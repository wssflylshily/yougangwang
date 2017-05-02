<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use Exception;
use App;
use Auth;
use Request;
use Validator;
use Session;
use DB;

class OrderController extends Controller
{
    protected function postCheckout()
    {
        $response = [
            'result'    => true,
            'message'   => '订单提交成功',
        ];

        try {
            $validator = Validator::make(Request::all(), [
                'onecheck'     => 'required',
            ], [
                'onecheck.required' => '没有选中要结算的现货',
            ]);

            if ($validator->fails())
            {
                throw new Exception($validator->errors()->first());
            }

            $onecheck = Request::input('onecheck');
            $num = Request::input('dnum');
            for($i=0;$i<count($onecheck);$i++)
            {
                App\Cart::where('id', $onecheck[$i])->update(['buy_number' => $num[$i]]);
            }

            Session::set('onecheck', Request::input('onecheck'));

            // 检查要删除的是否都是自己购物车里的
            $has_illegal =  App\Cart::whereIn('id', Request::input('onecheck'))
                                    ->where('user_id', '<>', Auth::user()->id)
                                    ->count();

            if ($has_illegal) {
                throw new Exception('包含非法操作，不能删除');
            } else {
                // 验证要结算商品的有效性
                $vaild_goods = App\Cart::whereIn('id', Request::input('onecheck'))
                    ->has('ori')
                    ->with('ori')
                    ->get();

                if (count($vaild_goods) < count(Request::input('onecheck'))) {
                    throw new Exception('有现货刚被下架，请刷新购物车');
                }

                // 验证库存
                foreach ($vaild_goods as $goods) {
                    if ($goods->buy_number > $goods->ori->stock) {
                        throw new Exception('有现货库存不足');
                    }
                }

                // 卖家
                $sellers = App\Cart::where('user_id', Auth::user()->id)
                                   ->orderBy('created_at', 'desc')
                                   ->lists('seller_id')
                                   ->unique()
                                   ->toArray();

                $response['seller_cnt'] = count($sellers);
                $response['cart_goods'] = App\Cart::where('user_id', Auth::user()->id)
                                                ->whereIn('id', Request::input('onecheck'))
                                                ->orderByRaw('instr(\',' . implode(',', $sellers) . ',\', CONCAT(\',\',seller_id,\',\'))')
                                                ->orderBy('created_at', 'desc')
                                                ->get();
//                $response['cart_goods'] = App\Cart::where('user_id', Auth::user()->id)
//                                                ->whereIn('id', Request::input('onecheck'))
//                                                ->groupBy('seller_id')
//                                                ->orderBy('created_at', 'desc')
//                                                ->get();

                $response['consignees'] = App\Consignee::where('user_id', Auth::user()->id)
                                                ->orderBy('is_default', 'desc')
                                                ->orderBy('id', 'desc')
                                                ->get();

                if (count($response['consignees']) == 0) {
                    throw new Exception('您还未设置收货地址，请先<a href="' . route('user.address') . '">添加</a>一个');
                }
            }
        } catch(Exception $e) {
            $response['result']  = false;
            $response['message'] = $e->getMessage();
            abort(500, $response['message']);
        }
        // echo json_encode($response);
        //  return;
        return view('shop.order.checkout', $response);
        //return view('shop.order.order_confirm', $response);
    }

    public function postPay()
    {
        $response = [
            'result'    => true,
            'message'   => '下单成功，请到个人中心做后续操作',
        ];
       // return $response;

        try {
            $onecheck = Session::remove('onecheck');

            // 检查要删除的是否都是自己购物车里的
            $has_illegal =  App\Cart::whereIn('id', $onecheck)
                                    ->where('user_id', '<>', Auth::user()->id)
                                    ->count();

            if ($has_illegal) {
                throw new Exception('包含非法操作，不能删除');
            }

            // 验证要结算商品的有效性
            $vaild_goods = App\Cart::whereIn('id', $onecheck)
                                   ->has('ori')
                                   ->with('ori')
                                   ->get();

            if (count($vaild_goods) == 0 || count($vaild_goods) < count($onecheck)) {
                throw new Exception('有现货刚被下架，请刷新购物车');
            }

            // 验证库存
            foreach ($vaild_goods as $goods) {
                if ($goods->buy_number > $goods->ori->stock) {
                    throw new Exception('有现货库存不足');
                }
            }

            // 卖家
            $sellers = App\Cart::where('user_id', Auth::user()->id)
                               ->orderBy('created_at', 'desc')
                               ->lists('seller_id')
                               ->unique()
                               ->toArray();

            $consignee = App\Consignee::find(Request::input('addr_select'));

            // 生成订单
            foreach ($sellers as $seller_id) {
                $checkout_cart_goods = App\Cart::whereIn('id', $onecheck)
                                      ->where('user_id', Auth::user()->id)
                                      ->where('seller_id', $seller_id)
                                      ->orderBy('created_at', 'desc')
                                      ->has('ori')
                                      ->with('ori')
                                      ->get();

                $new_order = new App\Order();
                $new_order->user_id = Auth::user()->id;
                $new_order->seller_id   = $seller_id;
                $new_order->seller_id   = $seller_id;
                $new_order->type        = 1;
                $new_order->order_sn    = sprintf('f%d%d%d', time(), Auth::user()->id + 1000, rand_len_int());
                $new_order->status      = -1;
                $new_order->linkman     = $consignee->receiver;
                $new_order->mobile      = $consignee->mobile;
                $new_order->address     = $consignee->province . $consignee->city . $consignee->county . ' ' . $consignee->detail_address;
                $new_order->zip_code    = $consignee->postcode;
                $new_order->receive_type= Request::input('receive_type');
                $new_order->pay_type= Request::input('pay_type');
                if (Request::input('receive_type') == 2){
                    $new_order->technology= Request::input('technology');
                }else{
                    $new_order->postsge  = 0;
                }

                $new_order->save();

                $order_goods  = [];
                $order_amount = 0;
                $del_goods    = [];
                $ori_goods    = [];
                foreach ($checkout_cart_goods as $goods) {
                    $area = DB::table('areas')->where('areaId', $goods->ori->area_code)->first();

                    $new_order_goods = new App\OrderGoods();
                    $new_order_goods->order_id  = $new_order->id;
                    $new_order_goods->goods_id  = $goods->ori->id;
                    $new_order_goods->buy_count = $goods->buy_number;
                    $new_order_goods->buy_price = $goods->buy_price;
                    $new_order_goods->bak_name  = $goods->ori->name;
                    $new_order_goods->bak_area  = $area ? $area->areaName : $goods->ori->area_code;
                    $new_order_goods->bak_variety  = $goods->ori->variety;
                    $new_order_goods->bak_standard  = $goods->ori->standard;
                    $new_order_goods->bak_steelmill  = $goods->ori->steelmill;
                    $new_order_goods->bak_attribute  = $goods->ori->length . '*' . $goods->ori->thickness . '*' . $goods->ori->outer_diameter;

                    $order_goods[] = $new_order_goods;
                    $order_amount += $goods->buy_number * $goods->buy_price;
                    $del_goods[]   = $goods->id;

                    // 减库存
                    $goods->ori->stock -= $goods->buy_number;
                    $ori_goods[]   = $goods->ori;
                }

                $new_order->order_amount = $order_amount;
                $new_order->save();

                $new_order->goods()->saveMany($order_goods);
                App\Cart::destroy($del_goods);

                foreach ($ori_goods as $goods) {
                    $goods->save();
                }
            }
        } catch(Exception $e) {
            $response['result']  = false;
            $response['message'] = $e->getMessage();
            $response['trace'] = $e->getTrace();
        }

        return $response;
    }

    /**
     * 立即支付
     * 孙璠
     * 2017.1.7
     */
    protected function postCheckNow()
    {
//        dd(Request::all());
        $response = [
            'result'    => true,
            'message'   => '',
        ];

        try {
            $validator = Validator::make(Request::all(), [
                'buy_id'     => 'required',
                'buy_number'     => 'required',
            ], [
                'buy_id.required' => '没有选中要结算的现货',
                'buy_number.required' => '购买数量不能为0',
            ]);

            if (Request::input('buy_number') <= 0)
            {
                throw new Exception("购买数量不能为0");
            }
            if ($validator->fails())
            {
                throw new Exception($validator->errors()->first());
            }


            // 验证要结算商品的有效性
            $db = App\Goods::query();
            $vaild_goods = $db->leftJoin('areas', 'areas.areaId', '=', 'goods.area_code')->where('id', Request::input('buy_id'))->with('seller')->first();

            if (!$vaild_goods) {
                throw new Exception('有现货刚被下架，请刷新页面');
            }

            // 验证库存
            if (Request::input('buy_number') > $vaild_goods->stock) {
                throw new Exception('有现货库存不足');
            }
            $response['goods'] = $vaild_goods;
            $response['goods_num'] = Request::input('buy_number');
            $response['buy_price'] = $vaild_goods->price*Request::input('buy_number');

            $response['consignees'] = App\Consignee::where('user_id', Auth::user()->id)
                ->orderBy('is_default', 'desc')
                ->orderBy('id', 'desc')
                ->get();
           // return;
            if (count($response['consignees']) == 0) {
                throw new Exception('您还未设置收货地址，请先<a href="' . route('user.address') . '">添加</a>一个');
            }
        } catch(Exception $e) {
            $response['result']  = false;
            $response['message'] = $e->getMessage();
            abort(500, $response['message']);
        }
//        dd($response);
        return view('shop.order.checkout2', $response);
    }

    public function postPayNow()
    {
        $response = [
            'result'    => true,
            'message'   => '订单已经生成，正在跳往订单列表页做后续操作',
        ];

        try {
            $db = App\Goods::query();
            $goods = $db->leftJoin('areas', 'areas.areaId', '=', 'goods.area_code')->where('id', Request::input('buy_id'))->with('seller')->first();

            if (!$goods) {
                throw new Exception('有现货刚被下架，请刷新页面');
            }

            // 验证库存
            if (Request::input('buy_number') > $goods->stock) {
                throw new Exception('有现货库存不足');
            }

            $seller_id = Request::input('seller_id');

            $consignee = App\Consignee::find(Request::input('addr_select'));

            // 生成订单

            $new_order = new App\Order();
            $new_order->user_id = Auth::user()->id;
            $new_order->seller_id   = $seller_id;
            $new_order->type        = 1;
            $new_order->order_sn    = sprintf('f%d%d%d', time(), Auth::user()->id + 1000, rand_len_int());
            $new_order->status      = -1;
            $new_order->linkman     = $consignee->receiver;
            $new_order->mobile      = $consignee->mobile;
            $new_order->address     = $consignee->province . $consignee->city . $consignee->county . ' ' . $consignee->detail_address;
            $new_order->zip_code    = $consignee->postcode;
            $new_order->receive_type= Request::input('receive_type');
            $new_order->pay_type= Request::input('pay_type');
            if (Request::input('receive_type') == 2){
                $new_order->technology= Request::input('technology');
            }

            $new_order->save();

            $order_goods  = [];
            $order_amount = 0;
            $del_goods    = [];

            $area = DB::table('areas')->where('areaId', $goods->area_code)->first();

            $new_order_goods = new App\OrderGoods();
            $new_order_goods->order_id  = $new_order->id;
            $new_order_goods->goods_id  = $goods->id;
            $new_order_goods->buy_count = Request::input('buy_number');
            $new_order_goods->buy_price = $goods->price;
            $new_order_goods->bak_name  = $goods->name;
            $new_order_goods->bak_area  = $area ? $area->areaName : $goods->area_code;
            $new_order_goods->bak_variety  = $goods->variety;
            $new_order_goods->bak_standard  = $goods->standard;
            $new_order_goods->bak_steelmill  = $goods->steelmill;
            $new_order_goods->bak_attribute  = $goods->length . '*' . $goods->thickness . '*' . $goods->outer_diameter;

            $order_goods[] = $new_order_goods;
            $order_amount += Request::input('buy_number') * $goods->price;
            $del_goods[]   = $goods->id;

            // 减库存
            $goods->stock -= Request::input('buy_number');

            $new_order->order_amount = $order_amount;
            $new_order->save();

            $new_order->goods()->saveMany($order_goods);
            App\Cart::destroy($del_goods);

            $goods->save();

        } catch(Exception $e) {
            $response['result']  = false;
            $response['message'] = $e->getMessage();
            $response['trace'] = $e->getTrace();
        }
        return $response;
    }
}

<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use Exception;
use App;
use Auth;
use Request;
use Validator;
use DB;

class CartController extends Controller
{
    protected function getIndex()
    {
        // 卖家
        $sellers = App\Cart::where('user_id', Auth::user()->id)
                           ->orderBy('created_at', 'desc')
                           ->lists('seller_id')
                           ->unique()
                           ->toArray();
        $result['seller_cnt'] = count($sellers);
        $result['cart_goods'] = App\Cart::where('carts.user_id', Auth::user()->id)
                                        ->has('ori')
                                        ->orderByRaw('instr(\',' . implode(',', $sellers) . ',\', CONCAT(\',\',gt_carts.seller_id,\',\'))')
                                        ->orderBy('carts.created_at', 'desc')
                                        ->get();
        $result['areas'] = DB::table('areas')->where('parentId','<>' , 0)->get();
        return view('shop.cart.index', $result);
    }

    public function postCount()
    {
        $response = [
            'result'    => true,
        ];

        try {

            $response['cart_count'] = Auth::check() ? App\Cart::where('user_id', Auth::user()->id)->has('ori')->count() : 0;

        } catch(Exception $e) {
            $response['result']  = false;
        }

        return $response;
    }

    public function postAdd()
    {
        $response = [
            'result'    => true,
            'message'   => '购物车添加成功',
        ];

        try {

            if (!Auth::check()) {
                throw new Exception('您尚未登录，不能添加购物车');
            }

            // 验证购买数量和库存
            if (!is_numeric(Request::input('buy_number')) || Request::input('buy_number') == 0) {
                throw new Exception('购买数量不能为0');
            }

            $get_goods = App\Goods::find(Request::input('goods_id'));

            if (!$get_goods || $get_goods->stock < Request::input('buy_number')) {
                throw new Exception('库存不足，请重新选择数量');
            }

            $user_id = Auth::user()->id;

            // 通过user_id找同款现货
            $cart = App\Cart::where('goods_id', $get_goods->id)
                            ->where('user_id', $user_id)
                            ->first();

            // 加入购物车
            if ($cart) {
                $cart->buy_number      += Request::input('buy_number');
            } else {
                $cart = new App\Cart();
                $cart->user_id          = $user_id;
                $cart->seller_id        = $get_goods->seller_id;
                $cart->goods_id         = $get_goods->id;
                $cart->buy_number       = Request::input('buy_number');
                $cart->buy_price        = $get_goods->price;
//                $cart->bak_name         = $get_goods->name;
//                $cart->bak_area         = $get_goods->area_code;
//                $cart->bak_variety      = $get_goods->variety;
//                $cart->bak_standard     = $get_goods->standard;
//                $cart->bak_material     = $get_goods->material;
//                $cart->bak_steelmill    = $get_goods->steelmill;
//                $cart->bak_attribute    = $get_goods->length . '*' . $get_goods->thickness . '*' . $get_goods->outer_diameter;
            }

            $cart->save();

            $response['cart_count'] = App\Cart::where('user_id', Auth::user()->id)
                                              ->has('ori')
                                              ->count();

        } catch(Exception $e) {
            $response['result']  = false;
            $response['message'] = $e->getMessage();
        }

        return $response;
    }

    public function postDelete()
    {
        $response = [
            'result'    => true,
            'message'   => '删除成功',
        ];

        try {

            // 检查要删除的是否都是自己购物车里的
            $has_illegal =  App\Cart::whereIn('goods_id', Request::input('goods_id'))
                                     ->where('user_id', '<>', Auth::user()->id)
                                     ->count();

            if ($has_illegal) {
                throw new Exception('包含非法操作，不能删除');
            } else {
                App\Cart::destroy(Request::input('goods_id'));
            }

        } catch(Exception $e) {
            $response['result']  = false;
            $response['message'] = $e->getMessage();
        }

        return $response;
    }

    public function postCheckout()
    {
        $response = [
            'result'    => true,
            'message'   => '订单已生成',
        ];

        try {

            // 检查要删除的是否都是自己购物车里的
            $has_illegal =  App\Cart::whereIn('goods_id', Request::input('goods_id'))
                                     ->where('user_id', '<>', Auth::user()->id)
                                     ->count();

            if ($has_illegal) {
                throw new Exception('包含非法操作，不能删除');
            } else {
                // 验证要结算商品的有效性
                $vaild_goods = App\Cart::whereIn(Request::input('goods_id'))
                                       ->has('ori')
                                       ->with('ori')
                                       ->get();

                if (count($vaild_goods) < count(Request::input('goods_id'))) {
                    throw new Exception('有现货刚被下架，请刷新购物车');
                }

                // 验证库存
                foreach ($vaild_goods as $goods) {
                    if ($goods->buy_number > $goods->ori->stock) {
                        throw new Exception('要结算的现货库存不足');
                    }
                }
            }

        } catch(Exception $e) {
            $error[] = $e->getMessage();
        }

        return $response;
    }

    //推荐方案一
    //孙璠 2017.2.17
    public function getRecommendOne()
    {
        $db_sellers = App\Seller::query();
        $check_carts_id = Request::input('goods_id');

        for ($i = 0; $i < count($check_carts_id); $i++) {
            $check_carts[$i] = App\Cart::query()->where('id', $check_carts_id[$i])->first();
        }
        for ($i = 0; $i < count($check_carts); $i++) {
            $check_goods[$i] = App\Goods::query()->where('id', $check_carts[$i]['goods_id'])->first();
        }

        for ($i = 0; $i < count($check_goods); $i++) {
            $goods[$i] = App\Goods::query()
                ->where('material', $check_goods[$i]->material)
                ->where('outer_diameter', $check_goods[$i]->outer_diameter)
                ->where('thickness', $check_goods[$i]->thickness)
                ->where('length', $check_goods[$i]->length)
                ->where('stock', '>', $check_carts[$i]->buy_number)
                ->select('id','seller_id')
                ->get();
            //var_dump($goods[0][$i]->seller_id);

        }
        $j = 0;
        for ($j; $j < count($goods); $j++) {
            $a = $goods[$j];
            if (count($a)<1){
                $j++;
            }elseif (count($a)>1){
                break;
            }
        }

        $sameArr = array();
        $k = $j+1;

        for ($k; $k < count($goods); $k++) {
            if (count($goods[$k])<1){
                continue;
            }
            $b = $goods[$k];

            if (count($a)==1 && count($b)==1)
            {
                if ($a->seller_id=$b->seller_id){
                    $sameArr[] = $a->seller_id;
                }
            }elseif (count($a)==1 && count($b)>1)
            {
                foreach ($b as $item){
                    if ($a->seller_id == $item->seller_id){
                        $sameArr[] = $a->seller_id;
                    }
                }
            }elseif (count($b)==1 && count($a)>1)
            {
                foreach ($a as $item){
                    if ($b->seller_id == $item->seller_id){
                        $sameArr[] = $b->seller_id;
                    }
                }
            }else {
                foreach ($a as $item)
                {
                    foreach ($b as $value)
                    {
                        if ($item->seller_id == $value->seller_id){
                            $sameArr[] = $item->seller_id;
                        }
                    }
                }
            }
            $a = $sameArr;
        }
        if(!empty($a)){
            $a = array_unique($a);
            $a = array_values($a);
        }

        for ($i = 0; $i < count($a); $i++) {
            $return[$i]['seller'] = $a[$i];
            $return[$i]['seller_name'] = App\Seller::query()->where('id',$a[$i])->value('name');
            for ($j = 0; $j < count($check_goods); $j++)
            {
                $return[$i]['goods'][$j] = App\Goods::query()
                    ->where('seller_id', $a[$i])
                    ->where('material', $check_goods[$j]->material)
                    ->where('outer_diameter', $check_goods[$j]->outer_diameter)
                    ->where('thickness', $check_goods[$j]->thickness)
                    ->where('length', $check_goods[$j]->length)
                    ->where('stock', '>', $check_carts[$j]->buy_number)
                    ->first();
                $return[$i]['goods'][$j]['buy_num'] = $check_carts[$j]->buy_number;
            }
        }
        echo json_encode($return);
    }

    //推荐方案二
    //孙璠 2017.2.17
    public function getRecommendTwo()
    {
        //$db_sellers = App\Seller::query();
        $check_carts_id = Request::input('goods_id');

        for ($i = 0; $i < count($check_carts_id); $i++) {
            $check_carts[$i] = App\Cart::query()->where('id', $check_carts_id[$i])->first();
        }
        for ($i = 0; $i < count($check_carts); $i++) {
            $check_goods[$i] = App\Goods::query()->where('id', $check_carts[$i]['goods_id'])->first();
        }

        for ($i = 0; $i < count($check_goods); $i++) {
            $goods[$i] = App\Goods::query()
                ->where('material', $check_goods[$i]->material)
                ->where('outer_diameter', $check_goods[$i]->outer_diameter)
                ->where('thickness', $check_goods[$i]->thickness)
                ->where('length', $check_goods[$i]->length)
                ->where('stock', '>', $check_carts[$i]->buy_number)
                ->select('id','area_code')
                ->get();
            //var_dump($goods[0][$i]->seller_id);

        }
        $j = 0;
        for ($j; $j < count($goods); $j++) {
            $a = $goods[$j];
            if (count($a)<1){
                $j++;
            }elseif (count($a)>1){
                break;
            }
        }

        $sameArr = array();
        $k = $j+1;

        for ($k; $k < count($goods); $k++) {
            if (count($goods[$k])<1){
                continue;
            }
            $b = $goods[$k];

            if (count($a)==1 && count($b)==1)
            {
                if ($a->area_code=$b->area_code){
                    $sameArr[] = $a->area_code;
                }
            }elseif (count($a)==1 && count($b)>1)
            {
                foreach ($b as $item){
                    if ($a->area_code == $item->area_code){
                        $sameArr[] = $a->area_code;
                    }
                }
            }elseif (count($b)==1 && count($a)>1)
            {
                foreach ($a as $item){
                    if ($b->area_code == $item->area_code){
                        $sameArr[] = $b->area_code;
                    }
                }
            }else {
                foreach ($a as $item)
                {
                    foreach ($b as $value)
                    {
                        if ($item->area_code == $value->area_code){
                            $sameArr[] = $item->area_code;
                        }
                    }
                }
            }
            $a = $sameArr;
        }
        $a = array_unique($a);
        $a = array_values($a);

        for ($i = 0; $i < count($a); $i++) {
            $return[$i]['area_code'] = $a[$i];
            $return[$i]['area_name'] = DB::table('areas')->where('areaId', $a[$i])->first();
            for ($j = 0; $j < count($check_goods); $j++)
            {
                $return[$i]['goods'][$j] = App\Goods::query()
                    ->where('area_code', $a[$i])
                    ->where('material', $check_goods[$j]->material)
                    ->where('outer_diameter', $check_goods[$j]->outer_diameter)
                    ->where('thickness', $check_goods[$j]->thickness)
                    ->where('length', $check_goods[$j]->length)
                    ->where('stock', '>', $check_carts[$j]->buy_number)
                    ->first();
                $return[$i]['goods'][$j]['buy_num'] = $check_carts[$j]->buy_number;
            }
        }

        echo json_encode($return);
    }

    public function postRecommend()
    {
        dd(Request::all());
    }
}

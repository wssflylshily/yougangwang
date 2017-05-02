<?php

namespace App\Http\Controllers\Seller;

use App;
use App\Http\Controllers\Controller;
use Request;
use Validator;
use \Illuminate\Support\Facades\Auth;
use Validation;
use App\Http\Controllers\Common\SendMessage;

class HomeController extends Controller
{
    public function __construct()
    {
//        $this->middleware('guest', ['except' => 'getLogout']);
    }

    protected function getIndex()
    {
    	$seller_id = Auth::user()->id;
    	$seller_db = App\Seller::query();
    	$seller = $seller_db->where('user_id',$seller_id)->first();
    	$jyfs = implode('、', json_decode($seller->business_type));
    	$wl = implode('、', json_decode($seller->logistics_type));
//     	dd($seller);
//     	$user = App\User::query();
//     	$user_id = Auth::user()->id;
    	
//     	$users = $user->where('id', $user_id)->first();
        return view('seller.home.index',['seller'=>$seller,'jyfs'=>$jyfs,'wl'=>$wl]);
    }
    
    /**
     * 我的合同
     */
    protected function getMyContract(){
        $db_orders = App\Order::query();
        $orders =$db_orders
            ->leftJoin('contracts', 'contracts.order_id', '=', 'orders.id')
            ->where('seller_id', Auth::user()->id)
            ->where('orders.status', '-1')
            ->where('contracts.status', ['1'])
            ->orderBy('contracts.created_at', 'desc')
            ->select('contracts.*', 'orders.*', 'contracts.created_at as create_time', 'contracts.status as cstate', 'orders.status as ostate')
            ->with('seller')
            ->paginate(8);
        
    	return view('seller.home.contractList',['orders' => $orders]);
    }

    //已签约
    protected function getContractAlready()
    {
        /*$db_contract = App\Contract::query();
        $rs = $db_contract->where('status',3)->paginate(8);*/
        $db_orders = App\Order::query();
        if (Request::input('type') != null)
        {
            $db_orders->where('status' , Request::input('type'));
        }
        $orders =$db_orders
            ->leftJoin('contracts', 'contracts.order_id', '=', 'orders.id')
            ->where('user_id', Auth::user()->id)
            ->whereIn('orders.status', ['-1', '1'])
            ->whereIn('contracts.status', [ '2', '3', '100'])
            ->orderBy('orders.created_at', 'desc')
            ->select('contracts.*', 'orders.*', 'contracts.updated_at as create_time', 'contracts.status as cstate', 'orders.status as ostate')
            ->with('seller')
            ->paginate(8);
        return view('seller.home.contract_already', ['orders' => $orders]);
    }
    protected function getContractCancel()
    {
        /*$db_contract = App\Contract::query();
        $rs = $db_contract->where('status',3)->paginate(8);*/
        $db_orders = App\Order::query();
        if (Request::input('type') != null)
        {
            $db_orders->where('status' , Request::input('type'));
        }
        $orders =$db_orders
            ->leftJoin('contracts', 'contracts.order_id', '=', 'orders.id')
            ->where('user_id', Auth::user()->id)
            ->whereIn('orders.status', ['100'])
            ->whereIn('contracts.status', ['100'])
            ->orderBy('orders.created_at', 'desc')
            ->select('contracts.*', 'orders.*', 'contracts.updated_at as create_time', 'contracts.status as cstate', 'orders.status as ostate')
            ->with('seller')
            ->paginate(8);
        return view('seller.home.contract_cancel', ['orders' => $orders]);
    }

    //发货----发送短信
    //传订单id
    public function postSendGoodsSms()
    {
        $response = [
            'result'    => true,
            'message'   => '验证码已发送至买家手机',
        ];

        try {

            $validator = Validator::make(Request::all(), [
                'order_id'    => 'required',
            ], [
                'order_id.required'   => '订单异常，发货失败',
            ]);

            if ($validator->fails()) {
                throw new Exception($validator->messages()->first());
            }

            if (captcha_valid(Request::input('mobile'))) {
                throw new Exception('您刚收到的验证码仍然有效');
            }

            $db_order = App\Order::query();
            $order_detail = $db_order->where('id', Request::input('order_id'))->first();

            // 生成验证码和短信内容
            $captcha = $this->randomkeys(8);
            // $sms_tpl = '卖家已发货，您的收货验证码是:' . $captcha . '。请不要把验证码泄露给其他人。【优钢网】';

            // 生成发送验证码api的调用参数
            // $post_data = http_build_query([
            //     'sname'     => 'DL-wanglu',
            //     'spwd'      => 'abc123456',
            //     'scorpid'   => '',
            //     'sprdid'    => '1012818',
            //     'sdst'      => $order_detail->mobile,
            //     'smsg'      => $sms_tpl,
            // ], null, '&', PHP_QUERY_RFC3986);

            // // 取得发送验证码api
            // $gets = sms_captcha($post_data);

            // // 解析返回结果，做相应处理
            // $result = xml_to_array($gets);

            //-------------------------TODO-------------短信验证码---------------
            $instance = new SendMessage();
            $tem = "SMS_61830017";
            $status=$instance->run($order_detail->mobile,$captcha,$tem,1);
            if($status == false){
                $response['result']  = false;
                $response['message'] = '网络错误'; 
            }else{
                // 把验证码相关信息保存到session里
                captcha_store($captcha, Request::input('mobile'));
                $db = App\Order::query();
                $rs = $db->where('id', Request::input('order_id'))->update(['receive_code' => $captcha, 'status' => 5]);
            }
            // $db = App\Order::query();
            // $rs = $db->where('id', Request::input('order_id'))->update(['receive_code' => $captcha, 'status' => 5]);

            /*if ($result['State'] == 0) {
                //把验证码和订单状态更新到订单里
                $db = App\Order::query();
                $rs = $db->where('id', Request::input('order_id'))->update(['receive_code' => $captcha, 'status' => 5]);
            } else {
                throw new Exception('验证码发送失败，请重试');
            }*/

        } catch ( \Exception $e) {
            $response['result']  = false;
            $response['message'] = '网络错误'; 
        }

        return $response;
    }

    //收货 --- 验证收货码
    public function postReceiveGoods()
    {
        $response = [
            'result'    => true,
            'message'   => '收货成功！',
        ];

        try {

            $validator = Validator::make(Request::all(), [
                'order_id'    => 'required',
                'code'    => 'required',
            ], [
                'order_id.required'   => '订单异常，收货失败',
                'code.required'   => '收货码不能为空',
            ]);

            if ($validator->fails()) {
                throw new \Exception($validator->messages()->first());
            }

            $db_order = App\Order::query();
            $order_detail = $db_order->where('id', Request::input('order_id'))->first();

            if ($order_detail->receive_code == Request::input('code')) {
                //把验证码和订单状态更新到订单里
                $db = App\Order::query();
                $rs = $db->where('id', Request::input('order_id'))->update(['status' => 6]);
            } else {
                throw new \Exception('收货码不正确');
            }

        } catch (\Exception $e) {
            $response['result']  = false;
            $response['message'] = $e->getMessage();
        }

        return $response;
    }

    //生成验证码
    public function randomkeys($length = 8)
    {
        $key = "";
        $pattern = '1234567890abcdefghijklmnopqrstuvwxyz   
               ABCDEFGHIJKLOMNOPQRSTUVWXYZ';
        for($i=0;$i<$length;$i++)
        {
            $key .= $pattern{mt_rand(0,35)};    //生成php随机数
        }
        return $key;
    }

//销售中心 --我的评价
    protected function getMyComment()
    {
        //订单信息
        $db_comment = App\Comments::query();
        $rs =$db_comment
            ->join('orders', 'orders.id', '=', 'comments.order_id')
            ->where('seller_id', Auth::user()->id)
//            ->with('order')
            ->paginate(8);
        return view('seller.stocks.index',['rs' => $rs]);
    }
}

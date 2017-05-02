<?php

/**
 * HomeController constructor.
 * 个人中心
 * 孙璠
 * 2016.12.21
 */

namespace App\Http\Controllers\User;

use App;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Request;
use Validator;

class HomeController extends Controller
{
    public function __construct()
    {
//        $this->middleware('guest', ['except' => 'getLogo   ut']);
    }


    //首页
    protected function getIndex()
    {
        $user = App\User::query();
        $user_id = Auth::user()->id;

        $users = $user->where('id', $user_id)->first();
        if($users->realname_auth == 0){
            $users->nameauth = "未实名认证"; 
        }else{
            $users->nameauth = "实名认证";
        }

        // 信用等级
        $degree_html = '';
        for($i = 0;$i<$users['credit_degree'];$i++){
            $degree_html .= '<span class="ok"></span>';
        }

        for($j = 0;$j<5-$users['credit_defree'];$j++){
            $degree_html .= '<span class="no"></span>';
        }

        $users->degree_html = $degree_html;

        if(!$users->avatar_pic){
            $users->avatar_pic = '/assets/shop/img/person/headimg.jpg';
        }

        // dd($users);

        //孙璠--用户首页--现货----start

        $num[0] = DB::table('orders')      //待签约
            ->where('type',1)
            ->where('user_id',$user_id)
            ->where('status',-1)
            ->count();

        $num[1] = DB::table('orders')      //待付款
        ->where('type',1)
            ->where('user_id',$user_id)
            ->where('status', 1)
            ->count();

        $num[2] = DB::table('orders')      //待收货
        ->where('type',1)
            ->where('user_id',$user_id)
            ->where('status', 5)
            ->count();

        /*$num1 = DB::table('order')      //待自提
        ->where('type',1)
            ->where('user_id',$user_id)
            ->where('status',-1)
            ->count();*/

        $num[4] = DB::table('orders')      //待评价
        ->where('type',1)
            ->where('user_id',$user_id)
            ->where('status', 9)
            ->count();

        $db_orders = App\Order::query();
        if (Request::input('type') != null)
        {
            $db_orders->where('status' , Request::input('type'));
        }
        $orders =$db_orders
                ->where('type',1)
                ->where('user_id',$user_id)
                ->orderBy('created_at', 'desc')
                ->with('goods')
                ->with('seller')
                ->get();
        //孙璠--用户首页--现货----end
        return view('user.home.index',['users'=>$users,'order_goods' => $orders, 'num' => $num]);

    }


    protected function getIndexFutures()
    {

        $user = new \App\User();
        $user_id = Auth::user()->id;
        // $users = $user->all();
        $users = $user->select('realname','realname_auth','credit_degree','avatar_pic','compony','consignee','id')->find($user_id);
        // dd($users);
        if($users->realname_auth == 0){
            $users->nameauth = "未实名认证"; 
        }else{
            $users->nameauth = "实名认证";
        }

        // 信用等级
        $degree_html = '';
        for($i = 0;$i<$users['credit_degree'];$i++){
            $degree_html .= '<span class="ok"></span>';
        }

        for($j = 0;$j<5-$users['credit_defree'];$j++){
            $degree_html .= '<span class="no"></span>';
        }

        $users->degree_html = $degree_html;

        if(!$users->avatar_pic){
            $users->avatar_pic = '/assets/shop/img/person/headimg.jpg';
        }

        $num[0] = DB::table('orders')      //待签约
        ->where('type',2)
        ->where('user_id',$user_id)
        ->where('status',-1)
        ->where('deleted_at',null)
        ->count();
        
        $num[1] = DB::table('orders')      //待付款
        ->where('type',2)
        ->where('user_id',$user_id)
        ->where('status', 2)
        ->orwhere('status',3)
        ->where('deleted_at',null)
        ->count();
        
        $num[2] = DB::table('orders')      //待收货
        ->where('type',2)
        ->where('user_id',$user_id)
        ->where('status', 5)
        ->where('deleted_at',null)
        ->count();
        
        $num[4] = DB::table('orders')      //待评价
        ->where('type',2)
        ->where('user_id',$user_id)
        ->where('status', 9)
        ->where('deleted_at',null)
        ->count();
        
        $db_orders = App\Order::query();
        $db_orders->where('type' , 2);
        $db_orders->where('user_id' , $user_id);
        $status = Request::input('status');
        if (Request::input('status') != null){
        	$db_orders->where('status' , Request::input('status'));
        }
        $orders =$db_orders
		        ->orderBy('created_at', 'desc')
		        ->paginate(20);
        
        //(strtotime($order->created_at)-time())/(60*60*24)
        
        return view('user.home.index_futures',['users'=>$users,'orders'=>$orders,'status'=>$status,'num'=>$num]);
    }

    /**
     * 取消订单
     * 孙璠
     * 2017.1.3
     */
    protected function cancelOrder()
    {
        $response = [
            'result'    => true,
            'message'   => '取消成功!',
        ];
        $db = App\Order::query();
        $his = $db->where('id', Request::input('id'))->first();
        if ($his->status == -1)
        {
            $db_contract = App\Contract::query();
            $rs = $db->where('id', Request::input('id'))->update(['status' => 100]);
            $rsc = $db_contract->where('order_id', Request::input('id'))->update(['status' => 100]);
        }else{
            $response = [
                'result'    => false,
                'message'   => '取消失败!',
            ];;
        }
        return $response;
    }
}

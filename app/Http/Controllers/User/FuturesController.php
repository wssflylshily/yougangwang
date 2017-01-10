<?php

/**
 * HomeController constructor.
 * 个人中心--期货
 * 孙璠
 * 2016.12.21
 */

namespace App\Http\Controllers\User;

use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\Controller;
use Request;
use Validator;
use App;

class FuturesController extends Controller
{
// 	protected $user_id = 1;
// 	protected $seller_id = 2;

    public function __construct()
    {
//        $this->middleware('guest', ['except' => 'getLogo   ut']);
    }


    /**
     * 我的期货
     */
    protected function getFutures()
    {
    	$user_id = Auth::user()->id;
    	$order_db = App\Order::query();
    	$status = Request::input('status');
    	if (Request::input('status') != null)
    	{
    		$order_db->where('status' , Request::input('status'));
    	}
    	$orderlist = $order_db->where('type',2)->where('user_id',$user_id)->orderby('id','desc')->paginate(5);
        
    	return view('user.futures.futures',['orderList'=>$orderlist,'status'=>$status]);
    }

    /**
     * 期货 历史
     */
    protected function getFuturesHistory()
    {
        return view('user.futures.futures_history');
    }
    
    /**
     * 买家选择商家，更改状态
     */
    protected function getOfferSellers($order_id,$seller_id){
//     	dd($order_id."---".$seller_id);
    	$seller_id = $this->seller_id;
    	//查找商家的报价信息
    	$offer_db = App\FutureOffers::query();
    	$get_offers = $offer_db->where('order_id',$order_id)->where('seller_id',$seller_id)->get();
    	
    	$order_db = App\Order::query();
    	$get_order = $order_db->where('id',$order_id)->first();
    	$get_order->status = -1;
    	$get_order->seller_id = $seller_id;
    	//计算订单价格
    	$get_order->save();
    	return redirect(route('user.futures'));
    }
    /**
     * 更改订单状态
     */
    protected function changeOrderStatus($order_id,$status){
    	$order_db = App\Order::query();
    	$get_order = $order_db->where('id',$order_id)->first();
    	$get_order->status = $status;
    	$get_order->save();
    	return redirect(route('user.futures'));
    }
    
    /**
     * 填写发票信息页面
     */
    protected function invoice($order_id){
    	$order_db = App\Order::query();
    	$order = $order_db->where('id',$order_id)->first();
    	$future_db = App\OrderFutures::query();
    	$futures = $future_db->where('order_id',$order_id)->get();
    	
    	return view('user.futures.invoice',['order'=>$order,'futures'=>$futures]);
    }
    
    /**
     * 提交发票信息
     */
    protected function postInvoice(){
    	
    }

    /**
     * 商家接单
     */
    protected function takeOrder(){
        $order_db = App\Order::query();
        $get_order = $order_db->where('order_sn',Request::input('order_sn'))->first();
        return view('user.futures.takeorder',['order'=>$get_order]);
    }
    

}

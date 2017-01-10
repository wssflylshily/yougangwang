<?php

namespace App\Http\Controllers\Seller;

use Illuminate\Support\Facades\Auth;

use App;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Request;
use Validator;

class FuturesController extends Controller
{
    public function __construct()
    {
    	
    }

    /**
     * 我的期货列表
     */
    protected function getIndex()
    {
        return view('seller.futures.index');
    }
    
    /**
     * 期货询单列表
     */
    protected function getFutures(){
    	$order_db = App\Order::query();
    	$future_db = App\OrderFutures::query();
    	if(Request::input('area')){
    		$future_db->where('area_id',Request::input('area'));
    	}
    	if(Request::input('variety')){
    		$future_db->where('variety',Request::input('variety'));
    	}
    	if(Request::input('standard')){
    		$future_db->where('standard',Request::input('standard'));
    	}
    	if(Request::input('start')){
    		$future_db->where('delivery_date','>',Request::input('start'));
    	}
    	if(Request::input('end')){
    		$future_db->where('delivery_date','<',Request::input('end'));
    	}
    	if(Request::input('start')&&Request::input('end')){
    		$future_db->whereBetween('delivery_date',[Request::input('start'),Request::input('end')]);
    	}
    	
    	$futures = $future_db->groupby('order_id')->orderby('order_id','desc')->paginate(5);
		
    	$allArea = DB::table('areas')->where('parentId',0)->get();
    	
    	return view('seller.futures.futuresList',['futures'=>$futures,'areas'=>$allArea]);
    }
    
    /**
     * 期货详情
     */
    protected function getDetail($order_id){
    	$order_db = App\Order::query();
    	$get_order = $order_db->where('id',$order_id)->first();
    	
    	return view('seller.futures.detail',['order'=>$get_order]);
    }
    
    /**
     * 期货报单
     */
    protected function getOfferFutures(){
    	$seller_id = Auth::user()->id;
    	$db_offers = App\FutureOffers::query();
    	$order_ids = $db_offers->where('seller_id',$seller_id)->groupby('order_id')->get(['order_id']);
    	
//     	$orderids = DB::table('future_offers')->where('seller_id',$seller_id)->lists('order_id');
//     	$list = DB::table('orders')->whereIn('id',$orderids)->get();
    	$db_orders = App\Order::query();
//     	 ->join('future_offers',)
        $orders = $db_orders->where('type',2)->where('seller_id',$seller_id)->whereIn('id',$order_ids)->get();
//         print_r($orders);die;

    	return view('seller.futures.offer',['list'=>$orders,'seller_id'=>$seller_id]);
    }
    
    /**
     * 期货订单列表
     */
    protected function getOrders(){
    	$seller_id = Auth::user()->id;
    	$order_db = App\Order::query();
//     	$status = Request::input('status');
//     	if($status==1){
    		
//     	}elseif ($status==2){
    		
//     	}
    	$orders = $order_db->where('type',2)->where('seller_id',$seller_id)->orderby('id','desc')->get();
    	
    	return view('seller.futures.orders',['orders'=>$orders]);
    }
    
    /**
     * 查看物流信息
     */
    protected function getLogistics($order_id){
    	$logistics_db = App\Logistics::query();
    	$list = $logistics_db->where('order_id',$order_id)->orderby('created_at','desc')->get();
    	$order_db = app\Order::query();
    	$order = $order_db->where('id',$order_id)->first();
    	
    	return view('seller.futures.logistics_write',['list'=>$list,'order'=>$order]);
    }
    /**
     * 提交物流信息
     */
    protected function postLogistics(){
    	$new_logistics = new App\Logistics();
    	$new_logistics->order_id = Request::input('order_id');
    	$new_logistics->message = Request::input('message');
    	$new_logistics->save();
    	return redirect(route('seller.futures.logistics',['order_id'=>Request::input('order_id')]));
    }
    
    /**
     * 更改订单状态
     */
    protected function changeOrderStatus($order_id,$status){
    	$order_db = App\Order::query();
    	$get_order = $order_db->where('id',$order_id)->first();
    	$get_order->status = $status;
    	$get_order->save();

    	return redirect(route('seller.futures.orders'));
    }
    
    
    
}

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
    	
    	$futures = $future_db
    				->leftJoin('areas', 'areas.areaId', '=', 'order_futures.area_id')
    				->groupby('order_id')
    				->orderby('order_id','desc')
    				->paginate(10);
		
    	$allArea = DB::table('areas')->where('parentId',0)->get();
    	//品种
    	$db1 = App\Variety::query();
    	$parameter['varieties'] = $db1->get();
    	
    	//材质
    	$db2 = App\Material::query();
    	$parameter['materials'] = $db2->get();
    	
    	//标准
    	$db3 = App\Standard::query();
    	$parameter['standards'] = $db3->get();
    	
    	//钢厂
    	$db4 = App\SteelMill::query();
    	$parameter['steelmills'] = $db4->get();
    	
    	return view('seller.futures.futuresList',['futures'=>$futures,'areas'=>$allArea],$parameter);
    }
    
    /**
     * 期货详情
     */
    protected function getDetail($order_id){
    	$order_db = App\Order::query();
    	$get_order = $order_db->where('id',$order_id)->first();
    	$areas = DB::table('areas')->where('parentId',0)->get();
//     	$user_id = Auth::user()->id;
//     	$user_db = App\User::query();
//     	$user = $user_db->where('id',$user_id)->first();
//     	$seller_db = App\Seller::query();
//     	$seller = $seller_db->where('user_id',$user_id)->first();
    	$futureNum = $order_db->where('user_id',$get_order->user_id)->count();
    	return view('seller.futures.detail',['order'=>$get_order,'areas'=>$areas,'futureNum'=>$futureNum]);
    }
    
    /**
     * 期货报单
     */
    protected function getOfferFutures(){
    	$user_id = Auth::user()->id;
    	$seller_db = App\Seller::query();
    	$seller = $seller_db->where('user_id',$user_id)->first();
    	
    	$db_offers = App\FutureOffers::query();
    	$order_ids = $db_offers->where('seller_id',$seller->id)->groupby('order_id')->lists('order_id');
    	
    	//$orderids = DB::table('future_offers')->where('seller_id',$seller_id)->lists('order_id');
//     	$list = DB::table('orders')->whereIn('id',$orderids)->get();
    	$db_orders = App\Order::query();
//     	 ->join('future_offers',)
        $orders = $db_orders->where('type',2)->whereIn('id',$order_ids)->orderBy('id','desc')->get();
        
        /*$contract_db = App\Contract::query();
        //签约中的订单
        $order_ids1 = $contract_db->where('status','<',3)->whereIn('order_id',$order_ids)->lists('order_id');
        $orders1 = $db_orders->where('type',2)->whereIn('id',$order_ids1)->orderBy('id','desc')->get();
        //签约完成的订单
        $order_ids2 = $contract_db->where('status',3)->whereIn('order_id',$order_ids)->lists('order_id');
        $orders2 = $db_orders->where('type',2)->whereIn('id',$order_ids2)->orderBy('id','desc')->get();*/
        
//         print_r($orders);die;

    	return view('seller.futures.offer',['list'=>$orders,'seller_id'=>$seller->id]);
    }
    
    /**
     * 期货订单列表
     */
    protected function getOrders(){
    	$seller_id = Auth::user()->id;
    	$order_db = App\Order::query();
    	$status = Request::input('status');
    	if (Request::input('status') != null)
    	{
    		$order_db->where('status' , $status);
    	}
//     	$status = Request::input('status');
//     	if($status==1){
    		
//     	}elseif ($status==2){
    		
//     	}
    	$orders = $order_db->where('type',2)->where('seller_id',$seller_id)->orderby('id','desc')->get();
    	
    	return view('seller.futures.orders',['orders'=>$orders,'status'=>$status]);
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
    	$order_id = Request::input('order_id');
    	$new_logistics->order_id = $order_id;
    	$new_logistics->message = Request::input('message');
    	$new_logistics->save();
    	return redirect(route('seller.futures.logistics',['order_id'=>$order_id]));
    }
    
    /**
     * 查看发票信息
     */
    protected function getInvoice($order_id){
    	$order_db = App\Order::query();
    	$order = $order_db->where('id',$order_id)->first();
//     	dd($order);
    	return view('seller.futures.invoice',['order'=>$order]);
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

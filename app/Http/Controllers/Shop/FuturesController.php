<?php
namespace App\Http\Controllers\Shop;

use Illuminate\Support\Facades\Auth;
use DB;
use App;
use Session;
use Request;
//use App\Future;

use App\Http\Controllers\Controller;
use Validator;

class FuturesController extends Controller
{
	protected $seller_id = 2;
	protected $user_id = 1;
	
	/**
	 * 期货列表
	 */
	protected function getIndex(){
		//查找所有省份
		$areas = DB::table('areas')->where('parentId',0)->get();
		$query = App\OrderFutures::query();
// 		$order_db = App\Order::query();
// 		$order = $order_db->where('type',2)->get();
		
		//$result['list'] = $query->
		if(!empty(Request::query())){
			if (Request::input('area'))
			{
				$query->where('area_id', Request::input('area'));
			}
			if (Request::input('variety'))
			{
				$query->where('variety', Request::input('variety'));
			}
			if (Request::input('standard'))
			{
				$query->where('standard', Request::input('standard'));
			}
			if (Request::input('starttime')){
				$query->where('delivery_date','>=',Request::input('starttime'));
			}
			if(Request::input('endtime')){
				$query->where('delivery_date','<',Request::input('endtime'));
			}
			if (Request::input('starttime') && Request::input('endtime'))
			{
				$query->whereBetween('delivery_date', [Request::input('starttime'), Request::input('endtime')]);
			}
		}
		$list = $query->groupby('order_id')->orderby('order_id','desc')->paginate(5);
		//$list = DB::table('order_futures')->groupby('order_id')->paginate(2);
		//$result['list'] = "";
		return view('shop.futures.index',['list' => $list,'areas'=>$areas]);
	}
	
	/**
	 * 期货详情
	 */
	protected function getDetail($id){
		//查询订单信息
		$order_db = App\Order::query();
		$order = $order_db->where('id',$id)->first();
		//查询用户已发单数量
		$user_id = $order->user_id;
		$futureNum = $order_db->where('user_id',$user_id)->count();
		
		/*$result = DB::table('orders')
		->where('id',$id)
		->first();
		$list = DB::table('order_futures')->where('order_id',$id)->get();*/
		
		return view('shop.futures.detail',['order'=>$order,'futureNum'=>$futureNum]);
	}
	
	/**
	 * 商家提交报价
	 */
	protected function postOffer(){
		$data = $_POST;
// 		$req = request();
		$futureOffers = new App\FutureOffers();
		$futureOffers->seller_id = $this->seller_id;
		$futureOffers->unit_price= $data['price'];
		$futureOffers->days = $data['daynum1'];
		$futureOffers->valid_day = $data['daynum2'];
		$futureOffers->future_id = $data['future_id'];
		$futureOffers->order_id = $data['order_id'];
		$ok = $futureOffers->save();
		$arr = array();
		if ($ok){
			$arr['status'] = 1;
			$arr['info'] = "报价成功";
		}else{
			$arr['status'] = 0;
			$arr['info'] = "报价失败";
		}
		echo json_encode($arr);exit;
	}
	
    /**
     * 根据地区id查询城市
     */
    protected function getCitiesByareaId(){
    	$areaid = $_GET['areaId'];
    	$cities = DB::table('areas')->where('parentId',$areaid)->get();
//     	var_dump($cities);die;
    	echo json_encode($cities);exit;
    }
	
	/**
	 * 发布期货第一步
	 */
    protected function publish()
    {
    	$areas = DB::table('areas')->where('parentId',0)->get();
    	//$areaids = DB::table('areas')->where('parentId',0)->lists('areaId');
    	//$cities = DB::table('areas')->whereIn('parentId',$areaids)->get();
    	
        return view('shop.futures.publish',['areas'=>$areas]);
    }
    /**
     * 提交期货信息
     */
    protected function postFuture(){
    	$user_id = Auth::user()->id;
    	$new_order = new App\Order();
    	$new_order->user_id = $user_id;
    	$new_order->type = 2;
    	$new_order->order_sn = "f".time().(1000+$user_id);
    	$new_order->linkman = Request::input('name');
    	$new_order->mobile = Request::input('tel');
    	$new_order->address = Request::input('addr');
    	$new_order->zip_code = Request::input('code');
    	
    	$new_future = new App\OrderFutures();
    	//$new_future->order_id = $new_order->id;
    	$new_future->area_id = Request::input('region');
    	$new_future->city_id = Request::input('city');
    	$new_future->variety = Request::input('variety');
    	$new_future->standard = Request::input('standard');
    	$new_future->material = Request::input('material');
    	$new_future->steelmill = Request::input('gangchang');
    	$new_future->outer_diameter = Request::input('waijing');
    	$new_future->thickness = Request::input('houdu');
    	$new_future->length_type = Request::input('lengthtype');
    	$new_future->length = Request::input('length');
    	$new_future->max_length = Request::input('lengthmax');
    	$new_future->unit = Request::input('unit');
    	$new_future->stock = Request::input('stock');
    	$new_future->deviation = Request::input('wucha');
    	$new_future->delivery_date = Request::input('date_start');
	    
    	Session::set('tmp_future_order', ['order'=>$new_order,'future'=>[$new_future]]);
    	return ['status'=>1];
    	
    }
    
    /**
     * 发布期货第二步
     */
    protected function publishtwo(){
    	$user_id = Auth::user()->id;
    	$orderInfo = Session::get('tmp_future_order');
//     	dd(Session::get('tmp_future_order'));
    	$areas = DB::table('areas')->where('parentId',0)->get();
    	
    	$seller_db = App\Seller::query();
    	//查询所有供应商
    	$suppliers = $seller_db->where('user_id','<>',$user_id)->get();
    	
//     	$orderInfo['future'][]
//     	$order_db = App\Order::query();
//     	$order = $order_db->where('id',$order_id)->first();
//     	$future_db = App\OrderFutures::query();
//     	$futures = $future_db->where('order_id',$order_id)->get();
    	
    	return view('shop.futures.publish2',['areas'=>$areas,'order'=>$orderInfo['order'],'futures'=>$orderInfo['future'],'suppliers'=>$suppliers]);
    }
    /**
     * 添加期货详细
     */
    protected function addFutureDetail(){
    	$orderInfo = Session::get('tmp_future_order');
    	$order = $orderInfo['order'];
//     	dd($order);
    	$futures = $orderInfo['future'];
    	$new_future = new App\OrderFutures();
    	$new_future->area_id = Request::input('region');
    	$new_future->city_id = Request::input('city');
    	$new_future->variety = Request::input('variety');
    	$new_future->standard = Request::input('standard');
    	$new_future->material = Request::input('material');
    	$new_future->steelmill = Request::input('gangchang');
    	$new_future->outer_diameter = Request::input('waijing');
    	$new_future->thickness = Request::input('houdu');
    	$new_future->length_type = Request::input('lengthtype');
    	$new_future->length = Request::input('length');
    	$new_future->max_length = Request::input('lengthmax');
    	$new_future->unit = Request::input('unit');
    	$new_future->stock = Request::input('stock');
    	$new_future->deviation = Request::input('wucha');
    	$new_future->delivery_date = Request::input('date_start');
    	$futures[] = $new_future;
    	Session::set('tmp_future_order',['order'=>$order,'future'=>$futures]);
    }
    
    /**
     * 确认发布订单
     */
    protected function postFutureOrder(){
    	$user_id = Auth::user()->id;
    	$orderinfo = Session::get('tmp_future_order');
    	$futures = $orderinfo['future'];
    	$new_order = new App\Order();
    	$new_order->user_id = $user_id;
    	$new_order->type = 2;
    	$new_order->order_sn = "f".time().(1000+$user_id).rand_len_int();
    	$new_order->linkman = Request::input('name');
    	$new_order->mobile = Request::input('tel');
    	$new_order->address = Request::input('addr');
    	$new_order->zip_code = Request::input('code');
    	$new_order->detail = Request::input('detail');
    	$new_order->receive_type = Request::input('way');
    	$new_order->send_type = Request::input('tsway');
//     	$new_order->status = -1;
    	$order_res = $new_order->save();
    	foreach ($futures as $item){
    		$new_future = new App\OrderFutures();
    		$new_future->order_id = $new_order->id;
    		$new_future->area_id = $item->area_id;
    		$new_future->city_id = $item->city_id;
    		$new_future->variety = $item->variety;
    		$new_future->standard= $item->standard;
    		$new_future->material = $item->material;
    		$new_future->steelmill = $item->steelmill;
    		$new_future->outer_diameter = $item->outer_diameter;
    		$new_future->thickness = $item->thickness;
    		$new_future->length_type = $item->length_type;
    		$new_future->length = $item->length;
    		$new_future->max_length = $item->max_length;
    		$new_future->unit = $item->unit;
    		$new_future->stock = $item->stock;
    		$new_future->deviation = $item->deviation;
    		$new_future->delivery_date = $item->delivery_date;
    		$new_future->save();
    	}
    	Session::set('tmp_future_order',null);
    	return redirect(route('shop.futures'));
//     	if ($order_res){
//     		Session::set('tmp_future_order',null);
//     		return json_encode(['status'=>1,'url'=>"/seller/futures"]);
//     	}else{
//     		return json_encode(['status'=>0,'url'=>"/futures"]);
//     	}
    }
    
    /**
     * 签订合同
     */
    protected function signContract(){
    	return view('shop.futures.signcontract');
    }
    
    /**
     * 支付订单
     */
    protected function payOrder(){
    	return view('shop.futures.payOrder');
    }
    
    /**
     * 生产
     */
    protected function produce(){
    	return view('shop.futures.produce');
    }
    
    /**
     * 物流查询
     */
    protected function getLogistic($order_id){
    	$order_db = App\Order::query();
    	$order = $order_db->where('id',$order_id)->first();
    	
    	$logistic_db = App\Logistics::query();
    	$logistics = $logistic_db->where('order_id',$order_id)->orderby('created_at','desc')->get();
    	
    	return view('shop.futures.logistic',['order'=>$order,'list'=>$logistics]);	
    }
    
    /**
     * 收货
     */
    protected function receipt(){
    	return view('shop.futures.receipt');
    }
    
    /**
     * 发票处理
     */
    protected function invoive(){
    	return view('shop.futures.invoive');
    }
    
    /**
     * 交易完成
     */
    protected function complete(){
    	return view('shop.futures.completion');
    }
    
}

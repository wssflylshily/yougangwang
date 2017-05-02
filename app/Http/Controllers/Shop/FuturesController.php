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
	/**
	 * 期货列表
	 */
	protected function getIndex(){
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
		
		//查找所有省份
		$areas = DB::table('areas')->where('parentId',0)->get();
		$cities = "";
		$query = App\OrderFutures::query();
// 		$order_db = App\Order::query();
// 		$order = $order_db->where('type',2)->get();
		
		//$result['list'] = $query->
		if(!empty(Request::query())){
			if (Request::input('area'))
			{
				$query->where('area_id', Request::input('area'));
				$cities = DB::table('areas')->where('parentId',Request::input('area'))->get();
			}
			if (Request::input('city'))
			{
				$query->where('city_id', Request::input('city'));
			}
			if (Request::input('variety'))
			{
				$query->where('variety', Request::input('variety'));
			}
			if (Request::input('standard'))
			{
				$query->where('standard', Request::input('standard'));
			}
			if (Request::input('material'))
			{
				$query->where('material', Request::input('material'));
			}
			if (Request::input('steelmill'))
			{
				$query->where('steelmill', Request::input('steelmill'));
			}
			if (Request::input('outer_diameter1') != null && Request::input('outer_diameter2'))
			{
				$query->whereBetween('outer_diameter', [Request::input('outer_diameter1'), Request::input('outer_diameter2')]);
			}
			if (Request::input('thickness1') != null && Request::input('thickness2'))
			{
				$query->whereBetween('thickness', [Request::input('thickness1'), Request::input('thickness2')]);
			}
			if (Request::input('length1') != null && Request::input('length2'))
			{
				$query->whereBetween('length', [Request::input('length1'), Request::input('length2')]);
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
		$list = $query
			->groupby('order_id')
			->orderby('order_id','desc')
			->paginate(10);
		//$list = DB::table('order_futures')->groupby('order_id')->paginate(2);
		//$result['list'] = "";
		return view('shop.futures.index',['list' => $list,'areas'=>$areas,'cities'=>$cities],$parameter);
	}
	
	/**
	 * 期货详情
	 */
	protected function getDetail($id){
		//查询订单信息
		$order_db = App\Order::query();
		$order = $order_db->where('id',$id)->first();
		$rs['order'] = $order;
		if (!empty($order)){
            //查询用户已发单数量
            $user_id = $order->user_id;
            $futureNum = $order_db->where('user_id',$user_id)->count();
            $areas = DB::table('areas')->where('parentId',0)->get();
            $rs['futureNum'] = $futureNum;
            $rs['areas'] = $areas;
        }

		/*$result = DB::table('orders')
		->where('id',$id)
		->first();
		$list = DB::table('order_futures')->where('order_id',$id)->get();*/
		
		return view('shop.futures.detail', $rs);
	}
	
	/**
	 * 商家提交报价
	 */
	protected function postOffer(){
		$data = $_POST;
		$userid = Auth::user()->id;
		$seller_db = App\Seller::query();
		$seller = $seller_db->where('user_id',$userid)->first();
		$offer_db = App\FutureOffers::query();
		$offer = $offer_db
				->where('seller_id',$seller->id)
				->where('order_id',$data['order_id'])
				->where('future_id',$data['future_id'])
				->first();
		if($offer){
			return ['status'=>-1,'info'=>'已经报过价了'];
// 			$arr['status'] = -1;
// 			$arr['info'] = "已经报过价了";
// 			echo json_encode($arr);exit;
		}
// 		$req = request();
		$futureOffers = new App\FutureOffers();
		$futureOffers->seller_id = $seller->id;
		$futureOffers->unit_price= $data['price'];
		$futureOffers->days = $data['daynum1'];
		$futureOffers->valid_day = $data['daynum2'];
		$futureOffers->future_id = $data['future_id'];
		$futureOffers->order_id = $data['order_id'];
		$ok = $futureOffers->save();
		$arr = array();
		if ($ok){
			return ['status'=>1,'info'=>"报价成功"];
// 			$arr['status'] = 1;
// 			$arr['info'] = "报价成功";
		}else{
			return ['status'=>0,'info'=>'报价失败'];
// 			$arr['status'] = 0;
// 			$arr['info'] = "报价失败";
		}
		//echo json_encode($arr);exit;
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
		//明星商城
		$seller = DB::table('sellers')->where('is_star', 1)->take(3)->orderBy('sale_count', 'desc')->get();
		
    	
        return view('shop.futures.publish',['areas'=>$areas,'sellers'=>$seller],$parameter);
    }
    /**
     * 提交期货信息
     */
    protected function postFuture(){
    	$user_id = Auth::user()->id;
    	$new_order = new App\Order();
    	$new_order->user_id = $user_id;
    	$new_order->type = 2;
    	$new_order->order_sn = "F".time().(1000+$user_id);
    	$new_order->linkman = Request::input('name');
    	$new_order->mobile = Request::input('tel');
    	$new_order->address = Request::input('addr');
    	$new_order->zip_code = Request::input('code');
    	
    	$new_future = new App\OrderFutures();
    	//$new_future->order_id = $new_order->id;
    	$new_future->area_id = Request::input('area_id');
//     	$area = DB::table('areas')->where('areaId',Request::input('region'))->first();
    	$new_future->area = Request::input('region');
    	$new_future->city_id = Request::input('city_id');
//     	$city = DB::table('areas')->where('areaId',Request::input('city'))->first();
    	$new_future->city = Request::input('city');
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
    	
    	$order = $orderInfo['order'];
    	if(!$order) $order = array();
    	$futures = $orderInfo['future'];
    	if(!$futures) $futures = array();
    	
    	$seller_db = App\Seller::query();
    	//查询所有供应商
    	$suppliers = $seller_db->where('user_id','<>',$user_id)->get();

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
    	
//     	print_r($futures);die;
    	return view('shop.futures.publish2',['areas'=>$areas,'order'=>$order,'futures'=>$futures,'suppliers'=>$suppliers],$parameter);
//     	return view('shop.futures.publish2');
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
    	$new_future->area_id = Request::input('area_id');
//     	$area = DB::table('areas')->where('areaId',Request::input('region'))->first();
    	$new_future->area = Request::input('region');
    	$new_future->city_id = Request::input('city_id');
//     	$city = DB::table('areas')->where('areaId',Request::input('city'))->first();
    	$new_future->city = Request::input('city');
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
    	$new_order->order_sn = "F".time().(1000+$user_id).rand_len_int();
    	$new_order->linkman = Request::input('name');
    	$new_order->mobile = Request::input('tel');
    	$new_order->address = Request::input('addr');
    	$new_order->zip_code = Request::input('code');
    	$new_order->detail = Request::input('detail');
    	$new_order->receive_type = Request::input('way');
    	$new_order->send_type = Request::input('tsway');
    	$sellers = Request::input('sellers');
    	/*if($new_order->send_type==2&&$sellers){
    		$ids = explode('|', $sellers);
    		foreach ($ids as $key=>$val){
    			$new_notify = new App\Notification();
    			$new_notify->user_id = $val;
    			$new_notify->from_id = $user_id;
    			$new_notify->message = "发布新的期货需求";
    			$new_notify->save();
    		}
    	}elseif($new_order->send_type==1){
    		//$sellers = 
    	}*/
    	
//     	$new_order->status = -1;
    	$order_res = $new_order->save();
    	foreach ($futures as $item){
    		$new_future = new App\OrderFutures();
    		$new_future->order_id = $new_order->id;
    		$new_future->area = $item->area;
    		$new_future->area_id = $item->area_id;
    		$new_future->city = $item->city;
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
    protected function signContract($order_id){
    	$order_db = App\Order::query();
    	$order = $order_db->where('id',$order_id)->first();
    	$user_db = App\User::query();
    	$user = $user_db->where('id',$order->user_id)->first();
    	
    	$contract_db = App\Contract::query();
    	$contract = $contract_db->where('order_id',$order_id)->first();
    	$contract_sn = sprintf('GT-%d-C%d%d', date('Y'), date('mdHis'), rand_len_int());
    	return view('shop.futures.signcontract',['contract'=>$contract,'order'=>$order,'contract_sn'=>$contract_sn,'user'=>$user]);
    }
    
    /**
     * 支付订单
     */
    protected function payOrder($order_id){
    	$order_db = App\Order::query();
    	$order  = $order_db->where('id',$order_id)->first();
    	return view('shop.futures.payOrder',['order'=>$order]);
    }
    
    /**
     * 生产
     */
    protected function produce($order_id){
    	$order_db = App\Order::query();
    	$order  = $order_db->where('id',$order_id)->first();
    	return view('shop.futures.produce',['order'=>$order]);
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

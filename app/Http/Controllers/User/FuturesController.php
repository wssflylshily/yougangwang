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
use DB;

class FuturesController extends Controller
{
// 	protected $user_id = 1;
// 	protected $seller_id = 2;

    public function __construct()
    {
//        $this->middleware('guest', ['except' => 'getLogo   ut']);
    }

	protected function delFut()
	{
		$deleteid = Request::all();
//		$deleteid = Request::input('delete_id');
//		dd($deleteid);
		$order_db = App\Order::query();
		$ok = $order_db->where('id',$deleteid)->delete();
		if($ok){
			exit('1');
		}else{
			exit('-1');
		}

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
    	$orderlist = $order_db->where('type',2)->where('user_id',$user_id)->orderby('id','desc')->paginate(15);
        
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
    	if($status==3){
    		return redirect(route('shop.futures.produce',['order_id'=>$get_order->id]));
    	}elseif($status==4){
    		return redirect(route('shop.futures.produce',['order_id'=>$get_order->id]));
    		//return redirect(route('shop.futures.payOrder',['order_id'=>$get_order->id]));
    	}else{
    		return redirect(route('user.futures'));
    	}
    }
    
    /**
     * 填写发票信息页面
     */
    protected function invoice($order_id){
    	$order_db = App\Order::query();
    	$order = $order_db->where('id',$order_id)->first();
    	
    	return view('user.futures.invoice',['order'=>$order,'result'=>""]);
    }
    
    /**
     * 提交发票信息
     */
    protected function postInvoice(){
    	$order_id = Request::input('order_id');
    	$db_orders = App\Order::query();
    	$order =$db_orders
    	->where('id',$order_id)
    	->first();
    	
    	$validator = Validator::make(Request::all(), [
    			'order_id'    => 'required',
    			'invoice_type'    => 'required',
    			'name' => 'required',
    			'shbh' => 'required',
    			'address' => 'required',
    			'tel' => 'required',
    			'bank' => 'required',
    			'bank_num' => 'required',
    			'send_address' => 'required',
    			], [
    			'order_id.required'   => '提交失败!',
    			'invoice_type.required'   => '发票类型不能为空!',
    			'name.required'      => '名称不能为空!',
    			'shbh.required'     => '纳税人识别号不能为空!',
    			'address.required'     => '地址不能为空!',
    			'tel.required' => '电话不能为空!',
    			'bank.required' => '开户行不能为空!',
    			'bank_num.required' => '银行账号不能为空!',
    			'send_address.required' => '发票邮寄地址不能为空!',
    			]);
    	
    	if ($validator->fails()) {
    		return view('user.futures.invoice',['order' => $order, 'result' => $validator->messages()->first()]);
    	}
    	
    	$order = $db_orders->where('id', $order_id)->update([
    			'invoice_type' => Request::input('invoice_type'),
    			'invoice_name' => Request::input('name'),
    			'invoice_no' => Request::input('shbh'),
    			'invoice_address' => Request::input('address'),
    			'invoice_tel' => Request::input('tel'),
    			'invoice_bank' => Request::input('bank'),
    			'invoice_bank_num' => Request::input('bank_num'),
    			'invoice_send_address' => Request::input('send_address'),
    			'status' => 8,
    			]);
    	/*$order->invoice_type = Request::input('invoice_type');
    	$order->invoice_name = Request::input('name');
    	$order->invoice_no = Request::input('shbh');
    	$order->invoice_address = Request::input('address');
    	$order->invoice_tel = Request::input('tel');
    	$order->invoice_bank = Request::input('bank');
    	$order->invoice_bank_num = Request::input('bank_num');
    	$order->invoice_send_address = Request::input('send_address');
    	$order->status = 8;
    	$order->save();*/
    	//$this->changeOrderStatus(Request::input('order_sn'),8);
    	return redirect(route('user.futures'));
    	
    }

    /**
     * 商家接单
     */
    protected function takeOrder(){
//     	$userid = Auth::user()->id;
        $order_db = App\Order::query();
        $get_order = $order_db->where('order_sn',Request::input('order_sn'))->first();
        $areas = DB::table('areas')->where('parentId',0)->get();
        
        $time = strtotime($get_order->created_at);
        $jiange = 60*60*24*15;
        $endtime = $time+60*60*24*15;
        $day = round(($endtime-time())/(60*60*24));
//         var_dump($get_order->created_at);
//         print_r(date('Y-m-d H:i:s',$endtime));die;
        
        /*$offer_db = App\FutureOffers::query();
        $sellerids = $offer_db
        			->where('order_id',$get_order->id)
        			->groupBy('seller_id')
        			->lists('seller_id');
        $seller_db = App\Seller::query();
        $sellers = $seller_db->whereIn('id',$sellerids)->get();*/
        
        $offers = DB::table('future_offers')
        		->where('order_id',$get_order->id)
        		->groupBy('seller_id')
        		->get();//lists('seller_id','id');
// 		print_r($offers);die;
		
        foreach ($offers as $offer){
        	$seller_db = App\Seller::query();
        	$offer->seller = $seller_db->where('id',$offer->seller_id)->first();
        	$offer_db = App\FutureOffers::query();
        	$offer->detail = $offer_db
			        	->leftJoin('order_futures','order_futures.id','=','future_offers.future_id')
			        	->where('future_offers.order_id',$get_order->id)
        				->where('future_offers.seller_id',$offer->seller_id)->get();
        	
        }
//         print_r($offers);die;
        
        return view('user.futures.takeorder',['order'=>$get_order,'areas'=>$areas,'offers'=>$offers,'stime'=>$time,'etime'=>$endtime,'days'=>$day]);
    }
    
    /**
     * 选择商家
     */
    protected function selectSeller(){
    	$response = [
    	'result'    => true,
    	'message'   => '已选择商家，正在跳往签订合同页进行后续操作',
    	];
    	$order_id = Request::input('order_id');
    	$seller_id = Request::input('seller_id');
    	try {
    		$order_db = App\Order::query();
    		$get_order = $order_db->where('id',$order_id)->first();
    		$get_order->seller_id = $seller_id;
    		$get_order->status = -1;
    		$get_order->save();
    		$offer_db = App\FutureOffers::query();
    		$offers = $offer_db
    				->where('seller_id',$seller_id)
    				->where('order_id',$order_id)
    				->get();
    		foreach ($offers as $offer){
    			$future_db = App\OrderFutures::query();
    			$future = $future_db->where('id',$offer->future_id)->first();
    			$future->offer_id = $offer->id;
    			$future->save();
    		}
    		/*$new_contract = new App\Contract();
    		$new_contract->order_id = $order_id;
    		$new_contract->contract_sn = sprintf('GT-%d-C%d%d', date('Y'), date('mdHis'), rand_len_int());
    		$new_contract->supplier_id = $seller_id;
    		$new_contract->demander_id = Auth::user()->id;
    		$new_contract->save();*/
    		
    	}catch (Exception $e){
    		$response['result']  = false;
    		$response['message'] = $e->getMessage();
    		$response['trace'] = $e->getTrace();
    	}
    	return $response;
    }
    
    /**
     * 发起、确认合同
     */
    protected function postContract(){
    	$userid = Auth::user()->id;
    	$orderid = Request::input('order_id');
    	$order_db = App\Order::query();
    	$order = $order_db->where('id',$orderid)->first();
    	$contract_db = App\Contract::query();
    	$contract = $contract_db->where('order_id',$orderid)->first();
    	if(!$contract){
    		$contract = new App\Contract();
    		$contract->contract_sn = Request::input('contract_sn');
	    	$contract->supplier_id = $order->seller_id;
	    	$contract->demander_id = $order->user_id;
	    	$contract->order_id = $orderid;
    		$contract->save();
    		$new_notify = new App\Notification();
    		$new_notify->user_id = $order->seller_id;
    		$new_notify->from_id = $order->user_id;
    		$new_notify->message = "已发起合同";
    		$new_notify->save();
    		if($userid==$order->user_id){
    			return redirect(route('user.futures'));
    		}else{
    			return redirect(route('seller.futures.orders'));
    		}
    	}
    	if ($contract->status==1){
    		$contract->status = 2;
	    	$contract->promise_price = Request::input('promise_price');
	    	$contract->freight_price = Request::input('freight_price');
	    	$contract->processing_price = Request::input('processing_price');
	    	$contract->shangai_price = Request::input('shangai_price');
	    	$contract->price_amount = Request::input('price_amount');
	    	$contract->price_amount_fanti = Request::input('price_amount_fanti');
	    	$contract->deadline = Request::input('deadline');
	    	$contract->overdue_daily_penalty = Request::input('overdue_daily_penalty');
	    	$contract->other_assumpsit = Request::input('other_assumpsit');
	    	$contract->supplier_agent = Request::input('supplier_agent');
	    	$contract->from_address = Request::input('from_address');
    		$contract->save();
    		$new_notify = new App\Notification();
    		$new_notify->user_id = $order->user_id;
    		$new_notify->from_id = $order->seller_id;
    		$new_notify->message = "已同意您的合同条款";
    		$new_notify->save();
    		
    		if($userid==$order->user_id){
    			return redirect(route('user.futures'));
    		}else{
    			return redirect(route('seller.futures.orders'));
    		}
    	}
    	if($contract->status==2){
    		$contract->status = 3;
	    	$contract->demander_agent = Request::input('demander_agent');
	    	$contract->save();
            $order_db->order_amount = Request::input('price_amount');
            $order_db->postsge = Request::input('freight_price');
            $order_db->status = 2;
            $order_db->save();
	    	
	    	if($userid==$order->user_id){
	    		return redirect(route('shop.futures.payOrder',['order_id'=>$order->id]));
	    	}else{
	    		return redirect(route('seller.futures.orders'));
	    	}
    	}
    	
    }

    /**
     * 支付
     * 孙璠
     * 2017.4.19
     */
    protected function toPay()
    {
        require_once(public_path('ebusclient').'/PaymentRequest.php');

        $tRequest = new \PaymentRequest();

        $money = Request::input('money');   //要支付的钱
        $order_sn = Request::input('order_sn'); //订单编号

        //订单信息
        if (Request::input('postsge'))
        {
            $postsge = Request::input('postsge'); //运费
            $order = App\Order::query()->where('order_sn',$order_sn)->update(['postsge'=>$postsge]);
        }else{
            $order_sn .= "a";
        }

        $order_info = App\Order::query()->where('order_sn',$order_sn)->first();

        $tRequest->order["PayTypeID"] = "ImmediatePay"; //设定交易类型//ImmediatePay：直接支付PreAuthPay：预授权支付 DividedPay：分期支付
        $tRequest->order["OrderNo"] = $order_sn; //设定订单编号
        $tRequest->order["OrderAmount"] = $money; //设定交易金额
        $tRequest->order["CurrencyCode"] = "156"; //设定交易币种
        $tRequest->order["InstallmentMark"] = "0"; //分期标识
        $tRequest->order["BuyIP"] = $_SERVER['SERVER_NAME']; //IP
        $tRequest->order["OrderDate"] = date('Y/m/d'); //设定订单日期 （必要信息 - YYYY/MM/DD）
        $tRequest->order["OrderTime"] = date('H:i:s'); //设定订单时间 （必要信息 - HH:MM:SS）
        $tRequest->order["CommodityType"] = "0201"; //设置商品种类

//2、订单明细
//        $order_goods = App\OrderFutures::query()->where('order_id', $order_info->id)->get();

//        foreach ($order_goods as $k=>$val)
//        {
            $orderitem = array ();
            $orderitem["SubMerName"] = ""; //设定二级商户名称
            $orderitem["SubMerId"] = ""; //设定二级商户代码
            $orderitem["SubMerMCC"] = "0000"; //设定二级商户MCC码
            $orderitem["SubMerchantRemarks"] = ""; //二级商户备注项
            $orderitem["ProductID"] = ""; //商品代码，预留字段
            $orderitem["ProductName"] = "期货"; //商品名称
            $orderitem["UnitPrice"] = ""; //商品总价
            $orderitem["Qty"] = ""; //商品数量
            $orderitem["ProductRemarks"] = ""; //商品备注项
            $orderitem["ProductType"] = "消费类"; //商品类型
            $orderitem["ProductDiscount"] = "1"; //商品折扣
            $orderitem["ProductExpiredDate"] = "10"; //商品有效期
            $tRequest->orderitems[0] = $orderitem;
//        }


//3、生成支付请求对象
        $tRequest->request["PaymentType"] = "1"; //设定支付类型
        $tRequest->request["PaymentLinkType"] = "1"; //设定支付接入方式
        $tRequest->request["ReceiveAccount"] = "02111101040007009"; //设定收款方账号
        $tRequest->request["ReceiveAccName"] = "天津优钢信息技术有限公司"; //设定收款方户名
        $tRequest->request["NotifyType"] = "1"; //设定通知方式
        $tRequest->request["ResultNotifyURL"] = "http://www.usteel.cn/user/pay/return"; //设定通知URL地址
        $tRequest->request["IsBreakAccount"] = "0"; //设定交易是否分账

        $tResponse = $tRequest->postRequest();
//支持多商户配置
//$tResponse = $tRequest->extendPostRequest(2);

        if ($tResponse->isSuccess()) {
//            print ("<br>Success!!!" . "</br>");
//            print ("ReturnCode   = [" . $tResponse->getReturnCode() . "]</br>");
//            print ("ReturnMsg   = [" . $tResponse->getErrorMessage() . "]</br>");
            $PaymentURL = $tResponse->GetValue("PaymentURL");
//            print ("<br>PaymentURL=$PaymentURL" . "</br>");
            echo "<script language='javascript'>";
            echo "window.location.href='$PaymentURL'";
            echo "</script>";
        } else {
//            print ("<br>Failed!!!" . "</br>");
//            print ("ReturnCode   = [" . $tResponse->getReturnCode() . "]</br>");
//            print ("ReturnMsg   = [" . $tResponse->getErrorMessage() . "]</br>");
            echo "<script language='javascript'>";
            echo "alert('" . $tResponse->getErrorMessage() . "');";
            echo "location.href=document.referrer;";
            echo "</script>";
        }
    }

    //支付回调
    protected function payReturn()
    {
        require_once (public_path('ebusclient').'/Result.php');
        //1、取得MSG参数，并利用此参数值生成验证结果对象
//        dd($_POST);
        $tResult = new \Result();
        $tResponse = $tResult->init($_POST['MSG']);

        if ($tResponse->isSuccess()) {
            if (substr($tResponse->getValue("OrderNo"), 0, -1) == "a"){
                $order_sn = substr($tResponse->getValue("OrderNo"), -1);
            }else{
                $order_sn = $tResponse->getValue("OrderNo");
            }
            DB::table('money_log')->insert([
                'OrderNo' => $order_sn,
                'Amount' => $tResponse->getValue("Amount"),
                'BatchNo' => $tResponse->getValue("BatchNo"),
                'VoucherNo' => $tResponse->getValue("VoucherNo"),
                'HostDate' => $tResponse->getValue("HostDate"),
                'HostTime' => $tResponse->getValue("HostTime"),
                'MerchantRemarks' => $tResponse->getValue("MerchantRemarks"),
                'PayType' => $tResponse->getValue("PayType"),
                'NotifyType' => $tResponse->getValue("NotifyType"),
                'iRspRef' => $tResponse->getValue("iRspRef"),
            ]);
            //2、、支付成功
            $order = App\Order::query()->where('order_sn',$order_sn)->first();
            if ($order->status == 2){
                App\Order::query()->where('order_sn', $order_sn)->update(['status' => 3, 'paid_amount' => $tResponse->getValue("Amount")]);
            }elseif ($order->status == 3){
                App\Order::query()->where('order_sn', $order_sn)->update(['status' => 4, 'paid_amount' => $tResponse->getValue("Amount")]);
            }


            //tMerchantPage = "http://172.30.7.117/demo/CustomerPage.aspx?请传入必要的参数"  如下：
//            $tMerchantPage = "http://www.usteel.cn/user/pay/success?OrderNo=" . $tResponse->getValue("OrderNo");
            return redirect(route('user.futures'));

        } else {
            //3、失败
            //tMerchantPage = "http://172.30.7.117/demo/MerchantFailure.aspx?请传入必要的参数" 如下：
//            $tMerchantPage = "http://www.usteel.cn/demo/MerchantFailure?OrderNo=" . $tResponse->getValue("OrderNo");
            //$tMerchantPage = "http://www.usteel.cn/user/pay/fail?OrderNo=" . $tResponse->getValue("OrderNo");
            throw new Exception('支付失败，请联系管理员');
        }
//        print ("<html><head><meta http-equiv=\"refresh\" content=\"0; url='<%= tMerchantPage %>'\"></head></html>");
    }
    
    /**
     * 用户去评价
     */
    protected function completion($order_id){
    	$db = App\CommentOptions::query();
    	$comment_options = $db->where('status', 1)->get();
    	
    	$order_db = App\Order::query();
    	$order = $order_db->where('id',$order_id)->first();
    	$db_comment = App\Comments::query();
    	$comment = $db_comment->where('order_id', $order->id)->first();
    	
    	return view('user.futures.completion',['order'=>$order,'options'=>$comment_options, 'comment' => $comment]);
    }
    
    /**
     * 提交评价信息
     */
    protected function postCompletion(){
    	
    }
   
    

}

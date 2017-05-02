<?php

/**
 * HomeController constructor.
 * 个人中心--现货
 * 孙璠
 * 2016.12.21
 */

namespace App\Http\Controllers\User;

use App;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Request;
use Validator;
use Session;
use App\Http\Controllers\Common\SendMessage;
use DB;

class StocksController extends Controller
{

    public function __construct()
    {
//        $this->middleware('guest', ['except' => 'getLogo   ut']);
    }


    /**
     * 我的现货
     * 孙璠
     */
    protected function getStocks()
    {
        $db_orders = App\Order::query();
        if (Request::input('type') != null)
        {
            $db_orders->where('status' , Request::input('type'));
        }
        $orders =$db_orders
            ->where('user_id', Auth::user()->id)
            ->where('type',1)
            ->orderBy('created_at', 'desc')
            ->with('goods')
            ->with('seller')
            ->paginate(8);
       // dd($orders);
        return view('user.stocks.stocks',['order_goods' => $orders]);
    }
    
    /**
     * 现货 历史
     * 孙璠
     */
    protected function getStocksHistory()
    {
        $db_orders = App\Order::query();
        if (Request::input('type') != null)
        {
            $db_orders->where('status' , Request::input('type'));
        }
        $orders =$db_orders
            ->where('user_id', Auth::user()->id)
            ->where('type',1)
            ->orderBy('created_at', 'desc')
            ->with('goods')
            ->with('seller')
            ->paginate(8);
        return view('user.stocks.stocks_history',['order_goods' => $orders]);
    }

    //孙璠 2016.12.26  支付详情页
    protected function toPay()
    {
        //$this->changeOrderStatus(Request::input('order_sn'),4);
        $db_orders = App\Order::query();
        $order =$db_orders
            ->where('order_sn',Request::input('order_sn'))
            ->with('goods')
            ->with('seller')
            ->first();
        $order['total'] = $order['order_amount'] + $order['postsge'];
        return view('user.stocks.topay',['order' => $order]);
    }

    //孙璠 2016.12.27  物流详情页
    protected function getLogistic()
    {
        $db_orders = App\Order::query();
        $order =$db_orders
            ->where('order_sn',Request::input('order_sn'))
            ->with('goods')
            ->with('seller')
            ->first();

        $db_logistic = App\Logistics::query();
        $logistic = $db_logistic->where('order_id', $order->id)->orderBy('created_at', 'desc')->get();
        return view('user.stocks.logistic',['order' => $order, 'logistic' => $logistic]);
    }

    //孙璠  2016.12.27  确认收货
    protected function toReceipt()
    {
        $db_orders = App\Order::query();
        $order =$db_orders
            ->where('order_sn',Request::input('order_sn'))
            ->with('goods')
            ->with('seller')
            ->first();
        return view('user.stocks.confirm_receipt',['order' => $order]);
    }

    /**
     * 开发票
     * 孙璠
     * 2016.12.29
     */
    protected function getInvoice()
    {
        //$this->changeOrderStatus(Request::input('order_sn'),8);
        $db_orders = App\Order::query();
        $order =$db_orders
            ->where('order_sn',Request::input('order_sn'))
            ->with('goods')
            ->with('seller')
            ->first();
        return view('user.stocks.invoice', ['order' => $order, 'result' => '']);
    }

    /**
     * 开发票----表单提交
     * 孙璠
     * 2016.12.29
     */
    protected function postInvoice()
    {
        $db_orders = App\Order::query();
        $order =$db_orders
            ->where('id',Request::input('id'))
            ->with('goods')
            ->with('seller')
            ->first();

        $validator = Validator::make(Request::all(), [
            'id'    => 'required',
            'invoice_type'    => 'required',
            'name' => 'required',
            'shbh' => 'required',
            'address' => 'required',
            'tel' => 'required',
            'bank' => 'required',
            'bank_num' => 'required',
            'send_address' => 'required',
        ], [
            'id.required'   => '提交失败!',
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
            return view('user.stocks.invoice',['order' => $order, 'result' => $validator->messages()->first()]);
        }

        $order = $db_orders->where('id', Request::input('id'))->update([
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
        //$this->changeOrderStatus(Request::input('order_sn'),8);
        return redirect(route('user.home'));
    }

    /**
     * 修改订单状态
     * 孙璠
     * 2016.12.29
     */
    protected function changeOrderStatus($order_sn,$status)
    {
        $db = App\Order::query();
        if ($order_sn && $status)
        {
            $db->where('order_sn', $order_sn)->update(['status' => $status]);
        }
    }

    /**
     * 修改订单状态-----临时
     * 孙璠
     * 2016.12.29
     */
    protected function changeStatus()
    {
        $db = App\Order::query();
        if (Request::input('order_sn') && Request::input('status'))
        {
            $db->where('order_sn', Request::input('order_sn'))->update(['status' => Request::input('status')]);
        }
        return redirect(route('user.home'));
    }

    /**
     * 签合同
     * 孙璠
     * 2016.12.30
     */
    protected function signContract()
    {
        $response = [];

        $response['order'] =App\Order::where('order_sn', Request::input('order_sn'))
            ->join('order_goods', 'order_goods.order_id', '=', 'orders.id')
            ->join('goods', 'order_goods.goods_id', '=', 'goods.id')
            //->join('LEFT JOIN gt_order_good ON gt_order_good.order_id=gt_order.id')
            //->join('LEFT JOIN gt_good ON gt_order_good.goods_id=gt_good.id')
                                     ->with('goods')
                                     ->with('user')
                                     ->with('seller')
                                    ->select('*', 'orders.id as id')
                                     ->first();

        // 生成合同编号
//        dd($response);
        if (!$response['order']->contract) {
            $response['contract_sn'] = sprintf('GT-%d-C%d%d', date('Y'), date('mdHis'), rand_len_int());
            Session::set('contract_sn', $response['contract_sn']);
            Session::set('order_id', $response['order']->order_id);
        } else {
            if ($response['order']->contract->status == 3) {
                abort(500, '非法操作');
            }

            $response['contract_sn'] = $response['order']->contract->contract_sn;
//            if ($response['order']->contract->status == 2) {
//                $response['allow'] = 'user';
//            }
//
//            if ($response['order']->contract->status == 1) {
//                $response['allow'] = 'seller';
//            }
        }
//        dd($response);

        Session::set('contract_sn', $response['contract_sn']);
        Session::set('order_id', $response['order']->order_id);

        return view('user.stocks.sign_contract', $response);
    }

    protected function postSignContract()
    {
//        dd(Session::remove('order_id'));
        $order =App\Order::find(Session::remove('order_id'));
//         $order = App\Order::find(Request::input('order_id'));
        // 生成合同
        if (!$order->contract) {
            $new_contract = new App\Contract();
            $new_contract->status = 1;
            $new_contract->order_id     = $order->id;
            $new_contract->contract_sn  = Session::remove('contract_sn');
//            $new_contract->contract_sn  = Request::input('contract_sn');
            $new_contract->supplier_id  = $order->seller_id;
            $new_contract->demander_id  = $order->user_id;
            $new_contract->other_assumpsit  = Request::input('other_assumpsit');
            $new_contract->demander_agent   = Request::input('demander_agent');
            $new_contract->sign_time   = time();

            $new_contract->save();
            return redirect(route('user.home'));
        } else {
            if ($order->contract->status == 3) {
                abort(500, '非法操作');
            }

            if ($order->contract->status == 2) {

                $order->contract->status = 3;
                $order->contract->other_assumpsit = Request::input('other_assumpsit');
                $order->contract->demander_agent = Request::input('demander_agent');
                if ($order->pay_type == 2){
                    $order->status = 4;
                }else{
                    $order->status = 1;
                }

                $order->contract->save();
                $order->save();

                return redirect(route('user.home'));
            }

            if ($order->contract->status == 1) {
//                dd(Request::all());
                //商家签合同
                $order->contract->status = 2;
                $order->contract->sign_address = Request::input('sign_address');
                $order->contract->sign_time = time();
                $order->contract->freight_price = Request::input('freight_price');
                $order->contract->fangfu_price = Request::input('fangfu_price');
                $order->contract->processing_price = Request::input('processing_price');
                $order->contract->price_amount = Request::input('price_amount');
                $order->contract->price_amount_fanti = Request::input('price_amount_fanti');
                $order->contract->promise_price = Request::input('promise_price');
                $order->contract->shangai_price = Request::input('shangai_price');
                $order->contract->other_assumpsit = Request::input('other_assumpsit');
                $order->contract->supplier_agent = Request::input('supplier_agent');

                //将附加的图片存起来
                if (Request::input('pic_url'))foreach (Request::input('pic_url') as $k=>$v)
                {
                    $new_contract_pic = new App\ContractPic();
                    $new_contract_pic->contract_id = $order->contract->id;
                    $new_contract_pic->pic_url = $v;
                    $new_contract_pic->save();
                }

                //增加一条给买家的消息
                $new_notification = new App\Notification();
                $new_notification->user_id = Request::input('user_id');
                $new_notification->from_id = Request::input('seller_id');
                $new_notification->message = "已同意您的合同条款";

                $order->contract->save();
                $new_notification->save();

                return redirect(route('seller.stocks.orders'));
            }
        }
    }

    /**
     * 评价
     * 孙璠
     * 2016.12.30
     */
    protected function toCompletion()
    {
        //$this->changeOrderStatus(Request::input('order_sn'),99);
        //评论选项
        $db = App\CommentOptions::query();
        $comment_options = $db->where('status', 1)->get();

        //订单信息
        $db_orders = App\Order::query();
        $order =$db_orders
            ->where('order_sn',Request::input('order_sn'))
            ->with('goods')
            ->with('seller')
            ->first();

        $db_comment = App\Comments::query();
        $comment = $db_comment->where('order_id', $order->id)->first();
        return view('user.stocks.completion', ['options' => $comment_options, 'order' => $order, 'comment' => $comment]);
    }

    /**
     * 评价表单提交
     */
    protected function toComment()
    {
        $options = json_encode(Request::input('options'));
        $db = new App\Comments();

        $db_order = App\Order::query();
        $db->user_id = Auth::user()->id;
        $db->order_id = Request::input('order_id');
        $db->star = Request::input('star');
        $db->options = $options;
        $db->message = Request::input('message');
        if ($db->save())
        {
            $response = [
                'result'    => true,
                'message'   => '评论成功，正在跳转',
            ];

            $db_order->where('id', Request::input('order_id'))->update(['status' => 99]);

            //修改卖家信誉
            $db_seller = App\Seller::query();

            $order = App\Order::query()->where('id', Request::input('order_id'))->first();
            $seller = $db_seller->where('id', $order->seller_id)->first();
            $new_star = ((int)($seller->credit_degree) + (int)(Request::input('star')))/2;
            App\Seller::query()->where('id', $order->seller_id)->update(['credit_degree' => $new_star]);
        }else{
            $response = [
                'result'    => false,
                'message'   => '评论失败',
            ];
        }
        return $response;
    }

    protected function payTest()
    {
        require_once(public_path('ebusclient').'/PaymentRequest.php');

        $tRequest = new \PaymentRequest();

        //订单信息
        $order = App\Order::query()->where('order_sn',Request::input('order_sn'))->first();
        $total = $order['order_amount'] * 1.05 + $order['postsge'];

        $tRequest->order["PayTypeID"] = "ImmediatePay"; //设定交易类型//ImmediatePay：直接支付PreAuthPay：预授权支付 DividedPay：分期支付
        $tRequest->order["OrderNo"] = Request::input('order_sn'); //设定订单编号
        $tRequest->order["OrderAmount"] = $total; //设定交易金额
        $tRequest->order["CurrencyCode"] = "156"; //设定交易币种
        $tRequest->order["InstallmentMark"] = "0"; //分期标识
        $tRequest->order["BuyIP"] = $_SERVER['SERVER_NAME']; //IP
        $tRequest->order["OrderDate"] = date('Y/m/d'); //设定订单日期 （必要信息 - YYYY/MM/DD）
        $tRequest->order["OrderTime"] = date('H:i:s'); //设定订单时间 （必要信息 - HH:MM:SS）
        $tRequest->order["CommodityType"] = "0201"; //设置商品种类

//2、订单明细
        $order_goods = App\OrderGoods::query()->where('order_id', $order->id)->get();

        foreach ($order_goods as $k=>$val)
        {
            $orderitem = array ();
            $orderitem["SubMerName"] = $order->seller->name; //设定二级商户名称
            $orderitem["SubMerId"] = $order->seller->id; //设定二级商户代码
            $orderitem["SubMerMCC"] = "0000"; //设定二级商户MCC码
            $orderitem["SubMerchantRemarks"] = ""; //二级商户备注项
            $orderitem["ProductID"] = $val->goods_id; //商品代码，预留字段
            $orderitem["ProductName"] = $val->bak_variety; //商品名称
            $orderitem["UnitPrice"] = $val->buy_price; //商品总价
            $orderitem["Qty"] = $val->buy_count; //商品数量
            $orderitem["ProductRemarks"] = ""; //商品备注项
            $orderitem["ProductType"] = "消费类"; //商品类型
            $orderitem["ProductDiscount"] = "1"; //商品折扣
            $orderitem["ProductExpiredDate"] = "10"; //商品有效期
            $tRequest->orderitems[$k] = $orderitem;
        }


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
            DB::table('money_log')->insert([
                'OrderNo' => $tResponse->getValue("OrderNo"),
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
            App\Order::query()->where('order_sn', $tResponse->getValue("OrderNo"))->update(['status' => 4, 'paid_amount' => $tResponse->getValue("Amount")]);

            //tMerchantPage = "http://172.30.7.117/demo/CustomerPage.aspx?请传入必要的参数"  如下：
//            $tMerchantPage = "http://www.usteel.cn/user/pay/success?OrderNo=" . $tResponse->getValue("OrderNo");
            return redirect(route('user.stocks'));

        } else {
            //3、失败
            //tMerchantPage = "http://172.30.7.117/demo/MerchantFailure.aspx?请传入必要的参数" 如下：
//            $tMerchantPage = "http://www.usteel.cn/demo/MerchantFailure?OrderNo=" . $tResponse->getValue("OrderNo");
            //$tMerchantPage = "http://www.usteel.cn/user/pay/fail?OrderNo=" . $tResponse->getValue("OrderNo");
            throw new Exception('支付失败，请联系管理员');
        }
//        print ("<html><head><meta http-equiv=\"refresh\" content=\"0; url='<%= tMerchantPage %>'\"></head></html>");
    }

    //支付成功页面
    protected function ResultSuccess()
    {
        print ("<html><body>成功！</body></html>");
    }

    //支付失败页面
    protected function ResultFail()
    {
        print ("<html><body>失败！</body></html>");
    }

    /**
     * 签合同
     * 孙璠
     * 2016.12.30
     */
    protected function getContractPdf()
    {
        $response = [];

        $response['order'] =App\Order::where('order_sn', Request::input('order_sn'))
            ->join('order_goods', 'order_goods.order_id', '=', 'orders.id')
            ->join('goods', 'order_goods.goods_id', '=', 'goods.id')
            //->join('LEFT JOIN gt_order_good ON gt_order_good.order_id=gt_order.id')
            //->join('LEFT JOIN gt_good ON gt_order_good.goods_id=gt_good.id')
            ->with('goods')
            ->with('user')
            ->with('seller')
            ->first();

        // 生成合同编号
        if (!$response['order']->contract) {
            $response['contract_sn'] = sprintf('GT-%d-C%d%d', date('Y'), date('mdHis'), rand_len_int());
            Session::set('contract_sn', $response['contract_sn']);
            Session::set('order_id', $response['order']->id);
        } else {
            if ($response['order']->contract->status == 3) {
                abort(500, '非法操作');
            }

            $response['contract_sn'] = $response['order']->contract->contract_sn;
//            if ($response['order']->contract->status == 2) {
//                $response['allow'] = 'user';
//            }
//
//            if ($response['order']->contract->status == 1) {
//                $response['allow'] = 'seller';
//            }
        }

        Session::set('contract_sn', $response['contract_sn']);
        Session::set('order_id', $response['order']->id);

        return view('user.stocks.contractPdf', $response);
    }

    protected function getPDF()
    {
        $name = Request::input('order_sn');
        $url = "http://".$_SERVER['HTTP_HOST']."/user/stocks/contractpdf?order_sn=".$name;
        $cmd = 'wkhtmltopdf '.$url.' /home/wwwroot/usteel.cn/public/PDF/'.$name.'.pdf';
        exec($cmd);
        $this->downfile('./PDF/'.$name.'.pdf',$name);
    }

    protected function downfile($file,$name)
    {
        $filename=realpath($file); //文件名
        $date=$name;
        Header( "Content-type:  application/octet-stream ");
        Header( "Accept-Ranges:  bytes ");
        Header( "Accept-Length: " .filesize($filename));
        header( "Content-Disposition:  attachment;  filename= {$date}.pdf");
        echo file_get_contents($filename);
        readfile($filename);
        unlink ($file);
    }

    protected function sendSMS()
    {
        $instance = new SendMessage();
        $instance->run();
    }
}

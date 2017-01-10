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
        return view('user.stocks.pay',['order' => $order]);
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
        ]);
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

        return view('user.stocks.sign_contract', $response);
    }

    protected function postSignContract()
    {
        $order =App\Order::find(Session::remove('order_id'));

        // 生成合同
        if (!$order->contract) {
            $new_contract = new App\Contract();
            $new_contract->status = 1;
            $new_contract->order_id     = $order->id;
            $new_contract->contract_sn  = Session::remove('contract_sn');
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
                $order->status = 1;

                $order->contract->save();
                $order->save();

                return redirect(route('user.home'));
            }

            if ($order->contract->status == 1) {
                //商家签合同
                $order->contract->status = 2;

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
        }else{
            $response = [
                'result'    => false,
                'message'   => '评论失败',
            ];
        }
        return $response;
    }

}

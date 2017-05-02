<?php

/**
 * HomeController constructor.
 * 取消订单列表
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

class CancelOrderController extends Controller
{
    public function __construct()
    {
//        $this->middleware('guest', ['except' => 'getLogo   ut']);
    }


    //现货
    protected function getIndex()
    {
        $db_orders = App\Order::query();
        if (Request::input('type') != null)
        {
            $db_orders->where('status' , Request::input('type'));
        }
        $orders =$db_orders
            ->where('user_id', Auth::user()->id)
            ->where('status', '100')
            ->orderBy('created_at', 'desc')
            ->with('goods')
            ->with('seller')
            ->paginate(8);
        return view('user.cancel_order.stocks',['order_goods' => $orders]);

    }

    //期货
    protected function getFutures()
    {
        $db_orders = App\Order::query();
        if (Request::input('type') != null)
        {
            $db_orders->where('status' , Request::input('type'));
        }
        $orders =$db_orders
            ->where('user_id', Auth::user()->id)
            ->where('type',2)
            ->where('status', '100')
            ->orderBy('created_at', 'desc')
            ->with('goods')
            ->with('seller')
            ->paginate(8);
        return view('user.cancel_order.futures',['order_goods' => $orders]);

    }



}

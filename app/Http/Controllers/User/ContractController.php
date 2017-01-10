<?php

/**
 * HomeController constructor.
 * 个人中心---合同
 * 孙璠
 * 2016.12.21
 */

namespace App\Http\Controllers\User;

use App;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Request;
use Validator;

class ContractController extends Controller
{

    public function __construct()
    {
//        $this->middleware('guest', ['except' => 'getLogo   ut']);
    }

    /**
     * 我的合同
     */
    protected function getContract()
    {
        $db_orders = App\Order::query();
        /*$orders =$db_orders
            ->leftJoin('contracts', 'contracts.order_id', '=', 'orders.id')
            ->where('user_id', Auth::user()->id)
            ->where('orders.status', '-1')
            ->where('contracts.status', '0')
            ->orderBy('contracts.created_at', 'desc')
            ->select('contracts.*', 'orders.*', 'orders.created_at as create_time', 'contracts.status as cstate', 'orders.status as ostate')
            ->with('seller')
            ->paginate(8);*/
        $orders =$db_orders
            ->where('user_id', Auth::user()->id)
            ->where('orders.status', '-1')
            ->orderBy('created_at', 'desc')
            ->select('orders.*', 'created_at as create_time', 'status as ostate')
            ->with('seller')
            ->paginate(8);
        return view('user.contract.contract',['orders' => $orders]);
    }

    protected function getContractAlready()
    {
        /*$db_contract = App\Contract::query();
        $rs = $db_contract->where('status',3)->paginate(8);*/
        $db_orders = App\Order::query();
        if (Request::input('type') != null)
        {
            $db_orders->where('status' , Request::input('type'));
        }
        $orders =$db_orders
            ->leftJoin('contracts', 'contracts.order_id', '=', 'orders.id')
            ->where('user_id', Auth::user()->id)
            ->whereIn('orders.status', ['-1', '1'])
            ->whereIn('contracts.status', ['1', '2', '3'])
            ->orderBy('orders.created_at', 'desc')
            ->select('contracts.*', 'orders.*', 'contracts.updated_at as create_time', 'contracts.status as state', 'orders.status as ostate')
            ->with('seller')
            ->paginate(8);
        return view('user.contract.contract_already', ['orders' => $orders]);
    }

    /**
     * 合同历史
     */
    protected function getContractHistory()
    {
        return view('user.contract.contract_history');
    }

}

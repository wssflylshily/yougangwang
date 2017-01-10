<?php

namespace App\Http\Controllers\Seller;

use App;
use App\Http\Controllers\Controller;
use Request;
use Validator;
use \Illuminate\Support\Facades\Auth;


class HomeController extends Controller
{
    public function __construct()
    {
//        $this->middleware('guest', ['except' => 'getLogout']);
    }

    protected function getIndex()
    {
    	$seller_id = Auth::user()->id;
    	$seller_db = App\Seller::query();
    	$seller = $seller_db->where('user_id',$seller_id)->first();
//     	dd($seller);
//     	$user = App\User::query();
//     	$user_id = Auth::user()->id;
    	
//     	$users = $user->where('id', $user_id)->first();
        return view('seller.home.index',['seller'=>$seller]);
    }
    
    /**
     * 我的合同
     */
    protected function getMyContract(){
        $db_orders = App\Order::query();
        $orders =$db_orders
            ->leftJoin('contracts', 'contracts.order_id', '=', 'orders.id')
            ->where('seller_id', Auth::user()->id)
            ->where('orders.status', '-1')
            ->where('contracts.status', ['1'])
            ->orderBy('contracts.created_at', 'desc')
            ->select('contracts.*', 'orders.*', 'contracts.created_at as create_time', 'contracts.status as cstate', 'orders.status as ostate')
            ->with('seller')
            ->paginate(8);
    	return view('seller.home.contractList',['orders' => $orders]);
    }

    //已签约
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
            ->whereIn('contracts.status', [ '2', '3', '100'])
            ->orderBy('orders.created_at', 'desc')
            ->select('contracts.*', 'orders.*', 'contracts.updated_at as create_time', 'contracts.status as cstate', 'orders.status as ostate')
            ->with('seller')
            ->paginate(8);
        return view('seller.home.contract_already', ['orders' => $orders]);
    }
}

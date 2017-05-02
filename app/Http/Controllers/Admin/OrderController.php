<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Exception;
use Request;
use Validator;
use App;
use DB;

class OrderController extends Controller
{
    public function getIndex()
    {
        $query = App\Order::query();
        /*dd(Request());*/
        if (!empty(Request::query())){
            //订单搜索
            if (Request::input('search_ddh'))
            {
                $query->where('order_sn','like', '%'.Request::input('search_ddh').'%');
            }
            //状态搜索
            if (Request::input('search_zt'))
            {
                $query->where('status','like','%'.Request::input('search_zt').'%');
            }
            /*//物流号搜索
            if (Request::input('search_wlh'))
            {
                $query->where('material','like','%'.Request::input('search_wlh').'%');
            }*/
            //下单时间
            if (Request::input('search_datestart') &&!Request::input('search_dateend'))
            {
                $query->where('orders.created_at','>=', date('Y-m-d H:i:s',strtotime(Request::input('search_datestart'))));
            }
            if (!Request::input('search_datestart') && Request::input('search_dateend'))
            {
                $query->where('orders.created_at','<=', date('Y-m-d H:i:s',strtotime(Request::input('search_datestart'))));
            }
            if (Request::input('search_datestart') && Request::input('search_dateend'))
            {
                $query->whereBetween('orders.created_at',[date('Y-m-d H:i:s',strtotime(Request::input('search_datestart'))), date('Y-m-d H:i:s',strtotime(Request::input('search_dateend')))]);
            }

        }
        $orders['orders_list'] = $query->where('type',1)
            ->leftJoin('users', 'users.id', '=', 'orders.user_id')
            ->orderBy('orders.created_at', 'desc')
            ->paginate(10);
//         print_r($orders);die;
       
        /* return view('shop.stocks.index', ['goods' => $goods, 'provinces' => $area, 'cities' => $city]);*/
        return view('admin.orders.order_now', $orders);
        /*$result['user_list'] = \App\Order::withTrashed()->orderBy('id', 'desc')->paginate(20);
        return view('admin.orders.order_now', $result);*/
    }
    
    /**
     * 现货订单详情
     */
    public function getOrdernowdetail($id){
    	$order_db = App\Order::query();
    	$info = $order_db->where('id',$id)->first();
    	
    	return view('admin.orders.ordernowdetail',['order'=>$info]);
    }
    
    /**
     * 期货订单详情
     */
    public function getOrderfutdetail($id){
    	$order_db = App\Order::query();
    	$info = $order_db->where('id',$id)->first();
    	//print_r($info->futures);die;
    	return view('admin.orders.orderfuturedetail',['order'=>$info]);
    }

    public function getFuture()
    {
        $query = App\Order::query();
        /* dd($query);*/
        $city = "";
        if (!empty(Request::query())){
            //订单搜索
            if (Request::input('search_ddh'))
            {
                $query->where('order_sn','like', '%'.Request::input('search_ddh').'%');
            }
            //状态搜索
            if (Request::input('search_zt'))
            {
                $query->where('status','like','%'.Request::input('search_zt').'%');
            }
            /*//物流号搜索
            if (Request::input('search_wlh'))
            {
                $query->where('material','like','%'.Request::input('search_wlh').'%');
            }*/
            //下单时间
            if (Request::input('search_datestart') &&!Request::input('search_dateend'))
            {
                $query->where('orders.created_at','>=', date('Y-m-d H:i:s',strtotime(Request::input('search_datestart'))));
            }
            if (!Request::input('search_datestart') && Request::input('search_dateend'))
            {
                $query->where('orders.created_at','<=', date('Y-m-d H:i:s',strtotime(Request::input('search_datestart'))));
            }
            if (Request::input('search_datestart') && Request::input('search_dateend'))
            {
                $query->whereBetween('orders.created_at',[date('Y-m-d H:i:s',strtotime(Request::input('search_datestart'))), date('Y-m-d H:i:s',strtotime(Request::input('search_dateend')))]);
            }


        }
        $orders['orders_list'] = $query->where('type','2')
            ->leftJoin('users', 'users.id', '=', 'orders.user_id')
            ->leftJoin('future_offers','future_offers.order_id','=','orders.id')
            ->select('orders.*','users.name','future_offers.created_at as futime')
            ->orderBy('orders.created_at', 'desc')
            ->paginate(10);
        /*dd($goods);*/
        /* return view('shop.stocks.index', ['goods' => $goods, 'provinces' => $area, 'cities' => $city]);*/
        return view('admin.orders.order_future', $orders);
       /* $result['user_list'] = \App\Order::withTrashed()->orderBy('id', 'desc')->paginate(20);
        return view('admin.orders.order_future', $result);*/
    }

    public function getAdd()
    {
        return view('admin.user.add');
    }

    public function postAdd()
    {
        $response = [
            'result'    => true,
            'message'   => '保存成功',
        ];

        try {

            $validator = Validator::make(Request::all(), [
                'email'     => 'required|email|unique:users|max:255',
                'password'  => 'required',
            ], [
                'email.required' => '邮箱不能为空',
                'email.email'    => '邮箱格式不正确',
                'email.unique'   => '该邮箱已被使用',
                'email.max'      => '邮箱长度不能超过255个字符',
                'password.required' => '请给新用户设置个密码',
            ]);

            if ($validator->fails())
            {
                throw new Exception($validator->errors()->first());
            }

            $new_user = new \App\User();

            $new_user->name     = Request::input('name') ? Request::input('name') : null;
            $new_user->email    = Request::input('email');
            $new_user->password = bcrypt(Request::input('password'));

            $new_user->save();

        } catch(Exception $e) {
            $response['result']  = false;
            $response['message'] = $e->getMessage();
        }

        return $response;
    }

    public function getEdit($id)
    {
        $result['user'] = \App\User::withTrashed()->findOrFail($id);

        return view('admin.user.edit', $result);
    }

    public function postEdit($id)
    {
        $response = [
            'result'    => true,
            'message'   => '保存成功',
        ];

        try {

            $get_user = \App\User::withTrashed()->findOrFail($id);

            $get_user->name     = Request::input('name') ? Request::input('name') : null;

            if (Request::input('password')) {
                $get_user->password = bcrypt(Request::input('password'));
            }

            $get_user->save();

        } catch(Exception $e) {
            $response['result']  = false;
            $response['message'] = $e->getMessage();
        }

        return $response;
    }

    public function postDelete()
    {
        $response = [
            'result'    => true,
            'message'   => '删除成功',
        ];

        try {

            $has_admin = \App\User::whereIn('id', Request::input('user_id'))
                ->where('role', 'admin')
                ->count();

            if ($has_admin) {
                throw new Exception('包含超级管理员，不能删除');
            }

            \App\User::destroy(Request::input('user_id'));

        } catch(Exception $e) {
            $response['result']  = false;
            $response['message'] = $e->getMessage();
        }

        return $response;
    }

    //现货签合同
    public function postNowcon(){
        $response = [
            'result'    => true,
            'message'   => '修改成功',
        ];
        try {
            App\Order::whereIn('id', Request::input('order_ids'))
                ->update(['status' => 1]);
        } catch(Exception $e) {
            $response['result']  = false;
            $response['message'] = $e->getMessage();
        }

        return $response;
    }

    //现货付款
    public function postNowpay(){
        $response = [
            'result'    => true,
            'message'   => '修改成功',
        ];
        try {
            App\Order::whereIn('id', Request::input('order_ids'))
                ->update(['status' => 1]);
        } catch(Exception $e) {
            $response['result']  = false;
            $response['message'] = $e->getMessage();
        }

        return $response;
    }

}

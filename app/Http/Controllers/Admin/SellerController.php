<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Exception;
use Request;
use Validator;
use App;
use DB;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Schema\Blueprint;

class SellerController extends Controller
{
    public function getIndex()
    {
        /*$result['seller_list'] = \App\Seller::withTrashed()->orderBy('id', 'desc')->paginate(20);
        return view('admin.seller.seller', $result);*/

        $query = App\Seller::query();
        /*dd($query);*/
        if (!empty(Request::query())){

            if (Request::input('username'))
            {
                $query->where('name','like' ,"%".Request::input('username')."%");
            }
            if (Request::input('mobile'))
            {   //查询符合条件的用户们
                $users_info = DB::table('users')->select('id')->where('mobile', 'like','%'.Request::input('mobile').'%')->get();
                foreach($users_info as $k=>$v){
                    $user_ids[$k] = $v->id;
                }
                /*var_dump($order_ids);exit;*/
                /*$order_id = $order_info['order_id'];*/
                if(!empty($user_ids)){
                    $query->whereIn('user_id',$user_ids);
                }else{
                    $query->where('user_id',0);
                }
                /*$query->where('mobile','like',"%".Request::input('mobile')."%");*/
            }
        }

        $seller['seller_list'] = $query
            ->withTrashed()
            ->leftJoin('users','sellers.user_id','=','users.id')
            ->orderBy('sellers.created_at', 'desc')
            ->paginate(10);


        return view('admin.seller.seller', $seller);
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
        $result['seller'] = \App\User::withTrashed()->findOrFail($id);
        //通过商家id获取用户id
        $info = DB::table('sellers')->where('id',$id)->first();
        $info = \App\seller::withTrashed()->where('id',$id)->first();
        $user_id = $info->user_id;
        /*var_dump($user_id);exit;*/
        $result['user'] = \App\Seller::withTrashed()->where('user_id',$user_id)->first();
        $result['seller_info'] = \App\Seller::withTrashed()->where('user_id',$user_id)->first();
//         dd($result['seller_info']->is_star);
        return view('admin.seller.shop_edit', $result);
    }

    public function postEdit($id)
    {
        $seller_info = DB::table('sellers')->where('id',$id)->first();
        $user_id = $seller_info->user_id;
        $response = [
            'result'    => true,
            'message'   => '保存成功',
            'go_url'    => "/admin/seller/edit/".$user_id,
        ];

        try {
            /*$seller_info = DB::table('sellers')->where('id',$id)->first();
            $user_id = $seller_info->user_id;*/
            $get_user = \App\User::withTrashed()->findOrFail($id);

            /*$get_user->name     = Request::input('name') ? Request::input('name') : null;*/

            if (Request::input('password')) {
                $get_user->password = bcrypt(Request::input('password'));
            }

            $get_seller = \App\Seller::withTrashed()->where('user_id','=',$id);
            if (Request::input('state_type')) {
                /*$get_seller->shop_status = Request::input('state_type');*/
                $get_seller->update(['shop_status'=>Request::input('state_type')]);
            }

            $get_user->save();
            /*$get_seller->save();*/

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

            $has_admin = \App\seller::whereIn('id', Request::input('user_id'))
                ->where('role', 'admin')
                ->count();

            if ($has_admin) {
                throw new Exception('包含超级管理员，不能删除');
            }

            \App\seller::destroy(Request::input('user_id'));

        } catch(Exception $e) {
            $response['result']  = false;
            $response['message'] = $e->getMessage();
        }

        return $response;
    }

    public function getEvaluate(){
        $query = App\Comments::query();
        /*dd($query);*/
        if (!empty(Request::query())){

            if (Request::input('username'))
            {
                $query->where('name','like' ,"%".Request::input('name')."%");
            }
            if (Request::input('mobile'))
            {
                $query->where('mobile','like',"%".Request::input('mobile')."%");
            }
        }

        $evaluate['evaluate_list'] = $query
            ->orderBy('created_at', 'desc')
            ->paginate(10);


        return view('admin.seller.evaluate_list', $evaluate);
    }

    //删除商铺
    public function postDel(){
        $response = [
            'result'    => true,
            'message'   => '禁用成功',
        ];

        try {
           /* App\Seller::whereIn('id', Request::input('seller_ids'))
                ->update(['user_status' => '-1']);*/
            \App\User::destroy(Request::input('seller_ids'));
            \App\Seller::whereIn('id', Request::input('seller_ids'))
                ->update(['shop_status' => '2']);
        } catch(Exception $e) {
            $response['result']  = false;
            $response['message'] = $e->getMessage();
        }

        return $response;
    }

    //启用商家
    public function postStart(){
        $response = [
            'result'    => true,
            'message'   => '启用成功',
        ];
        try {
            App\Seller::whereIn('id', Request::input('seller_ids'))
                ->update(['deleted_at' => null]);
        } catch(Exception $e) {
            $response['result']  = false;
            $response['message'] = $e->getMessage();
        }

        return $response;
    }


    //禁用商家
    public function postForbid(){
        $response = [
            'result'    => true,
            'message'   => '禁用成功',
        ];
        try {
            App\Seller::whereIn('id', Request::input('seller_ids'))
                ->update(['deleted_at' => date('Y-m-d H:i:s')]);
        } catch(Exception $e) {
            $response['result']  = false;
            $response['message'] = $e->getMessage();
        }

        return $response;
    }

    //明星商家
    public function postStar(){
        $response = [
            'result'    => true,
            'message'   => '启用成功',
        ];
        try {
            App\Seller::whereIn('id', Request::input('seller_ids'))
                ->update(['is_star' => 1]);
        } catch(Exception $e) {
            $response['result']  = false;
            $response['message'] = $e->getMessage();
        }

        return $response;
    }


    //取消明星商家
    public function postNostar(){
        $response = [
            'result'    => true,
            'message'   => '禁用成功',
        ];
        try {
            App\Seller::whereIn('id', Request::input('seller_ids'))
                ->update(['is_star' => -1]);
        } catch(Exception $e) {
            $response['result']  = false;
            $response['message'] = $e->getMessage();
        }

        return $response;
    }

}

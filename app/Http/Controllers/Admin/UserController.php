<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Exception;
use Request;
use Validator;
use App;
use DB;

class UserController extends Controller
{
    public function getIndex()
    {
        $query = App\User::query();
         /*dd($query);*/
        if (!empty(Request::query())){

            if (Request::input('username'))
            {
                $query->where('name','like' ,"%".Request::input('username')."%");
            }
            if (Request::input('mobile'))
            {
                $query->where('mobile','like',"%".Request::input('mobile')."%");
            }
        }
        /*dd($areas);*/
        $user['user_list'] = $query
            ->withTrashed()
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        /*dd($goods);*/
        /* return view('shop.stocks.index', ['goods' => $goods, 'provinces' => $area, 'cities' => $city]);*/
        return view('admin.user.user_manage', $user);


        /*$result['user_list'] = \App\User::withTrashed()->orderBy('id', 'desc')->paginate(5);
        return view('admin.user.user_manage', $result);*/
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

    /*public function getEdit($id)
    {
        $result['user'] = \App\User::withTrashed()->findOrFail($id);

        return view('admin.user.edit', $result);
    }*/

    public function getEdit($id)
    {
        $result['user'] = \App\User::withTrashed()->findOrFail($id);
        $result['seller'] = \App\Seller::withTrashed()->where('user_id',$id)->first();
        $result['seller_info'] = \App\Seller::withTrashed()->where('user_id',$id)->first();
        /*var_dump($result);exit;*/
        return view('admin.user.person_edit', $result);
    }

    public function postEdit($id)
    {
        $response = [
            'result'    => true,
            'message'   => '保存成功',
            'go_url'    => "/admin/user/edit/".$id,
        ];

        try {

            $get_user = \App\User::withTrashed()->findOrFail($id);

            /*$get_user->name     = Request::input('name') ? Request::input('name') : null;*/

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
//会员管理 删除
    public function postDelete()
    {
        $response = [
            'result'    => true,
            'message'   => '删除成功',
        ];

        try {

            $has_admin = \App\User::whereIn('id', Request::input('user_ids'))
                                  ->where('role_id', '1')
                                  ->count();
//dd($has_admin);
            if ($has_admin) {
                throw new Exception('包含超级管理员，不能删除');
            }else{
                \App\User::destroy(Request::input('user_ids'));
            }



        } catch(Exception $e) {
            $response['result']  = false;
            $response['message'] = $e->getMessage();
        }

        return $response;
    }

    //删除商铺
    public function postDel(){
        $response = [
            'result'    => true,
            'message'   => '删除成功',
        ];

        try {

            \App\User::destroy(Request::input('user_ids'));

        } catch(Exception $e) {
            $response['result']  = false;
            $response['message'] = $e->getMessage();
        }

        return $response;
    }

    //启用商家
    public function postStart(){
        //dd(1111);
        $response = [
            'result'    => true,
            'message'   => '启用成功',
        ];
        try {
            App\User::whereIn('id', Request::input('user_ids'))
                ->update(['user_status' => 1]);
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
            App\User::whereIn('id', Request::input('user_ids'))
                ->update(['user_status' => -1]);
            /*DB::table('articles')->whereIn('id', Request::input('article_ids'))
                ->update(['is_show' => -1]);*/
        } catch(Exception $e) {
            $response['result']  = false;
            $response['message'] = $e->getMessage();
        }

        return $response;
    }

}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Exception;
use Request;
use Validator;

class SellerController extends Controller
{
    public function getIndex()
    {
        $result['seller_list'] = \App\Seller::withTrashed()->orderBy('id', 'desc')->paginate(20);
        return view('admin.seller.seller', $result);
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
}

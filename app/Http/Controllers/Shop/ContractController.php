<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use App;
use Request;
use Validator;

class ContractController extends Controller
{
    public function getSign($sn = null)
    {
        return view('shop.contract.sign');
    }

    public function postSign($sn)
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
}

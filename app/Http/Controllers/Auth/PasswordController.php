<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Exception;
use App;
use Auth;
use Request;
use Validator;
use Session;

class PasswordController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function getFind()
    {
        return view('auth.password.find');
    }

    public function postFind()
    {
        $response = [
            'result'    => true,
            'message'   => '密码已更改，正在跳往登录页面',
            'go_url'    => route('auth.login'),
        ];

        try {

            $validator = Validator::make(Request::all(), [
                'mobile'    => 'required|regex:/^1[34578][0-9]{9}$/|exists:users',
                'password'  => 'required|min:6|confirmed',
                'captcha'  => 'required',
            ], [
                'mobile.required'   => '手机号不能为空',
                'mobile.regex'      => '手机号格式有误，请检查',
                'mobile.exists'     => '该手机号未注册',
                'password.required' => '请输入登录密码',
                'password.min'      => '密码长度不能小于6位',
                'password.confirmed'=> '两次输入的密码不一致',
            ]);

            if ($validator->fails()) {
                throw new Exception($validator->messages()->first());
            }

            if (!captcha_valid(Request::input('mobile'))) {
                throw new Exception('验证码无效，请重新取得');
            } elseif (Request::input('captcha') != Session::get('captcha')) {
                Session::set('captcha_try', Session::get('captcha_try') + 1);
                throw new Exception('验证码不正确，请重新输入');
            }

            $get_user = App\User::where('mobile', Request::input('mobile'))->first();

            if (!$get_user) {
                throw new Exception('该用户已被删除');
            }

            $get_user->password = bcrypt(Request::input('password'));
            $get_user->save();

            captcha_destroy();

        } catch (Exception $e) {
            $response['result']  = false;
            $response['message'] = $e->getMessage();
        }

        return $response;
    }
}

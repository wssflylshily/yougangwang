<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Exception;
use App;
use Auth;
use Request;
use Validator;
use Session;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin.guest', ['except' => 'getLogout']);
    }

    protected function getLogin()
    {
        return view('admin.auth.login');
    }

    protected function postLogin()
    {
        $response = [
            'result'    => true,
            'message'   => '登录成功，正在跳转',
        ];

        try {

            $validator = Validator::make(Request::all(), [
                'account'    => 'required|max:255|exists:users,email',
                'password' => 'required',
//                'captcha'  => 'required',
            ], [
                'account.required' => '帐号不能为空',
                'account.max'      => '帐号长度不能超过255个字符',
                'account.exists'   => '帐号不存在',
                'password.required' => '请输入登录密码',
            ]);

            if ($validator->fails()) {
                throw new Exception($validator->messages()->first());
            }

//            if (Request::input('captcha') !== Session::get('captcha')) {
//                throw new Exception('验证码不正确，请重新输入');
//            }

            $get_user = App\User::where('email', Request::input('account'))->first();

            if(!$get_user || $get_user->role_id == '') {
                throw new Exception('帐号不存在');
            }

            $login_user = [
                'email'    => Request::input('account'),
                'password' => Request::input('password'),
            ];

            if (Auth::guest()) {
                if (!Auth::attempt($login_user)) {
                    throw new Exception('登录失败，密码不正确');
                }
            } elseif (Auth::user()->email == $login_user['email']) {
                if (!Auth::validate($login_user)) {
                    throw new Exception('登录失败，密码不正确');
                }
            } else { // 前台登录的和后台不是一个用户
                if (!Auth::attempt($login_user)) {
                    throw new Exception('登录失败，密码不正确');
                }
            }

            Session::set('admin_auth', time());

            $response['go_url'] = Session::get('url.intended') ? Session::remove('url.intended') : route('admin.home');

        } catch (Exception $e) {
            $response['result']  = false;
            $response['message'] = $e->getMessage();
        }

        return $response;
    }

    public function getLogout()
    {
        Session::forget('admin_auth');
        return redirect(route('admin.login'));
    }
}

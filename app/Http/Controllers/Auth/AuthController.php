<?php

namespace App\Http\Controllers\Auth;

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
        $this->middleware('guest', ['except' => 'getLogout']);
    }

    public function getLogin()
    {
        return view('auth.login');
    }

    public function postLogin()
    {
        $response = [
            'result'    => true,
            'message'   => '登录成功，正在跳转',
        ];
       //dd(Request::input('mobile'));
        try {

            $validator = Validator::make(Request::all(), [
                'mobile'    => 'required|regex:/^1[34578][0-9]{9}$/|exists:users',
                'password' => 'required',
            ], [
                'mobile.required'   => '手机号不能为空',
                'mobile.regex'      => '手机号格式有误，请检查',
                'mobile.exists'     => '该手机号未注册',
                'password.required' => '请输入登录密码',
            ]);

            if ($validator->fails()) {
                throw new Exception($validator->messages()->first());
            }

            $login_user = [
                'mobile'   => Request::input('mobile'),
                'password' => Request::input('password'),
            ];

            if (Auth::attempt($login_user, Request::has('remember_me'))) {
                $response['go_url'] = Session::get('url.intended') ? Session::remove('url.intended') : route('shop.home');
            } else {
                throw new Exception('登录失败，密码不正确');
            }

            $mobile =  Request::input('mobile');
            //dd($mobile);
            $user = App\User::query();
            $ok = $user->where('mobile',$mobile)->first();

           // $st = $ok->status;
            $status = $ok['user_status'];
            if($status == '-1'){
                throw new Exception('登录失败，被禁用');
            }
            $response['result'] = true;

        } catch (Exception $e) {
            $response['result']  = false;
            $response['message'] = $e->getMessage();
        }

        return $response;
    }

    public function getRegister()
    {
        return view('auth.register');
    }

    public function postRegister()
    {
        $response = [
            'result'    => true,
            'message'   => '注册成功，正在跳转',
        ];

        try {

            $validator = Validator::make(Request::all(), [
                'name'      => 'required|max:10|unique:users',
                'mobile'    => 'required|regex:/^1[34578][0-9]{9}$/|unique:users',
                'password'  => 'required|min:6|confirmed',
                'captcha'   => 'required',
            ], [
                'name.required'     => '用户名不能为空',
                'name.max'          => '用户名不能超过10个字',
                'name.unique'       => '该用户名已被注册',
                'mobile.required'   => '手机号不能为空',
                'mobile.regex'      => '手机号格式有误，请检查',
                'mobile.unique'     => '该手机号已被注册',
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

            $new_user = [
                'name'      => Request::input('name'),
                'mobile'    => Request::input('mobile'),
                'email'     => null,
                'password'  => bcrypt(Request::input('password')),
            ];

            $user = App\User::create($new_user);

            if($user) {
                Auth::login($user);
                $response['go_url'] = Session::get('url.intended') ? Session::remove('url.intended') : route('shop.home');

                captcha_destroy();
            } else {
                throw new Exception('注册失败');
            }

        } catch (Exception $e) {
            $response['result']  = false;
            $response['message'] = $e->getMessage();
        }

        return $response;
    }

    public function getLogout()
    {
        Auth::logout();
        return redirect(route('auth.login'));
    }


}

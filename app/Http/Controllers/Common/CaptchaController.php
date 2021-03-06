<?php

namespace App\Http\Controllers\Common;

use App\Http\Controllers\Controller;
use Exception;
use Request;
use Validator;
use App;

class CaptchaController extends Controller
{
    protected function postCaptchaSms()
    {
        $response = [
            'result'    => true,
            'message'   => '验证码已发送，请注意查收',
        ];

        try {

            $validator = Validator::make(Request::all(), [
                'mobile'    => 'required|regex:/^1[34578][0-9]{9}$/',
            ], [
                'mobile.required'   => '手机号不能为空',
                'mobile.regex'      => '手机号格式有误，请检查',
            ]);

            if ($validator->fails()) {
                throw new Exception($validator->messages()->first());
            }

            if (captcha_valid(Request::input('mobile'))) {
                throw new Exception('您刚收到的验证码仍然有效');
            }

            // 生成验证码和短信内容
            $captcha = rand_len_int();
            // $sms_tpl = '您的验证码是:' . $captcha . '。请不要把验证码泄露给其他人。【百分信息】';
             /*
            // 生成发送验证码api的调用参数
            $post_data = http_build_query([
                'sname'     => 'DL-wanglu',
                'spwd'      => 'abc123456',
                'scorpid'   => '',
                'sprdid'    => '1012818',
                'sdst'      => Request::input('mobile'),
                'smsg'      => $sms_tpl,
            ], null, '&', PHP_QUERY_RFC3986);

            // 取得发送验证码api
            $gets = sms_captcha($post_data);

            // 解析返回结果，做相应处理
            $result = xml_to_array($gets);
            if ($result['State'] == 0) {
                // 把验证码相关信息保存到session里
                captcha_store($captcha, Request::input('mobile'));
            } else {
                throw new Exception('验证码发送失败，请重试');
            }*/
            $instance = new SendMessage();
            $tem = "SMS_61735016";
            $status=$instance->run(Request::input('mobile'),$captcha,$tem);
            if($status == false){
                $response['result']  = false;
                $response['message'] = '网络错误'; 
            }else{
                // 把验证码相关信息保存到session里
                captcha_store($captcha, Request::input('mobile'));
            }
        } catch (\Exception $e) {
            $response['result']  = false;
            $response['message'] = '网络错误'; 
        }

        return $response;
    }

    //获得所有钢铁参数
    public function getSteelParameter()
    {
        $result = null;

        //品种
        $db1 = App\Variety::query();
        $result['varieties'] = $db1->get();

        //材质
        $db2 = App\Material::query();
        $result['materials'] = $db2->get();

        //标准
        $db3 = App\Standard::query();
        $result['standards'] = $db3->get();

        //钢厂
        $db4 = App\SteelMill::query();
        $result['steelmills'] = $db4->get();

        return $result;
    }
}

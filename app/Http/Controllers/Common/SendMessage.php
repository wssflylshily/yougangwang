<?php
namespace App\Http\Controllers\Common;

require_once(public_path('sms').'/mns-autoloader.php');

use AliyunMNS\Client;
use AliyunMNS\Topic;
use AliyunMNS\Constants;
use AliyunMNS\Model\MailAttributes;
use AliyunMNS\Model\SmsAttributes;
use AliyunMNS\Model\BatchSmsAttributes;
use AliyunMNS\Model\MessageAttributes;
use AliyunMNS\Exception\MnsException;
use AliyunMNS\Requests\PublishMessageRequest;
class SendMessage
{
    public function run($mobile,$code,$tem,$type=0)
    {
        /**
         * Step 1. 初始化Client
         */
        $this->endPoint = "http://1334077812577753.mns.cn-hangzhou.aliyuncs.com/"; // eg. http://1234567890123456.mns.cn-shenzhen.aliyuncs.com
        $this->accessId = "LTAIqQRVM14moUy6";
        $this->accessKey = "m8vUHLn7iJIFeQMTBsX8UkYoFaIxU7";
        $this->client = new Client($this->endPoint, $this->accessId, $this->accessKey);
        /**
         * Step 2. 获取主题引用
         */
        $topicName = "sms.topic-cn-hangzhou";
        $topic = $this->client->getTopicRef($topicName);

        /**
         * Step 3. 生成SMS消息属性
         */
        // 3.1 设置发送短信的签名（SMSSignName）和模板（SMSTemplateCode）
        $batchSmsAttributes = new BatchSmsAttributes("优钢网",$tem);
        // 3.2 （如果在短信模板中定义了参数）指定短信模板中对应参数的值
        if($type==0){
            $batchSmsAttributes->addReceiver($mobile, array("code" => $code));  
        }else{
            $batchSmsAttributes->addReceiver($mobile, array("name" => $code));
        }

//        $batchSmsAttributes->addReceiver("YourReceiverPhoneNumber2", array("YourSMSTemplateParamKey1" => "value1"));
        $messageAttributes = new MessageAttributes(array($batchSmsAttributes));
        /**
         * Step 4. 设置SMS消息体（必须）
         *
         * 注：目前暂时不支持消息内容为空，需要指定消息内容，不为空即可。
         */
        $messageBody = "您的验证码是:123。请不要把验证码泄露给其他人。";
        /**
         * Step 5. 发布SMS消息
         */
        $request = new PublishMessageRequest($messageBody, $messageAttributes);
        try
        {
            $res = $topic->publishMessage($request);
            // echo $res->isSucceed();
            if($res->isSucceed()==1){
                return true;
            }else{
                return false;
            }
            // echo "\n";
            // echo $res->getMessageId();
            // echo "\n";
        }
        catch (MnsException $e)
        {
            return false;
            // echo $e;
            // echo "\n";
        }
    }
}
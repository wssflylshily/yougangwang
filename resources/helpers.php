<?php

function page_render($paginator)
{
    $presenter = new \App\Overwrites\CustomPresenter($paginator);
    return $presenter->render();
}

function rand_len_int($len = 6, $fill_zero = true)
{
    $max_value = pow(10, $len) - 1;

    if ($fill_zero) {
        $input  = rand(0, $max_value);
        $result = str_pad($input, $len, '0', STR_PAD_LEFT);
    } else {
        $min_value = pow(10, $len - 1);
        $result = (string) rand($min_value, $max_value);
    }

    return $result;
}

function sms_captcha($data, $target = null)
{
    $target = $target ?: 'http://cf.lmobile.cn/submitdata/Service.asmx/g_Submit';
    $url_info = parse_url($target);
    $httpheader = "POST " . $url_info['path'] . " HTTP/1.0\r\n";
    $httpheader .= "Host:" . $url_info['host'] . "\r\n";
    $httpheader .= "Content-Type:application/x-www-form-urlencoded\r\n";
    $httpheader .= "Content-Length:" . strlen($data) . "\r\n";
    $httpheader .= "Connection:close\r\n\r\n";
    //$httpheader .= "Connection:Keep-Alive\r\n\r\n";
    $httpheader .= $data;

    $fd = fsockopen($url_info['host'], 80);
    fwrite($fd, $httpheader);
    $gets = "";
    while(!feof($fd)) {
        $gets .= fread($fd, 128);
    }
    fclose($fd);
    if($gets != ''){
        $start = strpos($gets, '<?xml');
        if($start > 0) {
            $gets = substr($gets, $start);
        }        
    }
    return $gets;
}

function captcha_store($captcha, $mobile = null)
{
    Session::set('captcha', $captcha);

    if ($mobile) {
        Session::set('captcha_mobile', $mobile);
        Session::set('captcha_time', time());
        Session::set('captcha_try', 0);
    }
}

function captcha_destroy()
{
    Session::forget('captcha');
    Session::forget('captcha_mobile');
    Session::forget('captcha_time');
    Session::forget('captcha_try');
}

function captcha_valid($mobile = null)
{
    if (Session::has('captcha') && time() - Session::get('captcha_time') < 180) {
        if (!$mobile) {
            return true;
        } elseif ($mobile == Session::get('captcha_mobile') && Session::get('captcha_try') <= 3) {
            return true;
        }
    }


    return false;
}

function xml_to_array($xml)
{
    //禁止引用外部xml实体 
    libxml_disable_entity_loader(true); 
    $xmlstring = simplexml_load_string($xml, 'SimpleXMLElement', LIBXML_NOCDATA);
    $arr = json_decode(json_encode($xmlstring), true);

    return $arr;
} 

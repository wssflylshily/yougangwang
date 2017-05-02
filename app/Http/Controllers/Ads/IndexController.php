<?php

/**
 * 广告管理
 * 2017.1.12
 * 孙璠
 */
namespace App\Http\Controllers\Ads;

use DB;
use App;
use App\Http\Controllers\Controller;
use Exception;
use Request;
use Validator;

class IndexController extends Controller
{
    protected function getIndex()
    {
        $db = App\Ad::query();
        $rs = $db->orderBy('created_at', 'desc')->take(3)->get();
        return json_encode($rs);
    }

}

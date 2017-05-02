<?php

/**
 * 文章管理
 * 2017.1.11
 * 孙璠
 */
namespace App\Http\Controllers\Article;

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
        $db = App\Article::query();
        if (Request::input('type'))
        {
            $db->where('type', Request::input('type'))->orderBy('order', 'asc');
        }
        $rs = $db->get();
        return view('article.index', ['rs' => $rs]);
    }

    protected function getDetail($id)
    {
        $db = App\Article::query();
        $rs = $db->where('id', $id)->first();
        return view('article.detail', ['rs' => $rs]);
    }

    protected function getFooter()
    {
        $db = App\Article::query();
        if (Request::input('type'))
        {
            $db->where('type', Request::input('type'))->orderBy('order', 'asc');
        }
        $rs = $db->take(5)->get();
        return json_encode($rs);
    }

    public function getFooterMes()
    {
        $footer = DB::table('config')->where('remarks','底部信息')->first();
        return json_encode($footer->value);
    }

}

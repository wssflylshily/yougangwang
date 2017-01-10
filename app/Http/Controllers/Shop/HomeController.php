<?php

namespace App\Http\Controllers\Shop;

use App;
use App\Http\Controllers\Controller;
use Request;
use Validator;
use DB;

class HomeController extends Controller
{
    public function __construct()
    {
//        $this->middleware('guest', ['except' => 'getLogout']);
    }

    protected function getIndex()
    {
        $this->visits();
        //浏览量
        $visits = DB::table('config')->where('name', 'visits')->first();
        $sale = DB::table('config')->where('name', 'sale')->first();
        //孙璠---首页---特卖部分---start
        $query = App\Goods::query();
        if (Request::input('goods_name'))
        {
            $query->where('name', Request::input('goods_name'));
        }
        $goods = $query->leftJoin('areas', 'areas.areaId', '=', 'goods.area_code')->where('type','9')->orderBy('created_at', 'desc')->take(7)->get();
        //孙璠---首页---特卖部分---end
        
        //mashanshan-----首页期货部分------start
        $futures = App\OrderFutures::query();
        $futureList = $futures->orderBy('created_at','desc')->groupBy('order_id')->take(4)->get();
        //mashanshan-----首页期货部分------end

        return view('shop.home.index',['goods' => $goods,'futures'=>$futureList, 'visits' => $visits, 'sale' => $sale]);
    }
    protected function visits()
    {
        DB::table('config')->increment('value', 1, ['name' => 'visits']);
    }
}

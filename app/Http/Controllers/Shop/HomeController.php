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
        $goods = $query->leftJoin('areas', 'areas.areaId', '=', 'goods.area_code')->where('type','9')->where('status',1)->orderBy('created_at', 'desc')->take(7)->get();
        //孙璠---首页---特卖部分---end
        
        //mashanshan-----首页期货部分------start
        $futures = App\OrderFutures::query();
        $futureList = $futures->leftJoin('areas', 'areas.areaId', '=', 'order_futures.city_id')->orderBy('created_at','desc')->groupBy('order_id')->take(4)->get();
        //mashanshan-----首页期货部分------end

        //明星商城
        $seller = DB::table('sellers')->where('is_star', 1)->take(5)->orderBy('sale_count', 'desc')->get();

        //轮播图
        $banners = App\Banner::query()->get();

        return view('shop.home.index',['goods' => $goods,'futures'=>$futureList, 'visits' => $visits, 'sale' => $sale, 'sellers' => $seller, 'banners'=>$banners]);
    }

    protected function visits()
    {
        //DB::table('config')->increment('value', 1, ['name' => 'visits']);
        $visit = DB::table('config')->where('name','visits')->first();
        DB::table('config')->where('name','visits')->update(['value' => $visit->value+1]);
    }

    protected function getLocation()
    {
//        $getIp=$_SERVER["REMOTE_ADDR"];
        $getIp="111.165.27.199";
        $content = file_get_contents("http://api.map.baidu.com/location/ip?ak=5DE0E3q3e6NZ6gUgQ8gLHFH2Gn7pVI6G&ip={$getIp}&coor=bd09ll");
        if (!$content)
        {
            echo "未知";exit();
        }
        $json = json_decode($content);
        echo $json->content->address;//按层级关系提取address数据
    }

    protected function getShopHome()
    {
        $db = App\Goods::query();
        $sellerid = Request::input('seller_id');
        //$sellerid = 1;

        //商铺信息
        $sellerInfo = App\Seller::query()->where('id', $sellerid)->first();

        //商品
        $groups = $db->where('seller_id', $sellerid)
            ->groupBy('variety')->get();

        $i=0;
        $goods =  array();
        foreach ($groups as $item)
        {
            $goods[$i] = App\Goods::query()->where('seller_id', $sellerid)
                ->where('variety', $item->variety)
                ->leftJoin('areas', 'areas.areaId', '=', 'goods.area_code')
                ->orderBy('created_at', 'desc')->take(10)->get();
            $i++;
        }
        return view('shop.home.shop_home', ['groups' => $groups, 'goods' => $goods, 'seller'=>$sellerInfo]);
    }

    protected function getShopStores()
    {
        $db = App\Goods::query();
        $sellerid = Request::input('seller_id');
        //$sellerid = 1;

        $city = "";
        if (!empty(Request::query())){
            if (Request::input('city'))
            {
                $db->where('area_code', Request::input('city'));
                $city = DB::table('areas')->where('parentId', Request::input('province'))->get();
            }
            if (Request::input('variety'))
            {
                $db->where('variety', Request::input('variety'));
            }
            if (Request::input('standard'))
            {
                $db->where('standard', Request::input('standard'));
            }
            if (Request::input('material'))
            {
                $db->where('material', Request::input('material'));
            }
            if (Request::input('steelmill'))
            {
                $db->where('steelmill', Request::input('steelmill'));
            }
            if (Request::input('outer_diameter1') != null && Request::input('outer_diameter2'))
            {
                $db->whereBetween('outer_diameter', [Request::input('outer_diameter1'), Request::input('outer_diameter2')]);
            }
            if (Request::input('thickness1') != null && Request::input('thickness2'))
            {
                $db->whereBetween('thickness', [Request::input('thickness1'), Request::input('thickness2')]);
            }
            if (Request::input('length1') != null && Request::input('length2'))
            {
                $db->whereBetween('length', [Request::input('length1'), Request::input('length2')]);
            }
            if (Request::input('price1') != null && Request::input('price2'))
            {
                $db->whereBetween('price', [Request::input('price1'), Request::input('price2')]);
            }
            if (Request::input('search_key') != null && Request::input('search_content') != null)
            {
                $db->where(Request::input('search_key'), 'like', '%'.Request::input('search_content').'%');
            }
        }

        //商铺信息
        $sellerInfo = App\Seller::query()->where('id', $sellerid)->first();

        $area = DB::table('areas')->where('parentId', 0)->get();
        $goods = $db->where('seller_id', $sellerid)
            //->where('variety', Request::input('variety'))
            ->leftJoin('areas', 'areas.areaId', '=', 'goods.area_code')->orderBy('created_at', 'desc')->paginate(10);

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

        return view('shop.home.shop_stores', ['seller'=>$sellerInfo, 'goods' => $goods, 'provinces' => $area, 'cities' => $city, 'result' => Request::input('result')?Request::input('result'):""], $result);
    }
}

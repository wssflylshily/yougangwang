<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use App;
use Illuminate\Routing\Route;
use Request;
use Validator;
use Illuminate\Support\Facades\DB;

class StocksController extends Controller
{
    /**
     * 现货交易
     * 孙璠
     * 2016.12.22
     */
    protected function getIndex()
    {
    	
        $query = App\Goods::query();
        $city = "";
        if (!empty(Request::query())){
            if (Request::input('city'))
            {
                $query->where('area_code', Request::input('city'));
                $city = DB::table('areas')->where('parentId', Request::input('province'))->get();
            }
            if (Request::input('variety'))
            {
                $query->where('variety', Request::input('variety'));
            }
            if (Request::input('standard'))
            {
                $query->where('standard', Request::input('standard'));
            }
            if (Request::input('material'))
            {
                $query->where('material', Request::input('material'));
            }
            if (Request::input('steelmill'))
            {
                $query->where('steelmill', Request::input('steelmill'));
            }
            if (Request::input('outer_diameter1') != null && Request::input('outer_diameter2'))
            {
                $query->whereBetween('outer_diameter', [Request::input('outer_diameter1'), Request::input('outer_diameter2')]);
            }
            if (Request::input('thickness1') != null && Request::input('thickness2'))
            {
                $query->whereBetween('thickness', [Request::input('thickness1'), Request::input('thickness2')]);
            }
            if (Request::input('length1') != null && Request::input('length2'))
            {
                $query->whereBetween('length', [Request::input('length1'), Request::input('length2')]);
            }
            if (Request::input('price1') != null && Request::input('price2'))
            {
                $query->whereBetween('price', [Request::input('price1'), Request::input('price2')]);
            }
            if (Request::input('search_key') != null && Request::input('search_content') != null)
            {
                $query->where(Request::input('search_key'), 'like', '%'.Request::input('search_content').'%');
            }
        }
        $area = DB::table('areas')->where('parentId', 0)->get();
        $goods = $query->where('type','0')->where('status', 1)
                    ->leftJoin('areas', 'areas.areaId', '=', 'goods.area_code')
                    ->orderBy('created_at', 'desc')
                    ->paginate(8);

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

        return view('shop.stocks.index', ['goods' => $goods, 'provinces' => $area, 'cities' => $city],$result);
    }
    
    /**
     * 特卖列表
     * 孙璠
     */
    protected function getSpecial(){
        $query = App\Goods::query();
        $city = "";
        if (!empty(Request::query())){
            if (Request::input('city'))
            {
                $query->where('area_code', Request::input('city'));
                $city = DB::table('areas')->where('parentId', Request::input('province'))->get();
            }
            if (Request::input('variety'))
            {
                $query->where('variety', Request::input('variety'));
            }
            if (Request::input('standard'))
            {
                $query->where('standard', Request::input('standard'));
            }
            if (Request::input('material'))
            {
                $query->where('material', Request::input('material'));
            }
            if (Request::input('steelmill'))
            {
                $query->where('steelmill', Request::input('steelmill'));
            }
            if (Request::input('outer_diameter1') != null && Request::input('outer_diameter2'))
            {
                $query->whereBetween('outer_diameter', [Request::input('outer_diameter1'), Request::input('outer_diameter2')]);
            }
            if (Request::input('thickness1') != null && Request::input('thickness2'))
            {
                $query->whereBetween('thickness', [Request::input('thickness1'), Request::input('thickness2')]);
            }
            if (Request::input('length1') != null && Request::input('length2'))
            {
                $query->whereBetween('length', [Request::input('length1'), Request::input('length2')]);
            }
            if (Request::input('price1') != null && Request::input('price2'))
            {
                $query->whereBetween('price', [Request::input('price1'), Request::input('price2')]);
            }
            if (Request::input('search_key') != null && Request::input('search_content') != null)
            {
                $query->where(Request::input('search_key'), 'like', '%'.Request::input('search_content').'%');
            }
        }

        $area = DB::table('areas')->where('parentId', 0)->get();
        $goods = $query->where('type','9')->where('status', 1)->leftJoin('areas', 'areas.areaId', '=', 'goods.area_code')->orderBy('created_at', 'desc')->paginate(8);

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

    	return view('shop.special.index', ['goods' => $goods, 'provinces' => $area, 'cities' => $city],$result);
    }
    /**
     * 获取现货、特卖详情
     * 孙璠
     */
    protected function getDetail(){
        $id = Request::input('id');
        $query = App\Goods::query();
        $query->where('goods.id', $id);
        $goods = $query
            ->leftJoin('sellers', 'sellers.id', '=', 'goods.seller_id')
            ->first();
//        dd($goods);
    	return view('shop.special.detail', ['goods' => $goods]);
    }

    /**
     * 根据省份查城市
     * 孙璠
     * 2016.12.29
     */
    protected function getCities(){
        $areaid = Request::input('areaId');
        $cities = null;
        if ($areaid){
            $cities = DB::table('areas')->where('parentId',$areaid)->get();
        }
        return json_encode($cities);
    }

}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Exception;
use Request;
use Validator;
use App;
use DB;

class FutureController extends Controller
{
    /*public function getIndex()
    {
        //$result['future_list'] = \App\Goods::withTrashed()->orderBy('id', 'desc')->paginate(20);
        $result['future_list'] = App\FutureOffers::orderBy('id', 'desc')->paginate(10);
        return view('admin.futures.product_future', $result);
    }*/

    public function getIndex()
    {
        $query = App\OrderFutures::query();
        //$query = App\Goods::query();
        /* dd($query);*/
        $city = "";
        if (!empty(Request::query())){
            /*if (Request::input('city'))
            {
                $query->where('area_code', Request::input('city'));
                $city = DB::table('areas')->where('parentId', Request::input('province'))->get();
            }*/
        	if (Request::input('province'))
        	{
        		$query->where('area_id', Request::input('province'));
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
            if (Request::input('outer_diameter1') && Request::input('outer_diameter2'))
            {
                $query->whereBetween('outer_diameter', [Request::input('outer_diameter1'), Request::input('outer_diameter2')]);
            }
            if (Request::input('thickness1') && Request::input('thickness2'))
            {
                $query->whereBetween('thickness', [Request::input('thickness1'), Request::input('thickness2')]);
            }
            if (Request::input('length1') && Request::input('length2'))
            {
                $query->whereBetween('length', [Request::input('length1'), Request::input('length2')]);
            }
            if (Request::input('price1') && Request::input('price2'))
            {
                $query->whereBetween('price', [Request::input('price1'), Request::input('price2')]);
            }
            if (Request::input('search_key') && Request::input('search_content') != null)
            {
                $query->where(Request::input('search_key'), 'like', '%'.Request::input('search_content').'%');
            }
        }
        //dd(Request::input('province'));
        $area = DB::table('areas')->where('parentId', 0)->get();
        
        $list = $query
		        ->leftJoin('areas', 'areas.areaId', '=', 'order_futures.area_id')
		        ->groupby('order_id')
		        ->orderby('order_id','desc')
		        ->paginate(10);
        /*dd($areas);*/
       /* $goods['future_list'] = $query->where('type', 0)
            ->leftJoin('areas', 'areas.areaId', '=', 'goods.area_code')
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        /*dd($goods);*/

        //品种
        $db1 = App\Variety::query();
        $goods['varieties'] = $db1->get();

        //材质
        $db2 = App\Material::query();
        $goods['materials'] = $db2->get();

        //标准
        $db3 = App\Standard::query();
        $goods['standards'] = $db3->get();

        //钢厂
        $db4 = App\SteelMill::query();
        $goods['steelmills'] = $db4->get();

        /*dd($goods);*/
        /* return view('shop.stocks.index', ['goods' => $goods, 'provinces' => $area, 'cities' => $city]);*/
        return view('admin.futures.product_future', $goods,[ 'provinces' => $area, 'cities' => $city,'lists'=>$list]);
        //$result['stock_list'] = \App\Goods::withTrashed()->orderBy('id', 'desc')->paginate(20);
        /*$result['stock_list'] = \App\Goods::withTrashed()->orderBy('id', 'desc')->paginate(20);
        return view('admin.stock.product_now', $result);*/
    }

    //根据省份查城市
    protected function getCities(){
        $areaid = Request::input('areaId');
        $cities = null;
        if ($areaid){
            $cities = DB::table('areas')->where('parentId',$areaid)->get();
        }
        return json_encode($cities);
    }

    public function getAdd()
    {
        return view('admin.user.add');
    }

    public function postAdd()
    {
        $response = [
            'result'    => true,
            'message'   => '保存成功',
        ];

        try {

            $validator = Validator::make(Request::all(), [
                'email'     => 'required|email|unique:users|max:255',
                'password'  => 'required',
            ], [
                'email.required' => '邮箱不能为空',
                'email.email'    => '邮箱格式不正确',
                'email.unique'   => '该邮箱已被使用',
                'email.max'      => '邮箱长度不能超过255个字符',
                'password.required' => '请给新用户设置个密码',
            ]);

            if ($validator->fails())
            {
                throw new Exception($validator->errors()->first());
            }

            $new_user = new \App\User();

            $new_user->name     = Request::input('name') ? Request::input('name') : null;
            $new_user->email    = Request::input('email');
            $new_user->password = bcrypt(Request::input('password'));

            $new_user->save();

        } catch(Exception $e) {
            $response['result']  = false;
            $response['message'] = $e->getMessage();
        }

        return $response;
    }

    public function getEdit($id)
    {
        $result['user'] = \App\User::withTrashed()->findOrFail($id);

        return view('admin.user.edit', $result);
    }

    public function postEdit($id)
    {
        $response = [
            'result'    => true,
            'message'   => '保存成功',
        ];

        try {

            $get_user = \App\User::withTrashed()->findOrFail($id);

            $get_user->name     = Request::input('name') ? Request::input('name') : null;

            if (Request::input('password')) {
                $get_user->password = bcrypt(Request::input('password'));
            }

            $get_user->save();

        } catch(Exception $e) {
            $response['result']  = false;
            $response['message'] = $e->getMessage();
        }

        return $response;
    }

    public function postDelete()
    {
        $response = [
            'result'    => true,
            'message'   => '删除成功',
        ];

        try {

            $has_admin = \App\User::whereIn('id', Request::input('user_id'))
                ->where('role', 'admin')
                ->count();

            if ($has_admin) {
                throw new Exception('包含超级管理员，不能删除');
            }

            \App\User::destroy(Request::input('user_id'));

        } catch(Exception $e) {
            $response['result']  = false;
            $response['message'] = $e->getMessage();
        }

        return $response;
    }
}

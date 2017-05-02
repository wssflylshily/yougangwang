<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/1/14
 * Time: 11:02
 */

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Request;
use Validator;
use App;
use Illuminate\Support\Facades\DB;

class WebsetController extends Controller{
    //城市信息
    public function getIndex(){


        return view('admin.webset.webset_city');

    }

    //钢铁信息
    public function getSteel(){

        return view('admin.webset.webset_steel');

    }

    //品种
    public function getSteelVariety()
    {
        $db = App\Variety::query();
        $rs = $db->orderBy('created_at', 'desc')->paginate(10);
        return view('admin.webset.steel.variety', ['rs' => $rs]);
    }

    //品种
    public function getVarietyAdd()
    {
        return view('admin.webset.steel.variety_add');
    }

    //品种
    public function postVarietyAdd()
    {
        $response = [
            'result'    => true,
            'message'   => '添加成功',
        ];

        try {

            $validator = Validator::make(Request::all(), [
                'name_name'    => 'required',
            ], [
                'name_name.required'   => '名称不能为空!',
            ]);

            if ($validator->fails()) {
                throw new Exception($validator->messages()->first());
            }

            $old = App\Variety::query()->where('name', Request::input('name_name'))->first();
            if ($old != null)
            {
                $response = [
                    'result'    => true,
                    'message'   => '已存在相同名称',
                ];
                return view('admin.webset.steel.variety_add', $response);
            }

            $db = new App\Variety();
            $db->name = Request::input('name_name');
            $db->save();

        } catch(Exception $e) {
            $response['result']  = false;
            $response['message'] = $e->getMessage();
            return view('admin.webset.steel.variety_add', $response);
        }

        return redirect(route('admin.webset.steel.variety'));
    }

    public function postVarietyDelete()
    {
        $response = [
            'result'    => true,
            'message'   => '删除成功',
        ];

        try {

            \App\Variety::destroy(Request::input('id'));

        } catch(Exception $e) {
            $response['result']  = false;
            $response['message'] = $e->getMessage();
        }

        return $response;
    }


    //标准
    public function getSteelStandard()
    {
        $db = App\Standard::query();
        $rs = $db->orderBy('created_at', 'desc')->paginate(10);
        return view('admin.webset.steel.standard', ['rs' => $rs]);
    }

    //标准
    public function getStandardAdd()
    {
        return view('admin.webset.steel.standard_add');
    }

    //标准
    public function postStandardAdd()
    {
        $response = [
            'result'    => true,
            'message'   => '添加成功',
        ];

        try {

            $validator = Validator::make(Request::all(), [
                'name_name'    => 'required',
            ], [
                'name_name.required'   => '名称不能为空!',
            ]);

            if ($validator->fails()) {
                throw new Exception($validator->messages()->first());
            }

            $old = App\Standard::query()->where('name', Request::input('name_name'))->first();
            if ($old != null)
            {
                $response = [
                    'result'    => true,
                    'message'   => '已存在相同名称',
                ];
                return view('admin.webset.steel.standard_add', $response);
            }

            $db = new App\Standard();
            $db->name = Request::input('name_name');
            $db->save();

        } catch(Exception $e) {
            $response['result']  = false;
            $response['message'] = $e->getMessage();
            return view('admin.webset.steel.standard_add', $response);
        }

        return redirect(route('admin.webset.steel.standard'));
    }

    public function postStandardDelete()
    {
        $response = [
            'result'    => true,
            'message'   => '删除成功',
        ];

        try {

            \App\Standard::destroy(Request::input('id'));

        } catch(Exception $e) {
            $response['result']  = false;
            $response['message'] = $e->getMessage();
        }

        return $response;
    }

    //材质
    public function getSteelMaterial()
    {
        $db = App\Material::query();
        $rs = $db->orderBy('created_at', 'desc')->paginate(10);
        return view('admin.webset.steel.material', ['rs' => $rs]);
    }

    public function getMaterialAdd()
    {
        return view('admin.webset.steel.material_add');
    }

    public function postMaterialAdd()
    {
        $response = [
            'result'    => true,
            'message'   => '添加成功',
        ];

        try {

            $validator = Validator::make(Request::all(), [
                'name_name'    => 'required',
            ], [
                'name_name.required'   => '名称不能为空!',
            ]);

            if ($validator->fails()) {
                throw new Exception($validator->messages()->first());
            }

            $old = App\Material::query()->where('name', Request::input('name_name'))->first();
            if ($old != null)
            {
                $response = [
                    'result'    => true,
                    'message'   => '已存在相同名称',
                ];
                return view('admin.webset.steel.material_add', $response);
            }

            $db = new App\Material();
            $db->name = Request::input('name_name');
            $db->save();

        } catch(Exception $e) {
            $response['result']  = false;
            $response['message'] = $e->getMessage();
            return view('admin.webset.steel.material_add', $response);
        }

        return redirect(route('admin.webset.steel.material'));
    }

    public function postMaterialDelete()
    {
        $response = [
            'result'    => true,
            'message'   => '删除成功',
        ];

        try {

            \App\Material::destroy(Request::input('id'));

        } catch(Exception $e) {
            $response['result']  = false;
            $response['message'] = $e->getMessage();
        }

        return $response;
    }

    //钢厂
    public function getSteelSteelmill()
    {
        $db = App\SteelMill::query();
        $rs = $db->orderBy('created_at', 'desc')->paginate(10);
        return view('admin.webset.steel.steelmill', ['rs' => $rs]);
    }

    public function getSteelmillAdd()
    {
        return view('admin.webset.steel.steelmill_add');
    }

    public function postSteelmillAdd()
    {
        $response = [
            'result'    => true,
            'message'   => '添加成功',
        ];

        try {

            $validator = Validator::make(Request::all(), [
                'name_name'    => 'required',
            ], [
                'name_name.required'   => '名称不能为空!',
            ]);

            if ($validator->fails()) {
                throw new Exception($validator->messages()->first());
            }

            $old = App\SteelMill::query()->where('name', Request::input('name_name'))->first();
            if ($old != null)
            {
                $response = [
                    'result'    => true,
                    'message'   => '已存在相同名称',
                ];
                return view('admin.webset.steel.steelmill_add', $response);
            }

            $db = new App\SteelMill();
            $db->name = Request::input('name_name');
            $db->save();

        } catch(Exception $e) {
            $response['result']  = false;
            $response['message'] = $e->getMessage();
            return view('admin.webset.steel.steelmill_add', $response);
        }

        return redirect(route('admin.webset.steel.steelmill'));
    }

    public function postSteelmillDelete()
    {
        $response = [
            'result'    => true,
            'message'   => '删除成功',
        ];

        try {

            \App\SteelMill::destroy(Request::input('id'));

        } catch(Exception $e) {
            $response['result']  = false;
            $response['message'] = $e->getMessage();
        }

        return $response;
    }

    //底部信息
    public function getFooter(){
        $footer = DB::table('config')->where('remarks','底部信息')->first();
        return view('admin.webset.webset_footer',['footer'=>$footer,'mes' => ""]);

    }

    //底部信息修改
    public function postFooter(){
        $footer = DB::table('config')->where('remarks','=','底部信息')->first();
        if(!empty($footer)){
        DB::table('config')
            ->where('remarks','=','底部信息')
            ->update(['value' => Request::input('name')]);
        }else{
            DB::table('config')
                ->insert(['value' => Request::input('name'),'name'=>'msg','remarks'=>'底部信息']);
        }
        //$footer = DB::table('config')->where('remarks','=','底部信息')->first();
        //dd($footer);
        return view('admin.webset.webset_footer', [ 'mes' => "修改成功"]);

    }

}
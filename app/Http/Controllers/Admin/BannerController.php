<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Exception;
use Request;
use Validator;
use App;
use Illuminate\Support\Facades\Auth;

class BannerController extends Controller
{

    public function getIndex()
    {
        //dd(Auth::user()->id);
        $db = App\Banner::query();
        $banner = $db->orderBy('oid', 'asc')->get();
        return view('admin.banner.bannermanage', ['banner'=>$banner]);
    }

    public function postAdd()
    {
        foreach (Request::input('pic_url') as $k=>$v)
        {
            $new_banner_pic = new App\Banner();
            $new_banner_pic->img = $v;
            $new_banner_pic->save();
        }

        $db = App\Banner::query();
        $banner = $db->orderBy('oid', 'asc')->get();
        return view('admin.banner.bannermanage', ['banner'=>$banner]);
    }

    public function getDelete($id)
    {
        //App\Banner::query()->where('id', Request::input('banner_id'))->delete();
        App\Banner::destroy($id);

        $db = App\Banner::query();
        $banner = $db->orderBy('oid', 'asc')->get();
        return view('admin.banner.bannermanage', ['banner'=>$banner]);
    }
}

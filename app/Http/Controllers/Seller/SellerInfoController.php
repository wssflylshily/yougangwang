<?php 
namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use Request;
use Validator;
use DB;
use App\Technics;
use App\Seller;
use Illuminate\Support\Facades\Auth;

class SellerInfoController extends Controller{
    protected $user_id = 2;
	 public function __construct()
    {
//        $this->middleware('guest', ['except' => 'getLogout']);
    }

    // 公司信息
    protected function getSellerInfo(){
    	//获取当前用户的商铺信息
        $user_id=Auth::user()->id;
        $sellerinfo = DB::table('sellers')->where('user_id','=',$user_id)->first();
        $jyfs = $sellerinfo->business_type;
        $show_jyfs = json_decode($jyfs);
        $wl = $sellerinfo->logistics_type;
        $show_wl = json_decode($wl);
        /*var_dump($show_jyfs);exit;*/
        if($sellerinfo){
            return view('seller.home.sellerinfo',['sellerinfo'=>$sellerinfo,'show_jyfs'=>$show_jyfs,'show_wl'=>$show_wl]);
        }else{

        }
    }

    // 保存公司信息
    protected function postSellerInfo(){
        //获取用户提交的信息
        $postinfo = Request::all();
        /*dd($postinfo);*/
        $req = request();
        /*dd(request());*/
        //获取工艺
        $user_id = Auth::user()->id;
        $gongyi = Request::input('gyname');
        $gprice = Request::input('gyprice');
        $jyfs = Request::input('jyfs');
        $wl = Request::input('wl');
        if($gongyi){
            foreach($gongyi as $key => $value){
                $gong[$key]['gyname'] = $gongyi[$key];
                $gong[$key]['gyprice'] = $gprice[$key];
            }
            $cungongyi = json_encode($gong,JSON_UNESCAPED_UNICODE);

        }

        if($jyfs){
            $cunjyfs = json_encode($jyfs,JSON_UNESCAPED_UNICODE);
        }

        if($wl){
            $cunwl = json_encode($wl,JSON_UNESCAPED_UNICODE);
        }

        $req = request();


        /*print_r($_FILES);EXIT;*/
        //查询自己是否有商铺
        $res = DB::table('sellers')->where('user_id','=',$this->user_id)->first();
        /*dd($res);*/
        if($res){
            $seller = Seller::find($user_id);
            if($req->hasFile('logo_pic') && $req->file('logo_pic')->isValid()){
                $public_path = public_path();
                $date = date('/Y/m/d/',time());
                $imgname = time().rand(1000,9999).'.png';
                $path = "/assets/uploads/sellers".$date;
                $file_res = $req->file('logo_pic')->move($public_path.$path,$imgname);
                $seller->logo_pic = $path.$imgname;
            }
            if($req->hasFile('address_pic') && $req->file('address_pic')->isValid()){
                $public_path = public_path();
                $date = date('/Y/m/d/',time());
                $imgname = time().rand(1000,9999).'.png';
                $path = "/assets/uploads/sellers".$date;
                $file_res = $req->file('address_pic')->move($public_path.$path,$imgname);
                $seller->address_pic = $path.$imgname;
            }
            /*$seller->name = Request::input('name');*/
            if($wl){
                $seller->logistics_type = $cunwl;
            }
            if(Request::input('dengji')){
                $seller->level = Request::input('dengji');
            }else{
                $seller->level = 0;
            }

            if($jyfs){
                $seller->business_type = $cunjyfs;
            }

            $seller->short_name = Request::input('gsjc');
            $seller->summary = Request::input('gsjj');
            $seller->business_area = Request::input('jydq');
            $seller->business_product = Request::input('zycp');
            /*if($cungongyi){
                $seller->processing_type = $cungongyi;
            }*/
            $ok = $seller->save();
        }else{
           return back();
        }

        // dd($users);
        /*if($req->hasFile('avatar_pic') && $req->file('avatar_pic')->isValid()){
            $users->avatar_pic = $path.$imgname;
        }*/


        if($ok){
            return redirect('/seller/sellerinfo');
        }else{
            return back();
        }
    }
}
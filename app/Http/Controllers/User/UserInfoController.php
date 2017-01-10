<?php

/**
 * HomeController constructor.
 * 个人中心
 * 孙璠
 * 2016.12.21
 */

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
/*use Illuminate\Support\Facades\Auth;*/
use Request;
use Validator;
use DB;
use Auth;
use App\User;
use App\SellerAuthInfo;
use App\Consignee;
use App\Seller;


class UserInfoController extends Controller
{
    public function __construct()
    {
        
    }


    //添加收货地址页面
    protected function getUserAddress()
    {

        $user_id = Auth::user()->id;
        $address = request();
        //获取省份信息
        $province = DB::table('areas')->where('areaType','=',0)->get();
        //获取我的收货地址
        /*$new_consignee = new Consignee();*/
        $address = DB::table('consignees')->where('user_id','=',$user_id)->get();

        foreach($address as $key =>$value){
            $address[$key]->yin_mobile = substr_replace($value->mobile, '****', 3, 4);
        }
        /*var_dump($address);exit;*/
        return view('user.userinfo.user_address',['province'=>$province,'address'=>$address]);
    }

    Protected function getNextarea(){
        $pid = request('provinceId');
        /*求得此id下的子地区*/
        $row = DB::table('areas')->where('parentId','=',$pid)->get();
        echo json_encode($row,JSON_UNESCAPED_UNICODE);exit;


    }

    //提交修改个人地址
    protected function postUserAddress()
    {
        $user_id = Auth::user()->id;
        $request = Request::input();
        $addressid = Request::input('addressId');
       //var_dump($request);exit;
        if($addressid){
            $new_consignee =  Consignee::find($addressid);
            /*$new_consignee->user_id = $this->user_id;*/
            $new_consignee->province = Request::input('addr_ragion');
            $new_consignee->city = Request::input('addr_city');
            $new_consignee->county = Request::input('addr_country');
            $new_consignee->detail_address = Request::input('addr_xxaddr');
            $new_consignee->postcode = Request::input('addr_code');
            $new_consignee->receiver = Request::input('addr_name');
            if(Request::input('addr_tel')){
                $new_consignee->mobile = Request::input('addr_tel');
            }
            if(Request::input('addr_phone0')!=""&& Request::input('addr_phone1')!=""&& Request::input('addr_phone2')!=""){
                $new_consignee->tel1 = Request::input('addr_phone0');
                $new_consignee->tel2 = Request::input('addr_phone1');
                $new_consignee->tel3 = Request::input('addr_phone2');
            }
            if(Request::input('remeber_moren')){
                //把其他的变为不默认的

                $ok1 = DB::table('consignees')->where('user_id','=',$user_id)->update(['is_default'=>0]);
                $new_consignee->is_default = 1;
            }
            $ok = $new_consignee->save();
        }else{
            /*dd($request);*/
            $new_consignee = new Consignee();
            /* $new_consignee->user_id = Auth::user()->id;*/
            $new_consignee->user_id = $user_id;
            $new_consignee->province = Request::input('addr_ragion');
            $new_consignee->city = Request::input('addr_city');
            $new_consignee->county = Request::input('addr_country');
            $new_consignee->detail_address = Request::input('addr_xxaddr');
            $new_consignee->postcode = Request::input('addr_code');
            $new_consignee->receiver = Request::input('addr_name');
            if(Request::input('addr_tel')){
                $new_consignee->mobile = Request::input('addr_tel');
            }
            if(Request::input('addr_phone0')&&Request::input('addr_phone1')&&Request::input('addr_phone2')){
                $new_consignee->tel1 = Request::input('addr_phone0');
                $new_consignee->tel2 = Request::input('addr_phone1');
                $new_consignee->tel3 = Request::input('addr_phone2');
            }
            if(Request::input('remeber_moren')){
                $ok1 = DB::table('consignees')->where('user_id','=',$user_id)->update(['is_default'=>0]);
                $new_consignee->is_default = 1;
            }
            $ok = $new_consignee->save();
        }

        if($ok){
            return redirect('user/address');
        }else{
            return back();
        }
        /*dd($new_consignee);*/

    }

    //删除某个地址
    protected function delAddress(){
        $addrid = Request::all();
        $ok = DB::table('consignees')->where('id','=',$addrid)->delete();
        if($ok){
            exit('1');
        }else{
            exit('-1');
        }
    }

    //设为默认地址
    protected function setDefaultaddr(){
        $addrid = Request::all();
        /*$user_id = $this->user_id;*/
        $user_id = Auth::user()->id;
        $ok1 = DB::table('consignees')->where('user_id','=',$user_id)->update(['is_default'=>0]);
        $ok = DB::table('consignees')->where('id','=',$addrid)->update(['is_default'=>1]);
        if($ok&&$ok1){
            exit('1');
        }else{
            exit('-1');
        }
    }

    //获取某个地址的信息
    protected function getAddrInfo(){
        $addrid = Request::all();
        /*$addrid = request();*/
        /*dd($addrid);*/
        $address = DB::table('consignees')->where('id','=',$addrid)->get();
        /*var_dump($address);exit;*/
        echo json_encode($address,JSON_UNESCAPED_UNICODE);exit;
    }

    //个人资料
    protected function getUserInfo()
    {
        /*$user_id = $this->user_id;*/
        $user_id = Auth::user()->id;
        
        // 个人资料
        $users = User::find($user_id);
        // $users['password'] = substr_replace($users->, replacement, start)
        if($users->birthday == 0){
            $users->birthday = "";
        }else{
            $users->birthday = date('Y-m-d',$users->birthday);
        }
        // $users->tel = '1234586789';
        if($users->tel){
            $users->tel = substr_replace($users->tel,'****',3,4);
        }else{
            $users->tel = "无";
        }
        $sell = new SellerAuthInfo();

        // 公司资料
        $shops = SellerAuthInfo::where('user_id','=',$user_id)->first();
        // dd($shops);
        
        return view('user.userinfo.userInfo',['users'=>$users]);
    }

    // 修改个人资料
    protected function postUserInfo(){
        $req = request();

        $validator = Validator::make($req->all(),
                [
                    'realname'=>'required',
                ],
                [
                    'realname.required'=>'请填写真实姓名',
                ]
            );

        if($validator->fails()){
            return back()->withErrors($validator)->withInput();
       }
//         print_r($_FILES);EXIT;
        $users = User::find($req->user_id);
        if($req->hasFile('avatar_pic') && $req->file('avatar_pic')->isValid()){
            $public_path = public_path();
            $date = date('/Y/m/d/',time());
            $imgname = time().rand(1000,9999).'.png';
            $path = "/assets/uploads/avatars".$date;
            $file_res = $req->file('avatar_pic')->move($public_path.$path,$imgname);
            $users->avatar_pic = $path.$imgname;
        }



        $users->realname = $req->realname;
        $users->user_card = $req->user_card;
        $users->gender = $req->gender;
        $users->birthday = strtotime($req->birthday);
        $users->address = $req->address;
        // dd($users);
        /*if($req->hasFile('avatar_pic') && $req->file('avatar_pic')->isValid()){
            $users->avatar_pic = $path.$imgname;
        }*/

        $ok = $users->save();
        if($ok){
            return redirect('/user');
        }else{
            return back();
        }
    }

    // 公司资料展示
    public function getCompanyInfo(){
        /*$user_id = $this->user_id;*/
        $user_id = Auth::user()->id;
        // $user_id = 3;
        
        $shops = SellerAuthInfo::where('user_id','=',$user_id)->first();
        if(!$shops){
           return view('user.userinfo.company_add',['user_id'=>$user_id,'status'=>1]);
        }

        // dd($shops);
        
        return view('user.userinfo.company_edit',['shops'=>$shops,'user_id'=>$user_id,'status'=>2]);
    }

    // 公司资料提交
    public function postCompanyInfo(){
        $req = request();
       $validator = Validator::make($req->all(),
            [
                'company_name'=>'required',
                'company_code'=>'required'
            ],
            [
                'company_name.required'=>'请填写公司名称',
                'company_code.required'=>'请填写公司组织机构代码'
            ]
        );

       if($validator->fails()){
            return back()->withErrors($validator)->withInput();
       }
       if($req->status == 2){
            $shops = SellerAuthInfo::where('user_id','=',$req->user_id)->first();
            $seller = Seller::where('user','=',$req->user_id)->first();
            $shops->user_id = $req->user_id;
       }else{
            $shops = new SellerAuthInfo();
            /*$shops = new Seller();*/
            $seller = new Seller();
       }
       // dd($files);
       
        $public_path = public_path();
        $date = date('/Y/m/d/',time());
        $path = "/assets/uploads/company/".$date;
        // dd($path);
        // dd($req->file());
        foreach($req->file() as $fk=>$fv){
            $imgname = time().rand(1000,9999).'.png';
            if($req->file($fk)->isValid()){
                $req->file($fk)->move($public_path.$path,$imgname);
                $shops->$fk = $path.$imgname;
            }
        }
        $shops->company_name = $req->company_name;
        $shops->company_code = $req->company_code;
        $users = User::find($req->user_id);
        $users->compony = $req->company_name;
        $uok = $users->save();
        $sok = $shops->save();
        $user_id = Auth::user()->id;
        /*$seller = new Seller();*/
        $seller =  Seller::find($user_id);
        $seller->name = Request::input('company_name');
        $seller->user_id = Auth::user()->id;
        $sellok = $seller->save();


        if($uok && $sok && $sellok){
            return redirect('/user');
        }else{
            return back();
        }
    }

    
}

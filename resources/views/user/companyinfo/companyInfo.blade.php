@extends('_layouts.user')
@section('right-content')
   <script type="text/javascript" src="/assets/shop/js/laydate/laydate.js" ></script>

    <script>
        $(function(){
            
            // $(".orderQihuo .tab .tab_li").click(function(){
            //     //console.log($(this).index());
            //     // console.log({{Session::get('tips')}});
            //     if($(this).index()==0)
            //     {
            //         $(this).addClass("on").siblings("li").removeClass("on");
            //         $(".tab_select:eq(0)").show().siblings(".tab_select").hide();
            //     }
            //     else if($(this).index()==2)
            //     {
            //         $(this).addClass("on").siblings("li").removeClass("on");
            //         $(".tab_select:eq(1)").show().siblings(".tab_select").hide();
            //     }
            // });

            //修改密码
            $(".modify_pass_btn").click(function(){
                $(".mody_pass").show();
                $(".box_shadow").show();
            });
            //修改手机
            $(".modify_tel_btn").click(function(){
                $(".mody_tel").show();
                $(".box_shadow").show();
            });
            //关闭遮罩
            $(".box_shadow,.box_back").click(function(){
                $(".mody_tel").hide();
                $(".mody_pass").hide();
                $(".box_shadow").hide();
            })
            
            $('#ads_clear').css('display','none');

            $(".sctx").each(function(){
                $(this).click(function(){
                    var path_name = $(this).attr('id');
                    $("input[name="+path_name+"]").click();
                });
                
                
            })

             $("input[type='file']").each(function(){
                $(this).change(function(){
                    var cv = $(this).attr('name');
                     var file = this.files[0];
                    var reader = new FileReader();
                    reader.onload = function(e){
                        $('.'+cv).attr('src',e.target.result);
                    }
                    reader.readAsDataURL(file);
                });
          });

        })
    </script>
               <!-- 我的现货 我的期货-->
                <div class="orderQihuo">

                    <ul class="tab clear">
                        <li class="on tab_li"><a href="javascript:;">个人资料</a></li>
                        <li class="line"></li>
                        <li class="tab_li"><a href="javascript:;">公司证件</a></li>
                    </ul>
                    <!--个人资料-->
                    <div class="tab_select per_infor clear" style="display: block;">
                    	<div class="left_zl L">
                    		<table class="zl_table">
                                <form action="/user/userinfo" method="post" enctype="multipart/form-data">                     {!! csrf_field() !!}
                                <input type="hidden" name="user_id" value="{{$users->id}}">
                    			<tr>
                    				<td width="190" align="right">当前头像<em>*</em></td>
                    				<td><div class="span1"><img src="{{$users->avatar_pic}}" width="121" height="121" class="avatar_pic"></div><a href="javascript:;" class="sctx" id="avatar_pic">上传</a>
                                            <input type="file" name="avatar_pic" style="opacity:0">
                                    </td>
                    			</tr>
                    			<tr>
                    				<td align="right">帐号<em>*</em></td>
                    				<td><input type="text" disabled value="{{$users->name}}" style="width: 235px;"></td>
                    			</tr>
                    			<tr>
                    				<td align="right">真实姓名<em>*</em></td>
                    				<td><input type="text" name="realname" value="{{$users->realname}}" style="width: 235px;">
                                    @if ($errors->has('realname'))
                                    <span><font color="red" size="0.9em">{{$errors->first('realname')}}</font></span>
                                    @endif
                                    </td>
                                    
                    			</tr>
                    			<tr>
                    				<td align="right">身份证号</td>
                    				<td><input type="text" name="user_card" value="{{$users->user_card}}" style="width: 235px;"></td>
                    			</tr>
                    			<tr>
                    				<td align="right">性别</td>
                    				<td>
                                        @if ($users->gender == 2)
                    					<label><input type="radio" name="gender" class="radio_btn" value="1"> 男</label>
                    					<label><input type="radio" name="gender" class="radio_btn" checked="checked" value="2"> 女</label>
                                        @else
                                        <label><input type="radio" name="gender" value="1" class="radio_btn" checked="checked"> 男</label>
                                        <label><input type="radio" name="gender" value="2" class="radio_btn"> 女</label>
                                        @endif
                    				</td>
                    			</tr>
                    			<tr>
                    				<td align="right">生日</td>
                    				<td><input type="text" onclick="laydate()" name="birthday" style="width: 235px;" value="{{$users->birthday}}"></td>
                    			</tr>
                    			<tr>
                    				<td align="right">住址</td>
                    				<td><input type="text" name="address" style="width: 345px;" value="{{$users->address}}"></td>
                    			</tr>
                    			<tr>
                    				<td align="right">手机号</td>
                    				<td><span style="padding-right: 10px;">{{$users->tel}}</span><a href="javascript:;" class="modify_tel_btn">修改</a></td>
                    			</tr>
                    			<tr>
                    				<td align="right">密码</td>
                    				<td><span style="padding-right: 10px;">*******</span><a href="javascript:;" class="modify_pass_btn">修改</a></td>
                    			</tr>                                                  
                    			<tr>
                    				<td>&nbsp;</td>
                    				<td><button class="tj_btn">保存</button></td>
                    			</tr>
                                </form>
                    		</table>
                    	</div>
                    	<div class="right_zl R">
                    		<p class="bluefont">说明：<br><br></p>
                    		<p>1. 请选择一张本地图片上传为头像，仅支持JPG、GIF、PNG图片文件，且文件小于5M。<br><br>
2. 只有完善个人资料及所属公司信息后才可在平台进行交易。<br><br>
3. 为确保交易安全，请填写真实信息，我们承诺您的基本信息只交易双方能够看到。</p>
                    	</div>
                    </div>
                    <!--公司证件-->
                    <div class="tab_select per_infor clear">
                    	<table class="zl_table">
                        <form action="/user/postcompany" method="post" enctype="multipart/form-data">
                        {!! csrf_field(); !!}
                        <input type="hidden" value="{{$users->id}}" name="user_id">
                    		<tr>
                    			<td width="100" align="right">
                    				公司名称<em>*</em>
                    			</td>
                    			<td>
                    				<span class="span1"><input type="text" value="{{$users->compony}}" name="company_name" style="width: 280px;"></span>
                                    @if ($errors->has('company_name'))
                                    <span><font color="red" size="0.9em">{{$errors->first('company_name')}}</font></span>
                                    @endif
                    			</td>
                    			<td align="right">
                    				组织机构代码<em>*</em>
                    			</td>
                    			<td>	
                    				<span class="span1"><input type="text" value="{{$shops->company_code}}" name="company_code" style="width: 280px;"></span>
                                    @if ($errors->has('company_code'))
                                    <span><font color="red" size="0.9em">{{$errors->first('company_code')}}</font></span>
                                    @endif
                    			</td>
                    		</tr>
                    	</table>
                    	<table class="zl_table">
                    		<tr>
                    			<td colspan="2" style="font-size: 16px; color: #333333; font-weight: bold; padding:15px 10px;">证件上传</td>
                    		</tr>
                    		<tr>
                    			<td width="100" align="right">
                    				营业执照<em>*</em>
                    			</td>
                    			<td width="240">	
                    				<span class="span1"><img src="{{$shops->licence_path}}" class="licence_path" style="width: 168px; height: 138px;"></span>
                    				<a href="#" class="sctx" id="licence_path">上传</a>
                                    <input type="file" name="licence_path" style="width:100px;opacity:0">
                    			</td>
                    			<td align="right" width="160">
                    				组织机构代码证<em>*</em>
                    			</td>
                    			<td>	
                    				<span class="span1"><img src="{{$shops->code_path}}" class="code_path" style="width: 168px; height: 138px;"></span>
                    				<a href="#" class="sctx" id="code_path">上传</a>
                                    <input type="file" name="code_path" style="width:100px;opacity:0">
                    			</td>
                    		</tr>
                    	</table>
                    	<table class="zl_table">
                    		<tr>
                    			<td width="120" align="right">
                    				公章<em>*</em>
                    			</td>
                    			<td>
                    				<span class="span1"><img src="{{$shops->gong_path}}" class="gong_path" style="width: 128px; height: 128px;"></span>
                    				<a href="#" class="sctx" id="gong_path">上传</a>
                                    <input type="file" name="gong_path" style="width:100px;opacity:0">
                    			</td>
                    			<td width="160" align="right">
                    				合同章<em>*</em>
                    			</td>
                    			<td>	
                    				<span class="span1"><img src="{{$shops->contract_path}}" class="contract_path" style="width: 128px; height: 128px;"></span>
                    				<a href="#" class="sctx" id="contract_path">上传</a>
                                    <input type="file" name="contract_path" style="width:100px;opacity:0">
                    			</td>
                    			<td width="160" align="right">
                    				法人章<em>*</em>
                    			</td>
                    			<td>	
                    				<span class="span1"><img src="{{$shops->owner_path}}" class="owner_path" style="width: 128px; height: 128px;"></span>
                    				<a href="#" class="sctx" id="owner_path">上传</a>
                                    <input type="file" name="owner_path" style="width:100px;opacity:0">
                    			</td>
                    		</tr>
                    		<tr>
                    			<td>&nbsp;</td>
                    			<td colspan="5"><button class="tj_btn">保存</button></td>
                    		</tr>
                              </form>
                    	</table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--modify-->
    <div class="com_div">
    	<div class="box_shadow"></div>
    	<div class="mody_content mody_pass">
    		<div>
    			<h2>修改密码<span class="R">请牢记您修改的密码</span></h2>
    			<table>
    				<tr>
    					<td width="92" align="right">当前密码：</td>
    					<td>xu********</td>
    				</tr>
    				<tr>
    					<td align="right">当前手机号：</td>
    					<td>136****9999 <a class="fsyzm" href="javascript:;">发送验证码</a></td>
    				</tr>
    				<tr>
    					<td align="right">输入验证码：</td>
    					<td><input type="text" name="pass_yzm"></td>
    				</tr>
    				<tr>
    					<td align="right">输入新密码：</td>
    					<td><input type="password" name="pass_pass"></td>
    				</tr>
    				<tr>
    					<td align="right">确认新密码：</td>
    					<td><input type="password" name="pass_oldpass"></td>
    				</tr>
    				<tr>
    					<td colspan="2" align="center"><a href="javascript:;" class="mo_btn gray box_back">取消</a><a href="javascript:;" class="mo_btn">确认修改</a></td>
    				</tr>
    			</table>
    		</div>
    	</div>
    	<div class="mody_content mody_tel">
    		<div>
    			<h2>修改手机号<span class="R">请牢记您修改的手机号码</span></h2>
    			<table>
    				<tr>
    					<td align="right">当前手机号：</td>
    					<td>136****9999 <a class="fsyzm" href="javascript:;">发送验证码</a></td>
    				</tr>
    				<tr>
    					<td align="right">输入验证码：</td>
    					<td><input type="text" name="tel_yzm"></td>
    				</tr>
    				<tr>
    					<td align="right">新手机号：</td>
    					<td><input type="tel" name="tel_newtel"></td>
    				</tr>
    				<tr>
    					<td align="right">确认手机号：</td>
    					<td><input type="tel" name="tel_newteltwo"></td>
    				</tr>
    				<tr>
    					<td colspan="2" align="center"><a href="javascript:;" class="mo_btn gray box_back">取消</a><a href="javascript:;" class="mo_btn">确认修改</a></td>
    				</tr>
    			</table>
    		</div>
    	</div>
    </div>
   
    @endsection
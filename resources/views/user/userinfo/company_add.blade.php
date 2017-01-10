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
                        <li class="tab_li"><a href="/user/userinfo">个人资料</a></li>
                        <li class="line"></li>
                        <li class="on tab_li"><a href="/user/companyinfo">公司证件</a></li>
                    </ul>
                    <!--个人资料-->
                   
                    <!--公司证件-->
                    <div class="tab_select per_infor clear" style="display:block">
                    	<table class="zl_table">
                        <form action="/user/companyinfo" method="post" enctype="multipart/form-data">
                        {!! csrf_field(); !!}
                        <input type="hidden" value="{{$user_id}}" name="user_id">
                        <input type="hidden" value="{{$status}}" name="status">
                    		<tr>
                    			<td width="100" align="right">
                    				公司名称<em>*</em>
                    			</td>
                    			<td>
                    				<span class="span1"><input type="text" value="" name="company_name" style="width: 280px;"></span>
                                    @if ($errors->has('company_name'))
                                    <br><span><font color="red" size="0.9em">{{$errors->first('company_name')}}</font></span>
                                    @endif
                    			</td>
                    			<td align="right">
                    				组织机构代码<em>*</em>
                    			</td>
                    			<td>	
                    				<span class="span1"><input type="text" value="" name="company_code" style="width: 280px;"></span>
                                    @if ($errors->has('company_code'))
                                    <br><span><font color="red" size="0.9em">{{$errors->first('company_code')}}</font></span>
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
                    				<span class="span1"><img src="" class="licence_path" style="width: 168px; height: 138px;"></span>
                    				<a href="#" class="sctx" id="licence_path">上传</a>
                                    <input type="file" name="licence_path" style="opacity:0">
                    			</td>
                    			<td align="right" width="160">
                    				组织机构代码证<em>*</em>
                    			</td>
                    			<td>	
                    				<span class="span1"><img src="" class="code_path" style="width: 168px; height: 138px;"></span>
                    				<a href="#" class="sctx" id="code_path">上传</a>
                                    <input type="file" name="code_path" style="opacity:0">
                    			</td>
                    		</tr>
                    	</table>
                    	<table class="zl_table">
                    		<tr>
                    			<td width="100" align="right">
                    				公章<em>*</em>
                    			</td>
                    			<td>
                    				<span class="span1"><img src="" class="gong_path" style="width: 128px; height: 128px;"></span>
                    				<a href="#" class="sctx" id="gong_path">上传</a>
                                    <input type="file" name="gong_path" style="opacity:0">
                    			</td>
                    			<td align="right">
                    				合同章<em>*</em>
                    			</td>
                    			<td>	
                    				<span class="span1"><img src="" class="contract_path" style="width: 128px; height: 128px;"></span>
                    				<a href="#" class="sctx" id="contract_path">上传</a>
                                    <input type="file" name="contract_path" style="opacity:0">
                    			</td>
                    			<td align="right">
                    				法人章<em>*</em>
                    			</td>
                    			<td>	
                    				<span class="span1"><img src="" class="owner_path" style="width: 128px; height: 128px;"></span>
                    				<a href="#" class="sctx" id="owner_path">上传</a>
                                    <input type="file" name="owner_path" style="opacity:0">
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
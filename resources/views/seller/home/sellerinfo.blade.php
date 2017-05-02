@extends('_layouts.shop')

@section('main-content')
    <!-- content-->
    <div class="meCenIndex_con mid_div min_w marok spQihuoXundanDet">    	
	    <!--标题-->
        <div class="tit">
            <img src="/assets/shop/img/shangpu/sptit.jpg"/>
            <p class="line"></p>
        </div>
        <div class="content clear">
            @include('_layouts.seller_left')   
            <div class="R">
             <script>
        $(function(){

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

            $(document).on('click', '.edit_gy', function() {
//function code here.
                $(".box_shadow").show();
                $(".box_content").show();
            });
            
            $(".box_shadow,.back_infor").click(function(){
                $(".box_shadow").hide();
                $(".box_content").hide();
            });
            $(".add_gy").click(function(){
                var name=$("input[name='gy_name']").val();
                var price=$("input[name='gy_price']").val();
                if(name=="")
                {
                    return false;
                }
                if(price=="")
                {
                    return false;
                }
                /*var str='<div class="L div1"><input type="hidden" name="gyname" value="'+name+'"><input type="hidden" name="gyprice" value="'+price+'"><span class="s01">'+name+'</span><span class="s02">'+price+'</span><div class="delete_btn"></div>';*/
                var str='<div class="L div1"><span class="s01">'+name+'</span><span class="s02">'+price+'</span><div class="delete_btn"></div>';
                var str1='<div class="hehe" data="'+name+'"><input type="hidden" name="gyname[]" value="'+name+'"><input type="hidden" name="gyprice[]" value="'+price+'"></div>';
				$(".add_gyjg").append(str);
				$(".haha").append(str1);
                $("input[name='gy_name']").val("");
                $("input[name='gy_price']").val("");
            });
            $(".submit_infor").click(function(){
                var str="";
				var str1=[];
				var pricea=[];
                $(".add_gyjg .s01").each(function(){
                    str+='<span class="gyspan">'+$(this).html()+'</span>';
					//str1+=$(this).html();
                });


                str+='<a href="javascript:;" class="edit_gy">编辑</a>';

				$(".add_gyjg .div1").each(function(index,e){
					//str+='<span class="gyspan">'+$(this).html()+'</span>';
					str1[index]=$(this).children(".s01").html();
					pricea[index]=$(this).children(".s02").html();
				});
				console.log(str1);
				console.log(pricea);

                $(".gyjg_show").html(str);
                $(".box_shadow").hide();
                $(".box_content").hide();



            });
            $(document).on('click', '.delete_btn', function() {
                $(this).parent(".div1").remove();
            });
            
            $("input[name='sfxy']").change(function(){
                //console.log($(this).val());
                if($("input[name='sfxy']:checked").val())
                {
                    //console.log(1);
                    $(".sfxy_div").show();
                }
                else
                {
                    $(".sfxy_div").hide();
                }
            });
			/*$('#baocun').on('click',function(){
				$('form[name=sellerinfo]').submit();
			});*/
			//
			/*$('.bluefont').on('click', function () {
				var $v;
				$('input[name=jyfs]').each(function (k,v) {

					//$v=$(v);
					if(v.checked){
						console.log(v);
					}
				});
			});*/

        })
    </script>
                <!-- 企业资料 -->
                <div class="orderQihuo">
                    <ul class="tab clear">
                        <li class="on"><a href="javascript:;">企业资料</a></li>
                    </ul>
                    <div class="tab_select per_infor clear" style="display: block;">
						<form action="/seller/sellerinfo" method="post" enctype="multipart/form-data" name="sellerinfo">
                			<div class="left_zl L">

								<input type="hidden" name="_token" value="{{csrf_token()}}">
								<table class="zl_table">
									<tr>
										<td width="210" align="right">企业logo<em>*</em></td>
										<td><div class="span1"><img src="{{$sellerinfo->logo_pic}}" width="121" height="121" class="logo_pic"></div>
										<a href="javascript:;" class="sctx" id="logo_pic">上传</a>
										<input type="file" name="logo_pic" style="opacity:0">
										</td>
									</tr>
									<tr>
										<td align="right">公司名称<em>*</em></td>
										<td>{{$sellerinfo->name or ''}}</td>
										{{--<td><input type="text" name="name" value="{{$sellerinfo->name}}" style="width: 235px;"></td>--}}
									</tr>
									<tr>
										<td align="right">公司简称<em>*</em></td>
										<td><input type="text" name="gsjc" value="{{$sellerinfo->short_name or ''}}" style="width: 100px;"></td>
									</tr>
									<tr>
										<td align="right">主营产品</td>
										<td><input type="text" name="zycp" value="{{$sellerinfo->business_product or ''}}" style="width: 235px;"></td>
									</tr>
									<tr>
										<td align="right">经营方式</td>
										<td>
											<label class="disinblock"><input type="checkbox" name="jyfs[]" class="check_btn" <?php if($show_jyfs)if(in_array("现货销售",$show_jyfs))echo "checked" ?> value="现货销售"> 现货销售</label>
											<label class="disinblock"><input type="checkbox" name="jyfs[]" class="check_btn" <?php if($show_jyfs)if(in_array("期货销售",$show_jyfs))echo "checked" ?> value="期货销售"> 期货销售</label>
										</td>
									</tr>
									<tr>
										<td align="right">物流</td>
										<td>
											<label class="disinblock"><input type="checkbox" name="wl[]" class="check_btn" value="自己提供物流" <?php if ($show_wl)if(in_array("自己提供物流",$show_wl))echo "checked" ?>> 自己提供物流</label>
											<label class="disinblock"><input type="checkbox" name="wl[]" class="check_btn" value="平台物流" <?php if ($show_wl)if(in_array("平台物流",$show_wl))echo "checked" ?>> 平台物流</label>
											<label class="disinblock"><input type="checkbox" name="wl[]" class="check_btn" value="买家自提" <?php if ($show_wl)if(in_array("买家自提",$show_wl))echo "checked" ?>> 买家自提</label>
										</td>
									</tr>
									{{--<tr>
										<td align="right">工艺加工</td>
										<td><div class="gyjg_show">
											<span class="gyspan">倒角</span>
											<span class="gyspan">防腐</span>
											<span class="gyspan">切割</span>
											<a href="javascript:;" class="edit_gy">编辑</a>
										</div>
											<div style="display:none" class="haha">


											</div>
										</td>
									</tr>--}}
									<tr>
										<td align="right">经营地区</td>
										<td><input type="text" name="jydq" value="{{$sellerinfo->business_area or ''}}" style="width: 235px;"></td>
									</tr>
									<tr>
										<td width="210" align="right">地图图片<em>*</em></td>
										<td><div class="span1"><img src="{{$sellerinfo->address_pic or ''}}" width="210" height="130" class="address_pic"></div>
											<a href="javascript:;" class="sctx" id="address_pic">上传</a>
											<input type="file" name="address_pic" style="opacity:0">
										</td>
									</tr>
									<tr>
										<td align="right">公司简介</td>
										<td><textarea name="gsjj" style="width: 336px; height: 115px;">{{$sellerinfo->summary or ''}}</textarea></td>
									</tr>
									<tr>
										<td align="right" style="vertical-align: top;">是否为协议商</td>
										<td>
											<label class="disinblock"><input  type="checkbox" name="sfxy" class="check_btn" <?php if($sellerinfo->level !=0)echo "checked" ?>> 协议商家</label>
											<!--<div class="sfxy_div" style="padding-top: 15px;">-->

												<label class="sfxy_div disinblock"><input type="radio" class="radio_btn" name="dengji" value="1" <?php if($sellerinfo->level ==1)echo "checked" ?>> 一级</label>
												<label class="sfxy_div disinblock"><input type="radio" class="radio_btn" name="dengji" value="2" <?php if($sellerinfo->level ==2)echo "checked" ?>> 二级</label>
												<label class="sfxy_div disinblock"><input type="radio" class="radio_btn" name="dengji" value="3" <?php if($sellerinfo->level ==3)echo "checked" ?>> 三级</label>
										</td>
									</tr>
									<tr>
										<td>&nbsp;</td>
										<td style="padding: 20px 10px 50px 10px;"><button class="tj_btn">保存</button></td>
									</tr>
								</table>
						</form>
							</div>
							<div class="right_zl R">
								<p class="bluefont">说明：<br><br></p>
								<p>1. 请选择一张本地图片上传为头像，仅支持JPG、GIF、PNG图片文件，且文件小于5M。<br><br>
	2. 只有完善个人资料及所属公司信息后才可在平台进行交易。<br><br>
	3. 为确保交易安全，请填写真实信息，我们承诺您的基本信息只交易双方能够看到。</p>
							</div>
						</div>

					</div>

				</div>
			</div>
		</div>
		<!--box-->
		<div class="com_div">
			<div class="box_shadow"></div>
			<div class="box_content" style="width: 460px; margin-left: -250px; padding-bottom: 60px; height: 260px; bottom: auto;">
				<div style="width: 460px;">
					<h2 style="font-size: 18px;">工艺加工</h2>
					<div class="add_gyjg clear" style="margin-top: 35px; margin-bottom: 35px;">
							<div class="L">已添加：</div>
							{{--<div class="L div1">
								<input type="hidden" name="gongyi[]" value="哈哈哈">
								<input type="hidden" name="price[]" value="呵呵呵">
								<span class="s01">倒角</span><span class="s02">180</span>
								<div class="delete_btn"></div>
							</div>
							<div class="L div1">
								<span class="s01">倒角</span><span class="s02">180</span>
								<div class="delete_btn"></div>
							</div>
							<div class="L div1">
								<span class="s01">倒角</span><span class="s02">180</span>
								<div class="delete_btn"></div>
							</div>--}}
					</div>

				<div class="gy_tianjia">
					<span>工艺:</span><span><input name="gy_name" type="text" value=""></span>
					<span>单价：</span><span><input name="gy_price" type="text" value=""></span><span>元/吨</span>
					<a href="javascript:;" class="add_gy add_btn">添加</a>
				</div>
				<div class="clear operate_btn">
					<button type="button" class="fabubtn gray back_infor">取消</button>
					<button type="button" class="fabubtn submit_infor">确认</button>
				</div>
			</div>
		</div>
	</div>


    @endsection

@section('footer')
    @include('_layouts.shop_footer2')
@endsection
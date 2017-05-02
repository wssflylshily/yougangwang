@extends('_layouts.shop')
	<!-- <meta name="_token" content="{{ csrf_token() }}"/> --> 

@section('main-content')
		<script type="text/javascript" src="/assets/shop/js/laydate/laydate.js" ></script>
		<script type="text/javascript" src="/assets/shop/js/wirte.js" ></script>
		<script type="text/javascript">
			$(function(){
				//数量单位
				$("input[name='shuliang']").change(function(){
					$(".shuliang_danwei").html($(this).val());
				});
				//定尺判断
				$("input[name='dingchi']").change(function(){
					if($(this).val()==1)
					{
						$(".dingchi_chicun").show();
					}
					else
					{
						$(".dingchi_chicun").hide();
					}
					//$(".shuliang_danwei").html($(this).val());
				});
				//添加钢厂
				$(".add_gangchang").click(function(){
					$(".box_shadow").show();
					$(".box_content").show();
				});
				$(".box_shadow,.gangchang_cancel_btn").click(function(){
					$(".box_shadow").hide();
					$(".box_content").hide();
				});
				$(".gc_ul li").click(function(){
					var str="<span>已选择：</span>";
					$(this).toggleClass("on");
					
					$(".gc_ul li.on").each(function(){
						str+="<span>"+$(this).html()+"</span>";
					});
					
					$(".gc_pass_select").html(str);
				})
				$(".gangchang_ok_btn").click(function(){
					var str="";
					$(".gc_ul li.on").each(function(){
						str+=$(this).html()+",";
					});
					str = str.substring(0,str.length-1);
					$('input[name="steelmill"]').val(str);
					$(".gangchang .gangchang_content").html(str);
					$(".box_shadow").hide();
					$(".box_content").hide();
				});
				$('select[name="region"]').on('change',function(){
					var str = "";
					$('select[name="city"]').html("");
					var areaid = $(this).val();
					$.ajax({
						type:"GET",
						url:"{{route('shop.futures.getCities')}}",
						data:{areaId:areaid},
						datatype: "json",
						success:function(json){
							var data = JSON.parse(json);
							if(data!=""){
								for(var i=0;i<data.length;i++){
									str += '<option value="'+data[i].areaId+'" data-name="'+data[i].areaName+'">'+data[i].areaName+'</option>';
								}
								$('select[name="city"]').append(str);
							}
						}
					});
				});
				//发布按钮
				$("#publish_order").click(function(){
					var region=$("select[name='region'] :selected").attr("data-name");	//地区
					var area_id=$("select[name='region']").val();	//地区
					if(area_id==""){
						write_alert("请选择地区");
						return false;
					}
					var city=$("select[name='city'] :selected").attr("data-name");		//城市
					var city_id=$("select[name='city']").val();		//城市
					if(city_id==""){
						write_alert("请选择城市");
						return false;
					}
					var variety=$("select[name='variety']").val();	//品种
					if(variety==""){
						write_alert("请选择品种");
						return false;
					}
					var standard=$("select[name='standard']").val();//标准
					if(standard==""){
						write_alert("请选择标准");
						return false;
					}
					var material=$("select[name='material']").val();//材质
					if(material==""){
						write_alert("请选择材质");
						return false;
					}
					var gangchang = $('input[name="steelmill"]').val();//钢厂
					if(gangchang==""){
						write_alert("请选择钢厂");
						return false;
					}
					//console.log(region);return;
					//var gangchang="";
					//gangchang=$(".gangchang .gangchang_content").html();//钢厂
					//console.log(gangchang);
					var waijing_x=$("input[name='waijing_x']").val();
					if(waijing_x==""){
						write_alert("请填写外径");
						return false;
					}
					//var waijing_d=$("input[name='waijing_d']").val();
					var houdu_x=$("input[name='houdu_x']").val();
					if(houdu_x==""){
						write_alert("请填写厚度");
						return false;
					}
					//var houdu_d=$("input[name='houdu_d']").val();
					
					var dingchi_pd=$("input[name='dingchi']:checked").val();
					var dingchi_x=$("input[name='dingchi_x']").val();
					if(dingchi_x==""){
						write_alert("请填写长度");
						return false;
					}
					var dingchi_d=$("input[name='dingchi_d']").val();
					if(dingchi_pd==2)
					{
						//dingchi_x=0;
						dingchi_d="";
					}else{
						if(dingchi_d==""){
							write_alert("请填写长度最大值");
							return false;
						}
					}
					
					var shuliang_dw=$("input[name='shuliang']:checked").val();

					var unit = shuliang_dw;
					
					var shuliang_num=$("input[name='shuliang_num']").val();
					if(shuliang_num==""){
						write_alert("请填写数量");
						return false;
					}
					
					var wucha_x=$("input[name='wucha_x']").val();
					if(wucha_x==""){
						write_alert("请填写允差");
						return false;
					}
					//var wucha_d=$("input[name='wucha_d']").val();
					
					var date_start=$("input[name='date_start']").val();
					if(date_start==""){
						write_alert("请选择交货日期");
						return false;
					}
					//var date_end=$("input[name='date_end']").val();
					//console.log(region+" "+city+" "+variety+" "+standard+" "+material+" "+waijing_d+" "+waijing_d+" "+houdu_x+" "+houdu_d+" "+dingchi_pd+" "+dingchi_x+" "+dingchi_d+" "+shuliang_dw+" "+shuliang_num+" "+wucha_x+" "+wucha_d+" "+date_start+" "+date_end);
					//联系人
					var lxr_name=$("input[name='lxr_name']").val();
					if(lxr_name==""){
						write_alert("请填写联系人姓名");
						return false;
					}
					var lxr_tel=$("input[name='lxr_tel']").val();
					if(lxr_tel==""){
						write_alert("请填写联系电话");
						return false;
					}else if(!/^(((13[0-9]{1})|(15[0-9]{1})|(18[0-9]{1}))+\d{8})$/.test(lxr_tel)){
						write_alert("请填写正确的手机号");
						return false;
					}
					
					var lxr_addr=$("input[name='lxr_addr']").val();
					if(lxr_addr==""){
						write_alert("请填写收货地址");
						return false;
					}
					var lxr_code=$("input[name='lxr_code']").val();
					if(lxr_code==""){
						write_alert("请填写邮编");
						return false;
					}
					var infos = {region:region,
							area_id:area_id,
							city_id:city_id,
							city:city,
							variety:variety,
							standard:standard,
							material:material,
							gangchang:gangchang,
							waijing:waijing_x,
							houdu:houdu_x,
							lengthtype:dingchi_pd,
							length:dingchi_x,
							lengthmax:dingchi_d,
							unit:shuliang_dw,
							stock:shuliang_num,
							wucha:wucha_x,
							date_start:date_start,
							name:lxr_name,
							tel:lxr_tel,
							addr:lxr_addr,
							code:lxr_code,
							_token:"{{ csrf_token() }}"
							};
					//console.log(infos);return;
					$.ajax({
						type:"POST",
						url:"{{route('shop.futures.addFuture')}}",
						data:infos,
						datatype: "json",//"xml", "html", "script", "json", "jsonp", "text".
						success:function(json){
							location.href = "{{route('shop.futures.publish2')}}";
							/*console.log(json);
							if(json.status==1){
								//alert(json.status);
								
								
							}*/
						},
						error: function(){
						}
					});
					//console.log(lxr_name+" "+lxr_tel+" "+lxr_addr+" "+lxr_code);
					//location.href = "/futures/publish2";
				});
			});
		</script>
		<div class="shop_car order_confirm order_com mid_div">
			<div class="com_title">
				<img src="/assets/shop/img/qhtitle1_03.png">
			</div>
			<div class="contract futures_fb clear" style="border: 1px solid #416ccb;">
				<div class="L left_div com_kj">
					<div>
						<span>地区</span><span><select name="region"><option>全部</option>@foreach($areas as $area)<option value="{{$area->areaId}}" data-name="{{ $area->areaName }}">{{ $area->areaName }}</option>@endforeach</select></span>
						<span class="s01">城市</span><span><select name="city"><option>全部</option></select></span>
						<span class="s01">品种</span><span><select name="variety"><option>全部</option>@foreach($varieties as $variety)<option>{{$variety->name}}</option>@endforeach</select></span>
					</div>
					<div>
						<span>标准</span><span><select name="standard"><option>全部</option>@foreach ( $standards as $standard)<option>{{$standard->name}}</option>@endforeach</select></span>
						<span class="s01">材质</span><span><select name="material"><option>全部</option> @foreach ( $materials as $material)<option>{{$material->name}}</option>@endforeach</select></span>
					</div>
					<div class="clear">
						<div class="L leftone" style="height: auto; padding-right: 0px; border: none;">钢厂</div>
						<div class="L lefttwo gangchang">
							<span class="s02 gangchang_content"></span>
							<span class="s02 add_gangchang" style="border: 1px solid #ddd; padding-left: 5px; border-radius: 4px; cursor: pointer;">+添加/修改</span>
							<input type="hidden" name="steelmill" value="" />
						</div>
					</div>
					<div class="clear">
						<div class="L leftone">规格</div>
						<div class="L lefttwo">
							<div>
								<span>外径</span>
								<span><input type="text" name="waijing_x" value=""></span>
								<span>mm</span>
								<!--<span>~</span>
								<span><input type="text" name="waijing_d" value=""></span>
								<span>mm</span>-->
							</div>
							<div>
								<span>厚度</span>
								<span><input type="text" name="houdu_x" value=""></span>
								<span>mm</span>
								<!--<span>~</span>
								<span><input type="text" name="houdu_d" value=""></span>
								<span>mm</span>-->
							</div>
						</div>
					</div>
					<div class="clear">
						<div class="L leftone">长度</div>
						<div class="L lefttwo">
							<div>
								<span><input type="radio" class="radio_btn" name="dingchi" value="1" checked="checked" id="dingchi_0"></span>
								<span>不定尺</span>
								<span class="s02"><input type="radio" class="radio_btn" name="dingchi" id="dingchi_1" value="2"></span>
								<span>定尺</span>
							</div>
							<div>
								<span><input type="text" name="dingchi_x" value=""></span>
								<span>m</span>
								<span class="dingchi_chicun">~</span>
								<span class="dingchi_chicun"><input type="text" name="dingchi_d" value=""></span>
								<span class="dingchi_chicun">m</span>
							</div>
						</div>
					</div>
					<div class="clear">
						<div class="L leftone">数量</div>
						<div class="L lefttwo">
							<div>
								<span><input type="radio" checked="checked" class="radio_btn" name="shuliang" id="shuliang_0" value="吨"></span>
								<span>吨数</span>
								<span class="s02"><input type="radio" class="radio_btn" name="shuliang" id="shuliang_1" value="支"></span>
								<span>支数</span>
							</div>
							<div>
								<span><input type="text" value="" name="shuliang_num"></span>
								<span class="shuliang_danwei">吨</span>
								<span class="s02">允差（±）</span>
								<span><input type="text" name="wucha_x" value=""></span>
								<span>%</span>
								<!--<span>~</span>
								<span><input type="text" name="wucha_d" value=""></span>
								<span>%</span>-->
							</div>
						</div>
					</div>
					<div>
						<span>交货日期</span>
						<span><input name="date_start" value="" onclick="laydate()" type="text" placeholder="选择开始日期" /></span><span class="s01">（合同生效之日起）</span>
						<!--<span>~</span>
						<span><input name="date_end" value="" onclick="laydate()" type="text" placeholder="选择结束日期" /></span><span class="s01">（合同生效之日起）</span>-->
					</div>
				</div>
				<div class="R right_div">
					<div class="contact_div">
						<h2><span>联系人信息</span></h2>
						<div><input type="text" name="lxr_name" placeholder="填写联系人姓名" value="" /></div>
						<div><input type="text" name="lxr_tel" placeholder="填写联系人联系方式" value="" /></div>
						<div><input type="text" name="lxr_addr" placeholder="填写收货地址" value="" /></div>
						<div><input type="text" name="lxr_code" placeholder="填写邮编" value="" /></div>
					</div>
					<div class="fabu_btn"><a id="publish_order" href="javascript:;">发布订单</a></div>
				</div>
				
			</div>
			<!--广告推荐-->
			<div class="advert">
				<ul class="clear">
					<li class="L">
						<div><a href="#"><img src="/assets/shop/img/dt_14.jpg"></a></div>
					</li>
					<li class="L">
						<div><a href="#"><img src="/assets/shop/img/dt_14.jpg"></a></div>
					</li>
					<li class="L">
						<div><a href="#"><img src="/assets/shop/img/dt_14.jpg"></a></div>
					</li>
				</ul>
			</div>
			<div class="index_div" style="margin: 20px 0px 20px 60px;">
				<div class="shop futures_shop">
					<ul class="clear">
						@foreach($sellers as $seller)
						<li>
							<a href="{{ route('shop.shop.home', ['seller_id'=>$seller->id]) }}">
								<div class="img_div"><img src="{{ $seller->logo_pic }}" onerror="javascript:this.src='/assets/shop/img/hb_18.png';"></div>
								<h2>{{ $seller->name or ''}}</h2>
								<div class="com_star">
	                        		@for($i=0;$i<($seller->credit_degree);$i++)
	                                <span class="on"></span>
	                                @endfor
	                                @for($j=0;$j<(5-$seller->credit_degree);$j++)
									<span class="off"></span>
									@endfor
								</div>
								<h3>主营：{{ $seller->business_product or ''}}</h3>
								<!-- <h3>历史交易：36890单</h3> -->
							</a>
						</li>
						@endforeach
						<li style="width: 550px;">
							<a href="#" style="padding: 0px; height: 100%;">
								<img src="/assets/shop/img/dt_14.jpg" width="100%" height="100%">
							</a>
						</li>
					</ul>
				</div>
			</div>
		</div>
		<!--select_gangchang-->
		<div class="com_div">
			<div class="box_shadow"></div>
			<div class="box_content" style="width: 650px; margin-left: -345px;">
				<div class="gc_select" style="width: 650px;">
					<h2>选择钢厂</h2>
					<div class="gc_pass_select"><span>已选择：</span></div>
					<div>
						<ul class="gc_ul">
							@foreach($steelmills as $steelmill)<li>{{$steelmill->name}}</li>@endforeach
						</ul>
					</div>
					<div class="operate_btn"><a href="javascript:;" class="fabubtn gray gangchang_cancel_btn">取消</a><a href="javascript:;" class="fabubtn gangchang_ok_btn">确定</a></div>
				</div>
			</div>
		</div>
@endsection
	
	@section('footer')		
		<!--footer-->
		@include('_layouts.shop_footer1')
	@endsection
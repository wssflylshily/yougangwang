@extends('_layouts.shop')
@section('main-content')
		<script type="text/javascript" src="/assets/shop/js/laydate/laydate.js" ></script>
		<script type="text/javascript">
			$(function(){
				//添加钢厂
				$(".add_gangchang").click(function(){
					$("#gangchang_id").show();
					$("#add_infor_content").hide();
				});
				$(".gangchang_cancel_btn").click(function(){
					$("#gangchang_id").hide();
					$("#add_infor_content").show();
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
					$(".gangchang .gangchang_content").html(str);
					$(".box_content").hide();
					$("#add_infor_content").show();
				});
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
				//推送判断
				$("input[name='tsway']").change(function(){
					if($(this).val()==1){
						$(".futures_fb .select_num em").html(" 0 ");
					}else{
						$(".futures_fb .select_num em").html(" "+$(".gangchang_ul li.on").length+" ");
					}
				});
				//添加
				$("#open_add_infor").click(function(){
					$("#add_infor_content").show();
					$(".box_shadow").show();
				});
				//查找商家
				$("#open_search").click(function(){
					$("#search_shoper").show();
					$(".box_shadow").show();
				});
				//关闭
				$(".back_infor,.box_shadow").click(function(){
					$("#add_infor_content").hide();
					$("#search_shoper").hide();
					$("#gangchang_id").hide();
					$(".box_shadow").hide();
				});
				
				//选择地区城市
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
				//添加期货
				$("#fabu_infor").click(function(){
					var region=$("select[name='region'] :selected").attr('data-name');
					var area_id=$("select[name='region']").val();
					if(area_id==""){
						write_alert("请选择地区");
						return false;
					}
					var city=$("select[name='city'] :selected").attr('data-name');
					var city_id=$("select[name='city']").val();
					if(city_id==""){
						write_alert("请选择城市");
						return false;
					}
					var variety=$("select[name='variety']").val();
					if(variety==""){
						write_alert("请选择品种");
						return false;
					}
					var standard=$("select[name='standard']").val();
					if(standard==""){
						write_alert("请选择标准");
						return false;
					}
					var material=$("select[name='material']").val();
					if(material==""){
						write_alert("请选择材质");
						return false;
					}
					var gangchang="";
					gangchang = $(".gangchang .gangchang_content").html();
					if(gangchang==""){
						write_alert("请选择钢厂");
						return false
					}
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
						//dingchi_x="";
						dingchi_d="";
					}else{
						if(dingchi_d==""){
							write_alert("请填写长度最大值");
							return false;
						}
					}
					
					var shuliang_dw=$("input[name='shuliang']:checked").val();
					var unit = shuliang_dw;
					/*if(shuliang_dw=="支"){
						unit = 1;
					}*/
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
//					console.log(region+" "+city+" "+variety+" "+standard+" "+material+" "+waijing_x+" "+waijing_d+" "+houdu_x+" "+houdu_d+" "+dingchi_pd+" "+dingchi_x+" "+dingchi_d+" "+shuliang_dw+" "+shuliang_num+" "+wucha_x+" "+wucha_d+" "+date_start+" "+date_end);	
					var stra="";
					if(dingchi_d=="")
					{
						stra='<div class="nine L">'+waijing_x+'*'+houdu_x+'*'+dingchi_x*100+'</div>';
					}
					else
					{
						stra='<div class="nine L">'+waijing_x+'*'+houdu_x+'*'+dingchi_x*100+'~<br>'+waijing_x+'*'+houdu_x+'*'+dingchi_d*100+'</div>';
					}
					var str='<li class="clear"><div class="one single_txt L">'+region+'</div><div class="two single_txt L">'+variety+'</div><div class="three single_txt L">'+standard+'</div><div class="four single_txt L">'+material+'</div><div class="five single_txt L">'+gangchang+'</div>'+stra+'</div><div class="six L">'+shuliang_num+shuliang_dw+'</div><div class="seven single_txt L">'+wucha_x+'</div><div class="ten L">'+date_start+'</div></li>';
					$(".show_eleven .list ul").append(str);
					$(".box_shadow").hide();
					$(".box_content").hide();

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
							unit:unit,
							stock:shuliang_num,
							wucha:wucha_x,
							date_start:date_start,
							/*name:lxr_name,
							tel:lxr_tel,
							addr:lxr_addr,
							code:lxr_code,*/
							_token:"{{ csrf_token() }}"
						};
					
					$.ajax({
						type:"POST",
						url:"/futures/addFutureDetail",
						data:infos,
						datatype: "json",//"xml", "html", "script", "json", "jsonp", "text".
						success:function(json){
							//location.href = "/futures/addFutureDetail/";
						},
						error: function(){
						}
					});

					
				});
				
				//添加推送商家
				$("#shoper_add").click(function(){
					$(".box_shadow").hide();
					$("#search_shoper").hide();					
					var str="";
					var sellers_id = "";
					$(".gangchang_ul li.on").each(function(){
						str+="<li>"+$(this).find("h2").html()+"</li>";	
						sellers_id += $(this).attr('data-id')+"|";				
					});
					sellers_id = sellers_id.substring(0,sellers_id.length-1);
					$('#sellers_id').val(sellers_id);
					if($(".gangchang_ul li.on").length==0)
					{
						str="<li>暂未选择商家</li>";
					}
					$(".futures_fb .select_div ul").html(str);
					$(".futures_fb .select_num em").html(" "+$(".gangchang_ul li.on").length+" ");
				});
				//添加商家
				$(".gangchang_ul li").click(function(){
					$(this).toggleClass("on");
					if($(".gangchang_ul li.on").length==$(".gangchang_ul li").length)
					{
						$("input[name='checkall']").attr("checked","checked");
						console.log(3);
					}
					else
					{
						$("input[name='checkall']").removeAttr("checked");
					}
				});
				
				$("input[name='checkall']").change(function(){
					if($("input[name='checkall']:checked").val()==1)
					{
						console.log(1);
						$(".gangchang_ul li").addClass("on");
					}
					else{
						console.log(2);
						$(".gangchang_ul li").removeClass("on");
					}
				});
				//确认发布
				$('.czbtn1').click(function(){
					var detail = $('#detail').val();
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
					var way = $("input[name='way']:checked").val();
					var tsway = $("input[name='tsway']:checked").val();
					var sellers = $('#sellers_id').val();
					var data = {
						_token:"{{ csrf_token() }}",
						detail:detail,
						name:lxr_name,
						tel:lxr_tel,
						addr:lxr_addr,
						code:lxr_code,
						way:way,
						tsway:tsway,
						sellers:sellers
					}
					$.post('/futures/addFutureOrder',data).success(function(data){
						
						location.href = "{{ route('user.futures') }}";
					});
					//location.href = "/futures/takeOrder";
					
				});
			})
		</script>
		<div class="shop_car order_com mid_div">
			<ul class="step_icon nine_step clear">
				<li class="cur">发布期货</li>
				<li>商家接单 </li>
				<li>电子合同 </li>
				<li>付款</li>
				<li>生产期货</li>
				<li>物流查询</li>
				<li>收货</li>
				<li>发票处理</li>
				<li>交易完成</li>
			</ul>
			<div class="com_title">
				<img src="/assets/shop/img/qhtitle1_03.png">
			</div>
			<div class="com_content com_div futures_fb clear">
				<h2 class="h201">优钢网真诚为您服务！</h2>
				<h3 class="h301"><img src="/assets/shop/img/person/danger.jpg">我们提示您：期货信息发布期限为15天，若15内无商家接单，请您更新订单信息</h3>
				<div class="clear" style="text-align: right;"><a href="#" class="add_a" id="open_add_infor">+ 添加</a></div>
				<div class="list_eleven show_eleven" style="margin-top: 10px;">
					<div class="eleven_t clear">
						<div class="one L">地区</div>
						<div class="two L">品种</div>
						<div class="three L">标准</div>
						<div class="four L">材质</div>
						<div class="five L">钢厂</div>
						<div class="nine L">规格（mm*mm*mm）</div>
						<!--<div class="eight L">长度</div>-->
						<div class="six L">数量</div>
						<div class="seven L">允差（±%）</div>
						<div class="ten L">交货日期</div>
					</div>
					<div class="list">
						<ul>
							@foreach($futures as $future)
							<li class="clear">
								<div class="one single_txt L">{{ $future->area or '全部'}}</div>
								<div class="two single_txt L">{{$future->variety or '全部'}}</div>
								<div class="three single_txt L">{{$future->standard or '全部'}}</div>
								<div class="four single_txt L">{{$future->material or '全部'}}</div>
								<div class="five single_txt L">{{$future->steelmill or '全部'}}</div>
								<div class="nine L">
								@if($future->length_type==1)
								{{ $future->outer_diameter}}*{{$future->thickness}}*{{$future->length*100 }} ~ {{ $future->outer_diameter}}*{{$future->thickness}}*{{$future->max_length*100 }}
								@else
								{{ $future->outer_diameter}}*{{$future->thickness}}*{{$future->length*100 }}
								@endif
								</div>								
								<!--<div class="eight L">69</div>-->								
								<div class="six L">{{$future->stock}}{{$future->unit}}</div>
								<div class="seven single_txt L">{{$future->deviation}}</div>
								<div class="ten L"><?php echo substr($future->delivery_date,0,10); ?></div>
							</li>
							@endforeach
						</ul>
					</div>
					<div class="mess_div clear">
						<div class="L">
							<div>详细说明：</div>
							<div class="two_div">
								<textarea id="detail"></textarea>
							</div>
						</div>
						<div class="R">
							<div>
								<span>联系人：</span><span><input type="text" value="{{ $order->linkman or '' }}" name="lxr_name" style="width: 255px;"></span>
							</div>
							<div>
								<span>联系方式：</span><span><input type="text" value="{{ $order->mobile or '' }}" name="lxr_tel" style="width: 240px;"></span>
							</div>
							<div>
								<span>邮编： </span><span><input type="text" value="{{ $order->zip_code or '' }}" name="lxr_code" style="width: 266px;"></span>
							</div>
							<div>
								<span>收货地址： </span><span><input type="text" value="{{ $order->address or '' }}" name="lxr_addr" style="width: 240px;"></span>
							</div>
						</div>
					</div>					
				</div>
				<div>
					<div class="com_distance">
						<span>提货方式:</span>
						<span><input type="radio" checked="checked" name="way" value="1" class="radio_btn"> 自提</span>
						<span><input type="radio" name="way" value="2" class="radio_btn"> 送货上门</span>
					</div>
					<div class="com_distance">
						<span>推送方式:</span>
						<span><input type="radio" name="tsway" value="1" class="check_btn"> 自动推送(按地区)</span>
						<span><input type="radio" checked="checked" name="tsway" value="2" class="check_btn"> 选择商家推送</span>
						<span class="select_num">
							已选 <em> 0 </em>家
							<div class="select_div">
								<div class="sj"></div>
								<ul>
								<li class="single_txt">暂未选择商家</li>
									<!-- <li class="single_txt">天津华远兴业</li>
									<li class="single_txt">山东鲁业</li>
									<li class="single_txt">天津派普斯</li> -->
								</ul>
							</div>
							<input type="hidden" id="sellers_id" value="" />
						</span>
						<span><button class="czbtn" id="open_search">查找商家</button></span>
					</div>
					<div class="com_distance" style="text-align: right;">
						<button class="czbtn1">确认发布</button>
					</div>
				</div>
			</div>
			
		</div>
		
		<div class="com_div futures_fb">
			<!--期货添加-->
			<div class="box_shadow"></div>
			<div id="add_infor_content" class="box_content" style="padding-bottom: 60px;">
				<div>
					<h2 class="titleh2">添加期货</h2>
					<div class="left_div com_kj" style="width: 740px;">
						<div>
							<span>地区</span><span><select name="region"><option>全部</option>@foreach($areas as $area)<option value="{{ $area->areaId}}" data-name="{{ $area->areaName }}">{{ $area->areaName }}</option>@endforeach</select></span>
							<span class="s01">城市</span><span><select name="city"><option>全部</option></select></span>
							<span class="s01">品种</span><span><select name="variety"><option>全部</option>@foreach($varieties as $variety)<option>{{$variety->name}}</option>@endforeach</select></span>
						</div>
						<div>
							<span>标准</span><span><select name="standard"><option>全部</option>@foreach ( $standards as $standard)<option>{{$standard->name}}</option>@endforeach</select></span>
							<span class="s01">材质</span><span><select name="material"><option>全部</option>@foreach ( $materials as $material)<option>{{$material->name}}</option>@endforeach</select></span>
					</div>
						<div class="still_mill clear">
							<div class="L leftone" style="height: auto; padding-right: 0px; border: none;">钢厂</div>
							<div class="L lefttwo gangchang" style="width: 660px;">
								<span class="s02 gangchang_content"></span>
								<span class="s02 add_gangchang" style="border: 1px solid #ddd; padding-left: 5px; border-radius: 4px; cursor: pointer;">+添加/修改</span>
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
					<div class="clear operate_btn">
						<button type="button" class="fabubtn gray back_infor">返回</button>
						<button type="button" class="fabubtn" id="fabu_infor">确认添加</button>
					</div>
				</div>
			</div>
			<!--search_shoper-->
			<div id="search_shoper" class="box_content" style="padding-bottom: 60px;">
				<div class="com_kj">
					<h3 class="com_distance">选择推送商家 <span><select><option>选择钢厂</option>@foreach($steelmills as $steelmill)<option>{{$steelmill->name}}</option>@endforeach</select></span>
						<span class="R"><input type="checkbox" class="check_btn" value="1" name="checkall"> 全部推送</span>
					</h3>
					
					<div>
						<ul class="gangchang_ul">
							@foreach($suppliers as $item)
							<li data-id="{{$item->id}}">
								<div class="img_div"><img src="{{$item->logo_pic}}"></div>
								<h2>{{$item->name}}</h2>
								<h3>主营：{{$item->business_product}}</h3>
							</li>
							@endforeach
							<!-- <li>
								<div class="img_div"><img src="/assets/shop/img/hb_18.png"></div>
								<h2>黑龙江建龙钢铁</h2>
								<h3>主营：管材</h3>
							</li>
							<li>
								<div class="img_div"><img src="/assets/shop/img/hb_18.png"></div>
								<h2>黑龙江建龙钢铁</h2>
								<h3>主营：管材</h3>
							</li>
							<li>
								<div class="img_div"><img src="/assets/shop/img/hb_18.png"></div>
								<h2>黑龙江建龙钢铁</h2>
								<h3>主营：管材</h3>
							</li> -->
						</ul>
					</div>
					
					<div class="clear operate_btn">
						<button type="button" class="fabubtn gray back_infor">取消</button>
						<button type="button" class="fabubtn" id="shoper_add">确认</button>
					</div>
				</div>
			</div>
			<div id="gangchang_id" class="box_content" style="width: 650px; margin-left: -345px; z-index: 21;">
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
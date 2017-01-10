@extends('_layouts.shop')
@php($active = 'stocks')

@section('main-content')
		<!--select-->
		<div class="mid_div exchange com_div">
			<form action="/stocks" method="get">
			<div class="select_div">
				<div>
					<select name="province">
						<option value="0">选择地区</option>
						@foreach($provinces as $province)
							<option @if($province->areaId == Request::input('province')) selected @endif value="{{ $province->areaId }}">{{ $province->areaName }}</option>
						@endforeach
					</select>
				</div>
				<div class="div1">-</div>
				<div>
					<select name="city">
						@if(Request::input('city') && isset($cities))
							@foreach($cities as $city)
								<option @if(Request::input('city') == $city->areaId)selected @endif value="{{ $city->areaId }}">{{ $city->areaName }}</option>
							@endforeach
						@else
						<option value="0">选择城市</option>
						@endif
					</select>
				</div>
				<div>
					<select class="w1" name="variety">
						<option value="0">选择品种</option>
						@foreach ( config('const.goods_variety') as $variety)
							<option @if (Request::input('variety') == $variety) selected @endif >{{ $variety }}</option>
						@endforeach
					</select>
				</div>
				<div>
					<select class="w1" name="standard">
						<option value="0">选择标准</option>
						@foreach ( config('const.goods_standard') as $standard)
							<option @if (Request::input('standard') == $standard) selected @endif >{{ $standard }}</option>
						@endforeach
					</select>
				</div>
				<div>
					<select class="w1" name="material">
						<option value="0">选择材质</option>
						@foreach ( config('const.goods_material') as $material)
							<option @if (Request::input('material') == $material) selected @endif >{{ $material }}</option>
						@endforeach
					</select>
				</div>
				<div>
					<select class="w1" name="steelmill">
						<option value="0">选择钢厂</option>
						@foreach ( config('const.goods_steelmill') as $steelmill)
							<option @if (Request::input('steelmill') == $steelmill) selected @endif >{{ $steelmill }}</option>
						@endforeach
					</select>
				</div><br>
				<div>外径</div>
				<div>
					<select name="outer_diameter1">
						<option value="0">选择外径</option>
						@foreach ( config('const.goods_outer_diameter1') as $outer_diameter)
							<option @if (Request::input('outer_diameter1') == $outer_diameter) selected @endif >{{ $outer_diameter }}</option>
						@endforeach
					</select>
				</div>
				<div class="div1">-</div>
				<div>
					<select class="w2"  name="outer_diameter2">
						<option value="0">选择外径</option>
						@foreach ( config('const.goods_outer_diameter2') as $outer_diameter)
							<option @if (Request::input('outer_diameter2') == $outer_diameter) selected @endif >{{ $outer_diameter }}</option>
						@endforeach
					</select>
				</div>
				<div class="div1">mm</div>
				<div></div>
				<div>厚度</div>
				<div>
					<select class="w2" name="thickness1">
						<option value="0">选择厚度</option>
						@foreach ( config('const.goods_thickness1') as $thickness)
							<option @if (Request::input('thickness1') == $thickness) selected @endif >{{ $thickness }}</option>
						@endforeach
					</select>
				</div>
				<div class="div1">-</div>
				<div>
					<select class="w2" name="thickness2">
						<option value="0">选择厚度</option>
						@foreach ( config('const.goods_thickness2') as $thickness)
							<option @if (Request::input('thickness2') == $thickness) selected @endif >{{ $thickness }}</option>
						@endforeach
					</select>
				</div>
				<div class="div1">mm</div>
				<div></div>
				<div>长度</div>
				<div>
					<select class="w2" name="length1">
						<option value="0">选择长度</option>
						@foreach ( config('const.goods_length1') as $length)
							<option @if (Request::input('length1') == $length) selected @endif >{{ $length }}</option>
						@endforeach
					</select>
				</div>
				<div class="div1">-</div>
				<div>
					<select class="w2" name="length2">
						<option value="0">选择长度</option>
						@foreach ( config('const.goods_length2') as $length)
							<option @if (Request::input('length2') == $length) selected @endif >{{ $length }}</option>
						@endforeach
					</select>
				</div>
				<div class="div1">m</div><br>
				<div>价格（出厂价）</div>
				<div>
					<select class="w2" name="price1">
						<option value="0">选择价格</option>
						@foreach ( config('const.goods_price1') as $price)
							<option @if (Request::input('price1') == $price) selected @endif >{{ $price }}</option>
						@endforeach
					</select>
				</div>
				<div class="div1">-</div>
				<div>
					<select class="w2" name="price2">
						<option value="0" >选择价格</option>
						@foreach ( config('const.goods_price2') as $price)
							<option @if (Request::input('price2') == $price) selected @endif >{{ $price }}</option>
						@endforeach
					</select>
				</div>
				<div class="div1">mm</div>
				<div></div>
				<div class="div1">
					<select class="w3" name="search_key">
						<option @if (Request::input('search_key') == 'name') selected @endif value="name">产品</option>
						<option @if (Request::input('search_key') == 'steelmill') selected @endif value="steelmill">钢厂</option>
					</select>
				</div><div class="div1"><input type="text" name="search_content" placeholder="输入搜索内容" value="@if (Request::input('search_content') != null){{ Request::input('search_content') }}@endif"></div>
				<div class="div1"><button class="btn" type="submit" id="search_btn">搜索</button></div>
			</div>
			</form>
			<!--search_content-->
			<form action="{{ route('shop.order.checknow.post') }}" method="post">
			<div class="list_eleven">
				<div class="eleven_t clear">
					<div class="one L xl_menu"><span class="s0">地区</span>
						<div class="xl_div">
							<ul>
								<li class="clear"><input class="check_btn" type="checkbox" value=""><span>全部</span></li>
								<li class="clear"><input class="check_btn" type="checkbox" value=""><span>天津</span></li>
								<li class="clear"><input class="check_btn" type="checkbox" value=""><span>北京</span></li>
							</ul>
						</div>
					</div>
					<div class="two L xl_menu"><span class="s0">品种</span>
						<div class="xl_div">
							<ul>
								<li class="clear"><input class="check_btn" type="checkbox" value=""><span>全部</span></li>
								@foreach ( config('const.goods_variety') as $variety)
									<li class="clear"><input class="check_btn" type="checkbox" value=""><span>{{ $variety }}</span></li>
								@endforeach
							</ul>
						</div>
					</div>
					<div class="three L xl_menu"><span class="s0">标准</span>
						<div class="xl_div">
							<ul>
								<li class="clear"><input class="check_btn" type="checkbox" value=""><span>全部</span></li>
								<li class="clear"><input class="check_btn" type="checkbox" value=""><span>天津</span></li>
								<li class="clear"><input class="check_btn" type="checkbox" value=""><span>北京</span></li>
							</ul>
						</div>
					</div>
					<div class="four L xl_menu"><span class="s0">材质</span>
						<div class="xl_div">
							<ul>
								<li class="clear"><input class="check_btn" type="checkbox" value=""><span>全部</span></li>
								<li class="clear"><input class="check_btn" type="checkbox" value=""><span>天津</span></li>
								<li class="clear"><input class="check_btn" type="checkbox" value=""><span>北京</span></li>
							</ul>
						</div>
					</div>
					<div class="five L xl_menu"><span class="s0">外径</span>
						<div class="xl_div">
							<ul>
								<li class="clear"><input class="check_btn" type="checkbox" value=""><span>全部</span></li>
								<li class="clear"><input class="check_btn" type="checkbox" value=""><span>天津</span></li>
								<li class="clear"><input class="check_btn" type="checkbox" value=""><span>北京</span></li>
							</ul>
						</div>
					</div>
					<div class="six L xl_menu"><span class="s0">厚度</span>
						<div class="xl_div">
							<ul>
								<li class="clear"><input class="check_btn" type="checkbox" value=""><span>全部</span></li>
								<li class="clear"><input class="check_btn" type="checkbox" value=""><span>天津</span></li>
								<li class="clear"><input class="check_btn" type="checkbox" value=""><span>北京</span></li>
							</ul>
						</div>
					</div>
					<div class="seven L xl_menu"><span class="s0">长度</span>
						<div class="xl_div">
							<ul>
								<li class="clear"><input class="check_btn" type="checkbox" value=""><span>全部</span></li>
								<li class="clear"><input class="check_btn" type="checkbox" value=""><span>天津</span></li>
								<li class="clear"><input class="check_btn" type="checkbox" value=""><span>北京</span></li>
							</ul>
						</div>
					</div>
					<div class="eight L xl_menu"><span class="s0">钢厂</span>
						<div class="xl_div">
							<ul>
								<li class="clear"><input class="check_btn" type="checkbox" value=""><span>全部</span></li>
								<li class="clear"><input class="check_btn" type="checkbox" value=""><span>天津</span></li>
								<li class="clear"><input class="check_btn" type="checkbox" value=""><span>北京</span></li>
							</ul>
						</div>
					</div>
					<div class="nine L xl_menu"><span class="s0">供应商</span>
						<div class="xl_div">
							<ul>
								<li class="clear"><input class="check_btn" type="checkbox" value=""><span>全部</span></li>
								<li class="clear"><input class="check_btn" type="checkbox" value=""><span>天津</span></li>
								<li class="clear"><input class="check_btn" type="checkbox" value=""><span>北京</span></li>
							</ul>
						</div>
					</div>
					<div class="ten L"><span class="s01">吨数</span></div>
					<div class="eleven L"><span class="s01">价格</span></div>
				</div>
				<div class="list">
					<ul id="exchanlist">
						@foreach ($goods as $good)
							<li class="clear">
								<div class="one single_txt L">{{ $good->areaName or '未知' }}</div>
								<div class="two single_txt L">{{ $good->variety or '未知' }}</div>
								<div class="three single_txt L">{{ $good->standard or '未知' }}</div>
								<div class="four single_txt L">{{ $good->material or '未知' }}</div>
								<div class="five single_txt L">{{ $good->outer_diameter or '未知' }}</div>
								<div class="six single_txt L">{{ $good->thickness or '未知' }}</div>
								<div class="seven single_txt L">{{ $good->length or '未知' }}</div>
								<div class="eight single_txt L">{{ $good->steelmill or '未知' }}</div>
								<div class="nine single_txt L" style="width: 205px;">{{ $good->seller->name or '未知' }}</div>
								<div class="ten single_txt L">{{ $good->stock or '未知' }} 吨</div>
								<div class="eleven single_txt L" style="width: 113px;"><i>{{ $good->price or '未知' }}</i> 元/@if($good->unit == 2)支@else吨@endif</div>
								<div class="twelve single_txt L"><a href="javascript:;" data_id="{{ $good->id }}"></a></div>
							</li>
						@endforeach
					</ul>
				</div>
			</div>

			<!-- 分页-->
			<div class="fenyeArea clear">
				{!! $goods->appends(Request::query())->render() !!}
			</div>
			<!--购物车购买-->
			<div class="box_shadow"></div>
			<div class="car_div">
				<h2>选择购买吨数</h2>
				<input type="hidden" name="buy_id" value="" id="buy_id">
				<div class="div1">购买吨数 <input type="number" name="buy_number" value="1"></div>
				<div class="car_btn clear">
					<a href="javascript:;" class="L add_car">加入购物车</a>
					{{--<a href="javascript:;" class="R a01">立即支付</a>--}}
					<input  class="R a01" type="submit" value="立即支付" >
					<input type="hidden" value="{{ csrf_token() }}" name="_token" >
				</div>
			</div>
			</form>
		</div>

		<!-- Toaster -->
		<script src="/plugins/jquery-toaster/jquery.toaster.js"></script>

		<!-- pages script -->
<!--		<script src="/assets/base.js"></script>-->
		<script src="/assets/shop/js/pages/cart.js"></script>

		<script>
			 function forbiddenScroll(){
			        return false;
			 }
			$(function(){
				$("#exchanlist li a").click(function(){
					$(".exchange .box_shadow").show();
					$(".exchange .car_div").show();
					$(".exchange .car_div .add_car").attr("data_id",$(this).attr("data_id"));
					$("#buy_id").attr("value",$(this).attr("data_id"));
					$('body').on('mousewheel',forbiddenScroll);
				});
				$(".exchange .box_shadow").click(function(){
					$(".exchange .box_shadow").hide();
					$(".exchange .car_div").hide();
					$('body').off('mousewheel',forbiddenScroll);
				});
				//加入购物车
				$(".add_car").click(function(){
					var add_id=$(this).attr("data_id");
					var add_num=$("input[name='buy_number']").val();
					$(".exchange .box_shadow").hide();
					$(".exchange .car_div").hide();
					$('body').off('mousewheel',forbiddenScroll);

					var cart = new Cart();
					cart.add(add_id, add_num);
				});


				//搜索
				$("#search_btn").click(function(){
					//$("#")
					var district=$("select[name='district']");
					var city=$("select[name='city']");
					var kind=$("select[name='kind']");
					var standar=$("select[name='standar']");
					var material=$("select[name='material']");
					var gangchang=$("select[name='gangchang']");
					var waijing_x=$("select[name='waijing_x']");
					var waijing_d=$("select[name='waijing_d']");
					var houdu_x=$("select[name='houdu_x']");
					var houdu_d=$("select[name='houdu_d']");
					var changdu_x=$("select[name='changdu_x']");
					var changdu_d=$("select[name='changdu_d']");
					var price_x=$("select[name='price_x']");
					var price_d=$("select[name='price_d']");
					var search_kind=$("select[name='search_kind']");
					var search_content=$("input[name='search_content']");
//					console.log(district.val()+" "+city.val()+" "+kind.val()+" "+standar.val()+" "+material.val()+" "+gangchang.val()+" "+waijing_x.val()+" "+waijing_d.val()+" "+houdu_x.val()+" "+houdu_d.val()+" "+changdu_x.val()+" "+changdu_d.val()+" "+price_x.val()+" "+price_d.val()+" "+search_kind.val()+" "+search_content.val()+" ");
				});
				
			})
             $('select[name="province"]').on('change',function(){
                 var areaid = $(this).val();
                 $.ajax({
                     type:"GET",
                     url:"{{route('shop.area.city')}}",
                     data:{areaId:areaid},
                     datatype: "json",
                     success:function(json){
                         var data = JSON.parse(json);
                         console.log(data);
                         if(data != null){
                             var str = "";
                             for(var i=0;i<data.length;i++){
                                 str += '<option value="'+data[i].areaId+'">'+data[i].areaName+'</option>';
                             }
                             $('select[name="city"]').html("");
                             $('select[name="city"]').append(str);
                         }else{
                             var str = '<option value="0">选择城市</option>';
                             $('select[name="city"]').html("");
                             $('select[name="city"]').append(str);
						 }
                     }
                 });
             });
		</script>
	
	@endsection
	
	@section('footer')		
		<!--footer-->
		@include('_layouts.shop_footer1')
	@endsection
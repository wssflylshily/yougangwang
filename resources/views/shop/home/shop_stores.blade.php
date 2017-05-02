@extends('_layouts.shop')

@section('main-content')
		<!-- content-->
		<div class="mid_div marok indexShangjiaCangkuCon indexShangjiaCon">
			<!-- 个人信息-->
			<div class="personInfo clear">
				<p class="headimg L" style="background-image: url({{ $seller->logo_pic or '/assets/shop/img/shangpu/cangku_03.png' }})"></p>
				<ul class="L center">
					<li class="tit">
						<span class="icon"></span>
						<span class="name">{{ $seller->name or '-' }}</span>
						<!--如果是已关注商家，则类名添加一个 yi-->
					{{--<span class="guanzhu">关注商家</span>--}}
					<!--<span class="yiguanzhu">已关注</span>-->
					</li>
					<li class="xinyong clear">
						<div class="L x1">
							信用等级：
							<p class="xinyu">
								@if(!empty($seller->credit_degree))
									@for($i=0;$i<count($seller->credit_degree);$i++)
										<span class="ok"></span>
									@endfor
								@else
									<span class="ok"></span>
								@endif
							</p>
						</div>
						<div class="L x2">
							主营产品：<span>{{ $seller->business_product  or '-' }}</span>
						</div>
					</li>
					<li class="word">
						<span>{{ $seller->summary or '-' }}</span>
						{{--<a href="javascript:;" class="more">[更多]</a>--}}
					</li>
				</ul>
				<ul class="L right">
					<li>
						<span>累计销量：<b>{{ $seller->sale_count or '-' }}</b>吨</span>
					</li>
					{{--<li>
						<a href="javascript:;" class="kefu">在线客服</a>
					</li>--}}
				</ul>
			</div>
			<!-- 搜索区域-->
			<form action="{{ route('shop.shop.stores') }}" method="get">
			<div class="search">
				<ul class="clear line1">
					<li>地区
						<select name="province">
							<option value="0">选择地区</option>
							@foreach($provinces as $province)
								<option @if($province->areaId == Request::input('province')) selected @endif value="{{ $province->areaId }}">{{ $province->areaName }}</option>
							@endforeach
						</select>
					</li>
					<li>城市
						<select name="city">
							@if(Request::input('city') && isset($cities))
								@foreach($cities as $city)
									<option @if(Request::input('city') == $city->areaId)selected @endif value="{{ $city->areaId }}">{{ $city->areaName }}</option>
								@endforeach
							@else
								<option value="0">选择城市</option>
							@endif
						</select>
					</li>
					<li>品种
						<select name="" class="pinzhong">
							<option value="0">选择品种</option>
							@foreach ( $varieties as $variety)
								<option @if (Request::input('variety') == $variety->name) selected @endif >{{ $variety->name }}</option>
							@endforeach
						</select>
					</li>
					<li>材质
						<select name="" class="caizhi">
							<option value="0">选择材质</option>
							@foreach ( $materials as $material)
								<option @if (Request::input('material') == $material->name) selected @endif >{{ $material->name }}</option>
							@endforeach
						</select>
					</li>
					<li>钢厂
						<select name="" class="gangchang">
							<option value="0">选择钢厂</option>
							@foreach ( $steelmills as $steelmill)
								<option @if (Request::input('steelmill') == $steelmill->name) selected @endif >{{ $steelmill->name }}</option>
							@endforeach
						</select>
					</li>
				</ul>
				<ul class="line2 clear">
					<li class="left">
						<ul class="tr">
							<li class="td1">规格</li>
							<li class="td2">
								<ul>
									<li>
										<p class="w">外径 <input type="text" name="outer_diameter1" placeholder="输入外径范围" value="@if (Request::input('outer_diameter1') != null){{ Request::input('outer_diameter1') }}@endif"> mm ~</p>
										<p><input type="text" style="width: 100px;" name="outer_diameter2" placeholder="输入外径范围" value="@if (Request::input('outer_diameter2') != null){{ Request::input('outer_diameter2') }}@endif"> mm</p>

									</li>
									<li>
										<p class="w">厚度 <input type="text" style="width: 100px;" name="thickness1" placeholder="输入厚度范围" value="@if (Request::input('thickness1') != null){{ Request::input('thickness1') }}@endif"> mm ~</p>
										<p><input type="text" style="width: 100px;" name="thickness2" placeholder="输入厚度范围" value="@if (Request::input('thickness2') != null){{ Request::input('thickness2') }}@endif"> mm</p>
									</li>
									<li class="last">
										<p class="w">长度 <input type="text" style="width: 100px;" name="length1" placeholder="输入长度范围" value="@if (Request::input('length1') != null){{ Request::input('length1') }}@endif"> m ~</p>
										<p><input type="text" style="width: 100px;" name="length2" placeholder="输入长度范围" value="@if (Request::input('length2') != null){{ Request::input('length2') }}@endif"> m</p>
									</li>
								</ul>
							</li>
						</ul>
					</li>
					<li class="right">
						价格 <input type="text" style="width: 110px;" name="price1" placeholder="输入价格范围" value="@if (Request::input('price1') != null){{ Request::input('price1') }}@endif">
						- <input type="text" style="width: 110px;" name="price2" placeholder="输入价格范围" value="@if (Request::input('price2') != null){{ Request::input('price2') }}@endif">
					</li>
				</ul>
				<input type="hidden" value="{{ Request::input('seller_id') }}" name="seller_id">
				{{--<a href="javascript:;" class="searchbtn" type="submit" >搜索</a>--}}
				<input class="searchbtn" type="submit" >
			</div>
			</form>
			<!-- 分割线 -->
			<div class="fenge"></div>
			<!-- content-->
			<div class="guan">
				<div class="table">
					<ul class="thead">
						<li class="td1">特卖产品</li>
						<li class="td2">地区</li>
						<li class="td3">品种</li>
						<li class="td4">材质</li>
						<li class="td5">规格</li>
						<li class="td6">钢厂</li>
						<li class="td7">吨数</li>
						<li class="td8">单价</li>
						<li class="td9">查看详情</li>
					</ul>
					<div class="tbody">
						@foreach($goods as $good)
							<ul class="tr">
								<li class="td1">@if($good->type == 9)<span class="temai"></span>@endif</li>
								<li class="td2">{{ $good->areaName }}</li>
								<li class="td3">{{ $good->variety }}</li>
								<li class="td4">{{ $good->material }}</li>
								<li class="td5">{{ $good->length }}*{{ $good->thickness }}*{{ $good->outer_diameter }}</li>
								<li class="td6">{{ $good->seller->name or '未知' }}</li>
								<li class="td7">{{ $good->stock }}</li>
								<li class="td8"><b>{{ $good->price }}</b> 元/吨</li>
								{{--<li class="td9"><a class="add" href="javascript:;"></a></li>--}}
								<li class="td9"><a href="{{ route('shop.special.detail', ['id' => $good->id]) }}">查看详情</a></li>
							</ul>
						@endforeach

					</div>
				</div>
			</div>
			<!-- 分页-->
			{{--<div class="fenyeArea clear">
				<ul class="fenye clear R">
					<li class="on"><a href="#">1</a></li>
					<li><a href="#">2</a></li>
					<li><a href="#">3</a></li>
					<li><a href="#">8</a></li>
					<li><a href="#">9</a></li>
					<li class="last"><a href="#">10</a></li>
				</ul>
			</div>--}}
			<!-- 分页-->
			<div class="fenyeArea clear">
				{!! $goods->appends(Request::query())->render() !!}
			</div>
			<!--购物车购买-->
			{{--<div class="box_shadow"></div>
			<div class="car_div">
				<h2>选择购买吨数</h2>
				<input type="hidden" name="buy_id" value="" id="buy_id">
				<div class="div1">购买吨数 <input type="number" name="buy_number" value="1"></div>
				<div class="car_btn clear">
					<a href="javascript:;" class="L add_car">加入购物车</a>
					--}}{{--<a href="javascript:;" class="R a01">立即支付</a>--}}{{--
					<input  class="R a01" type="submit" value="立即支付" >
					<input type="hidden" value="{{ csrf_token() }}" name="_token" >
				</div>
			</div>--}}
		</div>
		<!-- footer-->
		<!-- 公司详细介绍-->
		{{--<div class="indexShangjiaDetail marok" style="display: none">
			<div class="tit">山东鲁业钢铁销售有限公司</div>
			<div class="con marok">
				<img src="img/shangpu/cangku_03.png" class="logo"/>
				<p>山东鲁业钢铁销售有限公司，坐落于洞山脚下，是一家集钢铁与贸易的达型有限公司，我们出口海内外。每年销售量达1000吨钢材。品种，规格齐全：有无缝管、焊接管、铺管、流体管、管线管等。</p>
				<p>作为省内著名的钢管企业，公司实力雄厚，资源充足，重合同守信用，以质量求生存，以信誉求发展，以优质的产品赢得客户公司秉承“客户的满意，就是我们的追求”“至真、至诚、至信”为服务理念，坚持质量第一、诚信服务、公平竞争、互惠互利、长期合作的服务原则，服务于新老客户。</p>
				<p>服务三保：保证质量、保证时间、保证数量</p>
				<p>服务宗旨：雄厚的实力、优质的产品、低廉的价格、一流的服务</p>
				<p>郑重承诺：保证以最好的产品、最优的质量、最低的价格、最完善的服务来答谢新老顾客的信赖.</p>
			</div>
			<div class="bot">
				<a href="javascript:;" class="submit">确认</a>
			</div>
		</div>--}}
		<!-- 遮罩-->
		<div id="zhezhao" style="display: none"></div>

		<script>
			//点击 更多 弹出公司详细介绍
			$('.indexShangjiaCon .personInfo  .center .word .more').on('click',function(){
				$('.indexShangjiaDetail').show();
				$('#zhezhao').show();
				$('html,body').css('overflow','hidden');
			});

			//公司详细介绍 点击确认
			$('.indexShangjiaDetail .bot .submit').on('click',function(){
				$('.indexShangjiaDetail').hide();
				$('#zhezhao').hide();
				$('html,body').css('overflow','auto');
			});

			//点击 搜索
			$('.indexShangjiaCangkuCon .search .searchbtn').on('click',function(){
				//loc pinzhong caizhi gangchang waijing1 houdu1 length1 price1
				var loc=$('.indexShangjiaCangkuCon .search .loc').val();
				var pinzhong=$('.indexShangjiaCangkuCon .search .pinzhong').val();
				var caizhi=$('.indexShangjiaCangkuCon .search .caizhi').val();
				var gangchang=$('.indexShangjiaCangkuCon .search .gangchang').val();
				var waijing1=$('.indexShangjiaCangkuCon .search .waijing1').val();
				var waijing2=$('.indexShangjiaCangkuCon .search .waijing2').val();
				var houdu1=$('.indexShangjiaCangkuCon .search .houdu1').val();
				var houdu2=$('.indexShangjiaCangkuCon .search .houdu2').val();
				var length1=$('.indexShangjiaCangkuCon .search .length1').val();
				var length2=$('.indexShangjiaCangkuCon .search .length2').val();
				var price1=$('.indexShangjiaCangkuCon .search .price1').val();
				var price2=$('.indexShangjiaCangkuCon .search .price2').val();

				console.log(loc,pinzhong,caizhi,gangchang);
				console.log(waijing1,waijing2,houdu1,houdu2,length1,length2,price1,price2);
			});

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
	@include('_layouts.shop_footer2')
@endsection

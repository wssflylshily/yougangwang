@extends('_layouts.shop')

@section('main-content')
		<!-- content-->
		<div class="mid_div marok indexShangjiaCon">
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
			<!--服务区块-->
			<!-- <div class="fuwu">
				<p class="tit">山东鲁业真诚为您服务</p>
				<p class="con">
					<span><b></b>我们有最全的货源</span>
					<span><b></b>我们有最优惠价格</span>
					<span><b></b>我们保证正品</span>
				</p>
				<div class="table">
					<ul class="trw">
						<li class="tdw1">
							山东鲁业钢铁销售有限公司
						</li>
						<li class="tdw2">
							<ul class="thead">
								<li class="td1">机组</li>
								<li class="td2">组距（mm）</li>
								<li class="td3">可生产钢种</li>
								<li class="td4">年产量</li>
								<li class="td5">备注</li>
							</ul>
							<div class="tbody">
								<ul class="tr">
									<li class="td1">180机组（Assel连轧机组，可在线正火）</li>
									<li class="td2">60-180</li>
									<li class="td3">J55/N80-1/
										20#/GRB-X60</li>
									<li class="td4">48万吨</li>
									<li class="td5">各规格可生产壁厚明细</li>
								</ul>
								<ul class="tr">
									<li class="td1">273机组（AQ斜轧机组）</li>
									<li class="td2">60-180</li>
									<li class="td3">J55/N80-1/
										20#/GRB-X60</li>
									<li class="td4">48万吨</li>
									<li class="td5">各规格可生产壁厚明细</li>
								</ul>
							</div>
						</li>
					</ul>
				</div>
			</div>
			 -->
			
			@for($i=0;$i<count($groups);$i++)
				<div class="guan">
					<ul class="tit clear">
						<li class="L">{{ $groups[$i]->variety or ''}}</li>
						<li class="R"><a href="{{ route('shop.shop.stores', ['variety' => $groups[$i]->variety, 'seller_id'=>$groups[$i]->seller_id]) }}">查看仓库</a></li>
					</ul>
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
							<li class="td9">操作</li>
						</ul>
						<div class="tbody">
							@foreach($goods[$i] as $good)
							<ul class="tr">
								<li class="td1">@if($good->type==9)<span class="temai"></span>@endif</li>
								<li class="td2">{{ $good->areaName or '-' }}</li>
								<li class="td3">{{ $good->variety or '-' }}</li>
								<li class="td4">{{ $good->material or '-' }}</li>
								<li class="td5">{{ $good->length or ''}}*{{ $good->thickness or ''}}*{{ $good->outer_diameter or ''}}</li>
								<li class="td6">{{ $good->seller->name or '未知' }}</li>
								<li class="td7">{{ $good->stock or '-' }}</li>
								<li class="td8"><b>{{ $good->price or '-' }}</b> 元/吨</li>
								<li class="td9"><a class="add"></a></li>
							</ul>
							@endforeach
						</div>
					</div>
				</div>
			@endfor

			<!-- 联系我们-->
			<div class="contact">
				<ul class="tit clear">
					<li class="line"></li>
					<li class="text"></li>
					<li class="line"></li>
				</ul>
				<div class="bluebd clear">
					{{--<div class="L left" id="allmap"></div>--}}
					<div class="L left"><img style="width: 535px;height: 336px" src="{{ $seller->address_pic or '/assets/shop/img/ditu.png' }}"></div>
					<div class="L right">
						<div class="neirong">
							<p class="tit">{{ $seller->name or '-' }}</p>
							<ul>
								<li>联系电话：{{ $seller->user->mobile or ''}}</li>
								{{--<li>企业邮箱：{{ $seller->user->email or '' }}</li>--}}
								<li>工艺加工：{{ $seller->processing_type or '-' }}</li>
								{{--<li>经营类型：{{ $seller->business_type or '-' }}</li>--}}
								<li>经营地区：{{ $seller->business_area or '-' }}</li>
								{{--<li>仓库地址：山东省济南市黄河南路238号1、2、3号仓库</li>--}}
							</ul>
						</div>
					</div>
				</div>
			</div>
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
			//百度地图API功能
			//加载第一张地图
			var map = new BMap.Map("allmap");            // 创建Map实例
			var point = new BMap.Point(116.404, 39.915);  //通过http://api.map.baidu.com/lbsapi/getpoint/index.html这个网址，更改经纬度
			map.centerAndZoom(point,15);
			map.enableScrollWheelZoom();
			var pt = new BMap.Point(116.404, 39.915);  //通过http://api.map.baidu.com/lbsapi/getpoint/index.html这个网址，更改经纬度
			var myIcon = new BMap.Icon("img/point.png", new BMap.Size(20,25));
			var marker = new BMap.Marker(pt,{icon:myIcon});  // 创建标注
			map.addOverlay(marker);              // 将标注添加到地图中

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
		</script>
@endsection

@section('footer')
	@include('_layouts.shop_footer2')
@endsection
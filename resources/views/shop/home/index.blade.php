@extends('_layouts.shop')
@php($active = 'home')

@section('main-content')
		<!--banner-->
		<div class="mid_div" style="position: relative; margin-top: 2px;">
			<div class="index_xiaoxi" @if(!Auth::check()) style="opacity:0.6;" @endif>
				<h2>消息中心  {{--<a href="#" class="R"><img style="padding-top: 10px;" src="/assets/shop/img/ygsy_05.png" /></a>--}}</h2>
				<div style=" height: 336px; margin-top: 8px; overflow: hidden;" class="msg">
					<ul>
					
						{{--<li><a href="#">2017年4月5日您有来自于天津派普斯有限公司的合同待签约。</a></li>
						<li><a href="#">2017年4月5日您有来自于天津派普斯有限公司的合同待签约。</a></li>
						<li><a href="#">2017年4月5日您有来自于天津派普斯有限公司的合同待签约。</a></li>
						<li><a href="#">2017年4月5日您有来自于天津派普斯有限公司的合同待签约。</a></li>
						<li><a href="#">2017年4月5日您有来自于天津派普斯有限公司的合同待签约。</a></li>
						<li><a href="#">2017年4月5日您有来自于天津派普斯有限公司的合同待签约。</a></li>
						<li><a href="#">2017年4月5日您有来自于天津派普斯有限公司的合同待签约。</a></li>
						<li><a href="#">2017年4月5日您有来自于天津派普斯有限公司的合同待签约。</a></li>--}}
					
					</ul>
				</div>
			</div>
		</div>
		<div id="banner_tabs" class="flexslider">
			<!--
				<div class="mid_div clear" style="margin-top: 10px;">
			<div class="L index_xiaoxi" style="width: 280px;">
				<h2>消息中心</h2>
				
			</div>
			<div class="R" style="width: 900px;">
			-->
		    <ul class="slides">
				{{--@foreach($banners as $banner)--}}
		        <li>
		            <a title="" target="_blank" href="javascript:;">
		                <img src="/assets/shop/img/alpha.png" style="background-image:url(/assets/shop/img/banner2_02.jpg);" />
		            </a>
		        </li>
				<li>
					<a title="" target="_blank" href="javascript:;">
						<img src="/assets/shop/img/alpha.png" style="background-image:url(/assets/shop/img/banner1_02.jpg);" />
					</a>
				</li>
				<li>
					<a title="" target="_blank" href="javascript:;">
						<img src="/assets/shop/img/alpha.png" style="background-image:url(/assets/shop/img/banner3_02.jpg);" />
					</a>
				</li>
				<li>
					<a title="" target="_blank" href="javascript:;">
						<img src="/assets/shop/img/alpha.png" style="background-image:url(/assets/shop/img/banner4_02.jpg);" />
					</a>
				</li>
				{{--@endforeach--}}
		        
		    </ul>
		    <ol id="bannerCtrl" class="flex-control-nav flex-control-paging">
		        <li class="active"><a>1</a></li>
		        <li><a>2</a></li>
		        <li><a>3</a></li>
		        <li><a>4</a></li>
		    </ol>
		</div>
		
		<script src="/assets/shop/js/slider.js"></script>
		<script src="/assets/shop/js/lh.js"></script>
		<!--lit_menu-->
		<div class="index_div mid_div" style="margin-top: 40px;">
			<!--今日特卖-->
			<div class="lit_title">
				<a href="{{ route('shop.special') }}" class="clear"><img src="/assets/shop/img/lit1_03.png" class="img1 L"><span class="font1 L">今日特卖</span><span class="font2 L">Today's special offer</span><img src="/assets/shop/img/index_22.png" class="L img2"></a>
			</div>
			<!--筛选列表-->
			{{--<div class="select_div clear">
				<div class="L">品名:</div>
				<div class="R">
					<ul class="clear">
						<li><a href="#" class="on">全部</a></li>
						<li><a href="#">直缝焊管</a></li>
						<li><a href="#">普通热轧板</a></li>
						<li><a href="#">热轧无缝钢管</a></li>
						<li><a href="#">方管</a></li>
						<li><a href="#">方矩管</a></li>
						<li><a href="#">矩管</a></li>
						<li><a href="#">冷轧不锈钢板卷</a></li>
						<li><a href="#">圆管</a></li>
						<li><a href="#">热镀锌钢管</a></li>
						<li><a href="#">热镀锌卷</a></li>
						<li><a href="#">无缝钢管</a></li>
						<li><a href="#">无缝管</a></li>
						<li><a href="#">线材</a></li>
					</ul>
					--}}{{--<div class="more"><a href="#">更多选项</a></div>--}}{{--
				</div>
			</div>--}}
			<div class="list_nine">
				<div class="nine_t clear">
					<div class="one L">品种</div>
					<div class="two L">规格</div>
					{{--<div class="three L">标准</div>--}}
					<div class="four L">材质</div>
					<div class="five L">钢厂</div>
					<div class="six L">地区</div>
					<div class="seven L">数量</div>
					<div class="eight L">供应商</div>
					<div class="nine L">价格</div>
				</div>
				<div class="list">
					<ul>
						@foreach ($goods as $good)
						<li class="clear">
							<div class="one single_txt L">{{ $good->variety or '其他' }}</div>
							<div class="two single_txt L">9.75×1500</div>
							{{--<div class="three single_txt L">{{ $good->standard or '' }}</div>--}}
							<div class="four single_txt L">{{ $good->material or '' }}</div>
							<div class="five single_txt L">{{ $good->steelmill or '' }}</div>
							<div class="six single_txt L">{{ $good->areaName or '' }}</div>
							<div class="seven single_txt L">{{ $good->stock or '' }} 吨</div>
							<div class="eight single_txt L">{{ $good->seller->name or '未知' }}</div>
							<div class="nine single_txt L"><i>{{ $good->price or '' }}</i> 元/{{ $good->unit == 1 ? '吨' : '支' }}</div>
							<div class="ten single_txt L"><a href="{{ route('shop.special.detail', ['id' => $good->id]) }}">查看详情</a></div>
						</li>
						@endforeach
					</ul>
				</div>
			</div>
			<!--期货动态-->
			<div class="lit_title">
				<a href="{{ route('shop.futures') }}" class="clear"><img src="/assets/shop/img/lit2_10.png" class="img1 L"><span class="font1 L">最新成交信息</span><span class="font2 L">Futures dynamic</span><img src="/assets/shop/img/index_30.png" class="L img2"></a>
			</div>
			<div class="news clear">
				<div class="L">
					<a href="javascript:;"><img src="/assets/shop/img/dt_14.jpg"></a>
				</div>
				<div class="R">
					<ul>
						@foreach ($futures as $future)
						<li>
							<a href="#" class="clear">
								<div class="L one single_txt"><i><?php echo substr($future->created_at,11,5); ?></i></div>
								<div class="L two single_txt">{{ $future->areaName }}</div>
								<div class="L three single_txt">{{ $future->variety }}</div>
								<div class="L four single_txt">{{ $future->standard }}</div>
								<div class="L five single_txt">{{ $future->outer_diameter }}*{{ $future->thickness }}*{{ $future->length }}</div>
								<div class="L six single_txt">{{ $future->stock }}</div>
								<div class="L seven single_txt">交货日期 <em><?php echo substr($future->delivery_date,0,10); ?></em></div>
								<div class="L eight single_txt">{{$future->order->user->realname or ''}}</div>
							</a>
						</li>
						@endforeach
						
					</ul>
				</div>
			</div>
			<!--明星商城-->
			<div class="lit_title">
				<a href="javascript:;" class="clear"><img src="/assets/shop/img/lit2_10.png" class="img1 L"><span class="font1 L">本周明星商城</span><span class="font2 L">Star Shopping Mall</span></a>
			</div>
			<div class="shop clear">
				<div class="L">
					<ul class="clear">
						@foreach($sellers as $seller)
								<li>
									<a href="{{ route('shop.shop.home', ['seller_id'=>$seller->id]) }}">
										<div class="img_div"><img src="{{ $seller->logo_pic }}" onerror="javascript:this.src='/assets/shop/img/hb_18.png';" alt="pic" ></div>
										<h2>{{ $seller->name }}</h2>
										<h3>主营：{{ $seller->business_product }}</h3>
									</a>
								</li>
						@endforeach
						
					</ul>
				</div>
				<div class="R">
					<h2>累计销售 <span><i>{{ $sale->value or 200 }}</i> 吨</span></h2>
					<h2>浏览量 <span><i class="i01">{{ $visits->value or 100 }}</i> 次</span></h2>
				</div>
			</div>
			
			<!--增值服务-->
			<div class="lit_title">
				<a href="javascript:;" style="background: none;" class="clear"><img src="/assets/shop/img/lit2_10.png" class="img1 L"><span class="font1 L">增值服务</span><span class="font2 L">Value-added Services</span></a>
			</div>
			<ul class="clear lit_menu" style="padding-top: 0px;text-align: center;">
				<li class="L">
					<div class=""><a href="javascript:;"><img src="/assets/shop/img/find1.jpg"></a></div>
					<div class="">
						<a href="javascript:;">
						<h2><span>物流服务</span></h2>
						<div class="font">专业配送，让货主省心</div>
						</a>
					</div>
				</li>
				<li class="L">
					<div class=""><a href="javascript:;"><img src="/assets/shop/img/find3.jpg"></a></div>
					<div class="">
						<a href="#">
							<h2><span>委托加工</span></h2>
							<div class="font">创造高技术含量精品钢铁</div>
						</a>
					</div>
				</li>
				<li class="L">
					<div class=""><a href="javascript:;"><img src="/assets/shop/img/find4.jpg"></a></div>
					<div class="">
						<a href="javascript:;">
							<h2><span>金融服务</span></h2>
							<div class="font">助您快速找到资金</div>
						</a>
					</div>
				</li>
				<li class="L">
					<div class=""><a href="javascript:;"><img src="/assets/shop/img/find2.jpg"></a></div>
					<div class="">
						<a href="javascript:;">
						<h2><span>找货服务</span></h2>
						<div class="font">选好钢，享实惠，够省心</div>
						</a>
					</div>
				</li>
				<li class="L">
					<div class=""><a href="javascript:;"><img src="/assets/shop/img/new.png"></a></div>
					<div class="">
						<a href="javascript:;">
							<h2><span>技术服务</span></h2>
							<div class="font">突破创新，开发新技术</div>
						</a>
					</div>
				</li>
			</ul>
		</div>
		
		<script type="text/javascript"> 
			function autoScroll(obj){  
			$(obj).find("ul").animate({
				marginTop : "-42px"  
			},500,function(){  
				$(this).css({marginTop : "0px"}).find("li:first").appendTo(this);  
			})  
			}  
			$(function(){  
				setInterval('autoScroll(".index_xiaoxi")',2000);	  
			})
		</script> 
		
@endsection

@section('footer')
    @include('_layouts.shop_footer1')
@endsection
@extends('_layouts.shop')
@php($active = 'home')

@section('main-content')
		<!--banner-->
		<div id="banner_tabs" class="flexslider">
		    <ul class="slides">
		        <li>
		            <a title="" target="_blank" href="#">
		                <img src="/assets/shop/img/alpha.png" style="background-image:url(/assets/shop/img/banner1.jpg);" />
		            </a>
		        </li>
		        <li>
		            <a title="" href="#">
		                <img src="/assets/shop/img/alpha.png" style="background-image:url(/assets/shop/img/banner1.jpg);" />
		            </a>
		        </li>
		        <li>
		            <a title="" href="#">
		                <img src="/assets/shop/img/alpha.png" style="background-image:url(/assets/shop/img/banner1.jpg);" /></span>
		            </a>
		        </li>
		    </ul>
		    <ol id="bannerCtrl" class="flex-control-nav flex-control-paging">
		        <li class="active"><a>1</a></li>
		        <li><a>2</a></li>
		        <li><a>2</a></li>
		    </ol>
		</div>
		<script src="/assets/shop/js/slider.js"></script>
		<script src="/assets/shop/js/lh.js"></script>
		<!--lit_menu-->
		<div class="index_div mid_div">
			<ul class="clear lit_menu">
				<li class="L">
					<div class="L"><a href="#"><img src="/assets/shop/img/find1.jpg"></a></div>
					<div class="R">
						<a href="#">
						<h2><span>找车</span></h2>
						<div class="font">专业配送，让货主省心</div>
						</a>
					</div>
				</li>
				<li class="L">
					<div class="L"><a href="#"><img src="/assets/shop/img/find2.jpg"></a></div>
					<div class="R">
						<a href="#">
						<h2><span>找货</span></h2>
						<div class="font">选好钢，享实惠，够省心</div>
						</a>
					</div>
				</li>
				<li class="L">
					<div class="L"><a href="#"><img src="/assets/shop/img/find3.jpg"></a></div>
					<div class="R">
						<a href="#">
						<h2><span>找加工</span></h2>
						<div class="font">创造高技术含量精品钢铁</div>
						</a>
					</div>
				</li>
				<li class="L">
					<div class="L"><a href="#"><img src="/assets/shop/img/find4.jpg"></a></div>
					<div class="R">
						<a href="#">
						<h2><span>找资金</span></h2>
						<div class="font">助您快速找到资金</div>
						</a>
					</div>
				</li>
			</ul>
			<!--今日特卖-->
			<div class="lit_title">
				<a href="#" class="clear"><img src="/assets/shop/img/lit1_03.png" class="img1 L"><span class="font1 L">今日特卖</span><span class="font2 L">Today's special offer</span><img src="/assets/shop/img/index_22.png" class="L img2"></a>
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
					<div class="three L">标准</div>
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
							<div class="three single_txt L">{{ $good->standard or '' }}</div>
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
				<a href="#" class="clear"><img src="/assets/shop/img/lit2_10.png" class="img1 L"><span class="font1 L">期货动态</span><span class="font2 L">Futures dynamic</span><img src="/assets/shop/img/index_30.png" class="L img2"></a>
			</div>
			<div class="news clear">
				<div class="L">
					<a href="#"><img src="/assets/shop/img/dt_14.jpg"></a>
				</div>
				<div class="R">
					<ul>
						@foreach ($futures as $future)
						<li>
							<a href="#" class="clear">
								<div class="L one single_txt"><i><?php echo substr($future->created_at,11,6) ?></i></div>
								<div class="L two single_txt">{{ $future->area_id }}</div>
								<div class="L three single_txt">{{ $future->variety }}</div>
								<div class="L four single_txt">{{ $future->standard }}</div>
								<div class="L five single_txt">{{ $future->outer_diameter }}*{{ $future->thickness }}*{{ $future->length }}</div>
								<div class="L six single_txt">{{ $future->stock }}</div>
								<div class="L seven single_txt">交货日期 <em><?php echo substr($future->delivery_date,0,10); ?></em></div>
								<div class="L eight single_txt">张先生</div>
							</a>
						</li>
						@endforeach
						<!-- <li>
							<a href="#" class="clear">
								<div class="L one single_txt"><i>11:50</i></div>
								<div class="L two single_txt">上海北宁</div>
								<div class="L three single_txt">无缝管</div>
								<div class="L four single_txt">#20</div>
								<div class="L five single_txt">19×89×12.3-12.5</div>
								<div class="L six single_txt">50吨</div>
								<div class="L seven single_txt">交货日期 <em>10月5日</em></div>
								<div class="L eight single_txt">张先生</div>
							</a>
						</li>
						<li>
							<a href="#" class="clear">
								<div class="L one single_txt"><i>11:50</i></div>
								<div class="L two single_txt">上海北宁</div>
								<div class="L three single_txt">无缝管</div>
								<div class="L four single_txt">#20</div>
								<div class="L five single_txt">19×89×12.3-12.5</div>
								<div class="L six single_txt">50吨</div>
								<div class="L seven single_txt">交货日期 <em>10月5日</em></div>
								<div class="L eight single_txt">张先生</div>
							</a>
						</li>
						<li>
							<a href="#" class="clear">
								<div class="L one single_txt"><i>11:50</i></div>
								<div class="L two single_txt">上海北宁</div>
								<div class="L three single_txt">无缝管</div>
								<div class="L four single_txt">#20</div>
								<div class="L five single_txt">19×89×12.3-12.5</div>
								<div class="L six single_txt">50吨</div>
								<div class="L seven single_txt">交货日期 <em>10月5日</em></div>
								<div class="L eight single_txt">张先生</div>
							</a>
						</li> -->
					</ul>
				</div>
			</div>
			<!--明星商城-->
			<div class="lit_title">
				<a href="#" class="clear"><img src="/assets/shop/img/lit2_10.png" class="img1 L"><span class="font1 L">明星商城</span><span class="font2 L">Star Shopping Mall</span></a>
			</div>
			<div class="shop clear">
				<div class="L">
					<ul class="clear">
						<li>
							<a href="#">
								<div class="img_div"><img src="/assets/shop/img/hb_18.png"></div>
								<h2>黑龙江建龙钢铁</h2>
								<h3>主营：管材</h3>
							</a>
						</li>
						<li>
							<a href="#">
								<div class="img_div"><img src="/assets/shop/img/hb_20.png"></div>
								<h2>黑龙江建龙钢铁</h2>
								<h3>主营：管材</h3>
							</a>
						</li>
						<li>
							<a href="#">
								<div class="img_div"><img src="/assets/shop/img/hb_20.png"></div>
								<h2>黑龙江建龙钢铁</h2>
								<h3>主营：管材</h3>
							</a>
						</li>
						<li>
							<a href="#">
								<div class="img_div"><img src="/assets/shop/img/hb_20.png"></div>
								<h2>黑龙江建龙钢铁</h2>
								<h3>主营：管材</h3>
							</a>
						</li>
						<li>
							<a href="#">
								<div class="img_div"><img src="/assets/shop/img/hb_20.png"></div>
								<h2>黑龙江建龙钢铁</h2>
								<h3>主营：管材</h3>
							</a>
						</li>
					</ul>
				</div>
				<div class="R">
					<h2>累计销售 <span><i>{{ $sale->value or 200 }}</i> 吨</span></h2>
					<h2>浏览量 <span><i class="i01">{{ $visits->value or 100 }}</i> 次</span></h2>
				</div>
			</div>
		</div>
		
		<!--box-->
		<div class="com_div">
			<div class="box_shadow"></div>
			<div class="box_content" style="width: 1000px; margin-left: -520px; padding-bottom: 60px;">
				<div style="width: 1000px;">
					<div class="index_tab">
						<ul>
							<li class="cur">
								<h2>方案一</h2>
								<h3>同供应商总价排名（升序）</h3>
							</li><li>
								<h2>方案二</h2>
								<h3>同供应商总价排名（升序）</h3>
							</li>
						</ul>
					</div>
					<div class="order_pay shop_car order_com tanchu fangan">	
						<div class="ten_t clear">
							<div class="L one">商家</div>
							<div class="L two">品种</div>
							<div class="L three">标准</div>
							<div class="L four">材质</div>
							<div class="L five">钢厂</div>
							<div class="L six">规格</div>							
							<div class="L eight">吨数</div>
							<div class="L seven">单价(元/吨)</div>
							<div class="L nine">总计</div>
							<div class="L eleven">选择</div>							
						</div>
						<!--订单情况-->
						<div class="order_list">
							<ul class="order_ul">
								<li class="clear shangpin">
									<div>
										<div class="clear">
											<div class="L one single_txt shop_dname">山东鲁业钢铁销售有限公司</div>
										</div>
									</div>
									<div>
										<div class="clear">
											<div class="L two single_txt">无缝管</div>
											<div class="L three single_txt">API 5L</div>
											<div class="L four single_txt">#20</div>
											<div class="L five single_txt">鞍钢</div>
											<div class="L six single_txt">219*9.8*12000</div>											
											<div class="L eight">30</div>
											<div class="L seven single_txt">3120</div>
										</div>
										<div class="clear">
											<div class="L two single_txt">无缝管</div>
											<div class="L three single_txt">API 5L</div>
											<div class="L four single_txt">#20</div>
											<div class="L five single_txt">鞍钢</div>
											<div class="L six single_txt">219*9.8*12000</div>											
											<div class="L eight">30</div>
											<div class="L seven single_txt">31200</div>
										</div>
									</div>
									<div>
										<div class="L nine">￥325000.00</div>
										<div class="L eleven">
											<input type="checkbox" class="check_btn" value="1">
										</div>	
									</div>
								</li>
							</ul>
						</div>
						<div class="order_list">
							<ul class="order_ul">
								<li class="clear shangpin">
									<div>
										<div class="clear">
											<div class="L one single_txt shop_dname">山东鲁业钢铁销售有限公司</div>
										</div>
									</div>
									<div>
										<div class="clear">
											<div class="L two single_txt">无缝管</div>
											<div class="L three single_txt">API 5L</div>
											<div class="L four single_txt">#20</div>
											<div class="L five single_txt">鞍钢</div>
											<div class="L six single_txt">219*9.8*12000</div>
											<div class="L eight">30</div>
											<div class="L seven single_txt">3120</div>											
										</div>
										<div class="clear">
											<div class="L two single_txt">无缝管</div>
											<div class="L three single_txt">API 5L</div>
											<div class="L four single_txt">#20</div>
											<div class="L five single_txt">鞍钢</div>
											<div class="L six single_txt">219*9.8*12000</div>
											<div class="L eight">30</div>
											<div class="L seven single_txt">31200</div>											
										</div>
									</div>
									<div>
										<div class="L nine">￥325000.00</div>
										<div class="L eleven">
											<input type="checkbox" class="check_btn" value="1">
										</div>
									</div>
								</li>
							</ul>
						</div>
					</div>
					<div class="order_pay shop_car order_com tanchu fangan" style="display: none;">	
						<div class="ten_t clear">
							<div class="L one">商家</div>
							<div class="L two">品种</div>
							<div class="L three">标准</div>
							<div class="L four">材质</div>
							<div class="L five">钢厂</div>
							<div class="L six">规格</div>							
							<div class="L eight">吨数</div>
							<div class="L seven">单价(元/吨)</div>
							<div class="L nine">总计</div>
							<div class="L eleven">选择</div>							
						</div>
						<!--订单情况-->
						<div class="order_list">
							<ul class="order_ul">
								<li class="clear shangpin">
									<div>
										<div class="clear">
											<div class="L one single_txt shop_dname">山东鲁业钢铁销售有限公司</div>
										</div>
									</div>
									<div>
										<div class="clear">
											<div class="L two single_txt">无缝管</div>
											<div class="L three single_txt">API 5L</div>
											<div class="L four single_txt">#20</div>
											<div class="L five single_txt">鞍钢</div>
											<div class="L six single_txt">219*9.8*12000</div>											
											<div class="L eight">30</div>
											<div class="L seven single_txt">3120</div>
										</div>
										<div class="clear">
											<div class="L two single_txt">无缝管</div>
											<div class="L three single_txt">API 5L</div>
											<div class="L four single_txt">#20</div>
											<div class="L five single_txt">鞍钢</div>
											<div class="L six single_txt">219*9.8*12000</div>											
											<div class="L eight">30</div>
											<div class="L seven single_txt">31200</div>
										</div>
									</div>
									<div>
										<div class="L nine">￥325000.00</div>
										<div class="L eleven">
											<input type="checkbox" class="check_btn" value="1">
										</div>	
									</div>
								</li>
							</ul>
						</div>
						<div class="order_list">
							<ul class="order_ul">
								<li class="clear shangpin">
									<div>
										<div class="clear">
											<div class="L one single_txt shop_dname">山东鲁业钢铁销售有限公司</div>
										</div>
									</div>
									<div>
										<div class="clear">
											<div class="L two single_txt">无缝管</div>
											<div class="L three single_txt">API 5L</div>
											<div class="L four single_txt">#20</div>
											<div class="L five single_txt">鞍钢</div>
											<div class="L six single_txt">219*9.8*12000</div>
											<div class="L eight">30</div>
											<div class="L seven single_txt">3120</div>											
										</div>
										<div class="clear">
											<div class="L two single_txt">无缝管</div>
											<div class="L three single_txt">API 5L</div>
											<div class="L four single_txt">#20</div>
											<div class="L five single_txt">鞍钢</div>
											<div class="L six single_txt">219*9.8*12000</div>
											<div class="L eight">30</div>
											<div class="L seven single_txt">31200</div>											
										</div>
									</div>
									<div>
										<div class="L nine">￥325000.00</div>
										<div class="L eleven">
											<input type="checkbox" class="check_btn" value="1">
										</div>
									</div>
								</li>
							</ul>
						</div>
					</div>
					
					<div class="clear operate_btn">
						<button type="button" class="fabubtn gray back_infor">取消</button>
						<button type="button" class="fabubtn submit_infor">确定</button>
					</div>
				</div>
			</div>
		</div>
@endsection

@section('footer')
    @include('_layouts.shop_footer1')
@endsection
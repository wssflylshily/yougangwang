@extends('_layouts.shop')

@section('main-content')
		<script type="text/javascript">
			$(function(){
				//查看商家
				$(".check_detail").click(function(){
					$(".box_shadow").show();
					$(".box_content").show();
				});
				$(".box_shadow,.back_infor").click(function(){
					$(".box_shadow").hide();
					$(".box_content").hide();
				});
				//选择商家
				$(".select_shop").click(function(){
					$(".select_shop").removeClass("cur");
					$(this).addClass("cur");
					$(".box_shadow").hide();
					$(".box_content").hide();
					$(".shop_name").html($(this).parents("li").find("shop_dname").html());
				});
			})
		</script>
	
		<div class="shop_car order_com mid_div">
			<ul class="step_icon nine_step clear">
				<li class="pass">发布期货</li>
				<li class="cur">商家接单 </li>
				<li>电子合同 </li>
				<li>付款</li>
				<li>生产期货</li>
				<li>物流查询</li>
				<li>收货</li>
				<li>发票处理</li>
				<li>交易完成</li>
			</ul>
			<div class="com_title">
				<img src="/assets/shop/img/sj_title_03.png">
			</div>
			<div class="com_content com_div futures_fb clear">
				<div class="com_distance">
					<span>订单号：GDYGHT120003765</span>
					<span>起始日期：2016年6月14日</span>
					<span>截止日期：2016年6月29日</span>
					<span>剩余天数：15天</span><br>
					<span>接单商家：<a href="javascript:;" class="shop_name">山东鲁业钢铁销售有限公司</a></span>
					<span><a href="javascript:;">3家</a></span>
					<span><a href="javascript:;" class="check_detail">查看详情</a></span>
				</div>
				<div class="list_eleven" style="margin-top: 0px;">
					<div class="eleven_t clear">
						<div class="one L">地区</div>
						<div class="two L">品种</div>
						<div class="three L">标准</div>
						<div class="four L">材质</div>
						<div class="five L">钢厂</div>
						<div class="nine L">规格（mm*mm*mm）</div>
						<div class="seven L">允差（±%）</div>
						<div class="eight L">吨数（t）</div>
						<div class="ten L">交货日期</div>
					</div>
					<div class="list">
						<ul>
							@foreach($order->futures as $future)
							<li class="clear">
								<div class="one single_txt L">{{$future->area_id}}</div>
								<div class="two single_txt L">{{$future->variety}}</div>
								<div class="three single_txt L">{{$future->standard}}</div>
								<div class="four single_txt L">{{$future->material}}</div>
								<div class="five single_txt L">{{$future->steelmill}}</div>
								<div class="nine single_txt L">@if($future->length_type==1){{ $future->outer_diameter }}*{{ $future->thickness }}*{{ $future->length*100 }}~{{ $future->outer_diameter }}*{{ $future->thickness }}*{{ $future->max_length*100 }}@else{{ $future->outer_diameter }}*{{ $future->thickness }}*{{ $future->length*100 }}@endif</div>
								<div class="seven single_txt L">{{$future->deviation}}</div>
								<div class="eight single_txt L">{{$future->stock}}@if($future->unit==1)支@else吨@endif</div>
								<div class="ten single_txt L"><?php echo substr($future->delivery_date,0,10); ?></div>
							</li>
							@endforeach
						</ul>
					</div>
					<div class="mess_div clear">
						<div class="L">
							<div>详细说明：</div>
							<div class="two_div" style="border: none; padding-top: 0px; width: 920px;">
								<p>{{ $future->detail }}</p>
							</div>
						</div>
					</div>
					<div class="mess_div com_distance" style="padding:10px 20px; margin: 0px;">
						<span class="tit">联系人：   {{ $order->linkman }}</span>
						<span class="tit">联系方式：   {{ $order->mobile }}</span>
						<span class="tit">邮编：   {{ $order->zip_code }}</span>
						<span class="tit">收货地址：   {{ $order->address }}</span>
					</div>
				</div>	
				<div style="text-align: right; padding: 20px;">
					<a href="/futures/signContract" class="com_btn">签约合同</a>
				</div>
			</div>
			
		</div>
		<!--box-->
		<div class="com_div">
			<div class="box_shadow"></div>
			<div class="box_content" style="width: 1000px; margin-left: -520px; padding-bottom: 60px;">
				<div style="width: 1000px;">
					<h2>选择商家</h2>
					<div class="order_pay shop_car order_com tanchu">	
						<div class="ten_t clear">
							<div class="L one">商家</div>
							<div class="L ten">产品信息</div>
							<div class="L seven">价格(元/吨)</div>
							<div class="L eight">交货天数</div>
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
											<div class="L seven single_txt">3120</div>
											<div class="L eight">30</div>
										</div>
										<div class="clear">
											<div class="L two single_txt">无缝管</div>
											<div class="L three single_txt">API 5L</div>
											<div class="L four single_txt">#20</div>
											<div class="L five single_txt">鞍钢</div>
											<div class="L six single_txt">219*9.8*12000</div>
											<div class="L seven single_txt">31200</div>
											<div class="L eight">30</div>
										</div>
									</div>
									<div>
										<div class="L nine"><a href="javascript:;" class="select_shop">选择</a></div>
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
											<div class="L seven single_txt">3120</div>
											<div class="L eight">30</div>
										</div>
										<div class="clear">
											<div class="L two single_txt">无缝管</div>
											<div class="L three single_txt">API 5L</div>
											<div class="L four single_txt">#20</div>
											<div class="L five single_txt">鞍钢</div>
											<div class="L six single_txt">219*9.8*12000</div>
											<div class="L seven single_txt">31200</div>
											<div class="L eight">30</div>
										</div>
									</div>
									<div>
										<div class="L nine"><a href="javascript:;" class="select_shop">选择</a></div>
									</div>
								</li>
							</ul>
						</div>
					</div>
					<div class="clear operate_btn">
						<button type="button" class="fabubtn gray back_infor">取消</button>
					</div>
				</div>
			</div>
		</div>
		<!--footer-->
			@endsection
	
	@section('footer')		
		<!--footer-->
		@include('_layouts.shop_footer1')
	@endsection
		
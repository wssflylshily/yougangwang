@extends('_layouts.shop')

@section('main-content')
		<div class="shop_car order_com order_pay mid_div">
			<ul class="step_icon nine_step clear">
				<li class="pass">发布期货</li>
				<li class="pass">商家接单 </li>
				<li class="pass">电子合同 </li>
				<li class="pass">付款</li>
				<li class="pass">生产期货</li>
				<li class="pass">物流查询</li>
				<li class="cur">收货</li>
				<li>发票处理</li>
				<li>交易完成</li>
			</ul>
			<div class="com_title">
				<img src="/assets/shop/img/qrsh_03.png">
			</div>
			<div style=" width: 1131px; margin: -37px 0px 0px 69px; padding-top: 40px; border-top: 1px solid #426dcc;">
				<div style="text-align: center;">
					<h2 style="font-size: 18px;"><img src="/assets/shop/img/qhtx_03.png" width="30" style="vertical-align: middle;"> 订单状态：商家已发货，等待买家确认</h2>
					<div class="com_distance" style="padding: 15px 0px; line-height: 36px;">
						<span>订单号： GDYGHT120003765 </span> 
						<span> 签约日期：2016年6月14日</span>  
						<span> 商家名称： 天津华远兴业</span><br>
						<span>收货地址：天津天津市西青区 300000 魏* 186****7960</span><br>
						<span style="font-size: 16px; margin: 20px 20px 0px 20px;">送货员：<b style="color: #3f6dcb;">12346332</b></span><span style="font-size: 16px; margin: 20px 20px;">收货序号：<b style="color: #ee0000;">3335672</b></span>
					</div>
					<div class="com_div" style="margin: 0px auto 20px auto;">
						<a href="#" class="com_btn">确认收货</a><a href="#" class="com_btn gray">异议申诉</a><a href="#" class="com_btn gray" style="margin: 0px;">返回</a>
					</div>
				</div>
				<div class="ten_t clear" style="border: 1px solid #DDDDDD; border-bottom: none;">
					<div class="L two">地区</div>
					<div class="L three">品种</div>
					<div class="L four">标准</div>
					<div class="L five">材质</div>
					<div class="L six">钢厂</div>
					<div class="L seven">规格</div>
					<div class="L eight">吨数</div>
					<div class="L nine">货款（元）</div>
					<div class="L ten">物流（元）</div>
				</div>
				<!--订单情况-->
				<div class="order_list" style="padding-top: 0px;">
					<ul class="order_ul">
						<li class="clear shangpin">
							<div>
								<div class="clear">
									<div class="L two single_txt">天津</div>
									<div class="L three single_txt">无缝管</div>
									<div class="L four single_txt">API 5L</div>
									<div class="L five single_txt">#20</div>
									<div class="L six single_txt">鞍钢</div>
									<div class="L seven single_txt">219*9.8*12000</div>
									<div class="L eight single_txt"><span class="s_num">5</span></div>
								</div>
								<div class="clear">
									<div class="L two single_txt">天津</div>
									<div class="L three single_txt">无缝管</div>
									<div class="L four single_txt">API 5L</div>
									<div class="L five single_txt">#20</div>
									<div class="L six single_txt">鞍钢</div>
									<div class="L seven single_txt">219*9.8*12000</div>
									<div class="L eight single_txt"><span class="s_num">5</span></div>
								</div>
							</div>
							<div>
								<div class="L nine">￥<span class="s_price">31200</span></div>
								<div class="L ten">￥<span class="s_price">1000</span></div>
							</div>
						</li>
						<li class="final" >
							<div style="width: 400px;">预付款 （20%货款+运费）：<span class="s02">￥144790.20</span></div>
							<div style="width: 400px;">尾款 （含运费）：<span class="s02">￥144790.20</span></div>
							<div style="text-align: right; width: 490px;">
								合计（含运费）：<span class="s02">￥800.00</span>
							</div>
						</li>
					</ul>
				</div>
			</div>
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
		</div>
		<!--footer-->
				    
@endsection

@section('footer')
    @include('_layouts.shop_footer1')
@endsection
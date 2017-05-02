@extends('_layouts.shop')

@section('main-content')
		<div class="shop_car order_com order_pay mid_div">
			<ul class="step_icon clear">
				<li class="pass">下单</li>
				<li class="pass">电子合同</li>
				<li class="cur">付款</li>
				<li>物流查询</li>
				<li>收货</li>
				<li>货物与款项结算</li>
				<li>发票处理</li>
				<li>交易完成</li>
			</ul>
			<div class="com_title">
				<img src="/assets/shop/img/qhqr_03.png">
				<div class="R explain_title"><img src="/assets/shop/img/fksm_03.png"> 付款说明
					<div class="explain_detail">
						<p class="redfont">付款规则</p>
						<p><b>1. 全额付款</b><br>
实付款=货款×1.05+运费<br>
确认收货后退还=实付款-(实际货款+运费）<br>
<b>2. 货到付款</b><br>
实付款=货款×0.3+运费<br>
确认收货后支付余款<br>
<b>3.无故拒收</b><br>
货到后无故拒收需支付运费</p>
					</div>
				</div>
			</div>
			<div class="futures_fb com_div" style=" width: 1131px; margin: -37px 0px 0px 69px; border-top: 1px solid #5e86e1;">
				<h2 style="padding: 20px 20px;"><span class="s01">订单号： {{ $order->order_sn }} </span></h2>
				<div class="list_eleven list_eleven3" style="margin-top: 0px;">
					<div class="eleven_t clear" style="border: none;">
						<div class="L one">地区</div>
						<div class="L two">品种</div>
						<div class="L three">标准</div>
						<div class="L four">材质</div>
						<div class="L five">钢厂</div>
						<div class="L six">规格（mm*mm*mm）</div>
						<div class="L eight">吨数（t）</div>
						<div class="L nine">货款（元）</div>
						<div class="L ten">物流（元）</div>
					</div>
					<!--订单情况-->
					<div class="order_list" style="padding: 0px;">					
						<ul class="order_ul" style="border: none;">
							@if($order->goods != null)
								@foreach ($order->goods as $goods)

									<li class="clear">
										<div class="L one single_txt">{{ $goods->bak_area  or '-' }}</div>
										<div class="L two single_txt">{{ $goods->bak_variety or '-'  }}</div>
										<div class="L three single_txt">{{ $goods->bak_standard or '-'  }}</div>
										<div class="L four single_txt">{{ $goods->bak_material or '-'  }}</div>
										<div class="L five single_txt">{{ $goods->bak_steelmill or '-'  }}</div>
										<div class="L six single_txt">{{ $goods->bak_attribute or '-'  }}</div>
										<div class="L eight single_txt"><span class="s_num">{{ $goods->buy_count or '-' }}</span></div>
										<div class="L nine single_txt">￥<span class="s_price">{{ $goods->buy_price * $goods->buy_count  }}</span></div>
										<div class="L ten single_txt">￥<span class="s_price">{{ $goods->postsge }}</span></div>
									</li>
								@endforeach
							@endif

							<li class="final clear" >
								{{--<div style="width: 400px;">预付款 （20%货款）：<span class="s02">￥144790.20</span></div>
								<div style="width: 400px;">尾款 （含运费）：<span class="s02">￥292669.80</span></div>--}}
								<div style="width: 400px;">已付款：<span class="s02">￥{{ $order->paid_amount }}</span></div>
								<div style="text-align: right; width: 400px;">
									<span>合计（含运费）：</span><span class="s02">￥{{ $order->total }}</span>
								</div>
							</li>
						</ul>
					</div>
				</div>
				<div class="mess_div com_distance" style="padding:10px 20px; margin: 0px; border: none;">
					<span>联系人：  {{ $order->linkman }}</span>
					<span>联系方式： {{ $order->mobile }}</span>
					<span>收货地址： {{ $order->address }}</span>
					<span>邮编： {{ $order->zip_code }}</span>
				</div>
				<div class="mess_div clear" style="border: none;">
					<div class="L" style="padding:10px 20px;">
						<div>详细说明：</div>
						<div class="two_div" style="border: none; padding-top: 0px; width: 920px;">
							<p>{{ $order->detail or '无' }}</p>
						</div>
					</div>
				</div>
				<!--支付方式-->
				<div class="pay_yhselect" style="border-top: 2px solid #e8e8e8;">
					<ul class="clear">
						<li class="on"><img src="/assets/shop/img/yh_03.jpg"></li>
						{{--<li><img src="/assets/shop/img/yh_03.jpg"></li>
						<li><img src="/assets/shop/img/yh_03.jpg"></li>
						<li><img src="/assets/shop/img/yh_03.jpg"></li>--}}
					</ul>
				</div>
				<div class="clear">
{{--					<a href="{{ route('user.stocks.change', ['order_sn' => $order->order_sn, 'total' => $order->total, 'status' => 4]) }}" class="pay_btn R">确认支付</a>--}}
					<a href="{{ route('user.order.paytest', ['order_sn' => $order->order_sn, 'total' => $order->total]) }}" class="pay_btn R">确认支付</a>
					<span style="color: #ec0000; padding: 13px 20px;" class="R"><img src="/assets/shop/img/fksm_03.png" style="vertical-align: middle;"> 确认收货后需支付剩余尾款</span>
				</div>
			</div>
		</div>
		<!--footer-->
@endsection

@section('footer')
	@include('_layouts.shop_footer2')
@endsection
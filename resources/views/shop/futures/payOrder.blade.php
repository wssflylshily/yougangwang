@extends('_layouts.shop')

@section('main-content')
		<script type="text/javascript">
			$(function(){
				$(".pay_yhselect li").click(function(){
					$(this).addClass("on");
					$(this).siblings().removeClass("on");
				});
			})
		</script>
	
		<div class="shop_car order_com order_pay mid_div">
			<ul class="step_icon nine_step clear">
				<li class="pass">发布期货</li>
				<li class="pass">商家接单 </li>
				<li class="pass">电子合同 </li>
				<li class="cur">付款</li>
				<li>生产期货</li>
				<li>物流查询</li>
				<li>收货</li>
				<li>发票处理</li>
				<li>交易完成</li>
			</ul>
			
			<div class="com_title" style="">
				<img src="/assets/shop/img/qhqr_03.png">
				<!-- <div class="R explain_title"><img src="/assets/shop/img/fksm_03.png"> 付款说明
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
				</div> -->
			</div>
			
			<div class="futures_fb com_div" style=" width: 1131px; margin: -37px 0px 0px 69px; border-top: 1px solid #5e86e1;">
				<h2 style="padding: 20px 20px;"><span class="s01">订单号： {{$order->order_sn}} </span></h2>
				<div class="list_eleven list_eleven3" style="margin-top: 0px;">
					<div class="eleven_t clear" style="border: none;">
						<div class="L one">地区</div>
						<div class="L two">品种</div>
						<div class="L three">标准</div>
						<div class="L four">材质</div>
						<div class="L five">钢厂</div>
						<div class="L six">规格（mm*mm*mm）</div>
						<div class="L seven">允差（±%）</div>
						<div class="L eight">数量</div>
						<div class="L nine">货款（元）</div>
						<div class="L ten">物流（元）</div>
					</div>
					<!--订单情况-->
					<div class="order_list" style="padding: 0px;">					
						<ul class="order_ul" style="border: none;">
							@foreach($order->futures as $future)
							<li class="clear">
								<div class="L one single_txt">{{$future->area}}</div>
								<div class="L two single_txt">{{$future->variety}}</div>
								<div class="L three single_txt">{{$future->material}}</div>
								<div class="L four single_txt">{{$future->standard}}</div>
								<div class="L five single_txt">{{$future->steelmill}}</div>
								<div class="L six single_txt">
									@if($future->length_type==2)
									{{ $future->outer_diameter }}*{{ $future->thickness }}*{{ $future->length*100 }}
									@else
									{{ $future->outer_diameter }}*{{ $future->thickness }}*{{ $future->length*100 }} ~ {{ $future->outer_diameter }}*{{ $future->thickness }}*{{ $future->max_length*100 }}
									@endif
								</div>
								<div class="L seven single_txt"><span class="s_num">{{$future->deviation}}</span></div>
								<div class="L eight single_txt"><span class="s_num">{{$future->stock}} {{$future->unit}}</span></div>
								{{--<div class="L nine single_txt">￥<span class="s_price">{{$future->offer->unit_price*$future->stock}}</span></div>--}}
								<div class="L nine single_txt">￥<span class="s_price"><?php echo round($order->order_amount,2); ?></span></div>
								<div class="L ten single_txt">￥<span class="s_price">{{($order->contract->processing_price+$order->contract->shangai_price+$order->contract->promise_price)*$future->stock}}</span></div>
							</li>
							@endforeach
							<li class="final clear" >
								<div style="width: 400px;">预付款 （20%货款）：<span class="s02">￥<?php echo round($order->order_amount*0.2,2); ?></span></div>
								<div style="width: 400px;">尾款 （含运费）：<span class="s02">￥<?php echo round($order->order_amount*0.8+($order->contract->processing_price+$order->contract->shangai_price+$order->contract->promise_price)*$future->stock,2); ?></span></div>
								<div style="text-align: right; width: 400px;">
									<span>合计（含运费）：</span><span class="s02">￥<?php echo round(($order->order_amount+($order->contract->processing_price+$order->contract->shangai_price+$order->contract->promise_price)*$future->stock),2); ?></span>
								</div>
							</li>
						</ul>
					</div>
				</div>
				<div class="mess_div com_distance" style="padding:10px 20px; margin: 0px; border: none;">
					<span>联系人：  {{$order->linkman}}</span>
					<span>联系方式： {{$order->mobile}}</span> 
					<span>收货地址：{{$order->address}}</span>
					<span>邮编： {{$order->zip_code}}</span>
				</div>
				<div class="mess_div clear" style="border: none;">
					<div class="L" style="padding:10px 20px;">
						<div>详细说明：</div>
						<div class="two_div" style="border: none; padding-top: 0px; width: 920px;">
							<textarea id="detail">{{$order->detail}}</textarea>
							<!-- <p>含税过磅到防腐厂价，每支钢管坡口30°-35 °，管端均带上金属管帽；</p>
							<p>1）外径：按照标准要求；</p>
							<p>2) 壁厚：+0mm/-0.1mm；</p>
							<p>3) 长度：+0/-20mm；</p> -->
						</div>
					</div>
				</div>
				<!--支付方式-->
				<div class="pay_yhselect" style="border-top: 2px solid #e8e8e8;">
					<ul class="clear">
						<li class="on"><img src="/assets/shop/img/yh_03.jpg"></li>
						<!-- <li><img src="/assets/shop/img/yh_03.jpg"></li>
						<li><img src="/assets/shop/img/yh_03.jpg"></li>
						<li><img src="/assets/shop/img/yh_03.jpg"></li> -->
					</ul>
				</div>
				<div class="clear">
					@if($order->status==2)
					{{--<a href="{{route('user.futures.changeStatus',['order_id'=>$order->id,'status'=>3])}}" class="pay_btn R">确认支付预付款</a>--}}
					<a href="{{route('user.futures.pay',['order_sn'=>$order->order_sn, 'money' => round($order->order_amount*0.2,2) , 'postsge' => (($order->contract->processing_price+$order->contract->shangai_price+$order->contract->promise_price)*$future->stock),'status'=>3])}}" class="pay_btn R">确认支付预付款</a>
					@elseif($order->status==3)
					<a href="{{route('user.futures.pay',['order_sn'=>$order->order_sn, 'money' => round($order->order_amount*0.8+($order->contract->processing_price+$order->contract->shangai_price+$order->contract->promise_price)*$future->stock,2) ]) }}" class="pay_btn R">确认支付预付款</a>
					{{--<a href="{{route('user.futures.changeStatus',['order_id'=>$order->id,'status'=>4])}}" class="pay_btn R">确认支付尾款</a>--}}
					<!-- /futures/produce -->
					@endif
					<span style="color: #ec0000; padding: 13px 20px;" class="R"><img src="/assets/shop/img/fksm_03.png" style="vertical-align: middle;"> 确认收货前需支付剩余尾款</span>
				</div>
			</div>
		</div>
		<!--footer-->
			@endsection
	
	@section('footer')		
		<!--footer-->
		@include('_layouts.shop_footer1')
	@endsection
		

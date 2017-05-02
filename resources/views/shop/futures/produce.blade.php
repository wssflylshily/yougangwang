@extends('_layouts.shop')

@section('main-content')
		<div class="shop_car order_com mid_div">
			<ul class="step_icon nine_step clear">
				<li class="pass">发布期货</li>
				<li class="pass">商家接单 </li>
				<li class="pass">电子合同 </li>
				<li class="pass">付款</li>
				<li class="cur">生产期货</li>
				<li>物流查询</li>
				<li>收货</li>
				<li>发票处理</li>
				<li>交易完成</li>
			</ul>
			<div class="com_title">
				<img src="/assets/shop/img/scqhtitle_03.png">
			</div>
			<div class="com_content com_div futures_fb clear">
				<div class="com_distance">
					<span>订单号：{{$order->order_sn}}</span>
					<span>签约日期：<?php echo date('Y年m月d日',strtotime($order->contract->updated_at)); ?></span>
					<!-- <span>剩余天数：15天</span> -->
					<span>接单商家：<a href="#">{{$order->seller->name}}</a></span>
				</div>
				<div class="list_eleven list_eleven2" style="margin-top: 0px;">
					<div class="eleven_t clear">
						<div class="one L">地区</div>
						<div class="two L">品种</div>
						<div class="three L">标准</div>
						<div class="four L">材质</div>
						<div class="five L">钢厂</div>
						<div class="nine L">规格（mm*mm*mm）</div>
						<div class="seven L">允差（±%）</div>
						<div class="eight L">数量</div>
						<!-- <div class="six L">支数（支）</div> -->
						<div class="ten L">交货日期</div>
						<div class="two L">状态</div>
					</div>
					<div class="list">
						<ul>
							@foreach($order->futures as $future)
							<li class="clear">
								<div class="one single_txt L">{{$future->area}}</div>
								<div class="two single_txt L">{{$future->variety}}</div>
								<div class="three single_txt L">{{$future->standard}}</div>
								<div class="four single_txt L">{{$future->material}}</div>
								<div class="five single_txt L">{{$future->steelmill}}</div>
								<div class="nine single_txt L">
									@if($future->length_type==2)
									{{ $future->outer_diameter }}*{{ $future->thickness }}*{{ $future->length*100 }}
									@else
									{{ $future->outer_diameter }}*{{ $future->thickness }}*{{ $future->length*100 }} ~ {{ $future->outer_diameter }}*{{ $future->thickness }}*{{ $future->max_length*100 }}
									@endif
								</div>
								<div class="seven single_txt L">{{$future->deviation}}</div>
								<div class="eight single_txt L">{{$future->stock}} {{$future->unit}}</div>
								<!-- <div class="six single_txt L">125</div> -->
								<div class="ten single_txt L"><?php echo date('Y年m月d日',strtotime($future->delivery_date)); ?></div>
								<div class="two L"><font class="zt1">卖家发货中</font></div>
							</li>
							@endforeach
							
						</ul>
					</div>
					<div class="mess_div clear">
						<div class="L">
							<div>详细说明：</div>
							<div class="two_div" style="border: none; padding-top: 0px; width: 920px;">
								<textarea id="detail">{{$order->detail}}</textarea>
							</div>
						</div>
					</div>
					<div class="mess_div com_distance" style="padding:10px 20px; margin: 0px;">
						<span>联系人：   {{$order->linkman}}</span>
						<span>联系方式：  {{$order->mobile}}</span> 
						<span>收货地址：{{$order->address}}</span>
						<span>邮编： {{$order->zip_code}}</span>
					</div>
				</div>	
				<div style="text-align: right; padding: 20px;">
					@if($order->status==3)
					<a href="{{route('shop.futures.payOrder',['order_id'=>$order->id])}}" class="com_btn">去支付尾款</a>
					{{--@elseif($order->status==4)
					<a href="javascript:void(0);" class="com_btn">等待卖家发货</a>
					@elseif($order->status==5)
					<a href="#" class="com_btn">去收货</a>--}}
					@endif
				</div>
			</div>
			
		</div>
		<!--footer-->
			@endsection
	
	@section('footer')		
		<!--footer-->
		@include('_layouts.shop_footer1')
	@endsection
		
@extends('_layouts.shop')
		
		@section('main-content')
		<div class="shop_car order_confirm order_com mid_div">
			<ul class="step_icon nine_step clear">
				<li class="pass">发布期货</li>
				<li class="pass">商家接单 </li>
				<li class="pass">电子合同 </li>
				<li class="pass">付款</li>
				<li class="pass">生产期货</li>
				<li class="cur">物流查询</li>
				<li>收货</li>
				<li>发票处理</li>
				<li>交易完成</li>
			</ul>
			<div class="com_title">
				<img src="/assets/shop/img/wltitlte_03.png">
				<div class="R">订单号：{{$order->order_sn}}    （签约日期：{{$order->created_at}}）</div>
			</div>
			<div class="contract" style="border-right: 1px solid #dfdfdf; border-left: 1px solid #dfdfdf; border-bottom: 1px solid #dfdfdf;">
				<div class="add_logtis">
					<span class="w1">变更物流信息</span>
					<span class="w2"><div contenteditable="true"></div></span>
					<span class="w3"><button name="subwl">提交物流信息</button></span>
				</div>
				<div class="logistic_t">
					<!--<p><span>物流单号： 415588065529</span><span style="margin-left: 200px;"> 物流公司： 中通快递 </span><span style="margin-left: 200px;">客服电话： 95311</span></p>-->
					<p>商家名称： {{$order->seller->name}}</p>
					<p style="display:none;">发货地址：福建省泉州市晋江市 陈埭镇江头工业区速达货运对面悍途户外仓库3楼 362200 天猫悍途收 17758706659</p>
					<p>收货地址：{{$order->address}} {{$order->zip_code}} {{$order->linkman}} {{$order->mobile}}</p>
				</div>
				<div class="logistic_pass">
					@if($list)
					@for($i=0;$i<count($list);$i++)
					<div @if($i==0)class="first_wl" @elseif($i==(count($list)-1)) class="final_wl" @endif>
						<div><?php echo substr($list[$i]->created_at,0,4) ?>年<?php echo substr($list[$i]->created_at,5,2) ?>月<?php echo substr($list[$i]->created_at,8,2) ?>日</div>
						<div>
							<div>
								<span><?php echo substr($list[$i]->created_at,11,5) ?></span>
								<span>{{ $list[$i]->message }}</span>
							</div>
						</div>
					</div>
					@endfor
					@endif
				</div>
			</div>
			<!--<div style="text-align: right; padding: 20px;">
				以上信息由第三方物流公司提供，如需查询详情请<a href="#">联系客服</a>
			</div>-->
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
		<script type="text/javascript">
			$(function(){
				$("button[name='subwl']").click(function(){
					var order_id = "{{$order->id}}";
					var msg = $('.add_logtis .w2 div').html();
					var data = {order_id:order_id,message:msg,_token:"{{ csrf_token() }}"};
					$.post("{{route('seller.futures.addLogistics')}}",data).success(function(){

					});
				});
			})
	
		</script>
		@endsection

@section('footer')
    @include('_layouts.shop_footer1')
@endsection
@extends('_layouts.shop')

@section('main-content')
	<form action="{{ route('shop.order.pay.post') }}" method="POST" class="main-form" accept-charset="UTF-8" autocomplete="off" novalidate="novalidate">
		<input type="hidden" name="_token" value="{{ csrf_token() }}" id="csrfToken">
		<div class="shop_car order_confirm order_com mid_div">
			<ul class="step_icon clear">
				<li class="cur">下单</li>
				<li>电子合同</li>
				<li>付款</li>
				<li>物流查询</li>
				<li>收货</li>
				<li>货物与款项结算</li>
				<li>发票处理</li>
				<li>交易完成</li>
			</ul>
			<div class="com_title">
				<img src="/assets/shop/img/ordertitle_03.png">
			</div>
			<div style=" width: 1120px; margin: 0px auto;">

				<!--地址-->
				<div class="addr">
					<h2>收货人信息 <a href="#" class="R">管理收货地址</a></h2>
					<ul>
						@foreach ($consignees as $consignee)
						<li>
							<span><input {!! $consignee->is_default ? 'checked="checked"' : '' !!} class="check_btn" name="addr_select" type="radio" value="{{ $consignee->id }}"></span><span class="s01 addr_person">{{ $consignee->receiver }}</span><span class="addr_detail">{{ $consignee->province . $consignee->city . $consignee->county }} {{ $consignee->detail_address }}  </span><span>{{ $consignee->mobile }}</span>{!! $consignee->is_default ? '<span class="s02">默认地址</span>' : '' !!}
						</li>
						@endforeach
					</ul>
					@if (count($consignees) > 3)
					<div class="more_addr">
						<a href="javascript:void(0);">全部地址</a>
					</div>
					@endif
				</div>
				<!--订单详情-->
				<!--<div class="wars" style="text-align: right; padding-right: 20px;">
					<img src="/assets/shop/img/war_09.png"> 您的订单涉及到2个商家，购买后请一一与其签约合同。
				</div>-->
				<div class="ten_t clear" style="margin-top: 10px;">
					<div class="L two">地区</div>
					<div class="L three">品种</div>
					<div class="L four">标准</div>
					<div class="L five">材质</div>
					<div class="L six">钢厂</div>
					<div class="L seven">规格</div>
					<div class="L eight">吨数</div>
					<div class="L nine">价格（元/吨）</div>
				</div>
				<!--订单情况-->
				@php($seller = 0; $idx = 0; $checkout_cnt = count($cart_goods);)

				@foreach ($cart_goods as $goods)
					@if ($goods->seller->id != $seller && $seller != 0)
						<li class="final clear">
							<div class="L">
								<span>物流方式：</span>
								<span><label><input type="radio" class="radio_btn wlfangshi" checked="checked" value="1"> 买家自提</label></span>
<!--								<span><label><input type="radio" class="radio_btn wlfangshi" value="2"> 商家承担</label></span>
								<span><label><input type="radio" class="radio_btn wlfangshi" value="3"> 拼车</label></span>-->
							</div>
							<div class="R">
								<span>付款方式：</span>
								<span><label><input type="radio" class="radio_btn fkfangshi" value="1" checked="checked"> 全额付款</label></span>
<!--								<span><label><input type="radio" class="radio_btn fkfangshi" value="1"> 货到付款</label></span>-->
							</div>
						</li>
						<li class="final clear">
							<div class="L another" style="display: none;">
								<span><input type="checkbox" value="1" class="check_btn lwzhifu"> 加工</span>
								<span><input type="checkbox" value="2" class="check_btn lwzhifu"> 防腐</span>
								<span><input type="checkbox" value="3" class="check_btn lwzhifu"> 苫盖</span>
							</div>
							<div class="R">（货款）：<em class="one_pay">￥0.00</em></div>
						</li>
						</ul>
					</div>
					@endif

					@if ($goods->seller->id != $seller)
					<div class="order_list">
						<h2>{{ $goods->seller->name }}</h2>
						<ul class="order_ul">
					@endif

						<li class="clear shangpin">
							<div class="L two single_txt">{{ $goods->ori->area_code or '' }}</div>
							<div class="L three single_txt">{{ $goods->ori->variety or '' }}</div>
							<div class="L four single_txt">{{ $goods->ori->standard or '' }}</div>
							<div class="L five single_txt">{{ $goods->ori->material or '' }}</div>
							<div class="L six single_txt">{{ $goods->ori->steelmill or '' }}</div>
							<div class="L seven single_txt">{{ $goods->ori->length . '*' . $goods->ori->thickness . '*' . $goods->ori->outer_diameter }}</div>
							<div class="L eight single_txt"><span class="s_num">{{ $goods->buy_number }}</span></div>
							<div class="L nine single_txt">￥<span class="s_price">{{ $goods->buy_price }}</span></div>
						</li>

					@php($seller = $goods->seller->id; $idx++;)
					@if ($idx == $checkout_cnt)
						<li class="final clear">
							<div class="L">
								<span>物流方式：</span>
								<span><label><input type="radio" class="radio_btn wlfangshi" checked="checked" value="1"> 买家自提</label></span>
<!--								<span><label><input type="radio" class="radio_btn wlfangshi" value="2"> 商家承担</label></span>
								<span><label><input type="radio" class="radio_btn wlfangshi" value="3"> 拼车</label></span>-->
							</div>
							<div class="R">
								<span>付款方式：</span>
								<span><label><input type="radio" class="radio_btn fkfangshi" value="1" checked="checked"> 全额付款</label></span>
<!--								<span><label><input type="radio" class="radio_btn fkfangshi" value="1"> 货到付款</label></span>-->
							</div>
						</li>
						<li class="final clear">
							<div class="L another" style="display: none;">
								<span><input type="checkbox" value="1" class="check_btn lwzhifu"> 加工</span>
								<span><input type="checkbox" value="2" class="check_btn lwzhifu"> 防腐</span>
								<span><input type="checkbox" value="3" class="check_btn lwzhifu"> 苫盖</span>
							</div>
							<div class="R">（货款）：<em class="one_pay">￥0.00</em></div>
						</li>
						</ul>
					</div>
					@endif
				@endforeach

				<!--订单确认-->
				<div class="confirm_infor">
					<div class="pay_infor">
						<div><em>需付款：</em><em class="em01" id="total_price">￥0.00</em></div>
						<div><em>寄送至：</em><span id="select_addr">天津市 南开区 红旗路 赛德广场5号楼 1106室</span></div>
						<div><em>收货人：</em><span id="select_person">林子杰</span></div>
					</div>
					<div class="clear">
						<a href="{{ route('shop.cart') }}" class="back_btn L"><img src="/assets/shop/img/back_10.png"> 返回购物车</a>
						<button type="submit" class="confirm_btn R">提交订单</button>
					</div>
				</div>
			</div>
		</div>
	</form>

		<script>
			$(function(){
				//更多地址
				if($(".addr li").length<4)
				{
					$(".addr ul").css({"height":"auto"});
					$(".more_addr").hide();
				}
				$(".more_addr a").click(function(){
					//cosole.log(2);
					if($(this).hasClass("cur"))
					{
						$(".addr ul").css({"height":"108px"});
						$(this).removeClass("cur");
						$(this).html("全部地址");
					}
					else
					{
						$(this).addClass("cur");
						$(this).html("收起地址");
						$(".addr ul").css({"height":"auto"});
					}
				});
				//地址初始化
				$("#select_addr").html($("input[name='addr_select']:checked").parents("li").find(".addr_detail").html());
				$("#select_person").html($("input[name='addr_select']:checked").parents("li").find(".addr_person").html());
				//地址选择
				$("input[name='addr_select']").change(function(){
					//console.log($(this).val());
					$("#select_addr").html($("input[name='addr_select']:checked").parents("li").find(".addr_detail").html());
					$("#select_person").html($("input[name='addr_select']:checked").parents("li").find(".addr_person").html());
				});
				//订单
				var all_price=0,one_price=0;;
				$(".order_list").each(function(index,e){
					one_price=0;
					//console.log(one_price);
					$(this).find(".shangpin").each(function(){
						one_price+=parseFloat(($(this).find(".s_num").html())*parseFloat($(this).find(".s_price").html()));
						//console.log(one_price);
					});
					all_price+=one_price;
					$(this).find(".one_pay").html("￥"+parseFloat(one_price).toFixed(2));
					$("#total_price").html("￥"+parseFloat(all_price).toFixed(2));
					//加工
					$(this).find(".wlfangshi").attr("name","ysway"+index);
					$(this).find(".fkfangshi").attr("name","fkway"+index);
					$(this).find(".lwzhifu").attr("name","anotherway"+index);
				});
				//商家承担
				for(var i=0;i<$(".order_list").length;i++)
				{
					$("input[name='ysway"+i+"']").change(function(){
						if($(this).val()=="2")
						{
							$(this).parents(".order_list").find(".another").show();
						}
						else
						{
							$(this).parents(".order_list").find(".another").hide();
						}
					})
				}
				//提交订单
				$(".confirm_btn").click(function(){
					var addr_idd=$("input[name='addr_select']:checked").val();
					console.log(addr_idd);
					$(".order_list").each(function(index,e){
						console.log("2");
					})
				})
				
			})
		</script>

		<!-- Toaster -->
		<script src="/plugins/jquery-toaster/jquery.toaster.js"></script>

		<!-- pages script -->
		<script src="/plugins/jquery-form/jquery.form.min.js"></script>
		<script src="/assets/base.js"></script>

		<script>
			$(function(){
				var base = new Base();
				base.initForm("{{ route('user.home') }}");
			});
		</script>
@endsection

@section('footer')
		<!--footer-->
		@include('_layouts.shop_footer1')
@endsection

@extends('_layouts.shop')

@section('main-content')
		<div class="shop_car tent1 order_com mid_div">
			<ul class="step_icon clear">
				<li class="pass">下单</li>
				<li class="pass">电子合同</li>
				<li class="pass">付款</li>
				<li class="pass">物流查询</li>
				<li class="pass">收货</li>
				<li class="pass">货物与款项结算</li>
				<li class="cur">发票处理</li>
				<li>交易完成</li>
			</ul>
			<div class="com_title">
				<img src="/assets/shop/img/fpcl_03.png">
				<div class="R">如需修改发票信息请与商家联系 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <a href="javascript:;" class="contact" data_tel="{{ $order->seller->user->mobile  or '' }}"><img src="/assets/shop/img/person/contact.jpg"></a></div>
			</div>
				<div class="com_distance">
					<span>发票类型：</span><span><input type="radio" name="invoice_type" value="1" class="radio_btn" @if($order->invoice_type == 1) checked @endif > 增值税发票</span>
					<span><input type="radio" name="invoice_type" value="2" class="radio_btn" @if($order->invoice_type == 2) checked @endif > 普通发票</span>
					<span style="color: red;">{{ $result }}</span>
					<span style="margin-left: 150px;">发票邮寄地址： <input type="text" placeholder="在此填写您发票的寄送地址" value="{{ $order->invoice_send_address or '-' }}" name="send_address" style="border-bottom: 1px solid #ddd; padding: 3px 6px; width: 370px;"</span>
				</div>
				<div>
					<table class="invoice_table">
						<tr>
							<td class="font1" width="28">购<br>买<br>方</td>
							<td width="500">
								<table>
									<tr>
										<td>名&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;称：</td>
										<td><input type="text" name="name" placeholder="" value="{{ $order->invoice_name or '-' }}"></td>
									</tr>
									<tr>
										<td>纳税人识别号:</td><td><input type="text" name="shbh" placeholder="" value="{{ $order->invoice_no or '-' }}"></td>
									</tr>
									<tr>
										<td>地&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;址:</td>
										<td><input type="text" name="address" placeholder="" value="{{ $order->invoice_address or '-' }}"></td>
									</tr>
									<tr>
										<td>电&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;话:</td>
										<td><input type="text" name="tel" placeholder="" value="{{ $order->invoice_tel or '-' }}"></td>
									</tr>
									<tr>
										<td>开&nbsp;&nbsp;&nbsp; 户 &nbsp;&nbsp;&nbsp;行&nbsp;:</td>
										<td><input type="text" name="bank" placeholder="" value="{{ $order->invoice_bank or '-' }}"></td>
									</tr>
									<tr>
										<td>银&nbsp;&nbsp;行&nbsp;&nbsp;账&nbsp;&nbsp;号:</td>
										<td><input type="text" name="bank_num" placeholder="" value="{{ $order->invoice_bank_num or '-' }}"></td>
									</tr>
								</table>
							</td>
							<td align="center">
								<p><img src="/assets/shop/img/qhtx_03.png"></p>
								<p>
									请认真审核您填写的购买方信息，一经确认不可随意更改。如需修改请与商家联系修改。
								</p>
							</td>
						</tr>
					</table>
					<!--物品-->
					<div class="ten_t clear" style="margin-top: 10px; border: 1px solid #ddd; border-bottom: none;">
						<div class="L one">地区</div>
						<div class="L two">品种</div>
						<div class="L three" style="width: 120px;">标准</div>
						<div class="L four">材质</div>
						<div class="L five">钢厂</div>
						<div class="L six">规格（mm*mm*mm）</div>
						<div class="L eight">吨数（t）</div>
						<div class="L nine">货款（元）</div>
						<div class="L two" style="text-align: right;">物流（元）</div>
					</div>
					<!--订单情况-->
					<div class="order_list" style="padding-top: 0px;">
						<ul class="order_ul">
							@if($order->goods != null)
								@foreach ($order->goods as $goods)
									<li class="clear">
										<div class="L one single_txt">{{ $goods->bak_area  or '-' }}</div>
										<div class="L two single_txt">{{ $goods->bak_variety or '-'  }}</div>
										<div class="L three single_txt" style="width: 120px;">{{ $goods->bak_standard or '-'  }}</div>
										<div class="L four single_txt">{{ $goods->bak_material or '-'  }}</div>
										<div class="L five single_txt">{{ $goods->bak_steelmill or '-'  }}</div>
										<div class="L six single_txt">{{ $goods->bak_attribute or '-'  }}</div>
										<div class="L eight single_txt"><span class="s_num">{{ $goods->buy_count or '-' }}</span></div>
										<div class="L nine single_txt">￥<span class="s_price">{{ $goods->buy_count * $goods->buy_price}}</span></div>
										<div class="L two single_txt" style="text-align: right; color: #ff4400;">￥<span class="s_price">{{ $goods->postsge or '-' }}</span></div>
									</li>
								@endforeach
							@endif
						</ul>
					</div>
					<!--销售方-->
					{{--<table class="invoice_table">
						<tr>
							<td class="font1" width="28">销<br>售<br>方</td>
							<td>
								<table>
									<tr>
										<td>名&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;称：</td>
										<td>天津市华远兴业钢铁销售公司</td>
									</tr>
									<tr>
										<td>纳税人识别号:</td>
										<td>120108625665478</td>
									</tr>
									<tr>
										<td>地  址、电  话&nbsp;:</td>
										<td>天津市武清区河内镇石油国际2座1345 022-25645656</td>
									</tr>
									<tr>
										<td>开户行及账号:</td>
										<td>中国农行武清区河内支行235647895632</td>
									</tr>
								</table>
							</td>
						</tr>
					</table>--}}
				</div>
				<div class="incoice_notice clear">
					<div class="L">
						<p><img src="/assets/shop/img/qhtx_03.png"></p>
						<p>优钢网提示您</p>
					</div>
					<div class="R" style="width: 780px;">
						<p>1、原则上发票开具内容需与实际供货内容一致，如有特殊要求需合同签订前与卖方沟通，并且卖方同意开具；</p>
						<p>2、发票中买、卖双方开票信息应与国家颁发的法定执照内容一致，双方开票前需仔细核对；</p>
						<p>3、发票开具时间为15天（含节假日，除去对公工作日），每月1~10日为系统对公工作日，不受理发票开具服务。</p>
					</div>
				</div>
				<div class="com_div" style="margin: 20px auto; text-align: center;">
					<input type="hidden" name="id" value="{{ $order->id }}">
					<input type="hidden" name="_token" value="{{ csrf_token() }}">
					<a href="{{ route('seller.stocks.orders') }}" class="com_btn gray">返 回</a>{{--<input type="submit" class="com_btn" value="确认" >--}}
					<a class="com_btn" href="{{ route('seller.stocks.change', ['order_sn' => $order->order_sn, 'status' => 9]) }}">已开发票</a>
				</div>
			</div>
		</div>
		<!--footer-->
		<script>
			$(function(){
				$(document).on("click", ".thead .contact", function() {
					var tel=$(this).attr("data_tel");
					$.alert("请拨打电话："+tel, "联系方式");
				});

			})
		</script>
@endsection

@section('footer')
	@include('_layouts.shop_footer2')
@endsection

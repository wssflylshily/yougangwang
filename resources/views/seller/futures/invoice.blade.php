@extends('_layouts.shop')

@section('main-content')
		<div class="shop_car tent1 order_com mid_div">
			<ul class="step_icon nine_step clear">
				<li class="pass">发布期货</li>
				<li class="pass">商家接单 </li>
				<li class="pass">电子合同 </li>
				<li class="pass">付款</li>
				<li class="pass">生产期货</li>
				<li class="pass">物流查询</li>
				<li class="pass">收货</li>
				<li class="cur">发票处理</li>
				<li>交易完成</li>
			</ul>
			<div class="com_title">
				<img src="/assets/shop/img/fpcl_03.png">
				<!-- <div class="R">如需修改发票信息请与商家联系 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <a href="#" data_tel="{{$order->seller->user->mobile}}"><img src="/assets/shop/img/person/contact.jpg"></a></div> -->
			</div>
			<div style=" width: 1131px; margin: -37px 0px 0px 69px; padding-top: 40px; border-top: 1px solid #426dcc;">
				<div class="com_distance">
					<span>发票类型：</span><span><input type="radio" name="invoice_type" class="radio_btn" value="1" @if($order->invoice_type==1) checked @endif disabled> 增值税发票</span>
					<span><input type="radio" name="invoice_type" class="radio_btn" value="2" @if($order->invoice_type==2) checked @endif disabled> 普通发票</span>
					<span style="margin-left: 320px;">发票邮寄地址： <input type="text" placeholder="在此填写您发票的寄送地址" name="send_address" value="{{$order->invoice_send_address or ''}}" disabled style="border-bottom: 1px solid #ddd; padding: 3px 6px; width: 370px;"></span>
				</div>
				<div>
					<table class="invoice_table">
						<tr>
							<td class="font1" width="28">购<br>买<br>方</td>
							<td width="500">
								<table>
									<tr>
										<td>名&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;称：</td>
										<td><input type="text" name="name" value="{{ $order->invoice_name or '' }}" disabled></td>
									</tr>
									<tr>
										<td>纳税人识别号:</td><td><input type="text" name="shbh" value="{{ $order->invoice_no or '' }}" disabled></td>
									</tr>
									<tr>
										<td>地&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;址:</td>
										<td><input type="text" name="address" placeholder="" value="{{ $order->invoice_address or '' }}" disabled></td>
									</tr>
									<tr>
										<td>电&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;话:</td>
										<td><input type="text" name="tel" placeholder="" value="{{ $order->invoice_tel or '' }}" disabled></td>
									</tr>
									<tr>
										<td>开&nbsp;&nbsp;&nbsp; 户 &nbsp;&nbsp;&nbsp;行&nbsp;:</td>
										<td><input type="text" name="bank" placeholder="" value="{{ $order->invoice_bank or '' }}" disabled></td>
									</tr>
									<tr>
										<td>银&nbsp;&nbsp;行&nbsp;&nbsp;账&nbsp;&nbsp;号:</td>
										<td><input type="text" name="bank_num" placeholder="" value="{{ $order->invoice_bank_num or '' }}" disabled></td>
									</tr>
									
								</table>
							</td>
							<!-- <td align="center">
								<p><img src="/assets/shop/img/qhtx_03.png"></p>
								<p>
									请认真审核您填写的购买方信息，一经确认不可随意更改。如需修改请与商家联系修改。
								</p>
							</td> -->
						</tr>
					</table>
					<!--物品-->
					<div class="ten_t clear" style="margin-top: 10px; border: 1px solid #ddd; border-bottom: none;">
						<div class="L two">地区</div>
						<div class="L three">品种</div>
						<div class="L four">标准</div>
						<div class="L five">材质</div>
						<div class="L six">规格</div>
						<div class="L seven">钢厂</div>
						<div class="L eight">数量</div>
						<div class="L nine">总额</div>
						<!-- <div class="L two">货物或<br>应税劳务/服务名称</div>
						<div class="L three">规格型号</div>
						<div class="L four">单位</div>
						<div class="L five">数量</div>
						<div class="L six">单价（含税）</div>
						<div class="L seven">金额（含税）</div>
						<div class="L eight">税率</div>
						<div class="L nine">税额</div> -->
					</div>
					<!--订单情况-->
					<div class="order_list" style="padding-top: 0px;">
						<ul class="order_ul">
							@foreach($order->futures as $future)
							<li class="clear shangpin">
								<div class="L two single_txt">{{$future->area}}</div>
								<div class="L three single_txt">{{$future->variety}}</div>
								<div class="L four single_txt">{{$future->standard}}</div>
								<div class="L five single_txt">{{$future->material}}</div>
								<div class="L six single_txt">
								@if($future->length_type==1)
								{{ $future->outer_diameter }}*{{ $future->thickness }}*{{ $future->length*100 }} ~ {{ $future->outer_diameter }}*{{ $future->thickness }}*{{ $future->max_length*100 }}
								@else
								{{ $future->outer_diameter }}*{{ $future->thickness }}*{{ $future->length*100 }}
								@endif
								</div>
								<div class="L seven single_txt">{{ $future->steelmill }}</div>
								<div class="L eight single_txt">{{$future->stock}}{{$future->unit}}</div>
								<div class="L nine single_txt">{{$future->offer->unit_price*$future->stock}}</div>
							</li>
							@endforeach
							<li class="final clear">
								<div class="L two single_txt">合计：</div>
								<div class="L three single_txt">&nbsp;</div>
								<div class="L four single_txt">&nbsp;</div>
								<div class="L five single_txt">&nbsp;</div>
								<div class="L six single_txt">&nbsp;</div>
								<div class="L seven single_txt"  style="color:none;font-weight;normal;">&nbsp;</div>
								<div class="L eight single_txt">&nbsp;</div>
								<div class="L nine single_txt">￥{{$order->order_amount}}</div>
							</li>
						</ul>
					</div>
					
				</div>
				<!-- <div class="incoice_notice clear">
					<div class="L">
						<p><img src="/assets/shop/img/qhtx_03.png"></p>
						<p>优钢网提示您</p>
					</div>
					<div class="R" style="width: 780px;">
						<p>1、原则上发票开具内容需与实际供货内容一致，如有特殊要求需合同签订前与卖方沟通，并且卖方同意开具；</p>
						<p>2、发票中买、卖双方开票信息应与国家颁发的法定执照内容一致，双方开票前需仔细核对；</p>
						<p>3、发票开具时间为15天（含节假日，除去对公工作日），每月1~10日为系统对公工作日，不受理发票开具服务。</p>
					</div>
				</div> -->
				<div class="com_div" style="margin: 20px auto; text-align: center;">
					<a href="javascript:history.go(-1);" class="com_btn gray">返 回</a>
					<a href="{{route('seller.futures.changeStatus',['order_id'=>$order->id,'status'=>9])}}" class="com_btn">已开发票</a>
				</div>
			</div>
		</div>
		<script type="text/javascript">
			$(function(){
		    	$(document).on("click", ".shop_car .com_title a", function() {
			        var tel=$(this).attr("data_tel");
			        $.alert("请拨打电话："+tel, "联系方式");
			    });
		     })
		</script>
		<!--footer-->
				    
@endsection

@section('footer')
    @include('_layouts.shop_footer1')
@endsection
@extends('_layouts.shop')

@section('main-content')
<style>
	.contract .table_txta .zhang_re{ position: relative; padding: 50px 0px;}
	.contract .table_txta .zhang_re .zhang_img{ z-index: -1; opacity: 0.5; position: absolute; left: 0px; top: 0px; bottom: 0px;}
  	.contract .table_txta .zhang_re .zhang_img img{ height: 100%;}
</style>
		<div class="shop_car order_confirm order_com mid_div">
			<ul class="step_icon clear">
				<li class="pass">下单</li>
				<li class="cur">电子合同</li>
				<li>付款</li>
				<li>物流查询</li>
				<li>收货</li>
				<li>货物与款项结算</li>
				<li>发票处理</li>
				<li>交易完成</li>
			</ul>
			<div class="com_title">
				<img src="/assets/shop/img/httitle_03.png">
				<a href="javascript:;" data-tel="{{ $order->seller->phone }}" class="lxsj R">联系商家</a>
			</div>
			<form action="{{ route('user.stocks.contract.sign.post') }}" method="POST" class="main-form" accept-charset="UTF-8" autocomplete="off" novalidate="novalidate">
			<input type="hidden" name="_token" value="{{ csrf_token() }}" id="csrfToken">
			<div class="contract">
				<h2>销 售 合 同</h2>
				<div class="ok_txt">
					<h3>合同编号: {{ $contract_sn }}</h3>
					<p>供方：<span class="fontred">{{ $order->seller->name or '未知' }}</span></p>
					<p>需方：<span class="fontred">{{ $order->user->seller->name or '未知' }}</span></p>
					<p>签订地点：<span></span></p>
					<p>签订日期：<span class="fontred"></span></p>
					<p style="text-indent: 2em;">双方根据《中华人民共和国合同法》及相关法律法规的规定，为明确双方的权利义务关系，经友好协商，订立本合同，供双方遵守执行。</p>
					<h3>第一条 合同标的情况</h3>
					<p>（一） 供方向需方供应以下货物：</p>
					<input type="hidden" name="seller_id" value="{{ $order->seller_id }}">
					<input type="hidden" name="user_id" value="{{ $order->user_id }}">
					<table class="table_txt">
						<tr>
							<th width="90">产品名称</th>
							<th width="165">执行标准</th>
							<th width="110">规格型号（mm）</th>
							<th width="120">钢级/材质</th>
							<th width="100">长度（米）</th>
							<th width="100">数量（吨）</th>
							<th width="110">出厂含税单价<br>（元/吨）</th>
							<th width="110">金额（元）</th>
							{{--<th>交货期</th>--}}
						</tr>
						@foreach ($order->goods as $order_goods)
						<tr class="fontred alignc">
							<td>{{ $order_goods->bak_variety or '未知' }}</td>
							<td>{{ $order_goods->bak_standard or '未知' }}</td>
							<td>{{ $order_goods->bak_attribute or '未知' }}</td>
							<td>{{ $order_goods->bak_material or '未知' }}</td>
							<td>dummy</td>
							<td>{{ $order_goods->buy_count or '未知' }}</td>
							<td>{{ $order_goods->buy_price or '未知' }}</td>
							<td>{{ $order_goods->buy_price * $order_goods->buy_count }}</td>
							{{--<td>dummy</td>--}}
						</tr>
						@endforeach
						<tr>
							<td colspan="9" class="td01">								
								<p><b>运费价格：</b></p>
								<div class="write_div" style="padding-left: 40px;">
									<span>货物由</span>
									<div class="writ_div" contenteditable="false" style="width: 300px;"></div>
									<span>发出运至</span><span class="fontred">{{ $order->address }}</span>
								</div>
								<div class="write_div" style="padding-left: 40px;">
									<span>商家承诺的价格是：</span>
									<div class="writ_div" contenteditable="false" style="width: 80px;"></div>
									<span>元/吨</span>
									<span style="margin-left: 100px;">运费小计：</span>
									<div class="writ_div" contenteditable="false" style="width: 80px;"></div>
									<span>元</span>
								</div>
								<p><b>工艺费用：</b></p>
								<div class="write_div" style="padding-left: 40px;">
									<span>加工：</span>
									<div class="writ_div" contenteditable="false" style="width: 80px;"></div>
									<span>元/吨</span>
									<span style="margin-left: 100px;">苫盖：</span>
									<div class="writ_div" contenteditable="false" style="width: 80px;"></div>
									<span>元/吨</span>
								</div>
							</td>
						</tr>
						<tr>
							<td colspan="9" class="td01">
								<div class="write_div" style="padding-left: 40px;">
									<span>合计（大写）：</span>
									<div class="writ_div" contenteditable="false" style="width: 260px;"></div>
									<span>（小写：</span><div class="writ_div" contenteditable="false" style="width: 126px;"></div><span>元）</span>
								</div>
							</td>
						</tr>
					</table>
					<p>合计人民币金额（大写）：<span>柒仟贰佰叁拾圆整 </span>（按实际提取的数量结算）</p>
					<p>（二）交货溢短装：交货数量按本合同约定货物数量的±5%的范围控制。</p>
					<p>（三）货物生产商为：黑龙江建龙钢铁销售有限公司。</p>
					<h3>第二条 货物的交付、运输、所有权及风险转移</h3>
					<p>（一）本合同所有货物最晚交货期为<span class="fontred">dummy</span>，延期交货日违约金为合同总额<span class="fontred">dummy%</span>，<br>
（二）货物交付地点：<span class="fontred">{{ $order->address }}</span>，收货人：<span class="fontred">{{ $order->linkman }}</span>，身份证号码：<span class="fontred">dummy</span>，联系方式：<span class="fontred">{{ $order->mobile }}</span>，
      收货人要仔细核查货物的数量，并签收确认收货，签收后货物的所有权属需方，供方及运输车辆将对货物数量将不再负责；<br>
（三）货物运输费用由供/需方支付，供方代办运输。</p>
					<h3>第三条 货款结算</h3>
					<p>（一）如供方未在交货期限内供货，结算单价将按第二条约定内容执行；<br>
（二）需方按合同约定向第三方支付预付定金及剩余货款，交货完毕后三工作日内需方将收到此批货款余额，供方将收到全额货款。</p>
					<h3>第四条 违约责任</h3>
					<p>（一）共、需双方在合同生效后如单方取消合同，违约一方需赔偿另一方，赔偿金额为预付定金。</p>
					<h3>第五条 技术协议</h3>
					<div class="enclosure">
<!--						<ul class="clear">
							<li>
								<div class="img_div"><input type="file" name="sc_img" class="sc_btn" /></div>
							</li>
							<li>
								<div class="img_div"><img src="/assets/shop/img/dt_14.jpg"></div>
								<div class="font_size clear">
									<a href="javascript:;" class="L check_fj">查看</a>
									<a href="javascript:;" class="R delete_fj">删除</a>
								</div>	
							</li>
						</ul>-->
					</div>
					<p>备注：附件内容与合同其他条款同等法律效力，双方应遵守。</p>
					<h3>第六条 争议解决</h3>
					<p>（一）如共、需双方在产品质量上存在争议，可提交第三方检测机构判定；<br>
（二）如共、需双方在合同执行过程中发生争议，由双方协商解决，协商不成的，提交合同签订地的人民法院诉讼解决。</p>
					<h3>第七条 其他约定</h3>
					<p>（一）本合同双方确认后生成电子版合同文本，此文本具有法律效力；</p>
					<div class="write_div">
						<span>（二）</span>
						<div class="writ_div label_for" contenteditable="true" style="width: 1000px;"></div>
						<input type="hidden" class="label_txt" name="other_assumpsit">
					</div>
					<table class="table_txta">
						<tr>
							<td>
								<div class="zhang_re">
									<div>供方：{{ $order->seller->name or '未知' }}</div>
									<div><span>代理人：</span><div class="writ_div label_for" contenteditable="fasle" style="width: 200px;"></div><input type="hidden" class="label_txt" /></div>
									<div class="zhang_img">
										<img src="/assets/admin/img/zhang.png" height="100%">
									</div>
								</div>
							</td>
							<td>
								<div class="zhang_re">
									<div>需方：{{ $order->user->seller->name or '未知' }}</div>
									<div><span>代理人：</span><div class="writ_div label_for" contenteditable="true" style="width: 200px;"></div><input type="hidden" class="label_txt" name="demander_agent"></div>
									<div class="zhang_img">
										<img src="/assets/admin/img/zhang.png" height="100%">
									</div>
								</div>	
							</td>
						</tr>
					</table>
				</div>
				<div class="contract_btn">
					<a href="javascript:;" class="aback">取消签约</a>
					@if($order->status == -1 && !$order->contract)
						<button type="submit" class="anext_btn">发起合同</button>
					@else
						<button type="submit" class="anext_btn">确定</button>
					@endif
				</div>
			</div>
		</div>
		</form>
		<!--查看附件-->
		<div class="com_div">
			<div class="box_shadow"></div>
			<div class="box_content" style="overflow-y: auto; padding: 0px; background: none; text-align: center;">
				<img style="max-width: 100%;" src="">	
			</div>
		</div>
		<script>
			$(function(){
                $(document).on("click", ".contract_btn .aback", function() {
                    $.confirm("", "确认取消签约吗", function() {
                        $.toast("确认操作");
                        var id = "{{ $order->id }}";
                        $.ajax({
                            type:"GET",
                            url:"{{ route('user.order.cancel') }}",
                            data:{id:id},
                            datatype: "json",
                            success:function(e){
                                console.log(e);
                                if (e.result == true){
                                    window.location.href="{{ route('user.home') }}";
                                }
                            },
                            error: function(){
                            }
                        });
                    }, function() {
                        //取消操作
                    });
                });

				//弹出
				$(".lxsj").click(function(){
					var tel=$(this).data("tel");
		            $.alert("请拨打电话："+tel, "联系方式");
				})
				//删除附件
				$(document).on("click",".delete_fj",function(){
					var czdx=$(this);
					$.confirm("", "确定删除", function() {
			          czdx.parents("li").remove();
			        }, function() {
			          //取消操作
			        });
				});
				//查看附件
				$(document).on("click",".check_fj",function(){
					var img_attr=$(this).parents("li").find(".img_div img").attr("src");
					$(".box_shadow,.box_content").show();
					$(".box_content img").attr("src",img_attr);
				});
				
				$(".box_shadow,.box_content").click(function(){
					$(".box_shadow,.box_content").hide();
					$(".box_content img").attr("src","");
				})
				//inputhidden
				$(".label_for").focusout(function(){
					$(this).siblings(".label_txt").val($(this).html());
					console.log($(".label_txt").val());
				});
			})
		</script>
		<!--footer-->
			@endsection
	
	@section('footer')		
		<!--footer-->
		@include('_layouts.shop_footer1')
	@endsection
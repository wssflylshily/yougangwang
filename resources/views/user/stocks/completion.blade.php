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
				<li class="pass">发票处理</li>
				<li class="cur">交易完成</li>
			</ul>
			<div class="com_title">
				<img src="/assets/shop/img/jy_03.png">
			</div>
			<div style=" width: 1131px; margin: -37px 0px 0px 69px; padding-top: 40px; border-top: 1px solid #426dcc;">
				<div style="text-align: center;">
					<h2 style="font-size: 18px;"><img src="/assets/shop/img/qhtx_03.png" width="30" style="vertical-align: middle;"> 交易完成，请对本次交易进行评价</h2>
					<div class="com_distance" style="padding: 15px 0px;">
						<span>订单号： {{ $order->order_sn or '' }} </span>
						<span>（签约日期：<?php echo substr($order->created_at,0,4) ?>年<?php echo substr($order->created_at,5,2) ?>月<?php echo substr($order->created_at,8,2) ?>日）</span>
						<span> 商家名称： {{ $order->seller->name or '' }}</span>
					</div>
					<h3 style="font-size: 16px; color: #436bcd; margin-bottom: 15px;">综合评价</h3>
					<span id="notice" style="color: red">@if($comment) 评价完成 @endif</span>
					@if($comment)
						<div class="com_star">
							@for($i=0;$i<$comment->star;$i++)
								<span title="1" class="on"></span>
							@endfor
						</div>
					@else
					<div class="com_star">
						<span title="1"></span>
						<span title="2"></span>
						<span title="3"></span>
						<span title="4"></span>
						<span title="5"></span>
					</div>
					@endif
				</div>
				<div style="width: 400px; margin: 15px auto;">
					<ul class="order_evaluate clear">
						{{--<li class="L"><label><input type="checkbox" name="pjxz" class="check_btn"> 是否按时发货</label></li>
						<li class="L"><label><input type="checkbox" name="pjxz" class="check_btn"> 是否满足客户需求</label></li>
						<li class="L"><label><input type="checkbox" name="pjxz" class="check_btn"> 质量是否无损伤</label></li>
						<li class="L"><label><input type="checkbox" name="pjxz" class="check_btn"> 是否服务态度好</label></li>
						<li class="L"><label><input type="checkbox" name="pjxz" class="check_btn"> 物流是否快</label></li>
						<li class="L"><label><input type="checkbox" name="pjxz" class="check_btn"> 是否按时开发票</label></li>--}}
						@if($comment)

						@else
							@if($options)
								@foreach($options as $option)
									<li class="L"><label><input type="checkbox" value="{{ $option->id }}" name="pjxz" class="check_btn"> {{ $option->text }}</label></li>
								@endforeach
							@endif
						@endif
					</ul>
				</div>
				<div style="width: 650px; margin: 15px auto;">
					<textarea class="message" style="padding: 20px; width: 100%; height: 120px; background: #FFFFFF; border: 1px solid #ddd;" placeholder="请在此填写更多评价内容，祝您下次购物愉快。">@if($comment){{ $comment->message }}@endif</textarea>
				</div>
				<div class="com_div" style="margin: 20px auto; text-align: center;">
					@if($comment)
					@else
						<a href="#" class="com_btn">确 认 提 交</a>
					@endif
				</div>
			</div>
		</div>
		<!--footer-->
		<script>
			$(function(){
				//点击评分
				var score = 0;
				$(".com_star span").click(function(){
					var score=$(this).index()+1;
                    sessionStorage.setItem('score',score);
					//console.log(sessionStorage);
					$(".com_star span").each(function(index,e){
						if($(this).index()<score)
						{
							$(this).addClass("on");
						}
						else
						{
							$(this).removeClass("on");
						}
					});
					
				});
				//鼠标经过
				$(".com_star span").hover(function(){
					var score=$(this).index()+1;
					$(".com_star span").each(function(index,e){
						if($(this).index()<score)
						{
							$(this).addClass("cur");
						}
						else
						{
							$(this).removeClass("cur");
						}
					});
				},function(){
					$(".com_star span").removeClass("cur");
				})

				$(".com_btn").click(function () {
				    var score = sessionStorage.getItem('score');
				    var message = $(".message").val();
				    var order_id = "{{ $order->id }}";
				    var _token = "{{ csrf_token() }}";
				    console.log(score);
                    var chk_value = [];
                    $('input[name="pjxz"]:checked').each(function(){
                        chk_value.push($(this).val());
                    });
                    //alert(chk_value.length==0 ?'你还没有选择任何内容！':chk_value);
					if (score <= 0 || message == "" || order_id == "" || chk_value.length == 0){
                        $('#notice').html("信息填写不完整");
					}
                    $.ajax({
                        type:"POST",
                        url:"{{ route('user.stocks.comment.post') }}",
                        data:{star:score,options:chk_value,message:message,order_id:order_id,_token:_token},
                        datatype: "json",
                        success:function(e){
                            console.log(e);
                            if (e.result == true){
                                window.location.href="{{ route('user.home') }}";
							}else {
                                $('#notice').html(e.message);
							}
                        },
                        error: function(){
                        }
                    });
                })
			})
		</script>
		<!-- Toaster -->
		<script src="/plugins/jquery-toaster/jquery.toaster.js"></script>

		<!-- pages script -->
		<script src="/assets/base.js"></script>
@endsection

@section('footer')
	@include('_layouts.shop_footer2')
@endsection

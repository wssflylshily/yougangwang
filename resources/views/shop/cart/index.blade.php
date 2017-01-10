@extends('_layouts.shop')

@section('main-content')
	<form action="{{ route('shop.order.checkout.post') }}" method="POST" class="main-form" accept-charset="UTF-8" autocomplete="off" novalidate="novalidate">
		<input type="hidden" name="_token" value="{{ csrf_token() }}" id="csrfToken">
		<!--banner-->
		<div class="shop_car mid_div">
			<div class="com_title">
				<img src="/assets/shop/img/cartitle_06.png">
				<div class="wars R"><img src="/assets/shop/img/war_09.png"> 您的订单涉及到<span class="seller-cnt">{{ $seller_cnt }}</span>个商家，购买后请一一与其签约合同。</div>
			</div>
			<div style=" width: 1131px; margin: -37px 0px 0px 69px;">
				<!--结算头-->
				<div class="ten_t clear">
					<div class="L one"><input class="check_btn" name="allcheck" type="checkbox"> 全选</div>
					<div class="L two">地区</div>
					<div class="L three">品种</div>
					<div class="L four">标准</div>
					<div class="L five">材质</div>
					<div class="L six">钢厂</div>
					<div class="L seven">规格</div>
					<div class="L eight">吨数</div>
					<div class="L nine">价格（元/吨）</div>
					<div class="L ten">操作</div>
				</div>
				<!--购物车内容-->
				<dl class="car_list">
				@php($seller = 0)
				@foreach ($cart_goods as $goods)
					@if ($seller == 0)
						<dt><input name="c_all" class="check_btn" type="checkbox" data-rel="{{ $goods->seller->id }}"> {{ $goods->seller->name }}</dt>
					@elseif ($goods->seller->id != $seller)
					</dl>
					<dl class="car_list">
						<dt><input name="c_all" class="check_btn" type="checkbox" data-rel="{{ $goods->seller->id }}"> {{ $goods->seller->name }}</dt>
					@endif

					<dd class="clear">
						<div class="L one"><input class="check_btn" name="onecheck[]" type="checkbox" value="{{ $goods->id }}"></div>
						<div class="L two single_txt">{{ $goods->ori->area_code or '' }}</div>
						<div class="L three single_txt">{{ $goods->ori->variety or '' }}</div>
						<div class="L four single_txt">{{ $goods->ori->standard or '' }}</div>
						<div class="L five single_txt">{{ $goods->ori->material or '' }}</div>
						<div class="L six single_txt">{{ $goods->ori->steelmill or '' }}</div>
						<div class="L seven single_txt">{{ $goods->ori->length . '*' . $goods->ori->thickness . '*' . $goods->ori->outer_diameter }}</div>
						<div class="L eight single_txt"><input type="number" name="dnum" value="{{ $goods->buy_number }}"></div>
						<div class="L nine single_txt">￥<span class="price">{{ $goods->buy_price }}</span></div>
						<div class="L ten single_txt"><a href="#" class="delete-single" rel="{{ $goods->id }}">删除</a></div>
					</dd>
					@php($seller = $goods->seller->id)
				@endforeach
				</dl>

				<!--结算数字-->
				<div class="ten_d clear">
					<div class="L one"><input class="check_btn" name="allcheck" type="checkbox"> 全选</div>
					<div class="L two delete-selected"><a href="#">删除</a></div>
					<div class="L seven" style="margin-left: 370px; width: 200px; text-align: left;">已选商品   <i id="total_num">0</i>   件</div>
					<div class="L seven" style="width: 240px; text-align: left;">合计：<em>￥</em><em class="e01" id="total_price">0.00</em></div>
					<div class="R"><button type="submit" class="btn">结 算</button></div>
				</div>
			</div>
		</div>
		
		<!--box-->
		<div class="com_div">
			<div class="box_shadow"></div>
			<div class="box_content" style="width: 1000px; margin-left: -520px; padding-bottom: 60px;">
				<div style="width: 1000px;">
					<div class="index_tab">
						<ul>
							<li class="cur">
								<h2>方案一</h2>
								<h3>同供应商总价排名（升序）</h3>
							</li><li>
								<h2>方案二</h2>
								<h3>同供应商总价排名（升序）</h3>
							</li>
						</ul>
					</div>
					<div class="order_pay shop_car order_com tanchu fangan">	
						<div class="ten_t clear">
							<div class="L one">商家</div>
							<div class="L two">品种</div>
							<div class="L three">标准</div>
							<div class="L four">材质</div>
							<div class="L five">钢厂</div>
							<div class="L six">规格</div>							
							<div class="L eight">吨数</div>
							<div class="L seven">单价(元/吨)</div>
							<div class="L nine">总计</div>
							<div class="L eleven">选择</div>							
						</div>
						<!--订单情况-->
						<div class="order_list">
							<ul class="order_ul">
								<li class="clear shangpin">
									<div>
										<div class="clear">
											<div class="L one single_txt shop_dname">山东鲁业钢铁销售有限公司</div>
										</div>
									</div>
									<div>
										<div class="clear">
											<div class="L two single_txt">无缝管</div>
											<div class="L three single_txt">API 5L</div>
											<div class="L four single_txt">#20</div>
											<div class="L five single_txt">鞍钢</div>
											<div class="L six single_txt">219*9.8*12000</div>											
											<div class="L eight">30</div>
											<div class="L seven single_txt">3120</div>
										</div>
										<div class="clear">
											<div class="L two single_txt">无缝管</div>
											<div class="L three single_txt">API 5L</div>
											<div class="L four single_txt">#20</div>
											<div class="L five single_txt">鞍钢</div>
											<div class="L six single_txt">219*9.8*12000</div>											
											<div class="L eight">30</div>
											<div class="L seven single_txt">31200</div>
										</div>
									</div>
									<div>
										<div class="L nine">￥325000.00</div>
										<div class="L eleven">
											<input type="checkbox" class="check_btn" value="1">
										</div>	
									</div>
								</li>
							</ul>
						</div>
						<div class="order_list">
							<ul class="order_ul">
								<li class="clear shangpin">
									<div>
										<div class="clear">
											<div class="L one single_txt shop_dname">山东鲁业钢铁销售有限公司</div>
										</div>
									</div>
									<div>
										<div class="clear">
											<div class="L two single_txt">无缝管</div>
											<div class="L three single_txt">API 5L</div>
											<div class="L four single_txt">#20</div>
											<div class="L five single_txt">鞍钢</div>
											<div class="L six single_txt">219*9.8*12000</div>
											<div class="L eight">30</div>
											<div class="L seven single_txt">3120</div>											
										</div>
										<div class="clear">
											<div class="L two single_txt">无缝管</div>
											<div class="L three single_txt">API 5L</div>
											<div class="L four single_txt">#20</div>
											<div class="L five single_txt">鞍钢</div>
											<div class="L six single_txt">219*9.8*12000</div>
											<div class="L eight">30</div>
											<div class="L seven single_txt">31200</div>											
										</div>
									</div>
									<div>
										<div class="L nine">￥325000.00</div>
										<div class="L eleven">
											<input type="checkbox" class="check_btn" value="1">
										</div>
									</div>
								</li>
							</ul>
						</div>
					</div>
					<div class="order_pay shop_car order_com tanchu fangan" style="display: none;">	
						<div class="ten_t clear">
							<div class="L one">商家</div>
							<div class="L two">品种</div>
							<div class="L three">标准</div>
							<div class="L four">材质</div>
							<div class="L five">钢厂</div>
							<div class="L six">规格</div>							
							<div class="L eight">吨数</div>
							<div class="L seven">单价(元/吨)</div>
							<div class="L nine">总计</div>
							<div class="L eleven">选择</div>							
						</div>
						<!--订单情况-->
						<div class="order_list">
							<ul class="order_ul">
								<li class="clear shangpin">
									<div>
										<div class="clear">
											<div class="L one single_txt shop_dname">山东鲁业钢铁销售有限公司</div>
										</div>
									</div>
									<div>
										<div class="clear">
											<div class="L two single_txt">无缝管</div>
											<div class="L three single_txt">API 5L</div>
											<div class="L four single_txt">#20</div>
											<div class="L five single_txt">鞍钢</div>
											<div class="L six single_txt">219*9.8*12000</div>											
											<div class="L eight">30</div>
											<div class="L seven single_txt">3120</div>
										</div>
										<div class="clear">
											<div class="L two single_txt">无缝管</div>
											<div class="L three single_txt">API 5L</div>
											<div class="L four single_txt">#20</div>
											<div class="L five single_txt">鞍钢</div>
											<div class="L six single_txt">219*9.8*12000</div>											
											<div class="L eight">30</div>
											<div class="L seven single_txt">31200</div>
										</div>
									</div>
									<div>
										<div class="L nine">￥325000.00</div>
										<div class="L eleven">
											<input type="checkbox" class="check_btn" value="1">
										</div>	
									</div>
								</li>
							</ul>
						</div>
						<div class="order_list">
							<ul class="order_ul">
								<li class="clear shangpin">
									<div>
										<div class="clear">
											<div class="L one single_txt shop_dname">山东鲁业钢铁销售有限公司</div>
										</div>
									</div>
									<div>
										<div class="clear">
											<div class="L two single_txt">无缝管</div>
											<div class="L three single_txt">API 5L</div>
											<div class="L four single_txt">#20</div>
											<div class="L five single_txt">鞍钢</div>
											<div class="L six single_txt">219*9.8*12000</div>
											<div class="L eight">30</div>
											<div class="L seven single_txt">3120</div>											
										</div>
										<div class="clear">
											<div class="L two single_txt">无缝管</div>
											<div class="L three single_txt">API 5L</div>
											<div class="L four single_txt">#20</div>
											<div class="L five single_txt">鞍钢</div>
											<div class="L six single_txt">219*9.8*12000</div>
											<div class="L eight">30</div>
											<div class="L seven single_txt">31200</div>											
										</div>
									</div>
									<div>
										<div class="L nine">￥325000.00</div>
										<div class="L eleven">
											<input type="checkbox" class="check_btn" value="1">
										</div>
									</div>
								</li>
							</ul>
						</div>
					</div>
					
					<div class="clear operate_btn">
						<button type="button" class="fabubtn gray back_infor">取消</button>
						<button type="button" class="fabubtn submit_infor">确定</button>
					</div>
				</div>
			</div>
		</div>
	</form>


		<script>
        	function allcheck(){
				var a=0,b=0;
				var all_price=0,all_num=0;
				$(".car_list").each(function(){
					a=0;
					$(this).children("dd").each(function(){							
						if($(this).find("input[name='onecheck[]']").attr("checked"))
						{
							a++;
							b++;
							all_price+=parseInt($(this).find("input[name='dnum']").val())*parseFloat($(this).find(".price").html());
							all_num+=parseInt($(this).find("input[name='dnum']").val());
						}
						
					});
					if(a==$(this).children("dd").length)
					{
						$(this).find("input[name='c_all']").attr("checked","checked");
					}
					else
					{
						$(this).find("input[name='c_all']").removeAttr("checked");
					}
				})
				if(b==$("input[name='onecheck[]']").length)
				{
					$("input[name='allcheck']").attr("checked","checked");
				}
				else
				{
					$("input[name='allcheck']").removeAttr("checked");
				}
				$("#total_num").html(all_num);
				$("#total_price").html(parseFloat(all_price).toFixed(2));
			}
			$(function(){
				
				function allcheck(){
					var a=0,b=0;
					var all_price=0,all_num=0;
					$(".car_list").each(function(){
						a=0;
						$(this).children("dd").each(function(){							
							if($(this).find("input[name='onecheck[]']").attr("checked"))
							{
								a++;
								b++;
								all_price+=parseInt($(this).find("input[name='dnum']").val())*parseFloat($(this).find(".price").html());
								all_num+=parseInt($(this).find("input[name='dnum']").val());
							}
							
						});
						if(a==$(this).children("dd").length)
						{
							$(this).find("input[name='c_all']").attr("checked","checked");
						}
						else
						{
							$(this).find("input[name='c_all']").removeAttr("checked");
						}
					})
					if(b==$("input[name='onecheck[]']").length)
					{
						$("input[name='allcheck']").attr("checked","checked");
					}
					else
					{
						$("input[name='allcheck']").removeAttr("checked");
					}
					$("#total_num").html(all_num);
					$("#total_price").html(parseFloat(all_price).toFixed(2));
				}
				//全选
				$("input[name='allcheck']").change(function(){
					if($(this).attr("checked"))
					{
						$("input[name='c_all']").attr("checked","checked");
						$("input[name='onecheck[]']").attr("checked","checked");
					}
					else
					{
						$("input[name='c_all']").removeAttr("checked");
						$("input[name='onecheck[]']").removeAttr("checked");
					}
					allcheck();
				});
				//公司全选
				$("input[name='c_all']").change(function(){
					if($(this).attr("checked"))
					{
						$(this).parents("dl").find("input[name='onecheck[]']").attr("checked","checked");
					}
					else
					{
						$(this).parents("dl").find("input[name='onecheck[]']").removeAttr("checked");
					}
					allcheck();
				});
				//单个选择
				$("input[name='onecheck[]']").change(function(){
					allcheck();
				});
				//单个数字
				$("input[name='dnum']").change(function(){
					allcheck();
				});
			})
		</script>

		<!-- Toaster -->
		<script src="/plugins/jquery-toaster/jquery.toaster.js"></script>

		<!-- pages script -->
		<script src="/assets/shop/js/pages/cart.js"></script>

		<script>
			$(function(){
                var cart = new Cart();
                $(document).on('click', '.delete-selected', function() {
                    cart.deleteSelected();
                });

                $(document).on('click', '.delete-single', function() {
                    cart.deleteSelected($(this).attr('rel'), $(this));
                });
			});
		</script>
@endsection

@section('footer')
		<!--footer-->
		@include('_layouts.shop_footer1')
@endsection
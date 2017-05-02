@extends('_layouts.shop')

@section('main-content')
	<form action="{{ route('shop.order.checkout.post') }}" method="POST" class="main-form" accept-charset="UTF-8" autocomplete="off" novalidate="novalidate">
		<input type="hidden" name="_token" value="{{ csrf_token() }}" id="csrfToken">
		<!--banner-->
		<div class="shop_car mid_div">
			<div class="com_title">
				<img src="/assets/shop/img/cartitle_06.png">
				<div class="wars R"><img src="/assets/shop/img/war_09.png"> 您的订单涉及到<span class="seller-cnt">{{ $seller_cnt }}</span>个商家，购买后请一一与其签约合同。</div>
				<div class="R"><a href="javascript:;" class="tuijian_btn" style="margin-right: 100px">推荐方案</a> </div>
			</div>
			<div class="xuanze_div" style=" width: 1131px; margin: -37px 0px 0px 69px;">
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
				
				@php($seller = 0)
				@foreach ($cart_goods as $goods)
				<dl class="car_list">
					@if ($seller == 0)
						<dt><input name="c_all" class="check_btn" type="checkbox" data-rel="{{ $goods->seller->id or '-' }}"> {{ $goods->seller->name or '-' }}</dt>
					@elseif ($goods->seller->id != $seller)
					</dl>

					<dl class="car_list">
						<dt><input name="c_all" class="check_btn" type="checkbox" data-rel="{{ $goods->seller->id or '-' }}"> {{ $goods->seller->name or '-' }}</dt>
					@endif

					<dd class="clear">
						<div class="L one"><input class="check_btn" name="onecheck[]" type="checkbox" value="{{ $goods->id or ''}}"></div>
						<div class="L two single_txt">@foreach($areas as $area)@if($area->areaId == $goods->ori->area_code){{ $area->areaName }}@endif @endforeach</div>
						<div class="L three single_txt">{{ $goods->ori->variety or '-' }}</div>
						<div class="L four single_txt">{{ $goods->ori->standard or '-' }}</div>
						<div class="L five single_txt">{{ $goods->ori->material or '-' }}</div>
						<div class="L six single_txt">{{ $goods->ori->steelmill or '-' }}</div>
						<div class="L seven single_txt">{{ $goods->ori->length . '*' . $goods->ori->thickness . '*' . $goods->ori->outer_diameter }}</div>
						<div class="L eight single_txt"><input type="number" name="dnum[]" value="{{ $goods->buy_number or '-' }}"></div>
						<div class="L nine single_txt">￥<span class="price">{{ $goods->buy_price or '-' }}</span></div>
						<div class="L ten single_txt"><a href="javascript:;" class="delete-single" rel="{{ $goods->id  or ''}}">删除</a></div>
					</dd>
					{{--@php($seller = $goods->seller->id)--}}
					</dl>
				@endforeach
				

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
	</form>
		
		<!--box-->
		<div class="com_div">
			<div class="box_shadow"></div>
			<div class="box_content" style="width: 1000px; margin-left: -520px; padding-bottom: 60px;">
				<div style="width: 1000px;">
					<div class="index_tab">
						<ul>
							<li class="cur" style="cursor: pointer">
								<h2>方案一</h2>
								<h3>同供应商总价排名（升序）</h3>
							</li>
							<li style="cursor: pointer">
								<h2>方案二</h2>
								<h3>同城不同供应商总价排名（升序）</h3>
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
						<div id="one">

						</div>
					</div>
					<div class="order_pay shop_car order_com tanchu fangan" style="display: none;">	
						<div class="ten_t clear">
							<div class="L one">地区</div>
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
						<div id="two">

						</div>
					</div>
					
					<div class="clear operate_btn">
						<button type="button" class="fabubtn gray back_infor">取消</button>
						<button type="button" class="fabubtn submit_infor">确定</button>
					</div>
				</div>
			</div>
		</div>

		<script>
            $(".tuijian_btn").click(function(){
                var chk_value = [];
                $('input[name="onecheck[]"]:checked').each(function(){
                    chk_value.push($(this).val());
                });
                if (chk_value.length<=1)
				{
				    alert("您选择的商品少于两个！");
				    exit();
				} else {
                    $.ajax({
                        type:"GET",
                        url:"{{route('shop.cart.recommend.one')}}",
                        data: {goods_id:chk_value},
                        datatype: "json",
                        success:function(json){
                            var data = JSON.parse(json);
                            console.log(data)
							var str = "";
                            for (var i=0;i<data.length;i++)
							{
							    var price = 0;
							    var ids = [];
							    var buy_num = [];
                                str += '<div class="order_list">'+
                                    '<ul class="order_ul">'+
                                    '<li class="clear shangpin">'+
                                    '<div>'+
                                    '<div class="clear">'+
                                    '<div class="L one single_txt shop_dname">'+data[i].seller_name+'</div>'+
                                    '</div>'+
                                    '</div>'+
                                    '<div>';

										for(var j=0;j<(data[i].goods).length;j++){
											str += '<div class="clear">'+
                                                '<div class="L two single_txt">'+data[i].goods[j].variety+'</div>'+
                                                '<div class="L three single_txt">'+data[i].goods[j].standard+'</div>'+
                                                '<div class="L four single_txt">'+data[i].goods[j].material+'</div>'+
                                                '<div class="L five single_txt">'+data[i].goods[j].steelmill+'</div>'+
                                                '<div class="L six single_txt">'+data[i].goods[j].length+'*'+data[i].goods[j].thickness+'*'+data[i].goods[j].outer_diameter+'</div>'+
                                                '<div class="L eight">'+data[i].goods[j].buy_num+'</div>'+
                                                '<div class="L seven single_txt">'+data[i].goods[j].price+'</div>'+
                                                '</div>';
                                            price += parseFloat(data[i].goods[j].price)*data[i].goods[j].buy_num;
                                            ids.push(data[i].goods[j].id);
                                            buy_num.push(data[i].goods[j].buy_num);
										}

                                    str += '</div>'+
                                    '<div>'+
                                    '<div class="L nine">￥'+price+'</div>'+
                                    '<div class="L eleven">'+
                                	'<input type="hidden" name="buy_num" value="'+buy_num+'">'+
									'<input type="radio" class="check_btn" name="ids" data-num="'+buy_num+'" value="'+ids+'">'+
                                    '</div>'+
                                    '</div>'+
                                    '</li>'+
                                    '</ul>'+
                                    '</div>';
							}

                            $('#one').html("");
                            $('#one').append(str);
                        },
                        error: function(){
                        }
                    });

                    $.ajax({
                        type:"GET",
                        url:"{{route('shop.cart.recommend.two')}}",
                        data: {goods_id:chk_value},
                        datatype: "json",
                        success:function(json){
                            var data = JSON.parse(json);
                            console.log(data)
                            var str = "";
                            for (var i=0;i<data.length;i++)
                            {
                                var price = 0;
                                var ids = [];
                                var buy_num = [];
                                str += '<div class="order_list">'+
                                    '<ul class="order_ul">'+
                                    '<li class="clear shangpin">'+
                                    '<div>'+
                                    '<div class="clear">'+
                                    '<div class="L one single_txt shop_dname">'+data[i].area_name.areaName+'</div>'+
                                    '</div>'+
                                    '</div>'+
                                    '<div>';

                                for(var j=0;j<(data[i].goods).length;j++){
                                    str += '<div class="clear">'+
                                        '<div class="L two single_txt">'+data[i].goods[j].variety+'</div>'+
                                        '<div class="L three single_txt">'+data[i].goods[j].standard+'</div>'+
                                        '<div class="L four single_txt">'+data[i].goods[j].material+'</div>'+
                                        '<div class="L five single_txt">'+data[i].goods[j].steelmill+'</div>'+
                                        '<div class="L six single_txt">'+data[i].goods[j].length+'*'+data[i].goods[j].thickness+'*'+data[i].goods[j].outer_diameter+'</div>'+
                                        '<div class="L eight">'+data[i].goods[j].buy_num+'</div>'+
                                        '<div class="L seven single_txt">'+data[i].goods[j].price+'</div>'+
                                        '</div>';
                                    price += parseFloat(data[i].goods[j].price)*data[i].goods[j].buy_num;
                                    ids.push(data[i].goods[j].id);
                                    buy_num.push(data[i].goods[j].buy_num);
                                }

                                str += '</div>'+
                                    '<div>'+
                                    '<div class="L nine">￥'+price+'</div>'+
                                    '<div class="L eleven">'+
                                    '<input type="hidden" name="buy_num" value="'+buy_num+'">'+
                                    '<input type="radio" class="check_btn" name="ids" data-num="'+buy_num+'" value="'+ids+'">'+
                                    '</div>'+
                                    '</div>'+
                                    '</li>'+
                                    '</ul>'+
                                    '</div>';
                            }

                            $('#two').html("");
                            $('#two').append(str);
                        },
                        error: function(){
                        }
                    });

                    $(".box_shadow").show();
                    $(".box_content").show();
				}
                //alert(chk_value.length==0 ?'你还没有选择任何内容！':chk_value);

            });

            $(".back_infor").click(function(){
                $(".box_shadow").hide();
                $(".box_content").hide();
            });
            $(".submit_infor").click(function(){
                var buy_num = ($("input[name='ids']:checked").attr('data-num')).split(",");
                var ids = ($("input[name='ids']:checked").val()).split(",");

                var cart = new Cart();
                for (var i=0;i<ids.length;i++)
				{
				    //console.log(ids[i], buy_num[i]);
                    cart.add(ids[i], buy_num[i]);
                    cart.deleteSelected();
                    window.location="{{ route('shop.cart') }}"
				}

            });
            //方案tab
            $(".index_tab ul li").click(function(){
                $(this).addClass("cur").siblings().removeClass("cur");
                var index=$(this).index();
                $(".fangan:eq("+index+")").show().siblings(".fangan").hide();
            })

		</script>
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
							all_price+=parseInt($(this).find("input[name='dnum[]']").val())*parseFloat($(this).find(".price").html());
							all_num+=parseInt($(this).find("input[name='dnum[]']").val());
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
						
			// allcheck();
			//全选
			//allcheck
				$("input[name='allcheck']").change(function(){
					if($(this).attr("checked"))
					{
						$(this).parents(".xuanze_div").find("input[type='checkbox']").attr("checked","checked");
					}
					else
					{
						$(this).parents(".xuanze_div").find("input[type='checkbox']").removeAttr("checked");
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
				$("input[name='dnum[]']").change(function(){
					allcheck();
				});


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
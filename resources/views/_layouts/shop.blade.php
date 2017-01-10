<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>优钢网-首页</title>
		<link rel="stylesheet" href="/assets/shop/css/weui.min.css" />
		<link rel="stylesheet" href="/assets/shop/css/jquery-weui.css" />
		<link rel="stylesheet" href="/assets/shop/css/style.css" />
		<link rel="stylesheet" href="/assets/shop/css/person.css"/>
		<style>
			/*.list_nine .one,.list_nine .two,.list_nine .three,.list_nine .four,.list_nine .five,.list_nine .six,.list_nine .seven,.list_nine .eight,.list_nine .nine,.list_nine .ten{ display: table-cell; vertical-align:middle; word-break:break-all; word-wrap:break-word;}
			.list_nine .L{ float: none;}*/
		</style>
		<script type="text/javascript" src="/assets/shop/js/jquery-1.8.3.min.js" ></script>
		<script type="text/javascript" src="/assets/shop/js/jqwebui.js" ></script>
		<script>
			$(function(){
				$(".tuijian_btn").click(function(){
					$(".box_shadow").show();
					$(".box_content").show();
				});
				$(".back_infor").click(function(){
					$(".box_shadow").hide();
					$(".box_content").hide();
				});
				$(".submit_infor").click(function(){
					
				});
				//方案tab
				$(".index_tab ul li").click(function(){
					$(this).addClass("cur").siblings().removeClass("cur");
					var index=$(this).index();
					$(".fangan:eq("+index+")").show().siblings(".fangan").hide();
				})
			})
			
		</script>
	</head>
	<body>
		<!--top-->
		<div class="top_bg">
			<div class="mid_div clear">
				<div class="L">
					<span class="addr"><em>天津</em>
						<div class="add_selec">
							<ul class="clear">
								<li><a href="#" class="cur">天津</a></li>
								<li><a href="#">北京</a></li>
								<li><a href="#">河北</a></li>
								<li><a href="#">上海</a></li>
								<li><a href="#">北京</a></li>
								<li><a href="#">河北</a></li>
								<li><a href="#">上海</a></li>
								<li><a href="#">北京</a></li>
								<li><a href="#">河北</a></li>
								<li><a href="#">上海</a></li>
							</ul>
						</div>
					</span>
					<span><i>{{ Auth::check() ? Auth::user()->name : '' }}</i> 欢迎您</span>
				</div>
				<div class="R">
					@if (Auth::check())
					<a href="{{ route('auth.logout') }}" class="cur">退出</a>
					@else
					<a href="{{ route('auth.login') }}">您好，请登录 </a><a href="{{ route('auth.register') }}" class="cur">免费注册</a>
					@endif
					<a href="/user">个人中心</a>
					<a href="/message">消息中心</a>
					<div class="xiaoxi" id="result">消息中心
						<i>(您有<span id="mes_num">0</span>份合同等待签约)</i>
						<div class="xiao_div">
							<ul>
								{{--<li>
									<div class="div1 L single_txt">天津华远兴业</div>
									<div class="div2 L single_txt">已同意您的现货合同条款</div>
									<div class="R"><a href="#">前去签约</a></div>
								</li>--}}
							</ul>
						</div>
					</div>
					<a href="/after-service">售后服务</a><a href="/seller">我的商铺</a>
					<!-- <a href="/customer-center">客户中心</a> --><a href="/help">帮助</a>
				</div>
			</div>
		</div>
		<!--menu-->
		<div class="menu_bg">
			<div class="mid_div clear">
				<div class="L"><a href="/"><img src="/assets/shop/img/index_11.png"></a></div>
				<div class="R">
					@php($active = isset($active) ? $active : ''; $class[$active] = 'class="cur"';)
					<ul>
						<li><a href="/" {!! $class['home'] or '' !!}>首页</a></li>
						<li><a href="/stocks" {!! $class['stocks'] or '' !!}>现货交易</a></li>
						<li><a href="/futures" {!! $class['futures'] or '' !!}>期货交易</a></li>
						<li><a href="/special" {!! $class['special'] or '' !!}>特卖</a></li>
						<li><a href="#" style="color: #e7e7e7;">行情分析</a></li>
						<li class="future-publish"><a href="/futures/publish">发布期货</a></li>
						<li class="cart">
							<a href="/cart"><img src="/assets/shop/img/cart.jpg">我的购物车&nbsp;&nbsp;&nbsp;&gt;</a>
							<div class="list_num">0</div>
							@if (Request::is('cart_tmp'))
							<div class="car_wp">
								<div class="lidiv clear">
									<div class="one clear"><input class="check_btn" type="checkbox" name="neirong" value=""></div>
									<div class="two single_txt">无缝管无缝管无缝管无缝管无缝管</div>
									<div class="three single_txt">219*9.8*12000</div>
									<div class="four single_txt">56 吨</div>
								</div>
								<div class="lidiv clear">
									<div class="one"><input class="check_btn" type="checkbox" name="neirong" value=""></div>
									<div class="two single_txt">无缝管无缝管无缝管无缝管无缝管</div>
									<div class="three single_txt">219*9.8*12000</div>
									<div class="four single_txt">56 吨</div>
								</div>
								<div class="lidiv clear">
									<div class="one"><input class="check_btn" type="checkbox" name="neirong" value=""></div>
									<div class="two single_txt">无缝管无缝管无缝管无缝管无缝管</div>
									<div class="three single_txt">219*9.8*12000</div>
									<div class="four single_txt">56 吨</div>
								</div>
								<div class="car_op clear">
									<div class="L"><a href="javascript:;" class="tuijian_btn">推荐方案</a></div>
									<div class="R"><a href="/cart" class="a01">我的购物车</a><a href="#" class="a02">购买</a></div>
								</div>
							</div>
							@endif
						</li>
					</ul>
				</div>
			</div>
		</div>

        @yield('main-content')
        @yield('footer')
        <div id="hidden-items" style="display: none;">
            <input type="hidden" name="_token" value="{{ csrf_token() }}" id="csrfToken">
        </div><!-- /#hidden-items -->

		<script src="/assets/shop/js/pages/cart.js"></script>

		<script type="text/javascript">
            $.ajax({
                type:"GET",
                url:"{{route('notification.index')}}",
                datatype: "json",

                success:function(json){

                    var data = JSON.parse(json);
//                    console.log(data);

                    $('#mes_num').html(data.length);
                    var str = "";
                    for(var i=0;i<data.length;i++){
//                        alert(data[i].nid);
                        /*str += '<option value="'+data[i].areaId+'">'+data[i].areaName+'</option>';*/
                        str += '<li>'+
                            '<div class="div1 L single_txt">'+data[i].name+'</div>'+
                            '<div class="div2 L single_txt">'+data[i].message+'</div>'+
                            '<div class="R"><a href="/Notification/read/'+ data[i].nid +' ">前去签约</a></div>'+
                            '</li>';
                        $('.xiao_div ul').html("");
                        $('.xiao_div ul').append(str);
                    }
                },
                error: function(){
                }
            });

		</script>

		<script id="t:_1234-abcd-1" type="text/html">

			<i>(您有<%=data.length%>份合同等待签约)</i>
			<div class="xiao_div">
				<ul>
					<%for(var i=0;i<data.length;i++){%>
						<li>
							<div class="div1 L single_txt"><%=list[i][from_id]%></div>
							<div class="div2 L single_txt"><%=list[i][body]%></div>
							<div class="R"><a href="#">前去签约</a></div>
						</li>
					<%}%>
				</ul>
			</div>
		</script>


		<script>
			var cart = new Cart();
			cart.count();
		</script>
	</body>
</html>

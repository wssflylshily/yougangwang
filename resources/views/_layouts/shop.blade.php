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
	<style>
		.hovershow{ position: relative;}
		.hovershow .hoverhide{ display: none; position: absolute; left: 0px; right: 0px; top: 23px;border:1px solid #fafafa;background:white;padding: 10px;z-index: 99}
		.hovershow:hover .hoverhide{ display: block;}
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
					<span class="addr" id="city"><em>天津</em>
						{{--<div class="add_selec">
							<ul>
								--}}{{--<li><a href="#" class="cur">天津</a></li>
								<li><a href="#">北京</a></li>
								<li><a href="#">河北</a></li>
								<li><a href="#">上海</a></li>
								<li><a href="#">北京</a></li>
								<li><a href="#">河北</a></li>
								<li><a href="#">上海</a></li>
								<li><a href="#">北京</a></li>
								<li><a href="#">河北</a></li>
								<li><a href="#">上海</a></li>--}}{{--
							</ul>
						</div>--}}
					</span>
			<span> 欢迎您</span>
			@if (Auth::check())
				<span><i>{{ Auth::check() ? Auth::user()->compony : '' }}/{{ Auth::check() ? Auth::user()->name : '' }}</i></span>
				<span><a href="{{ route('auth.new.login') }}" class="cur">退出</a></span>
				<span><a href="{{ route('auth.logout') }}" class="cur">切换用户</a></span>
			@else
				<a href="{{ route('auth.login') }}">您好，请登录 </a><a href="{{ route('auth.register') }}" class="cur">免费注册</a>
			@endif
		</div>
		<div class="R">
			<div class="hovershow">
				<div style="line-height: 24px; padding: 0px 10px;">我的优钢</div>
				<div class="hoverhide">
					<span><a href="{{ route('seller.home') }}">我的资质</a></span>
					<span><a href="{{ route('shop.affair.index') }}">财务管理</a></span>
				</div>
			</div>
			{{--@if (Auth::check())
            <a href="{{ route('auth.logout') }}" class="cur">退出</a>
            @else
            <a href="{{ route('auth.login') }}">您好，请登录 </a><a href="{{ route('auth.register') }}" class="cur">免费注册</a>
            @endif--}}
			<a href="/user">采购中心</a>
			{{--<a href="/message">消息中心</a>--}}
			{{--<div class="xiaoxi" id="result">消息中心
                <i>(您有<span id="mes_num">0</span>份合同等待签约)</i>
                <div class="xiao_div">
                    <ul>
                    </ul>
                </div>
            </div>--}}
			<a href="/seller/stocks/publish">销售中心</a>
			<a href="{{ route('article.index', ['type' => 6]) }}">售后服务</a>
			<div class="hovershow">
				<div style="line-height: 24px; padding: 0px 10px;">联系客服</div>
				<div class="hoverhide">
					<span><a href="javascript:;" class="qq" data_tel="4567853685">在线客服</a></span>
					<span><a href="javascript:;" class="contact" data_tel="022-12345678">客服电话</a></span>
				</div>
			</div>
			<a href="{{ route('article.index', ['type' => 1]) }}">帮助</a>
		</div>
	</div>
</div>
<!--menu-->
<div class="menu_bg">
	<div class="mid_div clear">
		<div class="L"><a href="/"><img src="/assets/shop/img/index_11.png"></a></div>
		<div class="R">
			{{--@php($active = isset($active) ? $active : ''; $class[$active] = 'class="cur"')--}}
            <?php $active = isset($active) ? $active : ''; $class[$active] = 'class="cur"'?>
			<ul>
				<li><a href="/" {!! $class['home'] or '' !!}>首页</a></li>
				<li><a href="/stocks" {!! $class['stocks'] or '' !!}>现货交易</a></li>
				<li><a href="/futures" {!! $class['futures'] or '' !!}>期货交易</a></li>
				<li><a href="/special" {!! $class['special'] or '' !!}>特卖</a></li>
				<li><a href="#" style="color: #e7e7e7;">行情分析</a></li>
				{{--<li class="future-publish"><a href="/futures/publish">发布期货</a></li>--}}
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
            console.log(data);
            var str = "";
            for(var i=0;i<data.length;i++){
                str += '<li>'+
                    data[i].created_at+'您有来自于'+'<a href="#">'+data[i].name+data[i].message+'</a>'
                '</li>';
            }
            str = '<ul>'+str+'</ul>';
            $('.msg').html("");
            $('.msg').append(str);
        },
        error: function(){
        }
    });
    $.ajax({
        type:"GET",
        url:"{{route('shop.location')}}",
        datatype: "json",
        success:function(json) {
            if (json) {
                $('.addr em').html("");
                $('.addr em').append(json);
            }else{
                $('.addr em').html("");
                $('.addr em').append("未知");
            }

        },
        error: function(){
            $('.addr em').html("");
            $('.addr em').append("未知");
        }
    });
    $.ajax({
        type:"GET",
        url:"{{route('notification.city')}}",
        datatype: "json",

        success:function(json){
            var data = JSON.parse(json);
            console.log(data)
//					$('#city').html(data.length);
            var str = "";
            for(var i=0;i<data.length;i++){
                str += '<li>'+
                    '<a href="#">'+data[i].areaName+'</a>'+
                    '</li>';
            }
            $('.add_selec ul').html("");
            $('.add_selec ul').append(str);
        },
        error: function(){
        }
    });
</script>
<script>
    $(function(){
        $(document).on("click", ".contact", function() {
            var tel=$(this).attr("data_tel");
            $.alert("请拨打电话："+tel, "联系方式");
        });
        $(document).on("click", ".qq", function() {
            var tel=$(this).attr("data_tel");
            $.alert("请联系QQ客服："+tel, "QQ号");
        });
    })
</script>

<script>
    var cart = new Cart();
    cart.count();
</script>
</body>
</html>

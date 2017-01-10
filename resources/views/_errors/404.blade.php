<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>优钢网-首页</title>
		<link rel="stylesheet" href="/assets/shop/css/style.css" />
		<script type="text/javascript" src="/assets/shop/js/jquery-1.8.3.min.js" ></script>
		<script>
			$(function(){
				$(".errordiv").css({"min-height":$(window).height()-396+"px"});
			})
		</script>
	</head>
	<body style="background: #f7f7f7;">
		<!--top-->
		<!--menu-->
		<div class="menu_bg">
			<div class="mid_div clear">
				<div class="L"><a href="/"><img src="/assets/shop/img/index_11.png"></a></div>
			</div>
		</div>
		<div class="mid_div clear errordiv" style="padding: 120px 0px; overflow: hidden;">
			<div class="L" style="width: 500px;">
				<img src="/assets/shop/img/cwicon_03.png">
			</div>
			<div class="R" style="width: 600px; line-height: 30px;">
				<p style="font-size: 24px; color: #e36c08; margin-bottom: 30px;">抱歉，你撞到了404页面...</p>
				<p style="margin-bottom: 30px;">
					最有可能的原因是：<br>
					1）你输入的网址不正确<br>
					2）链接可能已过期
				</p>
				<p>
					别担心，你可以单击链接继续浏览<br>
					<a href="{{ route('shop.home') }}">优钢网首页</a> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<a href="javascript:history.back();">上一页</a>
				</p>
			</div>
		</div>
		<!--footer-->
		<div class="footer_bg min_w">
			<div class="footer_bottom">
				<div>Copyright 2015-2018  ×××科技有限公司.  <a href="#">www.××××××.com</a>  <a href="#">ICP备13029879</a>   ICP认证11568965</div>
			</div>
		</div>
		
	</body>
</html>

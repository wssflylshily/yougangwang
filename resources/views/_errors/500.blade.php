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
				<div class="L"><a href="#"><img src="/assets/shop/img/index_11.png"></a></div>
			</div>
		</div>
		<div class="mid_div clear errordiv" style="padding: 120px 0px; overflow: hidden;">
			<div class="L" style="width: 566px; text-align: right;">
				<img src="/assets/shop/img/dbqicon1.png">
			</div>
			<div class="R" style="width: 600px; line-height: 30px;">
				<p style="font-size: 24px; color: #333333; margin-bottom: 30px;">{!! $exception->getMessage() !!}</p>
				<p>
					您可以：<br>
					1)返回<a href="javascript:history.back();">上一页</a><br>
					2)去<a href="{{ route('shop.home') }}">优钢网首页</a>逛逛
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

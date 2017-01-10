@extends('_layouts.shop')

@section('main-content')
    <div class="mid_div login_div clear">
    	<div class="L">
    		<img src="/assets/shop/img/dt_14.jpg">
    	</div>
    	<form method="POST" class="main-form" accept-charset="UTF-8" autocomplete="off" novalidate="novalidate">
    	<div class="R">
    		<input type="hidden" name="_token" value="{{ csrf_token() }}">
    		<table>
    			<tr>
    				<td class="fontblue">用户登录</td>
    				<td align="right"><a href="{{ route('auth.register') }}">用户注册</a></td>
    			</tr>
    			<tr>
    				<td colspan="2">
    					<div class="div1"><input class="inp1" type="text" name="mobile" placeholder="输入手机号"></div>
    				</td>
    			</tr>
    			<tr>
    				<td colspan="2" style="padding-top: 0px;"><div class="div1"><input class="inp1" type="password" name="password" placeholder="输入密码"></div></td>
    			</tr>
    			<tr>
    				<td><label><input name="remember_me" value="记住密码" type="checkbox" class="check_btn"> 自动登录</label></td>
    				<td align="right"><a href="{{ route('auth.password.find') }}">忘记密码？</a></td>
    			</tr>
    			<tr>
    				<td colspan="2"><button id="login_btn" type="submit" class="ok_btn">登 录</button></td>
    			</tr>
<!--    			<tr>
    				<td colspan="2" align="center">-------使用第三方帐号登录-------</td>
    			</tr>
    			<tr>
    				<td colspan="2">
    					<ul class="login_ul">
	    					<li>
	    						<a href="#">
	    							<div><img src="/assets/shop/img/loginicon_03.png"></div>
	    							<h2>QQ登录</h2>
	    						</a>
	    					</li>
	    					<li>
	    						<a href="#">
	    							<div><img src="/assets/shop/img/loginicon_05.png"></div>
	    							<h2>微信登录</h2>
	    						</a>
	    					</li>
	    					<li>
	    						<a href="#">
	    							<div><img src="/assets/shop/img/loginicon_07.png"></div>
	    							<h2>微博登录</h2>
	    						</a>
	    					</li>
    					</ul>
    				</td>
    			</tr>-->
    		</table>
    	</div>
    	</form>
    </div>

	<!-- Toaster -->
	<script src="/plugins/jquery-toaster/jquery.toaster.js"></script>

	<!-- pages script -->
	<script src="/plugins/jquery-form/jquery.form.min.js"></script>
	<script src="/assets/base.js"></script>

	<script>
		$(function(){
            var base = new Base();
            base.initForm();
		});
	</script>
@endsection

@section('footer')
    @include('_layouts.shop_footer2')
@endsection

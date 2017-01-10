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
    				<td colspan="2" align="center"><img src="/assets/shop/img/yhzc_03.png"></td>
    			</tr>
    			<tr>
    				<td colspan="2"><div class="div1"><input class="inp1" type="text" name="name" placeholder="设置用户名"></div></td>
    			</tr>
    			<tr>
    				<td colspan="2" style="padding-top: 0px;"><div class="div1"><input class="inp1 inp2" type="text" name="mobile" placeholder="输入手机号"><a id="send_captcha" href="javascript:void(0);" class="inp3">获取验证码</a></div></td>
    			</tr>
    			<tr>
    				<td colspan="2" style="padding-top: 0px;"><div class="div1"><input class="inp1" type="text" name="captcha" placeholder="输入验证码"></div></td>
    			</tr>
    			<tr>
    				<td colspan="2" style="padding-top: 0px;"><div class="div1"><input class="inp1" type="password" name="password" placeholder="设置登录密码"></div></td>
    			</tr>
    			<tr>
    				<td colspan="2" style="padding-top: 0px;"><div class="div1"><input class="inp1" type="password" name="password_confirmation" placeholder="确认登录密码"></div></td>
    			</tr>
    			<tr>
    				<td colspan="2">
    				<div style="position: relative;">
    					<button id="sign_btn" type="submit" class="ok_btn">确 认 注 册</button>
    				</div>
    				</td>
    			</tr>
    			<tr>
    				<td colspan="2" align="center">
    					<a href="{{ route('auth.login') }}">返回登录</a><br>
    				</td>
    			</tr>
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

            $(document).on('click', '#send_captcha', function() {
                base.sendCaptcha($(this));
            });

            @if (Session::has('captcha_time') && time() - Session::get('captcha_time') < 60)
            var second = {{ 60 - (time() - Session::get('captcha_time')) }};
            base.disableCaptcha($('#send_captcha'), second);
            @endif
		});
	</script>
@endsection

@section('footer')
    @include('_layouts.shop_footer2')
@endsection

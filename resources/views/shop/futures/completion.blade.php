@extends('_layouts.shop')

@section('main-content')
		<div class="shop_car tent1 order_com mid_div">
			<ul class="step_icon nine_step clear">
				<li class="pass">发布期货</li>
				<li class="pass">商家接单 </li>
				<li class="pass">电子合同 </li>
				<li class="pass">付款</li>
				<li class="pass">生产期货</li>
				<li class="pass">物流查询</li>
				<li class="pass">收货</li>
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
						<span>订单号： GDYGHT120003765 </span> 
						<span>（签约日期：2016年6月14日）</span>  
						<span> 商家名称： 天津华远兴业</span>
					</div>
					<h3 style="font-size: 16px; color: #436bcd; margin-bottom: 15px;">综合评价</h3>
					<div class="com_star">
						<span class="on"></span>
						<span></span>
						<span></span>
						<span></span>
						<span></span>
					</div>
				</div>
				<div style="width: 400px; margin: 15px auto;">
					<ul class="order_evaluate clear">
						<li class="L"><label><input type="checkbox" name="pjxz" class="check_btn"> 是否按时发货</label></li>
						<li class="L"><label><input type="checkbox" name="pjxz" class="check_btn"> 是否满足客户需求</label></li>
						<li class="L"><label><input type="checkbox" name="pjxz" class="check_btn"> 质量是否无损伤</label></li>
						<li class="L"><label><input type="checkbox" name="pjxz" class="check_btn"> 是否服务态度好</label></li>
						<li class="L"><label><input type="checkbox" name="pjxz" class="check_btn"> 物流是否快</label></li>
						<li class="L"><label><input type="checkbox" name="pjxz" class="check_btn"> 是否按时开发票</label></li>
					</ul>
				</div>
				<div style="width: 650px; margin: 15px auto;">
					<textarea style="padding: 20px; width: 100%; height: 120px; background: #FFFFFF; border: 1px solid #ddd;" placeholder="请在此填写更多评价内容，祝您下次购物愉快。"></textarea>
				</div>
				<div class="com_div" style="margin: 20px auto; text-align: center;">
					<a href="#" class="com_btn">确 认 提 交</a>
				</div>
			</div>
		</div>
		<!--footer-->
			    
@endsection

@section('footer')
    @include('_layouts.shop_footer1')
@endsection
@extends('_layouts.shop')

@section('main-content')
		<div class="shop_car order_com mid_div">
			<ul class="step_icon nine_step clear">
				<li class="pass">发布期货</li>
				<li class="pass">商家接单 </li>
				<li class="pass">电子合同 </li>
				<li class="pass">付款</li>
				<li class="cur">生产期货</li>
				<li>物流查询</li>
				<li>收货</li>
				<li>发票处理</li>
				<li>交易完成</li>
			</ul>
			<div class="com_title">
				<img src="/assets/shop/img/scqhtitle_03.png">
			</div>
			<div class="com_content com_div futures_fb clear">
				<div class="com_distance">
					<span>订单号：GDYGHT120003765</span>
					<span>签约日期：2016年6月14日</span>
					<span>剩余天数：15天</span>
					<span>接单商家：<a href="#">山东鲁业钢铁销售有限公司</a></span>
				</div>
				<div class="list_eleven list_eleven2" style="margin-top: 0px;">
					<div class="eleven_t clear">
						<div class="one L">地区</div>
						<div class="two L">品种</div>
						<div class="three L">标准</div>
						<div class="four L">材质</div>
						<div class="five L">钢厂</div>
						<div class="nine L">规格（mm*mm*mm）</div>
						<div class="seven L">允差（±%）</div>
						<div class="eight L">吨数（t）</div>
						<div class="six L">支数（支）</div>
						<div class="ten L">交货日期</div>
						<div class="two L">状态</div>
					</div>
					<div class="list">
						<ul>
							<li class="clear">
								<div class="one single_txt L">天津</div>
								<div class="two single_txt L">热轧酸洗板</div>
								<div class="three single_txt L">API 5L</div>
								<div class="four single_txt L">#20</div>
								<div class="five single_txt L">鞍钢</div>
								<div class="nine single_txt L">219*9.8*12000</div>
								<div class="seven single_txt L">5</div>
								<div class="eight single_txt L">69</div>
								<div class="six single_txt L">125</div>
								<div class="ten single_txt L">2016年9月5日</div>
								<div class="two L"><font class="zt1">计划中</font></div>
							</li>
							<li class="clear">
								<div class="one single_txt L">天津</div>
								<div class="two single_txt L">热轧酸洗板</div>
								<div class="three single_txt L">API 5L</div>
								<div class="four single_txt L">#20</div>
								<div class="five single_txt L">鞍钢</div>
								<div class="nine single_txt L">219*9.8*12000</div>
								<div class="seven single_txt L">5</div>
								<div class="eight single_txt L">69</div>
								<div class="six single_txt L">125</div>
								<div class="ten single_txt L">2016年9月5日</div>
								<div class="two L"><font class="zt2">已完成</font></div>
							</li>
							<li class="clear">
								<div class="one single_txt L">天津</div>
								<div class="two single_txt L">热轧酸洗板</div>
								<div class="three single_txt L">API 5L</div>
								<div class="four single_txt L">#20</div>
								<div class="five single_txt L">鞍钢</div>
								<div class="nine single_txt L">219*9.8*12000</div>
								<div class="seven single_txt L">5</div>
								<div class="eight single_txt L">69</div>
								<div class="six single_txt L">125</div>
								<div class="ten single_txt L">2016年9月5日</div>
								<div class="two L"><font class="zt3">延期</font></div>
							</li>
						</ul>
					</div>
					<div class="mess_div clear">
						<div class="L">
							<div>详细说明：</div>
							<div class="two_div" style="border: none; padding-top: 0px; width: 920px;">
								<p>含税过磅到防腐厂价，每支钢管坡口30°-35 °，管端均带上金属管帽；</p>
								<p>1）外径：按照标准要求；</p>
								<p>2) 壁厚：+0mm/-0.1mm；</p>
								<p>3) 长度：+0/-20mm；</p>
							</div>
						</div>
					</div>
					<div class="mess_div com_distance" style="padding:10px 20px; margin: 0px;">
						<span>联系人：  张先生</span>
						<span>联系方式： 15022651950</span> 
						<span>收货地址： 天津市津南区北闸口镇开发区1181号</span>
						<span>邮编： 300457</span>
					</div>
				</div>	
				<div style="text-align: right; padding: 20px;">
					<a href="#" class="com_btn">去收货</a>
				</div>
			</div>
			
		</div>
		<!--footer-->
			@endsection
	
	@section('footer')		
		<!--footer-->
		@include('_layouts.shop_footer1')
	@endsection
		
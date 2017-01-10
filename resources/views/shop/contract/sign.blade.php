@extends('_layouts.shop')

@section('main-content')
		<div class="shop_car order_confirm order_com mid_div">
			<ul class="step_icon nine_step clear">
				<li class="pass">发布期货</li>
				<li class="pass">商家接单 </li>
				<li class="cur">电子合同 </li>
				<li>付款</li>
				<li>生产期货</li>
				<li>物流查询</li>
				<li>收货</li>
				<li>发票处理</li>
				<li>交易完成</li>
			</ul>
			<div class="com_title">
				<img src="/assets/shop/img/httitle_03.png">
				<a href="#" class="lxsj R">联系商家</a>
			</div>
			<div class="contract">
				<h2>销 售 合 同</h2>
				<div class="ok_txt">
					<h3>合同编号: GT-2015-C203130</h3>
					<p>供方：<span class="fontred">山东鲁业钢铁销售有限公司</span></p>
					<p>需方：<span class="fontred">天津钢商有限公司</span></p>
					<p>签订地点：<span>天津市津南区北闸口镇俊凌路10号</span></p>
					<p>签订日期：<span class="fontred">2016年06月05日</span></p>
					<p style="text-indent: 2em;">双方根据《中华人民共和国合同法》及相关法律法规的规定，为明确双方的权利义务关系，经友好协商，订立本合同，供双方遵守执行。</p>
					<h3>第一条 合同标的情况</h3>
					<p>（一） 供方向需方供应以下货物：</p>
					<table class="table_txt">
						<tr>
							<th width="90">产品名称</th>
							<th width="165">执行标准</th>
							<th width="110">规格型号（mm）</th>
							<th width="120">钢级/材质</th>
							<th width="100">长度（米）</th>
							<th width="100">数量（吨）</th>
							<th width="110">出厂含税单价<br>（元/吨）</th>
							<th width="110">金额（元）</th>
							<th>交货期</th>
						</tr>
						<tr class="fontred alignc">
							<td>管线管</td>
							<td>API-5L（HIC实验合格，具体见技术协议）</td>
							<td>114.3*6.02</td>
							<td>BNS</td>
							<td>12-12.5</td>
							<td>30</td>
							<td>3600</td>
							<td>108000</td>
							<td>2016年5月5日前</td>
						</tr>
						<tr>
							<td colspan="9" class="td01">								
								<p><b>运费价格：</b></p>
								<div class="write_div" style="padding-left: 40px;">
									<span>货物由</span>
									<div class="writ_div" contenteditable="false" style="width: 300px;"></div>
									<span>发出运至</span><span class="fontred">上海东路233号</span>
								</div>
								<div class="write_div" style="padding-left: 40px;">
									<span>商家承诺的价格是：</span>
									<div class="writ_div" contenteditable="false" style="width: 80px;"></div>
									<span>元/吨</span>
									<span style="margin-left: 100px;">运费小计：</span>
									<div class="writ_div" contenteditable="false" style="width: 80px;"></div>
									<span>元</span>
								</div>
								<p><b>工艺费用：</b></p>
								<div class="write_div" style="padding-left: 40px;">
									<span>加工：</span>
									<div class="writ_div" contenteditable="false" style="width: 80px;"></div>
									<span>元/吨</span>
									<span style="margin-left: 100px;">苫盖：</span>
									<div class="writ_div" contenteditable="false" style="width: 80px;"></div>
									<span>元/吨</span>
								</div>
							</td>
						</tr>
						<tr>
							<td colspan="9" class="td01">
								<div class="write_div" style="padding-left: 40px;">
									<span>合计（大写）：</span>
									<div class="writ_div" contenteditable="false" style="width: 260px;"></div>
									<span>（小写：</span><div class="writ_div" contenteditable="false" style="width: 126px;"></div><span>元）</span>
								</div>
							</td>
						</tr>
					</table>
					<p>合计人民币金额（大写）：<span>柒仟贰佰叁拾圆整 </span>（按实际提取的数量结算）</p>
					<p>（二）交货溢短装：交货数量按本合同约定货物数量的±5%的范围控制。</p>
					<p>（三）货物生产商为：黑龙江建龙钢铁销售有限公司。</p>
					<h3>第二条 货物的交付、运输、所有权及风险转移</h3>
					<p>（一）本合同所有货物最晚交货期为<span class="fontred">2016年7月1日</span>，延期交货日违约金为合同总额<span class="fontred">0.1%</span>，<br>
（二）货物交付地点：<span class="fontred">***</span>，收货人：<span class="fontred">***</span>，身份证号码：<span class="fontred">23232500000000</span>，联系方式：<span class="fontred">13812345666</span>，
      收货人要仔细核查货物的数量，并签收确认收货，签收后货物的所有权属需方，供方及运输车辆将对货物数量将不再负责；<br>
（三）货物运输费用由供/需方支付，供方代办运输。</p>
					<h3>第三条 货款结算</h3>
					<p>（一）如供方未在交货期限内供货，结算单价将按第二条约定内容执行；<br>
（二）需方按合同约定向第三方支付预付定金及剩余货款，交货完毕后三工作日内需方将收到此批货款余额，供方将收到全额货款。</p>
					<h3>第四条 违约责任</h3>
					<p>（一）共、需双方在合同生效后如单方取消合同，违约一方需赔偿另一方，赔偿金额为预付定金。</p>
					<h3>第五条 技术协议</h3>
					<div class="enclosure">
						<ul class="clear">
							<li><img src="/assets/shop/img/dt_14.jpg"></li>
							<li><img src="/assets/shop/img/dt_14.jpg"></li>
						</ul>
					</div>
					<p>备注：附件内容与合同其他条款同等法律效力，双方应遵守。</p>
					<h3>第六条 争议解决</h3>
					<p>（一）如共、需双方在产品质量上存在争议，可提交第三方检测机构判定；<br>
（二）如共、需双方在合同执行过程中发生争议，由双方协商解决，协商不成的，提交合同签订地的人民法院诉讼解决。</p>
					<h3>第七条 其他约定</h3>
					<p>（一）本合同双方确认后生成电子版合同文本，此文本具有法律效力；</p>
					<div class="write_div">
						<span>（二）</span>
						<div class="writ_div" contenteditable="true" style="width: 1000px;"></div>
					</div>
					<table class="table_txta">
						<tr>
							<td>供方：天津华远兴业钢铁销售有限公司 </td><td>需方：天津钢商有限公司</td>
						</tr>
						<tr>
							<td><span>代理人：</span><div class="writ_div" contenteditable="false" style="width: 200px;"></div> </td><td><span>代理人：</span><div class="writ_div" contenteditable="false" style="width: 200px;"></div></td>
						</tr>
					</table>
				</div>
				<div class="contract_btn">
					<a href="javascript:history.go(-1);" class="aback">返回</a>
					<a href="/futures/payOrder" class="anext_btn">确定</a>
				</div>
			</div>
		</div>
		<!--box 通知商家提示-->
		<div class="com_div futures_fb">
			<div class="box_shadow"></div>
			<div class="box_content box_content1">
				<div>
					<p><img src="/assets/shop/img/qhtx_03.png"></p>
					<p style="margin: 20px 0px;">已通知商家，请您耐心等待！</p>
					<div class="com_distance">
						<button class="czbtn1">确认</button>
					</div>
				</div>
			</div>
		</div>
		<!--footer-->
			@endsection
	
	@section('footer')		
		<!--footer-->
		@include('_layouts.shop_footer1')
	@endsection
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>AdminLTE 2 | Dashboard</title>
	<!-- Tell the browser to be responsive to screen width -->
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<!-- Bootstrap 3.3.6 -->
	<link rel="stylesheet" href="/plugins/bootstrap/css/bootstrap.min.css">
	<!-- Font Awesome -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
	<!-- Theme style -->
	<link rel="stylesheet" href="/assets/admin/css/AdminLTE.min.css">
	<!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
	<link rel="stylesheet" href="/assets/admin/css/skins/_all-skins.min.css">
	<style>
		.sidebar-menu>li.divider,
		.sidebar-menu .treeview-menu>li.divider {
			height: 1px;
			margin: 1px 0;
			overflow: hidden;
			background-color: #1a2226;
		}

		.sidebar-menu .treeview-menu>li.divider {
			margin: 5px 10px;
			background-color: #35444c;
		}

		.contract{ width: 90%; line-height: 28px; margin: 0px auto; padding: 40px 0px;}
		.contract .text_span{ margin-right: 5px; display: inline-block; background: #ff0000; color: #FFFFFF; border-radius: 4px; padding: 0px 6px;}
		.contract h2{ font-family: '宋体'; font-weight: bold; text-align: center; font-size:30px; color: #333333;}
		.contract h3{ font-family: '宋体'; font-size: 16px; font-weight: bold; padding-top: 15px; padding-bottom: 8px;}
		.contract .ok_txt{ padding-top: 30px;}
		.contract .ok_txt .fontred{ color: #c81825;}
		.contract .table_txt{ width: 100%; margin: 20px 0px; border-collapse: collapse; line-height: 24px;}
		.contract .table_txt tr td,.contract .table_txt tr th{max-width: 0px; word-break:break-all; word-wrap:break-word; padding: 8px 4px; border: 1px solid #ddd;}
		.contract .table_txt tr th{ font-weight: normal; text-align: center;}
		.contract .table_txt tr td.td01{ padding: 15px 20px; line-height: 28px;}
		.contract .table_txt .alignc{ text-align: center;}
		.contract .write_div span{ display: inline-block; vertical-align: middle;}
		.contract .writ_div{ display: inline-block; border-bottom: 1px solid #a1a1a1; min-height: 24px; padding: 3px; margin: 0px 3px; outline: none; font: inherit; color: #c81825; line-height: 24px; font-size: 14px; vertical-align: top;}
		.contract .enclosure{ padding: 10px 0px;}
		.contract .enclosure ul{ padding: 0px; margin: 0px;}
		.contract .enclosure ul.clear:after{ clear: both; content: ""; display: block;}
		.contract .enclosure ul li{ list-style: none; padding: 0px; }
		.contract .enclosure ul li{width: 105px; height: 145px; float: left; margin: 5px 5px;}
		.contract .enclosure ul li .img_div{width: 105px; height: 105px;  border: 1px solid #797979; background: url(/assets/shop/img/pic.png) #f7f7f7 center center no-repeat; position:relative; overflow: hidden;}
		.contract .enclosure ul li .font_size{ font-size: 12px; line-height: 30px; display: none;}
		.contract .enclosure ul li:hover .font_size{ display: block;}
		.contract .enclosure ul li .sc_btn{ position: absolute; opacity: 0; left: 0px; right: 0px; top: 0px; bottom: 0px;}
		.contract .enclosure ul li:hover .img_div{ background-color: #ededed;}
		.contract .enclosure ul li .img_div img{width: 105px; height: 105px; }

		.contract .table_txta{ width: 100%; margin: 20px 0px;}
		.contract .table_txta tr td{ padding: 6px 3px; color: #333;}
		.contract .table_txta .zhang_re{ position: relative; padding: 50px 0px;}
		.contract .table_txta .zhang_re .zhang_img{ opacity: 0.8; position: absolute; left: 0px; top: 0px; bottom: 0px;}
		.contract .table_txta .zhang_re .zhang_img img{ height: 100%;}

		.com_div .box_shadow{ background: rgba(0,0,0,0.5); position: fixed; left: 0px; top: 0px; right: 0px; bottom: 0px; z-index: 16; display: none;}
		.com_div .box_content{overflow-y: auto; padding: 0px; background: none; text-align: center; position: fixed; width: 800px; left: 50%; margin-left: -420px; top: 80px; bottom: 80px; z-index: 17; display: none;}
		/*.com_div .box_content > div{ width: 800px; height: 100%; overflow-y: auto;}*/
		.com_div .box_content img{ max-width: 100%;}
	</style>
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

@include('admin._layouts.header')

	<!-- Content Wrapper. Contains page content -->
	<div class="content-wrapper">
		<!-- Content Header (Page header) -->
		<section class="content-header">
			<h1>
				合同管理
				<small>合同详情</small>
			</h1>
			<ol class="breadcrumb">
				<li><a href="#"><i class="fa fa-dashboard"></i> 首页</a></li>
				<li>合同管理</li>
				<li class="active">合同详情</li>
			</ol>
		</section>

		<!-- Main content -->
		<section class="content">
			<div class="row">
				<div class="col-xs-12">
					<div class="box box-info">
						<!--<div class="box-header">
                        <div class="box-tools">
                            <div class="btn-group" style="margin-bottom: 5px;">
                              <button type="button" class="btn btn-sm text-warning start-selected"><i class="fa fa-archive"></i> 启用</button>
                              <button type="button" class="btn btn-sm text-warning end-selected"><i class="fa fa-archive"></i> 禁用</button>
                              <button type="button" class="btn btn-sm text-danger hot-selected">特卖</button>
                              <button type="button" class="btn btn-sm text-success tuijian-selected">推荐</button>
                              <button type="button" class="btn btn-sm text-danger delete-selected">删除</button>

                            </div>
                        </div>
                      </div>-->
						<!-- /.box-header -->
						<div class="box-body table-responsive">
							<div class="contract">
								{{--<div><span class="text_span">买家有疑义</span></div>--}}
								<h2>销 售 合 同</h2>
								<div class="ok_txt">
									<h3>合同编号: {{ $order->contract->contract_sn }}</h3>
									<p>供方：<span class="fontred">{{ $order->seller->name or '未知' }}</span></p>
									<p>需方：<span class="fontred">{{ $order->user->seller->name or '未知' }}</span></p>
									<p>签订地点：<span></span></p>
									<p>签订日期：<span class="fontred"></span></p>
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
											{{--<th>交货期</th>--}}
										</tr>
										@foreach ($order->goods as $order_goods)
											<tr class="fontred alignc">
												<td>{{ $order_goods->bak_variety or '未知' }}</td>
												<td>{{ $order_goods->bak_standard or '未知' }}</td>
												<td>{{ $order_goods->bak_attribute or '未知' }}</td>
												<td>{{ $order_goods->bak_material or '未知' }}</td>
												<td>dummy</td>
												<td>{{ $order_goods->buy_count or '未知' }}</td>
												<td>{{ $order_goods->buy_price or '未知' }}</td>
												<td>{{ $order_goods->buy_price * $order_goods->buy_count }}</td>
												{{--<td>dummy</td>--}}
											</tr>
										@endforeach
										<tr>
											<td colspan="9" class="td01">
												<p><b>运费价格：</b></p>
												<div class="write_div" style="padding-left: 40px;">
													<span>货物由</span>
													<div class="writ_div" contenteditable="false" style="width: 300px;">{{ $order->contract->sign_address or '' }}</div>
													<span>发出运至</span><span class="fontred">{{ $order->address }}</span>
												</div>
												<div class="write_div" style="padding-left: 40px;">
													<span>商家承诺的价格是：</span>
													<div class="writ_div" contenteditable="false" style="width: 80px;">{{ $order->contract->promise_price or '' }}</div>
													<span>元/吨</span>
													<span style="margin-left: 100px;">运费小计：</span>
													<div class="writ_div" contenteditable="false" style="width: 80px;">{{ $order->contract->freight_price or '' }}</div>
													<span>元</span>
												</div>
												<p><b>工艺费用：</b></p>
												<div class="write_div" style="padding-left: 40px;">
													<span>加工：</span>
													<div class="writ_div" contenteditable="false" style="width: 80px;">{{ $order->contract->processing_price or '' }}</div>
													<span>元/吨</span>
													<span style="margin-left: 100px;">防腐：</span>
													<div class="writ_div" contenteditable="false" style="width: 80px;">{{ $order->contract->fangfu_price or '' }}</div>
													<span>元/吨</span>
													<span style="margin-left: 100px;">苫盖：</span>
													<div class="writ_div" contenteditable="false" style="width: 80px;">{{ $order->contract->shangai_price or '' }}</div>
													<span>元/吨</span>
												</div>
											</td>
										</tr>
										<tr>
											<td colspan="9" class="td01">
												<div class="write_div" style="padding-left: 40px;">
													<span>合计（大写）：</span>
													<div class="writ_div" contenteditable="false" style="width: 260px;">{{ $order->contract->price_amount_fanti or '' }}</div>
													<span>（小写：</span><div class="writ_div" contenteditable="false" style="width: 126px;">{{ $order->contract->price_amount or '' }}</div><span>元）</span>
												</div>
											</td>
										</tr>
									</table>
									<p>合计人民币金额（大写）：<span>柒仟贰佰叁拾圆整 </span>（按实际提取的数量结算）</p>
									<p>（二）交货溢短装：交货数量按本合同约定货物数量的±5%的范围控制。</p>
									<p>（三）货物生产商为：黑龙江建龙钢铁销售有限公司。</p>
									<h3>第二条 货物的交付、运输、所有权及风险转移</h3>
									<p>（一）本合同所有货物最晚交货期为<span class="fontred">{{ $order->contract->deadline or '未定' }}</span>，延期交货日违约金为合同总额<span class="fontred">0.1%</span>，<br>
										（二）货物交付地点：<span class="fontred">{{ $order->address }}</span>，收货人：<span class="fontred">{{ $order->linkman }}</span>{{--，身份证号码：<span class="fontred">23232500000000</span>--}}，联系方式：<span class="fontred">{{ $order->mobile }}</span>，
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
											<!--<li>
                                                <div class="img_div"><input type="file" name="sc_img" class="sc_btn" /></div>
                                            </li>-->
											<li>
												<div class="img_div"><img src="/assets/shop/img/dt_14.jpg"></div>
												<div class="font_size clear">
													<a href="javascript:;" class="L check_fj">查看</a>
													<!--<a href="javascript:;" class="R delete_fj">删除</a>-->
												</div>
											</li>
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
										<div class="writ_div" contenteditable="false" style="width: 100%;">{{ $order->contract->other_assumpsit or '' }}</div>
									</div>
									<table class="table_txta">
										<tr>
											<td>
												<div class="zhang_re">
													<div>供方：{{ $order->seller->name or '未知' }} </div>
													<div><span>代理人：</span><div class="writ_div" contenteditable="false" style="width: 200px;">{{ $order->contract->supplier_agent or '' }}</div></div>
													{{--<div class="zhang_img">
														<img src="/assets/admin/img/zhang.png" height="100%">
													</div>--}}
												</div>
											</td>
											<td>
												<div class="zhang_re">
													<div>需方：{{ $order->user->seller->name or '未知' }} </div>
													<div><span>代理人：</span><div class="writ_div" contenteditable="false" style="width: 200px;">{{ $order->contract->demander_agent or '' }}</div></div>
													{{--<div class="zhang_img">
														<img src="/assets/admin/img/zhang.png" height="100%">
													</div>--}}
												</div>
											</td>
										</tr>
									</table>
								</div>
							</div>
						</div>
						<!-- /.box-body -->
						<div class="box-footer clearfix" style="border: none;">
						</div>
						<!-- /.box-body -->
					</div>
					<!-- /.box -->
				</div>
			</div>
			<!-- /.row -->
			<!--box_shadow-->
			<!--查看附件-->
			<div class="com_div">
				<div class="box_shadow"></div>
				<div class="box_content">
					<img src="">
				</div>
			</div>
		</section>
		<!-- /.content -->
	</div>
	<!-- /.content-wrapper -->
	<footer class="main-footer">
		<strong>Copyright &copy; 2016 <a href="#">YouGang</a>.</strong> All rights
		reserved.
	</footer>
</div>
<!-- ./wrapper -->

<!-- jQuery 2.2.3 -->
<script src="/plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
    $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.6 资料查看/退出-->
<script src="/plugins/bootstrap/js/bootstrap.min.js"></script>
<!-- AdminLTE App 适应-->
<script src="/assets/admin/js/app.min.js"></script>
<!-- page script 全选-->
<!--<script src="/assets/base.js"></script>-->
<!--<script src="/assets/admin/js/product.js"></script>-->
<!-- Page script -->
<script>
    $(function () {
        //查看附件
        $(document).on("click",".check_fj",function(){
            var img_attr=$(this).parents("li").find(".img_div img").attr("src");
            $(".box_shadow,.box_content").show();
            $(".box_content img").attr("src",img_attr);
        });

        $(".box_shadow,.box_content").click(function(){
            $(".box_shadow,.box_content").hide();
            $(".box_content img").attr("src","");
        })
    });
</script>
</body>
</html>

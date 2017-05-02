@extends('_layouts.shop')

@section('main-content')
    <link rel="stylesheet" href="/assets/shop/css/person.css"/>

    <!-- content-->
    <div class="meCenIndex_con mid_div min_w marok spmehetong">
        <div class="tit">
            <img src="/assets/shop/img/shangpu/sptit.jpg"/>
            <p class="line"></p>
        </div>
        <div class="content clear">
            @include('_layouts.seller_left')
            <div class="R">
                <!-- 我的合同-->
                <div class="mehetong">
                    <ul class="tab clear">
                        <li class="on"><a href="#">签约</a></li>
                        <li class="line"></li>
                        <li><a href="#">签约中</a></li>
                        <li class="right"><p class="tip"><b></b>优钢网提示您：如果您的订单合同自发起之日起买卖双方没有签约成功，系统将自动终止双方的签约。</p></li>
                    </ul>
                    <!-- table-->
                    <div class="table">
                        <ul class="thead clear">
                            <li class="td1">订单号</li>
                            <li class="td2">签订日期</li>
                            <li class="td3">合同编号</li>
                            <li class="td4">下单买家</li>
                            <li class="td5">状态</li>
                            <li class="td6">操作</li>
                        </ul>
                        <div class="tbody">
                            <ul class="tr clear">
                                <li class="td1">2602065004365800</li>
                                <li class="td2">2016-06-17</li>
                                <li class="td3">GDB2345346</li>
                                <li class="td4">方先生</li>
                                <li class="td5">未处理</li>
                                <li class="td6">
                                    <a href="#" class="btnRed4 go">去签约</a>
                                </li>
                            </ul>
                            <ul class="tr clear">
                                <li class="td1">2602065004365800</li>
                                <li class="td2">2016-06-17</li>
                                <li class="td3">GDB2345346</li>
                                <li class="td4">刘女士</li>
                                <li class="td5">买家有疑义</li>
                                <li class="td6">
                                    <a href="#" class="btnGrayBd4 cancel">取消签约</a>
                                </li>
                            </ul>
                            <ul class="tr clear">
                                <li class="td1">2602065004365800</li>
                                <li class="td2">2016-06-17</li>
                                <li class="td3">GDB2345346</li>
                                <li class="td4">苗先生</li>
                                <li class="td5">商家已回复</li>
                                <li class="td6">
                                    <a href="#" class="btnGrayBd4 cancel">取消签约</a>
                                </li>
                            </ul>
                            <ul class="tr clear">
                                <li class="td1">2602065004365800</li>
                                <li class="td2">2016-06-17</li>
                                <li class="td3">GDB2345346</li>
                                <li class="td4">王先生</li>
                                <li class="td5">未处理</li>
                                <li class="td6">
                                    <a href="#" class="btnBlue4 download">下载合同</a>
                                </li>
                            </ul>
                            <ul class="tr clear">
                                <li class="td1">2602065004365800</li>
                                <li class="td2">2016-06-17</li>
                                <li class="td3">GDB2345346</li>
                                <li class="td4">王先生</li>
                                <li class="td5">买家有疑义</li>
                                <li class="td6">
                                    <a href="#" class="btnRed4 modify">修改疑义</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- ad-->
                @include('_layouts.ads')
            </div>
        </div>
    </div>
    <!-- footer-->

    <!-- 签约的成功提示信息-->
    <div class="SPhetongSignTip marok" style="display: none">
        <h3><span class="ok"></span>您已签约，请查看！</h3>
        <p>（已以网站提示与短信的形式通知买家已签约）</p>
        <a href="javascript:;" class="see">查看合同</a>
        <a href="javascript:;" class="back">返回</a>
    </div>
    <!-- 异议信息框-->
    <div class="SPhetongYiyi" style="display: none">
        <span class="ok"></span>您的异议已通知买家，请耐心等待回复。
    </div>
    <!-- 去签约框-->
    <!-- 遮罩-->
    <div id="zhezhao" style="display: none"></div>
    <!-- 合同框 红字部分是从后台读取的-->
    <div style="display: none" class="hetongKuang">
       	<div>
       		<div class="contract" style="margin: 0px auto; width: 1100px; border: none;">
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
			</div>
			<div class="com_div operate_btn bot" style="text-align: center;">
				<a href="#" class="com_btn gray aback">返回</a>
				<a href="#" class="com_btn download">下载合同</a>
			</div>
        </div>
    </div>
    <script>
        //禁止窗口滚动
        function forbiddenScroll(){
            return false;
        }

        //合同框 的自定义滚动条
//      $('.hetongKuang .top').perfectScrollbar();

        //点击下载合同
        $('.meCenIndex_con > .content > .R .mehetong .table').on('click','.btnBlue4',function(){
            $('#zhezhao').show();
            $('.hetongKuang').show();
            $("body,html").css({"overflow":"hidden"});
            //$('body').on('mousewheel',forbiddenScroll);//不允许页面滚动
            //$('.hetongKuang .top').scrollTop(0);//滚回顶部
        });

        //合同框 点击返回
        $('.hetongKuang').on('click','a.aback',function(){
            $('#zhezhao').hide();
            $('.hetongKuang').hide();
            $("body,html").css({"overflow-y":"auto"});
            //$('body').off('mousewheel',forbiddenScroll);//允许页面滚动
        });
    </script>
    <!-- 遮罩层-->
    <div id="zhezhao" style="display: none"></div>

    <script type="text/javascript">
        //点击 取消签约
        $('.meCenIndex_con > .content > .R .mehetong .table .tbody').on('click','.tr li.td6 .cancel',function(){
            console.log('取消签约');
        });

        //点击 去签约
        $('.meCenIndex_con > .content > .R .mehetong .table .tbody').on('click','.tr li.td6 .go',function(){
            $('#zhezhao').show();
            $('.SPhetongGo').show();
            $('html,body').css('overflow','hidden');
        });
        //点击 去签约框 返回
        $('.SPhetongGo .bot a.back').on('click',function(){
            $('#zhezhao').hide();
            $('.SPhetongGo').hide();
            $('html,body').css('overflow','auto');
        });
        //点击 去签约框 同意签约
        $('.SPhetongGo .bot a.tongyi').on('click',function(){
            $('.SPhetongGo').hide();
            $('.SPhetongSignTip').show();
        });
        //点击 去签约框 对条款有疑议
        var zhezhaocanClick=false;
        $('.SPhetongGo .bot a.yiyi').on('click',function(){
            $('.SPhetongGo').hide();
            $('.SPhetongYiyi').show();
            zhezhaocanClick=true;
        });

        //点击 去签约框 对条款有疑议 之后 点击遮罩让 提示框消失
        $('#zhezhao').on('click',function(){
            if(zhezhaocanClick){
                zhezhaocanClick=false;
                $('.SPhetongYiyi').hide();
                $('#zhezhao').hide();
                $('html,body').css('overflow','auto');
            }
        });
        // 签约的成功提示信息  点击 查看合同
        $('.SPhetongSignTip .see').on('click',function(){
            $('.SPhetongSignTip').hide();
            $('.SPhetongSee').show();
        });
        //点击查看合同的返回
        $('.SPhetongSee .bot a.back').on('click',function(){
            $('.SPhetongSee').hide();
            $('#zhezhao').hide();
            $('html,body').css('overflow','auto');
        });
        //点击 签约的成功提示信息 返回
        $('.SPhetongSignTip .back').on('click',function(){
            $('.SPhetongSignTip').hide();
            $('#zhezhao').hide();
            $('html,body').css('overflow','auto');
        });

        //点击修改疑义
        $('.meCenIndex_con > .content > .R .mehetong .table .tbody').on('click','.tr li.td6 .modify',function(){
            $('.SPhetongModify').show();
            $('#zhezhao').show();
            $('html,body').css('overflow','hidden');
        });
        //点击修改疑义框 的返回
        $('.SPhetongModify .bot a.back').on('click',function(){
            $('.SPhetongModify').hide();
            $('#zhezhao').hide();
            $('html,body').css('overflow','auto');
        });
        //点击修改疑义框 的确认修改
        $('.SPhetongModify .bot a.modify').on('click',function(){
            $('.SPhetongModify').hide();
            $('#zhezhao').hide();
            $('html,body').css('overflow','auto');
        });

        //点击 下载合同
        $('.meCenIndex_con > .content > .R .mehetong .table .tbody').on('click','.tr li.td6 .download',function(){
            $('.SPhetongDownload').show();
            $('#zhezhao').show();
            $('html,body').css('overflow','hidden');
        });
        //点击下载合同的返回
        $('.SPhetongDownload .bot a.back').on('click',function(){
            $('.SPhetongDownload').hide();
            $('#zhezhao').hide();
            $('html,body').css('overflow','auto');
        });
    </script>
     @endsection
@section('footer')
    @include('_layouts.shop_footer2')
@endsection
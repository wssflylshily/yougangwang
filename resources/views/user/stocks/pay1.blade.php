﻿<script type="text/javascript">
    function CheckValue() {
        var paymenttype = document.getElementById("PaymentType").value;
        var paymentlinktype = document.getElementById("PaymentLinkType").value;
        if (paymenttype == "6" && paymentlinktype == "2") {
            trUnionPayLinkType.style.display = "inline";
        } else {
            trUnionPayLinkType.style.display = "none";
        }
    }
    function SelectedIndexChanged() {
        var paytypeid = document.getElementById("PayTypeID").value;
        if (paytypeid == "ImmediatePay") {
            installmentCode.style.display = "none";
            installmentNum.style.display = "none";
        }
        else if (paytypeid == "PreAuthPay") {
            installmentCode.style.display = "none";
            installmentNum.style.display = "none";
        }
        else if (paytypeid == "DividedPay") {
            installmentCode.style.display = "inline";
            installmentNum.style.display = "inline";

        }
    }

</script>
<html>
<head>

<title>农行网上支付平台-商户接口范例-支付请求</title>
</head>
<body bgcolor='#FFFFFF' value='#000000' link='#0000FF' vlink='#0000FF'
	alink='#FF0000'>
	<form name="form1" action='{{ route('user.order.paytest') }}' method="post">
		<input type="hidden" value="{{ csrf_token() }}" name="_token">
		<table>
			<tr>
				<td>交易类型</td>
				<td><select name="PayTypeID" onclick="SelectedIndexChanged()">
						<option value="ImmediatePay">直接支付</option>
						<option value="PreAuthPay">预授权支付</option>
						<option value="DividedPay">分期支付</option>
				</select>*必输
				<td>
			</tr>
			<tr>
				<td>订单日期</td>
				<td><input type="text" name="OrderDate" value="2014/09/23">（YYYY/MM/DD）</td>
			</tr>
			<tr>
				<td>订单时间</td>
				<td><input type="text" name="OrderTime" value="11:55:30">（HH:MM:SS）</td>
			</tr>
			<tr>
				<td>订单支付有效期</td>
				<td><input type="text" name="orderTimeoutDate"
					value="20241019104901" />精确到秒，选输</td>
			</tr>
			<tr>
				<td>交易编号</td>
				<td><input type="text" name="OrderNo" value="ON20140924003" />必输</td>
			</tr>
			<tr>
				<td>交易币种</td>
				<td><input type="text" name="CurrencyCode" value="156" />156:人民币,*必输</td>
			</tr>
			<tr>
				<td>交易金额</td>
				<td><input type="text" name="PaymentRequestAmount" value="2.00" />保留小数点后两位数字,*必输</td>
			</tr>
			<tr>
				<td>手续费金额</td>
				<td><input type="text" name="Fee" value="" />保留小数点后两位数字,选输</td>
			</tr>
			<tr>
				<td>订单说明</td>
				<td><input type="text" name="OrderDesc" value="Game Card Order" />选输</td>
			</tr>
			<tr>
				<td>订单地址</td>
				<td><input type="text" name="OrderURL"
					value="http://127.0.0.1/Merchant/MerchantQueryOrder.php?ON=ON200412230001&DetailQuery=1" />选输</td>
			</tr>
			<tr>
				<td>收货地址</td>
				<td><input type="text" name="ReceiverAddress" value="北京" />选输</td>
			</tr>
			<tr>
				<td>分期标识</td>
				<td><input type="text" name="InstallmentMark" value="0" />1：分期；0：否。*必输</td>
			</tr>
			<tr id="installmentCode" style="display: none;">
				<td>分期代码</td>
				<td><input type="text" name="InstallmentCode" value="" />选输</td>
			</tr>
			<tr id="installmentNum" style="display: none;">
				<td>分期期数</td>
				<td><input type="text" name="InstallmentNum" value="" />2-99,选输</td>
			</tr>
			<tr>
				<td>商品种类</td>
				<td><select name="CommodityType" id="CommodityType" >
						<option value="0101">充值类-支付账户充值(0101)</option>
						<option value="0201">消费类-虚拟类(0201),如：游戏点卡、游戏装备、手机充值卡、礼品卡</option>
						<option value="0202">消费类-传统类(0202),如：百货商城、数码家电、服饰、食品等</option>
						<option value="0203">消费类-实名类(0203),如：航空售票、酒店预订、旅游产品等</option>
						<option value="0301">转账类-本行转账(0301)</option>
						<option value="0302">转账类-他行转账(0302)</option>
						<option value="0401">缴费类-水费(0401)</option>
						<option value="0402">缴费类-电费(0402)</option>
						<option value="0403">缴费类-煤气费(0403)</option>
						<option value="0404">缴费类-有线电视费(0404)</option>
						<option value="0405">缴费类-通讯费(0405)</option>
						<option value="0406">缴费类-物业费(0406)</option>
						<option value="0407">缴费类-保险费(0407)</option>
						<option value="0408">缴费类-行政费用(0408)</option>
						<option value="0409">缴费类-税费(0409)</option>
						<option value="0410">缴费类-学费(0410)</option>
						<option value="0499">缴费类-其他(0499)</option>
						<option value="0501">理财类-基金(0501)</option>
						<option value="0502">理财类-理财产品(0502)</option>
						<option value="0503">理财类-其他(0599)</option>
				</select>*必输</td>
			</tr>
			<tr>
				<td>客户交易IP</td>
				<td><input type="text" name="BuyIP" value="" />选输</td>
			</tr>
			<tr>
				<td>订单保存时间</td>
				<td><input type="text" name="ExpiredDate" value="30" />单位:天，选输</td>
			</tr>
			<tr>
				<td>支付账户类型</td>
				<td><input type="text" name="PaymentType" value="A"
					onkeyup="CheckValue()" />1：农行卡支付 2：国际卡支付 3：农行贷记卡支付 5:基于第三方的跨行支付
					A:支付方式合并 6：银联跨行支付，*必输</td>
			</tr>
			<tr>
				<td>交易渠道</td>
				<td><input type="text" name="PaymentLinkType" value="1"
					onkeyup="CheckValue()" />1：internet网络接入 2：手机网络接入 3:数字电视网络接入
					4:智能客户端，*必输</td>
			</tr>
			<tr id="trUnionPayLinkType" style="display: none;">
				<td>银联跨行移动支付接入方式</td>
				<td><input type="text" name="UnionPayLinkType" value="0" />0：页面接入
					1：客户端接入，如果选择的支付帐户类型为6(银联跨行支付)交易渠道为2(手机网络接入)，需要必输</td>
			</tr>
			<tr>
				<td>收款方账号</td>
				<td><input type="text" name="ReceiveAccount" value="" />选输</td>
			</tr>
			<tr>
				<td>收款方户名</td>
				<td><input type="text" name="ReceiveAccName" value="" />选输</td>
			</tr>
			<tr>
				<td>通知方式</td>
				<td><input type="text" name="NotifyType" value="0" />0：URL页面通知
					1：服务器通知，*必输</td>
			</tr>
			<tr>
				<td>通知URL地址</td>
				<td><input type="text" name="ResultNotifyURL"
					value="http://10.233.4.10:99/demo/MerchantResult.php" />*必输</td>
			</tr>
			<tr>
				<td>附言</td>
				<td><input type="text" name="MerchantRemarks" value="Hi" />不超过100个字符，选输</td>
			</tr>
			<tr>
				<td>交易是否分账</td>
				<td><input type="text" name="IsBreakAccount" value="0" />0:否；1:是，*必输</td>
			</tr>
			<tr>
				<td>分账模版编号</td>
				<td><input type="text" name="SplitAccTemplate" value="" />选输</td>
			</tr>
			<tr>
				<td colspan="2"><input type='BUTTON' value='提交订单'
					onclick="form1.submit()"></td>
			</tr>
		</table>
	</form>
	<center>
		<a href='Merchant.html'>回商户首页</a>
	</center>
</body>
</html>

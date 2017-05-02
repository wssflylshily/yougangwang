﻿<?php
class_exists('TrxRequest') or require (dirname(__FILE__) . '/core/TrxRequest.php');
class_exists('Json') or require (dirname(__FILE__) . '/core/Json.php');
class_exists('IChannelType') or require (dirname(__FILE__) . '/core/IChannelType.php');
class_exists('IPaymentType') or require (dirname(__FILE__) . '/core/IPaymentType.php');
class_exists('INotifyType') or require (dirname(__FILE__) . '/core/INotifyType.php');
class_exists('DataVerifier') or require (dirname(__FILE__) . '/core/DataVerifier.php');
class_exists('ILength') or require (dirname(__FILE__) . '/core/ILength.php');
class_exists('IPayTypeID') or require (dirname(__FILE__) . '/core/IPayTypeID.php');
class_exists('IInstallmentmark') or require (dirname(__FILE__) . '/core/IInstallmentmark.php');
class_exists('ICommodityType') or require (dirname(__FILE__) . '/core/ICommodityType.php');
class_exists('IQueryType') or require (dirname(__FILE__) . '/core/IQueryType.php');
class QueryOrderRequest extends TrxRequest {
	public $request = array (
		"TrxType" => IFunctionID :: TRX_TYPE_QUERY,
		"PayTypeID" => "",
		"OrderNo" => "",
		"QueryDetail" => ""
	);
	function __construct() {
	}

	protected function getRequestMessage() {
		Json :: arrayRecursive($this->request, "urlencode", false);
		$tMessage = json_encode($this->request);
		$tMessage = urldecode($tMessage);
		return $tMessage;
	}

	/// 支付请求信息是否合法
	protected function checkRequest() {
		if (!DataVerifier :: isValidString($this->request["OrderNo"], ILength :: ORDERID_LEN))
			throw new TrxException(TrxException :: TRX_EXC_CODE_1100, TrxException :: TRX_EXC_MSG_1100, "未设定交易编号！");
		if (!($this->request["QueryDetail"] === IQueryType :: QUERY_TYPE_STATUS) && !($this->request["QueryDetail"] === IQueryType :: QUERY_TYPE_DETAIL))
			throw new TrxException(TrxException :: TRX_EXC_CODE_1100, TrxException :: TRX_EXC_MSG_1100, "QueryType设定非法！");
	}
}
?>
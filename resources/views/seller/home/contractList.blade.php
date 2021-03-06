@extends('_layouts.shop')

@section('main-content')
    <!--<link rel="stylesheet" href="/assets/shop/css/person.css"/>-->

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
                        <li class="on"><a href="{{ route('seller.contract.home') }}">未签约</a></li>
                        <li class="line"></li>
                        <li><a href="{{ route('seller.contract.already') }}">已签约</a></li>
                        <li><a href="{{ route('seller.contract.cancel') }}">已作废</a></li>
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
                            @if($orders)
                                @foreach($orders as $order)
                                    <ul class="tr clear">
                                        <li class="td1">{{ $order->order_sn }}</li>
                                        <li class="td2">{{ $order->create_time }}</li>
                                        <li class="td3">{{ $order->contract_sn }}</li>
                                        <li class="td4">{{ $order->seller->name }}</li>
                                        <li class="td5">待签约</li>
                                        <li class="td6">
                                        	@if($order->type==2)
                                        	<a href="{{ route('shop.futures.signContract', ['order_id' => $order->id]) }}" data-htid="1" class="btnRed4 go">签约</a>
                                        	@else
                                            <a href="{{ route('user.stocks.contract', ['order_sn' => $order->order_sn]) }}" data-htid="1" class="btnRed4 go">签约</a>
                                            @endif
                                            {{--<a href="javascript:;" data-htid="1" class="btnGrayBd4 qxqy_toast">取消签约</a>--}}
                                        </li>
                                    </ul>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
                <!-- ad-->
                @include('_layouts.ads')
            </div>
        </div>
    </div>
    <!-- footer-->
    <script>
        $("#contract").addClass("on");
       $(function(){
       	//取消签约
    	$('body').on('click','.qxqy_toast',function(){
    		var contract_id=$(this).data("htid");
    		console.log(contract_id);
    		$.confirm("", "取消签约？", function() {
	          $.toast("已取消");
	        }, function() {
	          //取消操作
	        });
    	});
    	//去签约约跳到合同页
    	//下载合同
    	$('body').on('click','.htxz_toast',function(){
    		var contract_id=$(this).data("htid");
    		$.confirm("", "确认下载？", function() {
	          $.toast("下载成功");
	        }, function() {
	          //取消操作
	        });
    	});
    	//修改疑义
    	$('body').on('click','.modify_toast',function(){
    		var contract_id=$(this).data("htid");
	        $.modal({
	          title: "疑义内容",
	          text: "疑义内容：我不同意签约",
	          buttons: [
	            { text: "去修改", onClick: function(){ 
	            	window.location.href="#";
	            } },
	            { text: "取消", className: "default"},
	          ]
	        });
	        
    	});
       })
    </script>
     @endsection
@section('footer')
    @include('_layouts.shop_footer2')
@endsection
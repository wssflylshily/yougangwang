@extends('_layouts.shop')
@section('main-content')
    <!-- content-->
    <div class="meCenIndex_con mid_div min_w marok">
        <div class="tit">
            <img src="/assets/shop/img/shangpu/sptit.jpg"/>
            <p class="line"></p>
        </div>
        <div class="content clear">
        	@include('_layouts.seller_left')
           
            <div class="R">
                <!-- 我的现货 我的期货 我的合同-->
                <div class="orderQihuo">
                    <ul class="tab clear">
                        <li  class="on"><a href="{{ route('seller.stocks.orders') }}">现货订单</a></li>
                        <li><a href="/seller/futuresOrders">期货订单</a></li>
                    </ul>
                    <!-- 我的现货-->
                    <div class="orderCon">
                        <div class="tit">
                            <ul class="L clear">
                                <li @if(Request::input('type') == 0) class="on" @endif><a href="{{route('seller.stocks.orders')}}">全部</a></li>
                                <li @if(Request::input('type') == -1) class="on" @endif><a href="{{route('seller.stocks.orders', ['type' => -1])}}">待签约</a></li>
                                <li @if(Request::input('type') == 1) class="on" @endif><a href="{{route('seller.stocks.orders', ['type' => 1])}}">待付款</a></li>
                                <li @if(Request::input('type') == 4) class="on" @endif><a href="{{route('seller.stocks.orders', ['type' => 4])}}">待发货</a></li>
                                <li @if(Request::input('type') == 5) class="on" @endif><a href="{{route('seller.stocks.orders', ['type' => 5])}}">待收货</a></li>
                                <li @if(Request::input('type') == 6) class="on" @endif><a href="{{route('seller.stocks.orders', ['type' => 6])}}">待结算</a></li>
                                <li @if(Request::input('type') == 7) class="on" @endif><a href="{{route('seller.stocks.orders', ['type' => 7])}}">待开票</a></li>
                                <li @if(Request::input('type') == 99) class="on" @endif><a href="{{route('seller.stocks.orders', ['type' => 9])}}">交易完成</a></li>
                                <li @if(Request::input('type') == 9) class="on" @endif><a href="{{route('seller.stocks.orders', ['type' => 8])}}">待评价</a></li>
                            </ul>
                        </div>
                        <ul class="tableTit clear">
                            <li class="td1">地区</li>
                            <li class="td2">品种</li>
                            <li class="td3">标准</li>
                            <li class="td4">材质</li>
                            <li class="td5">钢厂</li>
                            <li class="td6">规格</li>
                            <li class="td7">吨数</li>
                            <li class="td8">实付款</li>
                            <li class="td9">交易状态</li>
                            <li class="td10">交易操作</li>
                        </ul>
                        <!-- 现货列表 normal是非评价的现货列表 蓝色  评价的现货列表是 灰色-->
                        <ul class="orderList">
                            @foreach ($order_goods as $order)
                                <li class="order">
                                    <ul class="thead clear">
                                        <li class="one">
                                            <input class="check_btn" type="checkbox" name="neirong" value="">
                                            {{ $order->created_at->format('Y-m-d') }}
                                            订单号：{{ $order->order_sn  or '' }}
                                        </li>
                                        <li class="two">{{ $order->user->name  or '' }}</li>
                                        <li class="three">
                                            <a href="javascript:;" data_tel="{{ $order->mobile }}" class="contact" style="background-image: url(/assets/shop/img/contact_p.png);"></a>
                                        </li>
                                    </ul>
                                    <ul class="tbody">
                                        <li>
                                            <ul class="tr clear">
                                                <li class="col7">
                                                    @if($order->goods != null)
                                                        @foreach ($order->goods as $goods)
                                                            <ul class="last">
                                                                <li class="td1">{{ $goods->bak_area  or '' }}</li>
                                                                <li class="td2">{{ $goods->bak_variety or ''  }}</li>
                                                                <li class="td3">{{ $goods->bak_standard or ''  }}</li>
                                                                <li class="td4">{{ $goods->bak_material or ''  }}</li>
                                                                <li class="td5">{{ $goods->bak_steelmill or ''  }}</li>
                                                                <li class="td6">{{ $goods->bak_attribute or ''  }}</li>
                                                                <li class="td7">{{ $goods->buy_count or ''  }}</li>
                                                            </ul>
                                                        @endforeach
                                                    @endif
                                                </li>

                                                <li class="td8">
                                                    <p class="black">￥{{ $order->paid_amount or ''  }}</p>
                                                    <p class="f12">(含运费：￥{{ $order->postsge or ''  }})</p>
                                                </li>
                                                <li class="td9">
                                                    @if($order->status === -1)
                                                        <a href="#" class="f12 textRed">待签约</a>
                                                    @elseif($order->status == 1)
                                                        <a href="#" class="f12 textRed">待付款</a>
                                                    @elseif($order->status == 4)
                                                        <a href="#" class="f12 textRed">待发货</a>
                                                    @elseif($order->status == 5)
                                                        {{--<a href="#" class="f12 textRed">待收货</a>--}}
                                                        <a href="{{ route('seller.stocks.logistics', ['order_sn' => $order->order_sn]) }}" class="f12 textRed">添加物流</a>
                                                    @elseif($order->status == 6)
                                                        <a href="#" class="f12 textRed">待结算</a>
                                                    @elseif($order->status == 7)
                                                        <a href="#" class="f12 textBlue">待开发票</a>
                                                    @elseif($order->status == 8)
                                                        <a href="#" class="f12 textBlue">待收发票</a>
                                                    @elseif($order->status == 9)
                                                        <a href="#" class="f12 textBlue">待评价</a>
                                                    @elseif($order->status == 99)
                                                        <a href="#" class="f12">交易成功</a>
                                                    @elseif($order->status == 100)
                                                        <a href="#" class="f12">订单取消</a>
                                                    @endif
                                                    {{--<a href="#" class="f12">订单详情</a>--}}
                                                </li>
                                                <li class="td10">
                                                    @if($order->status == 4)
                                                        {{--<a href="{{ route('seller.stocks.change', ['order_sn' => $order->order_sn, 'status' => 5]) }}" class="btnFukuan btnRed2">发货</a>--}}
                                                        <a id="send_captcha" href="javascript:void(0);" data_id="{{ $order->id }}" class="btnFukuan btnRed2">发货</a>
                                                    @elseif($order->status == -1 && $order->contract && $order->contract->status == 1 )
                                                        <a href="{{ route('user.stocks.contract', ['order_sn' => $order->order_sn]) }}" class="btnShouhuo btnRed4">签约</a>
                                                    @elseif($order->status == 5)
                                                        {{--<a href="{{ route('seller.stocks.change', ['order_sn' => $order->order_sn, 'status' => 6]) }}" class="btnShouhuo btnRed4">已收货</a>--}}
                                                        <a id="receive" href="javascript:void(0);" data_id="{{ $order->id }}" class="btnShouhuo btnRed4">已收货</a>
                                                    @elseif($order->status == 6)
                                                        <a href="{{ route('seller.stocks.change', ['order_sn' => $order->order_sn, 'status' => 7]) }}" class="btnShouhuo btnRed4">结算</a>
                                                    @elseif($order->status == 8)
                                                        <a href="{{ route('seller.stocks.invoice', ['order_sn' => $order->order_sn]) }}" class="btnShouhuo btnBlue4">开发票</a>
                                                    @elseif($order->status == 99)
                                                        <a href="{{ route('user.stocks.completion', ['order_sn' => $order->order_sn]) }}" class="btnShouhuo btnBlue4">查看评论</a>
                                                    @endif
                                                </li>
                                            </ul>
                                        </li>
                                    </ul>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <input id="csrfToken" type="hidden" value="{{ csrf_token() }}">
                <div class="fenyeArea clear">
                    {!! $order_goods->render() !!}
                </div>
                <!-- ad-->
                @include('_layouts.ads')
            </div>
        </div>
    </div>

    <!-- Toaster -->
    <script src="/plugins/jquery-toaster/jquery.toaster.js"></script>

    <!-- pages script -->
    <script src="/plugins/jquery-form/jquery.form.min.js"></script>
    <script src="/assets/base.js"></script>

    <script type="text/javascript">
        $("#stocks_order").addClass("on");
    $(function(){
    	$(document).on("click", ".thead .contact", function() {
	        var tel=$(this).attr("data_tel");
	        $.alert("请拨打电话："+tel, "联系方式");
	    });

        var base = new Base();
        base.initForm();

        $(document).on('click', '#send_captcha', function() {
            var data = {
                order_id  : $(this).attr("data_id"),
                _token  : $('#csrfToken').val()
            };

            $.post('{{ route('seller.stocks.sendgoodssms') }}', data, function(response) {
                if (response.result !== true) {
                    $.toaster({ priority : 'danger', title : '失败', message : response.message });
                    self.waiting = false;
                    return false;
                }

                $.toaster({ priority : 'success', title : '成功', message : response.message });
                window.location.reload();
            })
        });

        $(document).on('click', '#receive', function() {
            $.prompt({
                text: "",
                title: "输入收货码",
                onOK: function(text) {
//                    $.alert("您的收货码是:"+text);
                    var data = {
                        order_id  : $("#receive").attr("data_id"),
                        code : text,
                        _token  : $('#csrfToken').val()
                    };
                    //alert(data.order_id);return;

                    $.post('{{ route('seller.stocks.receive') }}', data, function(response) {
                        console.log(response)
                        if (response.result !== true) {
                            $.toaster({ priority : 'danger', title : '失败', message : response.message });
                            self.waiting = false;
                            return false;
                        }

                        $.toaster({ priority : 'success', title : '成功', message : response.message });
                        window.location.reload();
                    })
                },
                onCancel: function() {
                    console.log("取消了");
                },
                input: ''
            });
        });
     })
    </script>
    <!-- footer-->
    @endsection

@section('footer')
    @include('_layouts.shop_footer2')
@endsection
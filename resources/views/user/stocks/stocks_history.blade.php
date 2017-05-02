@extends('_layouts.shop')

@section('main-content')
    <!-- content-->
    <div class="meCenIndex_con mid_div min_w marok">
        <div class="tit">
            <img src="/assets/shop/img/person/mecentertit.jpg"/>
            <p class="line"></p>
        </div>
        <div class="content clear">
            @include('_layouts.user_left')
            <div class="R">
                <!-- 我的现货 我的期货 我的合同-->
                <div class="orderQihuo">
                    <ul class="tab clear">
                        <li class="on"><a href="{{ route('user.stocks-history') }}">我的现货</a></li>
                        <li class="line"></li>
                        <li><a href="{{ route('user.futures-history') }}">我的期货</a></li>
                        <li class="line"></li>
                        <li><a href="{{ route('user.contract-history') }}">我的合同</a></li>
                    </ul>
                    <!-- 我的现货-->
                    <div class="orderCon">
                        <div class="tit">
                            <ul class="L clear">
                                <li @if(Request::input('type') == 0) class="on" @endif><a href="{{route('user.stocks-history')}}">全部</a></li>
                                <li @if(Request::input('type') == -1) class="on" @endif><a href="{{route('user.stocks-history', ['type' => -1])}}">待签约</a></li>
                                <li @if(Request::input('type') == 1) class="on" @endif><a href="{{route('user.stocks-history', ['type' => 1])}}">待付款</a></li>
                                <li @if(Request::input('type') == 4) class="on" @endif><a href="{{route('user.stocks-history', ['type' => 4])}}">待发货</a></li>
                                <li @if(Request::input('type') == 5) class="on" @endif><a href="{{route('user.stocks-history', ['type' => 5])}}">待收货</a></li>
                                <li @if(Request::input('type') == 6) class="on" @endif><a href="{{route('user.stocks-history', ['type' => 6])}}">待结算</a></li>
                                <li @if(Request::input('type') == 7) class="on" @endif><a href="{{route('user.stocks-history', ['type' => 7])}}">待开票</a></li>
                                <li @if(Request::input('type') == 99) class="on" @endif><a href="{{route('user.stocks-history', ['type' => 9])}}">交易完成</a></li>
                                <li @if(Request::input('type') == 9) class="on" @endif><a href="{{route('user.stocks-history', ['type' => 8])}}">待评价</a></li>

                            </ul>
                            {{--<a href="#" class="R">查看全部现货</a>--}}
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
                                            <?php echo substr($order->created_at,0,10) ?>
                                            订单号：{{ $order->order_sn  or '' }}
                                        </li>
                                        <li class="two">{{ $order->seller->name  or '' }}</li>
                                        <li class="three">
                                            <a href="#" class="contact"></a>
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
                                                        <a href="#" class="f12 textRed">待收货</a>
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
                                                    @endif
                                                    <a href="#" class="f12">订单详情</a>
                                                </li>
                                                <li class="td10">
                                                    @if($order->status == 1)
                                                        <a href="{{ route('user.pay', ['order_sn' => $order->order_sn]) }}" class="btnFukuan btnRed2">付款</a>
                                                    @elseif($order->status == -1)
                                                        <a href="{{ route('user.stocks.contract', ['order_sn' => $order->order_sn]) }}" class="btnShouhuo btnRed4">签约</a>
                                                    @elseif($order->status == 5)
                                                        <a href="{{ route('user.logistic', ['order_sn' => $order->order_sn]) }}" class="btnShouhuo btnRed4">查看物流</a>
                                                    @elseif($order->status == 7)
                                                        <a href="{{ route('user.invoice', ['order_sn' => $order->order_sn]) }}" class="btnShouhuo btnBlue4">开发票</a>
                                                        {{--@elseif($order->status == 8)
                                                            <a href="#" class="btnShouhuo btnBlue4">已收发票</a>--}}
                                                    @elseif($order->status == 9)
                                                        <a href="{{ route('user.stocks.completion', ['order_sn' => $order->order_sn]) }}" class="btnPingjia btnGrayBd2">评价</a>
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
                <div class="more_div">
                    {!! $order_goods->render() !!}
                </div>

                <!-- ad-->
                @include('_layouts.ads')

            </div>
        </div>
    </div>
    <!-- footer-->
@endsection

@section('footer')
    @include('_layouts.shop_footer2')
@endsection
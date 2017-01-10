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
                <!-- 我的合同-->
                <div class="mehetong">
                    <ul class="tab clear">
                        <li><a href="{{ route('user.contract') }}">未签约</a></li>
                        <li class="on"><a href="{{ route('user.contract.already') }}">已签约</a></li>
                        <li class="right" style="width: 780px;"><p class="tip">优钢网提示您：如果您的订单合同自发起之日起买卖双方没有签约成功，系统将自动终止双方的签约。</p></li>
                    </ul>
                    <!-- table-->
                    <div class="table">
                        <ul class="thead clear">
                            <li class="td1">订单号</li>
                            <li class="td2">签订日期</li>
                            <li class="td3">合同编号</li>
                            <li class="td4">供应商家</li>
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
                                        <li class="td5">@if($order->state == 1)等待卖家签约@elseif($order->state == 2)待确认@else完成@endif</li>
                                        <li class="td6">
                                            @if($order->ostate == -1 && $order->state == 2 )
                                                <a href="{{ route('user.stocks.contract', ['order_sn' => $order->order_sn]) }}" data-htid="1" class="btnGrayBd4 qxqy_toast">确认合同</a>
                                            @endif
                                        </li>
                                    </ul>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
                <!-- 查看历史记录-->
                <div class="history clear">
                    <a href="/user/contract-history" class="seeHistory L">查看历史记录</a>
                    <!-- 分页-->
                    {{--<div class="fenyeArea clear R">
                        <ul class="fenye clear R">
                            <li class="on"><a href="#">1</a></li>
                            <li><a href="#">2</a></li>
                            <li><a href="#">3</a></li>
                            <li><a href="#">8</a></li>
                            <li><a href="#">9</a></li>
                            <li class="last"><a href="#">10</a></li>
                        </ul>
                    </div>--}}
                    <div class="fenyeArea clear">
                        {!! $orders->render() !!}
                    </div>
                </div>
                <!-- ad-->
                <ul class="ads clear">
                    <li><img src="/assets/shop/img/person/ad.jpg"/></li>
                    <li><img src="/assets/shop/img/person/ad.jpg"/></li>
                    <li class="last"><img src="/assets/shop/img/person/ad.jpg"/></li>
                </ul>
            </div>
        </div>
    </div>
    <!-- footer-->
@endsection

@section('footer')
    @include('_layouts.shop_footer2')
@endsection
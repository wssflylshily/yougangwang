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
                <!-- 我的期货-->
                <div class="orderQihuo">
                    <ul class="tab clear" style="margin-bottom: 10px;">
                        <li><a href="{{ route('user.order.cancel.index') }}">现货订单</a></li>
                        <li class="on"><a href="{{ route('user.order.cancel.futures') }}">期货订单</a></li>
                    </ul>
                    <!-- 我的期货-->
                    <div class="orderCon">
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
                        <!-- 期货列表 normal是非评价的期货列表 蓝色  评价的期货列表是 灰色-->
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
                                            <a href="javascript:;" class="contact" data_tel="{{ $order->seller->user->mobile  or '' }}"></a>
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
                                                    <a href="#" class="f12">订单详情</a>
                                                </li>
                                                <li class="td10">
                                                    订单已关闭
                                                </li>
                                            </ul>
                                        </li>
                                    </ul>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                {{--<div class="fenyeArea clear">
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
                    {!! $order_goods->render() !!}
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
@extends('_layouts.shop')

@section('main-content')
    <!-- content-->
    <div class="meCenIndex_con mid_div min_w marok">
        <div class="tit">
            <img src="/assets/shop/img/person/mecentertit.jpg"/>
            <p class="line"></p>
        </div>
        <div class="content clear">
            <ul class="L">
                <li><a style="color: #e7e7e7" href="#">我的购物车</a></li>
                <li><a href="/user/stocks">我的现货</a></li>
                <li><a href="/user/futures">我的期货</a></li>
                <li><a style="color: #e7e7e7" href="#" rel="/user/contract">我的合同</a></li>
                <li><a style="color: #e7e7e7" href="#">我的评价</a></li>
                <li><a style="color: #e7e7e7" href="#">取消订单记录</a></li>
                <li><a href="/user/address">管理收货地址</a></li>
                <li class="line"></li>
                <li><a style="color: #e7e7e7" href="#">关注的钢材</a></li>
                <li><a style="color: #e7e7e7" href="#">关注的商家</a></li>
                <li class="line"></li>
                <li><a style="color: #e7e7e7" href="#">我的积分</a></li>
                <li><a style="color: #e7e7e7" href="#">我的活动</a></li>
                <li><a style="color: #e7e7e7" href="#">我的优钢币</a></li>
                <li class="line"></li>
                <li><a style="color: #e7e7e7" href="#">退货退款</a></li>
                <li><a style="color: #e7e7e7" href="#">交易纠纷</a></li>
                <li><a style="color: #e7e7e7" href="#">意见建议</a></li>
                <li><a style="color: #e7e7e7" href="#">我的投诉</a></li>
                <li class="line"></li>
                <li><a style="color: #e7e7e7" href="#">历史访问</a></li>
                <li><a style="color: #e7e7e7" href="#">最近访问</a></li>
            </ul>
            <div class="R">
                @yield('right-content')

                <!-- ad-->
                <ul class="ads clear" id="ads_clear">
                    <li><img src="/assets/shop/img/person/ad.jpg"/></li>
                    <li><img src="/assets/shop/img/person/ad.jpg"/></li>
                    <li class="last"><img src="/assets/shop/img/person/ad.jpg"/></li>
                </ul>
            </div>
        </div>
    </div>
@endsection

@section('footer')
    @include('_layouts.shop_footer2')
@endsection

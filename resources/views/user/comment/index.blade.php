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
                        <li class="on"><a href="my_evaluate.html">我的评价</a></li>
                    </ul>
                    <ul class="evaluate_ul">
                        @if($rs)
                            @foreach($rs as $com)
                                <li>
                                    <h2><span class="s01">订单编号：{{ $com->order->order_sn }} </span><span class="s02">商家名称：{{ $com->order->seller->name }}</span><span class="contact_sj"></span></h2>
                                    <div class="evaluate_font">
                                        <b>评价内容:</b>
                                        {{ $com->message }}
                                    </div>
                                </li>
                            @endforeach
                        @endif
                    	{{--<li>
                    		<h2><span class="s01">订单编号：122222222222 </span><span class="s02">商家名称：山东名称</span><span class="contact_sj"></span></h2>
                    		<div class="evaluate_font">
                    			<b>评价内容:</b>
                    			 好评！！！好评！！！好评！！！好评！！！
                    		</div>
                    	</li>--}}
                    	{{--<li>
                    		<h2><span class="s01">订单编号：122222222222 </span><span class="s02">商家名称：山东名称</span><span class="contact_sj"></span></h2>
                    		<div class="evaluate_font">
                    			<b>评价内容:</b>
                    			 好评！！！好评！！！好评！！！好评！！！
                    		</div>
                    	</li>--}}
                    </ul>
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
                    {!! $rs->render() !!}
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
@extends('_layouts.shop')

@section('main-content')
    <!-- content-->
<div class="meCenIndex_con mid_div marok spmecangku">
        <div class="tit">
            <img src="/assets/shop/img/shangpu/sptit.jpg"/>
            <p class="line"></p>
        </div>
        <div class="content clear">
            @include('_layouts.seller_left')
            <div class="R">
                <!-- 我的期货-->
                <div class="orderQihuo">
                	{{--<ul class="tab clear" style="margin-bottom: 10px;">
                        <li class="on"><a href="my_evaluate.html">我的评价</a></li>
                    </ul>--}}
                    <ul class="evaluate_ul">
                        @if($rs)
                            @foreach($rs as $com)
                                <li>
                                    <h2><span class="s01">订单编号：{{ $com->order->order_sn or ''}} </span><span class="s02">商家名称：{{ $com->order->seller->name or ''}}</span></h2>

                                    <div class="evaluate_font">
                                        <b style="float: left">星级评价:</b>
                                        @if($com)
                                            <div class="com_star" style="float: left">
                                                @for($i=0;$i<$com->star;$i++)
                                                    <span title="1" class="on"></span>
                                                @endfor
                                            </div>
                                        @else
                                            <div class="com_star">
                                                <span title="1"></span>
                                                <span title="2"></span>
                                                <span title="3"></span>
                                                <span title="4"></span>
                                                <span title="5"></span>
                                            </div>
                                        @endif
                                        <b style="margin-left: 20px;">评价内容:</b>
                                        {{ $com->message }}
                                    </div>

                                        {{--{{ $com->message }}--}}

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
                @include('_layouts.ads')
            </div>
        </div>
    </div>
    <!-- footer-->
    <script>
        $("#index").addClass("on");
    </script>
@endsection

@section('footer')
    @include('_layouts.shop_footer2')
@endsection
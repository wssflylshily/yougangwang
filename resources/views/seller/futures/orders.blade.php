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
                        <li class="on"><a href="meHeTongHistory1.html">期货订单</a></li>
                    </ul>
                    <!-- 我的现货-->
                    <div class="orderCon">
                        <div class="tit">
                            <ul class="L clear">
                                <li class="on"><a href="#">全部</a></li>
                                <li><a href="#">等待签约</a></li>
                                <li><a href="#">待付款</a></li>
                                <li><a href="#">待生产</a></li>
                                <li><a href="#">待发货</a></li>
                                <li><a href="#">已发货</a></li>
                                <li><a href="#">待开票</a></li>
                                <li><a href="#">交易完成</a></li>
                            </ul>
                        </div>
                        <ul class="tableTit clear">
                            <li class="td1">地区</li>
                            <li class="td2">品种</li>
                            <li class="td3">标准</li>
                            <li class="td4">材质</li>
                            <li class="td5">钢厂</li>
                            <li class="td6">规格</li>
                            <li class="td7">数量</li>
                            <li class="td8">实付款</li>
                            <li class="td9">交易状态</li>
                            <li class="td10">交易操作</li>
                        </ul>
                        <!-- 期货列表 normal是非评价期货列表 蓝色  评价的期货列表是 灰色-->
                        <ul class="orderList">
                        	@foreach($orders as $order)
                            <li class="order">
                                <ul class="thead clear">
                                    <li class="one">
                                        <input class="check_btn" type="checkbox" name="neirong" value="">
                                        <?php echo substr($order->created_at,0,10); ?>
                                        {{$order->order_sn}}
                                    </li>
                                    <li class="two">{{$order->seller->name}}</li>
                                    <li class="three">
                                        <a href="javascript:;" data_tel="{{$order->user->mobile}}" class="contact" style="background-image: url(/assets/shop/img/contact_p.png);"></a>
                                    </li>
                                </ul>
                                <ul class="tbody">
                                    <li>
                                        <ul class="tr clear">
                                            <li class="col7">
                                        	@foreach($order->futures as $future)
                                                <ul>
                                                    <li class="td1">{{$future->area_id}}</li>
                                                    <li class="td2">{{$future->variety}}</li>
                                                    <li class="td3">{{$future->standard}}</li>
                                                    <li class="td4">{{$future->material}}</li>
                                                    <li class="td5">{{$future->steelmill}}</li>
                                                    <li class="td6">
                                                    @if($future->length_type==1)
													{{ $future->outer_diameter}}*{{$future->thickness}}*{{$future->length*100 }} ~ {{ $future->outer_diameter}}*{{$future->thickness}}*{{$future->max_length*100 }}
													@else
													{{ $future->outer_diameter}}*{{$future->thickness}}*{{$future->length*100 }}
													@endif
                                                    </li>
                                                    <li class="td7">{{$future->stock}}@if($future->unit==1)支@else吨@endif</li>
                                                </ul>
                                            @endforeach
                                            </li>
                                            <li class="td8">
                                                <p class="black">￥{{$order->order_amount}}</p>
                                                <p class="f12">(含运费：￥{{$order->postsge}})</p>
                                            </li>
                                            <li class="td9">
                                           		@if($order->status==0)
                                                <a href="javascript:;" class="f12 textRed">等待买家回复</a>
                                                @elseif($order->status==-1)
                                                <a href="javascript:;" class="f12 textRed">待签约</a>
                                                @elseif($order->status==2)
                                                <a href="javascript:;" class="f12 textRed">待付首款</a>
                                                @elseif($order->status==3)
                                                <a href="javascript:;" class="f12 textRed">待付尾款</a>
                                                @elseif($order->status==4)
                                                <a href="javascript:;" class="f12 textRed">待发货</a>
                                                @elseif($order->status==5)
                                                <a href="{{route('seller.futures.logistics',['order_id'=>$order->id])}}" class="f12 textRed">添加物流</a>
                                                <!-- <a href="{{route('shop.futures.logistic',['order_id'=>$order->id])}}" class="f12 textRed">查看物流</a> -->
                                                @elseif($order->status==6)
                                                <a href="javascript:;" class="f12 textRed">待结算</a>
                                                @elseif($order->status==7)
                                                <a href="javascript:;" class="f12 textRed">待开发票</a>
                                                @elseif($order->status==8)
                                                <a href="javascript:;" class="f12 textRed">待收发票</a>
                                                @elseif($order->status==9)
                                                <a href="javascript:;" class="f12 textRed">待评价</a>
                                                @elseif($order->status==99)
                                                <a href="javascript:;" class="f12 textRed">交易完成</a>
                                            	@endif
                                                <a href="#" class="f12">订单详情</a>
                                            </li>
                                            <li class="td10">
                                            	@if($order->status==0)
                                            	<!-- <a href="" class="btnFukuan btnRed2">选择商家</a>-->
                                            	@elseif($order->status==-1)
                                                <!-- <a href="#" class="btnFukuan btnRed2">签约</a> -->
                                                @elseif($order->status==2)
                                                <a href="#" class="btnBlue4">查看合同</a>
                                                @elseif($order->status==3)
                                                <a href="#" class="btnBlue4">查看合同</a>
                                                @elseif($order->status==4)
                                                <a href="{{route('seller.futures.changeStatus',['order_id'=>$order->id,'status'=>5])}}" class="btnBlue4">发货</a>
                                                @elseif($order->status==5)
                                                <a href="{{route('seller.futures.changeStatus',['order_id'=>$order->id,'status'=>6])}}" class="btnBlue4">确认收货</a>
                                                @elseif($order->status==6)
                                                <a href="{{route('seller.futures.changeStatus',['order_id'=>$order->id,'status'=>7])}}" class="btnBlue4">结算</a>
                                                @elseif($order->status==7)
                                                <a href="#" class="btnBlue4">查看发票</a>
                                                @elseif($order->status==8)
                                                <a href="{{route('seller.futures.changeStatus',['order_id'=>$order->id,'status'=>9])}}" class="btnBlue4">寄送发票</a>
                                                @elseif($order->status==9)
                                                <!-- <a href="#" class="btnFukuan btnRed2">去评价</a> -->
                                                @elseif($order->status==99)
                                                <a href="#" class="btnBlue4">交易完成</a>
                                            	@endif
                                                <!-- <a href="#" class="btnFukuan btnRed2">待付款</a> -->
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                            @endforeach
                            
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script type="text/javascript">
    $(function(){
    	$(document).on("click", ".thead .contact", function() {
	        var tel=$(this).attr("data_tel");
	        $.alert("请拨打电话："+tel, "联系方式");
	    });
     })
    </script>
    <!-- footer-->
    @endsection

@section('footer')
    @include('_layouts.shop_footer2')
@endsection
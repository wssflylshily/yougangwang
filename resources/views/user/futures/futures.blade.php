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
                    <ul class="tab clear">
                        <li class="on"><a href="#">我的期货</a></li>
                    </ul>
                    <!-- 我的期货-->
                    <div class="orderCon">
                        <div class="tit">
                            <ul class="L clear">
                                <li @if($status==null) class="on" @endif><a href="{{route('user.futures')}}">全部</a></li>
                                <li @if($status=='0') class="on" @endif><a href="{{route('user.futures',['status'=>0])}}">未接单</a></li>
                                <li @if($status==-1) class="on" @endif><a href="{{route('user.futures',['status'=>-1])}}">待签约</a></li>
                                <li @if($status==2) class="on" @endif><a href="{{route('user.futures',['status'=>2])}}">待付首款</a></li>
                                <li @if($status==3) class="on" @endif><a href="{{route('user.futures',['status'=>3])}}">待付尾款</a></li>
                                <li @if($status==4) class="on" @endif><a href="{{route('user.futures',['status'=>4])}}">待发货</a></li>
                                <li @if($status==5) class="on" @endif><a href="{{route('user.futures',['status'=>5])}}">待收货</a></li>
                                <li @if($status==6) class="on" @endif><a href="{{route('user.futures',['status'=>6])}}">待结算</a></li>
                                <li @if($status==7) class="on" @endif><a href="{{route('user.futures',['status'=>7])}}">待开票</a></li>
                                <li @if($status==9) class="on" @endif><a href="{{route('user.futures',['status'=>9])}}">待评价</a></li>
                                <li @if($status==99) class="on" @endif><a href="{{route('user.futures',['status'=>99])}}">交易完成</a></li>
                            </ul>
                            <a href="/user/futures-history" style="display:none;" class="R">查看全部订单</a>
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
                        <!-- 期货列表 normal是非评价的期货列表 蓝色  评价的期货列表是 灰色-->
                        <ul class="orderList">
                        	@foreach($orderList as $order)
                            <li class="order">
                                <ul class="thead clear">
                                    <li class="one">
                                        <input class="check_btn" type="checkbox" name="neirong" value="">
                                        <?php echo substr($order->created_at,0,10); ?>
                                        订单号：{{ $order->order_sn }}
                                    </li>
                                    <li class="two">
                                    @if($order->offers_cnt()>0)
                                    	已有 <b class="orange">{{ $order->offers_cnt() }}家</b> 商家接单
                                    @else	暂无商家接单
                                    @endif</li>
                                    @if($order->seller_id > 0)
                                    <li class="three">
                                    	<?php //dd($order->seller->user); ?>
                                        <a href="javascript:;" data_tel="{{$order->seller->user->mobile}}" class="contact"></a>
                                    </li>
                                    @endif
                                </ul>
                                <ul class="tbody">
                                    <li>
                                        <ul class="tr clear">
                                            <li class="col7">
                                        	@foreach($order->futures as $future)
                                                <ul>
                                                    <li class="td1">{{ $future->area_id }}</li>
                                                    <li class="td2">{{ $future->variety }}</li>
                                                    <li class="td3">{{ $future->standard }}</li>
                                                    <li class="td4">{{ $future->material }}</li>
                                                    <li class="td5">{{ $future->steelmill }}</li>
                                                    <li class="td6">{{ $future->outer_diameter }}*{{ $future->thickness }}*{{ $future->length*100 }}</li>
                                                    <li class="td7">{{ $future->stock }}</li>
                                                </ul>
                                                @endforeach
                                            </li>
                                            <li class="td8">
                                                <p class="black">￥{{$order->order_amount}}</p>
                                                <p class="f12">(含运费：￥{{$order->postsge}})</p>
                                            </li>
                                            <li class="td9">
                                                @if($order->status==0&&$order->offers_cnt()>0)
                                                <a href="javascript:;" class="f12 textRed">待选择商家</a>
                                                @elseif($order->status==-1)
                                                <a href="javascript:;" class="f12 textRed">待签约</a>
                                                @elseif($order->status==2)
                                                <a href="javascript:;" class="f12 textRed">待付首款</a>
                                                @elseif($order->status==3)
                                                <a href="javascript:;" class="f12 textRed">待付尾款</a>
                                                @elseif($order->status==4)
                                                <a href="javascript:;" class="f12 textRed">待发货</a>
                                                @elseif($order->status==5)
                                                <a href="javascript:;" class="f12 textRed">待收货</a>
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
                                            
                                            	@if($order->status==0&&$order->offers_cnt() > 0)
                                            	<a href="{{ route('user.futures.takeOrder',['order_sn'=>$order->order_sn]) }}" class="btnSelectShagnjia btnBlue4">选择商家</a>
                                            	@elseif($order->status==-1)
                                                <a href="{{route('user.futures.changeStatus',['order_id'=>$order->id,'status'=>2])}}" class="btnSelectShagnjia btnBlue4">签约</a>
                                                @elseif($order->status==2)
                                                <a href="{{route('user.futures.changeStatus',['order_id'=>$order->id,'status'=>3])}}" class="btnFukuan btnRed2">付首款</a>
                                                @elseif($order->status==3)
                                                <a href="{{route('user.futures.changeStatus',['order_id'=>$order->id,'status'=>4])}}" class="btnFukuan btnRed2">付尾款</a>
                                                @elseif($order->status==4)
                                                <!-- <a href="#" class="btnShangjiaTui btnGrayBd4">查看物流</a> -->
                                                @elseif($order->status==5)
                                                <a href="{{route('shop.futures.logistic',['order_id'=>$order->id])}}" class="btnShangjiaTui btnBlue4">查看物流</a>
                                                @elseif($order->status==6)
                                                <!-- -<a href="#" class="btnShangjiaTui btnGrayBd4">待结算</a> -->
                                                @elseif($order->status==7)
                                                <!-- <a href="{{route('user.futures.changeStatus',['order_id'=>$order->id,'status'=>8])}}" class="btnSelectShagnjia btnBlue4">开发票</a> -->
                                                <a href="{{route('user.futures.invoice',['order_id'=>$order->id])}}" class="btnSelectShagnjia btnBlue4">开发票</a>
                                                @elseif($order->status==8)
                                                <a href="#" class="btnSelectShagnjia btnBlue4">查看发票</a>
                                                @elseif($order->status==9)
                                                <a href="{{route('user.futures.changeStatus',['order_id'=>$order->id,'status'=>99])}}" class="btnSelectShagnjia btnBlue4">去评价</a>
                                                @elseif($order->status==99)
                                                <!-- <a href="#" class="btnShangjiaTui btnGrayBd4">交易完成</a> -->
                                            	@endif
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                            @endforeach
                            <!-- <li class="order">
                                <ul class="thead clear">
                                    <li class="one">
                                        <input class="check_btn" type="checkbox" name="neirong" value="">
                                        2016-10-22
                                        订单号：2602065004365800
                                    </li>
                                    <li class="two">已有 <b class="orange">3家</b> 商家接单</li>
                                    <li class="three">
                                        <a href="#" class="contact"></a>
                                    </li>
                                </ul>
                                <ul class="tbody">
                                    <li>
                                        <ul class="tr clear">
                                            <li class="col7">
                                                <ul>
                                                    <li class="td1">天津</li>
                                                    <li class="td2">无缝管</li>
                                                    <li class="td3">API 5L</li>
                                                    <li class="td4">#20</li>
                                                    <li class="td5">鞍钢</li>
                                                    <li class="td6">219*9.8*12000</li>
                                                    <li class="td7">69</li>
                                                </ul>
                                                <ul class="last">
                                                    <li class="td1">天津</li>
                                                    <li class="td2">无缝管</li>
                                                    <li class="td3">API 5L</li>
                                                    <li class="td4">#20</li>
                                                    <li class="td5">鞍钢</li>
                                                    <li class="td6">219*9.8*12000</li>
                                                    <li class="td7">69</li>
                                                </ul>
                                            </li>
                                            <li class="td8">
                                                <p class="black">￥218730</p>
                                                <p class="f12">(含运费：￥3450.00)</p>
                                            </li>
                                            <li class="td9">
                                                <a href="#" class="f12">订单详情</a>
                                            </li>
                                            <li class="td10">
                                                <a href="#" class="btnSelectShagnjia btnBlue4">选择商家</a>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                            <li class="order">
                                <ul class="thead clear">
                                    <li class="one">
                                        <input class="check_btn" type="checkbox" name="neirong" value="">
                                        2016-10-22
                                        订单号：2602065004365800
                                    </li>
                                    <li class="two">天津华远兴业</li>
                                    <li class="three">
                                        <a href="#" class="contact"></a>
                                    </li>
                                </ul>
                                <ul class="tbody">
                                    <li>
                                        <ul class="tr clear">
                                            <li class="col7">
                                               <ul class="last">
                                                   <li class="td1">天津</li>
                                                   <li class="td2">无缝管</li>
                                                   <li class="td3">API 5L</li>
                                                   <li class="td4">#20</li>
                                                   <li class="td5">鞍钢</li>
                                                   <li class="td6">219*9.8*12000</li>
                                                   <li class="td7">69</li>
                                               </ul>
                                            </li>
                                            <li class="td8">
                                                <p class="black">￥218730</p>
                                                <p class="f12">(含运费：￥3450.00)</p>
                                            </li>
                                            <li class="td9">
                                                <a href="#" class="f12">订单详情</a>
                                            </li>
                                            <li class="td10">
                                                <a href="#" class="btnFukuan btnRed2">付款</a>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                            <li class="order pingjia">
                                <ul class="thead clear">
                                    <li class="one">
                                        <input class="check_btn" type="checkbox" name="neirong" value="">
                                        2016-10-22
                                        订单号：2602065004365800
                                    </li>
                                    <li class="two">山东鲁能</li>
                                    <li class="three">
                                        <a href="#" class="contact"></a>
                                    </li>
                                </ul>
                                <ul class="tbody">
                                    <li>
                                        <ul class="tr clear">
                                            <li class="col7">
                                                <ul>
                                                    <li class="td1">天津</li>
                                                    <li class="td2">无缝管</li>
                                                    <li class="td3">API 5L</li>
                                                    <li class="td4">#20</li>
                                                    <li class="td5">鞍钢</li>
                                                    <li class="td6">219*9.8*12000</li>
                                                    <li class="td7">69</li>
                                                </ul>
                                                <ul class="last">
                                                    <li class="td1">天津</li>
                                                    <li class="td2">无缝管</li>
                                                    <li class="td3">API 5L</li>
                                                    <li class="td4">#20</li>
                                                    <li class="td5">鞍钢</li>
                                                    <li class="td6">219*9.8*12000</li>
                                                    <li class="td7">69</li>
                                                </ul>
                                            </li>
                                            <li class="td8">
                                                <p class="black">￥218730</p>
                                                <p class="f12">(含运费：￥3450.00)</p>
                                            </li>
                                            <li class="td9">
                                                <a href="#" class="f12 textBlue">生产中</a>
                                                <a href="#" class="f12">订单详情</a>
                                            </li>
                                            <li class="td10">
                                                <a href="#" class="btnBlue4 disabled">确认收货</a>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                            <li class="order pingjia">
                                <ul class="thead clear">
                                    <li class="one">
                                        <input class="check_btn" type="checkbox" name="neirong" value="">
                                        2016-10-22
                                        订单号：2602065004365800
                                    </li>
                                    <li class="two">山东鲁能</li>
                                    <li class="three">
                                        <a href="#" class="contact"></a>
                                    </li>
                                </ul>
                                <ul class="tbody">
                                    <li>
                                        <ul class="tr clear">
                                            <li class="col7">
                                                <ul>
                                                    <li class="td1">天津</li>
                                                    <li class="td2">无缝管</li>
                                                    <li class="td3">API 5L</li>
                                                    <li class="td4">#20</li>
                                                    <li class="td5">鞍钢</li>
                                                    <li class="td6">219*9.8*12000</li>
                                                    <li class="td7">69</li>
                                                </ul>
                                                <ul class="last">
                                                    <li class="td1">天津</li>
                                                    <li class="td2">无缝管</li>
                                                    <li class="td3">API 5L</li>
                                                    <li class="td4">#20</li>
                                                    <li class="td5">鞍钢</li>
                                                    <li class="td6">219*9.8*12000</li>
                                                    <li class="td7">69</li>
                                                </ul>
                                            </li>
                                            <li class="td8">
                                                <p class="black">￥218730</p>
                                                <p class="f12">(含运费：￥3450.00)</p>
                                            </li>
                                            <li class="td9">
                                                <a href="#" class="f12">已完成</a>
                                                <a href="#" class="f12 textRed">查看物流</a>
                                            </li>
                                            <li class="td10">
                                                <a href="#" class="btnBlue4">确认收货</a>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                            <li class="order pingjia">
                                <ul class="thead clear">
                                    <li class="one">
                                        <input class="check_btn" type="checkbox" name="neirong" value="">
                                        2016-10-22
                                        订单号：2602065004365800
                                    </li>
                                    <li class="two">山东鲁能</li>
                                    <li class="three">
                                        <a href="#" class="contact"></a>
                                        <a href="#" class="del"></a>
                                    </li>
                                </ul>
                                <ul class="tbody">
                                    <li>
                                        <ul class="tr clear">
                                            <li class="col7">
                                                <ul>
                                                    <li class="td1">天津</li>
                                                    <li class="td2">无缝管</li>
                                                    <li class="td3">API 5L</li>
                                                    <li class="td4">#20</li>
                                                    <li class="td5">鞍钢</li>
                                                    <li class="td6">219*9.8*12000</li>
                                                    <li class="td7">69</li>
                                                </ul>
                                                <ul class="last">
                                                    <li class="td1">天津</li>
                                                    <li class="td2">无缝管</li>
                                                    <li class="td3">API 5L</li>
                                                    <li class="td4">#20</li>
                                                    <li class="td5">鞍钢</li>
                                                    <li class="td6">219*9.8*12000</li>
                                                    <li class="td7">69</li>
                                                </ul>
                                            </li>
                                            <li class="td8">
                                                <p class="black">￥218730</p>
                                                <p class="f12">(含运费：￥3450.00)</p>
                                            </li>
                                            <li class="td9">
                                                <a href="#" class="f12">待开发票</a>
                                                <a href="#" class="f12">订单详情</a>
                                            </li>
                                            <li class="td10">
                                                <a href="#" class="btnGrayBd2">评价</a>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                            <li class="order pingjia">
                                <ul class="thead clear">
                                    <li class="one">
                                        <input class="check_btn" type="checkbox" name="neirong" value="">
                                        2016-10-22
                                        订单号：2602065004365800
                                    </li>
                                    <li class="two">山东鲁能</li>
                                    <li class="three">
                                        <a href="#" class="contact"></a>
                                        <a href="#" class="del"></a>
                                    </li>
                                </ul>
                                <ul class="tbody">
                                    <li>
                                        <ul class="tr clear">
                                            <li class="col7">
                                                <ul class="last">
                                                    <li class="td1">天津</li>
                                                    <li class="td2">无缝管</li>
                                                    <li class="td3">API 5L</li>
                                                    <li class="td4">#20</li>
                                                    <li class="td5">鞍钢</li>
                                                    <li class="td6">219*9.8*12000</li>
                                                    <li class="td7">69</li>
                                                </ul>
                                            </li>
                                            <li class="td8">
                                                <p class="black">￥218730</p>
                                                <p class="f12">(含运费：￥3450.00)</p>
                                            </li>
                                            <li class="td9">
                                                <a href="#" class="f12">交易完成</a>
                                                <a href="#" class="f12">订单详情</a>
                                            </li>
                                            <li class="td10">
                                                <a href="#" class="btnGrayBd2">评价</a>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                             -->
                        </ul>
                    </div>
                </div>
                <div class="fenyeArea clear">
                    {!! $orderList->render() !!}
                    <!-- <ul class="fenye clear R">
                        
                        <li class="on"><a href="#">1</a></li>
                        <li><a href="#">2</a></li>
                        <li><a href="#">3</a></li>
                        <li><a href="#">8</a></li>
                        <li><a href="#">9</a></li>
                        <li class="last"><a href="#">10</a></li>
                    </ul> -->
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
    <script type="text/javascript">
    $(function(){
    	$(document).on("click", ".thead .contact", function() {
	        var tel=$(this).attr("data_tel");
	        $.alert("请拨打电话："+tel, "联系方式");
	    });
     })
    </script>
@endsection

@section('footer')
    @include('_layouts.shop_footer2')
@endsection
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
                <!-- 个人信息-->
               <div class="personInfo clear">
                    <a href="/user/userinfo" class="set"><img src="/assets/shop/img/person/set.jpg"/></a>
                    <p class="headimg L" style="background-image: url({{$users->avatar_pic}})"></p>
                    <ul class="L one">
                        <li><b class="name">{{$users->realname}}</b> @if($users->gender == 1)先生@else女士@endif</li>
                        {{--<li>{{$users->nameauth}}
                            <span class="renzheng"></span>
                        </li>--}}
                        <li>信誉等级：
                            <p class="dengji">
                                {!! $users->degree_html !!}
                            </p>
                        </li>
                        <li>我的公司：{{$users->compony}}</li>
                        {{--<li>收货地址：{{$users->consignee}}</li>--}}
                    </ul>
                    <ul class="L two">
                        <li>待签约：{{ $num[0] or 0 }}</li>
                        <li>待付款：{{ $num[1] or 0 }}</li>
                        <li>待收货：{{ $num[2] or 0 }}</li>
                        {{--<li>待自提：{{ $num[3] or 0 }}</li>--}}
                        <li>待评价：{{ $num[4] or 0 }}</li>
                    </ul>
                </div>
                <!-- 我的现货 我的期货-->
                <div class="orderQihuo">
                    <ul class="tab clear">
                        <li><a href="/user">我的现货</a></li>
                        <li class="line"></li>
                        <li class="on"><a href="/user/home-futures">我的期货</a></li>
                    </ul>
                    <!-- 我的期货-->
                    <div class="orderCon">
                        <div class="tit">
                            <ul class="L clear">
                            	<li @if($status==null) class="on" @endif><a href="{{route('user.home-futures')}}">全部</a></li>
                                <li @if($status=='0') class="on" @endif><a href="{{route('user.home-futures',['status'=>0])}}">未接单</a></li>
                                <li @if($status==-1) class="on" @endif><a href="{{route('user.home-futures',['status'=>-1])}}">待签约</a></li>
                                <li @if($status==2) class="on" @endif><a href="{{route('user.home-futures',['status'=>2])}}">待付首款</a></li>
                                <li @if($status==3) class="on" @endif><a href="{{route('user.home-futures',['status'=>3])}}">待付尾款</a></li>
                                <li @if($status==4) class="on" @endif><a href="{{route('user.home-futures',['status'=>4])}}">待发货</a></li>
                                <li @if($status==5) class="on" @endif><a href="{{route('user.home-futures',['status'=>5])}}">待收货</a></li>
                                <li @if($status==6) class="on" @endif><a href="{{route('user.home-futures',['status'=>6])}}">待结算</a></li>
                                <li @if($status==7) class="on" @endif><a href="{{route('user.home-futures',['status'=>7])}}">待开票</a></li>
                                <li @if($status==9) class="on" @endif><a href="{{route('user.home-futures',['status'=>9])}}">待评价</a></li>
                                <li @if($status==99) class="on" @endif><a href="{{route('user.home-futures',['status'=>99])}}">交易完成</a></li>
                                <!-- <li class="on"><a href="#">全部</a></li>
                                <li><a href="#">未接单</a></li>
                                <li><a href="#">已接单</a></li>
                                <li><a href="#">待付款</a></li>
                                <li><a href="#">生产中</a></li>
                                <li><a href="#">已发货</a></li>
                                <li><a href="#">待开票</a></li>
                                <li><a href="#">交易完成</a></li> -->
                            </ul>
                            <a href="/user/futures" class="R">查看全部订单</a>
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
                        <!-- 期货列表 normal是非评价的期货列表 蓝色  评价的期货列表是 灰色-->
                        <ul class="orderList">
                        	@if($orders != null)
                        	@foreach($orders as $order)
                            <li class="order">
                                <ul class="thead clear">
                                    <li class="one">
                                        <input class="check_btn" type="checkbox" name="neirong" value="">
                                        <?php echo substr($order->created_at,0,10); ?>
                                        订单号：{{ $order->order_sn }}
                                    </li>
                                    <li class="two">@if($order->offers_cnt()>0)
                                    	已有 <b class="orange">{{ $order->offers_cnt() }}家</b> 商家接单
                                    @else	暂无商家接单
                                    @endif</li>
                                    
                                    <li class="three">
                                     	@if($order->seller_id > 0)
                                        <a href="javascript:;" data_tel="{{$order->seller->user->mobile or ''}}" class="contact"></a>
                                    	@endif
                                    	@if($order->offers_cnt()<=0)
                                        <a href="javascript:;" class="del" data_tel="{{ $order->id  or ''}}"></a>
                                    	@endif
                                    </li>
                                </ul>
                                <ul class="tbody">
                                    <li>
                                        <ul class="tr clear">
                                            <li class="co17">
                                                @if($order->futures != null)
                                                @foreach($order->futures as $future)
                                                <ul>
                                                    <li class="td1">{{$future->area or '全部'}}</li>
                                                    <li class="td2">{{$future->variety or '全部'}}</li>
                                                    <li class="td3">{{ $future->standard or '全部' }}</li>
                                                    <li class="td4">{{ $future->material or '全部' }}</li>
                                                    <li class="td5">{{ $future->steelmill or '全部' }}</li>
                                                    <li class="td6">
                                                    @if($future->length_type==2)
                                                    {{ $future->outer_diameter }}*{{ $future->thickness }}*{{ $future->length*100 }}
                                                    @else
                                                    {{ $future->outer_diameter }}*{{ $future->thickness }}*{{ $future->length*100 }} ~ {{ $future->outer_diameter }}*{{ $future->thickness }}*{{ $future->max_length*100 }}
                                                    @endif
                                                    </li>
                                                    <li class="td7">{{ $future->stock }}@if($future->unit==1)支@else吨@endif</li>
                                                </ul>
                                                @endforeach
                                                @endif
                                            </li>

                                            <li class="td8">
                                                <p class="black">￥{{$order->paid_amount or 0}}</p>
                                                <p class="f12">(含运费：￥{{$order->postsge or 0}})</p>
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
                            @endif
                            
                        </ul>
                    </div>
                </div>
                <!-- 信任的商家-->
                {{--<div class="xinRen">
                    <div class="tit clear">
                        <p class="L">信任的商家</p>
                        <a href="#" class="R">更多商家</a>
                    </div>
                    <ul class="list clear">
                        <li>
                            <p class="img" style="background-image: url(/assets/shop/img/hb_18.png)"></p>
                            <p class="name">华远兴业</p>
                            <p class="stars">
                                <span class="ok"></span>
                                <span class="ok"></span>
                                <span class="ok"></span>
                                <span class="ok"></span>
                                <span class="ok"></span>
                            </p>
                            <p class="zhuying f12">主营：线材</p>
                            <p class="history f12">历史交易：36890单</p>
                        </li>
                        <li>
                            <p class="img" style="background-image: url(/assets/shop/img/hb_18.png)"></p>
                            <p class="name">华远兴业</p>
                            <p class="stars">
                                <span class="ok"></span>
                                <span class="ok"></span>
                                <span class="ok"></span>
                                <span class="ok"></span>
                                <span class="ok"></span>
                            </p>
                            <p class="zhuying f12">主营：线材</p>
                            <p class="history f12">历史交易：36890单</p>
                        </li>
                        <li>
                            <p class="img" style="background-image: url(/assets/shop/img/hb_18.png)"></p>
                            <p class="name">华远兴业</p>
                            <p class="stars">
                                <span class="ok"></span>
                                <span class="ok"></span>
                                <span class="ok"></span>
                                <span class="ok"></span>
                                <span class="ok"></span>
                            </p>
                            <p class="zhuying f12">主营：线材</p>
                            <p class="history f12">历史交易：36890单</p>
                        </li>
                        <li>
                            <p class="img" style="background-image: url(/assets/shop/img/hb_18.png)"></p>
                            <p class="name">华远兴业</p>
                            <p class="stars">
                                <span class="ok"></span>
                                <span class="ok"></span>
                                <span class="ok"></span>
                                <span class="ok"></span>
                                <span class="ok"></span>
                            </p>
                            <p class="zhuying f12">主营：线材</p>
                            <p class="history f12">历史交易：36890单</p>
                        </li>
                        <li class="last">
                            <p class="img" style="background-image: url(/assets/shop/img/hb_18.png)"></p>
                            <p class="name">华远兴业</p>
                            <p class="stars">
                                <span class="ok"></span>
                                <span class="ok"></span>
                                <span class="ok"></span>
                                <span class="ok"></span>
                                <span class="ok"></span>
                            </p>
                            <p class="zhuying f12">主营：线材</p>
                            <p class="history f12">历史交易：36890单</p>
                        </li>
                    </ul>
                </div> --}}
                <!-- ad-->
                @include('_layouts.ads')
            </div>
        </div>
    </div>
    <script>
    	$(function(){
    		$(document).on("click", ".thead .contact", function() {
		        var tel=$(this).attr("data_tel");
		        $.alert("请拨打电话："+tel, "联系方式");
		    });
    	})

        $(".del").click(function(){

            var delete_id=$(".del").attr("data_tel");
             //alert(delete_id);
            $.ajax({
                type:"get",
                url:"{{ route('user.deleteFut')}}",
                data:{delete_id:delete_id},
                datatype: "json",//"xml", "html", "script", "json", "jsonp", "text".
                /*headers: {
                 'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                 },*/
                success:function(data){
                    console.log(data);
                    if(data=="1"){
                        alert("删除成功");
                        window.location.href=location.href;
                    }else{

                    }

                },
                error: function(){
                }
            });

        });

    </script>
@endsection

@section('footer')
    @include('_layouts.shop_footer2')
@endsection

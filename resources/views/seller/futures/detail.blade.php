@extends('_layouts.shop')

@section('main-content')
    <link rel="stylesheet" href="/assets/shop/css/person.css"/>
    <!-- content-->
    <div class="meCenIndex_con mid_div min_w marok spQihuoXundanDet">
    	<!--点击报价的弹出框-->
	    <div class="baojiaKuang" style="display: none;">
	    	<p><span class="tit">价格</span><input class="price" type="text" /><span class="danwei">元/吨</span></p>
	    	<p><span class="tit">交货天数</span><input class="dayNum1" type="text" /><span class="danwei">天</span></p>
	    	<p><span class="tit">有效天数</span><input class="dayNum2" type="text" /><span class="danwei">天</span></p>
	    	<button class="cancel">取消</button><button class="sure">确定</button>
	    </div>
	    <!--标题-->
        <div class="tit">
            <img src="/assets/shop/img/shangpu/sptit.jpg"/>
            <p class="line"></p>
        </div>
        <div class="content clear">
            @include('_layouts.seller_left')
            <div class="R">
                <!-- 个人信息-->
                <div class="personInfo spQihuoXundanDetInfo clear">
                    <!--<a href="#" class="set"><img src="../img/person/set.jpg"/></a>-->
                    <p class="headimg L" style="background-image: url({{$order->user->avatar_pic or '/assets/shop/img/shangpu/sp_03.png'}})"></p>
                    <ul class="L one">
                        <!-- 如果是认证过的，则类名是这两个renzheng ok    没通过的则类名为renzheng-->
                        <li class="first"><b class="name">{{$order->user->realname or ''}}</b>@if($order->user->gender==1)先生@else女士@endif<span class="renzheng ok"></span></li>
                        <li>信誉等级：
                            <p class="xinyu">
	                            @if($order->user->credit_degree>0)
	                        		@for($i=1;$i<=$order->user->credit_degree;$i++)
	                        		<span class="ok"></span>
	                        		@endfor
	                            @else
	                            	暂无等级
	                            @endif
                                <!-- <span class="ok"></span>
                                <span class="ok"></span>
                                <span class="ok"></span>
                                <span class="ok"></span>
                                <span class="ok"></span> -->
                            </p>
                        </li>
                        <li>收货地址：{{$order->user->consignee or '暂未填写'}}</li>
                        <li>我的公司：{{$order->user->compony or '暂未填写'}}</li>
                    </ul>
                    <ul class="L two">
                        <li class="fabu">
                            发布订单数：{{$futureNum or ''}}
                        </li>
                        <li class="huoyue">活跃地区：{{$order->user->seller->business_area or '暂无'}}</li>
                    </ul>
                </div>
                <div class="seePaiming">
                    <!-- <a href="#">查看排名</a> -->
                </div>
                <!-- table-->
                <div class="table">
                    <ul class="thead">
                        <li class="td1">城市</li>
                        <li class="td2">品种</li>
                        <li class="td3">标准</li>
                        <li class="td4">材质</li>
                        <li class="td5">钢厂</li>
                        <li class="td6">
                            <p>规格</p>
                            <p>（mm*mm*mm）</p>
                        </li>
                        <li class="td7">
                            <p>允差</p>
                            <p>（±%）</p>
                        </li>
                        <!-- <li class="td8">
                            <p>吨数</p>
                            <p>（t）</p>
                        </li> -->
                        <li class="td9">数量</li>
                        <li class="td10">交货日期</li>
                        <li class="td11">报价</li>
                    </ul>
                    <div class="tbody">
                    	@foreach($order->futures as $future)
                        <ul class="tr">
                            <li class="td1">{{$future->area or '全部'}}</li>
                            <li class="td2">{{$future->variety or '全部'}}</li>
                            <li class="td3">{{$future->standard or '全部'}}</li>
                            <li class="td4">{{$future->material or '全部'}}</li>
                            <li class="td5">{{$future->steelmill or '全部'}}</li>
                            <li class="td6">@if($future->length_type==1){{ $future->outer_diameter }}*{{ $future->thickness }}*{{ $future->length*100 }}~{{ $future->outer_diameter }}*{{ $future->thickness }}*{{ $future->max_length*100 }}@else{{ $future->outer_diameter }}*{{ $future->thickness }}*{{ $future->length*100 }}@endif</li>
                            <li class="td7">{{$future->deviation}}</li>
                            <!-- <li class="td8">69</li> -->
                            <li class="td9">{{$future->stock}} {{$future->unit}}</li>
                            <li class="td10"><?php echo substr($future->delivery_date,0,10); ?></li>
                            <li class="td11"><a href="javascript:;" class="btnBlue4" data_id="{{$future->id}}">报价</a></li>
                        </ul>
                        @endforeach
                        <!-- <ul class="tr oushu">
                            <li class="td1">天津</li>
                            <li class="td2">无缝管</li>
                            <li class="td3">APL 5L</li>
                            <li class="td4">#20</li>
                            <li class="td5">鞍钢</li>
                            <li class="td6">219*9.8*12000</li>
                            <li class="td7">5</li>
                            <li class="td8">69</li>
                            <li class="td9">125</li>
                            <li class="td10">2016年9月5日</li>
                            <li class="td11"><a href="javascript:;" class="btnBlue4">报价</a></li>
                        </ul> -->
                    </div>
                </div>
                <!-- 详细说明 补充说明-->
                <div class="detailBuchong clear">
                    <div class="L one"><p class="tit">详细说明：</p></div>
                    <!-- <div class="L two" style="width:500px">
                    	<div style="padding: 10px 15px; border: 1px solid #cccccc; width: 450px;">
                    		<textarea readonly style="width:100%; height:140px">{{ $order->detail }}</textarea>
                    	</div>
                    </div> -->
                    <ul class="L two">
                    	{{ $order->detail }}
                        <!-- <li>含税过磅到防腐厂价，每支钢管坡口30°-35 °，管端均带上金属管帽；</li>
                        <li>1）外径：按照标准要求；</li>
                        <li>2) 壁厚：+0mm/-0.1mm；</li>
                        <li>3) 长度：+0/-20mm；</li> -->
                    </ul>
                    <ul class="L three">
                        <li><span class="tit">联系人：</span>{{ $order->linkman }}</li>
                        <li><span class="tit">联系方式：</span>{{ $order->mobile }}</li>
                        <li><span class="tit">邮编：</span>{{ $order->zip_code }}</li>
                        <li><span class="tit">收货地址：</span>{{ $order->address }}</li>
                    </ul>
                    <input type="hidden" id="order_id" value="{{$order->id}}" />
                </div>
                <!-- <form class="form">
                  <div class="buchong">
                	<span class="tit">补充说明：</span>
                    <input type="text" value="请在此填写补充说明内容">
                  </div>
                  <input type="submit" class="tijiao" value="提交表单" />
                </form> -->
                <!-- ad-->
                @include('_layouts.ads')
            </div>
        </div>
    </div>
    <script type="text/javascript">
        //table隔行变色
        $('.spQihuoXundanDet .tbody .tr:nth-child(2n)').addClass('oushu');
        
        //点击报价
        $('.spQihuoXundanDet .tbody').on('click','.btnBlue4',function(e){
        	var y=e.pageY-134;//减去顶部的距离
        	$('.spQihuoXundanDet .baojiaKuang').css('top',y+'px');
        	$('.spQihuoXundanDet .baojiaKuang input').val('');//清空input旧值
        	$('.baojiaKuang').show();
        	$('.spQihuoXundanDet .baojiaKuang button.sure').attr("data_id",$(this).attr("data_id"));
        });
        
        //报价框 点击取消
        $('.spQihuoXundanDet .baojiaKuang button.cancel').on('click',function(){
        	$('.baojiaKuang').hide();
        });
        //报价框 点击确定
        $('.spQihuoXundanDet .baojiaKuang button.sure').on('click',function(){
        	$('.baojiaKuang').hide();
        	var id = $(this).attr("data_id");
        	var price=$('.spQihuoXundanDet input.price').val();
        	var dayNum1=$('.spQihuoXundanDet input.dayNum1').val();
        	var dayNum2=$('.spQihuoXundanDet input.dayNum2').val();
        	var orderid =$('#order_id').val();
        	var data = {price:price,daynum1:dayNum1,daynum2:dayNum2,future_id:id,order_id:orderid,_token:"{{ csrf_token() }}"};
			$.ajax({
				type:"POST",
				url:"{{route('shop.futures.addOffer')}}",
				data:data,
				datatype: "json",//"xml", "html", "script", "json", "jsonp", "text".
				
				success:function(json){
					//console.log(json);
					//write_alert(json.info);
					alert(json.info);
				},
				error: function(){
				}
			});
        });
        
        //点击提交表单
        $('.spQihuoXundanDet .form .tijiao').on('click',function(){
        	var inputv=$('.spQihuoXundanDet .buchong input').val();
        	//console.log(inputv);
        });
        
        //补充说明 input
        $('.spQihuoXundanDet .buchong input').on('focus',function(){
        	if(this.value=='请在此填写补充说明内容'){
        		$(this).val('');
        	}
        });
        $('.spQihuoXundanDet .buchong input').on('blur',function(){
        	if(this.value==''){
        		$(this).val('请在此填写补充说明内容');
        	}
        });
    </script>
    <!-- footer-->
    @endsection

@section('footer')
    @include('_layouts.shop_footer2')
@endsection

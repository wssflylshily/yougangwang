@extends('_layouts.shop')
	<!-- <meta name="_token" content="{{ csrf_token() }}"/> --> 

@php($active = 'futures')

@section('main-content')
    <link rel="stylesheet" href="/assets/shop/css/person.css"/>
    <style>
    	.spQihuoXundanDet > .content > .R .spQihuoXundanDetInfo .one{ width: 680px;}
    	.spQihuoXundanDet .table .td1{ width: 98px;}
    	.spQihuoXundanDet .table .td2{ width: 98px;}
    	.spQihuoXundanDet .table .td3{ width: 98px;}
    	.spQihuoXundanDet .table .td4{ width: 98px;}
    	.spQihuoXundanDet .table .td5{ width: 155px;}
    	.spQihuoXundanDet .table .td6{ width: 200px;}
    	.spQihuoXundanDet .table .td7{ width: 98px;}
    	.spQihuoXundanDet .table .td8{ width: 98px;}
    	.spQihuoXundanDet .table .td9{ width: 98px;}
    	.spQihuoXundanDet .table .td10{ width: 138px;}
    	.spQihuoXundanDet .table .td11{ width: 118px;}
    </style>
    <script src="/assets/shop/js/laydate/laydate.js"></script>
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
        <div class="content clear" style="margin: 0px;">
            <div class="R" style="width: 100%; float: none;">
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
                            </p>
                        </li>
                        <li>收货地址：{{$order->user->consignee or '暂未填写'}}</li>
                        <li>我的公司：{{$order->user->compony or '暂未填写'}}</li>
                    </ul>
                    <ul class="L two">
                        <li class="fabu">
                            发布订单数：{{$futureNum}}
                        </li>
                        <li class="huoyue" style="display:none;">活跃地区：{{$order->user->seller->business_area or '暂无'}}</li>
                    </ul>
                </div>
                <div class="seePaiming">
                    <a href="#" style="display:none;">查看排名</a>
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
                        <li class="td8">
                            <p>吨数</p>
                            <p>（t）</p>
                        </li>
                        <!-- <li class="td9">支数</li> -->
                        <li class="td10">交货日期</li>
                        <li class="td11">报价</li>
                    </ul>
                    <div class="tbody">
                    	@foreach ($order->futures as $item)
                        <ul class="tr">
                            <li class="td1">{{ $item->area or '全部' }}</li>
                            <li class="td2">{{ $item->variety or '全部' }}</li>
                            <li class="td3">{{ $item->standard or '全部' }}</li>
                            <li class="td4">{{ $item->material or '全部' }}</li>
                            <li class="td5">{{ $item->steelmill or '全部' }}</li>
                            <li class="td6">@if($item->length_type==1){{ $item->outer_diameter }}*{{ $item->thickness }}*{{ $item->length*100 }}~{{ $item->outer_diameter }}*{{ $item->thickness }}*{{ $item->max_length*100 }}@else{{ $item->outer_diameter }}*{{ $item->thickness }}*{{ $item->length*100 }}@endif</li>
                            <li class="td7">{{ $item->deviation or ''}}</li>
                            <li class="td8">{{ $item->stock or ''}} {{$item->unit or ''}}</li>
                            <!-- <li class="td9">125</li> -->
                            <li class="td10"><?php echo substr($item->delivery_date,0,10); ?></li>
                            <li class="td11"><a href="javascript:;" class="btnBlue4" data_id="{{ $item->id or ''}}">报价</a></li>
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
                            <li class="td11"><a href="javascript:;" class="btnBlue4">报价</a></li> -->
                            <!--<li class="td11">3020 15天</li>-->
                        </ul>
                    </div>
                </div>
                <!-- 详细说明 补充说明-->
                <div class="detailBuchong clear" style="margin-bottom: 20px;">
                    <div class="L one"><p class="tit">详细说明：</p></div>
                    <div class="L two" style="width:500px">
                    	<div style="padding: 10px 15px; border: 1px solid #cccccc; width: 450px;">
                    		<textarea readonly style="width:100%; height:140px">{{ $order->detail or ''}}</textarea>
                    	</div>
                    </div>
                    <!-- <ul class="L two">
                        <li>含税过磅到防腐厂价，每支钢管坡口30°-35 °，管端均带上金属管帽；</li>
                        <li>1）外径：按照标准要求；</li>
                        <li>2) 壁厚：+0mm/-0.1mm；</li>
                        <li>3) 长度：+0/-20mm；</li>
                    </ul> -->
                    <ul class="L three">
                        <li><span class="tit">联系人：</span>{{ $order->linkman or ''}}</li>
                        <li><span class="tit">联系方式：</span>{{ $order->mobile or ''}}</li>
                        <li><span class="tit">邮编：</span>{{ $order->zip_code or ''}}</li>
                        <li><span class="tit">收货地址：</span>{{ $order->address or ''}}</li>
                    </ul>
                    <input type="hidden" id="order_id" value="{{$order->id or ''}}" />
                </div>
                <!--<form class="form">
                  <div class="buchong" style="text-align: left; margin-bottom: 25px;">
                	<span class="tit">补充说明：</span>
                    <input type="text" value="补充内容" >
                  </div>
                  <input type="submit" class="tijiao" value="提交表单" />
                </form>-->
            </div>
        </div>
    </div>
    <script>
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
        	var id = $(this).attr("data_id");
        	$('.baojiaKuang').hide();
        	var price=$('.spQihuoXundanDet input.price').val();
        	var dayNum1=$('.spQihuoXundanDet input.dayNum1').val();
        	var dayNum2=$('.spQihuoXundanDet input.dayNum2').val();
        	var orderid =$('#order_id').val();
        	var data = {price:price,daynum1:dayNum1,daynum2:dayNum2,future_id:id,order_id:orderid,_token:"{{ csrf_token() }}"};
        
        	//console.log(data);
        	//return;
			$.ajax({
				type:"POST",
				url:"/futures/addOffer",
				data:data,
				datatype: "json",//"xml", "html", "script", "json", "jsonp", "text".
				
				success:function(json){
					console.log(json);
					//write_alert(json.info);
					alert(json.info);
				},
				error: function(){
				}
			});
        	//console.log(price,dayNum1,dayNum2);
        });
        
        //点击提交表单
        $('.spQihuoXundanDet .form .tijiao').on('click',function(){
        	var inputv=$('.spQihuoXundanDet .buchong input').val();
        	//console.log(inputv);
        });
        
        //补充说明 input
        /*$('.spQihuoXundanDet .buchong input').on('focus',function(){
        	if(this.value=='请在此填写补充说明内容'){
        		$(this).val('');
        	}
        });
        $('.spQihuoXundanDet .buchong input').on('blur',function(){
        	if(this.value==''){
        		$(this).val('请在此填写补充说明内容');
        	}
        });*/
    </script>
	@endsection
	
	@section('footer')		
		<!--footer-->
		@include('_layouts.shop_footer1')
	@endsection
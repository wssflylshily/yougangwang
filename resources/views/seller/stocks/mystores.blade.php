@extends('_layouts.shop')
@section('main-content')
    <!-- content-->
    <div class="meCenIndex_con mid_div marok spmecangku">
	    <!--标题-->
        <div class="tit">
            <img src="/assets/shop/img/shangpu/sptit.jpg"/>
            <p class="line"></p>
        </div>
        <div class="content clear">
         	@include('_layouts.seller_left')
            <div class="R">
                <!-- 个人信息-->
                <div class="personInfo spmeCangku clear">
                    <p class="headimg L" style="background-image: url({{$seller->logo_pic or '/assets/shop/img/shangpu/cangku_03.png'}})"></p>
                    <ul class="L right">
                    	<li class="tit">
                    		<span class="icon"></span>
                    		<span class="name">{{$seller->name}}</span>
                    		<!--如果是已关注商家，则类名添加一个 yi-->
                    		<!--<span class="guanzhu">关注商家</span>
                    		<span class="yiguanzhu">已关注</span>-->
                    		<span class="R">累计销量：<b>{{ $seller->sale_count or 0 }}</b>吨</span>
                    	</li>
                    	<li class="xinyong">
                    		信用等级：
                    		<p class="xinyu">
                    			@for($i=0;$i<$seller->credit_degree;$i++)
                                <span class="ok"></span>
                                @endfor
                            </p>
                    	</li>
                    	<li class="word">
                    		{{$seller->summary}}
                    	</li>
                    </ul>
                </div>
                <!--服务区块-->
                <!-- <div class="fuwu">
                	<p class="tit">山东鲁业真诚为您服务</p>
                	<p class="con">
                		<span><b></b>我们有最全的货源</span>
                		<span><b></b>我们有最优惠价格</span>
                		<span><b></b>我们保证正品</span>
                	</p>
                	<div class="table">
						<ul class="thead">
							<li class="td1">机组</li>
							<li class="td2">组距（mm）</li>
							<li class="td3">可生产钢种</li>
							<li class="td4">年产量</li>
							<li class="td5">备注</li>
						</ul> 
						<div class="tbody">
							<ul class="tr">
								<li class="td1">180机组（Assel连轧机组，可在线正火）</li>
								<li class="td2">60-180</li>
								<li class="td3">J55/N80-1/
20#/GRB-X60</li>
								<li class="td4">48万吨</li>
								<li class="td5">各规格可生产壁厚明细</li>
							</ul>
							<ul class="tr">
								<li class="td1">273机组（AQ斜轧机组）</li>
								<li class="td2">60-180</li>
								<li class="td3">J55/N80-1/
20#/GRB-X60</li>
								<li class="td4">48万吨</li>
								<li class="td5">各规格可生产壁厚明细</li>
							</ul>
						</div>
                	</div>
                </div> -->
                
                <!--无缝管-->
				@for($i=0;$i<count($groups);$i++)
					<div class="guan">
						<ul class="tit clear">
							<li class="L">{{ $groups[$i]->variety }}</li>
							<li class="R"><a href="{{ route('seller.stocks.all', ['variety' => $groups[$i]->variety]) }}">查看仓库</a></li>
						</ul>
						<div class="table">
							<ul class="thead">
								<li class="td1">特卖产品</li>
								<li class="td2">地区</li>
								<li class="td3">品种</li>
								<li class="td4">材质</li>
								<li class="td5">规格</li>
								<li class="td6">钢厂</li>
								<li class="td7">吨数</li>
								<li class="td8">单价</li>
								<li class="td9">操作</li>
							</ul>
							<div class="tbody">
								@foreach($goods[$i] as $good)
									<ul class="tr">
										<li class="td1">@if($good->type==9)<span class="temai"></span>@endif</li>
										<li class="td2">{{ $good->areaName or '-' }}</li>
										<li class="td3">{{ $good->variety or '-' }}</li>
										<li class="td4">{{ $good->material or '-' }}</li>
										<li class="td5">{{ $good->length }}*{{ $good->thickness }}*{{ $good->outer_diameter }}</li>
										<li class="td6">{{ $good->seller->name or '未知' }}</li>
										<li class="td7">{{ $good->stock or '-' }}</li>
										<li class="td8"><b>{{ $good->price or '-' }}</b> 元/吨</li>
										<li class="td9"></li>
									</ul>
								@endforeach
							</div>
						</div>
					</div>
				@endfor
                
                <!-- ad-->
				@include('_layouts.ads')
            </div>
        </div>
    </div>
    <!-- footer-->
	<script>
        $("#stores").addClass("on");
	</script>
  @endsection
    <!-- footer-->
    @section('footer')      
        <!--footer-->
        @include('_layouts.shop_footer1')
    @endsection
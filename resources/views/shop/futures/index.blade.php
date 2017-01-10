@extends('_layouts.shop')

@php($active = 'futures')

@section('main-content')
    <link rel="stylesheet" href="/assets/shop/css/style.css" />
    <link rel="stylesheet" href="/assets/shop/css/person.css"/>
    <style>
    	.meCenIndex_con > .content > .R .dongtai .search p select{ width: 145px;}
    	.meCenIndex_con > .content > .R .dongtai .search p input.time{ width: 145px;}
    	.meCenIndex_con > .content > .R .dongtai .table .td1{ width: 110px;}
    	.meCenIndex_con > .content > .R .dongtai .table .td2{ width: 150px;}
    	.meCenIndex_con > .content > .R .dongtai .table .td3{ width: 170px;}
    	.meCenIndex_con > .content > .R .dongtai .table .td4{ width: 200px;}
    	.meCenIndex_con > .content > .R .dongtai .table .td5{ width: 120px;}
    	.meCenIndex_con > .content > .R .dongtai .table .td6{ width: 110px;}
    	.meCenIndex_con > .content > .R .dongtai .table .td7{ width: 130px;}
    	.meCenIndex_con > .content > .R .dongtai .table .td8{ width: 200px;}
    </style>
    <script src="/assets/shop/js/laydate/laydate.js"></script>
    <!-- content-->
    <div class="meCenIndex_con mid_div min_w marok spQihuoXundanDet">
        <div class="content clear" style="margin-top: 0px; margin-left: 0px;">
            <div class="R" style="width: 100%; float: none;">
                <div class="dongtai">
                	<form action="/futures" method="get">
                    <div class="search">
                        <p>地区
                            <select name="area" class="diqu">
                                <option value="">全部</option>
                                @foreach($areas as $area)
                                <option value="{{$area->areaId}}">{{$area->areaName}}</option>
                                @endforeach
                            </select>
                        </p>
                        <p>品种
                            <select name="variety" class="type">
                             	<option value="">全部</option>
                            @foreach ( config('const.goods_variety') as $variety)
                                <option>{{$variety}}</option>
                            @endforeach
                            </select>
                        </p>
                        <p>标准
                            <select name="standard" class="standard">
                                <option value="">全部</option>
                                @foreach ( config('const.goods_standard') as $standard)
									<option>{{ $standard }}</option>
								@endforeach
                            </select>
                        </p>
                        <p>日期
                            <input id="start" name="starttime" onclick="laydate()" class="time laydate-icon" value="" placeholder="请选择日期">
                            —
                            <input id="end" name="endtime" onclick="laydate()" class="time laydate-icon" value="" placeholder="请选择日期">
                        </p>
                        <p>
                        	<button type="submit" class="sou">搜索</button>
                            <!-- <a href="javascript:;" class="sou">搜索</a> -->
                        </p>
                    </div>
                    </form>
                    <div class="table">
                        <ul class="thead">
                            <li class="td1">城市</li>
                            <li class="td2">品种</li>
                            <li class="td3">标准</li>
                            <li class="td4">规格</li>
                            <li class="td5">钢厂</li>
                            <li class="td6">吨数</li>
                            <li class="td7">交货日期</li>
                            <li class="td8">更新日期</li>
                        </ul>
                        <div class="tbody">
                        	@foreach ($list as $item)
                            <ul class="tr">
                                <li class="td1">{{ $item->area_id }}</li>
                                <li class="td2">{{ $item->variety }}</li>
                                <li class="td3">{{ $item->standard }}</li>
                                <li class="td4">@if($item->length_type==1){{ $item->outer_diameter}}*{{$item->thickness}}*{{$item->length*100 }}~{{ $item->outer_diameter}}*{{$item->thickness}}*{{$item->max_length*100 }}@else{{ $item->outer_diameter}}*{{$item->thickness}}*{{$item->length*100 }}@endif</li>
                                <li class="td5">{{ $item->steelmill }}</li>
                                <li class="td6">{{ $item->stock }}{{ $item->unit }}</li>
                                <li class="td7"><?php echo substr($item->delivery_date,0,10); ?>{{-- $item->delivery_date --}}</li>
                                <li class="td8"><?php echo substr($item->updated_at,0,10); ?>{{-- $item->updated_at --}}
                                    <a href="/futures/detail/{{$item->order_id}}" class="detail">详情</a>
                                </li>
                            </ul>
                            @endforeach
                            <!-- <ul class="tr">
                                <li class="td1">天津</li>
                                <li class="td2">无缝管</li>
                                <li class="td3">API 5L</li>
                                <li class="td4">141*69*12-12.3</li>
                                <li class="td5">鞍钢</li>
                                <li class="td6">200吨</li>
                                <li class="td7">2016-5-3</li>
                                <li class="td8">2016-4-3
                                    <a href="/futures/detail" class="detail">详情</a>
                                </li>
                            </ul> -->
                        </div>
                    </div>
                </div>
                <!-- 分页-->
                <div class="fenyeArea clear">
                    {!! $list->appends(Request::query())->render() !!}
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        //最新动态 select 改变的时候
        $('.meCenIndex_con > .content > .R .zuiXin .top select').on('change',function(){
            var selected=$(this).val();
            console.log(selected);
        });

        var time1,time2;
        laydate({
            //哪个元素上提供日期选择功能 这必须写id选择器
            elem: '#start',
            //获得焦点时显示日期选择器
            event: 'focus',
            choose:function(data){
                console.log(data);
                time1=data;
            }
        });
        laydate({
            //哪个元素上提供日期选择功能 这必须写id选择器
            elem: '#end',
            //获得焦点时显示日期选择器
            event: 'focus',
            choose:function(data){
                console.log(data);
                time2=data;
            }
        });

        //点击 搜索
        $('.meCenIndex_con > .content > .R .dongtai .search p .sou').on('click',function(){
            //地区 品种 标准 .diqu .type .standard
            var diqu=$('.meCenIndex_con > .content > .R .dongtai .search .diqu').val();
            var type=$('.meCenIndex_con > .content > .R .dongtai .search .type').val();
            var standard=$('.meCenIndex_con > .content > .R .dongtai .search .standard').val();

            console.log(diqu,type,standard,time1,time2)
        });
    </script>
    <!--footer-->
	@endsection
	
	@section('footer')		
		<!--footer-->
		@include('_layouts.shop_footer1')
	@endsection

@extends('_layouts.shop')

@section('main-content')
    <link rel="stylesheet" href="/assets/shop/css/person.css"/>
    <script src="/assets/shop/js/laydate/laydate.js"></script>

    <!-- content-->
    <div class="meCenIndex_con mid_div min_w marok spQihuoXundanDet">
    	
	    <!--标题-->
        <div class="tit">
            <img src="/assets/shop/img/shangpu/sptit.jpg"/>
            <p class="line"></p>
        </div>
        <div class="content clear">
            @include('_layouts.seller_left')
            <div class="R">
                <!-- 最新动态-->
                <!-- <div class="titTab">
                    <span>最新动态</span>
                </div>
                <div class="zuiXin">
                    <div class="top">
                        <ul>
                            <li>无缝管</li>
                            <li>铺管</li>
                            <li class="last">螺纹管</li>
                        </ul>
                        <select name="">
                            <option value="">全部</option>
                            @foreach ( config('const.goods_variety') as $variety)
                            <option>{{$variety}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="table">
                        <ul class="tr">
                            <li class="td1">11:50</li>
                            <li class="td2">上海北宁</li>
                            <li class="td3">无缝管</li>
                            <li class="td4">#20</li>
                            <li class="td5">219*89*12.3-12.5</li>
                            <li class="td6">50吨</li>
                            <li class="td7">交货日期10月05日</li>
                            <li class="td8">张先生</li>
                        </ul>
                        <ul class="tr">
                            <li class="td1">11:50</li>
                            <li class="td2">上海北宁</li>
                            <li class="td3">无缝管</li>
                            <li class="td4">#20</li>
                            <li class="td5">219*89*12.3-12.5</li>
                            <li class="td6">50吨</li>
                            <li class="td7">交货日期10月05日</li>
                            <li class="td8">张先生</li>
                        </ul>
                        <ul class="tr">
                            <li class="td1">11:50</li>
                            <li class="td2">上海北宁</li>
                            <li class="td3">无缝管</li>
                            <li class="td4">#20</li>
                            <li class="td5">219*89*12.3-12.5</li>
                            <li class="td6">50吨</li>
                            <li class="td7">交货日期10月05日</li>
                            <li class="td8">张先生</li>
                        </ul>
                        <ul class="tr">
                            <li class="td1">11:50</li>
                            <li class="td2">上海北宁</li>
                            <li class="td3">无缝管</li>
                            <li class="td4">#20</li>
                            <li class="td5">219*89*12.3-12.5</li>
                            <li class="td6">50吨</li>
                            <li class="td7">交货日期10月05日</li>
                            <li class="td8">张先生</li>
                        </ul>
                        <ul class="tr">
                            <li class="td1">11:50</li>
                            <li class="td2">上海北宁</li>
                            <li class="td3">无缝管</li>
                            <li class="td4">#20</li>
                            <li class="td5">219*89*12.3-12.5</li>
                            <li class="td6">50吨</li>
                            <li class="td7">交货日期10月05日</li>
                            <li class="td8">张先生</li>
                        </ul>
                    </div>
                </div>
                -->
                <!-- 动态查询-->
                <div class="titTab">
                    <span>动态查询</span>
                </div>
                <div class="dongtai">
                    <div class="search">
                    	<form action="{{route('seller.futuresList')}}" method="get">
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
                                @foreach(config('const.goods_variety') as $variety)
                                <option>{{ $variety }}</option>
                                @endforeach
                            </select>
                        </p>
                        <p>标准
                            <select name="standard" class="standard">
                                <option value="">全部</option>
                                @foreach(config('const.goods_standard') as $standard)
                                <option>{{$standard}}</option>
                                @endforeach
                            </select>
                        </p>
                        <p>日期
                            <input id="start" name="start" onclick="laydate()" class="time laydate-icon" value="{{Request::input('start')}}" placeholder="请选择日期">
                            —
                            <input id="end" name="end" onclick="laydate()" class="time laydate-icon" value="{{Request::input('end')}}" placeholder="请选择日期">
                        </p>
                        <p>
                        	<button class="sou" type="submit">搜索</button>
<!--                             <a href="javascript:;" class="sou">搜索</a> -->
                        </p>
                        </form>
                    </div>
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
                        	@foreach($futures as $future)
                            <ul class="tr">
                                <li class="td1">{{ $future->area_id }}</li>
                                <li class="td2">{{ $future->variety }}</li>
                                <li class="td3">{{ $future->standard }}</li>
                                <li class="td4">{{ $future->outer_diameter*$future->thickness*$future->length }}</li>
                                <li class="td5">{{ $future->steelmill }}</li>
                                <li class="td6">{{ $future->stock }}</li>
                                <li class="td7"><?php echo substr($future->created_at, 0,10); ?></li>
                                <li class="td8"><?php echo substr($future->updated_at,0,10); ?>
                                    <a href="{{route('seller.futures.detail',['order_id'=>$future->order_id])}}" class="detail">详情</a>
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
                                    <a href="SPqihuoXundanDetail.html" class="detail">详情</a>
                                </li>
                            </ul>
                            <ul class="tr">
                                <li class="td1">天津</li>
                                <li class="td2">无缝管</li>
                                <li class="td3">API 5L</li>
                                <li class="td4">141*69*12-12.3</li>
                                <li class="td5">鞍钢</li>
                                <li class="td6">200吨</li>
                                <li class="td7">2016-5-3</li>
                                <li class="td8">2016-4-3
                                    <a href="SPqihuoXundanDetail.html" class="detail">详情</a>
                                </li>
                            </ul>
                            <ul class="tr">
                                <li class="td1">天津</li>
                                <li class="td2">无缝管</li>
                                <li class="td3">API 5L</li>
                                <li class="td4">141*69*12-12.3</li>
                                <li class="td5">鞍钢</li>
                                <li class="td6">200吨</li>
                                <li class="td7">2016-5-3</li>
                                <li class="td8">2016-4-3
                                    <a href="SPqihuoXundanDetail.html" class="detail">详情</a>
                                </li>
                            </ul>
                            <ul class="tr">
                                <li class="td1">天津</li>
                                <li class="td2">无缝管</li>
                                <li class="td3">API 5L</li>
                                <li class="td4">141*69*12-12.3</li>
                                <li class="td5">鞍钢</li>
                                <li class="td6">200吨</li>
                                <li class="td7">2016-5-3</li>
                                <li class="td8">2016-4-3
                                    <a href="SPqihuoXundanDetail.html" class="detail">详情</a>
                                </li>
                            </ul>
                            <ul class="tr">
                                <li class="td1">天津</li>
                                <li class="td2">无缝管</li>
                                <li class="td3">API 5L</li>
                                <li class="td4">141*69*12-12.3</li>
                                <li class="td5">鞍钢</li>
                                <li class="td6">200吨</li>
                                <li class="td7">2016-5-3</li>
                                <li class="td8">2016-4-3
                                    <a href="SPqihuoXundanDetail.html" class="detail">详情</a>
                                </li>
                            </ul>
                            <ul class="tr">
                                <li class="td1">天津</li>
                                <li class="td2">无缝管</li>
                                <li class="td3">API 5L</li>
                                <li class="td4">141*69*12-12.3</li>
                                <li class="td5">鞍钢</li>
                                <li class="td6">200吨</li>
                                <li class="td7">2016-5-3</li>
                                <li class="td8">2016-4-3
                                    <a href="SPqihuoXundanDetail.html" class="detail">详情</a>
                                </li>
                            </ul>
                            <ul class="tr">
                                <li class="td1">天津</li>
                                <li class="td2">无缝管</li>
                                <li class="td3">API 5L</li>
                                <li class="td4">141*69*12-12.3</li>
                                <li class="td5">鞍钢</li>
                                <li class="td6">200吨</li>
                                <li class="td7">2016-5-3</li>
                                <li class="td8">2016-4-3
                                    <a href="SPqihuoXundanDetail.html" class="detail">详情</a>
                                </li>
                            </ul>
                            <ul class="tr">
                                <li class="td1">天津</li>
                                <li class="td2">无缝管</li>
                                <li class="td3">API 5L</li>
                                <li class="td4">141*69*12-12.3</li>
                                <li class="td5">鞍钢</li>
                                <li class="td6">200吨</li>
                                <li class="td7">2016-5-3</li>
                                <li class="td8">2016-4-3
                                    <a href="SPqihuoXundanDetail.html" class="detail">详情</a>
                                </li>
                            </ul>
                            <ul class="tr">
                                <li class="td1">天津</li>
                                <li class="td2">无缝管</li>
                                <li class="td3">API 5L</li>
                                <li class="td4">141*69*12-12.3</li>
                                <li class="td5">鞍钢</li>
                                <li class="td6">200吨</li>
                                <li class="td7">2016-5-3</li>
                                <li class="td8">2016-4-3
                                    <a href="SPqihuoXundanDetail.html" class="detail">详情</a>
                                </li>
                            </ul> -->
                        </div>
                    </div>
                </div>
                <!-- 分页-->
                <div class="fenyeArea clear">
                    {!! $futures->render() !!}
                    <!-- <ul class="fenye clear R">
                        <li class="on"><a href="#">1</a></li>
                        <li><a href="#">2</a></li>
                        <li><a href="#">3</a></li>
                        <li><a href="#">8</a></li>
                        <li><a href="#">9</a></li>
                        <li class="last"><a href="#">10</a></li>
                    </ul> -->
                </div>
                <!-- 广告-->
                <ul class="ads clear">
                    <li><img src="/assets/shop/img/person/ad.jpg"/></li>
                    <li><img src="/assets/shop/img/person/ad.jpg"/></li>
                    <li class="last"><img src="/assets/shop/img/person/ad.jpg"/></li>
                </ul>
            </div>
        </div>
    </div>
    <!-- footer-->
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
        /*$('.meCenIndex_con > .content > .R .dongtai .search p .sou').on('click',function(){
            //地区 品种 标准 .diqu .type .standard
            var diqu=$('.meCenIndex_con > .content > .R .dongtai .search .diqu').val();
            var type=$('.meCenIndex_con > .content > .R .dongtai .search .type').val();
            var standard=$('.meCenIndex_con > .content > .R .dongtai .search .standard').val();

            console.log(diqu,type,standard,time1,time2)
        });*/
    </script>
@endsection

@section('footer')
    @include('_layouts.shop_footer1')
@endsection

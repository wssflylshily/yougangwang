@extends('_layouts.shop')

@php($active = 'futures')

@section('main-content')
    <link rel="stylesheet" href="/assets/shop/css/style.css" />
    <link rel="stylesheet" href="/assets/shop/css/person.css"/>
    <style>
    	.meCenIndex_con > .content > .R .dongtai .search p select{ width: 145px;}
    	.meCenIndex_con > .content > .R .dongtai .search p input.time{ width: 145px;}
    	/*.meCenIndex_con > .content > .R .dongtai .table .td1{ width: 110px;}
    	.meCenIndex_con > .content > .R .dongtai .table .td2{ width: 150px;}
    	.meCenIndex_con > .content > .R .dongtai .table .td3{ width: 170px;}
    	.meCenIndex_con > .content > .R .dongtai .table .td4{ width: 200px;}
    	.meCenIndex_con > .content > .R .dongtai .table .td5{ width: 120px;}
    	.meCenIndex_con > .content > .R .dongtai .table .td6{ width: 110px;}
    	.meCenIndex_con > .content > .R .dongtai .table .td7{ width: 130px;}
    	.meCenIndex_con > .content > .R .dongtai .table .td8{ width: 200px;}*/
		.meCenIndex_con > .content > .R .dongtai .table .td1{ width: 110px;}
    	.meCenIndex_con > .content > .R .dongtai .table .td2{ width: 120px;}
    	.meCenIndex_con > .content > .R .dongtai .table .td3{ width: 140px;}
    	.meCenIndex_con > .content > .R .dongtai .table .td4{ width: 120px;}
    	.meCenIndex_con > .content > .R .dongtai .table .td5{ width: 80px;}
    	.meCenIndex_con > .content > .R .dongtai .table .td6{ width: 80px;}
    	.meCenIndex_con > .content > .R .dongtai .table .td7{ width: 130px;}
    	.meCenIndex_con > .content > .R .dongtai .table .td8{ width: 110px;}
    	.meCenIndex_con > .content > .R .dongtai .table .td9{ width: 130px;}
    	.meCenIndex_con > .content > .R .dongtai .table .td10{ width: 200px;}
    </style>
    <script src="/assets/shop/js/laydate/laydate.js"></script>
    <!-- content-->
    <div class="meCenIndex_con mid_div min_w marok spQihuoXundanDet">
        <div class="content clear" style="margin-top: 0px; margin-left: 0px;">
            <div class="R" style="width: 100%; float: none;">
                <div class="dongtai mid_div exchange com_div">
                	<form action="/futures" method="get">
                	<div class="select_div">
				<div>
					<select name="area">
						<option value="0">选择地区</option>
						@foreach($areas as $province)
							<option @if($province->areaId == Request::input('area')) selected @endif value="{{ $province->areaId }}">{{ $province->areaName }}</option>
						@endforeach
					</select>
				</div>
				<div class="div1">-</div>
				<div>
					<select name="city">
						@if(Request::input('city') && isset($cities))
							@foreach($cities as $city)
								<option @if(Request::input('city') == $city->areaId) selected @endif value="{{ $city->areaId }}">{{ $city->areaName }}</option>
							@endforeach
						@else
						<option value="0">选择城市</option>
						@endif
					</select>
				</div>
				<div>
					<select class="w1" name="variety">
						<option value="0">选择品种</option>
						@foreach ( $varieties as $variety)
							<option @if (Request::input('variety') == $variety->name) selected @endif >{{ $variety->name }}</option>
						@endforeach
					</select>
				</div>
				<div>
					<select class="w1" name="standard">
						<option value="0">选择标准</option>
						@foreach ( $standards as $standard)
							<option @if (Request::input('standard') == $standard->name) selected @endif >{{ $standard->name }}</option>
						@endforeach
					</select>
				</div>
				<div>
					<select class="w1" name="material">
						<option value="0">选择材质</option>
						@foreach ( $materials as $material)
							<option @if (Request::input('material') == $material->name) selected @endif >{{ $material->name }}</option>
						@endforeach
					</select>
				</div>
				<div>
					<select class="w1" name="steelmill">
						<option value="0">选择钢厂</option>
						@foreach ( $steelmills as $steelmill)
							<option @if (Request::input('steelmill') == $steelmill->name) selected @endif >{{ $steelmill->name }}</option>
						@endforeach
					</select>
				</div><br>
				<div>外径</div>
				<div>
					<input type="text" style="width: 100px;" name="outer_diameter1" placeholder="输入外径范围" value="@if (Request::input('outer_diameter1') != null){{ Request::input('outer_diameter1') }}@endif">
				</div>
				<div class="div1">-</div>
				<div>
					<input type="text" style="width: 100px;" name="outer_diameter2" placeholder="输入外径范围" value="@if (Request::input('outer_diameter2') != null){{ Request::input('outer_diameter2') }}@endif">
				</div>
				<div class="div1">mm</div>
				<div></div>
				<div>厚度</div>
				<div>
					<input type="text" style="width: 100px;" name="thickness1" placeholder="输入厚度范围" value="@if (Request::input('thickness1') != null){{ Request::input('thickness1') }}@endif">
				</div>
				<div class="div1">-</div>
				<div>
					<input type="text" style="width: 100px;" name="thickness2" placeholder="输入厚度范围" value="@if (Request::input('thickness2') != null){{ Request::input('thickness2') }}@endif">
				</div>
				<div class="div1">mm</div>
				<div></div>
				<div>长度</div>
				<div>
					<input type="text" style="width: 100px;" name="length1" placeholder="输入长度范围" value="@if (Request::input('length1') != null){{ Request::input('length1') }}@endif">
				</div>
				<div class="div1">-</div>
				<div>
					<input type="text" style="width: 100px;" name="length2" placeholder="输入长度范围" value="@if (Request::input('length2') != null){{ Request::input('length2') }}@endif">
				</div>
				<div class="div1">m</div><br>
				<div>
                	<input id="start" name="starttime" onclick="laydate()" class="time laydate-icon" style="width:100px;" value="@if (Request::input('starttime') != null){{ Request::input('starttime') }}@endif" placeholder="请选择日期">
                    —
                    <input id="end" name="endtime" onclick="laydate()" class="time laydate-icon" style="width:100px;" value="@if (Request::input('endtime') != null){{ Request::input('endtime') }}@endif" placeholder="请选择日期">
				</div>
				
				<div class="div1"><button class="btn" type="submit" id="search_btn">搜索</button></div>
			</div>
                    <!-- <div class="search" style="height:190px;">
                        <p>地区
                            <select name="area" class="diqu">
                                <option value="">全部</option>
                                @foreach($areas as $area)
                                <option value="{{$area->areaId}}">{{$area->areaName}}</option>
                                @endforeach
                            </select>
                            —
                            <select name="city" class="diqu">
                                <option value="">请选择城市</option>
                                
                            </select>
                        </p>
                        <p>品种
                            <select name="variety" class="type">
                             	<option value="">全部</option>
                            @foreach ( $varieties as $variety)
                                <option>{{$variety->name}}</option>
                            @endforeach
                            </select>
                        </p>
                        <p>标准
                            <select name="standard" class="standard">
                                <option value="">全部</option>
                                @foreach ( $standards as $standard)
									<option>{{ $standard->name }}</option>
								@endforeach
                            </select>
                        </p>
                        <p>材质
                        	<select class="w1" name="material">
								<option value="0">选择材质</option>
								@foreach ( $materials as $material)
									<option @if (Request::input('material') == $material->name) selected @endif >{{ $material->name }}</option>
								@endforeach
							</select>
                        </p>
                        <p>钢厂
                        	<select class="w1" name="steelmill">
								<option value="0">选择钢厂</option>
								@foreach ( $steelmills as $steelmill)
									<option @if (Request::input('steelmill') == $steelmill->name) selected @endif >{{ $steelmill->name }}</option>
								@endforeach
							</select>
                        </p>
                        <p>外径
                        	<input type="text" style="width: 100px;" name="outer_diameter1" placeholder="输入外径范围" value="@if (Request::input('outer_diameter1') != null){{ Request::input('outer_diameter1') }}@endif">—
                        	<input type="text" style="width: 100px;" name="outer_diameter2" placeholder="输入外径范围" value="@if (Request::input('outer_diameter2') != null){{ Request::input('outer_diameter2') }}@endif">
                        </p>
                        <p>厚度
                        	<input type="text" style="width: 100px;" name="thickness1" placeholder="输入厚度范围" value="@if (Request::input('thickness1') != null){{ Request::input('thickness1') }}@endif">—
                        	<input type="text" style="width: 100px;" name="thickness2" placeholder="输入厚度范围" value="@if (Request::input('thickness2') != null){{ Request::input('thickness2') }}@endif">
                        </p>
                        <p>长度
                        	<input type="text" style="width: 100px;" name="length1" placeholder="输入长度范围" value="@if (Request::input('length1') != null){{ Request::input('length1') }}@endif">—
                        	<input type="text" style="width: 100px;" name="length2" placeholder="输入长度范围" value="@if (Request::input('length2') != null){{ Request::input('length2') }}@endif">
                        </p>
                        <p>日期
                            <input id="start" name="starttime" onclick="laydate()" class="time laydate-icon" value="@if (Request::input('starttime') != null){{ Request::input('starttime') }}@endif" placeholder="请选择日期">
                            —
                            <input id="end" name="endtime" onclick="laydate()" class="time laydate-icon" value="@if (Request::input('endtime') != null){{ Request::input('endtime') }}@endif" placeholder="请选择日期">
                        </p>
                        <p>
                        	<button type="submit" class="sou">搜索</button>
                            <!-- <a href="javascript:;" class="sou">搜索</a> -->
                        <!-- </p>
                    </div>
                     -->
                    </form>
                    <div class="table">
                        <ul class="thead">
                            <li class="td1">城市</li>
                            <li class="td2">品种</li>
                            <li class="td3">标准</li>
                            <li class="td4">长度(m)</li>
                            <li class="td5">外径(mm)</li>
                            <li class="td6">厚度(mm)</li>
                            <li class="td7">钢厂</li>
                            <li class="td8">吨数</li>
                            <li class="td9">交货日期</li>
                            <li class="td10">更新日期</li>
                        </ul>
                        <div class="tbody">
                        	@foreach ($list as $item)
                            <ul class="tr">
                                <li class="td1">{{ $item->area or '全部' }}</li>
                                <li class="td2">{{ $item->variety or '全部' }}</li>
                                <li class="td3">{{ $item->standard or '全部' }}</li>
                                <li class="td4">@if($item->length_type==1){{$item->length}}~{{$item->max_length}}@else{{$item->length}}@endif</li>
                               	<li class="td5">{{ $item->outer_diameter}}</li>
                               	<li class="td6">{{$item->thickness}}</li>
                                <li class="td7">{{ $item->steelmill or '全部' }}</li>
                                <li class="td8">{{ $item->stock }} {{ $item->unit }}</li>
                                <li class="td9"><?php echo substr($item->delivery_date,0,10); ?></li>
                                <li class="td10"><?php echo substr($item->updated_at,0,10); ?>
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
        
        $('select[name="area"]').on('change',function(){
            var areaid = $(this).val();
            $.ajax({
                type:"GET",
                url:"{{route('shop.area.city')}}",
                data:{areaId:areaid},
                datatype: "json",
                success:function(json){
                    var data = JSON.parse(json);
                    //console.log(data);
                    if(data != null){
                        var str = "";
                        for(var i=0;i<data.length;i++){
                            str += '<option value="'+data[i].areaId+'">'+data[i].areaName+'</option>';
                        }
                        $('select[name="city"]').html("");
                        $('select[name="city"]').append(str);
                    }else{
                        var str = '<option value="0">选择城市</option>';
                        $('select[name="city"]').html("");
                        $('select[name="city"]').append(str);
					 }
                }
            });
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

@extends('_layouts.shop')
@section('main-content')
    <!-- content-->
    <div class="meCenIndex_con mid_div min_w marok fabuxianhuo">
        <div class="tit">
            <img src="/assets/shop/img/shangpu/sptit.jpg"/>
            <p class="line"></p>
        </div>
        <div class="content clear">
            <div class="R" style=" float: none; width: auto; padding-top: 30px;">
               <!-- tab-->
                <form action="{{ route('seller.republish') }}" method="post">
                <div class="orderQihuo">
                    <ul class="tab clear">
                        <li class="on"><a href="javascript:;">现货修改</a></li>
                        <li><span style="color: red;">{{ $result }}</span></li>
                    </ul>
                    <div class="con clear">
                        <ul class="clear">
                            <li>地区
                                <select name="province">
                                    @foreach($provinces as $province)
                                        <option @if($goods->province == $province->areaId)selected @endif value="{{ $province->areaId }}">{{ $province->areaName }}</option>
                                    @endforeach
                                </select>
                            </li>
                            <li>城市
                                <select name="city">
                                    @foreach($cities as $city)
                                        <option @if($goods->area_code == $city->areaId)selected @endif value="{{ $city->areaId }}">{{ $city->areaName }}</option>
                                    @endforeach
                                </select>
                            </li>
                            <li>品种
                                <select name="variety">
                                    {{--<option value="">全部</option>--}}
                                    @foreach ( config('const.goods_variety') as $variety)
                                        <option value="{{ $variety }}" @if ($goods->variety == $variety) selected @endif > {{ $variety }}</option>
                                    @endforeach
                                </select>
                            </li>
                        </ul>
                        <ul class="clear">
                            <li>标准
                                <select name="standard">
                                    @foreach ( config('const.goods_standard') as $standard)
                                        <option value="{{ $standard }}" @if ($goods->standard == $standard) selected @endif > {{ $standard }}</option>
                                    @endforeach
                                </select>
                            </li>
                            <li>材质
                                <select name="material">
                                    @foreach ( config('const.goods_material') as $material)
                                        <option value="{{ $material }}" @if ($goods->material == $material) selected @endif > {{ $material }}</option>
                                    @endforeach
                                </select>
                            </li>
                            <li>钢厂
                                <select name="steelmill">
                                    @foreach ( config('const.goods_steelmill') as $steelmill)
                                        <option value="{{ $steelmill }}" @if ($goods->steelmill == $steelmill) selected @endif > {{ $steelmill }}</option>
                                    @endforeach
                                </select>
                            </li>
                        </ul>
                        <ul class="clear">
                            <li>价格
                                <select name="goods_price">
                                    @foreach ( config('const.goods_price') as $price)
                                        <option value="{{ $price }}" @if ($goods->goods_price == $price) selected @endif > {{ $price }}</option>
                                    @endforeach
                                </select>
                                元/吨
                            </li>
                        </ul>
                        <ul class="tr">
                            <li class="td1">规格</li>
                            <li class="td2" style="width: 245px;">
                                <ul>
                                    <li>外径 <input name="outer_diameter" type="text" value="{{ $goods->outer_diameter }}" /> mm</li>
                                    <li class="last">厚度 <input name="thickness" type="text" value="{{ $goods->thickness }}" /> mm</li>
                                </ul>
                            </li>
                            <li class="td1">数量</li>
                            <li class="td2" style="width: 245px;">
                                <ul>
                                    <li>
                                    	<input class="radio_btn" type="radio" name="unit" @if($goods->unit == 1) checked @endif value="1"/>吨数
                                    	<input style="margin-left: 10px;" class="radio_btn" type="radio" @if($goods->unit == 2) checked @endif name="unit" value="2"/>支数
                                    </li>
                                    <li class="last"><input type="text" name="stock" class="text stock" value="{{ $goods->stock }}"/></li>
                                </ul>
                            </li>
                        </ul>
                        <ul class="tr">
                            <li class="td1">长度</li>
                            <li class="td2">
                                <ul>
                                    {{--<li>
                                        <span><input type="radio" name="chi" class="chi" checked /> 不定尺</span>
                                        <span><input type="radio" name="chi" class="chi"/> 定尺</span>
                                    </li>--}}
                                    <li class="last"><input name="length" type="text" value="{{ $goods->length }}" /> m</li>
                                </ul>
                            </li>
                        </ul>
                        <div class="btns">
                            {{--<a href="javascript:;" class="daoru">导入Excel表格</a>--}}
                            {{--<a href="javascript:;" class="fabu">重新发布</a>--}}

                            <input type="hidden" name="id" value="{{ $goods->id }}">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input class="fabu" type="submit" value="重新发布" >
                        </div>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
    <!-- footer-->
    <script>
        $('select[name="province"]').on('change',function(){
            var areaid = $(this).val();
            $.ajax({
                type:"GET",
                url:"{{route('shop.area.city')}}",
                data:{areaId:areaid},
                datatype: "json",
                success:function(json){
                    var data = JSON.parse(json);
                    if(data != null){
                        var str = "";
                        for(var i=0;i<data.length;i++){
                            str += '<option value="'+data[i].areaId+'">'+data[i].areaName+'</option>';
                        }
                        $('select[name="city"]').html("");
                        $('select[name="city"]').append(str);
                    }else{
                        var str = '<option value="">选择城市</option>';
                        $('select[name="city"]').html("");
                        $('select[name="city"]').append(str);
                    }
                }
            });
        });
    </script>
    @endsection
    <!-- footer-->
    @section('footer')
        <!--footer-->
@include('_layouts.shop_footer1')
@endsection
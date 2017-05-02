@extends('_layouts.shop')
@section('main-content')
    <!-- content-->

    <div class="meCenIndex_con mid_div min_w marok fabuxianhuo">
        <div class="tit">
            <img src="/assets/shop/img/shangpu/sptit.jpg"/>
            <p class="line"></p>
        </div>
        <div class="content clear">
             @include('_layouts.seller_left')
            <div class="R">
                <!-- 个人信息-->
               {{-- <div class="personInfo clear">
                    <a href="#" class="set"><img src="/assets/shop/img/person/set.jpg"/></a>
                    <p class="headimg L" style="background-image: url(/assets/shop/img/shangpu/headimg.jpg)"></p>
                    <ul class="L one">
                        <li><b class="name">天津华远兴业</b></li>
                        <li>黑龙江建龙协议户：一级
                        </li>
                        <li>信誉等级：
                            <p class="xinyu">
                                <span class="ok"></span>
                                <span class="ok"></span>
                                <span class="ok"></span>
                                <span class="ok"></span>
                                <span class="ok"></span>
                            </p>
                        </li>
                        <li>我的公司：山东鲁业化工销售有限公司</li>
                        <li>收货地址：山东省泰安市泰山领镇中山西路233号</li>
                    </ul>
                    <ul class="L two">
                        <li class="sum">总销售额：<span><b>454676</b>吨</span></li>
                        <li>签约中：0</li>
                        <li>付款中：0</li>
                        <li>发货中：1</li>
                        <li>评价中：4</li>
                    </ul>
                </div>--}}
                <!-- tab-->
                <form action="{{ route('seller.publish') }}" method="post">
                <div class="orderQihuo">
                    <ul class="tab clear">
                        <li class="on"><a href="#">发布现货</a></li>
                        <li><span style="color: red;">{{ $result }}</span></li>
                    </ul>
                    <div class="con clear">
                        <ul class="clear">
                            <li>地区
                                <select name="province">
                                    <option value="">选择地区</option>
                                    @foreach($provinces as $province)
                                        <option value="{{ $province->areaId }}">{{ $province->areaName }}</option>
                                    @endforeach
                                </select>
                            </li>
                            <li>城市
                                <select name="city">
                                    <option value="">选择城市</option>
                                </select>
                            </li>
                            <li>品种
                                <select name="variety">
                                    {{--<option value="">全部</option>--}}
                                    @foreach ( $varieties as $variety)
                                        <option value="{{ $variety->name }}" @if (Request::input('variety') == $variety->name) selected @endif > {{ $variety->name }}</option>
                                    @endforeach
                                </select>
                            </li>
                        </ul>
                        <ul class="clear">
                            <li>标准
                                <select name="standard">
                                    @foreach ( $standards as $standard)
                                        <option value="{{ $standard->name }}" @if (Request::input('standard') == $standard->name) selected @endif > {{ $standard->name }}</option>
                                    @endforeach
                                </select>
                            </li>
                            <li>材质
                                <select name="material">
                                    @foreach ( $materials as $material)
                                        <option value="{{ $material->name }}" @if (Request::input('material') == $material->name) selected @endif > {{ $material->name }}</option>
                                    @endforeach
                                </select>
                            </li>
                            <li>钢厂
                                <select name="steelmill">
                                    @foreach ( $steelmills as $steelmill)
                                        <option value="{{ $steelmill->name }}" @if (Request::input('steelmill') == $steelmill->name) selected @endif > {{ $steelmill->name }}</option>
                                    @endforeach
                                </select>
                            </li>
                        </ul>
                        {{--<ul class="tr">
                            价格
                                --}}{{--<select name="goods_price">
                                    @foreach ( config('const.goods_price') as $price)
                                        <option value="{{ $price }}" @if (Request::input('goods_price') == $price) selected @endif > {{ $price }}</option>
                                    @endforeach
                                </select>--}}{{--
                                <input name="goods_price" type="text"/>
                                元/吨

                        </ul>--}}
                        <ul class="tr">
                            <li class="td1">价格</li>
                            <li class="td2">
                                <ul>
                                    {{--<li>
                                        <span><input type="radio" name="chi" class="chi" checked /> 不定尺</span>
                                        <span><input type="radio" name="chi" class="chi"/> 定尺</span>
                                    </li>--}}
                                    <li class="last"><input name="goods_price" type="text"/> 元/吨</li>
                                </ul>
                            </li>
                        </ul>

                        <ul class="tr">
                            <li class="td1">规格</li>
                            <li class="td2" style="width: 245px;">
                                <ul>
                                    <li>外径 <input name="outer_diameter" type="text"/> mm</li>
                                    <li class="last">厚度 <input name="thickness" type="text"/> mm</li>
                                </ul>
                            </li>
                            <li class="td1">数量</li>
                            <li class="td2" style="width: 245px;">
                                <ul>
                                    <li>
                                        <input class="radio_btn" type="radio" name="unit" checked value="1"/>吨数
                                        <input style="margin-left: 10px;" class="radio_btn" type="radio" name="unit" value="2"/>支数
                                    </li>
                                    <li class="last"><input type="text" name="stock" class="text stock" value=""/></li>
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
                                    <li class="last"><input name="length" type="text"/> m</li>
                                </ul>
                            </li>
                        </ul>
                        <div class="btns">
                            {{--<a href="javascript:;" class="daoru">导入Excel表格</a>--}}
                            {{--<a href="javascript:;" class="fabu" id="publish_spots">发布</a>--}}
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input class="fabu" type="submit" value="发布" >
                        </div>
                    </div>
                </div>
                </form>
                <!-- ad-->
                @include('_layouts.ads')
            </div>
        </div>
    </div>
    <script>
        $("#public_stock").addClass("on");
        $('#publish_spots').click(function(){
           // alert('heheh');
            window.location.href = "/seller/stocks/stores";
        });

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
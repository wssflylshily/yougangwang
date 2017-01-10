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
                <div class="personInfo clear">
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
                </div>
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
                                    @foreach ( config('const.goods_variety') as $variety)
                                        <option value="{{ $variety }}" @if (Request::input('variety') == $variety) selected @endif > {{ $variety }}</option>
                                    @endforeach
                                </select>
                            </li>
                        </ul>
                        <ul class="clear">
                            <li>标准
                                <select name="standard">
                                    @foreach ( config('const.goods_standard') as $standard)
                                        <option value="{{ $standard }}" @if (Request::input('standard') == $standard) selected @endif > {{ $standard }}</option>
                                    @endforeach
                                </select>
                            </li>
                            <li>材质
                                <select name="material">
                                    @foreach ( config('const.goods_material') as $material)
                                        <option value="{{ $material }}" @if (Request::input('material') == $material) selected @endif > {{ $material }}</option>
                                    @endforeach
                                </select>
                            </li>
                            <li>钢厂
                                <select name="steelmill">
                                    @foreach ( config('const.goods_steelmill') as $steelmill)
                                        <option value="{{ $steelmill }}" @if (Request::input('steelmill') == $steelmill) selected @endif > {{ $steelmill }}</option>
                                    @endforeach
                                </select>
                            </li>
                        </ul>
                        <ul class="clear">
                            <li>价格
                                <select name="goods_price">
                                    @foreach ( config('const.goods_price') as $price)
                                        <option value="{{ $price }}" @if (Request::input('goods_price') == $price) selected @endif > {{ $price }}</option>
                                    @endforeach
                                </select>
                                元/吨
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
                <ul class="ads clear">
                    <li><img src="/assets/shop/img/person/ad.jpg"/></li>
                    <li><img src="/assets/shop/img/person/ad.jpg"/></li>
                    <li class="last"><img src="/assets/shop/img/person/ad.jpg"/></li>
                </ul>
            </div>
        </div>
    </div>
    <script>
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
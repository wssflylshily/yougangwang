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
                        <li><b class="name">{{$users->realname}}</b> 先生</li>
                        <li>{{$users->nameauth}}
                            <span class="renzheng"></span>
                        </li>
                        <li>信誉等级：
                            <p class="dengji">
                                {!! $users->degree_html !!}
                            </p>
                        </li>
                        <li>我的公司：{{$users->compony}}</li>
                        <li>收货地址：{{$users->consignee}}</li>
                    </ul>
                    <ul class="L two">
                        <li>待签约：dummy</li>
                        <li>待付款：dummy</li>
                        <li>待收货：dummy</li>
                        <li>待自提：dummy</li>
                        <li>待评价：dummy</li>
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
                                <li class="on"><a href="#">全部</a></li>
                                <li><a href="#">未接单</a></li>
                                <li><a href="#">已接单</a></li>
                                <li><a href="#">待付款</a></li>
                                <li><a href="#">生产中</a></li>
                                <li><a href="#">已发货</a></li>
                                <li><a href="#">待开票</a></li>
                                <li><a href="#">交易完成</a></li>
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
                            <li class="td7">吨数</li>
                            <li class="td8">实付款</li>
                            <li class="td9">交易状态</li>
                            <li class="td10">交易操作</li>
                        </ul>
                        <!-- 期货列表 normal是非评价的期货列表 蓝色  评价的期货列表是 灰色-->
                        <ul class="orderList">
                            <li class="order">
                                <ul class="thead clear">
                                    <li class="one">
                                        <input class="check_btn" type="checkbox" name="neirong" value="">
                                        2016-10-22
                                        订单号：2602065004365800
                                    </li>
                                    <li class="two">暂无商家接单</li>
                                    <li class="three">
                                        <a href="javascript:;" data_tel="13012345678" class="contact"></a>
                                    </li>
                                </ul>
                                <ul class="tbody">
                                    <li>
                                        <ul class="tr clear">
                                            <li class="col7">
                                                <ul class="last">
                                                    <li class="td1">天津</li>
                                                    <li class="td2">无缝管</li>
                                                    <li class="td3">API 5L</li>
                                                    <li class="td4">#20</li>
                                                    <li class="td5">鞍钢</li>
                                                    <li class="td6">219*9.8*12000</li>
                                                    <li class="td7">69</li>
                                                </ul>
                                            </li>
                                            <li class="td8">
                                                <p class="black">￥218730</p>
                                                <p class="f12">(含运费：￥3450.00)</p>
                                            </li>
                                            <li class="td9">
                                                <a href="#" class="f12">订单详情</a>
                                            </li>
                                            <li class="td10">
                                                <a href="#" class="btnShangjiaTui btnGrayBd4">商家推送</a>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                            <li class="order">
                                <ul class="thead clear">
                                    <li class="one">
                                        <input class="check_btn" type="checkbox" name="neirong" value="">
                                        2016-10-22
                                        订单号：2602065004365800
                                    </li>
                                    <li class="two">已有 <b class="orange">3家</b> 商家接单</li>
                                    <li class="three">
                                        <a href="javascript:;" data_tel="13012345678" class="contact"></a>
                                    </li>
                                </ul>
                                <ul class="tbody">
                                    <li>
                                        <ul class="tr clear">
                                            <li class="col7">
                                                <ul>
                                                    <li class="td1">天津</li>
                                                    <li class="td2">无缝管</li>
                                                    <li class="td3">API 5L</li>
                                                    <li class="td4">#20</li>
                                                    <li class="td5">鞍钢</li>
                                                    <li class="td6">219*9.8*12000</li>
                                                    <li class="td7">69</li>
                                                </ul>
                                                <ul class="last">
                                                    <li class="td1">天津</li>
                                                    <li class="td2">无缝管</li>
                                                    <li class="td3">API 5L</li>
                                                    <li class="td4">#20</li>
                                                    <li class="td5">鞍钢</li>
                                                    <li class="td6">219*9.8*12000</li>
                                                    <li class="td7">69</li>
                                                </ul>
                                            </li>
                                            <li class="td8">
                                                <p class="black">￥218730</p>
                                                <p class="f12">(含运费：￥3450.00)</p>
                                            </li>
                                            <li class="td9">
                                                <a href="#" class="f12">订单详情</a>
                                            </li>
                                            <li class="td10">
                                                <a href="#" class="btnSelectShagnjia btnBlue4">选择商家</a>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                            <li class="order">
                                <ul class="thead clear">
                                    <li class="one">
                                        <input class="check_btn" type="checkbox" name="neirong" value="">
                                        2016-10-22
                                        订单号：2602065004365800
                                    </li>
                                    <li class="two">天津华远兴业</li>
                                    <li class="three">
                                        <a href="javascript:;" data_tel="13012345678" class="contact"></a>
                                    </li>
                                </ul>
                                <ul class="tbody">
                                    <li>
                                        <ul class="tr clear">
                                            <li class="col7">
                                                <ul class="last">
                                                    <li class="td1">天津</li>
                                                    <li class="td2">无缝管</li>
                                                    <li class="td3">API 5L</li>
                                                    <li class="td4">#20</li>
                                                    <li class="td5">鞍钢</li>
                                                    <li class="td6">219*9.8*12000</li>
                                                    <li class="td7">69</li>
                                                </ul>
                                            </li>
                                            <li class="td8">
                                                <p class="black">￥218730</p>
                                                <p class="f12">(含运费：￥3450.00)</p>
                                            </li>
                                            <li class="td9">
                                                <a href="#" class="f12">订单详情</a>
                                            </li>
                                            <li class="td10">
                                                <a href="#" class="btnFukuan btnRed2">付款</a>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                            <li class="order pingjia">
                                <ul class="thead clear">
                                    <li class="one">
                                        <input class="check_btn" type="checkbox" name="neirong" value="">
                                        2016-10-22
                                        订单号：2602065004365800
                                    </li>
                                    <li class="two">山东鲁能</li>
                                    <li class="three">
                                        <a href="javascript:;" data_tel="13012345678" class="contact"></a>
                                    </li>
                                </ul>
                                <ul class="tbody">
                                    <li>
                                        <ul class="tr clear">
                                            <li class="col7">
                                                <ul>
                                                    <li class="td1">天津</li>
                                                    <li class="td2">无缝管</li>
                                                    <li class="td3">API 5L</li>
                                                    <li class="td4">#20</li>
                                                    <li class="td5">鞍钢</li>
                                                    <li class="td6">219*9.8*12000</li>
                                                    <li class="td7">69</li>
                                                </ul>
                                                <ul class="last">
                                                    <li class="td1">天津</li>
                                                    <li class="td2">无缝管</li>
                                                    <li class="td3">API 5L</li>
                                                    <li class="td4">#20</li>
                                                    <li class="td5">鞍钢</li>
                                                    <li class="td6">219*9.8*12000</li>
                                                    <li class="td7">69</li>
                                                </ul>
                                            </li>
                                            <li class="td8">
                                                <p class="black">￥218730</p>
                                                <p class="f12">(含运费：￥3450.00)</p>
                                            </li>
                                            <li class="td9">
                                                <a href="#" class="f12 textBlue">生产中</a>
                                                <a href="#" class="f12">订单详情</a>
                                            </li>
                                            <li class="td10">
                                                <a href="#" class="btnBlue4 disabled">确认收货</a>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                            <li class="order pingjia">
                                <ul class="thead clear">
                                    <li class="one">
                                        <input class="check_btn" type="checkbox" name="neirong" value="">
                                        2016-10-22
                                        订单号：2602065004365800
                                    </li>
                                    <li class="two">山东鲁能</li>
                                    <li class="three">
                                        <a href="javascript:;" data_tel="13012345678" class="contact"></a>
                                    </li>
                                </ul>
                                <ul class="tbody">
                                    <li>
                                        <ul class="tr clear">
                                            <li class="col7">
                                                <ul>
                                                    <li class="td1">天津</li>
                                                    <li class="td2">无缝管</li>
                                                    <li class="td3">API 5L</li>
                                                    <li class="td4">#20</li>
                                                    <li class="td5">鞍钢</li>
                                                    <li class="td6">219*9.8*12000</li>
                                                    <li class="td7">69</li>
                                                </ul>
                                                <ul class="last">
                                                    <li class="td1">天津</li>
                                                    <li class="td2">无缝管</li>
                                                    <li class="td3">API 5L</li>
                                                    <li class="td4">#20</li>
                                                    <li class="td5">鞍钢</li>
                                                    <li class="td6">219*9.8*12000</li>
                                                    <li class="td7">69</li>
                                                </ul>
                                            </li>
                                            <li class="td8">
                                                <p class="black">￥218730</p>
                                                <p class="f12">(含运费：￥3450.00)</p>
                                            </li>
                                            <li class="td9">
                                                <a href="#" class="f12">已完成</a>
                                                <a href="#" class="f12 textRed">查看物流</a>
                                            </li>
                                            <li class="td10">
                                                <a href="#" class="btnBlue4">确认收货</a>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                            <li class="order pingjia">
                                <ul class="thead clear">
                                    <li class="one">
                                        <input class="check_btn" type="checkbox" name="neirong" value="">
                                        2016-10-22
                                        订单号：2602065004365800
                                    </li>
                                    <li class="two">山东鲁能</li>
                                    <li class="three">
                                        <a href="javascript:;" data_tel="13012345678" class="contact"></a>
                                        <a href="#" class="del"></a>
                                    </li>
                                </ul>
                                <ul class="tbody">
                                    <li>
                                        <ul class="tr clear">
                                            <li class="col7">
                                                <ul>
                                                    <li class="td1">天津</li>
                                                    <li class="td2">无缝管</li>
                                                    <li class="td3">API 5L</li>
                                                    <li class="td4">#20</li>
                                                    <li class="td5">鞍钢</li>
                                                    <li class="td6">219*9.8*12000</li>
                                                    <li class="td7">69</li>
                                                </ul>
                                                <ul class="last">
                                                    <li class="td1">天津</li>
                                                    <li class="td2">无缝管</li>
                                                    <li class="td3">API 5L</li>
                                                    <li class="td4">#20</li>
                                                    <li class="td5">鞍钢</li>
                                                    <li class="td6">219*9.8*12000</li>
                                                    <li class="td7">69</li>
                                                </ul>
                                            </li>
                                            <li class="td8">
                                                <p class="black">￥218730</p>
                                                <p class="f12">(含运费：￥3450.00)</p>
                                            </li>
                                            <li class="td9">
                                                <a href="#" class="f12">待开发票</a>
                                                <a href="#" class="f12">订单详情</a>
                                            </li>
                                            <li class="td10">
                                                <a href="#" class="btnGrayBd2">评价</a>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                            <li class="order pingjia">
                                <ul class="thead clear">
                                    <li class="one">
                                        <input class="check_btn" type="checkbox" name="neirong" value="">
                                        2016-10-22
                                        订单号：2602065004365800
                                    </li>
                                    <li class="two">山东鲁能</li>
                                    <li class="three">
                                        <a href="javascript:;" data_tel="13012345678" class="contact"></a>
                                        <a href="#" class="del"></a>
                                    </li>
                                </ul>
                                <ul class="tbody">
                                    <li>
                                        <ul class="tr clear">
                                            <li class="col7">
                                                <ul class="last">
                                                    <li class="td1">天津</li>
                                                    <li class="td2">无缝管</li>
                                                    <li class="td3">API 5L</li>
                                                    <li class="td4">#20</li>
                                                    <li class="td5">鞍钢</li>
                                                    <li class="td6">219*9.8*12000</li>
                                                    <li class="td7">69</li>
                                                </ul>
                                            </li>
                                            <li class="td8">
                                                <p class="black">￥218730</p>
                                                <p class="f12">(含运费：￥3450.00)</p>
                                            </li>
                                            <li class="td9">
                                                <a href="#" class="f12">交易完成</a>
                                                <a href="#" class="f12">订单详情</a>
                                            </li>
                                            <li class="td10">
                                                <a href="#" class="btnGrayBd2">评价</a>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
                <!-- 信任的商家-->
                <div class="xinRen">
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
                </div> 
                <!-- ad-->
                <ul class="ads clear" id="ads_clear">
                    <li><img src="/assets/shop/img/person/ad.jpg"/></li>
                    <li><img src="/assets/shop/img/person/ad.jpg"/></li>
                    <li class="last"><img src="/assets/shop/img/person/ad.jpg"/></li>
                </ul>
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
    </script>
@endsection

@section('footer')
    @include('_layouts.shop_footer2')
@endsection

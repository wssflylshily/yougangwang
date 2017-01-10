@extends('_layouts.shop')

@section('main-content')
    <link rel="stylesheet" href="/assets/shop/css/person.css"/>

    <!-- content-->
    <div class="meCenIndex_con mid_div min_w marok">
        <div class="tit">
            <img src="/assets/shop/img/shangpu/sptit.jpg"/>
            <p class="line"></p>
        </div>
        <div class="content clear">
            <ul class="L">
                <li><a href="/seller">我的店铺</a></li>
                <li><a href="/spots/publish">发布现货</a></li>
                <li><a href="/futures/publish">发布期货</a></li>
                <li><a href="/seller/futuresList">期货询单</a></li>
                <li><a href="/seller/futuresOffer">期货报单</a></li>
                <li><a href="/seller/contract">我的合同</a></li>
                <li class="on"><a href="/seller/myfutures">我的期货</a></li>
                 <li><a href="/spots/mystores">我的仓库</a></li>
                <li class="line"></li>
                <!-- <li><a href="#">我的产品</a></li>
                <li><a href="#">发布活动</a></li>
                <li><a href="#">我的评价</a></li>
                <li><a href="#">我的积分</a></li> -->
                <li><a href="#">订单记录</a></li>
                <li class="line"></li>
                <!-- <li><a href="#">维权中心</a></li>
                <li><a href="#">活动中心</a></li> -->
            </ul>
            <div class="R">
                <!-- 我的期货-->
                <div class="orderQihuo">
                    <ul class="tab clear">
                        <li class="on"><a href="#">我的期货</a></li>
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
                            <a href="#" class="R">查看全部订单</a>
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
                                        <a href="#" class="contact"></a>
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
                                        <a href="#" class="contact"></a>
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
                                        <a href="#" class="contact"></a>
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
                                        <a href="#" class="contact"></a>
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
                                        <a href="#" class="contact"></a>
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
                                        <a href="#" class="contact"></a>
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
                                        <a href="#" class="contact"></a>
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
                <div class="fenyeArea clear">
                    <ul class="fenye clear R">
                        <li class="on"><a href="#">1</a></li>
                        <li><a href="#">2</a></li>
                        <li><a href="#">3</a></li>
                        <li><a href="#">8</a></li>
                        <li><a href="#">9</a></li>
                        <li class="last"><a href="#">10</a></li>
                    </ul>
                </div>
                <!-- ad-->
                <ul class="ads clear">
                    <li><img src="/assets/shop/img/person/ad.jpg"/></li>
                    <li><img src="/assets/shop/img/person/ad.jpg"/></li>
                    <li class="last"><img src="/assets/shop/img/person/ad.jpg"/></li>
                </ul>
            </div>
        </div>
    </div>
    <!-- footer-->
    
@endsection

@section('footer')
    @include('_layouts.shop_footer1')
@endsection
@extends('_layouts.shop')
@section('main-content')
    <!-- content-->
    <div class="meCenIndex_con mid_div min_w marok">
        <div class="tit">
            <img src="../img/shangpu/sptit.jpg"/>
            <p class="line"></p>
        </div>
        <div class="content clear">
            <ul class="L">
                <li><a href="#">我的店铺</a></li>
                <li><a href="#">现货订单</a></li>
                <li><a href="#">期货订单</a></li>
                <li><a href="#">发布现货</a></li>
                <li><a href="#">发布现货</a></li>
                <li><a href="#">期货询单</a></li>
                <li><a href="#">期货报单</a></li>
                <li><a href="#">我的合同</a></li>
                <li><a href="#">我的仓库</a></li>
                <li class="line"></li>
                <li><a href="#">我的产品</a></li>
                <li><a href="#">发布活动</a></li>
                <li><a href="#">我的评价</a></li>
                <li><a href="#">我的积分</a></li>
                <li><a href="#">订单记录</a></li>
                <li class="line"></li>
                <li><a href="#">维权中心</a></li>
                <li><a href="#">活动中心</a></li>
            </ul>
            <div class="R">
                <!-- 我的现货 我的期货 我的合同-->
                <div class="orderQihuo">
                    <ul class="tab clear">
                        <li class="on"><a href="meHeTongHistory1.html">现货订单</a></li>
                    </ul>
                    <!-- 我的现货-->
                    <div class="orderCon">
                        <div class="tit">
                            <ul class="L clear">
                                <li class="on"><a href="#">全部</a></li>
                                <li><a href="#">未签合同</a></li>
                                <li><a href="#">待发货</a></li>
                                <li><a href="#">已发货</a></li>
                                <li><a href="#">待开票</a></li>
                                <li><a href="#">交易完成</a></li>
                            </ul>
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
                        <!-- 现货列表 normal是非评价的现货列表 蓝色  评价的现货列表是 灰色-->
                        <ul class="orderList">
                            <li class="order">
                                <ul class="thead clear">
                                    <li class="one">
                                        <input class="check_btn" type="checkbox" name="neirong" value="">
                                        2016-10-22
                                        订单号：2602065004365800
                                    </li>
                                    <li class="two">天津华远兴业</li>
                                    <li class="three">
                                        <a href="javascript:;" data_tel="132000000" class="contact" style="background-image: url(../img/contact_p.png);"></a>
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
                                                <a href="#" class="f12 textRed">查看物流</a>
                                            </li>
                                            <li class="td10">
                                                <a href="#" class="btnShouhuo btnBlue4">添加物流</a>
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
                                        <a href="javascript:;" data_tel="132000000" class="contact" style="background-image: url(../img/contact_p.png);"></a>
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
                                                <a href="#" class="f12 textRed">待补款</a>
                                                <a href="#" class="f12">订单详情</a>
                                            </li>
                                            <li class="td10">
                                                <a href="#" class="btnTousu btnGrayBd2">投诉</a>
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
                                        <a href="javascript:;" data_tel="132000000" class="contact" style="background-image: url(../img/contact_p.png);"></a>
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
                                                <a href="#" class="btnFukuan btnRed2">发货</a>
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
                                    <li class="two">天津华远兴业</li>
                                    <li class="three">
                                        <a href="javascript:;" data_tel="132000000" class="contact" style="background-image: url(../img/contact_p.png);"></a>
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
                                                <a href="#" class="f12 textBlue">待开发票</a>
                                                <a href="#" class="f12">订单详情</a>
                                            </li>
                                            <li class="td10">
                                                <a href="#" class="btnPingjia btnGrayBd2">开发票</a>
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
                                    <li class="two">天津华远兴业</li>
                                    <li class="three">
                                        <a href="javascript:;" data_tel="132000000" class="contact" style="background-image: url(../img/contact_p.png);"></a>
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
                                                <a href="#" class="f12">交易成功</a>
                                                <a href="#" class="f12">订单详情</a>
                                            </li>
                                            <li class="td10">
                                                <a href="#" class="btnPingjia btnGrayBd2">评价</a>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
                <!-- ad-->
                <ul class="ads clear">
                    <li><img src="../img/person/ad.jpg"/></li>
                    <li><img src="../img/person/ad.jpg"/></li>
                    <li class="last"><img src="../img/person/ad.jpg"/></li>
                </ul>
            </div>
        </div>
    </div>
    <!-- footer-->
    @endsection
    <!-- footer-->
    @section('footer')
        <!--footer-->
@include('_layouts.shop_footer1')
@endsection
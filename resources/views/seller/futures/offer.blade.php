@extends('_layouts.shop')

@section('main-content')
    <link rel="stylesheet" href="/assets/shop/css/person.css"/>

    <!-- content-->
    <div class="meCenIndex_con mid_div min_w marok qihuobaodan">
        <div class="tit">
            <img src="/assets/shop/img/shangpu/sptit.jpg"/>
            <p class="line"></p>
        </div>
        <div class="content clear">
            @include('_layouts.seller_left')
            <div class="R">
                <!-- tab-->
                <div class="orderQihuo">
                    <ul class="tab clear">
                        <li class="on"><a href="#">全部</a></li>
                        <li class="line"></li>
                        <li><a href="#">签约中</a></li>
                        <li class="line"></li>
                        <li><a href="#">签约完成</a></li>
                    </ul>
                    <ul class="thead">
                    	<li class="td1">地区</li>
                    	<li class="td2">品种</li>
                    	<li class="td3">标准</li>
                    	<li class="td4">材质</li>
                    	<li class="td5">钢厂</li>
                    	<li class="td6">规格</li>
                    	<li class="td7">允差</li>
                    	<li class="td8">吨数</li>
                    	<!-- <li class="td9">支数</li> -->
                    	<li class="td10">交货日期</li>
                    	<!-- <li class="td11">报价</li>
                    	<li class="td12">交货天数</li> -->
                    	<li class="td13">状态</li>
                    </ul>
                    <div class="baodanList">
                        <!-- 全部-->
                        <div class="all">
                            <ul class="list">
                            	@foreach($list as $item)
                                <li>
                                    <ul class="thead">
                                        <li class="td1"><?php echo substr($item['created_at'], 0,10); ?><!-- 2016-10-22 --></li>
                                        <li class="td2">订单号：{{ $item['order_sn'] }}</li>
                                        <li class="td3">{{ $item->linkman }}</li>
                                        <li class="td4">
                                            <a href="javascript:;" class="contact"></a>
                                        </li>
                                    </ul>
                                    <div class="tbody">
                                        <ul class="tr">
                                            <li class="td1w">
                                            	@foreach($item->futures as $future)
                                                <ul class="tr">
                                                    <li class="td1">{{ $future->area_id }}</li>
                                                    <li class="td2">{{ $future->variety }}</li>
                                                    <li class="td3">{{ $future->standard }}</li>
                                                    <li class="td4">{{ $future->material }}</li>
                                                    <li class="td5">{{ $future->steelmill }}</li>
                                                    <li class="td6">@if($future->length_type==1){{ $future->outer_diameter }}*{{ $future->thickness }}*{{ $future->length*100 }}~{{ $future->outer_diameter }}*{{ $future->thickness }}*{{ $future->max_length*100 }}@else{{ $future->outer_diameter }}*{{ $future->thickness }}*{{ $future->length*100 }}@endif</li>
                                                    <li class="td7">{{ $future->deviation }}</li>
                                                    <li class="td8">{{ $future->stock }}</li>
                                                   <!--  <li class="td9">{{ $future->price }}</li> -->
                                                    <li class="td10"><?php echo substr($future->delivery_date,0, 10) ?></li>
                                                   <!--  <li class="td11"></li>
                                                    <li class="td12">{{ $future->days }}</li> -->
                                                </ul>
                                                @endforeach
                                            </li>
                                            <li class="td2w">
                                            	@if($item->status==0)
                                                <span class="red">待买家回复</span>
                                                @elseif($item->status==-1&&$item->seller_id!=$seller_id)
                                                <span class="gray">买家已选择其他商家</span>
                                                @elseif($item->status==-1&&$item->seller_id==$seller_id&&$item->contract==null)
                                                <span class="red">待签约</span>
                                                @elseif($item->status==-1&&$item->seller_id==$seller_id&&$item->contract->status<3)
                                                <span class="blue">签约中</span>
                                                @elseif($item->status==-1&&$item->seller_id==$seller_id&&$item->contract->status==3)
                                                <span class="green">签约完成</span>
                                                @endif
                                            </li>
                                        </ul>
                                    </div>
                                </li>
                                @endforeach
                               
                            </ul>
                        </div>
                        <!-- 签约中-->
                        <div style="display: none" class="zhong">
                            <ul class="list">
                            @foreach($list as $item)
                            @if($item->contract!=null && $item->contract->status<3)
                                <li>
                                    <ul class="thead">
                                        <li class="td1"><?php echo substr($item->created_at,0,10); ?></li>
                                        <li class="td2">订单号：{{$item->order_sn}}</li>
                                        <li class="td3">{{$item->linkman}}</li>
                                        <li class="td4">
                                            <a href="javascript:;" class="contact"></a>
                                        </li>
                                    </ul>
                                    <div class="tbody">
                                        <ul class="tr">
                                            <li class="td1w">
                                            	@foreach($item->futures as $future)
                                                <ul class="tr">
                                                    <li class="td1">{{ $future->area_id }}</li>
                                                    <li class="td2">{{ $future->variety }}</li>
                                                    <li class="td3">{{ $future->standard }}</li>
                                                    <li class="td4">{{ $future->material }}</li>
                                                    <li class="td5">{{ $future->steelmill }}</li>
                                                    <li class="td6">@if($future->length_type==1){{ $future->outer_diameter }}*{{ $future->thickness }}*{{ $future->length*100 }}~{{ $future->outer_diameter }}*{{ $future->thickness }}*{{ $future->max_length*100 }}@else{{ $future->outer_diameter }}*{{ $future->thickness }}*{{ $future->length*100 }}@endif</li>
                                                    <li class="td7">{{ $future->deviation }}</li>
                                                    <li class="td8">{{ $future->stock }}</li>
                                                   <!--  <li class="td9">{{ $future->price }}</li> -->
                                                    <li class="td10"><?php echo substr($future->delivery_date,0, 10) ?></li>
                                                    <!-- <li class="td11"></li>
                                                    <li class="td12">{{ $future->days }}</li> -->
                                                </ul>
                                                @endforeach
                                                
                                            </li>
                                            <li class="td2w">
                                                <span class="blue">签约中</span>
                                            </li>
                                        </ul>
                                    </div>
                                </li>
                                @endif
                                @endforeach
                            </ul>
                        </div>
                        <!-- 签约完成-->
                        <div style="display: none" class="complete">
                            <ul class="list">
                                @foreach($list as $item)
                            @if($item->contract!=null and $item->contract->status==3)
                                <li>
                                    <ul class="thead">
                                        <li class="td1"><?php echo substr($item->created_at,0,10); ?></li>
                                        <li class="td2">订单号：{{$item->order_sn}}</li>
                                        <li class="td3">{{$item->linkman}}</li>
                                        <li class="td4">
                                            <a href="javascript:;" class="contact"></a>
                                        </li>
                                    </ul>
                                    <div class="tbody">
                                        <ul class="tr">
                                            <li class="td1w">
                                            	@foreach($item->futures as $future)
                                                <ul class="tr">
                                                    <li class="td1">{{ $future->area_id }}</li>
                                                    <li class="td2">{{ $future->variety }}</li>
                                                    <li class="td3">{{ $future->standard }}</li>
                                                    <li class="td4">{{ $future->material }}</li>
                                                    <li class="td5">{{ $future->steelmill }}</li>
                                                    <li class="td6">@if($future->length_type==1){{ $future->outer_diameter }}*{{ $future->thickness }}*{{ $future->length*100 }}~{{ $future->outer_diameter }}*{{ $future->thickness }}*{{ $future->max_length*100 }}@else{{ $future->outer_diameter }}*{{ $future->thickness }}*{{ $future->length*100 }}@endif</li>
                                                    <li class="td7">{{ $future->deviation }}</li>
                                                    <li class="td8">{{ $future->stock }}</li>
                                                   <!--  <li class="td9">{{ $future->price }}</li> -->
                                                    <li class="td10"><?php echo substr($future->delivery_date,0, 10) ?></li>
                                                    <!-- <li class="td11"></li> 
                                                    <li class="td12">{{ $future->days }}</li>-->
                                                </ul>
                                                @endforeach
                                                
                                            </li>
                                            <li class="td2w">
                                                <span class="green">签约完成</span>
                                            </li>
                                        </ul>
                                    </div>
                                </li>
                                @endif
                                @endforeach
                            </ul>
                        </div>
                    </div>
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
    <!-- 遮罩层-->
    <div id="zhezhao" style="display: none"></div>
    <!-- 点击签约中 的弹框-->
    <div class="SPqihuoBaodanKuang marok zhongK" style="display: none">
        <span class="tanhao"></span>
        <p class="tit">您已成为买家的供货方，请签约供货合同！</p>
        <div class="btns">
            <a href="javascript:;" class="back">返回</a>
            <a href="javascript:;" class="see">查看合同</a>
        </div>
    </div>
    <!-- 点击签约完成 的弹框-->
    <div class="SPqihuoBaodanKuang marok completeK" style="display: none">
        <span class="tanhao"></span>
        <p class="tit">您与买家已成功签约，请尽快发货！</p>
        <div class="btns">
            <a href="javascript:;" class="back">返回</a>
            <a href="javascript:;" class="see">查看合同</a>
        </div>
    </div>
    <!-- 点击查看合同 的弹框-->
    <div style="display: none" class="hetongKuang">
        <div class="top">
            <h2>销 售 合 同</h2>
            <h3>合同编号: GT-2015-C203130</h3>
            <p>供方：<b>山东鲁业钢铁销售有限公司</b></p>
            <p>需方：<b>天津钢商有限公司</b></p>
            <p>签订地点：天津市津南区北闸口镇俊凌路10号</p>
            <p>签订日期：<b>2016年06月05日</b></p>
            <p class="suo2">双方根据《中华人民共和国合同法》及相关法律法规的规定，为明确双方的权利义务关系，经友好协商，订立本合同，供双方遵守执行。</p>

            <h4>第一条 合同标的情况</h4>
            <p>（一） 供方向需方供应以下货物：</p>
            <div class="table">
                <ul class="thead clear">
                    <li class="td1">产品名称</li>
                    <li class="td2">执行标准</li>
                    <li class="td3">
                        <p>规格型号</p>
                        <p>（mm）</p>
                    </li>
                    <li class="td4">钢级/材质</li>
                    <li class="td5">
                        <p>长度</p>
                        <p>（米）</p>
                    </li>
                    <li class="td6">
                        <p>数量</p>
                        <p>（吨）</p>
                    </li>
                    <li class="td7">
                        <p>出厂含税单价</p>
                        <p>(元/吨)</p>
                    </li>
                    <li class="td8">
                        <p>金额</p>
                        <p>(元)</p>
                    </li>
                    <li class="td9">交货期</li>
                </ul>
                <div class="tbody">
                    <ul class="tr">
                        <li class="td1">管线管</li>
                        <li class="td2">API-5L（HIC实验合格，具体见技术协议）</li>
                        <li class="td3">114.3*6.02</li>
                        <li class="td4">BNS</li>
                        <li class="td5">12-12.5米</li>
                        <li class="td6">30</li>
                        <li class="td7">3600</li>
                        <li class="td8">108000</li>
                        <li class="td9">2015年5月5前</li>
                    </ul>
                    <ul class="tr">
                        <li class="tdall">
                            <p class="text333">运费价格：</p>
                            <p class="textindent">货物由<b>天津市军粮城房山镇45号</b>发出运至<b>上海东路233号</b></p>
                            <p class="textindent"><span>商家承诺的价格是：<b>50</b> 元/吨</span><span>运费小计：<b>1500</b> 元</span></p>
                            <p class="text333">工艺费用：</p>
                            <p class="textindent"><span>加工：<b>180</b> 元</span><span>苫盖：<b>360</b> 元</span></p>
                        </li>
                    </ul>
                    <ul class="tr">
                        <li class="tdall">
                            <p class="sum">合计（大写）：<b>壹拾壹万零伍佰肆拾元整</b>（小写：<b>110540.00</b>元）</p>
                        </li>
                    </ul>
                </div>
            </div>
            <p>合计人民币金额（大写）：柒仟贰佰叁拾圆整 （按实际提取的数量结算）</p>
            <p>（二）交货溢短装：交货数量按本合同约定货物数量的±5%的范围控制。</p>
            <p>（三）货物生产商为：黑龙江建龙钢铁销售有限公司。</p>

            <h4>第二条 货物的交付、运输、所有权及风险转移</h4>
            <p>（一）本合同所有货物最晚交货期为<b>2016年7月1日</b>，延期交货日违约金为合同总额<b>0.1%</b></p>
            <p>（二）货物交付地点：<b>***</b>，收货人：<b>***</b>，身份证号码：<b>23232500000000</b>，联系方式：<b>13812345666</b>，收货人要仔细核查货物的数量，并签收确认收货，签收后货物的所有权属需方，供方及运输车辆将对货物数量将不再负责；</p>
            <p>（三）货物运输费用由供/需方支付，供方代办运输。</p>

            <h4>第三条 货款结算</h4>
            <p>（一） 如供方未在交货期限内供货，结算单价将按第二条约定内容执行；</p>
            <p>（二） 需方按合同约定向第三方支付预付定金及剩余货款，交货完毕后三工作日内需方将收到此批货款余额，供方将收到全额货款。</p>

            <h4>第四条 违约责任</h4>
            <p>（一）共、需双方在合同生效后如单方取消合同，违约一方需赔偿另一方，赔偿金额为预付定金。</p>

            <h4>第五条 技术协议</h4>
            <p>上传附件</p>
            <p>备注：附件内容与合同其他条款同等法律效力，双方应遵守。</p>

            <h4>第六条 争议解决</h4>
            <p>（一）如共、需双方在产品质量上存在争议，可提交第三方检测机构判定；</p>
            <p>（二）如共、需双方在合同执行过程中发生争议，由双方协商解决，协商不成的，提交合同签订地的人民法院诉讼解决。</p>

            <h4>第七条 其他约定</h4>
            <p>（一）本合同双方确认后生成电子版合同文本，此文本具有法律效力；</p>
            <p>（二）<input type="text"/></p>

            <ul class="botqian clear mt50">
                <li>供方：天津华远兴业钢铁销售有限公司</li>
                <li>需方：天津钢商有限公司</li>
            </ul>
            <ul class="botqian clear">
                <li>代理人：</li>
                <li>代理人：</li>
            </ul>
        </div>
        <div class="bot">
            <a href="javascript:;" class="back">返回</a>
        </div>
    </div>

    <script>
        //点击tab
        $('.qihuobaodan > .content > .R .orderQihuo .tab li').on('click',function(){
            var index=$(this).index();
            $(this).addClass('on').siblings().removeClass('on');
            if(index==0){
                $('.qihuobaodan > .content > .R .orderQihuo .baodanList .all').show().siblings().hide();
            }else if(index==2){
                $('.qihuobaodan > .content > .R .orderQihuo .baodanList .zhong').show().siblings().hide();
            }else if(index==4){
                $('.qihuobaodan > .content > .R .orderQihuo .baodanList .complete').show().siblings().hide();
            }
        });

        //点击签约中
        $('.qihuobaodan > .content > .R .orderQihuo .baodanList .tbody .tr > .td2w .blue').on('click',function(){
            $('.zhongK').show();
            $('#zhezhao').show();
            $('html,body').css('overflow','hidden');//页面不允许滚动
        });
        //点击返回
        $('.zhongK .btns .back').on('click',function(){
            $('.zhongK').hide();
            $('#zhezhao').hide();
            $('html,body').css('overflow','auto');//页面允许滚动
        });
        //点击查看合同
        $('.zhongK .btns .see').on('click',function(){
            $('.zhongK').hide();
            $('.hetongKuang').show();
        });

        //点击签约完成
        $('.qihuobaodan > .content > .R .orderQihuo .baodanList .tbody .tr > .td2w .green').on('click',function(){
            $('.completeK').show();
            $('#zhezhao').show();
            $('html,body').css('overflow','hidden');//页面不允许滚动
        });
        //点击返回
        $('.completeK .btns .back').on('click',function(){
            $('.completeK').hide();
            $('#zhezhao').hide();
            $('html,body').css('overflow','auto');//页面允许滚动
        });
        //点击查看合同
        $('.completeK .btns .see').on('click',function(){
            $('.completeK').hide();
            $('.hetongKuang').show();
        });

        //点击合同框 返回
        $('.hetongKuang .bot a.back').on('click',function(){
            $('.hetongKuang').hide();
            $('#zhezhao').hide();
            $('html,body').css('overflow','auto');//页面允许滚动
        });
    </script>
    @endsection

@section('footer')
    @include('_layouts.shop_footer1')
@endsection
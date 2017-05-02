@extends('_layouts.shop')

@section('main-content')
    <!-- content-->
    <div class="meCenIndex_con mid_div min_w marok">
        {{--<div class="tit">
            <img src="/assets/shop/img/shangpu/sptit.jpg"/>
            <p class="line"></p>
        </div>--}}
        <div class="content clear" style="margin:0">
            {{--@include('_layouts.seller_left')  --}}
            <div class="R" style="width: 100%">
                <!-- 个人信息-->
                <div class="personInfo clear">
                    <a href="/seller/sellerinfo" class="set"><img src="/assets/shop/img/person/set.jpg"/></a>
                    <p class="headimg L" style="background-image: url({{$seller->logo_pic or '/assets/shop/img/shangpu/headimg.jpg'}})"></p>
                    <ul class="L one">
                        <li><b class="name">{{$seller->name}}</b></li>
                        <!-- <li>黑龙江建龙协议户：一级
                        </li> -->
                        <li>信誉等级：
                            <p class="xinyu">
                        	@if($seller->credit_degree>0)
                        		@for($i=1;$i<($seller->credit_degree+1);$i++)
                                <span class="ok"></span>
                                @endfor
                            @else
                            	暂无等级
                            @endif
                            </p>
                            
                        </li>
                        <li>我的公司：{{$seller->name}}</li>
                        {{--<li>收货地址：{{$seller->user->consignee}}</li>--}}
                    </ul>
                    <ul class="L two" style="display:none;">
                        <li class="sum">总销售额：<span><b>454676</b>吨</span></li>
                        <li>签约中：0</li>
                        <li>付款中：0</li>
                        <li>发货中：1</li>
                        <li>评价中：4</li>
                    </ul>
                </div>
                <!-- tab-->
                <div class="orderQihuo">
                    <ul class="tab clear">
                        <li class="on"><a href="javascript:;">公司简介</a></li>
                        <li class="line"></li>
                        <li><a href="javascript:;">经营范围</a></li>
                        <li class="line"></li>
                        <li><a href="javascript:;">证件</a></li>
                    </ul>
                    <!-- 公司简介-->
                    <div class="con clear one">
                        <img class="L" src="{{$seller->logo_pic or '/assets/shop/img/shangpu/adlou.jpg'}}" alt=""/>
                        <div class="R">
                        	{!! $seller->summary !!}
                            <!-- <p>天津华远兴业钢铁销售有限公司于2015年3月在天津滨海新区中心商务区注册成立。 主要经营：钢材、建材、金属材料等批发兼零售业务。公司有优越的采购途径及稳定的销售渠道,被山东墨龙评为“信誉单位”授予普管（20#钢）销售总代理、被黑龙江建龙授予华北地区普管销售代理单位。公司坚持以质量求生存、以诚信求发展为广大客户提供优质可靠的产品和全心全意的服务。一直以来受到广大客户的一致好评，欢迎莅临华远、选择华远，互利共赢！</p>
                            <p>我们尊崇“踏实、拼搏、责任”的企业精神，并以诚信、共赢、开创经营理念，创造良好的办公环境，以全新的管理模式，完善的技术，周到的服务，卓越的品质为生存根本，我们始终坚持用户至上 用心服务于客户，坚持用自己的服务去打动客户。欢迎各位来参观指导工作。</p>
                        	 -->
                        </div>
                    </div>
                    <!--经营范围-->
                    <div class="con clear two" style="display: none">
                        <img class="L" src="/assets/shop/img/shangpu/adlou.jpg" alt=""/>
                        <div class="R">
                        	<!--<span class="set"></span>-->
                            <ul>
                                <li class="clear">
                                    <p class="tit L">产品</p>
                                    <p class="text L">{{$seller->business_product}}</p>
                                </li>
                                <li class="clear">
                                    <p class="tit L">经营方式</p>
                                    <p class="text L">{{$jyfs}}</p>
                                </li>
                                <li class="clear">
                                    <p class="tit L">物流</p>
                                    <p class="text L">{{$wl}}</p>
                                </li>
                                <li class="clear">
                                    <p class="tit L">经营地区</p>
                                    <p class="text L">{{$seller->business_area}}</p>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!-- 证件-->
                    <div class="three con" style="display:none">
                        <ul class="line1 clear">
                            <li class="first z1">
                                <div class="imgbd">
                                    <img src="{{$seller->user->sellerAuthInfo->licence_path or ''}}" alt=""/>
                                </div>
                                <p class="name">营业执照</p>
                                <p class="btns">
                                    <!--<a href="javascript:;" class="modify">修改</a>-->
                                    <a href="javascript:;" class="see">查看</a>
                                </p>
                            </li>
                            <li class="z2">
                                <div class="imgbd">
                                    <img src="{{$seller->user->sellerAuthInfo->code_path or ''}}" alt=""/>
                                </div>
                                <p class="name">组织机构代码证</p>
                                <p class="btns">
                                    <!--<a href="javascript:;" class="modify">修改</a>-->
                                    <a href="javascript:;" class="see">查看</a>
                                </p>
                            </li>
                        </ul>
                        <ul class="line2 clear">
                            <li class="first z3">
                                <div class="imgbd">
                                    <img src="{{$seller->user->sellerAuthInfo->gong_path or ''}}" alt=""/>
                                </div>
                                <p class="name">公章</p>
                                <p class="btns">
                                    <!--<a href="javascript:;" class="modify">修改</a>-->
                                    <a href="javascript:;" class="see">查看</a>
                                </p>
                            </li>
                            <li class="z4">
                                <div class="imgbd">
                                    <img src="{{$seller->user->sellerAuthInfo->contract_path or ''}}" alt=""/>
                                </div>
                                <p class="name">合同章</p>
                                <p class="btns">
                                    <!--<a href="javascript:;" class="modify">修改</a>-->
                                    <a href="javascript:;" class="see">查看</a>
                                </p>
                            </li>
                            <li class="last">
                                <div class="imgbd">
                                    <img src="{{$seller->user->sellerAuthInfo->owner_path or ''}}" alt=""/>
                                </div>
                                <p class="name">法人章</p>
                                <p class="btns">
                                    <!--<a href="javascript:;" class="modify">修改</a>-->
                                    <a href="javascript:;" class="see">查看</a>
                                </p>
                            </li>
                        </ul>
                    </div>
                </div>
                <!-- ad-->
                {{--@include('_layouts.ads')--}}
            </div>
        </div>
    </div>
    <!-- 遮罩层-->
    <div id="zhezhao" style="display: none"></div>
    <!-- 证件 修改框-->
    <div class="SPcenterModifyZhengjian" style="display: none">
        <div class="tit">修改图片</div>
        <div class="con">
            <div class="upload clear">
                <div class="bd L"></div>
                <div class="input L">
                    <span>浏览</span>
                    <input type="file"/>
                </div>
            </div>
            <a href="javascript:;" class="back">返回</a>
            <a href="javascript:;" class="sure">确认修改</a>
        </div>
    </div>
    <!-- 查看大图片-->
    <div class="SPcenterBigImg" style="display: none;">
        <div class="top">
            <img src=""/>
        </div>
        <div class="bot">
            <a href="javascript:;" class="back">返回</a>
        </div>
    </div>
    
    <script type="text/javascript">
        $("#seller").addClass("on");
	    //点击tab的li
	    $('.meCenIndex_con > .content > .R .orderQihuo .tab li').on('click',function(){
	        if(this.className!='line'){
	            //0 2 4
	            var index=$(this).index();
	            $(this).addClass('on').siblings('.on').removeClass('on');
	            if(index==0){
	                $('.meCenIndex_con > .content > .R .orderQihuo .one').css('display','block');
	                $('.meCenIndex_con > .content > .R .orderQihuo .two').css('display','none');
	                $('.meCenIndex_con > .content > .R .orderQihuo .three').css('display','none');
	            }else if(index==2){
	                $('.meCenIndex_con > .content > .R .orderQihuo .one').css('display','none');
	                $('.meCenIndex_con > .content > .R .orderQihuo .two').css('display','block');
	                $('.meCenIndex_con > .content > .R .orderQihuo .three').css('display','none');
	            }else if(index==4){
	                $('.meCenIndex_con > .content > .R .orderQihuo .one').css('display','none');
	                $('.meCenIndex_con > .content > .R .orderQihuo .two').css('display','none');
	                $('.meCenIndex_con > .content > .R .orderQihuo .three').css('display','block');
	            }
	        }
	    });
		  //点击 证件 查看 把大图片弹出来
        $('.meCenIndex_con > .content > .R .orderQihuo .three p.btns a.see').on('click',function(){
            var src=$(this).parent().parent().find('.imgbd img').attr('src');
            $('.SPcenterBigImg .top img').attr('src',src);
            $('.SPcenterBigImg').scrollTop('0px');//滚动条在顶部
            $('#zhezhao').show();
            $('.SPcenterBigImg').show();
            $('html,body').css('overflow','hidden');
        });
        //点击 证件 查看大图 返回
        $('.SPcenterBigImg .bot .back').on('click',function(){
            $('#zhezhao').hide();
            $('.SPcenterBigImg').hide();
            $('html,body').css('overflow','auto');
        });
    </script>
@endsection

@section('footer')
    @include('_layouts.shop_footer2')
@endsection

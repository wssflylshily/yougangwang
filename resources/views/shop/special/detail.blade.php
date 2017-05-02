@extends('_layouts.shop')

@section('main-content')
		<!--<link rel="stylesheet" href="/assets/shop/css/weui.min.css"/>-->
		<!--<link rel="stylesheet" href="/assets/shop/css/jquery-weui.css"/>-->

    <!--<link rel="stylesheet" href="/assets/shop/css/person.css"/>-->

    <div class="mid_div index_div pro_detail" style="margin-bottom: 30px;">
		<form action="{{ route('shop.order.checknow.post') }}" method="post">
    	<div class="pro_company clear">
    		<div class="L img_div"><img style="width: 300px;" src="{{ $goods->seller->logo_pic or '/assets/shop/img/shangpu/cangku_03.png'}}"></div>
    		<div class="R font_div">
    			<h2>{{ $goods->seller->name or ''}} <span class="R">累计销量：<em>{{ $goods->sale_count or ''}}</em>吨</span></h2>
    			<div class="L" style="width: 678px;">
	    			<h3 class="com_star">
	    				<i>信用等级：</i>
						@if($goods->credit_degree>0)
						@for($i=0;$i<$goods->credit_degree;$i++)
	    				<span class="on"></span>
						@endfor
						@else
							暂无等级
						@endif
						{{--{{ $goods->credit_degree or ''}}--}}
	    				{{--<span class="on"></span>
	    				<span class="on"></span>
	    				<span class="on"></span>
	    				<span class="on"></span>--}}
	    			</h3>
	    			<div id="summary" style="margin-top: 10px; height: 48px; overflow: hidden;">
	    				{{--山东鲁业钢铁销售有限公司，坐落于洞山脚下，是一家集钢铁与贸易的达型有限公司，我们出口海内外。每年销售量达1000吨钢材。品种、规格齐全：有无缝管、焊接管、铺管、流体管、管线管等 ……--}}
						<?php /*echo mb_strlen($goods->seller->summary, 'utf-8') > 80 ? mb_substr($goods->seller->summary, 0, 80, 'utf-8').'....' : $goods->seller->summary; */?><!--

						<a href="javascript:" id="more">[更多]</a>-->
						{{ $goods->seller->summary or ''}}
	    			</div>
    			</div>
    			<div class="R" style="padding-top: 10px;">
    				<a href="javascript:;"><img src="/assets/shop/img/prodetail_09.png"></a>
    			</div>
    		</div>
    	</div>
    	<div class="com_button" style="text-align: right;">
    		<a href="javascript:;" class="btn add_carcar">加入购物车</a>
			<input type="hidden" name="buy_id" value="{{ $goods->id or ''}}" id="buy_id">
			<input type="hidden" name="buy_number" value="1">
			<input type="hidden" value="{{ csrf_token() }}" name="_token" >
    		{{--<a href="#" class="btn red">立即购买</a>--}}
			<input  class="R a01 red" type="submit" value="立即购买" >
    	</div>
		</form>
		<div class="lit_title">
			<a href="javascript:;" class="clear" style="background: none;"><img src="/assets/shop/img/lit2_10.png" class="img1 L"><span class="font1 L">产品介绍</span><span class="font2 L">Product introduction</span></a>
		</div>
		<div class="detail_font">
			<table class="tablea">
				<tr>
					<td width="50%">品名：{{ $goods->name or ''}}</td>
					<td>地区：{{ $goods->area_code or ''}}</td>
				</tr>
				<tr>
					<td>规格：141*69*12-12.3</td>
					<td>材质：{{ $goods->material or ''}}</td>
				</tr>
				<tr>
					<td>质量：30,000</td>
					<td>钢厂：{{ $goods->steelmill or ''}}</td>
				</tr>
				<tr>
					<td>仓库所在地：</td>
					<td>&nbsp;</td>
				</tr>
			</table>
		</div>
		<div class="detail_font">
			<p>{{ $goods->detail or ''}}</p>
		</div>
    </div>
		<!-- Toaster -->
		<script src="/plugins/jquery-toaster/jquery.toaster.js"></script>

		<!-- pages script -->
		<!--		<script src="/assets/base.js"></script>-->
		<script src="/assets/shop/js/pages/cart.js"></script>
    <script>
		$('#more').click(function () {
		    alert(111);
			$('#summary').html("{{ $goods->seller->summary or ''}}");
	    })
	    $(".add_carcar").click(function(){
	    	var str='<div class="weui_mask weui_mask_visible"></div>'
	    	+'<div class="weui_dialog weui_dialog_visible"><div class="weui_dialog_hd"><strong class="weui_dialog_title">输入数量</strong></div><div class="weui_dialog_bd"><input type="number" class="weui_input weui-prompt-input" id="weui-prompt-input" value="1"></div><div class="weui_dialog_ft"><a href="javascript:;" class="weui_btn_dialog default">取消</a><a href="javascript:;" class="weui_btn_dialog primary">确定</a></div></div>'
	    	$("body").append(str);

	    	$(".weui_dialog_visible .default").click(function(){
	    		$(".weui_mask,.weui_dialog").remove();
	    	});
	    	$(".weui_dialog_visible .primary").click(function(){
	    		//加入购物车操作
	    		var car_number=$("#weui-prompt-input").val();
	    		//console.log(car_number);

                //加入购物车
				var add_id="{{ Request::input('id') }}";
				var add_num=car_number

				 var cart = new Cart();
				 cart.add(add_id, add_num);

	    		$(".weui_mask,.weui_dialog").remove();
	    	});
	    })

	</script>
    <!-- footer-->
 @endsection

	@section('footer')
		<!--footer-->
		@include('_layouts.shop_footer2')
	@endsection

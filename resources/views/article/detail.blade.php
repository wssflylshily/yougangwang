@extends('_layouts.shop')
@section('main-content')
	<style>
		.page_h1{ color: #416ccb; font-size: 20px; margin: 20px 0px; padding-left: 20px; padding-top: 20px;}
		.page_font{ padding: 20px; font-size: 14px; color: #333333; padding-left: 40px; line-height: 30px; margin-bottom: 150px;}
		.page_font a{ color: #333333;}
		.page_font a:hover{color: #416ccc;}
	</style>
		<!-- content-->
	    <div class="meCenIndex_con mid_div min_w marok">
	        <div class="tit">
	            <img src="/assets/shop/img/gywm_03.png"/>
	            <p class="line"></p>
	        </div>
	        <div class="content clear">
				<ul class="L">
					<li @if($rs->type == 1) class="on" @endif><a href="{{ route('article.index', ['type' => 1]) }}">现货问题</a></li>
					<li @if($rs->type == 2) class="on" @endif><a href="{{ route('article.index', ['type' => 2]) }}">期货问题</a></li>
					<li @if($rs->type == 3) class="on" @endif><a href="{{ route('article.index', ['type' => 3]) }}">聚划算</a></li>
					<li @if($rs->type == 4) class="on" @endif><a href="{{ route('article.index', ['type' => 4]) }}">了解物流</a></li>
					<li @if($rs->type == 5) class="on" @endif><a href="{{ route('article.index', ['type' => 5]) }}">关于我们</a></li>
					<li @if($rs->type == 6) class="on" @endif><a href="{{ route('article.index', ['type' => 6]) }}">售后问题</a></li>
					<li @if($rs->type == 7) class="on" @endif><a href="{{ route('article.index', ['type' => 7]) }}">其他问题</a></li>
				</ul>
	            <div class="R">
	               <h1 class="page_h1">{{ $rs->title }}</h1>
	               <div class="page_font">
					   {!! $rs->content !!}
	               </div>
	            </div>
	        </div>
	    </div>
		<!-- footer-->
@endsection

@section('footer')
	<!--footer-->
	@include('_layouts.shop_footer1')
@endsection

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AdminLTE 2 | Dashboard</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="/plugins/bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="/assets/admin/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="/assets/admin/css/skins/_all-skins.min.css">
  <style>
    .sidebar-menu>li.divider,
    .sidebar-menu .treeview-menu>li.divider {
        height: 1px;
        margin: 1px 0;
        overflow: hidden;
        background-color: #1a2226;
    }

    .sidebar-menu .treeview-menu>li.divider {
        margin: 5px 10px;
        background-color: #35444c;
    }
    
    .contract{ width: 90%; line-height: 28px; margin: 0px auto; padding: 40px 0px;}
	.contract .text_span{ margin-right: 5px; display: inline-block; background: #ff0000; color: #FFFFFF; border-radius: 4px; padding: 0px 6px;}
	.contract h2{ font-family: '宋体'; font-weight: bold; text-align: center; font-size:30px; color: #333333;}
	.contract h3{ font-family: '宋体'; font-size: 16px; font-weight: bold; padding-top: 15px; padding-bottom: 8px;}
	.contract .ok_txt{ padding-top: 30px;}
	.contract .ok_txt .fontred{ color: #c81825;}
	.contract .table_txt{ width: 100%; margin: 20px 0px; border-collapse: collapse; line-height: 24px;}
	.contract .table_txt tr td,.contract .table_txt tr th{max-width: 0px; word-break:break-all; word-wrap:break-word; padding: 8px 4px; border: 1px solid #ddd;}
	.contract .table_txt tr th{ font-weight: normal; text-align: center;}
	.contract .table_txt tr td.td01{ padding: 15px 20px; line-height: 28px;}
	.contract .table_txt .alignc{ text-align: center;}
	.contract .write_div span{ display: inline-block; vertical-align: middle;}
	.contract .writ_div{ display: inline-block; border-bottom: 1px solid #a1a1a1; min-height: 24px; padding: 3px; margin: 0px 3px; outline: none; font: inherit; color: #c81825; line-height: 24px; font-size: 14px; vertical-align: top;}
	.contract .enclosure{ padding: 10px 0px;}
	.contract .enclosure ul{ padding: 0px; margin: 0px;}
	.contract .enclosure ul.clear:after{ clear: both; content: ""; display: block;}
	.contract .enclosure ul li{ list-style: none; padding: 0px; width: 105px; height: 105px; border: 1px solid #797979; float: left; margin: 5px 5px; float: left;}
	.contract .enclosure ul li img{width: 100%; height: 100%;}
	.contract .table_txta{ width: 100%; margin: 20px 0px;}
	.contract .table_txta tr td{ padding: 6px 3px; color: #333;}
	.contract .table_txta .zhang_re{ position: relative; padding: 50px 0px;}
	.contract .table_txta .zhang_re .zhang_img{ opacity: 0.8; position: absolute; left: 0px; top: 0px; bottom: 0px;}
  	.contract .table_txta .zhang_re .zhang_img img{ height: 100%;}
  	.contract em{ color: #FF0000; font-style: normal;}
  	.logistic_t{ margin: 0px 40px; padding: 10px 20px; border-bottom: 1px solid #dfdfdf; font-size: 14px; color: #666666; line-height: 30px;}
	.logistic_pass{ margin: 20px 80px; background: url(/assets/admin/img/wlstep_03.png) left center repeat-y; line-height: 33px;}
	.logistic_pass > div > div{ display: table-cell; padding-left: 32px; vertical-align: top;}
	.logistic_pass span{ display: table-cell; padding-right: 32px; vertical-align: top;}
	.logistic_pass > div{ padding-left: 54px;}
	.logistic_pass > div.first_wl{ background:url(/assets/admin/img/wlstep1_06.png) left top no-repeat;}
	.logistic_pass > div.final_wl{ background:url(/assets/admin/img/wlstep1_06.png) left bottom no-repeat;}
  	
  </style>
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  @include('admin._layouts.header')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        订单管理
        <small>订单详情</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> 首页</a></li>
        <li>期货订单</li>
        <li class="active">订单详情</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box box-info">
          	<div class="box-header">
              <div class="box-tools">
                  <div class="btn-group" style="margin-bottom: 5px;">
                  @if($order->status==-1)
				  <button type="button" class="btn btn-sm text-warning qdht-selected">签订合同</button>
				  @elseif($order->status==2)
                  <button type="button" class="btn btn-sm text-warning fsk-selected">付首款</button>
                  @elseif($order->status==3)
                  <button type="button" class="btn btn-sm text-warning fwk-selected">付尾款</button>
                  @elseif($order->status==4)
                  <button type="button" class="btn btn-sm text-warning fh-selected">发货</button>
                  <!-- <button type="button" class="btn btn-sm text-warning qhsc-selected">生产完成</button> -->
                  @elseif($order->status==5)
                  <button type="button" class="btn btn-sm text-warning sh-selected">收货</button>
                  @elseif($order->status==6)
                  <button type="button" class="btn btn-sm text-warning js-selected">结算</button>
                  @elseif($order->status==7)
                  <button type="button" class="btn btn-sm text-warning fpcl-selected">发票处理</button>
				  @else
					  <button type="button" class="btn btn-sm text-warning fpcl-selected">未知</button>
                  @endif
                  <button type="button" class="btn btn-sm text-warning ddwc-selected">订单完成</button>
                  </div>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive">
              <div class="contract">
              	<div>
              		@if($order->status==-1)
              		<span class="text_span">待签合同</span>
              		@elseif($order->status==2)
              		<span class="text_span">待付首款</span>
              		@elseif($order->status==3)
              		<span class="text_span">待付尾款</span>
              		@elseif($order->status==4)
              		<span class="text_span">待发货</span>
              		@elseif($order->status==5)
              		<span class="text_span">待收货</span>
              		@elseif($order->status==6)
              		<span class="text_span">待结算</span>
              		@elseif($order->status==7)
              		<span class="text_span">待处理发票</span>
              		@elseif($order->status==9)
              		<span class="text_span">待评价</span>
              		@elseif($order->status==99)
              		<span class="text_span">已完成</span>
              		@elseif($order->status==100)
              		<!-- <span class="text_span">待生产</span> -->
              		<span class="text_span">已取消</span>
              		@endif
              	</div>
              	
              	<table class="table_txt">
					<tr>
						<th>地区</th>
						<th>品种</th>
						<th>标准</th>
						<th>材质</th>
						<th>规格</th>
						<th>钢厂</th>
						<th>允差</th>
						<th>价格</th>
						<th>吨数</th>
					</tr>
					@foreach($order->futures as $future)
					<tr class="fontred alignc">
						<td>{{$future->area or '全部'}}</td>
						<td>{{$future->variety or '全部'}}</td>
						<td>{{$future->standard or '全部'}}</td>
						<td>{{$future->material or '全部'}}</td>
						<td>
							@if($future->length_type==1){{ $future->outer_diameter }}*{{ $future->thickness }}*{{ $future->length*100 }}~{{ $future->outer_diameter }}*{{ $future->thickness }}*{{ $future->max_length*100 }}@else{{ $future->outer_diameter }}*{{ $future->thickness }}*{{ $future->length*100 }}@endif
						</td>
						<td>{{$future->steelmill or '全部'}}</td>
						<td>{{$future->deviation or ''}}%</td>
						<td>{{$future->offer->unit_price or ''}}元/吨</td>
						<td><em>{{$future->stock or ''}}{{$future->unit or ''}}</em></td>
					</tr>
					@endforeach
					<tr>
						<td colspan="4">工艺：{{$order->technology or '无'}}</td>
						<td colspan="5">工艺费用：<em>@if($order->contract){{ $order->contract->processing_price or 0}}+{{  $order->contract->fangfu_price or 0}}+ {{ $order->contract->shangai_price or 0}}@endif</em></td>
					</tr>
					<tr>
						<td colspan="4">物流方式：@if($order->receive_type==1)用户自提@else商家承担@endif</td>
						<td colspan="5">物流费用：<em>{{$order->postsge or ''}}</em></td>
					</tr>
					<tr>
						<td colspan="3">总金额：<em>{{$order->order_amount or ''}}</em></td>
						<td colspan="3">预付款：<em>{{$order->order_amount*0.2}}</em></td>
						<td colspan="3">尾款：<em>{{$order->order_amount*0.8}}</em></td>
					</tr>
					<tr>
						<td colspan="9">交货日期：<em>@if($order->contract){{$order->contract->deadline or ''}}@endif</em></td>
					</tr>
				</table>
              	
				<div class="logistic_t">
					<!-- <p><span>物流单号： 415588065529</span><span style="margin-left: 200px;"> 物流公司： 中通快递 </span><span style="margin-left: 200px;">客服电话： 95311</span></p> -->
					<p>商家名称： {{$order->seller->name or ''}}</p>
					<p>发货地址：{{$order->contract->from_address or ''}}</p>
					<p>收货地址：{{$order->address or ''}}&nbsp;&nbsp; {{$order->zip_code or ''}}&nbsp;&nbsp; {{$order->linkman or ''}} &nbsp;&nbsp;{{$order->mobile or ''}}</p>
				</div>
				@if($order->logistics)
				<div class="logistic_pass">
					@for($i=0;$i<count($order->logistics);$i++)
					<div class="first_wl">
						<div><?php echo date('Y年m月d日',strtotime($order->logistics[$i]->created_at)); ?></div>
						<div>
							<div>
								<span><?php echo date('H:i',strtotime($order->logistics[$i]->created_at)); ?></span>
								<span>{{$order->logistics[$i]->message}}</span>
							</div>
						</div>
					</div>
					@endfor
					
				</div>
				<div style="text-align: right; padding: 20px;">
					以上信息由第三方物流公司提供，如需查询详情请<a href="#">联系客服</a>
				</div>
				
				@endif
			  </div>
            </div>
            <!-- /.box-body -->
            
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <strong>Copyright &copy; 2016 <a href="#">YouGang</a>.</strong> All rights
    reserved.
  </footer>
</div>
<!-- ./wrapper -->

<!-- jQuery 2.2.3 -->
<script src="/plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.6 资料查看/退出-->
<script src="/plugins/bootstrap/js/bootstrap.min.js"></script>
<!-- AdminLTE App 适应-->
<script src="/assets/admin/js/app.min.js"></script>
<!-- page script 全选-->
<!--<script src="/assets/base.js"></script>-->
<!--<script src="/assets/admin/js/product.js"></script>-->
<!-- Page script -->
<script>
  $(function () {
    //qdht
		$(document).on("click",".qdht-selected",function(){
			
		    if (!confirm('您确定要签订合同吗？')) {
		    	location.href = "{{route('seller.futures.changeStatus',['order_id'=>$order->id,'status'=>2])}}";
		        return;
		    }
	    //订单签订合同操作
	    
		});
		//fsk
		$(document).on("click",".fsk-selected",function(){
		
		    if (!confirm('您确定订单已付首款吗？')) {
		    	location.href = "{{route('seller.futures.changeStatus',['order_id'=>$order->id,'status'=>3])}}";
		        return;
		    }
	    //订单付款操作
	    
		});
		//fwk
		$(document).on("click",".fwk-selected",function(){
		
		    if (!confirm('您确定订单已付尾款吗？')) {
		    	location.href = "{{route('seller.futures.changeStatus',['order_id'=>$order->id,'status'=>4])}}";
		        return;
		    }
	    //订单付款操作
	    
		});
		//sh
		$(document).on("click",".fh-selected",function(){
			
		    if (!confirm('您确定已发货？')) {
		    	location.href = "{{route('seller.futures.changeStatus',['order_id'=>$order->id,'status'=>5])}}";
		        return;
		    }
		});
		//sh
		$(document).on("click",".sh-selected",function(){
			
		    if (!confirm('您确定已收货？')) {
		    	location.href = "{{route('seller.futures.changeStatus',['order_id'=>$order->id,'status'=>6])}}";
		        return;
		    }
	    //订单收货操作
	    
		});
		//qhsc
		$(document).on("click",".qhsc-selected",function(){
		
	    if (!confirm('您确定订单已生产完成？')) {
	        return;
	    }
	    //订单结算操作
	    
		});

		//js
		$(document).on("click",".js-selected",function(){
			
		    if (!confirm('您确定已结算？')) {
		    	location.href = "{{route('seller.futures.changeStatus',['order_id'=>$order->id,'status'=>7])}}";
		        return;
		    }
		});
		//fpcl
		$(document).on("click",".fpcl-selected",function(){
		
		    if (!confirm('您确定订单发票已处理完成？')) {
		    	location.href = "{{route('seller.futures.changeStatus',['order_id'=>$order->id,'status'=>9])}}";
		        return;
		    }
	    //订单发票处理操作
	    
		});
		//ddwc
		$(document).on("click",".ddwc-selected",function(){
		
		    if (!confirm('您确定订单已完成？')) {
		    	location.href = "{{route('seller.futures.changeStatus',['order_id'=>$order->id,'status'=>99])}}";
		        return;
		    }
	    //订单确认完成操作
	    
		})
		})
    
  });
</script>
</body>
</html>

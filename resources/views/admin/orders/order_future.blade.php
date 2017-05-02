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
  <!-- bootstrap datepicker -->
  <link rel="stylesheet" href="/plugins/datepicker/datepicker3.css">
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
    .select_div > *{ display: inline-block; margin: 5px 3px;}
    .select_div select{border: 1px solid #e0e0e0; padding: 6px 10px;
 color: #999999; color: #333;}
 	.select_div input{padding: 7px 10px; border: 1px solid #e0e0e0; background: #fff;}
  </style>
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
    @include('admin._layouts.header')
{{--  <header class="main-header">
    <!-- Logo -->
    <a href="/admin" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>后台</b></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg text-left"><b>优钢（管理后台）</b></span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="/assets/admin/img/user2-160x160.jpg" class="user-image" alt="User Image">
              <span class="hidden-xs">Alexander Pierce</span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="/assets/admin/img/user2-160x160.jpg" class="img-circle" alt="User Image">

                <p>超级管理员</p>
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="#" class="btn btn-default btn-flat">资料</a>
                </div>
                <div class="pull-right">
                  <a href="#" class="btn btn-default btn-flat">退出</a>
                </div>
              </li>
            </ul>
          </li>
        </ul>
      </div>
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="/assets/admin/img/user2-160x160.jpg" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p style="line-height: 36px;">您好，管理员</p>
        </div>
      </div>
      <!-- sidebar menu: : style can be found in sidebar.less -->
     --}}{{-- <ul class="sidebar-menu">
        <li class="header"><!--主导航--></li>
        <li>
          <a href="#">
            <i class="fa fa-dashboard"></i> <span>后台首页</span>
            <span class="pull-right-container">
            </span>
          </a>
        </li>

        <li class="divider"></li>

        <li class="treeview">
          <a href="javascript:;">
            <i class="fa fa-files-o"></i>
            <span>会员管理</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="index.html"><i class="fa fa-circle-o"></i> 商家会员</a></li>
            <li><a href="user_manage.html"><i class="fa fa-circle-o"></i>注册会员</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="javascript:;">
            <i class="fa fa-files-o"></i>
            <span>商品管理</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="product_now.html"><i class="fa fa-circle-o"></i> 现货管理</a></li>
            <li><a href="product_future.html"><i class="fa fa-circle-o"></i> 期货管理</a></li>
            <li><a href="product_hotsale.html"><i class="fa fa-circle-o"></i> 特卖管理</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="javascript:;">
            <i class="fa fa-files-o"></i>
            <span>合同管理</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="contract_list.html"><i class="fa fa-circle-o"></i> 合同列表</a></li>
          </ul>
        </li>

        <li class="divider"></li>

        <li class="treeview">
          <a href="javascript:;">
            <i class="fa fa-files-o"></i>
            <span>订单管理</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="order_now.html"><i class="fa fa-circle-o"></i> 现货订单</a></li>
            <li><a href="order_future.html"><i class="fa fa-circle-o"></i> 期货订单</a></li>
            <li><a href="order_hotsale.html"><i class="fa fa-circle-o"></i> 特卖订单</a></li>
          </ul>
        </li>
        <li class="treeview">
        	<a href="javascript:;">
        		<i class="fa fa-book"></i>
        		<span>网站设置</span>
        		<span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
        	</a>
        	<ul class="treeview-menu">
            <li><a href="article_list.html"><i class="fa fa-circle-o"></i> 现货文章</a></li>
            <li><a href="article_list.html"><i class="fa fa-circle-o"></i> 期货文章</a></li>
            <li><a href="article_list.html"><i class="fa fa-circle-o"></i> 聚划算</a></li>
          	<li><a href="article_list.html"><i class="fa fa-circle-o"></i> 了解物流</a></li>
        		<li><a href="article_list.html"><i class="fa fa-circle-o"></i> 关于我们</a></li>
        		<li><a href="article_list.html"><i class="fa fa-circle-o"></i> 其他文章</a></li>
        	</ul>
        </li>
        <li class="treeview">
        	<a href="javascript:;">
        		<i class="fa fa-book"></i>
        		<span>基本信息</span>
        		<span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
        	</a>
        	<ul class="treeview-menu">
        		<li><a href="bannermanage.html"><i class="fa fa-circle-o"></i> banner管理</a></li>
            <li><a href="website_city.html"><i class="fa fa-circle-o"></i> 城市管理</a></li>
            <li><a href="website_steel.html"><i class="fa fa-circle-o"></i> 钢铁信息</a></li>
            <li><a href="website_footer.html"><i class="fa fa-circle-o"></i> 底部信息</a></li>
        	</ul>
        </li>
      </ul>--}}{{--

      <ul class="sidebar-menu">
        <li class="header"><!--主导航--></li>
        <li>
          <a href="/admin">
            <i class="fa fa-dashboard"></i> <span>后台首页</span>
            <span class="pull-right-container">
            </span>
          </a>
        </li>

        <li class="divider"></li>

        <li class="treeview">
          <a href="javascript:;">
            <i class="fa fa-files-o"></i>
            <span>会员管理</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="/admin/seller"><i class="fa fa-circle-o"></i> 商家会员</a></li>
            <li><a href="/admin/user"><i class="fa fa-circle-o"></i> 注册会员</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="javascript:;">
            <i class="fa fa-files-o"></i>
            <span>商品管理</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="/admin/stock"><i class="fa fa-circle-o"></i> 现货管理</a></li>
            <li><a href="/admin/future"><i class="fa fa-circle-o"></i> 期货管理</a></li>
            <li><a href="/admin/hot"><i class="fa fa-circle-o"></i> 特卖管理</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="javascript:;">
            <i class="fa fa-files-o"></i>
            <span>合同管理</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="/admin/contract"><i class="fa fa-circle-o"></i> 合同列表</a></li>
          </ul>
        </li>

        <li class="divider"></li>

        <li class="treeview">
          <a href="javascript:;">
            <i class="fa fa-files-o"></i>
            <span>订单管理</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">

            <li><a href="/admin/order"><i class="fa fa-circle-o"></i> 现货订单</a></li>
            <li><a href="{{URL::route('admin.order.future')}}"><i class="fa fa-circle-o"></i> 期货订单</a></li>
            --}}{{--<li><a href="order_hotsale.html"><i class="fa fa-circle-o"></i> 特卖订单</a></li>--}}{{--
          </ul>
        </li>
        <li class="treeview">
          <a href="javascript:;">
            <i class="fa fa-book"></i>
            <span>网站设置</span>
        		<span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
              <li><a href="article_list.html"><i class="fa fa-circle-o"></i> 现货文章</a></li>
              <li><a href="article_list.html"><i class="fa fa-circle-o"></i> 期货文章</a></li>
              <li><a href="article_list.html"><i class="fa fa-circle-o"></i> 聚划算</a></li>
              <li><a href="article_list.html"><i class="fa fa-circle-o"></i> 了解物流</a></li>
              <li><a href="article_list.html"><i class="fa fa-circle-o"></i> 联系我们</a></li>
              <li><a href="article_list.html"><i class="fa fa-circle-o"></i> 其他文章</a></li>
              <li><a href="article_list.html"><i class="fa fa-circle-o"></i> 关于我们</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="javascript:;">
            <i class="fa fa-book"></i>
            <span>基本信息</span>
        		<span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="/admin/banner"><i class="fa fa-circle-o"></i> banner管理</a></li>
            <li><a href="website_city.html"><i class="fa fa-circle-o"></i> 城市管理</a></li>
            <li><a href="website_steel.html"><i class="fa fa-circle-o"></i> 钢铁信息</a></li>
            <li><a href="website_footer.html"><i class="fa fa-circle-o"></i> 底部信息</a></li>
          </ul>
        </li>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>--}}

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        订单管理
        <small>期货订单</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="/admin"><i class="fa fa-dashboard"></i> 首页</a></li>
        <li>订单管理</li>
        <li class="active">期货订单</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Default box -->
      <div class="box collapsed-box">
        <div class="box-header with-border">
          <h3 class="box-title"><a href="javascript:history.back();"><i class="fa fa-reply"></i></a> ｜条件筛选</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="收展">
              <i class="fa fa-plus"></i></button>
          </div>
        </div>
        <!-- form start -->
        <form class="form-horizontal">
          <div class="box-body">
          	<div class="select_div">
          	<div>订单号</div>
          	<div><input type="text" name="search_ddh" placeholder="订单号" value="{{Request()->search_ddh}}"></div>
          	<div>订单状态</div>
          	<div><select name="search_zt">
                    <option value="" >全部</option>
                    <option value="-1" @if(Request()->search_zt==-1) selected="selected" @endif>待签约</option>
                    <option value="2" @if(Request()->search_zt==2) selected="selected" @endif>代付首款</option>
                    <option value="3" @if(Request()->search_zt==3) selected="selected" @endif>代付尾款</option>
                    <option value="4" @if(Request()->search_zt==4) selected="selected" @endif>代发货</option>
                    <option value="5" @if(Request()->search_zt==5) selected="selected" @endif>代收货</option>
                    <option value="6" @if(Request()->search_zt==6) selected="selected" @endif>待结算</option>
                    <option value="7" @if(Request()->search_zt==7) selected="selected" @endif>代开票</option>
                    <option value="8" @if(Request()->search_zt==8) selected="selected" @endif>已开发票</option>
                    <option value="9" @if(Request()->search_zt==9) selected="selected" @endif>待评价</option>
                    <option value="99" @if(Request()->search_zt==99) selected="selected" @endif>交易完成(售后处理中)</option>
                    <option value="100" @if(Request()->search_zt==100) selected="selected" @endif>已取消</option>
          	</select></div>
          	{{--<div>物流号</div>
          	<div><input type="text" name="search_wlh" placeholder="物流号"></div>--}}
							<div>下单时间</div>
							<div>
								<input type="text" name="search_datestart" id="reservation_start" placeholder="选择日期" value="{{Request()->search_datestart}}">
							</div>
							<div class="div1">-</div>
							<div>
								<input type="text" name="search_dateend" id="reservation_end" placeholder="选择日期" value="{{Request()->search_dateend}}">
							</div>
						</div>
          </div>  
          
          <!-- /.box-body -->
          <div class="box-footer">
            <button type="submit" class="btn btn-primary pull-right"><i class="fa fa-search"></i> 搜索</button>
          </div>
          <!-- /.box-footer -->
        </form>
      </div>
      <!-- /.box -->

      <div class="row">
        <div class="col-xs-12">
          <div class="box box-info">
            <div class="box-header">
              <h3 class="box-title">订单一览</h3>

              {{--<div class="box-tools">
                  <div class="btn-group" style="margin-bottom: 5px;">
					<button type="button" class="btn btn-sm text-warning qdht-selected">签订合同</button>
                  <button type="button" class="btn btn-sm text-warning fk-selected">付款</button>
                  <button type="button" class="btn btn-sm text-warning qhsc-selected">生产完成</button>
                  <button type="button" class="btn btn-sm text-warning sh-selected">收货</button>
                  <button type="button" class="btn btn-sm text-warning fpcl-selected">发票处理</button>
                  <button type="button" class="btn btn-sm text-warning ddwc-selected">订单完成</button>
                  </div>
              </div>--}}
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive">
              <table class="table table-bordered table-hover">
                <thead style="background-color: #ddd;">
                  <tr>
                    <th width="30"><input type="checkbox"></th>
                    <th>订单编号</th>
                    <th>下单用户</th>
                    <th>总金额</th>
                    <!-- <th>允差</th> -->
                    <th>预付款</th>
                    <th>尾款</th>
                    <th>下单时间</th>
                    <!-- <th>报价时间</th> -->
                    <th>状态</th>
                    <th width="210">操作</th>
                  </tr>
                </thead>
                <tbody>
                @foreach($orders_list as $orders)
                  <tr>
                    <td><input type="checkbox" name="order_id[]" value="{{$orders->id}}"></td>
                    <td>{{$orders->order_sn}}</td>
                    <td>{{$orders->name}}</td>
                    <td>{{$orders->order_amount}}</td>
                    <!-- <td>2%</td> -->
                    <td>{{$orders->order_amount*0.2}} {{--$orders->paid_amount--}}</td>
                    <td>{{$orders->order_amount*0.8}}<?php //echo($orders->order_amount-$orders->paid_amount)?></td>
                    <td>{{$orders->created_at}}</td>
                    <!-- <td>{{$orders->futime}}</td> -->
                    <td>
                      @if($orders->status==0)
                      	<span class="label label-danger">等待商家接单</span>
                      @elseif($orders->status == -1)
                        <span class="label label-danger">待签合同</span>
                      @elseif($orders->status == 1)
                        <span class="label label-danger">待付款</span>
                      @elseif($orders->status == 2)
                        <span class="label label-danger">待付首款</span>
                      @elseif($orders->status == 3)
                        <span class="label label-danger">待付尾款</span>
                      @elseif($orders->status == 4)
                        <span class="label label-danger">待发货</span>
                      @elseif($orders->status == 5)
                        <span class="label label-default">待收货</span>
                      @elseif($orders->status == 6)
                        <span class="label label-danger">待结算</span>
                      @elseif($orders->status == 7)
                        <span class="label label-dafault">待开发票</span>
                      @elseif($orders->status == 8)
                        <span class="label label-default">已开发票</span>
                      @elseif($orders->status == 9)
                        <span class="label label-default">待评价</span>
                      @elseif($orders->status == 99)
                        <span class="label label-success">交易完成</span>
                      @endif
                    </td>
                    <td>
                      <a href="{{route('admin.order.fut.detail',['order_id'=>$orders->id])}}" class="btn btn-xs btn-default">
                        查看详情
                      </a>
                      {{--<a href="contract_detail.html" class="btn btn-xs btn-default">
                        查看合同
                      </a>
                      @if($orders->status==99)
                        <a href="evaluate_edit.html" class="btn btn-xs btn-default">
                          查看评价
                        </a>
                      @endif
                    </td>--}}
                  </tr>
                @endforeach
                  {{--<tr>
                    <td><input type="checkbox" name="order_id[]" value="1"></td>
                    <td>2602065004365800</td>
                    <td>用户1</td>
                    <td>10000</td>
                    <td>2%</td>
                    <td>5000</td>
                    <td>5000</td>
                    <td>2602065004365800</td>
                    <td>
                        <span class="label label-danger">待签合同</span>
                    </td>
                    <td>
                        <a href="orderfuture_detail.html" class="btn btn-xs btn-default">
                           查看详情
                        </a>
                        <a href="contract_detail.html" class="btn btn-xs btn-default">
                           查看合同
                        </a>
                    </td>
                  </tr>
                  <tr>
                    <td><input type="checkbox" name="order_id[]" value="1"></td>
                    <td>2602065004365800</td>
                    <td>用户1</td>
                    <td>10000</td>
                    <td>2%</td>
                    <td>5000</td>
                    <td>5000</td>
                    <td>2602065004365800</td>
                    <td>
                        <span class="label label-danger">待付款</span>
                    </td>
                    <td>
                        <a href="orderfuture_detail.html" class="btn btn-xs btn-default">
                           查看详情
                        </a>
                        <a href="contract_detail.html" class="btn btn-xs btn-default">
                           查看合同
                        </a>
                    </td>
                  </tr>
                  <tr>
                    <td><input type="checkbox" name="order_id[]" value="1"></td>
                    <td>2602065004365800</td>
                    <td>用户1</td>
                    <td>10000</td>
                    <td>2%</td>
                    <td>5000</td>
                    <td>5000</td>
                    <td>2602065004365800</td>
                    <td>
                        <span class="label label-danger">待收货</span>
                    </td>
                    <td>
                        <a href="orderfuture_detail.html" class="btn btn-xs btn-default">
                           查看详情
                        </a>
                        <a href="contract_detail.html" class="btn btn-xs btn-default">
                           查看合同
                        </a>
                    </td>
                  </tr>
                  <tr>
                    <td><input type="checkbox" name="order_id[]" value="1"></td>
                    <td>2602065004365800</td>
                    <td>用户1</td>
                    <td>10000</td>
                    <td>2%</td>
                    <td>5000</td>
                    <td>5000</td>
                    <td>2602065004365800</td>
                    <td>
                        <span class="label label-success">完成</span>
                    </td>
                    <td>
                        <a href="orderfuture_detail.html" class="btn btn-xs btn-default">
                           查看详情
                        </a>
                        <a href="contract_detail.html" class="btn btn-xs btn-default">
                           查看合同
                        </a>
                        
                         <a href="evaluate_edit.html" class="btn btn-xs btn-default">
                           查看评价
                        </a>
                    </td>
                  </tr>--}}
                </tbody>
              </table>
            </div>
            <!-- /.box-body -->
            <div class="box-footer clearfix" style="border: none;">
              {{--{!! page_render($orders_list) !!}--}}
                {!! $orders_list->appends(Request::query())->render() !!}
            </div>
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
<div id="hidden-items" style="display: none;">
    <input type="hidden" name="_token" value="{{ csrf_token() }}" id="csrfToken">
</div><!-- /#hidden-items -->
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
<script src="/assets/base.js"></script>
<!--<script src="/assets/admin/js/order.js"></script>-->
<!-- Page script -->
<!-- bootstrap datepicker -->
<script src="/plugins/datepicker/bootstrap-datepicker.js"></script>

{{--ajax js文件--}}
<script src="/plugins/jquery-toaster/jquery.toaster.js"></script>
<!-- pages script -->
<script src="/plugins/jquery-form/jquery.form.min.js"></script>
<script src="/assets/base.js"></script>
<!-- Page script -->
<script>
	
  $(function () {
  	//Date range picker
  	$('#reservation_start').datepicker({
      autoclose: true
    });
    $('#reservation_end').datepicker({
      autoclose: true
    });
    // 全部勾选
    $('thead input[type="checkbox"]').on('click', function() {
        var status = $(this).prop('checked');

        // 设置该仓库下的所有
        $(this).closest('table').find('tbody input[type="checkbox"]').prop('checked', status);
    });

    // 选择商品
    $('tbody input[type="checkbox"]').on('click', function() {
        // 计算选中数，勾选仓库
        var total = $('tbody input[type="checkbox"]').size();
        var checked = $('tbody input:checked[type="checkbox"]').size();

        // 改变全选
        if (checked === total) {
            $('thead input[type="checkbox"]').prop('checked', true);
        }
        else {
            $('thead input[type="checkbox"]').prop('checked', false);
        }
    });
		
		//qdht
		$(document).on("click",".qdht-selected",function(){
			var selected = [];
	    $('input:checked[name="order_id[]"]').each(function() {
	        selected.push($(this).val());
	    });
	
	    if (selected.length < 1) {
	        alert('您没有选中操作的订单');
	        return;
	    }
	    if (!confirm('您确定要签订合同吗？')) {
	        return;
	    }
	    //订单签订合同操作
	    
		});
		//fk
		$(document).on("click",".fk-selected",function(){
			var selected = [];
	    $('input:checked[name="order_id[]"]').each(function() {
	        selected.push($(this).val());
	    });
	
	    if (selected.length < 1) {
	        alert('您没有选中操作的订单');
	        return;
	    }
	    if (!confirm('您确定订单已付款吗？')) {
	        return;
	    }
	    //订单付款操作
	    
		});
		//sh
		$(document).on("click",".sh-selected",function(){
			var selected = [];
	    $('input:checked[name="order_id[]"]').each(function() {
	        selected.push($(this).val());
	    });
	
	    if (selected.length < 1) {
	        alert('您没有选中操作的订单');
	        return;
	    }
	    if (!confirm('您确定已收货？')) {
	        return;
	    }
	    //订单收货操作
	    
		});
		//qhsc
		$(document).on("click",".qhsc-selected",function(){
			var selected = [];
	    $('input:checked[name="order_id[]"]').each(function() {
	        selected.push($(this).val());
	    });
	
	    if (selected.length < 1) {
	        alert('您没有选中操作的订单');
	        return;
	    }
	    if (!confirm('您确定订单已生产完成？')) {
	        return;
	    }
	    //订单结算操作
	    
		});
		//fpcl
		$(document).on("click",".fpcl-selected",function(){
			var selected = [];
	    $('input:checked[name="order_id[]"]').each(function() {
	        selected.push($(this).val());
	    });
	
	    if (selected.length < 1) {
	        alert('您没有选中操作的订单');
	        return;
	    }
	    if (!confirm('您确定订单发票已处理完成？')) {
	        return;
	    }
	    //订单发票处理操作
	    
		});
		//ddwc
		$(document).on("click",".ddwc-selected",function(){
			var selected = [];
	    $('input:checked[name="order_id[]"]').each(function() {
	        selected.push($(this).val());
	    });
	
	    if (selected.length < 1) {
	        alert('您没有选中操作的订单');
	        return;
	    }
	    if (!confirm('您确定订单已完成？')) {
	        return;
	    }
	    //订单确认完成操作
	    
		})
		
  });
</script>
</body>
</html>

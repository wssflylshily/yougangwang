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
  </style>
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <header class="main-header">
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
      {{--<ul class="sidebar-menu">
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
            <li><a href="user_manage.html"><i class="fa fa-circle-o"></i> 注册会员</a></li>
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
      </ul>--}}

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
            {{--<li><a href="order_hotsale.html"><i class="fa fa-circle-o"></i> 特卖订单</a></li>--}}
          </ul>
        </li>
        {{--<li class="treeview">
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
        </li>--}}
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
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        合同管理
        <small>合同列表</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="/admin"><i class="fa fa-dashboard"></i> 首页</a></li>
        <li class="active">合同列表</li>
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
            <div class="form-group">
              <label for="inputName" class="col-sm-2 control-label">订单编号</label>

              <div class="col-sm-10">
                <input type="text" class="form-control" id="inputName" placeholder="订单编号">
              </div>
            </div>
            <div class="form-group">
              <label for="inputTel" class="col-sm-2 control-label">合同编号</label>

              <div class="col-sm-10">
                <input type="text" class="form-control" id="inputTel" placeholder="合同编号">
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
              <h3 class="box-title">合同一览</h3>

              <!--<div class="box-tools">
                  <div class="btn-group" style="margin-bottom: 5px;">
					<button type="button" class="btn btn-sm text-warning start-selected"><i class="fa fa-archive"></i> 启用</button>
					<button type="button" class="btn btn-sm text-warning end-selected"><i class="fa fa-archive"></i> 禁用</button>
					<button type="button" class="btn btn-sm text-success" onclick="javascript:location.href='#';"><i class="fa fa-plus"></i> 新增</button>
					<button type="button" class="btn btn-sm text-success time-back"> 按时间倒叙</button>
                    <button type="button" class="btn btn-sm text-danger delete-selected"><i class="fa fa-trash"></i> 删除</button>
                    
                  </div>
              </div>-->
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive">
              <table class="table table-bordered table-hover">
                <thead style="background-color: #ddd;">
                  <tr>
                    <th width="30"><input type="checkbox"></th>
                    <th>订单编号</th>
                    <th>合同编号</th>
                    <th>创建时间</th>
                    {{--<th>初审时间</th>
                    <th>复核时间</th>--}}
                    <th>买家名称</th>
                    <th>卖家名称</th>
                    <th>状态</th>
                    <th>金额</th>
                    <th width="100">操作</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($contract_list as $contract)
                  @endforeach
                  <tr>
                    <td><input type="checkbox" name="user_id[]" value="1"></td>
                    <td>2602065004365800</td>
                    <td>GDB2345346</td>
                    <td>2016-06-17</td>
                    <td>方先生</td>
                    <td>钢厂</td>
                    <td>
                      <span class="label label-danger">买家有疑义</span>
                    </td>
                    <td>20580</td>
                    <td>
                      <a href="contract_detail.html" class="btn btn-xs btn-default">
                        查看详情
                      </a>
                    </td>
                  </tr>
                 {{-- <tr>
                    <td><input type="checkbox" name="user_id[]" value="1"></td>
                    <td>2602065004365800</td>
                    <td>GDB2345346</td>
                    <td>2016-06-17</td>
                    <td>2016-06-17</td>
                    <td>2016-06-17</td>
                    <td>方先生</td>
                    <td>钢厂</td>
                    <td>
                        <span class="label label-danger">买家有疑义</span>
                    </td>
                    <td>20580</td>
                    <td>
                        <a href="contract_detail.html" class="btn btn-xs btn-default">
                           查看详情
                        </a>
                    </td>
                  </tr>
                  <tr>
                    <td><input type="checkbox" name="user_id[]" value="1"></td>
                    <td>2602065004365800</td>
                    <td>GDB2345346</td>
                    <td>2016-06-17</td>
                    <td>2016-06-17</td>
                    <td>2016-06-17</td>
                    <td>方先生</td>
                    <td>钢厂</td>
                    <td>
                        <span class="label label-danger">买家有疑义</span>
                    </td>
                    <td>20580</td>
                    <td>
                        <a href="contract_detail.html" class="btn btn-xs btn-default">
                           查看详情
                        </a>
                    </td>
                  </tr>
                  <tr>
                    <td><input type="checkbox" name="user_id[]" value="1"></td>
                    <td>2602065004365800</td>
                    <td>GDB2345346</td>
                    <td>2016-06-17</td>
                    <td>2016-06-17</td>
                    <td>2016-06-17</td>
                    <td>方先生</td>
                    <td>钢厂</td>
                    <td>
                        <span class="label label-danger">买家有疑义</span>
                    </td>
                    <td>20580</td>
                    <td>
                        <a href="contract_detail.html" class="btn btn-xs btn-default">
                           查看详情
                        </a>
                    </td>
                  </tr>
                  <tr>
                    <td><input type="checkbox" name="user_id[]" value="1"></td>
                    <td>2602065004365800</td>
                    <td>GDB2345346</td>
                    <td>2016-06-17</td>
                    <td>2016-06-17</td>
                    <td>2016-06-17</td>
                    <td>方先生</td>
                    <td>钢厂</td>
                    <td>
                        <span class="label label-danger">买家有疑义</span>
                    </td>
                    <td>20580</td>
                    <td>
                        <a href="contract_detail.html" class="btn btn-xs btn-default">
                           查看详情
                        </a>
                    </td>
                  </tr>--}}
                </tbody>
              </table>
            </div>
            <!-- /.box-body -->
            <div class="box-footer clearfix" style="border: none;">
              <!--{!! page_render($contract_list) !!}-->
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
<!--<script src="/assets/admin/js/contract.js"></script>-->
<!-- Page script -->
<script>
  $(function () {
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

//  var user = new User();
    //删除
//  $(document).on('click', '.delete-selected', function() {
//      user.deleteSelected();//user_js
//  });
//  //启用
//  $(document).on('click','.start-selected',function(){
//  	user.startSelected();//user_js
//  });
//  //禁用
//  $(document).on('click','.end-selected',function(){
//  	user.endSelected();//user_js
//  });
//  //按时间倒序
//  $(document).on('click','.time-back',function(){
//  	//按时间倒叙
//  });    
    //按条件筛选
    $(".form-horizontal").submit(function(){
    	if($("#inputName").val()==""&&$("#inputTel").val()=="")
    	{
    		alert("没有任何筛选条件");
    		return false;
    	}
    })
  });
</script>
</body>
</html>
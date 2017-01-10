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
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Select2 -->
  <link rel="stylesheet" href="/plugins/select2/select2.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="/assets/admin/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="/assets/admin/css/skins/_all-skins.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="/plugins/iCheck/flat/blue.css">
  <!-- Morris chart -->
  <link rel="stylesheet" href="/plugins/morris/morris.css">
  <!-- jvectormap -->
  <link rel="stylesheet" href="/plugins/jvectormap/jquery-jvectormap-1.2.2.css">
  <!-- Date Picker -->
  <link rel="stylesheet" href="/plugins/datepicker/datepicker3.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="/plugins/daterangepicker/daterangepicker.css">
  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
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
<!--          <a href="#"><i class="fa fa-circle text-success"></i> 在线</a>-->
        </div>
      </div>
      <!-- search form -->
<!--      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="搜索...">
              <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form>-->
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
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
          <a href="#">
            <i class="fa fa-files-o"></i>
            <span>现货管理</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="#"><i class="fa fa-circle-o"></i> 现货列表</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-files-o"></i>
            <span>期货管理</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="#"><i class="fa fa-circle-o"></i> 期货列表</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-files-o"></i>
            <span>订单管理</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="#"><i class="fa fa-circle-o"></i> 合同列表</a></li>
            <li><a href="#"><i class="fa fa-circle-o"></i> 订单列表</a></li>
          </ul>
        </li>

        <li class="divider"></li>

        <li class="treeview active">
          <a href="#">
            <i class="fa fa-files-o"></i>
            <span>用户管理</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
              <small class="label pull-right bg-red">demo</small>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="/admin/user"><i class="fa fa-circle-o"></i> 用户列表</a></li>
            <li class="active"><a href="/admin/user/add"><i class="fa fa-circle-o"></i> 添加新用户</a></li>
            <li class="divider"></li>
            <li><a href="/admin/user-group"><i class="fa fa-circle-o"></i> 用户组</a></li>
            <li><a href="/admin/user-group/permission"><i class="fa fa-circle-o"></i> 用户组权限</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-files-o"></i>
            <span>商铺管理</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="#"><i class="fa fa-circle-o"></i> 商铺列表</a></li>
          </ul>
        </li>

        <li class="divider"></li>

        <li><a href="#"><i class="fa fa-book"></i> <span>网站设置</span></a></li>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        用户
        <small>新增</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="/admin"><i class="fa fa-dashboard"></i> 首页</a></li>
        <li><a href="/admin/user">用户列表</a></li>
        <li class="active">用户新增</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <form method="POST" class="main-form form-horizontal" accept-charset="UTF-8" autocomplete="off" novalidate="novalidate">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
      <!-- Default box -->
      <div class="box collapsed-box">
        <div class="box-header with-border">
          <h3 class="box-title"><a href="javascript:history.back();"><i class="fa fa-reply"></i></a></h3>

          <div class="box-tools pull-right">
            <button type="submit" class="btn btn-sm btn-success pull-right"><i class="fa fa-save"></i> 保存</button>
          </div>
        </div>
      </div>
      <!-- /.box -->

      <div class="row">
        <!-- left column -->
        <div class="col-md-6">
          <!-- Default box -->
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">登录信息</h3>
            </div>
            <div class="box-body">
              <div class="form-group">
                <label for="inputEmail" class="col-sm-2 control-label">邮箱</label>
            
                <div class="col-sm-9">
                  <input type="email" class="form-control" id="inputEmail" placeholder="Email" name="email">
                </div>
              </div>
              <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">用户名</label>
            
                <div class="col-sm-9">
                  <input type="text" class="form-control" id="inputEmail3" placeholder="Name" name="name">
                </div>
              </div>
              <div class="form-group">
                <label for="inputPassword3" class="col-sm-2 control-label">密码</label>
            
                <div class="col-sm-9">
                  <input type="text" class="form-control" id="inputPassword3" placeholder="Password" name="password">
                </div>
              </div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

          <!-- Default box -->
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">用户组信息</h3>
            </div>
            <div class="box-body">
              <div class="form-group">
                <label class="col-sm-2 control-label">用户组</label>
            
                <div class="col-sm-9">
                  <select name="role" class="form-control select2" style="width: 100%;">
                    @foreach (config('const.user_role') as $idx => $role)
                    <option value="{{ $idx }}">{{ $role }}</option>
                    @endforeach
                  </select>
                </div>
              </div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

          <!-- Default box -->
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">状态信息</h3>
            </div>
            <div class="box-body">
              <div class="btn-group" data-toggle="buttons">
                  @foreach (config('const.user_status') as $idx => $status)
                  <label class="btn btn-default btn-sm">
                      <input type="radio" name="state_type" value="{{ $idx }}">{{ $status }}
                  </label>
                  @endforeach
              </div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

          <!-- Default box -->
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">商铺信息</h3>
            </div>
            <div class="box-body">
              暂无
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!--/.col (left) -->

        <!-- right column -->
        <div class="col-md-6">
          <!-- Default box -->
          <div class="box box-success">
            <div class="box-header with-border">
              <h3 class="box-title">用户资料</h3>
            </div>
            <div class="box-body">
              <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">邮箱</label>

                <div class="col-sm-9">
                  <input type="email" class="form-control" id="inputEmail3" placeholder="Email">
                </div>
              </div>
              <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">用户名</label>

                <div class="col-sm-9">
                  <input type="email" class="form-control" id="inputEmail3" placeholder="Name">
                </div>
              </div>
              <div class="form-group">
                <label for="inputPassword3" class="col-sm-2 control-label">密码</label>

                <div class="col-sm-9">
                  <input type="text" class="form-control" id="inputPassword3" placeholder="Password">
                </div>
              </div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!--/.col (right) -->
      </div>
      </form>
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
<!-- Bootstrap 3.3.6 -->
<script src="/plugins/bootstrap/js/bootstrap.min.js"></script>
<!-- Toaster -->
<script src="/plugins/jquery-toaster/jquery.toaster.js"></script>
<!-- Select2 -->
<script src="/plugins/select2/select2.full.min.js"></script>
<!-- Morris.js charts -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="/plugins/morris/morris.min.js"></script>
<!-- Sparkline -->
<script src="/plugins/sparkline/jquery.sparkline.min.js"></script>
<!-- jvectormap -->
<script src="/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<!-- jQuery Knob Chart -->
<script src="/plugins/knob/jquery.knob.js"></script>
<!-- daterangepicker -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
<script src="/plugins/daterangepicker/daterangepicker.js"></script>
<!-- datepicker -->
<script src="/plugins/datepicker/bootstrap-datepicker.js"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<!-- Slimscroll -->
<script src="/plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="/plugins/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="/assets/admin/js/app.min.js"></script>

<!-- page script -->
<script src="/plugins/jquery-form/jquery.form.min.js"></script>
<script src="/assets/base.js"></script>

<!-- Page script -->
<script>
  $(function () {
    //Initialize Select2 Elements
    $(".select2").select2();

    var base = new Base();
    base.initForm('./');
  });
</script>
</body>
</html>

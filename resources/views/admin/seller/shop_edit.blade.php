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

    <!-- Select2 -->
    <link rel="stylesheet" href="/plugins/select2/select2.min.css">
  
  
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
    .com_row{ width: 100%; overflow-y: hidden;}
    .zl_table{ width: 100%;}
		.zl_table tr td{ padding: 5px 10px;}
		.zl_table input[type='text']:disabled{ background: #f5f5f5;}
		.zl_table input[type='text'],.zl_table input[type='password']{ background: #fff; border: 1px solid #ddd; padding: 5px 8px; width: 90%;}
		.zl_table .span1{ display: inline-block; vertical-align: middle;}
  </style>
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

 {{-- <header class="main-header">
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
      <ul class="sidebar-menu">
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
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>--}}
 @include('admin._layouts.header')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        会员管理
        <small>买卖会员</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="/admin"><i class="fa fa-dashboard"></i> 首页</a></li>
        <li>会员管理</li>
        <li class="active">买卖会员</li>
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
      	<div class="col-md-6">
      		<div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">用户信息</h3>
            </div>
                <table class="zl_table">
                    <tr>
                        <td width="100" align="right">当前头像</td>
                        <td><img src="{{$user->avatar_pic}}" width="121" height="121"></td>
                    </tr>
                    <tr>
                        <td align="right">帐号</td>
                        <td><input type="text" name="tel" value="{{$user->mobile}}" disabled="disabled"></td>
                    </tr>
                    <tr>
                        <td align="right">真实姓名</td>
                        <td><input type="text" name="tel" value="{{$user->realname}}" disabled="disabled"></td>
                    </tr>
                    <tr>
                        <td align="right">身份证号</td>
                        <td><input type="text" name="tel" value="{{$user->user_card}}" disabled="disabled"></td>
                    </tr>
                    <tr>
                        <td align="right">性别</td>
                        <td>
                            <label><input type="radio" name="sex" class="radio_btn" disabled="disabled" @if($user->gender==1)checked="checked"@endif> 男</label>
                            <label><input type="radio" name="sex" class="radio_btn" @if($user->gender==2)checked="checked"@endif disabled="disabled"> 女</label>
                        </td>
                    </tr>
                    <tr>
                        <td align="right">生日</td>
                        <td><input type="text" id="datepicker" name="birth" value="<?php echo(date('m/d/Y',$user->birthday));?>" disabled="disabled"></td>
                    </tr>
                    <tr>
                        <td align="right">住址</td>
                        <td><input type="text" name="addr" disabled="{{$user->consignee}}"></td>
                    </tr>
                    {{--<tr>
                        <td align="right">手机号</td>
                        <td><input type="text" name="tel" value="15302265146"></td>
                    </tr>--}}
                    <tr>
                        <input type="hidden" name="id" value="{{$user->id}}">
                        <td align="right">密码</td>
                        <td><input type="password" name="password" value=""></td>
                    </tr>
                </table>
		    	</div>
		    	
		    	<!---->
		    	<!-- Default box -->
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">用户组信息</h3>
            </div>
            <!-- form start -->
            <!--<form class="form-horizontal">-->
              <div class="box-body">
                <div class="form-group">
                  <label class="col-sm-2 control-label">用户组</label>

                  <div class="col-sm-9">
                    <select name="role" class="form-control select2" style="width: 100%;" disabled="disabled">
                      <option value="注册用户">注册用户</option>
                      <option value="注册用户" selected="selected">店铺卖家</option>
                      <option value="注册用户">超级管理员</option>
                    </select>
                  </div>
                </div>
              </div>
              <!-- /.box-body -->
            <!--</form>-->
          </div>
          <!---->
          {{--<div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">状态信息</h3>
            </div>
            <!-- form start -->
            <form class="form-horizontal">
              <div class="box-body">
                <div class="btn-group" data-toggle="buttons">                   
                    <label class="btn btn-default btn-sm active">
                        <input type="radio" name="state_type" value="1">未激活
                    </label>
                    <label class="btn btn-default btn-sm">
                        <input type="radio" name="state_type" value="3">已启用
                    </label>
                    <label class="btn btn-default btn-sm">
                        <input type="radio" name="state_type" value="4">已禁用
                    </label>
                </div>
              </div>
              <!-- /.box-body -->
            </form>
          </div>--}}
                  <!--商铺审核-->
            <!-- /.box-body -->
         <div class="box box-info">
           <div class="box-header with-border">
             <h3 class="box-title">商铺审核</h3>
           </div>
           <!-- form start -->
           <form class="form-horizontal">
             <div class="box-body">
                 <div class="btn-group" data-toggle="buttons">
                      <label @if($user->shop_status==1) class="btn btn-default btn-sm active" @elseif($user->shop_status==0 or $user->shop_status==2)class="btn btn-default btn-sm" @endif>
                          <?php /*dd($user->shop_status);*/?>
                       <input type="radio" name="state_type" value="1" >审核通过
                   </label>
                   <label @if($user->shop_status==2) class="btn btn-default btn-sm active" @elseif($user->shop_status==0 or $user->shop_status==1)class="btn btn-default btn-sm" @endif>
                       <input type="radio" name="state_type" value="2">拒绝申请
                   </label>
               </div>
             </div>
             <!-- /.box-body -->
           </form>
         </div>
        </div>
        <!-- left column -->
        <!--公司信息-->
        <div class="col-md-6">
      		<div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">公司证件</h3>
            </div>
                <table class="zl_table">
                    <tr>
                        <td width="120" align="right">公司名称</td>
                        <td><input type="text" name="tel" value="{{$seller->name or ''}}" disabled="disabled"></td>
                    </tr>
                    <tr>
                        <td align="right">组织机构代码</td>
                        <td><input type="text" name="tel" value="{{$seller_info->company_code or ''}}" disabled="disabled"></td>
                    </tr>
                    <tr>
                        <td align="right">营业执照</td>
                        <td><img src="{{$seller_info->licence_path or ''}}" width="121" height="121"></td>
                    </tr>
                    <tr>
                        <td align="right">组织机构代码证</td>
                        <td><img src="{{$seller_info->code_path or ''}}" width="121" height="121"></td>
                    </tr>
                    <tr>
                        <td align="right">公章</td>
                        <td><img src="{{$seller_info->gong_path or ''}}" width="121" height="121"></td>
                    </tr>
                    <tr>
                        <td align="right">合同章</td>
                        <td><img src="{{$seller_info->contract_path or ''}}" width="121" height="121"></td>
                    </tr>
                    <tr>
                        <td align="right">法人章</td>
                        <td><img src="{{$seller_info->owner_path or ''}}" width="121" height="121"></td>
                    </tr>
                </table>
		    	</div>
      	</div>
        
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
<!-- Bootstrap 3.3.6 资料查看/退出-->
<script src="/plugins/bootstrap/js/bootstrap.min.js"></script>
<!-- AdminLTE App 适应-->
<script src="/assets/admin/js/app.min.js"></script>
<!-- Select2 -->
<script src="/plugins/select2/select2.full.min.js"></script>
<!-- bootstrap datepicker -->
<script src="/plugins/datepicker/bootstrap-datepicker.js"></script>

<!-- Toaster -->
<script src="/plugins/jquery-toaster/jquery.toaster.js"></script>

<!-- pages script -->
<script src="/plugins/jquery-form/jquery.form.min.js"></script>
<script src="/assets/base.js"></script>
<script>
  $(function () {
    $('#datepicker').datepicker({
      autoclose: true
    });
  });
</script>
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

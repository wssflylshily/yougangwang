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
<!--  <link rel="stylesheet" href="/plugins/datepicker/datepicker3.css">-->
  
  
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
	.zl_table tr td{ padding: 10px 10px;}
	.zl_table input[type='text']:disabled{ background: #f5f5f5;}
	.zl_table input[type='text'],.zl_table input[type='password']{ background: #fff; border: 1px solid #ddd; padding: 5px 8px; width: 90%;}
	.zl_table .span1{ display: inline-block; vertical-align: middle;}
  	.evaluate{ font-size: 18px;}
  	.evaluate i{ margin-right: 5px;}
  	.tj_td label{ font-weight: normal; display: inline-block; margin-left: 5px;}
  /*.img_upload{ float: left; width: 180; position: relative;}
  .img_upload img{ margin-bottom: 3px;}
  .img_upload .gb_close{ font-size: 24px; background: #FFFFFF; position: absolute; left: 1px; top: 1px; z-index: 2;}*/
  </style>
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

    <!-- /.sidebar -->
  </aside>--}}
  @include('admin._layouts.header')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        基本信息
        <small>底部信息</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="/admin"><i class="fa fa-dashboard"></i> 首页</a></li>
        <li>基本信息</li>
        <li class="active">底部信息</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Default box -->
    <form action="{{ route('admin.webset.footer.post') }}" method="post">
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
        <div class="col-md-12">
        	<div class="box box-info">
	            <div class="box-header">
	              <h3 class="box-title">底部信息</h3>
	            </div>
                <p style="color: red">{{ $mes }}</p>
      		<!--<div class="box box-info" style="padding-bottom: 60px;">-->
      			<div class="box-body table-responsive">
	      		<table class="zl_table">
                    <tr>
                        <td width="100" align="right">内容</td>
                        <td><input type="text" name="name" placeholder="" value="{{ $footer->value or '' }}"></td>
                        <td> <input type="hidden" name="_token" value="{{ csrf_token() }}"></td>
                    </tr>
	    			{{--<tr>
	    				<td width="100" align="right">版权</td>
	    				<td><input type="text" name="name_name" placeholder="输入名称" value="品种1"></td>
	    			</tr>
	    			<tr>
	    				<td width="100" align="right">链接地址</td>
	    				<td><input type="text" name="name_name" placeholder="链接地址" value="javascript:;"></td>
	    			</tr>
	    			<tr>
	    				<td width="100" align="right">网址</td>
	    				<td><input type="text" name="name_name" placeholder="输入网址" value="品种1"></td>
	    			</tr>
	    			<tr>
	    				<td width="100" align="right">链接地址</td>
	    				<td><input type="text" name="name_name" placeholder="链接地址" value="javascript:;"></td>
	    			</tr> 
	    			<tr>
	    				<td width="100" align="right">备案号</td>
	    				<td><input type="text" name="name_name" placeholder="输入名称" value="品种1"></td>
	    			</tr>
	    			<tr>
	    				<td width="100" align="right">链接地址</td>
	    				<td><input type="text" name="name_name" placeholder="链接地址" value="javascript:;"></td>
	    			</tr> --}}
	    		</table>
			
      		</div>
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
<!-- bootstrap datepicker -->
<!--<script src="/plugins/datepicker/bootstrap-datepicker.js"></script>-->
</body>
</html>


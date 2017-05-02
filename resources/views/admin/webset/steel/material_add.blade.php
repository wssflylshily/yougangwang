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

@include('admin._layouts.header')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        基本信息
        <small>钢铁信息</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="/admin"><i class="fa fa-dashboard"></i> 首页</a></li>
        <li>基本信息</li>
        <li class="active">钢铁信息</li>
      </ol>
    </section>

    <form method="post" action="{{ route('admin.webset.steel.material-add') }}">
      <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <!-- Main content -->
    <section class="content">
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
        <div class="col-md-12">
        	<div class="box box-info">
	            <div class="box-header">
	              <h3 class="box-title">添加材质</h3>
                  <span style="margin-left: 10px;color:red;">@if(!empty($message)) {{ $message }}@endif</span>
	
	              <div class="box-tools">
	                  <div class="btn-group" style="margin-bottom: 5px;">
                        <!--<button type="button" class="btn btn-sm text-warning start-selected"><i class="fa fa-archive"></i> 启用</button>
                        <button type="button" class="btn btn-sm text-warning end-selected"><i class="fa fa-archive"></i> 禁用</button>
                        <button type="button" class="btn btn-sm text-success" onclick="javascript:location.href='website_add.html';"><i class="fa fa-plus"></i> 添加</button>-->
						<!--<button type="button" class="btn btn-sm text-danger delete-selected"><i class="fa fa-trash"></i> 删除</button>-->
	                    
	                  </div>
	              </div>
	            </div>
      		<!--<div class="box box-info" style="padding-bottom: 60px;">-->
      			<div class="box-body table-responsive">
	      		<table class="zl_table">
	    			<tr>
	    				<td width="100" align="right">名称</td>
	    				<td><input type="text" name="name_name" placeholder="输入名称" value=""></td>
	    			</tr>                                                                                                                                                                                                    
	    		</table>
			
      		</div>
      	</div>
        
      </div>
      </div>
    </section>
    </form>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <strong>Copyright &copy; 2016 <a href="#">YouGang</a>.</strong> All rights
    reserved.
  </footer>
</div>
<script src="/plugins/jquery-toaster/jquery.toaster.js"></script>
<script src="/plugins/jquery-form/jquery.form.min.js"></script>
<script src="/assets/base.js"></script>

<script>
    $(function(){
        var base = new Base();
        base.initForm();
    });
</script>
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
<script src="/plugins/datepicker/bootstrap-datepicker.js"></script>

<script src="/plugins/jquery-form/jquery.form.min.js"></script>


<script>

	$(document).on('click', '.start-selected', function() {
       alert("启用成功");
       $(".tablea .zt").html("状态：已启用");
    });
    //禁用
    $(document).on('click', '.end-selected', function() {
       alert("禁用成功");
       $(".tablea .zt").html("状态：已禁用");         
    });

</script>
</body>
</html>

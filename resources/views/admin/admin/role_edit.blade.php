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

@include('admin._layouts.header')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        基本信息
        <small>城市信息</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="/admin"><i class="fa fa-dashboard"></i> 首页</a></li>
        <li>基本信息</li>
        <li class="active">修改角色</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Default box -->
      <div class="box collapsed-box">
        <div class="box-header with-border">
          <h3 class="box-title"><a href="javascript:history.back();"><i class="fa fa-reply"></i></a></h3>

          <div class="box-tools pull-right">
            <button id="sub_but" class="btn btn-sm btn-success pull-right"><i class="fa fa-save"></i> 保存</button>
          </div>
        </div>
      </div>
      <!-- /.box -->

      <div class="row">
        <!-- left column -->
        <div class="col-md-12">
        	<div class="box box-info">
	            <div class="box-header">
	              <h3 class="box-title">修改角色</h3>
	
	              {{--<div class="box-tools">
	                  <div class="btn-group" style="margin-bottom: 5px;">
						<button type="button" class="btn btn-sm text-warning start-selected"><i class="fa fa-archive"></i> 启用</button>
						<button type="button" class="btn btn-sm text-warning end-selected"><i class="fa fa-archive"></i> 禁用</button>
	                  </div>
	              </div>--}}
	            </div>
      			<div class="box-body table-responsive">
	      		<table class="zl_table">
	      		    <tr>
	    				<td width="100" align="right">角色名</td>
                        <td><input type="text" name="name" required placeholder="输入角色名" value="{{ $role->name }}"></td>
	    			</tr> 
	    			<tr>
	    				<td width="100" align="right">角色描述</td>
	    				<td><input type="text" name="detail" required placeholder="输入角色描述" value="{{ $role->detail }}"></td>
	    			</tr>
                    <tr>
                        <td width="100" align="right">权限选择</td>
                        <td style="border: 1px solid #ddd;" >
                            @foreach($menus as $menu)
                                <table>
                                    <tr>
                                        {{--<th width="30"><input type="checkbox" value="{{ $menu->id }}"></th>--}}
                                        <td width="100">{{ $menu->title }}</td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        {{--<th width="30"></th>--}}
                                        <td>-------------</td>
                                        @foreach($menu['menu'] as $child)
                                            <td><input type="checkbox" name="menu_id" @foreach($user_menus as $user_menu)@if($user_menu->menu_id == $child->id) checked @endif @endforeach value="{{ $child->id }}" ></td>
                                            <td>{{ $child->title }}</td>
                                        @endforeach
                                    </tr>
                                </table>
                            @endforeach
                        </td>
                    </tr>
	    		</table>
			
      		</div>
      	</div>
        
      </div>
      </div>
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
<!-- Toaster -->
<script src="/plugins/jquery-toaster/jquery.toaster.js"></script>

<!-- pages script -->
<script src="/assets/base.js"></script>

<script type="text/javascript">
    $("#sub_but").click(function () {
        var name = $('input[name="name"]').val();
        var detail = $('input[name="detail"]').val();
        //alert(name);
        var chk_value =[];
        $('input[name="menu_id"]:checked').each(function(){
            chk_value.push($(this).val());
        });
        //alert(chk_value.length==0 ?'你还没有选择任何内容！':chk_value);
        if (chk_value.length==0)
        {
            alert("请选择角色的权限！");
        }
        $.ajax({
            type:"POST",
            url:"{{ route('admin.admin.role.edit') }}",
            datatype: "json",
            data: {'_token': "{{ csrf_token() }}", 'name':name, 'detail': detail, 'menu_id': chk_value, 'id': "{{ $role->id }}"},
            success:function(json){
                console.log(json);
                window.location.href="{{ route('admin.admin.role') }}";
            },
            error: function(){
            }
        });
    })


</script>
</body>
</html>

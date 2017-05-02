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
    .sort_inp{ width: 44px; text-align: center;}
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
        基本设置
        <small>钢铁信息</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="/admin"><i class="fa fa-dashboard"></i> 首页</a></li>
        <li class="active">钢铁信息</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Default box -->
     <div class="row">
        <div class="col-xs-12">
          <div class="box box-info">
            <div class="box-header">
              <h3 class="box-title">标准一览</h3>

              <div class="box-tools">
                  <div class="btn-group" style="margin-bottom: 5px;">
					{{--<button type="button" class="btn btn-sm text-warning start-selected"><i class="fa fa-archive"></i> 启用</button>
					<button type="button" class="btn btn-sm text-warning end-selected"><i class="fa fa-archive"></i> 禁用</button>--}}
					<button type="button" class="btn btn-sm text-success" onclick="javascript:location.href='{{ route('admin.webset.steel.standard-add') }}';"><i class="fa fa-plus"></i> 添加</button>
					<button type="button" class="btn btn-sm text-danger delete-selected"><i class="fa fa-trash"></i> 删除</button>
                    
                  </div>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive">
              <table class="table table-bordered table-hover">
                <thead style="background-color: #ddd;">
                  <tr>
                    <th width="30"><input type="checkbox"></th>
                    <th>ID</th>                    
                    <th>名称</th>
                    <th>创建时间</th>
                    {{--<th width="140">操作</th>--}}
                  </tr>
                </thead>
                <tbody>
                @foreach($rs as $r)
                  <tr>
                    <td><input type="checkbox" name="id" value="{{ $r->id }}"></td>
                    <td>{{ $r->id }}</td>
                    <td>{{ $r->name }}</td>
                    <td>{{ $r->created_at }}</td>
                    {{--<td>
                        <a href="website_add.html" class="btn btn-xs btn-default">
                          <i class="fa fa-edit"></i> 编辑
                        </a>
                    </td>--}}
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
            <!-- /.box-body -->
            <div class="box-footer clearfix" style="border: none;">
              {!! page_render($rs) !!}
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

    //var user = new User();
    //删除
    $(document).on('click', '.delete-selected', function() {
        var chk_value = [];
        $("tbody input[name='id']:checked").each(function(){
            chk_value.push($(this).val());
        });
       	if(chk_value.length==0)
       	{
       		alert("您没有选中要删除选中的品种")
       	}
       	else
       	{
       		if(confirm("您确定删除选中的品种吗"))
       		{
                $.post("{{ route('admin.webset.steel.standard-delete') }}",{'id':chk_value, '_token': "{{ csrf_token() }}"},function(result){
                    console.log(result);
                    //$("span").html(result);
                    if (result.result = true){
                        window.location.reload();
                    }else {
                        alert(result.message);
                    }

                });
       			return;
       		}
       	}
    });
    //启用
    $(document).on('click','.start-selected',function(){
    	if($("tbody input[name='user_id[]']:checked").length==0)
       	{
       		alert("您没有选中的数据")
       	}
       	else
       	{
       		if(!confirm("您确定启用选中的文章"))
       		{

       			return;
       		}
       	}
    });
    //禁用
    $(document).on('click','.end-selected',function(){
    	if($("tbody input[name='user_id[]']:checked").length==0)
       	{
       		alert("您没有选中的数据")
       	}
       	else
       	{
       		if(!confirm("您确定禁用选中的文章"))
       		{
       			return;
       		}
       	}
    });
     
  });
</script>
</body>
</html>

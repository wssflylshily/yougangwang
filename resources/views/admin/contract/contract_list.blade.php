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
  @include('admin._layouts.header')

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
                <input type="text" class="form-control" id="inputName" placeholder="订单编号" name="order_sn" name="{{Request()->order_sn}}">
              </div>
            </div>
            {{--<div class="form-group">
              <label for="inputName" class="col-sm-2 control-label">供货人</label>

              <div class="col-sm-10">
                <input type="text" class="form-control" id="inputName" placeholder="供货人" name="supplier_agent">
              </div>
            </div>--}}
            <div class="form-group">
              <label for="inputTel" class="col-sm-2 control-label">合同编号</label>

              <div class="col-sm-10">
                <input type="text" class="form-control" id="inputTel" placeholder="合同编号" name="contract_sn" {{Request()->contract_sn}}>
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
                  <tr>
                    <td><input type="checkbox" name="user_id[]" value="{{$contract->id}}"></td>
                    <td>{{$contract->order_sn}}</td>
                    <td>{{$contract->contract_sn}}</td>
                    <td>{{$contract->created_at->format('Y-m-d')}}</td>
                    <td>{{$contract->demander_agent}}</td>
                    <td>{{$contract->supplier_agent}}</td>
                    <td>
                      @if($contract->status==1)
                        <span class="label label-default">合同生成</span>
                      @elseif($contract->status==2)
                        <span class="label label-default">卖家签约</span>
                      @elseif($contract->status==3)
                        <span class="label label-success">已完成</span>
                      @elseif($contract->status==100)
                        <span class="label label-danger">已取消</span>
                      @endif
                    </td>
                    <td>{{$contract->price_amount}}</td>
                    <td>
                      <a href="{{ route('admin.contract.detail', ['order_sn' => $contract->order_sn]) }}" class="btn btn-xs btn-default">
                        查看详情
                      </a>
                    </td>
                  </tr>
                  @endforeach
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
              {{--{!! page_render($contract_list) !!}--}}
              {!! $contract_list->appends(Request::query())->render() !!}
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
    	/*if($("#inputName").val()==""&&$("#inputTel").val()=="")
    	{
    		alert("没有任何筛选条件");
    		return false;
    	}*/
    })
  });
</script>
</body>
</html>

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
        会员管理
        <small>商家会员</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="/admin"><i class="fa fa-dashboard"></i> 首页</a></li>
        <li>会员管理</li>
        <li class="active">商家会员</li>
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
              <label for="inputEmail3" class="col-sm-2 control-label">用户</label>

              <div class="col-sm-10">
                <input type="text" class="form-control" id="inputName" placeholder="用户名" name="name" value="{{Request()->name}}">
              </div>
            </div>
            <div class="form-group">
              <label for="inputPassword3" class="col-sm-2 control-label">手机</label>

              <div class="col-sm-10">
                <input type="text" class="form-control" id="inputTel" placeholder="手机号" name="mobile" value="{{Request()->mobile}}">
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
              <h3 class="box-title">用户一览</h3>

              <div class="box-tools">
                  <div class="btn-group" style="margin-bottom: 5px;">
					{{--<button type="button" class="btn btn-sm text-warning start-selected"><i class="fa fa-archive"></i> 启用</button>
					<button type="button" class="btn btn-sm text-warning end-selected"><i class="fa fa-archive"></i> 禁用</button>--}}
                    <button type="button" class="btn btn-sm text-warning star-selected"><i class="fa fa-archive"></i> 设为明星商城</button>
                    <button type="button" class="btn btn-sm text-warning nostar-selected"><i class="fa fa-archive"></i> 取消明星商城</button>
					{{--<button type="button" class="btn btn-sm text-success" onclick="javascript:location.href='#';"><i class="fa fa-plus"></i> 新增</button>--}}
					{{--<button type="button" class="btn btn-sm text-success time-back"> 按星级排序</button>--}}
                    {{--<button type="button" class="btn btn-sm text-danger delete-selected"><i class="fa fa-trash"></i> 删除</button>--}}
                    
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
                    <th>用户名</th>
                    <th>手机号</th>
                    <th>注册日期</th>
                    <th>明星商家</th>
                    <th>星级</th>                    
                   {{-- <th>状态</th>--}}
                    <th>审核状态</th>
                    {{--<th>角色</th>--}}
                    <th width="140">操作</th>
                  </tr>
                </thead>
                <tbody>
                @foreach($seller_list as $seller)
                  <tr>
                    <td><input type="checkbox" name="user_id[]" value="{{$seller->id}}"></td>
                    <td>{{$seller->id}}</td>
                    <td>{{$seller->name}}</td>
                    <td>{{$seller->mobile}}</td>
                    <td>{{ $seller->created_at }}</td>
                    <td>
                        @if($seller->is_star==1)
                            <span class="label label-success">是</span>
                        @else
                            <span class="label label-danger">否</span>
                        @endif
                    </td>
                    <td style="color: #FF0000;" class="evaluate" data_score="{{$seller->credit_degree}}">
                        {{--<a href="{{route('admin.seller.evaluate.list',['seller_id'=>$seller->id])}}">查看详情</a>--}}
                    </td>
                   {{-- <td>
                        @if($seller->deleted_at!=null)
                            <span class="label label-danger">已禁用</span>
                        @else
                            <span class="label label-success">已启用</span>
                        @endif
                        --}}{{--<span class="label label-danger">已删除</span>--}}{{--
                    </td>--}}
                      <td>
                          @if($seller->shop_status==0)
                              <span class="label label-default">待审核</span>
                          @elseif($seller->shop_status==1)
                              <span class="label label-success">已通过</span>
                          @elseif($seller->shop_status==2)
                              <span class="label label-danger">未通过</span>
                          @endif
                          {{--<span class="label label-danger">已删除</span>--}}
                      </td>
                    {{--<td>商户</td>--}}
                    <td>
                        <a href="{{route('admin.seller.edit',['id'=>$seller->id])}}" class="btn btn-xs btn-default">
                            <i class="fa fa-edit"></i> 编辑
                        </a>
                        {{--<a href="shop_edit.html" class="btn btn-xs btn-default">
                            <i class="fa fa-edit"></i> 编辑
                        </a>
                        <a href="person_detail.html" class="btn btn-xs btn-default">
                            查看详情
                        </a>--}}
                    </td>
                  </tr>
                  @endforeach
                  {{--<tr>
                    <td><input type="checkbox" name="user_id[]" value="1"></td>
                    <td>1</td>
                    <td>用户名1</td>
                    <td>15202265146</td>
                    <td>2016-10-11</td>
                    <td>是</td>
                    <td style="color: #FF0000;" class="evaluate" data_score="4.5">
                    	<a href="evaluate_list.html">查看详情</a>
                    </td>
                    <td>
                        <span class="label label-danger">已删除</span>
                     </td>
                    <td>商户</td>
                    <td>
                        <a href="shop_edit.html" class="btn btn-xs btn-default">
                          <i class="fa fa-edit"></i> 编辑
                        </a>
                        <a href="person_detail.html" class="btn btn-xs btn-default">
                           查看详情
                        </a>
                    </td>
                  </tr>
                  <tr>
                    <td><input type="checkbox" name="user_id[]" value="2"></td>
                    <td>1</td>
                    <td>用户名1</td>
                    <td>15202265146</td>
                    <td>2016-10-11</td>
                    <td>是</td>
                    <td style="color: #FF0000;" class="evaluate" data_score="4.5">
                    	<a href="evaluate_list.html">查看详情</a>
                    </td>
                    <td>
                        <span class="label label-default">未启用</span>
                     </td>
                    <td>商户</td>
                    <td>
                        <a href="shop_edit.html" class="btn btn-xs btn-default">
                          <i class="fa fa-edit"></i> 编辑
                        </a>
                        <a href="person_detail.html" class="btn btn-xs btn-default">
                           查看详情
                        </a>
                    </td>
                  </tr>
                  <tr>
                    <td><input type="checkbox" name="user_id[]" value="3"></td>
                    <td>1</td>
                    <td>用户名1</td>
                    <td>15202265146</td>
                    <td>2016-10-11</td>
                    <td>是</td>
                    <td style="color: #FF0000;" class="evaluate" data_score="4.5">
                    	<a href="evaluate_list.html">查看详情</a>
                    </td>
                    <td>
                        <span class="label label-success">已启用</span>
                     </td>
                    <td>商户</td>
                    <td>
                        <a href="#" class="btn btn-xs btn-default">
                          <i class="fa fa-edit"></i> 编辑
                        </a>
                        <a href="#" class="btn btn-xs btn-default">
                           查看详情
                        </a>
                    </td>
                  </tr>
                  <tr>
                    <td><input type="checkbox" name="user_id[]" value="4"></td>
                    <td>1</td>
                    <td>用户名1</td>
                    <td>15202265146</td>
                    <td>2016-10-11</td>
                    <td>是</td>
                    <td style="color: #FF0000;" class="evaluate" data_score="4.5">
                    	<a href="evaluate_list.html">查看详情</a>
                    </td>
                    <td>
                        <span class="label label-default">已禁用</span>
                     </td>
                    <td>商户</td>
                    <td>
                        <a href="shop_edit.html" class="btn btn-xs btn-default">
                          <i class="fa fa-edit"></i> 编辑
                        </a>
                        <a href="person_detail.html" class="btn btn-xs btn-default">
                           查看详情
                        </a>
                    </td>
                  </tr>--}}
                </tbody>
              </table>
            </div>
            <!-- /.box-body -->
            <div class="box-footer clearfix" style="border: none;">
              {{--<!--{!! page_render($seller_list) !!}-->--}}
                {!! $seller_list->appends(Request::query())->render() !!}
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
<script src="/assets/admin/js/seller.js"></script>
<!-- Page script -->
{{--ajax js文件--}}
<script src="/plugins/jquery-toaster/jquery.toaster.js"></script>
<!-- pages script -->
<script src="/plugins/jquery-form/jquery.form.min.js"></script>
<script src="/assets/base.js"></script>
<script>
  $(function () {
  	
  	$(".evaluate").each(function(){
  		var str='<i class="fa fa-star"></i>';
  		var stra='<i class="fa fa-star-half-full"></i>';
  		var strc='<i class="fa fa-star-o"></i>';
  		var data=$(this).attr("data_score").split('.');
  		var data_full=data[0];
  		var data_empty=parseInt(5-$(this).attr("data_score"));
  		if(data_empty>0)
  		{
  			for(var i=0;i<data_empty;i++)
	  		{
	  			$(this).prepend(strc);
	  		}
  		}
  		if(data[1]>0)
  		{
	  		$(this).prepend(stra);
  		}
  		if(data[0]>0)
  		{
  			for(var i=0;i<data[0];i++)
	  		{
	  			$(this).prepend(str);
	  		}
  		}
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

    var user = new User();
    /*//删除
    $(document).on('click', '.delete-selected', function() {
        user.deleteSelected();//user_js
    });*/

     /* //删除
      $(document).on('click', '.delete-selected', function() {
          if($("tbody input[name='user_id[]']:checked").length==0)
          {
              alert("您没有选中的数据")
          }
          else
          {
              if(!confirm("您确定删除选中的商家"))
              {
                  return;
              }else{
                  var seller_ids = [];
                  $("input[name='user_id[]']:checked").each(function(){
                      seller_ids.push($(this).val());
                  });

                  self.waiting = true;

                  var data = {
                      seller_ids: seller_ids,
                      _token  : $('#csrfToken').val()
                  };
                  /!*console.log(data)*!/
                  $.post('{{ route('admin.seller.todel') }}', data, function(response) {
                      if (response.result !== true) {
                          $.toaster({ priority : 'danger', title : '失败', message : response.message });
                          return false;
                      }

                      $.toaster({ priority : 'success', title : '成功', message : response.message });
                      window.location.reload();
                  }).complete(function(){
                      self.waiting = false;
                  }).error(function(){
                      $.toaster({ priority : 'danger', title : '失败', message : '网络错误' });
                  });
                  {{--$.ajax({--}}
                  {{--type:"get",--}}
                  {{--url:"{{ route('admin.article.del') }}",--}}
                  {{--datatype: "json",--}}
                  {{--data: { 'article_ids':article_ids},--}}
                  {{--success:function(json){--}}
                  {{--console.log(json);--}}
                  {{--if (json.result == true){--}}
                  {{--window.location.href="{{ route('admin.admin.role') }}";--}}
                  {{--}--}}
                  {{--},--}}
                  {{--error: function(){--}}
                  {{--}--}}
                  {{--});--}}
              }
          }
      });*/
    /*//启用
    $(document).on('click','.start-selected',function(){
    	user.startSelected();//user_js
    });*/
      //启用
      $(document).on('click','.start-selected',function(){
          if($("tbody input[name='user_id[]']:checked").length==0)
          {
              alert("您没有选中的数据")
          }
          else
          {
              if(!confirm("您确定启用选中的商家"))
              {
                  return;
              }else{
                  //获取所有的选中id
                  var seller_ids = [];
                  $("input[name='user_id[]']:checked").each(function(){
                      seller_ids.push($(this).val());
                  });
                  self.waiting = true;

                  var data = {
                      seller_ids: seller_ids,
                      _token  : $('#csrfToken').val()
                  };
                  /*console.log(data);*/
                  /*$.ajax({
                   type:"post",
                   url:"{{ route('admin.article.start') }}",
                   datatype: "json",
                   data: { 'data':data},
                   success:function(json){
                   console.log(json);
                   if (json.result == true){
                   window.location.href="{{ route('admin.admin.role') }}";
                   }
                   },
                   error: function(){
                   }
                   });*/

                  $.post('{{ route('admin.seller.start') }}', data, function(response) {
                      if (response.result !== true) {
                          $.toaster({ priority : 'danger', title : '失败', message : response.message });
                          return false;
                      }

                      $.toaster({ priority : 'success', title : '成功', message : response.message });
                      window.location.reload();
                  }).complete(function(){
                      self.waiting = false;
                  }).error(function(){
                      $.toaster({ priority : 'danger', title : '失败', message : '网络错误' });
                  });

              }
          }
      });
    /*//禁用
    $(document).on('click','.end-selected',function(){
    	user.endSelected();//user_js
    });*/
      //禁用
      $(document).on('click','.end-selected',function(){
          if($("tbody input[name='user_id[]']:checked").length==0)
          {
              alert("您没有选中的数据")
          }
          else
          {
              if(!confirm("您确定禁用选中的商家"))
              {
                  return;
              }else{
                  //获取所有的选中id
                  var seller_ids = [];
                  $("input[name='user_id[]']:checked").each(function(){
                      seller_ids.push($(this).val());
                  });
                  self.waiting = true;

                  var data = {
                      seller_ids: seller_ids,
                      _token  : $('#csrfToken').val()
                  };
                  /*console.log(data);*/
                  /*$.ajax({
                   type:"post",
                   url:"{{ route('admin.article.start') }}",
                   datatype: "json",
                   data: { 'data':data},
                   success:function(json){
                   console.log(json);
                   if (json.result == true){
                   window.location.href="{{ route('admin.admin.role') }}";
                   }
                   },
                   error: function(){
                   }
                   });*/

                  $.post('{{ route('admin.user.userDel') }}', data, function(response) {
                      if (response.result !== true) {
                          $.toaster({ priority : 'danger', title : '失败', message : response.message });
                          return false;
                      }

                      $.toaster({ priority : 'success', title : '成功', message : response.message });
                      window.location.reload();
                  }).complete(function(){
                      self.waiting = false;
                  }).error(function(){
                      $.toaster({ priority : 'danger', title : '失败', message : '网络错误' });
                  });
              }
          }
      });

      $(document).on('click','.star-selected',function(){
          if($("tbody input[name='user_id[]']:checked").length==0)
          {
              alert("您没有选中的数据")
          }
          else
          {
              if(!confirm("您确定将选中的商家设置为明星商家吗"))
              {
                  return;
              }else{
                  //获取所有的选中id
                  var seller_ids = [];
                  $("input[name='user_id[]']:checked").each(function(){
                      seller_ids.push($(this).val());
                  });
                  self.waiting = true;

                  var data = {
                      seller_ids: seller_ids,
                      _token  : $('#csrfToken').val()
                  };

                  $.post('{{ route('admin.seller.star') }}', data, function(response) {
                      if (response.result !== true) {
                          $.toaster({ priority : 'danger', title : '失败', message : response.message });
                          return false;
                      }

                      $.toaster({ priority : 'success', title : '成功', message : response.message });
                      window.location.reload();
                  }).complete(function(){
                      self.waiting = false;
                  }).error(function(){
                      $.toaster({ priority : 'danger', title : '失败', message : '网络错误' });
                  });

              }
          }
      });

      $(document).on('click','.nostar-selected',function(){
          if($("tbody input[name='user_id[]']:checked").length==0)
          {
              alert("您没有选中的数据")
          }
          else
          {
              if(!confirm("您确定将选中的商家设置为明星商家吗"))
              {
                  return;
              }else{
                  //获取所有的选中id
                  var seller_ids = [];
                  $("input[name='user_id[]']:checked").each(function(){
                      seller_ids.push($(this).val());
                  });
                  self.waiting = true;

                  var data = {
                      seller_ids: seller_ids,
                      _token  : $('#csrfToken').val()
                  };

                  $.post('{{ route('admin.seller.nostar') }}', data, function(response) {
                      if (response.result !== true) {
                          $.toaster({ priority : 'danger', title : '失败', message : response.message });
                          return false;
                      }

                      $.toaster({ priority : 'success', title : '成功', message : response.message });
                      window.location.reload();
                  }).complete(function(){
                      self.waiting = false;
                  }).error(function(){
                      $.toaster({ priority : 'danger', title : '失败', message : '网络错误' });
                  });

              }
          }
      });
    //按星级排序
    $(document).on('click','.time-back',function(){
    	//按星级排序
    });    
    //按条件筛选
    $(".form-horizontal").submit(function(){
    	/*if($("#inputName").val()==""&&$("#inputTel").val()=="")
    	{
    		alert("没有任何筛选条件");
    		return false;
    	}*/
    	if($("#inputName").val()=="")
    	{
    		
    	}
    	if($("#inputTel").val()=="")
    	{
    		
    	}
    	else if(!/^[0-9]*$/.test($("#inputTel").val()))
    	{
    		alert("手机格式错误");
    		return false;
    	}
    })
  });
</script>
</body>
</html>

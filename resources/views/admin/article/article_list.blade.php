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
        网站设置
        <small>文章列表</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="/admin"><i class="fa fa-dashboard"></i> 首页</a></li>
        <li class="active">期货文章</li>
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
              <label for="inputEmail3" class="col-sm-2 control-label">文章名称</label>

              <div class="col-sm-10">
                <input type="text" class="form-control" id="inputName" placeholder="文章名称" name="title">
              </div>
            </div>
            <div class="form-group">
              <label for="inputPassword3" class="col-sm-2 control-label">文章内容</label>

              <div class="col-sm-10">
                <input type="text" class="form-control" id="inputTel" placeholder="文章内容" name="content">
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
              <h3 class="box-title">文章一览</h3>

              <div class="box-tools">
                  <div class="btn-group" style="margin-bottom: 5px;">
					<button type="button" class="btn btn-sm text-warning start-selected" id="start"><i class="fa fa-archive"></i> 启用</button>
					<button type="button" class="btn btn-sm text-warning end-selected"><i class="fa fa-archive" id="forbidden"></i> 禁用</button>
					<button type="button" class="btn btn-sm text-success" onclick="javascript:location.href='{{route('admin.article.add',['type'=>$type])}}';"><i class="fa fa-plus"></i> 新增</button>
					<button type="button" class="btn btn-sm text-danger delete-selected"><i class="fa fa-trash" id="delete"></i> 删除</button>
                  </div>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive">
              <table class="table table-bordered table-hover">
                <thead style="background-color: #ddd;">
                  <tr>
                    <th width="30"><input type="checkbox"></th>
                    {{--<th width="50">排序</th>--}}
                    <th>ID</th>                    
                    <th>标题</th>
                    <th>发布日期</th>                
                    <th>状态</th>
                    <th>分类</th>
                    <th width="140">操作</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($article_list as $article)
                    <tr>
                      <td><input type="checkbox" name="user_id[]" value="{{$article->id}}"></td>
                      {{--<td><input type="text" value="1" class="sort_inp" name="sort[]" data_id="{{$article->order}}"></td>--}}
                      <td>{{$article->id}}</td>
                      <td>{{$article->title}}</td>
                      <td>{{$article->created_at->format('Y-m-d')}}</td>
                      <td>
                        @if($article->is_show==0)
                          <span class="label label-danger">已禁用</span>
                        @elseif($article->is_show==1)
                          <span class="label label-success">已启用</span>
                        @endif
                      </td>
                      @if($article->type==1)
                        <td>期货文章</td>
                      @elseif($article->type==2)
                        <td>期货文章</td>
                      @elseif($article->type==3)
                        <td>聚划算</td>
                      @elseif($article->type==4)
                        <td>了解物流</td>
                      @elseif($article->type==5)
                        <td>联系我们</td>
                      @elseif($article->type==6)
                        <td>关于我们</td>
                      @elseif($article->type==7)
                        <td>其他文章</td>
                      @endif
                      <td>{{--{{URL::route('admin.order.future')}}--}}
                        {{--<a href="{{URL::route('admin.article.edit',array('article_id'=>$article->id))}}" class="btn btn-xs btn-default">--}}
                        {{--<a href="Edit/{{$article->id}}" class="btn btn-xs btn-default">--}}
                        <a href="{{route('admin.article.edit',['id' => $article->id]) }}" class="btn btn-xs btn-default">
                        {{--<a href="/admin/article/Edit/{{$article->id}}" class="btn btn-xs btn-default">--}}
                          <i class="fa fa-edit"></i> 编辑
                        </a>
                      </td>
                    </tr>
                    @endforeach
                 {{-- <tr>
                    <td><input type="checkbox" name="user_id[]" value="1"></td>
                    <td><input type="text" value="1" class="sort_inp" name="sort[]" data_id="1"></td>
                    <td>1</td>
                    <td>文章标题</td>
                    <td>2016-10-11</td>
                    <td>
                        <span class="label label-danger">已删除</span>
                    </td>
                    <td>期货文章</td>
                    <td>
                        <a href="article_edit.html" class="btn btn-xs btn-default">
                          <i class="fa fa-edit"></i> 编辑
                        </a>
                    </td>
                  </tr>
                  <tr>
                    <td><input type="checkbox" name="user_id[]" value="2"></td>
                    <td><input type="text" value="1" class="sort_inp" name="sort[]" data_id="1"></td>
                    <td>1</td>
                    <td>文章标题</td>
                    <td>2016-10-11</td>
                    <td>
                        <span class="label label-danger">已删除</span>
                    </td>
                    <td>期货文章</td>
                    <td>
                        <a href="article_edit.html" class="btn btn-xs btn-default">
                          <i class="fa fa-edit"></i> 编辑
                        </a>
                    </td>
                  </tr>
                  <tr>
                    <td><input type="checkbox" name="user_id[]" value="3"></td>
                    <td><input type="text" value="1" class="sort_inp" name="sort[]" data_id="1"></td>
                    <td>1</td>
                    <td>文章标题</td>
                    <td>2016-10-11</td>
                    <td>
                        <span class="label label-default">已禁用</span>
                    </td>
                    <td>期货文章</td>
                    <td>
                        <a href="article_edit.html" class="btn btn-xs btn-default">
                          <i class="fa fa-edit"></i> 编辑
                        </a>
                    </td>
                  </tr>
                  <tr>
                    <td><input type="checkbox" name="user_id[]" value="4"></td>
                    <td><input type="text" value="1" class="sort_inp" name="sort[]" data_id="1"></td>
                    <td>1</td>
                    <td>文章标题</td>
                    <td>2016-10-11</td>
                    <td>
                        <span class="label label-success">已启用</span>
                    </td>
                    <td>期货文章</td>
                    <td>
                        <a href="article_edit.html" class="btn btn-xs btn-default">
                          <i class="fa fa-edit"></i> 编辑
                        </a>
                    </td>
                  </tr>--}}
                </tbody>
              </table>
            </div>
            <!-- /.box-body -->
            <div class="box-footer clearfix" style="border: none;">
                {!! $article_list->appends(Request::query())->render() !!}
              {{--{!! page_render($article_list) !!}--}}
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
<div id="hidden-items" style="display: none;">
  <input type="hidden" name="_token" value="{{ csrf_token() }}" id="csrfToken">
</div><!-- /#hidden-items -->
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
{{--ajax js文件--}}
<script src="/plugins/jquery-toaster/jquery.toaster.js"></script>
<!-- pages script -->
<script src="/plugins/jquery-form/jquery.form.min.js"></script>
<script src="/assets/base.js"></script>
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
       	if($("tbody input[name='user_id[]']:checked").length==0)
       	{
       		alert("您没有选中的数据")
       	}
       	else
       	{
       		if(!confirm("您确定删除选中的文章"))
       		{
       			return;
       		}else{
              var article_ids = [];
              $("input[name='user_id[]']:checked").each(function(){
                article_ids.push($(this).val());
              });
              self.waiting = true;

              var data = {
                article_ids: article_ids,
                _token  : $('#csrfToken').val()
              };

              $.post('{{ route('admin.article.todel') }}', data, function(response) {
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
       		}else{
              //获取所有的选中id
                var article_ids = [];
                $("input[name='user_id[]']:checked").each(function(){
                  article_ids.push($(this).val());
                });
                self.waiting = true;

                var data = {
                  article_ids: article_ids,
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

                $.post('{{ route('admin.article.start') }}', data, function(response) {
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
       		}else{
                //获取所有的选中id
                var article_ids = [];
                $("input[name='user_id[]']:checked").each(function(){
                    article_ids.push($(this).val());
                });
                self.waiting = true;

                var data = {
                    article_ids: article_ids,
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

                $.post('{{ route('admin.article.forbid') }}', data, function(response) {
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
     
    //按条件筛选
    $(".form-horizontal").submit(function(){
    	if($("#inputName").val()==""&&$("#inputTel").val()=="")
    	{
    		alert("没有任何筛选条件");
    		return false;
    	}
    	if($("#inputName").val()=="")
    	{
    		
    	}
    	if($("#inputTel").val()=="")
    	{
    		
    	}
    })
  });
</script>
</body>
</html>

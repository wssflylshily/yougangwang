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

@include('admin._layouts.header')

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
      <form method="POST" class="main-form form-horizontal" accept-charset="UTF-8" autocomplete="off" novalidate="novalidate" >
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
        <div class="col-md-10">
          <!-- Default box -->
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">登录信息</h3>
            </div>
            <div class="box-body">
              <div class="form-group">
                <label for="inputEmail" class="col-sm-2 control-label">邮箱</label>
            
                <div class="col-sm-9">
                  <input type="email" class="form-control" id="inputEmail" required value="{{ $admin->email }}" name="email">
                </div>
              </div>
              <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">用户名</label>
            
                <div class="col-sm-9">
                  <input type="text" class="form-control" id="inputEmail3" required value="{{ $admin->name }}" name="name">
                </div>
              </div>
              {{--<div class="form-group">
                <label for="inputPassword3" class="col-sm-2 control-label">密码</label>
            
                <div class="col-sm-9">
                  <input type="password" class="form-control" id="inputPassword3" required placeholder="" name="password">
                </div>
              </div>
              <div class="form-group">
                <label for="inputPassword3" class="col-sm-2 control-label">确认密码</label>

                <div class="col-sm-9">
                  <input type="password" class="form-control" id="inputPassword3" required placeholder="" name="password2">
                </div>
              </div>--}}
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
                    @foreach ($roles as $role)
                    <option name="role_id" @if($role->id == $admin->role_id) selected @endif value="{{ $role->id }}">{{ $role->name }}</option>
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
                  <label class="btn btn-default btn-sm @if($admin->user_status == 1) active @endif">
                      <input type="radio" name="state_type" value="1">启用
                  </label>
                  <label class="btn btn-default btn-sm @if($admin->user_status == -1) active @endif">
                      <input type="radio" name="state_type" value="-1">禁用
                  </label>
              </div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

          <!-- Default box -->
          <!-- /.box -->
        </div>
        <!--/.col (left) -->

        <!-- right column -->
        {{--<div class="col-md-6">
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
        </div>--}}
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

  $("#sub_but").click(function () {
      var name = $('input[name="name"]').val();
      var email = $('input[name="email"]').val();
//      var password = $('input[name="password"]').val();
//      var password2 = $('input[name="password2"]').val();
      var role_id = $('option[name="role_id"]:selected').val();
      var state_type = $('input[name="state_type"]:checked').val()?$('input[name="state_type"]:checked').val():1;
//      alert(state_type);

      if(name == '' || email == '')
      {
        alert('信息填写不完整！');
        return false;
      }
      //对电子邮件的验证
      var myreg = /^([a-zA-Z0-9]+[_|\_|\.]?)*[a-zA-Z0-9]+@([a-zA-Z0-9]+[_|\_|\.]?)*[a-zA-Z0-9]+\.[a-zA-Z]{2,3}$/;
       if(!myreg.test(email))
      {
           alert('请输入有效的邮箱！');
            return false;
      }
      /*if (password != password2){
          alert('两次密码不一致！请重新输入');
          return false;
      }*/
      $.ajax({
          type:"POST",
          url:"{{ route('admin.admin.edit') }}",
          datatype: "json",
          data: {'_token': "{{ csrf_token() }}", 'name':name, 'email': email, 'role_id' :role_id, 'state' : state_type, 'id': "{{ $admin->id }}"},
          success:function(json){
              console.log(json);
              if (json.result == true){
                  window.location.href="{{ route('admin.admin.index') }}";
              }
          },
          error: function(){
          }
      });
  })
</script>
</body>
</html>

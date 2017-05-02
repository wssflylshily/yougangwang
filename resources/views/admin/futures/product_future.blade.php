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
  <!-- daterange picker -->
  <link rel="stylesheet" href="/plugins/daterangepicker/daterangepicker.css">
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
    
    .select_div > *{ display: inline-block; margin: 5px 3px;}
    .select_div select{border: 1px solid #e0e0e0; padding: 6px 10px;
 color: #999999; color: #333;}
 	.select_div input{padding: 7px 10px; border: 1px solid #e0e0e0; background: #fff;}
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
        商品管理
        <small>期货管理</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> 首页</a></li>
        <li>商品管理</li>
        <li class="active">期货管理</li>
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
            <div class="select_div">
							<div>
                                <select name="province">
                                    <option value="0">选择地区</option>
                                    @foreach($provinces as $province)
                                        <option @if($province->areaId == Request::input('province')) selected @endif value="{{ $province->areaId }}">{{ $province->areaName }}</option>
                                    @endforeach
                                </select>
							</div>
							<!-- <div class="div1">-</div>
							<div>
                                <select name="city">
                                    @if(Request::input('city') && isset($cities))
                                        @foreach($cities as $city)
                                            <option @if(Request::input('city') == $city->areaId)selected @endif value="{{ $city->areaId }}">{{ $city->areaName }}</option>
                                        @endforeach
                                    @else
                                        <option value="0">选择城市</option>
                                    @endif
                                </select>
							</div> -->
							<div>
                                <select class="w1" name="variety">
                                    <option value="0">选择品种</option>
                                    @foreach ( $varieties as $variety)
                                        <option @if (Request::input('variety') == $variety->name) selected @endif >{{ $variety->name }}</option>
                                    @endforeach
                                </select>
							</div>
							<div>
                                <select class="w1" name="standard">
                                    <option value="0">选择标准</option>
                                    @foreach ( $standards as $standard)
                                        <option @if (Request::input('standard') == $standard->name) selected @endif >{{ $standard->name }}</option>
                                    @endforeach
                                </select>
							</div>
							<div>
                                <select class="w1" name="material">
                                    <option value="0">选择材质</option>
                                    @foreach ( $materials as $material)
                                        <option @if (Request::input('material') == $material->name) selected @endif >{{ $material->name }}</option>
                                    @endforeach
                                </select>
							</div>
							<!-- <div>
                                <select class="w1" name="steelmill">
                                    <option value="0">选择钢厂</option>
                                    @foreach ( $steelmills as $steelmill)
                                        <option @if (Request::input('steelmill') == $steelmill->name) selected @endif >{{ $steelmill->name }}</option>
                                    @endforeach
                                </select>
							</div><br>
							<div>外径</div>
							<div>
								{{--<select name="waijing_x">
									<option>选择外径</option>
									<option>1</option>
									<option>2</option>
									<option>3</option>
								</select>--}}
                                <input type="text" style="width: 100px;" name="outer_diameter1" placeholder="输入外径范围" value="@if (Request::input('outer_diameter1') != null){{ Request::input('outer_diameter1') }}@endif">
							</div>
							<div class="div1">-</div>
							<div>
								{{--<select class="w2"  name="waijing_d">
									<option>选择外径1</option>
									<option>4</option>
									<option>5</option>
									<option>6</option>
								</select>--}}
                                <input type="text" style="width: 100px;" name="outer_diameter2" placeholder="输入外径范围" value="@if (Request::input('outer_diameter2') != null){{ Request::input('outer_diameter2') }}@endif">
							</div>
							<div class="div1">mm</div>
							<div></div>
							<div>厚度</div>
							<div>
								{{--<select class="w2" name="houdu_x">
									<option>选择厚度</option>
									<option>1</option>
									<option>2</option>
									<option>3</option>
								</select>--}}
                                <input type="text" style="width: 100px;" name="thickness1" placeholder="输入厚度范围" value="@if (Request::input('thickness1') != null){{ Request::input('thickness1') }}@endif">

                            </div>
							<div class="div1">-</div>
							<div>
								{{--<select class="w2" name="houdu_d">
									<option>选择厚度1</option>
									<option>4</option>
									<option>5</option>
									<option>6</option>
								</select>--}}
                                <input type="text" style="width: 100px;" name="thickness2" placeholder="输入厚度范围" value="@if (Request::input('thickness2') != null){{ Request::input('thickness2') }}@endif">

                            </div>
							<div class="div1">mm</div>
							<div></div>
							<div>长度</div>
							<div>
								{{--<select class="w2" name="changdu_x">
									<option>选择长度</option>
									<option>1</option>
									<option>2</option>
									<option>3</option>
								</select>--}}
                                <input type="text" style="width: 100px;" name="length1" placeholder="输入长度范围" value="@if (Request::input('length1') != null){{ Request::input('length1') }}@endif">

                            </div>
							<div class="div1">-</div>
							<div>
								{{--<select class="w2" name="changdu_d">
									<option>选择长度1</option>
									<option>4</option>
									<option>5</option>
									<option>6</option>
								</select>--}}
                                <input type="text" style="width: 100px;" name="length2" placeholder="输入长度范围" value="@if (Request::input('length2') != null){{ Request::input('length2') }}@endif">

                            </div>
							<div class="div1">m</div><br> -->
							<div>交货日期</div>
							<div>
								<input type="text" name="search_datestart" id="reservation_start" placeholder="选择日期" value="">
							</div>
							<div>-</div>
							<div><input type="text" name="search_datestart" id="reservation_end" placeholder="选择日期" value=""></div>
							<!-- <div class="div1">
								{{--<select class="w3" name="search_kind">
									<option value="产品">产品</option>
									<option value="商家">商家</option>
								</select>--}}
                                <input type="text" style="width: 110px;" name="price1" placeholder="输入价格范围" value="@if (Request::input('price1') != null){{ Request::input('price1') }}@endif">

                            </div><div class="div1"><input type="text" name="search_content" placeholder="输入搜索内容" value=""></div> -->
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
              <h3 class="box-title">商品一览</h3>

              <div class="box-tools">
                 {{-- <div class="btn-group" style="margin-bottom: 5px;">
					<button type="button" class="btn btn-sm text-warning start-selected"><i class="fa fa-archive"></i> 启用</button>
					<button type="button" class="btn btn-sm text-warning end-selected"><i class="fa fa-archive"></i> 禁用</button>
					--}}{{--<button type="button" class="btn btn-sm text-success tuijian-selected"> 一键推荐</button>
					<button type="button" class="btn btn-sm text-success sort-selected"> 一键排序</button>--}}{{--
                    
                  </div>--}}
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive">
              <table class="table table-bordered table-hover">
                <thead style="background-color: #ddd;">
                  <tr>
                    <th width="30"><input type="checkbox"></th>
                    {{--<th>排序</th>--}}
                    <th width="50">ID</th>
                    <th>地区</th>
                    {{--<th>商品名称</th>--}}
                    <th>品种</th>                
                    <th>标准</th>
                    <th>材质</th>               
                    <th>联系人</th>
                    <th>电话</th>
                    <th>钢厂</th>
                    <!-- <th>推荐</th>
                    <th>状态</th> -->
                    <th>交货日期</th>
                    {{--<th width="100">操作</th>--}}
                  </tr>
                </thead>
                <tbody>
                @foreach($lists as $future)
                    <tr>
                        <td><input type="checkbox" name="pro_id[]" value="1"></td>
                        {{--<td><input type="text" value="1" class="sort_inp" name="sort[]" data_id="1"></td>--}}
                        <td>{{ $future->id }}</td>
                        <td>{{ $future->areaName or '全部' }}</td>
                        {{--<td>商品名称1</td>--}}
                        <td>{{$future->variety or '全部'}}</td>
                        <td>{{$future->standard or '全部'}}</td>
                        <td>{{$future->material or '全部'}}</td>
                        <td>{{$future->order->user->name or ''}}</td>
                        <td>{{$future->order->user->mobile or ''}}</td>
                        <td>{{$future->steelmill}}</td>
                       <!--  <td>是</td>
                        <td><span class="label label-success">启用</span></td> -->
                        <td><?php echo date('Y年m月d日',strtotime($future->delivery_date)); ?></td>
                        {{--<td>
                            <a href="productfuture_detail.html" class="btn btn-xs btn-default">
                                查看详情
                            </a>
                        </td>--}}
                    </tr>
                @endforeach
                </tbody>
              </table>
            </div>
            <!-- /.box-body -->
            <div class="box-footer clearfix" style="border: none;">

                {!! $lists->appends(Request::query())->render() !!}
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
<script src="/assets/admin/js/product.js"></script>
<!-- Page script -->
<!-- bootstrap datepicker -->
<script src="/plugins/datepicker/bootstrap-datepicker.js"></script>
<script>
  $(function () {
  	//Date range picker
  	$('#reservation_start').datepicker({
      autoclose: true
    });
    $('#reservation_end').datepicker({
      autoclose: true
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
    //一键启用
    $(document).on('click', '.start-selected', function() {
        user.startSelected();//product.js
    });
    //一键禁用
    $(document).on('click', '.end-selected', function() {
        user.endSelected();//product.js
    });
    //一键推荐
    $(document).on('click', '.tuijian-selected', function() {
        user.tuijianSelected();//product.js
    });
    //一键排序
    $(document).on('click','.sort-selected',function(){
    	var sort_li=[];
    	var sort_id=[];
    	$("input[name='sort[]']").each(function(index,e){
	  		sort_id[index]=$(this).attr("data_id");
    		sort_li[index]=$(this).val();
    	})
    	//console.log(sort_li+sort_id);
    	
    }); 
    //按条件筛选
    $(".form-horizontal").submit(function(){
    	var district=$("select[name='district']");
		var city=$("select[name='city']");
		var kind=$("select[name='kind']");
		var standar=$("select[name='standar']");
		var material=$("select[name='material']");
		var gangchang=$("select[name='gangchang']");
		var waijing_x=$("select[name='waijing_x']");
		var waijing_d=$("select[name='waijing_d']");
		var houdu_x=$("select[name='houdu_x']");
		var houdu_d=$("select[name='houdu_d']");
		var changdu_x=$("select[name='changdu_x']");
		var changdu_d=$("select[name='changdu_d']");
		var date_start=$("input[name='search_datestart']");
		var date_end=$("input[name='search_dateend']");
		var search_kind=$("select[name='search_kind']");
		var search_content=$("input[name='search_content']");
    })
  });
</script>
</body>
</html>

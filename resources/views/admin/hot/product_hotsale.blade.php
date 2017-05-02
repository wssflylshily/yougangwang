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
        <small>特卖管理</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> 首页</a></li>
        <li>商品管理</li>
        <li class="active">特卖管理</li>
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
				<div class="div1">-</div>
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
				</div>
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
				<div>
					<select class="w1" name="steelmill">
						<option value="0">选择钢厂</option>
						@foreach ( $steelmills as $steelmill)
							<option @if (Request::input('steelmill') == $steelmill->name) selected @endif >{{ $steelmill->name }}</option>
						@endforeach
					</select>
				</div><br>
				<div>外径</div>
				<div>
					{{--<select name="outer_diameter1">
						<option value="0">选择外径</option>
						@foreach ( config('const.goods_outer_diameter1') as $outer_diameter)
							<option @if (Request::input('outer_diameter1') == $outer_diameter) selected @endif >{{ $outer_diameter }}</option>
						@endforeach
					</select>--}}
					<input type="text" style="width: 100px;" name="outer_diameter1" placeholder="输入外径范围" value="@if (Request::input('outer_diameter1') != null){{ Request::input('outer_diameter1') }}@endif">
				</div>
				<div class="div1">-</div>
				<div>
					{{--<select class="w2"  name="outer_diameter2">
						<option value="0">选择外径</option>
						@foreach ( config('const.goods_outer_diameter2') as $outer_diameter)
							<option @if (Request::input('outer_diameter2') == $outer_diameter) selected @endif >{{ $outer_diameter }}</option>
						@endforeach
					</select>--}}
					<input type="text" style="width: 100px;" name="outer_diameter2" placeholder="输入外径范围" value="@if (Request::input('outer_diameter2') != null){{ Request::input('outer_diameter2') }}@endif">
				</div>
				<div class="div1">mm</div>
				<div></div>
				<div>厚度</div>
				<div>
					{{--<select class="w2" name="thickness1">
						<option value="0">选择厚度</option>
						@foreach ( config('const.goods_thickness1') as $thickness)
							<option @if (Request::input('thickness1') == $thickness) selected @endif >{{ $thickness }}</option>
						@endforeach
					</select>--}}
					<input type="text" style="width: 100px;" name="thickness1" placeholder="输入厚度范围" value="@if (Request::input('thickness1') != null){{ Request::input('thickness1') }}@endif">
				</div>
				<div class="div1">-</div>
				<div>
					{{--<select class="w2" name="thickness2">
						<option value="0">选择厚度</option>
						@foreach ( config('const.goods_thickness2') as $thickness)
							<option @if (Request::input('thickness2') == $thickness) selected @endif >{{ $thickness }}</option>
						@endforeach
					</select>--}}
					<input type="text" style="width: 100px;" name="thickness2" placeholder="输入厚度范围" value="@if (Request::input('thickness2') != null){{ Request::input('thickness2') }}@endif">
				</div>
				<div class="div1">mm</div>
				<div></div>
				<div>长度</div>
				<div>
					{{--<select class="w2" name="length1">
						<option value="0">选择长度</option>
						@foreach ( config('const.goods_length1') as $length)
							<option @if (Request::input('length1') == $length) selected @endif >{{ $length }}</option>
						@endforeach
					</select>--}}
					<input type="text" style="width: 100px;" name="length1" placeholder="输入长度范围" value="@if (Request::input('length1') != null){{ Request::input('length1') }}@endif">
				</div>
				<div class="div1">-</div>
				<div>
					{{--<select class="w2" name="length2">
						<option value="0">选择长度</option>
						@foreach ( config('const.goods_length2') as $length)
							<option @if (Request::input('length2') == $length) selected @endif >{{ $length }}</option>
						@endforeach
					</select>--}}
					<input type="text" style="width: 100px;" name="length2" placeholder="输入长度范围" value="@if (Request::input('length2') != null){{ Request::input('length2') }}@endif">
				</div>
				<div class="div1">m</div><br>
				<div>价格（出厂价）</div>
				<div>
					{{--<select class="w2" name="price1">
						<option value="0">选择价格</option>
						@foreach ( config('const.goods_price1') as $price)
							<option @if (Request::input('price1') == $price) selected @endif >{{ $price }}</option>
						@endforeach
					</select>--}}
					<input type="text" style="width: 110px;" name="price1" placeholder="输入价格范围" value="@if (Request::input('price1') != null){{ Request::input('price1') }}@endif">
				</div>
				<div class="div1">-</div>
				<div>
					{{--<select class="w2" name="price2">
						<option value="0" >选择价格</option>
						@foreach ( config('const.goods_price2') as $price)
							<option @if (Request::input('price2') == $price) selected @endif >{{ $price }}</option>
						@endforeach
					</select>--}}
					<input type="text" style="width: 110px;" name="price2" placeholder="输入价格范围" value="@if (Request::input('price2') != null){{ Request::input('price2') }}@endif">
				</div>
				<div class="div1">元</div>
				<div></div>
				<div class="div1">
					<select class="w3" name="search_key">
						<option @if (Request::input('search_key') == 'variety') selected @endif value="variety">产品</option>
						<option @if (Request::input('search_key') == 'steelmill') selected @endif value="steelmill">钢厂</option>
					</select>
				</div>
				<div class="div1"><input type="text" name="search_content" placeholder="输入搜索内容" value="@if (Request::input('search_content') != null){{ Request::input('search_content') }}@endif"></div>
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
                  <div class="btn-group" style="margin-bottom: 5px;">
					<button type="button" class="btn btn-sm text-warning start-selected"><i class="fa fa-archive"></i> 启用</button>
					<button type="button" class="btn btn-sm text-warning end-selected"><i class="fa fa-archive"></i> 禁用</button>
					<button type="button" class="btn btn-sm text-danger deletehot-selected">取消特卖</button>
					  {{--<button type="button" class="btn btn-sm text-success tuijian-selected"> 一键推荐</button>
                      <button type="button" class="btn btn-sm text-success sort-selected"> 一键排序</button>
                      <button type="button" class="btn btn-sm text-success delete-selected"> 一键删除</button>--}}
                    
                  </div>
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
					  <th>规格</th>
					  <th>钢厂</th>
					  <th>库存</th>
					  <th>状态</th>
					  <th>价格</th>
					  {{--<th width="100">操作</th>--}}
                  </tr>
                </thead>
                <tbody>
				@foreach($hot_list as $goods)
					<tr>
						<td><input type="checkbox" name="pro_id[]" value="{{$goods->id}}"></td>
						{{--<td><input type="text" value="{{$goods->id}}" class="sort_inp" name="sort[]" data_id="1"></td>--}}
						<td>{{$goods->id}}</td>
						<td>{{$goods->areaName}}</td>
						{{--<td>{{$goods->name}}</td>--}}
						<td>{{$goods->variety}}</td>
						<td>{{$goods->standard}}</td>
						<td>{{ $goods->length . '*' . $goods->thickness . '*' . $goods->outer_diameter }}</td>
						<td>{{$goods->steelmill}}</td>
						<td>{{$goods->stock}}@if($goods->unit==1)吨@else支@endif</td>
						@if($goods->status == 1 )
							<td><span class="label label-success">启用</span></td>
						@else
							<td><span class="label label-default">禁用</span></td>
						@endif
						<td>{{$goods->price}} 元/@if($goods->unit==1)吨@else支@endif</td>
						{{--<td>
                          <a href="product_detail.html" class="btn btn-xs btn-default">
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
              {{--{!! page_render($hot_list) !!}--}}
                {!! $hot_list->appends(Request::query())->render() !!}
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

<script src="/plugins/jquery-toaster/jquery.toaster.js"></script>
<!-- page script 全选-->
<script src="/assets/base.js"></script>
<script src="/assets/admin/js/product.js"></script>
<!-- Page script -->
<script>

    $('select[name="province"]').on('change',function(){
        var areaid = $(this).val();
        $.ajax({
            type:"GET",
            url:"{{route('shop.area.city')}}",
            data:{areaId:areaid},
            datatype: "json",
            success:function(json){
                var data = JSON.parse(json);
                console.log(data);
                if(data != null){
                    var str = "";
                    for(var i=0;i<data.length;i++){
                        str += '<option value="'+data[i].areaId+'">'+data[i].areaName+'</option>';
                    }
                    $('select[name="city"]').html("");
                    $('select[name="city"]').append(str);
                }else{
                    var str = '<option value="0">选择城市</option>';
                    $('select[name="city"]').html("");
                    $('select[name="city"]').append(str);
                }
            }
        });
    });

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

    var user = new User();
    //一键启用
    $(document).on('click', '.start-selected', function() {
        //user.startSelected();//product.js
        var selected = [];
        $('input:checked[name="pro_id[]"]').each(function() {
            selected.push($(this).val());
        });


        if (selected.length < 1) {
            alert('您没有选中要启用的商品');
            return;
        }

        var data = {
            goods_id: selected,
            status: 1,
            _token  : "{{ csrf_token() }}"
        };

        if (!confirm('您确定要启用选中的商品吗？')) {
            alert(selected);
            return;
        }
        $.post('{{ route('admin.hot.active') }}', data, function(response) {
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
    });
    //一键禁用
    $(document).on('click', '.end-selected', function() {
        //user.endSelected();//product.js
        var selected = [];
        $('input:checked[name="pro_id[]"]').each(function() {
            selected.push($(this).val());
        });


        if (selected.length < 1) {
            alert('您没有选中要禁用的商品');
            return;
        }

        var data = {
            goods_id: selected,
            status: -1,
            _token  : "{{ csrf_token() }}"
        };

        if (!confirm('您确定要禁用选中的商品吗？')) {
            alert(selected);
            return;
        }
        $.post('{{ route('admin.hot.active') }}', data, function(response) {
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
    });
    //一键推荐
    $(document).on('click', '.tuijian-selected', function() {
        user.tuijianSelected();//product.js
    });
    //一键热卖
    $(document).on('click','.deletehot-selected',function(){
    	//取消特卖
    	//user.deletehotSelected();
        var selected = [];
        $('input:checked[name="pro_id[]"]').each(function() {
            selected.push($(this).val());
        });


        if (selected.length < 1) {
            alert('您没有选中要取消特卖的商品');
            return;
        }

        var data = {
            goods_id: selected,
            status: 0,
            _token  : "{{ csrf_token() }}"
        };

        if (!confirm('您确定要取消特卖选中的商品吗？')) {
            alert(selected);
            return;
        }
        $.post('{{ route('admin.hot.special') }}', data, function(response) {
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
    }); 
     //一键删除
    $(document).on('click','.delete-selected',function(){
    	//取消特卖
    	user.deleteSelected();
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
		var price_x=$("select[name='price_x']");
		var price_d=$("select[name='price_d']");
		var search_kind=$("select[name='search_kind']");
		var search_content=$("input[name='search_content']");
    })
  });
</script>
</body>
</html>

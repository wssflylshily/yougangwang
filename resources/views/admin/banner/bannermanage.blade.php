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
    <link rel="stylesheet" href="/assets/shop/css/weui.min.css" />
    <link rel="stylesheet" href="/assets/shop/css/jquery-weui.css" />
    <link rel="stylesheet" href="/assets/shop/css/style.css" />
    <link rel="stylesheet" href="/assets/shop/css/person.css"/>

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

        .sc_img{ border: 1px solid #797979; background: url(/assets/shop/img/pic.png) #f7f7f7 center center no-repeat; position:relative; overflow: hidden; width: 360px; height: 84px;}
        .sc_img .sc_btn{ position: absolute; opacity: 0; left: 0px; right: 0px; top: 0px; bottom: 0px; z-index: 3;}
    </style>
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

@include('admin._layouts.header')
    <!-- Left side column. contains the logo and sidebar -->


    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                基本信息
                <small>banner信息</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="/admin"><i class="fa fa-dashboard"></i> 首页</a></li>
                <li>基本信息</li>
                <li class="active">banner信息</li>
            </ol>
        </section>

        <!-- Main content -->
        <form action="{{ route('admin.banner.add.post') }}" method="post">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
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
                            <h3 class="box-title">banner信息</h3>
                        </div>
                        <!--<div class="box box-info" style="padding-bottom: 60px;">-->
                        <div class="box-body table-responsive contract">
                            <div class="enclosure">
                                <ul class="clear" id="result_pic">
                                    <li>
                                        <div class="img_div"><input type="file" id="sc_btn" name="sc_img" class="sc_btn" /></div>
                                    </li>
                                    @if($banner)
                                        @foreach($banner as $item)
                                            <li style="width: 360px;height: 84px;margin-bottom: 30px;"><div class=""><img src="{{ $item->img }}" width="360" height="84"></div>
                                                <div class="font_size clear">
                                                    {{--<a href="javascript:;" class="L check_fj">查看</a>
                                                    <a href="banner/delete/{{ $item->id }}" class="L delete_fj">删除</a>--}}
                                                    <a href="{{route('admin.banner.delete',['id'=>$item->id])}}" class="L delete_fj">删除</a>
                                                </div>
                                            </li>
                                        @endforeach
                                    @endif
                                </ul>
                            </div>
                            {{--@if($banner)
                                @foreach($banner as $item)

                                    <div class="banner_div">
                                        <table class="zl_table">
                                            <tr>
                                                <td width="100" align="right">banenr图</td>
                                                <td>
                                                    <div class="sc_img">
                                                        <img src="{{ $item->img }}" width="360" height="84">
                                                        <input type="file" class="sc_btn" />
                                                    </div>
                                                    <a href="{{ route('admin.banner.delete', ['banner_id'=>$item->id, '_token'=>csrf_token()]) }}" class="delete_banner">删除</a>
                                                </td>
                                            </tr>
                                            --}}{{--<tr>
                                                <td width="100" align="right">链接地址</td>
                                                <td><input type="text" name="name_name" placeholder="链接地址" value="javascript:;"></td>
                                            </tr>--}}{{--
                                        </table>
                                    </div>
                                @endforeach
                            @endif--}}


                            {{--<div class="banner_div">
                                <table class="zl_table">
                                    <tr>
                                        <td width="100" align="right">banenr图</td>
                                        <td>
                                            <div class="sc_img">
                                                <img src="alpha.png" width="360" height="84">
                                                <input type="file" class="sc_btn" />
                                            </div>
                                            <a href="javascript:;" class="delete_banner">删除</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="100" align="right">链接地址</td>
                                        <td><input type="text" name="name_name" placeholder="链接地址" value="javascript:;"></td>
                                    </tr>
                                </table>
                            </div>
                            <div class="banner_div">
                                <table class="zl_table">
                                    <tr>
                                        <td width="100" align="right">banenr图</td>
                                        <td>
                                            <div>
                                                <div class="sc_img">
                                                    <img src="alpha.png" width="360" height="84">
                                                    <input type="file" class="sc_btn" />
                                                </div>
                                                <a href="javascript:;" class="delete_banner">删除</a>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="100" align="right">链接地址</td>
                                        <td><input type="text" name="name_name" placeholder="链接地址" value="javascript:;"></td>
                                    </tr>
                                </table>
                            </div>--}}
                            {{--<div class="add_img" style=" background: #C81825; padding: 10px; color: #FFFFFF; cursor: pointer; display: inline-block; margin: 10px 10px;">添加banner图</div>--}}
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
<script>
    window.onload = function(){
        var input = document.getElementById("sc_btn");
        var result_pic= document.getElementById("result_pic");
        var img_area = document.getElementById("img_area");
        if ( typeof(FileReader) === 'undefined' ){
            result_pic.innerHTML = "抱歉，你的浏览器不支持 FileReader，请使用现代浏览器操作！";
            input.setAttribute( 'disabled','disabled' );
        } else {
            input.addEventListener( 'change',readFile,false );}
    }
    function readFile(){
        var file = this.files[0];
        //这里我们判断下类型如果不是图片就返回 去掉就可以上传任意文件
        if(!/image\/\w+/.test(file.type)){
            alert("请确保文件为图像类型");
            return false;
        }
        var reader = new FileReader();
        reader.readAsDataURL(file);
        reader.onload = function(e){
            var stra="";
            stra +=
                '<li style="width: 360px;height: 84px;"><div class=""><img src="'+this.result+'"  width="360" height="84"></div>'+
                '<div class="font_size clear">'+
                '<input type="hidden" value="'+this.result+'" name="pic_url[]">'+
                //'<a href="javascript:;" class="L check_fj">查看</a>'+
                '<a href="javascript:;" class="R delete_fj">删除</a>'+
                '</div></li>';
            $("#result_pic").append(stra);
        }
    }
</script>
<script>
    $(function(){
        $(document).on("click",".delete_banner",function(){
            $(this).parents(".banner_div").remove();
        });
        $(".add_img").click(function(){
            var str='<div class="banner_div">\
      					<table class="zl_table">\
				    			<tr>\
				    				<td width="100" align="right">banenr图</td>\
				    				<td>\
				    					<div>\
				    						<div class="sc_img"><input type="file" class="sc_btn"></div>\
				    						<a href="javascript:;" class="delete_banner">删除</a>\
				    					</div>\
				    				</td>\
				    			</tr>\
				    			<tr>\
				    				<td width="100" align="right">链接地址</td>\
				    				<td><input type="text" name="name_name" placeholder="链接地址" value="javascript:;"></td>\
				    			</tr>\
				    		</table>\
      				</div>';
            $(this).before(str);
        })
    })
</script>

</body>
</html>


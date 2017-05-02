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

        .sc_img{ border: 1px solid #797979; background: url(/assets/shop/img/pic.png) #f7f7f7 center center no-repeat; position:relative; overflow: hidden; width: 360px; height: 84px;}
        .sc_img .sc_btn{ position: absolute; opacity: 0; left: 0px; right: 0px; top: 0px; bottom: 0px; z-index: 3;}
    </style>
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

    <header class="main-header">
        <!-- Logo -->
        <a href="/admin" class="logo">
            <!-- mini logo for sidebar mini 50x50 pixels -->
            <span class="logo-mini"><b>后台</b></span>
            <!-- logo for regular state and mobile devices -->
            <span class="logo-lg text-left"><b>优钢（管理后台）</b></span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top">
            <!-- Sidebar toggle button-->
            <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                <span class="sr-only">Toggle navigation</span>
            </a>

            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">
                    <!-- User Account: style can be found in dropdown.less -->
                    <li class="dropdown user user-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <img src="/assets/admin/img/user2-160x160.jpg" class="user-image" alt="User Image">
                            <span class="hidden-xs">Alexander Pierce</span>
                        </a>
                        <ul class="dropdown-menu">
                            <!-- User image -->
                            <li class="user-header">
                                <img src="/assets/admin/img/user2-160x160.jpg" class="img-circle" alt="User Image">

                                <p>超级管理员</p>
                            </li>
                            <!-- Menu Footer-->
                            <li class="user-footer">
                                <div class="pull-left">
                                    <a href="#" class="btn btn-default btn-flat">资料</a>
                                </div>
                                <div class="pull-right">
                                    <a href="#" class="btn btn-default btn-flat">退出</a>
                                </div>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>
    </header>
    <!-- Left side column. contains the logo and sidebar -->
    <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
            <!-- Sidebar user panel -->
            <div class="user-panel">
                <div class="pull-left image">
                    <img src="/assets/admin/img/user2-160x160.jpg" class="img-circle" alt="User Image">
                </div>
                <div class="pull-left info">
                    <p style="line-height: 36px;">您好，管理员</p>
                </div>
            </div>
            <!-- sidebar menu: : style can be found in sidebar.less -->
            {{-- <ul class="sidebar-menu">
                <li class="header"><!--主导航--></li>
                <li>
                    <a href="#">
                        <i class="fa fa-dashboard"></i> <span>后台首页</span>
            <span class="pull-right-container">
            </span>
                    </a>
                </li>

                <li class="divider"></li>

                <li class="treeview">
                    <a href="javascript:;">
                        <i class="fa fa-files-o"></i>
                        <span>会员管理</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="index.html"><i class="fa fa-circle-o"></i> 商家会员</a></li>
                        <li><a href="user_manage.html"><i class="fa fa-circle-o"></i> 注册会员</a></li>
                    </ul>
                </li>
                <li class="treeview">
                    <a href="javascript:;">
                        <i class="fa fa-files-o"></i>
                        <span>商品管理</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="product_now.html"><i class="fa fa-circle-o"></i> 现货管理</a></li>
                        <li><a href="product_future.html"><i class="fa fa-circle-o"></i> 期货管理</a></li>
                        <li><a href="product_hotsale.html"><i class="fa fa-circle-o"></i> 特卖管理</a></li>
                    </ul>
                </li>
                <li class="treeview">
                    <a href="javascript:;">
                        <i class="fa fa-files-o"></i>
                        <span>合同管理</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="contract_list.html"><i class="fa fa-circle-o"></i> 合同列表</a></li>
                    </ul>
                </li>

                <li class="divider"></li>

                <li class="treeview">
                    <a href="javascript:;">
                        <i class="fa fa-files-o"></i>
                        <span>订单管理</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="order_now.html"><i class="fa fa-circle-o"></i> 现货订单</a></li>
                        <li><a href="order_future.html"><i class="fa fa-circle-o"></i> 期货订单</a></li>
                        <li><a href="order_hotsale.html"><i class="fa fa-circle-o"></i> 特卖订单</a></li>
                    </ul>
                </li>
                --}}{{--<li class="treeview">
                    <a href="javascript:;">
                        <i class="fa fa-book"></i>
                        <span>网站设置</span>
        		<span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="article_list.html"><i class="fa fa-circle-o"></i> 现货文章</a></li>
                        <li><a href="article_list.html"><i class="fa fa-circle-o"></i> 期货文章</a></li>
                        <li><a href="article_list.html"><i class="fa fa-circle-o"></i> 聚划算</a></li>
                        <li><a href="article_list.html"><i class="fa fa-circle-o"></i> 了解物流</a></li>
                        <li><a href="article_list.html"><i class="fa fa-circle-o"></i> 关于我们</a></li>
                        <li><a href="article_list.html"><i class="fa fa-circle-o"></i> 其他文章</a></li>
                    </ul>
                </li>--}}{{--
                <li class="treeview">
                    <a href="javascript:;">
                        <i class="fa fa-book"></i>
                        <span>基本信息</span>
        		<span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="/admin/banner"><i class="fa fa-circle-o"></i> banner管理</a></li>
                        <li><a href="website_city.html"><i class="fa fa-circle-o"></i> 城市管理</a></li>
                        <li><a href="website_steel.html"><i class="fa fa-circle-o"></i> 钢铁信息</a></li>
                        <li><a href="website_footer.html"><i class="fa fa-circle-o"></i> 底部信息</a></li>
                    </ul>
                </li>
            </ul>--}}
            <ul class="sidebar-menu">
                <li class="header"><!--主导航--></li>
                <li>
                    <a href="/admin">
                        <i class="fa fa-dashboard"></i> <span>后台首页</span>
            <span class="pull-right-container">
            </span>
                    </a>
                </li>

                <li class="divider"></li>

                <li class="treeview">
                    <a href="javascript:;">
                        <i class="fa fa-files-o"></i>
                        <span>会员管理</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="/admin/seller"><i class="fa fa-circle-o"></i> 商家会员</a></li>
                        <li><a href="/admin/user"><i class="fa fa-circle-o"></i> 注册会员</a></li>
                    </ul>
                </li>
                <li class="treeview">
                    <a href="javascript:;">
                        <i class="fa fa-files-o"></i>
                        <span>商品管理</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="/admin/stock"><i class="fa fa-circle-o"></i> 现货管理</a></li>
                        <li><a href="/admin/future"><i class="fa fa-circle-o"></i> 期货管理</a></li>
                        <li><a href="/admin/hot"><i class="fa fa-circle-o"></i> 特卖管理</a></li>
                    </ul>
                </li>
                <li class="treeview">
                    <a href="javascript:;">
                        <i class="fa fa-files-o"></i>
                        <span>合同管理</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="/admin/contract"><i class="fa fa-circle-o"></i> 合同列表</a></li>
                    </ul>
                </li>

                <li class="divider"></li>

                <li class="treeview">
                    <a href="javascript:;">
                        <i class="fa fa-files-o"></i>
                        <span>订单管理</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                    </a>
                    <ul class="treeview-menu">
                        {{--<li><a href="admin/order"><i class="fa fa-circle-o"></i> 订单列表</a></li>--}}
                        <li><a href="/admin/order"><i class="fa fa-circle-o"></i> 现货订单</a></li>
                        <li><a href="{{URL::route('admin.order.future')}}"><i class="fa fa-circle-o"></i> 期货订单</a></li>
                        {{--<li><a href="order_now.html"><i class="fa fa-circle-o"></i> 现货订单</a></li>
                        <li><a href="order_future.html"><i class="fa fa-circle-o"></i> 期货订单</a></li>
                        <li><a href="order_hotsale.html"><i class="fa fa-circle-o"></i> 特卖订单</a></li>--}}
                    </ul>
                </li>
                <li class="treeview">
                    <a href="javascript:;">
                        <i class="fa fa-book"></i>
                        <span>网站设置</span>
                 <span class="pull-right-container">
               <i class="fa fa-angle-left pull-right"></i>
             </span>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="article_list.html"><i class="fa fa-circle-o"></i> 现货文章</a></li>
                        <li><a href="article_list.html"><i class="fa fa-circle-o"></i> 期货文章</a></li>
                        <li><a href="article_list.html"><i class="fa fa-circle-o"></i> 聚划算</a></li>
                        <li><a href="article_list.html"><i class="fa fa-circle-o"></i> 了解物流</a></li>
                        <li><a href="article_list.html"><i class="fa fa-circle-o"></i> 联系我们</a></li>
                        <li><a href="article_list.html"><i class="fa fa-circle-o"></i> 其他文章</a></li>
                        <li><a href="article_list.html"><i class="fa fa-circle-o"></i> 关于我们</a></li>
                    </ul>
                </li>
                <li class="treeview">
                    <a href="javascript:;">
                        <i class="fa fa-book"></i>
                        <span>基本信息</span>
        		<span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="/admin/banner"><i class="fa fa-circle-o"></i> banner管理</a></li>
                        <li><a href="website_city.html"><i class="fa fa-circle-o"></i> 城市管理</a></li>
                        <li><a href="website_steel.html"><i class="fa fa-circle-o"></i> 钢铁信息</a></li>
                        <li><a href="website_footer.html"><i class="fa fa-circle-o"></i> 底部信息</a></li>
                    </ul>
                </li>
            </ul>
        </section>
        <!-- /.sidebar -->
    </aside>

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
                        <div class="box-body table-responsive">
                            <div class="banner_div">
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
                            {{--<div class="banner_div">
                                <table class="zl_table">
                                    <tr>
                                        <td width="100" align="right">banenr图</td>
                                        <td>
                                            --}}{{--<div class="sc_img">--}}{{--
                                                --}}{{--<img src="alpha.png" width="360" height="84">
                                                <input type="file" class="sc_btn" />--}}{{--
                                                <input class="form-control" type="text" name="head_log" id="img_url_0" value="" readonly style="width:400px" required/>
                                                <input type="button" id="uploadButton_0" value="上传头像" />
                                                --}}{{--</div>--}}{{--
                                            <a href="javascript:;" class="delete_banner">删除</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="100" align="right">链接地址</td>
                                        <td><input type="text" name="name_name" placeholder="链接地址" value="javascript:;"></td>
                                    </tr>
                                </table>
                            </div>--}}
                            {{--<div class="form-group">
                                <label class="col-sm-3 control-label" style="text-align:right">上传头像图片 <span class="asterisk">*</span></label>
                                <div class="col-sm-2">
                                    <input class="form-control" type="text" name="head_log" id="img_url_0" value="" readonly style="width:400px" required/>
                                    <input type="button" id="uploadButton_0" value="上传头像" />
                                </div>
                            </div>--}}
                            <div class="add_img" style=" background: #C81825; padding: 10px; color: #FFFFFF; cursor: pointer; display: inline-block; margin: 10px 10px;">添加banner图</div>
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
{{--<script src="/plugins/editor></script>--}}
<script charset="utf-8" src="/plugins/editor/kindeditor-min.js"></script>
<script charset="utf-8" src="/plugins/editor/lang/zh_CN.js"></script>

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

    $("input[type='file']").each(function(){
        $(this).change(function(){
            var cv = $(this).attr('name');
            var file = this.files[0];
            var reader = new FileReader();
            reader.onload = function(e){
                $('.'+cv).attr('src',e.target.result);
            }
            reader.readAsDataURL(file);
        });
    });
</script>
<script type="text/javascript">

    var xj = "{$info.xingji}";

    if(xj==5){
        $('.haha').css('display','block');
    }


    $("#zv").change(function(){

        if($(this).val()==5){
            $('.haha').css('display','block');
        }else{
            $('.haha').css('display','none');
        }

    });

    KindEditor.ready(function(K) {
        K.create('#content', {
            themeType : 'simple',
            uploadJson : '/plugins/admineditor/php/upload_json.php',
            items:['source','|', 'undo', 'redo', '|', 'preview', 'template', 'code', 'cut', 'copy', 'paste','plainpaste', 'wordpaste', '|', 'justifyleft', 'justifycenter', 'justifyright','justifyfull', 'insertorderedlist', 'insertunorderedlist', 'indent', 'outdent', 'subscript','superscript', 'clearhtml', 'quickformat', 'selectall', '|', '/','formatblock', 'fontname', 'fontsize', '|', 'forecolor', 'hilitecolor', 'bold','italic', 'underline', 'strikethrough', 'lineheight', 'removeformat', '|', 'image', 'multiimage','insertfile', 'table', 'hr', 'emoticons', 'baidumap', 'pagebreak','anchor', 'link', 'unlink']
        });
    });
    KindEditor.ready(function(K) {
        K.create('#content_mb', {
            themeType : 'simple',
            uploadJson : '/plugins/admineditor/php/upload_json.php',
            items:['source','|', 'undo', 'redo', '|', 'preview', 'template', 'code', 'cut', 'copy', 'paste','plainpaste', 'wordpaste', '|', 'justifyleft', 'justifycenter', 'justifyright','justifyfull', 'insertorderedlist', 'insertunorderedlist', 'indent', 'outdent', 'subscript','superscript', 'clearhtml', 'quickformat', 'selectall', '|', '/','formatblock', 'fontname', 'fontsize', '|', 'forecolor', 'hilitecolor', 'bold','italic', 'underline', 'strikethrough', 'lineheight', 'removeformat', '|', 'image', 'multiimage','insertfile', 'table', 'hr', 'emoticons', 'baidumap', 'pagebreak','anchor', 'link', 'unlink']
        });
    });
    KindEditor.ready(function(K) {
        K.create('#content_en', {
            themeType : 'simple',
            uploadJson : '/plugins/admineditor/php/upload_json.php',
            items:['source','|', 'undo', 'redo', '|', 'preview', 'template', 'code', 'cut', 'copy', 'paste','plainpaste', 'wordpaste', '|', 'justifyleft', 'justifycenter', 'justifyright','justifyfull', 'insertorderedlist', 'insertunorderedlist', 'indent', 'outdent', 'subscript','superscript', 'clearhtml', 'quickformat', 'selectall', '|', '/','formatblock', 'fontname', 'fontsize', '|', 'forecolor', 'hilitecolor', 'bold','italic', 'underline', 'strikethrough', 'lineheight', 'removeformat', '|', 'image', 'multiimage','insertfile', 'table', 'hr', 'emoticons', 'baidumap', 'pagebreak','anchor', 'link', 'unlink']
        });
    });
    KindEditor.ready(function(K) {
        $("input[id^='uploadButton_']").each(function(i,v){
            var obj = this;
            var index=i;
            var uploadbutton = K.uploadbutton({
                button : obj,
                fieldName : 'imgFile',
                url : '/plugins/admineditor/php/upload_json.php',
                afterUpload : function(data) {
                    if (data.error === 0) {
                        var url = K.formatUrl(data.url, 'absolute');
                        K('#img_url_'+index).val(url);
                    } else {
                        alert(data.message);
                    }
                },
                afterError : function(str) {
                    alert('自定义错误信息: ' + str);
                }
            });
            uploadbutton.fileBox.change(function(e) {
                uploadbutton.submit();
            });
        });
    })
</script>

</body>
</html>


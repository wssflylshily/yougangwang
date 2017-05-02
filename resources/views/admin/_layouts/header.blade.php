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
                        {{--<img src="/assets/admin/img/user2-160x160.jpg" class="user-image" alt="User Image">--}}
                        <span class="hidden-xs">{{--Alexander Pierce--}}退出登录</span>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- User image -->
                        <li class="user-header">
                            {{--<img src="/assets/admin/img/user2-160x160.jpg" class="img-circle" alt="User Image">--}}

                            <p>超级管理员</p>
                        </li>
                        <!-- Menu Footer-->
                        @if(Session::get('admin_auth'))
                            <li class="user-footer">
                                {{-- <div class="pull-left">
                                     <a href="#" class="btn btn-default btn-flat">资料</a>
                                 </div>--}}
                                <div class="pull-right">
                                    <a href="{{ route('admin.logout') }}" class="btn btn-default btn-flat">退出</a>
                                </div>
                            </li>
                        {{--@else
                            <li class="user-footer">
                                --}}{{--<div class="pull-left">
                                    <a href="#" class="btn btn-default btn-flat">资料</a>
                                </div>--}}{{--
                                <div class="pull-right">
                                    <a href="admin/login" class="btn btn-default btn-flat">退出</a>
                                </div>
                            </li>--}}
                        @endif
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</header>
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
        {{--  <ul class="sidebar-menu">
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
                      <li><a href="article_list.html"><i class="fa fa-circle-o"></i> 关于我们</a></li>
                      <li><a href="article_list.html"><i class="fa fa-circle-o"></i> 其他文章</a></li>
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
                      <li><a href="bannermanage.html"><i class="fa fa-circle-o"></i> banner管理</a></li>
                      <li><a href="website_city.html"><i class="fa fa-circle-o"></i> 城市管理</a></li>
                      <li><a href="website_steel.html"><i class="fa fa-circle-o"></i> 钢铁信息</a></li>
                      <li><a href="website_footer.html"><i class="fa fa-circle-o"></i> 底部信息</a></li>
                  </ul>
              </li>
          </ul>
      </section>
      <!-- /.sidebar -->
  </aside>--}}
        <ul class="sidebar-menu" id="menus">
            {{--头像那块--}}
           {{-- <li class="header"><!--主导航--></li>--}}
            <li>
                <a href="/admin">
                    <i class="fa fa-dashboard"></i> <span>后台首页</span>
                    <span class="pull-right-container">
            </span>
                </a>
            </li>
            <li class="divider"></li>

            {{--<li class="treeview">
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
                    --}}{{--<li><a href="admin/order"><i class="fa fa-circle-o"></i> 订单列表</a></li>--}}{{--
                    <li><a href="/admin/order"><i class="fa fa-circle-o"></i> 现货订单</a></li>
                    <li><a href="{{URL::route('admin.order.future')}}"><i class="fa fa-circle-o"></i> 期货订单</a></li>
                    --}}{{--<li><a href="order_now.html"><i class="fa fa-circle-o"></i> 现货订单</a></li>
                    <li><a href="order_future.html"><i class="fa fa-circle-o"></i> 期货订单</a></li>
                    <li><a href="order_hotsale.html"><i class="fa fa-circle-o"></i> 特卖订单</a></li>--}}{{--
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
            </li>--}}
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>
<script type="text/javascript" src="/assets/shop/js/jquery-1.8.3.min.js" ></script>
<script type="text/javascript">
    $.ajax({
        type:"GET",
        url:"/admin/common",
        datatype: "json",
        success:function(json){
            var data = JSON.parse(json);

            for(var i=0;i<data.length;i++){
                var str = "";
                /*console.log(data[i].menu);*/
                str += '<li class="treeview">'+
                            '<a href="javascript:;">'+
                                '<i class="fa fa-files-o"></i>'+
                                '<span>'+data[i].title+'</span>'+
                                '<span class="pull-right-container">'+
                                    '<i class="fa fa-angle-left pull-right"></i>'+
                                '</span>'+
                            '</a>'+
                            '<ul class="treeview-menu">';
                for(var j=0;j<data[i].menu.length;j++){
                    str += '<li><a href="/admin/'+ data[i].menu[j].url +'"><i class="fa fa-circle-o"></i>'+ data[i].menu[j].title +'</a></li>';
                }

                str +=  '</ul></li>';
                $('#menus').append(str);
            }
        },
        error: function(){
        }
    });
</script>
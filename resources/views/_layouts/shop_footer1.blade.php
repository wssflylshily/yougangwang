		<!--footer-->
		<div class="footer_bg min_w">
			<div class=" footer_top">
				<div class="mid_div clear">
					<div class="L">
						<h2>现货</h2>
						<ul id="list1">
							{{--<li><a href="/article/detail/1">如何搜索？</a></li>
							<li><a href="#">如何支付？</a></li>
							<li><a href="#">如何确认收货？</a></li>
							<li><a href="#">如何开发票？</a></li>--}}
						</ul>
					</div>
					<div class="L">
						<h2>期货</h2>
						<ul id="list2">
							{{--<li><a href="#">如何发布期货信息？</a></li>
							<li><a href="#">迟迟得不到订单回复怎么办？</a></li>
							<li><a href="#">如何付款？</a></li>
							<li><a href="#">货物查询</a></li>
							<li><a href="#">联系客服</a></li>--}}
						</ul>
					</div>
					<div class="L">
						<h2>聚划算</h2>
						<ul id="list3">
							{{--<li><a href="#">如何发布信息？</a></li>
							<li><a href="#">关于聚划算</a></li>
							<li><a href="#">找不到相应的规格怎么办？</a></li>
							<li><a href="#">公共帐号</a></li>--}}
						</ul>
					</div>
					<div class="L">
						<h2>物流</h2>
						<ul id="list4">
							{{--<li><a href="#">查询物流</a></li>
							<li><a href="#">到货期查询</a></li>
							<li><a href="#">联系电话</a></li>--}}
						</ul>
					</div>
					<div class="L">
						<h2>我们</h2>
						<ul id="list5">
							{{--<li><a href="#">×××APP</a></li>
							<li><a href="#">微信联系我们</a></li>
							<li><a href="#">×××简介</a></li>
							<li><a href="#">我们为您维权</a></li>--}}
						</ul>
					</div>
				</div>
			</div>
			<div class="footer_bottom">
				<div class="mid_div">
					<div id="list6">
						{{--<a href="#" class="a01">法律声明</a>
						<a href="#" class="a01">联系我们</a>
						<a href="#" class="a01">常见问题</a>
						<a href="#" class="a01">真诚招聘</a>--}}
					</div>
				</div>
				<div id="footer_mes">Copyright 2015-2018  ×××科技有限公司.  <a href="#">www.××××××.com</a>  <a href="#">ICP备13029879</a>   ICP认证11568965</div>
			</div>
		</div>

		<script type="text/javascript">
            $.ajax({
                type:"GET",
                url:"{{route('article.footer')}}",
				data: {'type':1},
                datatype: "json",
                success:function(json){
                    var data = JSON.parse(json);
                    var str = "";
                    for(var i=0;i<data.length;i++){
                        str += '<li><a href="/Article/detail/'+data[i].id+'">'+data[i].title+'</a></li>';
                        $('#list1').html("");
                        $('#list1').append(str);
                    }
                },
                error: function(){
                }
            });
            $.ajax({
                type:"GET",
                url:"{{route('article.footer')}}",
                data: {'type':2},
                datatype: "json",
                success:function(json){
                    var data = JSON.parse(json);
                    var str = "";
                    for(var i=0;i<data.length;i++){
                        str += '<li><a href="/Article/detail/'+data[i].id+'">'+data[i].title+'</a></li>';
                        $('#list2').html("");
                        $('#list2').append(str);
                    }
                },
                error: function(){
                }
            });
            $.ajax({
                type:"GET",
                url:"{{route('article.footer')}}",
                data: {'type':3},
                datatype: "json",
                success:function(json){
                    var data = JSON.parse(json);
                    var str = "";
                    for(var i=0;i<data.length;i++){
                        str += '<li><a href="/Article/detail/'+data[i].id+'">'+data[i].title+'</a></li>';
                        $('#list3').html("");
                        $('#list3').append(str);
                    }
                },
                error: function(){
                }
            });
            $.ajax({
                type:"GET",
                url:"{{route('article.footer')}}",
                data: {'type':4},
                datatype: "json",
                success:function(json){
                    var data = JSON.parse(json);
                    var str = "";
                    for(var i=0;i<data.length;i++){
                        str += '<li><a href="/Article/detail/'+data[i].id+'">'+data[i].title+'</a></li>';
                        $('#list4').html("");
                        $('#list4').append(str);
                    }
                },
                error: function(){
                }
            });
            $.ajax({
                type:"GET",
                url:"{{route('article.footer')}}",
                data: {'type':5},
                datatype: "json",
                success:function(json){
                    var data = JSON.parse(json);
                    var str = "";
                    for(var i=0;i<data.length;i++){
                        str += '<li><a href="/Article/detail/'+data[i].id+'">'+data[i].title+'</a></li>';
                        $('#list5').html("");
                        $('#list5').append(str);
                    }
                },
                error: function(){
                }
            });

            $.ajax({
                type:"GET",
                url:"{{route('article.footer')}}",
                data: {'type':7},
                datatype: "json",
                success:function(json){
                    var data = JSON.parse(json);
                    var str = "";
                    for(var i=0;i<data.length;i++){
                        //str += '<li><a href="/Article/detail/'+data[i].id+'">'+data[i].title+'</a></li>';
                        str += '<a href="/Article/detail/'+data[i].id+'" class="a01">'+data[i].title+'</a>';
                        $('#list6').html("");
                        $('#list6').append(str);
                    }
                },
                error: function(){
                }
            });

            $.ajax({
                type:"GET",
                url:"{{route('article.footer_mes')}}",
                data: {},
                datatype: "json",
                success:function(json){
                    var data = JSON.parse(json);
                    console.log(data)
                    $('#footer_mes').html("");
                    $('#footer_mes').append(data);
                },
                error: function(){
                }
            });

		</script>
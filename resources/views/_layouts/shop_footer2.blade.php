    <!-- footer-->
    <link rel="stylesheet" href="/assets/shop/css/person.css"/>
    <div class="min_w person_footer marok">
        <ul class="ul1 clear" id="article">
            {{--<li><a href="#">关于我们</a></li>
            <li><a href="#">联系我们</a></li>
            <li><a href="#">人才招聘</a></li>
            <li><a href="#">商家入驻</a></li>
            <li><a href="#">广告服务</a></li>
            <li><a href="#">手机优钢</a></li>
            <li><a href="#">战略联盟</a></li>
            <li><a href="#">疑难解答</a></li>--}}
        </ul>
        <ul class="ul2 clear">
            <li><a href="#">法律声明</a></li>
            <li class="line">|</li>
            <li><a href="#">联系我们</a></li>
            <li class="line">|</li>
            <li><a href="#">常见问题</a></li>
            <li class="line">|</li>
            <li><a href="#">真诚招聘</a></li>
        </ul>
        <p id="footer_mes"></p>
    </div>
    <script>
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
                    str += '<li><a href="/Article/detail/'+data[i].id+'">'+data[i].title+'</a></li>';
                    $('#article').html("");
                    $('#article').append(str);
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
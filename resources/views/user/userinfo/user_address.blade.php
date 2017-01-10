@extends('_layouts.shop')

@section('main-content')
    <!-- content-->
    <div class="meCenIndex_con mid_div min_w marok">
        <div class="tit">
            <img src="/assets/shop/img/person/mecentertit.jpg"/>
            <p class="line"></p>
        </div>
        <div class="content clear">
          @include('_layouts.user_left')
            <div class="R">
    <meta name="_token" content="{{ csrf_token() }}"/>
            <script type="text/javascript" src="/assets/shop/js/laydate/laydate.js" ></script>
    <script type="text/javascript" src="/assets/shop/js/wirte.js" ></script>
    <!--新添加-->
    <script src="/plugins/jquery-toaster/jquery.toaster.js"></script>

    <!-- pages script -->
    <script src="/assets/base.js"></script>
    <script src="/assets/shop/js/pages/cart.js"></script>
    <!--新添加-->
    <script>
        $(function(){
            $("#save_addr").click(function(){
                var addr_ragion=$("select[name='addr_ragion']").val();
                var addr_city=$("select[name='addr_city']").val();addr_country
                var addr_country=$("select[name='addr_country']").val();
                var addr_xxaddr=$("textarea[name='addr_xxaddr']").val();
                var addr_code=$("input[name='addr_code']").val();
                var addr_name=$("input[name='addr_name']").val();
                var ragion_tel=$("select[name='ragion_tel']").val();
                var addr_tel=$("input[name='addr_tel']").val();
                var ragion_phone=$("select[name='ragion_phone']").val();
                var addr_phone0=$("input[name='addr_phone0']").val();
                var addr_phone1=$("input[name='addr_phone1']").val();
                var addr_phone2=$("input[name='addr_phone2']").val();
                //var remeber_moren=$("input[name='remeber_moren']").val();
                if(addr_ragion=="请选择省份")
                {
                    write_alert("请填写区域");
                    return false;
                }
                if(addr_city=="请选择城市")
                {
                    write_alert("请填写城市");
                    return false;
                }
                if(addr_country=="请选择区县")
                {
                    write_alert("请填写区县");
                    return false;
                }
                if(addr_xxaddr=="")
                {
                    write_alert("请填写详细地址");
                    return false;
                }
                if(addr_name=="")
                {
                    write_alert("请填写收货人姓名");
                    return false;
                }
                if(addr_tel=="")
                {
                    write_alert("请填写联系方式");
                    return false;
                }
                if(!/^(((13[0-9]{1})|(15[0-9]{1})|(18[0-9]{1}))+\d{8})$/.test(addr_tel)){
                    write_alert("请填写正确的手机号");
                    return false;
                }
                $("form[name='addrinfo']").submit();
                /*if(addr_phone=="")
                {
                    write_alert("请填写收货人姓名");
                    return false;
                }*/
                if($(this).attr("addr_id")=="")
                {
                    //新建
                }
                else
                {
                    var add_id=$(this).attr("addr_id");
                    //修改
                }
                /*var item ={
                    addr_ragion:addr_ragion,
                    addr_city:addr_city,
                    addr_xxaddr:addr_xxaddr,
                    addr_code:addr_code,
                    addr_name:addr_name,
                    ragion_tel:ragion_tel
                    ,addr_tel:addr_tel,
                    ragion_phone:ragion_phone,
                    addr_phone0:addr_phone0,
                    addr_phone1:addr_phone1,
                    addr_phone2:addr_phone2
                }
                $.ajax({
                    type:"POST",
                    url:"{{ route('user.address')}}",
                    data:item,
                    datatype: "json",//"xml", "html", "script", "json", "jsonp", "text".
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    },
                    success:function(json){
                        console.log(json);
                    },
                    error: function(){
                    }
                });*/
            });
            /*console.log($("option.province"))*/
            $("#sheng").on('change',function(){

                var provinceId=$("#sheng option:selected").attr("data");
                $.ajax({
                    type:"get",
                    url:"{{ route('user.nextarea')}}",
                    data:{provinceId:provinceId},
                    datatype: "json",//"xml", "html", "script", "json", "jsonp", "text".
                    /*headers: {
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    },*/
                    success:function(data){
                        $("#shi").html('').append('<option>请选择城市</option>');
                        var data1 = JSON.parse(data);
                        /*console.log(data1[0].areaName);*/
                        var str = '';
                        if(data!=""){
                            for(var i=0;i<data1.length;i++){
                                 str += '<option data="'+data1[i].areaId+'">'+data1[i].areaName+'</option>';
                            }
                            $("#shi").append(str);
                        }
                    },
                    error: function(){
                    }
                });
            });

            $("#shi").on('change',function(){
                var provinceId=$("#shi option:selected").attr("data");
                $.ajax({
                    type:"get",
                    url:"{{ route('user.nextarea')}}",
                    data:{provinceId:provinceId},
                    datatype: "json",//"xml", "html", "script", "json", "jsonp", "text".
                    /*headers: {
                     'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                     },*/
                    success:function(data){
                        $("#xian").html('').append('<option>请选择区县</option>');
                        var data1 = JSON.parse(data);
                        /*console.log(data.length)*/
                        var str = '';
                        if(data!=""){
                            for(var i=0;i<data1.length;i++){
                                str += '<option data="'+data1[i].areaId+'">'+data1[i].areaName+'</option>';
                            }
                            $("#xian").append(str);
                        }
                    },
                    error: function(){
                    }
                });
            });
            //取消
            $("#clear_addr").click(function(){
                $("textarea[name='addr_xxaddr']").val("");
                $("input[name='addr_code']").val("");
                $("input[name='addr_name']").val("");               
                $("input[name='addr_tel']").val("");                
                $("input[name='addr_phone0']").val("");
                $("input[name='addr_phone1']").val("");
                $("input[name='addr_phone2']").val("");
                $("#save_addr").attr("addr_id","");
                $("#save_addr").html("确认新增");
            });
            //编辑
            $(".bianji_btn").click(function(){
                $("#save_addr").attr("addr_id",$(this).attr("addr_id"));
                $("#save_addr").html("确认修改");
                var nowId = $(this).attr('addr_id');
                $.ajax({
                    type:"get",
                    url:"{{ route('user.oneaddrinfo')}}",
                    data:{addrid:nowId},
                    datatype: "json",//"xml", "html", "script", "json", "jsonp", "text".
                    /*headers: {
                     'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                     },*/
                    success:function(data){
                        /*console.log(data);*/
                        var data1 = JSON.parse(data);
                        /*console.log(data1);*/
                        /*console.log(data.length)*/
                        $("input[name='addressId']").val(nowId);
                        $("select[name='addr_ragion']").val(data1[0].province);
                        $("option[name='addr_city1']").html(data1[0].city);
                        $("option[name='addr_country1']").html(data1[0].county);
                        $("textarea[name='addr_xxaddr']").val(data1[0].detail_address);
                        $("input[name='addr_code']").val(data1[0].postcode);
                        $("input[name='addr_name']").val(data1[0].receiver);
                        $("select[name='ragion_tel']").val("+86");
                        $("input[name='addr_tel']").val(data1[0].mobile);
                        $("select[name='ragion_phone']").val("+86");
                        $("input[name='addr_phone0']").val(data1[0].tel1);
                        $("input[name='addr_phone1']").val(data1[0].tel2);
                        $("input[name='addr_phone2']").val(data1[0].tel3);
                    },
                    error: function(){
                    }
                });
                /*$("select[name='addr_ragion']").val("地区");
                $("select[name='addr_city']").val("天津");
                $("textarea[name='addr_xxaddr']").val("红旗路赛德广场5号楼1106室");
                $("input[name='addr_code']").val("300000");
                $("input[name='addr_name']").val("林子杰");
                $("select[name='ragion_tel']").val("+86");
                $("input[name='addr_tel']").val("15202265146");
                $("select[name='ragion_phone']").val("+86");
                $("input[name='addr_phone0']").val("");
                $("input[name='addr_phone1']").val("");
                $("input[name='addr_phone2']").val("");*/
            });
            //删除
            $(".shanchu_btn").click(function(){

                $(".delete_content").attr("addr_id",$(this).attr("addr_id"))
                $(".box_shadow").show();
                $(".delete_content").show();

            });
            /*});*/
            //确定删除
            $(".submit_btn").click(function(){
                var addr_id=$(".delete_content").attr("addr_id");
                $(".box_shadow").hide();
                $(".delete_content").hide();

                $.ajax({
                    type:"get",
                    url:"{{ route('user.deloneaddr')}}",
                    data:{addrid:addr_id},
                    datatype: "json",//"xml", "html", "script", "json", "jsonp", "text".
                    /*headers: {
                     'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                     },*/
                    success:function(data){
                        /*console.log(data);*/
                        if(data=="1"){
                            window.location.href=location.href;
                        }else{

                        }

                    },
                    error: function(){
                    }
                });
            });
            //取消
            $(".cancel_btn").click(function(){
                $(".box_shadow").hide();
                $(".delete_content").hide();
            });
            //设置默认
            $(".szmoren").click(function(){
                //$(this).add
                var nowId = $(this).attr('addr_id');
                $.ajax({
                    type:"get",
                    url:"{{ route('user.setdefaultaddr')}}",
                    data:{addrid:nowId},
                    datatype: "json",//"xml", "html", "script", "json", "jsonp", "text".
                    /*headers: {
                     'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                     },*/
                    success:function(data){
                        /*console.log(data);*/
                        if(data=="1"){
                            window.location.href=location.href;
                        }else{

                        }

                    },
                    error: function(){
                    }
                });

            });

            $('#ads_clear').css('display','none');
        });
        
    </script>
               <!-- 个人资料 -->
                <div class="orderQihuo">
                    <ul class="tab clear">
                        <li class="on"><a href="javascript:;">个人资料</a></li>
                    </ul>
                    <!--个人资料-->
                    <div class="tab_select per_infor clear" style="display: block;">
                        <form action="{{route('user.address')}}" method="post" name="addrinfo">
                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                            <input type="hidden" name="addressId" value="">
                            <table class="zl_table">
                                <tr>
                                    <td width="110" align="right" style="font-weight: bold; color: #416ccc;">新增收货地址</td>
                                    <td>电话号码、手机号码选填一项，其余均为必填项</td>
                                </tr>
                                <tr>
                                    <td align="right">所在地区<em>*</em></td>
                                    <td>
                                        <select name="addr_ragion" id="sheng">
                                            <option>请选择省份</option>
                                            @foreach ($province as $province)
                                                <option class="province" data="{{$province->areaId}}">{{$province->areaName}}</option>
                                            @endforeach
                                        </select>
                                        <select name="addr_city" id="shi" value="">
                                            <option name="addr_city1">请选择城市</option>
                                        </select>
                                        <select name="addr_country" id="xian" value="">
                                            <option name="addr_country1">请选择区县</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td align="right">详细地址<em>*</em></td>
                                    <td><textarea name="addr_xxaddr"></textarea></td>
                                </tr>
                                <tr>
                                    <td align="right">邮政编码</td>
                                    <td><input type="text" name="addr_code" value="" style="width: 235px;"></td>
                                </tr>
                                <tr>
                                    <td align="right">收货人姓名<em>*</em></td>
                                    <td><input type="text" name="addr_name" style="width: 345px;"></td>
                                </tr>
                                <tr>
                                    <td align="right">手机号码</td>
                                    <td>
                                        <select name="ragion_tel"><option>中国大陆 +86</option></select>
                                        <input type="text" name="addr_tel" style="width: 235px;">
                                    </td>
                                </tr>
                                <tr>
                                    <td align="right">电话号码</td>
                                    <td>
                                        <select name="ragion_phone"><option>中国大陆 +86</option></select>
                                        <input type="text" name="addr_phone0" style="width: 66px;">
                                        <span>-</span>
                                        <input type="text" name="addr_phone1" style="width: 145px;">
                                        <span>-</span>
                                        <input type="text" name="addr_phone2" style="width: 66px;">
                                    </td>
                                </tr>
                                <tr>
                                    <td>&nbsp;</td>
                                    <td><input name="remeber_moren" type="checkbox" class="check_btn" /> 设置为默认收货地址</td>
                                </tr>
                                <tr>
                                    <td>&nbsp;</td>
                                    <td>
                                        <br><button id="save_addr" addr_id="" type="button" class="tj_btn">确认新增</button>
                                        <button id="clear_addr" addr_id="" type="button" class="tj_btn">取消</button>
                                    </td>
                                </tr>
                            </table>
                        </form>
                    	<div style="margin-top: 50px; margin-bottom: 50px;">
                    		<table class="zl_table addr_table">
                    			<tr class="tr01">
                    				<td>收货人</td>
                    				<td>所在地区</td>
                    				<td>详细地址</td>
                    				<td>邮编</td>
                    				<td>电话/手机</td>
                    				<td>操作</td>
                    				<td>设置</td>
                    			</tr>
                                @foreach ($address as $addr)
                                    <tr >
                                        <td>{{$addr->receiver}}</td>
                                        <td>{{$addr->province}}  {{$addr->city}}  {{$addr->county}}</td>
                                        <td>{{$addr->detail_address}}</td>
                                        <td>{{$addr->postcode}}</td>
                                        <td>{{$addr->yin_mobile}}</td>
                                        <td><a href="javascript:;" class="bianji_btn" addr_id="{{$addr->id}}" ">编辑</a> | <a href="javascript:;" class="shanchu_btn" addr_id="{{$addr->id}}" >删除</a></td>
                                        @if ($addr->is_default===1)
                                            <td><a href="javascript:;" class="moren" addr_id="1" data="{{$addr->id}}">默认地址</a></td>
                                        @else
                                            <td><a href="javascript:;" class="szmoren" addr_id="{{$addr->id}}" ">设为默认</a></td>
                                        @endif
                                        {{--<td><a href="javascript:;" class="moren" addr_id="1">默认地址</a></td>--}}
                                    </tr>
                                @endforeach

                    		</table>
                    	</div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
    <!--box-->
    <div class="com_div">
    	<div class="box_shadow"></div>
    	<div class="mody_content delete_content" addr_id="">
    		<div>
    			<table>
    				<tr>
    					<td colspan="2" align="center" style="font-size: 18px;">确定删除？</td>
    				</tr>
    				<tr>
    					<td align="center">
    						<a href="javascript:;" class="mo_btn cancel_btn gray">取消</a>
    					</td>
    					<td align="center">
    						<a href="javascript:;" class="mo_btn submit_btn">确定</a>
    					</td>
    				</tr>
    			</table>
    		</div>
    	</div>    	
    </div>
@endsection

@section('footer')
    @include('_layouts.shop_footer2')
@endsection
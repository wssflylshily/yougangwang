@extends('_layouts.shop')
@section('main-content')
    <!-- content-->
    <div class="mid_div marok spseeCangku">
    	<div class="tit clear">
    		<p class="L">无缝管仓库</p>
    		<div class="R">
    			<a href="javascript:;" class="add">添加商品</a> 
    			{{--<a href="javascript:;" class="out">导出Excel表格</a> --}}
    		</div>
    	</div>
    	<div class="btns clear">
    		<a href="javascript:;" class="L set">批量设置特卖</a>
    		<a href="javascript:;" class="L cancel">批量取消特卖</a>
            <span style="color: red;margin-left: 5px;" class="L message1">@if($result){{ $result }}@endif</span>
    		<a href="javascript:;" class="R del">批量删除</a>
    		{{--<a href="javascript:;" class="R modify">批量修改</a>--}}
    	</div>
        <div class="content">
        	<div class="table">
        		<ul class="thead">
        			<li class="td1"><input class="check_btn" type="checkbox" name="neirong" value=""></li>
        			<li class="td2">特卖产品</li>
        			<li class="td3">地区</li>
        			<li class="td4">品种</li>
        			<li class="td5">材质</li>
        			<li class="td6">规格</li>
        			<li class="td7">钢厂</li>
        			<li class="td8">吨数</li>
        			<li class="td9">单价</li>
        			<li class="td10">操作</li>
        		</ul>
        		<div class="tbody">
					@foreach($goods as $good)
						<ul class="tr">
							<li class="td1"><input class="check_btn" type="checkbox" name="neirong" value="{{ $good->id }}"></li>
							<li class="td2">@if($good->type == 9)<span class="temai"></span>@endif</li>
							<li class="td3">{{ $good->areaName }}</li>
							<li class="td4">{{ $good->variety }}</li>
							<li class="td5">{{ $good->material }}</li>
							<li class="td6">{{ $good->length }}*{{ $good->thickness }}*{{ $good->outer_diameter }}</li>
							<li class="td7">{{ $good->seller->name or '未知' }}</li>
							<li class="td8">{{ $good->stock }}</li>
							<li class="td9"><b>{{ $good->price }}</b> 元/吨</li>
							<li class="td10">
								<a href="{{ route('seller.stores.editor', ['id' => $good->id]) }}" class="modify">修改</a>
								<a  href="javascript:;" class="delone del" data-id="{{ $good->id }}" >删除</a>
							</li>
						</ul>
					@endforeach


        		</div>
        	</div>
            <!-- 分页-->
			<div class="more_div fenyeArea clear">
				{!! $goods->appends(Request::query())->render() !!}
			</div>
           {{-- <div class="fenyeArea clear">
                <ul class="fenye clear R">
                    <li class="on"><a href="#">1</a></li>
                    <li><a href="#">2</a></li>
                    <li><a href="#">3</a></li>
                    <li><a href="#">8</a></li>
                    <li><a href="#">9</a></li>
                    <li class="last"><a href="#">10</a></li>
                </ul>
            </div>--}}
        </div>
    </div>
   @endsection
 	@section('footer')
 	 @include('_layouts.shop_footer2')
 	
    <!-- 添加商品 -->
    <div class="SPseeCangkuAddPro" style="display: none">
        <h3>添加商品</h3>
        <div class="con">
            <ul class="clear">
                <li>材质
                    <select class="material">
                        @foreach ( config('const.goods_material') as $material)
                            <option value="{{ $material }}" @if (Request::input('material') == $material) selected @endif > {{ $material }}</option>
                        @endforeach
                    </select>
                </li>
                <li>地区
                    <select name="province">
                        <option value="">选择地区</option>
                        @foreach($provinces as $province)
                            <option value="{{ $province->areaId }}">{{ $province->areaName }}</option>
                        @endforeach
                    </select>
                </li>
                <li>城市
                    <select name="city">
                        <option value="">选择城市</option>
                    </select>
                </li>

            </ul>
            <ul class="clear">
                <li>品种
                    <select class="variety" >
                        @foreach ( config('const.goods_variety') as $variety)
                            <option value="{{ $variety }}" @if (Request::input('variety') == $variety) selected @endif > {{ $variety }}</option>
                        @endforeach
                    </select>
                </li>
                <li>标准
                    <select class="standard">
                        @foreach ( config('const.goods_standard') as $standard)
                            <option value="{{ $standard }}" @if (Request::input('standard') == $standard) selected @endif > {{ $standard }}</option>
                        @endforeach
                    </select>
                </li>
                <li>钢厂
                    <select class="steelmill">
                        @foreach ( config('const.goods_steelmill') as $steelmill)
                            <option value="{{ $steelmill }}" @if (Request::input('steelmill') == $steelmill) selected @endif > {{ $steelmill }}</option>
                        @endforeach
                    </select>
                </li>
            </ul>
            <!-- 规格数量-->
            <div class="clear guigeNum">
                <div class="left">
                    <div class="td1">规格</div>
                    <ul class="td2">
                        <li>外径 <input type="text" class="outer_diameter"/> mm</li>
                        <li>厚度 <input type="text" class="houdu"/> mm</li>
                        <li class="last">长度 <input type="text" class="length"/> m</li>
                    </ul>
                </div>
                <div class="right clear">
                    <div class="td1">数量</div>
                    <ul class="td2">
                        <li>
                            <p><input class="radio" type="radio" name="unit" checked value="1"/>吨数</p>
                            <p class="last"><input class="radio" type="radio" name="unit" value="2"/>支数</p>
                        </li>
                        <li><input type="text" name="stock" class="text stock"/></li>
                    </ul>
                </div>
            </div>
            <!-- 价格-->
            <ul class="clear">
                <li>价格
                    <select class="goods_price">
                        @foreach ( config('const.goods_price') as $price)
                            <option value="{{ $price }}" @if (Request::input('goods_price') == $price) selected @endif > {{ $price }}</option>
                        @endforeach
                    </select>元/吨
                </li>
            </ul>
        </div>
        <div class="bot">
            <a href="javascript:;" class="back">返回</a>
            {{--<a href="javascript:;" class="daoru">导入Excel表格</a>--}}
            <a href="javascript:;" class="add">添加商品</a>
            <span style="color: red;margin-left: 5px;" class="message2"></span>
        </div>
    </div>
    <!-- 遮罩层-->
    <div id="zhezhao" style="display: none"></div>

    <script>
        //点击批量设置特卖
        $('.spseeCangku .btns .set').on('click',function(){
            console.log('点击批量设置特卖');
            var chk_value = [];
            $('input[name="neirong"]:checked').each(function(){
                chk_value.push($(this).val());
            });
            //alert(chk_value.length==0 ?'你还没有选择任何内容！':chk_value);
            $.ajax({
                type:"GET",
                url:"{{ route('seller.stores.tm') }}",
                data:{id:chk_value,type:9},
                datatype: "json",
                success:function(e){
                    console.log(e);
                    location.reload();
                    $('.message1').html(e);
                },
                error: function(){
                }
            });
        });
        //点击 批量取消特卖
        $('.spseeCangku .btns .cancel').on('click',function(){
            console.log('批量取消特卖');
            var chk_value = [];
            $('input[name="neirong"]:checked').each(function(){
                chk_value.push($(this).val());
            });
            //alert(chk_value.length==0 ?'你还没有选择任何内容！':chk_value);
            $.ajax({
                type:"GET",
                url:"{{ route('seller.stores.tm') }}",
                data:{id:chk_value,type:'0'},
                datatype: "json",
                success:function(e){
                    console.log(e);
                    location.reload();
                    $('.message1').html(e);
                },
                error: function(){
                }
            });
        });
        //点击 批量修改
        $('.spseeCangku .btns .modify').on('click',function(){
            console.log('批量修改');
        });
        //点击 批量删除
        $('.spseeCangku .btns .del').on('click',function(){
            console.log('批量删除');
            var chk_value = [];
            $('input[name="neirong"]:checked').each(function(){
                chk_value.push($(this).val());
            });
            //alert(chk_value.length==0 ?'你还没有选择任何内容！':chk_value);
            $.ajax({
                type:"GET",
                url:"{{ route('seller.stores.delete') }}",
                data:{id:chk_value,type:9},
                datatype: "json",
                success:function(e){
                    console.log(e);
                    location.reload();
                    $('.message1').html(e);
                },
                error: function(){
                }
            });
        });
        //点击 删除
        $('.delone').on('click',function(){
            console.log('删除');
            var id = $(this).attr('data-id');
            $.ajax({
                type:"GET",
                url:"{{ route('seller.stores.deleteOne') }}",
                data:{id:id},
                datatype: "json",
                success:function(e){
                    console.log(e);
                    $('.message1').html(e);
                    location.reload();
                },
                error: function(){
                }
            });
        });
        //点击 导出表格
        $('.spseeCangku .tit .R .out').on('click',function(){
            console.log('导出表格');
        });

        //点击 添加商品
        $('.spseeCangku .tit .R .add').on('click',function(){
            //清空操作
            $('.SPseeCangkuAddPro input[type=text]').val('');
            $('.SPseeCangkuAddPro input[type=radio]').attr('checked',false);
            $('.SPseeCangkuAddPro input[type=radio]').eq(0).attr('checked',true);
            $('.SPseeCangkuAddPro select').val($(this).find('option').eq(0).val());
            //显示
            $('.SPseeCangkuAddPro').show();
            $('#zhezhao').show();
        });
        //点击 弹框 返回
        $('.SPseeCangkuAddPro .bot .back').on('click',function(){
            $('.SPseeCangkuAddPro').hide();
            $('#zhezhao').hide();
        });
        //点击 弹框 导入
        $('.SPseeCangkuAddPro .bot .daoru').on('click',function(){
            $('.SPseeCangkuAddPro').hide();
            $('#zhezhao').hide();
        });
        //点击 弹框 添加商品
        $('.SPseeCangkuAddPro .bot .add').on('click',function(){
//            name location type standard changzi
//            waijing houdu length radio dun
            var material=$('.SPseeCangkuAddPro .material').val();
            var province=$('.SPseeCangkuAddPro .province').val();
            var city=$('.SPseeCangkuAddPro .city').val();
            var variety=$('.SPseeCangkuAddPro .variety').val();
            var standard=$('.SPseeCangkuAddPro .standard').val();
            var steelmill=$('.SPseeCangkuAddPro .steelmill').val();
            var goods_price=$('.SPseeCangkuAddPro .goods_price').val();

            var outer_diameter=$('.SPseeCangkuAddPro .outer_diameter').val();
            var thickness=$('.SPseeCangkuAddPro .houdu').val();
            var length=$('.SPseeCangkuAddPro .length').val();
            var unit=$('.SPseeCangkuAddPro .radio:checked').val();
            var stock=$('.SPseeCangkuAddPro .stock').val();

            var data = {
                province:province,
                city:city,
                variety:variety,
                standard:standard,
                material:material,
                steelmill:steelmill,
                goods_price:goods_price,
                outer_diameter:outer_diameter,
                thickness:thickness,
                length:length,
                unit:unit,
                stock:stock,
                _token:"{{ csrf_token() }}"
            };
            $.ajax({
                type:"POST",
                url:"{{ route('seller.stores.publish') }}",
                data:data,
                datatype: "json",
                success:function(e){
                    console.log(e);
                    if (e == 1){
                        $('.SPseeCangkuAddPro').hide();
                        $('#zhezhao').hide();
                        $('.message1').html("添加成功！");
                    }else {
                        $('.message2').html(e);
                    }

                },
                error: function(){
                }
            });

            /*console.log(name,location,type,standard,changzi);
            console.log(waijing,houdu,length,radio,dun);
            $('.SPseeCangkuAddPro').hide();
            $('#zhezhao').hide();*/
        });

        //点击列表的修改
        $('.spseeCangku .content .table').on('click','.td10 .modify',function(){
            console.log('修改');
        });
        //点击列表的删除
        $('.spseeCangku .content .table').on('click','.td10 .del',function(){
            console.log('删除');
        });

        //点击 头部的 复选框
        $('.spseeCangku .content .table .thead li.td1 .check_btn').on('click',function(){
            var alllistinput=$('.spseeCangku .content .table .tbody li.td1 .check_btn');
            for(var i=0;i<alllistinput.length;i++){
                alllistinput[i].checked=$(this).attr('checked');
            }
        });

        //点击 列表中的复选框
        $('.spseeCangku .content .table .tbody').on('click','.tr li.td1 .check_btn',function(){
            var alllistinput=$('.spseeCangku .content .table .tbody li.td1 .check_btn');
            var sum=alllistinput.length;
            var selectedNum=0;
            for(var i=0;i<sum;i++){
                if(alllistinput[i].checked){
                    selectedNum++;
                }
            }
            if(selectedNum==sum){
                //全选了
                $('.spseeCangku .content .table .thead li.td1 .check_btn')[0].checked=true;
            }else{
                //取消全选
                $('.spseeCangku .content .table .thead li.td1 .check_btn')[0].checked=false;
            }
        });

        $('select[name="province"]').on('change',function(){
            var areaid = $(this).val();
            $.ajax({
                type:"GET",
                url:"{{route('shop.area.city')}}",
                data:{areaId:areaid},
                datatype: "json",
                success:function(json){
                    var data = JSON.parse(json);
                    if(data != null){
                        var str = "";
                        for(var i=0;i<data.length;i++){
                            str += '<option value="'+data[i].areaId+'">'+data[i].areaName+'</option>';
                        }
                        $('select[name="city"]').html("");
                        $('select[name="city"]').append(str);
                    }else{
                        var str = '<option value="">选择城市</option>';
                        $('select[name="city"]').html("");
                        $('select[name="city"]').append(str);
                    }
                }
            });
        });
    </script>
</body>
</html>
@endsection
<ul class="ads clear" id="ads">

</ul>
<script type="text/javascript">
    $.ajax({
        type:"GET",
        url:"{{route('ads.index')}}",
        datatype: "json",
        success:function(json){
            var data = JSON.parse(json);
            //console.log(data);
            var str = "";
            for(var i=0;i<data.length;i++){
                str += '<a href="';
				if(data[i].url!=""&&data[i].url!=null){
					str+=data[i].url;
				}else{
					str+='javascript:;';
				}
                str+='"><li><img src="'+ data[i].pic_url +'" ></li>';
                $('#ads').html("");
                $('#ads').append(str);
            }
        },
        error: function(){
        }
    });
</script>
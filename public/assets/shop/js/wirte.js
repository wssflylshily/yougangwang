function cancel_operation(){
	$("#write_box").remove();
	$("#write_content").remove();
}
function write_alert(str){
	var stra="<div id='write_box'></div><div id='write_content'><p>"+ str+"</p><div><button id='write_cancel' onclick='javascript:cancel_operation();'>确定</button></div></div>";
	$("body").append(stra);
	var ww=$("#write_content").outerWidth();
	var hh=$("#write_content").outerHeight();
	$("#write_content").css({"margin-left":-ww/2+"px","margin-top":-hh/2+"px"});
}
function notice_alert(pos,str){
	var stra="<div id='write_notice'>"+str+"</div>";
	pos.append(stra);
	setTimeout(function(){
		$("#write_notice").remove();
	},2000);
}

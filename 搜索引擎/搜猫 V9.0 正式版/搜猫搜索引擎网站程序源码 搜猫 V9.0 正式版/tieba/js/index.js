function clueOn(a){
	if(a == 1){
		$("#clueon").html("输入贴吧名称直接回车即可进入该吧，如果吧不存在即可创建。");
	}
	if(a == 2){
		$("#clueon").html("输入关键词直接回车即可搜索");
	}
	if(a == 3){
		$("#clueon").html("输入作者名称直接回车即可搜索");
	}
}

$(document).ready(function(){
	$("#wd").focus();
	$.ajax({type:"POST",url:"./index.php?do=load",data:"rdm="+Math.random(),success:function(data){$("#header_links").html(data);tb_init('a.thickbox');}});
});
var owner="888888";
var sf_mess_cfg={
	theme:"luxury",color:"black",title:"在线向搜猫客服咨询！",send:"提交",copyright:"搜猫客服QQ 22568190",mbpos:"RD"
};
var sf_mess_msg={
	emailErr:'请填写正确的Email',messErr:'您的留言字数已超过限制，请保留在1000个字以内。',prefix:'请填写',success:'我们已经收到您的留言,稍候会与您联系.谢谢!',fail:'您的留言发送失败，请重试。'
};
var sf_mess_cols=[{
	type:"textarea",mbtype:"message",tip:"问题内容",innertip:"您给我们留言，我们及时给您回复！",idname:"content"
},{
	type:"text",mbtype:"must",tip:"联系人",innertip:"请输入姓名",idname:"contact"
},{
	type:"text",mbtype:"tel",tip:"联系电话",innertip:"请输入您的联系电话",idname:"phone"
},{
	type:"text",mbtype:"address",tip:"联系QQ",innertip:"请输入您经常使用的QQ号码",idname:"province"
}];
document.write('<script src="float/entry.js" type="text/javascript"></script>');
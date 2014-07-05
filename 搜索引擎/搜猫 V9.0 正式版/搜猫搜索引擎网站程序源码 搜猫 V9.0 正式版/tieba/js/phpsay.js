function postCheck(){
	var b = 0;
	var c = $.trim($('input[name=title]').val());
	var d = c.length;
	if(c == "至少3个字符，不超过32个字符"){
		b = 1;
		alert("请输入帖子标题")
	} else if(0 == d){
		b = 1;
		alert("帖子标题为空")
	} else if(d <= 3){
		b = 1;
		alert("帖子标题太短")
	}
	if(b){
		$('input[name=title]').focus();
		return false
	}
	var d = $.trim($("#ed_text_area").val()).length;
	if(d == 0){
		b = 1;
		alert("帖子内容为空")
	} else if(d > 10000){
		b = 1;
		alert("帖子内容超过1万汉字，请缩减后重新发帖")
	}
	if(b){
		$("#ed_text_area").focus();
		return false
	}
	if($("#imgverify").length)
	{
		d = $.trim($('input[name=verifyNum]').val()).length;
		if(d != 4){
			alert("请输入正确的验证码");
			$('input[name=verifyNum]').focus();
			return false
		}
	}
	$("#btn").val("正在提交");
	$("#btn").attr('disabled', true);
	return true;
}
function postBack(m){
	var b = parseInt(m);
	var g = m.substr(m.indexOf(' ')+1);
	if(b==0){
		$("#btn").val("重新提交");
		if(g=="topic" || g=="reply"){
			alert('验证码不正确');
			$("input[name=verifyNum]").focus();
			$('#imgverify').attr('src','./getimage.php?do='+g+'&rdm='+Math.random());
		}
		else
			alert(g);
		$("#btn").attr('disabled', false);
	}
	else if(b==1)
		location.href=g;
}
function postBind(){
	$(".disableAutoComplete").attr("autocomplete","off");
	$('#ed_more_rows').click(function(){var o=$('#ed_text_area')[0];if(o.rows<60)o.rows=o.rows+3;});
	$('#ed_less_rows').click(function(){var o=$('#ed_text_area')[0];if(o.rows>11)o.rows=o.rows-3;});
	$('#ed_ins_face').click(function(){toggle_mask(true);$('#insert_face').css({'display':'block',"top":getScrollTop()+125+'px'});});
	$('#ed_ins_pic').click(function(){toggle_mask(true);$('#insert_pic').css({'display':'block',"top":getScrollTop()+125+'px'});});
	$('#ed_ins_vid').click(function(){toggle_mask(true);$('#insert_video').css({'display':'block',"top":getScrollTop()+125+'px'});});
    $('#insert_face img').click(function(){var obj = $('#ed_text_area')[0];var str = '[/A' + this.src.match(/\d+/g)[0] + ']';insertatcursor(obj, str);$("#insert_face").hide();toggle_mask(false);});
    $('#insert_face img').mouseover(function(){this.style.border='solid #06c 1px';this.style.cursor='pointer';}).mouseout(function(){this.style.border='solid #fff 1px';});
	var options = {beforeSubmit:postCheck,success:postBack,url:'./post.php',type:'post'};
	$('#submit_form').ajaxForm(options);
}
function getScrollTop(){
	var agt = navigator.userAgent.toLowerCase();
	var ie = ((agt.indexOf("msie") != -1) && (agt.indexOf("opera") == -1) && (agt.indexOf("omniweb") == -1));
	var IeTrueBody = (document.compatMode && document.compatMode!="BackCompat")? document.documentElement : document.body;
	return ie ? IeTrueBody.scrollTop : window.pageYOffset;
}
function quick_send(e){
	var a;
	var b;
	var c;
	if(!e.ctrlKey){
		return false
	}
	if(window.event){
		a = e.keyCode
	} else if(e.which){
		a = e.which
	}
	if(a == 13){
		if($("#btn").attr("disabled") == false){
			$("#btn").attr('disabled', true);
			return $("#submit_form").submit()
		}
	}
	return false
}
function show_verify_image(t){
	if($("#imgverify").length) return;
	$("#verify_cell").prepend('<img id="imgverify" alt="验证码"/>');
	$('<a id="retry_link" href="#" tabindex="999">看不清，换一张</a>').prependTo($("#retry_cell")).click(function(){
		$("#imgverify").attr('src', "./getimage.php?do="+t+"&rdm="+Math.random());
		return false
	});
	$("#imgverify").load(function(){
		$("#verify_div").show();
		window.scrollTo(0, 99999)
	}).attr('src', "./getimage.php?do=" + t + "&rdm=" + Math.random())
}
function setReplyTitle(a){
	var b = $("#title");
	b.val(b.val().replace(/回复\s*\d*[:：](.*)/, '回复' + a + '：' + "$1"))
}
function opinion(p, h, i){
	var j = $("span", i).eq(0);
	var l = {
		op: 'standpoint',
		pid: p,
		opinion: h,
		rdm: Math.random()
	};
	$.post('./post.php', l, 
	function(a){
		var b = parseInt(a);
		if(b == 0){
			var c = j.html();
			var d = c.search(/\d+/);
			if(d < 0){
				c = c + ' 1'
			} else {
				var e = c.substring(0, d);
				var f = parseInt(c.substr(d)) + 1;
				c = e + f
			}
			j.html(c)
		} else {
			alert(a.substr(a.indexOf(' ') + 1))
		}
	})
}
function topicstat(tid){
	$.ajax({
		type: "POST",
		url: "./post.php",
		data: "tid=" + tid + "&op=topicStat"
	});
}
function anonymity_update(){
	var n = $.trim($('#nickname').val());
	var l = n.length;
	if(l < "2" || l > "15"){
		alert('昵称长度不合法。');
		$('#nickname').focus();
		return false;
	}
	$.ajax({
		type: "POST",
		url: "./anonymity.php",
		data: $('#anonymity-form').serialize(true),
		success: function(m){
			var b = parseInt(m);
			if(b == 0){
				$("#loginStateInfo").html(n + "，您未登录。");
				tb_remove();
			} else {
				alert(m.substr(m.indexOf(' ') + 1))
			}
		}
	});
}
function anonymity_delete(){
	$.post("./anonymity.php",{nickname:""},function(m){$("#loginStateInfo").html("您尚未登录。");tb_remove();});	
}
function admin(){
	if($.trim($('#login-pwd').val()) == ""){
		alert('请输入密码');
		$('#login-pwd').focus();
		return false;
	}
	$.ajax({
		type: "POST",
		url: "./admin.php?do=login",
		data: $('#login-form').serialize(true),
		success: function(m){
			var b = parseInt(m);
			if(b == "1"){
				top.location.reload();
			} else {
				alert(m.substr(m.indexOf(' ') + 1))
			}
		}
	});
}
function login(){
	if($.trim($('#login-user').val()) == ""){
		alert('请输入通行证账号');
		$('#login-user').focus();
		return false;
	}
	if($.trim($('#login-pwd').val()) == ""){
		alert('请输入通行证密码');
		$('#login-pwd').focus();
		return false;
	}
	$.ajax({
		type: "POST",
		url: "./login.php?do=login",
		data: $('#login-form').serialize(true),
		success: function(m){
			var b = parseInt(m);
			if(b == "1"){
				top.location.reload();
			} else {
				alert(m.substr(m.indexOf(' ') + 1))
			}
		}
	});
}
function register(){
	if($.trim($('#username').val()) == ""){
		alert('请输入昵称');
		$('#username').focus();
		return false;
	}
	if($.trim($('#userpwd').val()) == ""){
		alert('请输入密码');
		$('#userpwd').focus();
		return false;
	}
	if($.trim($('#userpwd').val()).length < "6"){
		alert('密码至少六位');
		$('#userpwd').focus();
		return false;
	}
	if($.trim($('#userpwd').val()) != $.trim($('#repwd').val())){
		alert('两次输入的密码不一致');
		$('#repwd').focus();
		return false;
	}
	if($.trim($('#useremail').val()) == ""){
		alert('请输入电子邮箱');
		$('#useremail').focus();
		return false;
	}
	$.ajax({
		type: "POST",
		url: "./register.php?do=reg",
		data: $('#reg-form').serialize(true),
		success: function(m){
			var b = parseInt(m);
			if(b == 0){
				alert(m.substr(m.indexOf(' ') + 1));
				top.location.reload();
			} else {
				alert(m.substr(m.indexOf(' ') + 1))
			}
		}
	});
}
function recoverpass(){
	if($.trim($('#username').val()) == ""){
		alert('请输入用户昵称');
		$('#username').focus();
		return false;
	}
	if($.trim($('#useremail').val()) == ""){
		alert('请输入电子邮箱');
		$('#useremail').focus();
		return false;
	}
	$("#recover_submit").hide();
	$("#recover_result").show();
	$.ajax({
		type: "POST",
		url: "./recoverpass.php?do=send",
		data: $('#recover-form').serialize(true),
		success: function(m){
			var b = parseInt(m);
			if(b == 0){
				$('#backuid')[0].value = m.substr(m.indexOf(' ') + 1);
				$("#recover_step1").hide();
				$("#recover_step2").show();
			} else {
				$("#recover_result").hide();
				$("#recover_submit").show();
				alert(m.substr(m.indexOf(' ') + 1));
			}
		}
	});
}
function resetpass(){
	if($.trim($('#safetycode').val()).length < "8"){
		alert('请输入正确识别码');
		$('#safetycode').focus();
		return false;
	}
	if($.trim($('#newpwd').val()) == ""){
		alert('请输入新密码');
		$('#newpwd').focus();
		return false;
	}
	if($.trim($('#newpwd').val()).length < "6"){
		alert('密码长度至少六位');
		$('#newpwd').focus();
		return false;
	}
	if($.trim($('#repwd').val()) != $.trim($('#newpwd').val())){
		alert('两次输入的新密码不一致');
		$('#repwd').focus();
		return false;
	}
	$.ajax({
		type: "POST",
		url: "./recoverpass.php?do=reset",
		data: $('#resetpwd-form').serialize(true),
		success: function(m){
			var b = parseInt(m);
			if(b == 0){
				alert(m.substr(m.indexOf(' ') + 1));
				top.location.reload();
			} else if(b == 2){
				alert(m.substr(m.indexOf(' ') + 1));
				tb_remove();
			} else {
				alert(m.substr(m.indexOf(' ') + 1))
			}
		}
	});
}
function profile(){
	if($.trim($('#oldpasswd').val()).length < "6"){
		alert('请输入正确的当前密码');
		$('#oldpasswd').focus();
		return false;
	}
	if($.trim($('#useremail').val()).length < "6"){
		alert('请输入正确的电子邮箱地址');
		$('#useremail').focus();
		return false;
	}
	$.ajax({
		type: "POST",
		url: "./profile.php?do=modify",
		data: $('#profile-form').serialize(true),
		success: function(m){
			var b = parseInt(m);
			if(b == 0){
				alert(m.substr(m.indexOf(' ') + 1));
			} else {
				alert(m.substr(m.indexOf(' ') + 1))
			}
		}
	});
}
function apply(){
	var t = $.trim($('#applytype').val());
	var c = $.trim($('#applyreason').val()).length;
	if(c < "10" || c > "90"){
		if(t == "1"){
			alert('申请理由应控制在10到90个字之间');
		} else {
			alert('辞职理由应控制在10到90个字之间');
		}
		$('#applyreason').focus();
		return false;
	}
	$.ajax({
		type: "POST",
		url: "./apply.php?do=apply",
		data: $('#apply-form').serialize(true),
		success: function(m){
			if(m.length < "25"){
				var b = parseInt(m);
				if(b == 0){
					alert(m.substr(m.indexOf(' ') + 1));
					if(t == "1"){
						tb_remove();
					}
				} else {
					alert(m.substr(m.indexOf(' ') + 1))
				}
			} else {
				alert('状态异常，请刷新页面。')
			}
		}
	});
}
function report(){
	var c = $.trim($('#reportcontent').val()).length;
	if(c < "3" || c > "80"){
		alert('举报原由应控制在3到80个字之间');
		$('#reportcontent').focus();
		return false;
	}
	$.ajax({
		type: "POST",
		url: "./report.php?do=report",
		data: $('#report-form').serialize(true),
		success: function(m){
			var b = parseInt(m);
			if(b == 0){
				alert(m.substr(m.indexOf(' ') + 1));
				tb_remove();
			} else {
				alert(m.substr(m.indexOf(' ') + 1))
			}
		}
	});
}
function create(){
	var b = $.trim($('#bar').val()).length;
	if(b < 1 || b > 15){
		alert('吧名称长度不合法');
		$('#bar').focus();
		return false;
	}
	var i = $.trim($('#intro').val()).length;
	if(i < 10 || i > 90){
		alert('吧简介必须介于10到90字之间');
		$('#intro').focus();
		return false;
	}
	$.ajax({
		type: "POST",
		url: "./create.php?do=create",
		data: $('#newForm').serialize(true),
		success: function(m){
			var b = parseInt(m);
			var g = m.substr(m.indexOf(' ') + 1);
			if(b == "2"){
				alert(g);
				top.location.href = './';
			} else if(b == "1"){
				top.location.href = g;
			} else {
				alert(g);
			}
		}
	});
}
function barRss(id){
	window.open('./rss.php?fid=' + id);
}
function topicManage(f, i, s, t){
	var truthBeTold = window.confirm("确定要继续此项操作？");
	if(truthBeTold){
		var l = {
			fid: f,
			id: i,
			ac: s,
			op: t,
			rdm: Math.random()
		};
		$.post('./manage.php', l, 
		function(a){
			var p = a.substr(a.indexOf(' ') + 1);
			var b = parseInt(a);
			if(b == 0){
				if(p == "OK"){
					top.location.reload();
				} else {
					top.location.href = p;
				}
			} else {
				alert(p);
			}
		})
	} else {
		return false;
	}
}
function setBlack(f, i, u){
	var truthBeTold = window.confirm("确定要封？");
	if(truthBeTold){
		var l = {
			fid: f,
			uid: i,
			str: u,
			op: 'blockade',
			rdm: Math.random()
		};
		$.post('./manage.php', l, 
		function(a){
			alert(a);
		})
	} else {
		return false;
	}
}
function toggleSelect(){
	$(".operchk").each(function(i){
		if(this.disabled) return;
		if(this.checked){
			this.checked = ""
		} else {
			this.checked = "checked"
		}
	})
}
function selectAll(){
	$(".operchk").each(function(i){
		if(this.disabled) return;
		this.checked = "checked"
	})
}
function delSelItems(fid, tid){
	var e = $(".operchk").filter(function(){
		return ! this.disabled && this.checked
	}).map(function(){
		return this.value
	}).get().join(',');
	if(e.length == 0){
		alert('请选择要删除的回帖');
	} else {
		var truthBeTold = window.confirm("确定要删除这些帖子吗？");
		if(truthBeTold){
			var l = {
				fid: fid,
				tid: tid,
				pid: e,
				op: 'batchDelete',
				rdm: Math.random()
			};
			$.post('./manage.php', l, 
			function(a){
				var p = a.substr(a.indexOf(' ') + 1);
				var b = parseInt(a);
				if(b == 0){
					if(p == "OK"){
						top.location.reload();
					} else {
						top.location.href = p;
					}
				} else {
					alert(p);
				}
			})
		}
	}
}
function AddFavorite(){
	if(window.sidebar && "object" == typeof(window.sidebar) && "function" == typeof(window.sidebar.addPanel)){
		window.sidebar.addPanel(document.title, document.location.href, '');
	} else if(document.all && "object" == typeof(window.external)){
		window.external.addFavorite(document.location.href, document.title);
	} else {
		alert('本功能仅支持 IE 和 FireFox 浏览器！');
	}
}
function caclWord(){
	var v = $.trim($('#applyreason').val()).length;
	$("#wcount").html(v);
}
function SearchSubmit(a){
	var w = $.trim(a.wd.value);
	if(w == ""){
		alert('请输入关键词');
		a.wd.value = '';
		a.wd.focus();
		return false;
	}
	if(a.tb[0].checked == false && a.tb[1].checked == false && a.tb[2].checked == false){
		return false;
	}
}
function toggle_mask(flag){
	if(flag){
		var _docwidth = $(document).width();
		var _docheight = $(document).height();
		if(document.all){
			_docwidth = '100%';
		}
		$("#mask").css({
			"position": "absolute",
			"top": 0,
			"left": 0,
			"width": _docwidth,
			"height": _docheight
		}).show();
	} else {
		$('#mask').hide();
	}
}
function closeInsert(id){
	$('#urlcheck_status_1').html('');
	$('#upload_status').html('');
	$('#video_status').html('');
	$("#" + id).hide();
	toggle_mask(false);
}
function insertImage(){
	var url = $.trim($("#outer_imgurl").val());
	var pattern = /http:\/\//i;
	if(! (url.length > 7 && pattern.test(url))){
		$('#upload_status').html('请输入有效的图片地址！<br />').attr('class', 'upload_error');
		$('#urlcheck_status_1').html('请输入有效的图片地址！<br />').attr('class', 'upload_error');
		$('#urlcheck_status_2').html('请输入有效的图片地址！<br />').attr('class', 'upload_error');
		$("#outer_imgurl").val('');
		return false;
	}
	if($("#ed_text_area").html() != ""){
		$("#ed_text_area").append("\r");
	}
	$("#ed_text_area").append("[img]"+url+"[/img]");
	$("#outer_imgurl").val('');
	closeInsert('insert_pic');
}
function insertVideo(){
	var url = $.trim($("#vid_url").val());
	var pattern = /http:\/\/(www.tudou.com|player.youku.com|player.56.com|player.ku6.com|v.blog.sohu.com|you.video.sina.com.cn|img.openv.tv|client.joy.cn|www.letv.com|www.youtube.com|6.cn)\//i;
	if(! (url.length > 20 && pattern.test(url))){
		var msg = '请输入有效的视频链接！<br />';
		if(!url.length) msg = '请输入您需要插入的视频链接！<br />';
		$('#video_status').html(msg).attr('class', 'upload_error');
		return false;
	}
	if($("#ed_text_area").html() != ""){
		$("#ed_text_area").append("\r");
	}
	$("#ed_text_area").append("[video]"+url+"[/video]");
	$("#vid_url").val('');
	closeInsert('insert_video');
}
function uploadCallback(){
	var io = document.getElementById('imgUploadIframe');
	try {
		var json = (io.contentWindow) ? io.contentWindow.document.body.innerHTML: null;
		if(!json) json = (io.contentDocument) ? io.contentDocument.body.innerHTML: null;
		if(!json) json = (io.document.compatMode && io.document.compatMode != "BackCompat") ? io.document.documentElement.innerHTML: null;
	} catch(e){
		return false;
	}
	if(json) eval("var data = " + json);
	if(typeof(data.error) != 'undefined'){
		if(data.error != ''){
			$('#upload_status').html(data.error + '<br />').attr('class', 'upload_error');
		} else {
			$("#outer_imgurl").val(data.msg);
			$("#upload_status").html("图片上传成功！<br />").attr('class', 'upload_loadding');
		}
	}
	$(".confirmbtn").attr('disabled', false);
}
function uploadImage(){
	var filename = $.trim($("#fileToUpload").val());
	if(!filename){
		return false;
	}
	var a = filename.split(".");
	if(a.length <= 1){
		$('#upload_status').html('请输入正确的文件名<br />').attr('class', 'upload_error');
		return false;
	}
	var postfix = (a[a.length - 1]).toLowerCase();
	var valid = {
		'jpg': 1,
		'jpeg': 1,
		'gif': 1,
		'png': 1
	};
	if(!valid[postfix]){
		$('#upload_status').html('抱歉，目前仅支持格式为jpg、jpeg、gif、png的图片<br />').attr('class', 'upload_error');
		return false;
	}
	$(".confirmbtn").attr('disabled', true);
	$("#upload_status").html("图片上传中...<br />").attr('class', 'upload_loadding');
	try {
		if($("#imgUploadIframe").length == 0){
			$("#imgUploadForm").before('<iframe name="imgUploadIframe" id="imgUploadIframe" src="" style="display:absolute; top:-1000px; left:-1000px;display:none;"></iframe>').attr('target', 'imgUploadIframe').submit();
			if(window.attachEvent){
				document.getElementById("imgUploadIframe").attachEvent('onload', uploadCallback);
			} else {
				document.getElementById("imgUploadIframe").addEventListener('load', uploadCallback, false);
			}
		}
		$("#imgUploadForm").submit();
	} catch(e){
		$(".confirmbtn").attr('disabled', false);
	}
}
function insertatcursor(myField, myValue) {
    if (document.all) {
        if (myField.createTextRange && myField.selection) {
			var objTxtRange = myField.selection;
			objTxtRange.collapse(false);
            objTxtRange.text = (objTxtRange.text.charAt(objTxtRange.text.length - 1) == ' ') ? myValue + ' ' : myValue;
			objTxtRange.select();
			myField.selection = document.selection.createRange().duplicate();
        }
        else {
            myField.value += myValue;
			var myFieldRange = myField.createTextRange();
			myFieldRange.collapse(false);
			myFieldRange.select();
        }
    }
    else if (myField.selectionStart ||myField.selectionStart == '0') {
        var startPos = myField.selectionStart;
        var endPos = myField.selectionEnd;
        myField.value = myField.value.substring(0, startPos)+ myValue+ myField.value.substring(endPos, myField.value.length);
		var newCursorPos = endPos + myValue.length;
		myField.setSelectionRange(newCursorPos, newCursorPos);
		myField.focus();
    } else {
        myField.value += myValue;
    }
}
function upCallback()
{
	var io=document.getElementById('imgUploadIframe');

	try{
		var json=(io.contentWindow)?io.contentWindow.document.body.innerHTML:null;
		
		if(!json)json=(io.contentDocument)?io.contentDocument.body.innerHTML:null;

		if(!json)json=(io.document.compatMode&&io.document.compatMode!="BackCompat")?io.document.documentElement.innerHTML:null;
	}
	catch(e){
		return false;
	}

	toggle_mask(false);

	if(json)eval("var data = "+json);
	
	if(typeof(data.error)!='undefined')
	{
		if(data.error!='')
		{
			$('#upload_status').html(data.error+'<br />').attr('class','upload_error');
		}
		else
		{
			$("#upload_status").html("");

			$("#step1").hide();
			
			var step2Width = parseInt(data.width) + 60;

			step2Height = parseInt(data.height);

			if( step2Height < 200 )
				step2Height = 200;

			$("#step2").css({padding:'60px',width:step2Width+'px',height:step2Height+'px'});

			$("#step2").show();

			$("#tempAvatar").html("<img src=\""+data.url+"\" id=\"tempImg\">").css({float:'left',width:data.width,height:data.height});
			
			$('<div><img src="'+data.url+'" style="position: relative;" /><div>')
				.css({float:'right',position: 'relative',overflow:'hidden',width:'40px',height:'40px'})
				.insertAfter($('#tempAvatar'));
			
			$('#tempImg').imgAreaSelect({ 
											aspectRatio: '1:1', 
											onSelectChange: function (img, selection) {
													var scaleX = 40 / (selection.width || 1);
													var scaleY = 40 / (selection.height || 1);
													$('#tempAvatar + div > img').css({
														width: Math.round(scaleX * data.width) + 'px',
														height: Math.round(scaleY * data.height) + 'px',
														marginLeft: '-' + Math.round(scaleX * selection.x1) + 'px',
														marginTop: '-' + Math.round(scaleY * selection.y1) + 'px'});
													},
											onSelectEnd: function (img, selection) {
														$('input[name=x]').val(selection.x1);
														$('input[name=y]').val(selection.y1);
														$('input[name=w]').val(selection.width);
														$('input[name=h]').val(selection.height)
													},
													handles:true,
													x1: 0, y1: 0, x2: 40, y2: 40
											});
		}
	}
}

function uploadAvatar(){
	var filename=$.trim($("#fileToUpload").val());
	if(!filename){return false;}
	var a=filename.split(".");
	if(a.length<=1){
		$('#upload_status').html('请输入正确的文件名<br />').attr('class','upload_error');
		return false;
	}
	var postfix=(a[a.length-1]).toLowerCase();
	var valid={'jpg':1,'jpeg':1,'gif':1,'png':1};
	if(!valid[postfix]){
		$('#upload_status').html('抱歉，目前仅支持格式为jpg、jpeg、gif、png的图片<br />').attr('class','upload_error');
		return false;
	}
	$("#upload_status").html("图片上传中...<br /><img src=\"./images/loadingAnimation.gif\"><br />").attr('class','upload_loadding');
	
	toggle_mask(true);
	
	try{
		if($("#imgUploadIframe").length==0){
			$("#imgUploadForm")
				.before('<iframe name="imgUploadIframe" id="imgUploadIframe" src="" style="display:none;"></iframe>')
				.attr('target','imgUploadIframe').submit();
			if(window.attachEvent){
				document.getElementById("imgUploadIframe").attachEvent('onload',upCallback);
			}
			else{
				document.getElementById("imgUploadIframe").addEventListener('load',upCallback,false);
			}
		}
		$("#imgUploadForm").submit();
	}
	catch(e){
		alert(e);
	}
}

function saveAvatar()
{
	var x = $('input[name=x]').val();
	var y = $('input[name=y]').val();
	var w = $('input[name=w]').val();
	var h = $('input[name=h]').val();

	if( x == "" || y == "" || w == "" || h == "" )
	{
		alert("请选择要设为头像的图片区域");

		return false;
	}

	$.ajax
		(
			{
				type:"POST",
				url:"./upload.php",
				data:"x="+x+"&y="+y+"&w="+w+"&h="+h,
				success:function(msg)
				{
					if( msg == "1" )
						location.href  = location.href;
					else
						alert("保存失败，请重试！");
				}
			}
		);
}

function delAvatar()
{
	$.post('./upload.php',{avatar: 'delete'},function(data){location.href  = location.href;});
}

$(window).unload( function () { delAvatar() } );
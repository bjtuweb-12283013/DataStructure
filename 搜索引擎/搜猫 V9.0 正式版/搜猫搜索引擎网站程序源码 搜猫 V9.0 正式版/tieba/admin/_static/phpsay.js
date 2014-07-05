function updateCategory(cid,fid,name)
{
	$("#father").val(fid);

	$("#name").val(name);

	$("#cid").val(cid);

	$(":submit").val("修改");
}

function delCategory(cid)
{
	var truthBeTold = window.confirm("确定要删除吗？");

	if(truthBeTold)
	{
		$.ajax
		(
			{
				type:"POST",
				url:"./category.php",
				data:"deleteId="+cid,
				timeout:12000,
				success:function(msg)
				{
					if( msg == 0 )
					{
						alert("删除失败，请重试！");
					}
					if( msg == 1 )
					{
						alert("删除成功");

						location.reload();
					}
					if( msg == 2 )
					{
						alert("该目录还有下级分类，不能直接删除！");
					}
				},
				error:function(XMLHttpRequest,textStatus)
				{
					alert('异常！');
				}
			}
		);
	}
}

function forumAuditing(fid,aid)
{
	$.ajax
	(
		{
			type:"POST",
			url:"./forum_temp.php",
			data:"forumId="+fid+"&actionId="+aid,
			success:function(msg)
			{
				if( msg == 1 )
				{
					location.reload();
				}
				else
				{
					alert("操作异常");
				}
			},
			error:function(XMLHttpRequest,textStatus)
			{
				alert('异常！');
			}
		}
	);
}

function applyAuditing(id,aid)
{
	$.ajax
	(
		{
			type:"POST",
			url:"./bm_apply.php",
			data:"Id="+id+"&Action="+aid,
			success:function(msg)
			{
				if( msg == 1 )
				{
					location.reload();
				}
				else
				{
					alert("操作异常");
				}
			},
			error:function(XMLHttpRequest,textStatus)
			{
				alert('异常！');
			}
		}
	);
}

function delModerator(fid,uid)
{
	var truthBeTold = window.confirm("确定要删除该吧主吗？");

	if(truthBeTold)
	{
		$.ajax
		(
			{
				type:"POST",
				url:"./forum_edit.php",
				data:"forumId="+fid+"&userId="+uid,
				timeout:12000,
				success:function(msg)
				{
					if( msg == 1 )
					{
						location.reload();
					}
					else
					{
						alert("操作异常");
					}
				},
				error:function(XMLHttpRequest,textStatus)
				{
					alert('异常！');
				}
			}
		);
	}
}

function delFriend(id,fid)
{
	var truthBeTold = window.confirm("确定要删除该同盟吧吗？");

	if(truthBeTold)
	{
		$.ajax
		(
			{
				type:"POST",
				url:"./forum_edit.php",
				data:"forumId="+id+"&friendId="+fid,
				timeout:12000,
				success:function(msg)
				{
					if( msg == 1 )
					{
						location.reload();
					}
					else
					{
						alert("操作异常");
					}
				},
				error:function(XMLHttpRequest,textStatus)
				{
					alert('异常！');
				}
			}
		);
	}
}

function toggleSelect()
{
	$(".operchk").each(function(i){if(this.disabled)return;if(this.checked){this.checked=""}else{this.checked="checked"}})
}

function selectAll()
{
	$(".operchk").each(function(i){if(this.disabled)return;this.checked="checked"})
}

function delSelItems()
{
	var e=$(".operchk").filter(function(){return!this.disabled&&this.checked}).map(function(){return this.value}).get().join(',');

	if( e.length==0 )
	{
		alert('请选择要删除的帖子');
	}
	else
	{
		var truthBeTold = window.confirm("确定要删除这些帖子吗？");

		if(truthBeTold)
		{
			$.ajax
			(
				{
					type:"POST",
					url:location.pathname,
					data:"deleteId="+e,
					success:function(msg)
					{
						if( msg != 1 )
						{
							alert(msg);
						}

						location.reload();
					}
				}
			);
		}
	}
}

function modifyPostContent(pid)
{
	$.ajax({
			type:"POST",
			url:location.pathname,
			data:"pid="+pid+"&message="+encodeURIComponent($("#message_"+pid).val()),
			success:function(msg){ alert(msg) }
		});
}

function delReport(id)
{
	$.ajax({
			type:"POST",
			url:location.pathname,
			data:"id="+id+"&do=delete",
			success:function(msg){ if(msg == "1"){location.href=location.href}else{alert(msg)} }
		});
}

function unBlack(T)
{
	var truthBeTold = window.confirm("确定要继续此解封操作吗？");
	
	if(!truthBeTold)
		return false;

	$.ajax({
			type:"POST",
			url:location.pathname,
			data:"Type="+T,
			success:function(msg)
			{
				if( msg == 1 )
					location.href = location.pathname;
				else
					alert("操作异常，请重试！");
			}
		});
}

function removeBlack(id)
{
	$.ajax({
			type:"POST",
			url:location.pathname,
			data:"deleteId="+id,
			success:function(msg)
			{
				if( msg == 1 )
				{
					$("#TR1_"+id).remove();

					$("#TR2_"+id).remove();

					$("#TotalNum").text($("#TotalNum").text()-1);
				}
				else
				{
					alert("操作异常，请重试！");
				}
			}
		});
}

function blackAll(uid,uname)
{
	var truthBeTold = window.confirm("确定要继续此全局封锁操作吗？");
	
	if(!truthBeTold)
		return false;

	$.ajax({
			type:"POST",
			url:location.pathname,
			data:"uid="+uid+"&uname="+uname,
			success:function(msg)
			{
				if( msg == 1 )
				{
					location.href = location.pathname;
				}
				else
				{
					alert("操作异常，请重试！");
				}
			}
		});
}

function forumCategory(fid,aid)
{
	$.ajax({
			type:"POST",
			url:"./forum_category.php",
			data:"fid="+fid+"&aid="+aid,
			success:function(msg)
			{
				if( msg == 1 )
				{
					$("#TR1_"+fid).remove();

					$("#TR2_"+fid).remove();

					$("#TotalNum").text($("#TotalNum").text()-1);
				}
				else
				{
					alert("操作异常，请重试！");
				}
			}
		});
}
<?php
define('CURSCRIPT', 'upload_img');
require('../include/common.inc.php');


if(isset($_POST['upload']) && $_FILES['uploadfile']['error']==0)
{

	if($cyask_uid)
	{
		$query=$dblink->query("SELECT attachopen FROM {$tablepre}member where uid=$cyask_uid");
		$attachopen=$dblink->result($query,0);
		
		if(!$attachopen)
		{
			$return_msg='alert("您没有上传图片的权限！");';
			include template('upload_img');
			exit;
		}
	}
	else
	{
		$return_msg='alert("还未登录，不能上传图片！");';
		include template('upload_img');
		exit;
	}
	
	$image_info=getimagesize($_FILES['uploadfile']['tmp_name']);

	if($image_info[2]==1)
	{
		$file_extend='.gif';
	}
	elseif($image_info[2]==2)
	{
		$file_extend='.jpg';
	}
	elseif($image_info[2]==3)
	{
		$file_extend='.png';
	}
	else
	{
		$return_msg='alert("图片格式不符合要求，建议上传 jpg 格式");';
		include template('upload_img');
		exit;
	}
	
	if($_FILES['uploadfile']['size']>800000)
	{
		$return_msg='alert("抱歉，上传的图片过大，请小于800KB");';
		include template('upload_img');
		exit;
    }

	//上传路径
	$upload_dir='../'.$attachurl.'/'.ceil($cyask_uid/1000);
	if(!is_dir($upload_dir))
	{
		mkdir($upload_dir, 0770);
	}
	
	$upload_dir=$upload_dir.'/u_'.$cyask_uid;
	if(!is_dir($upload_dir))
	{
		mkdir($upload_dir, 0770);
	}
	
	$upload_dir=$upload_dir.'/'.date("y_m");
	if(!is_dir($upload_dir))
	{
		mkdir($upload_dir, 0770);
	}
	
	//文件命名
	$upload_filename=date("d_H_i_s").'_'.$_FILES['uploadfile']['size'].$file_extend;

	if(move_uploaded_file($_FILES['uploadfile']['tmp_name'],$upload_dir.'/'.$upload_filename))
	{
		$upload_url = substr( $boardurl, 0, strpos( $boardurl, "cyaskeditor" ) ) ;
		$webpath = $upload_url.$attachurl.'/'.ceil($cyask_uid/1000).'/u_'.$cyask_uid.'/'.date("y_m").'/';
	
		$filesize=ceil($_FILES['uploadfile']['size']/1024); //kb
		$dblink->query("UPDATE {$tablepre}member SET attachments=attachments+$filesize where uid=$cyask_uid"); 
		
		$return_msg='try{parent.document.getElementById("imgLink").value="'.$webpath.$upload_filename.'";alert("图片上传成功！");}catch(err){alert("图片已上传，但粘贴失败！");}';
		include template('upload_img');
		exit;
	}
	else
	{
		$return_msg='alert("出现错误！请暂时停止上传");';
		include template('upload_img');
		exit;
	}
}
else
{
	include template('upload_img');
	exit;
}
?>
<?php
require(dirname(__FILE__)."/global.php");

if( isset($_FILES['upImg']) )
{
	if( $userGroup[$loginArr['group']]['upload'] == 0 )
	{
		echo '{"error":"您所在的用户组无权上传图片!"}';
	}
	else
	{
		$savePath = "attachment/img/".date('Y/m/d/H');

		mkDirs($savePath);

		$fileType = strtolower(strrchr($_FILES['upImg']['name'],"."));

		if ( !in_array($fileType, array(".jpg",".jpeg",".gif",".png")) )
		{
			echo '{"error":"目前仅支持格式为jpg、jpeg、gif、png的图片!"}';
		}
		elseif( $_FILES['upImg']['size'] > 204800 )
		{
			echo '{"error":"图片不能超过200K!"}';
		}
		else
		{
			$saveImg = $savePath."/".$loginArr['uid']."_".time().rand().$fileType;

			if( @move_uploaded_file($_FILES['upImg']['tmp_name'], $saveImg) )
			{
				echo '{"error":"","msg":"http://'.$site_domain.$site_catalog.$saveImg.'"}';
			}
			else
			{
				echo '{"error":"图片上传失败!"}';
			}
		}
	}
}

if( $loginArr['state'] == 0 )
{
	echo '{"error":"您还没有登录!"}';
}
else
{
	$avatarPath = "attachment/avatar/".($loginArr['uid']%32)."/".($loginArr['uid']%257)."/".$loginArr['uid'];

	if( isset($_FILES['upAvatar']) )
	{
		mkDirs($avatarPath);

		$fileType = strtolower(strrchr($_FILES['upAvatar']['name'],"."));

		if ( !in_array($fileType, array(".jpg",".jpeg",".gif",".png")) )
		{
			echo '{"error":"目前仅支持格式为jpg、jpeg、gif、png的图片!"}';
		}
		elseif( $_FILES['upAvatar']['size'] > 2097152 )
		{
			echo '{"error":"图片不能超过2MB!"}';
		}
		else
		{
			$imgInfo = @getimagesize($_FILES['upAvatar']['tmp_name']);

			if( !$imgInfo || !in_array($imgInfo[2], array(1,2,3)) )
			{
				echo '{"error":"系统无法识别您上传的文件!"}';
			}
			else
			{
				$TmpAvatar = $avatarPath."/temp".$fileType;
				
				if( @move_uploaded_file($_FILES['upAvatar']['tmp_name'], $TmpAvatar) )
				{
					$maxWidth = 520;

					$maxHeight = 520;

					if( $maxWidth > $imgInfo[0] || $maxHeight > $imgInfo[1] )
					{
						$maxWidth = $imgInfo[0];

						$maxHeight = $imgInfo[1];
					}
					else
					{
						if ( $imgInfo[0] < $imgInfo[1] )
							$maxWidth = ($maxHeight / $imgInfo[1]) * $imgInfo[0];
						else
							$maxHeight = ($maxWidth / $imgInfo[0]) * $imgInfo[1];
					}

					if( $maxWidth < 40 )
					{
						$maxWidth = 40;
					}

					if( $maxHeight < 40 )
					{
						$maxHeight = 40;
					}

					$image_p = imagecreatetruecolor($maxWidth, $maxHeight);

					switch($imgInfo[2])
					{
						case 1:
							$image = imagecreatefromgif($TmpAvatar);
							break;
						case 2:
							$image = imagecreatefromjpeg($TmpAvatar);
							break;
						case 3:
							$image = imagecreatefrompng($TmpAvatar);
							break;
					}

					imagecopyresampled($image_p, $image, 0, 0, 0, 0, $maxWidth, $maxHeight, $imgInfo[0], $imgInfo[1]);

					imagejpeg($image_p, $avatarPath."/temp.jpg",100);

					imagedestroy($image_p);

					imagedestroy($image);

					if( $fileType != ".jpg" && file_exists($TmpAvatar) )
					{
						unlink($TmpAvatar);
					}

					echo '{"error":"","url":"'.$avatarPath.'/temp.jpg?'.rand().'","width":"'.$maxWidth.'","height":"'.$maxHeight.'"}';
				}
				else
				{
					echo '{"error":"图片上传失败!"}';
				}
			}
		}
	}

	if( isset($_POST['x'],$_POST['y'],$_POST['w'],$_POST['h']) )
	{
		if( is_numeric($_POST['x']) && is_numeric($_POST['y']) && $_POST['w'] > 0 && $_POST['h'] > 0 )
		{
			$image_p = imagecreatetruecolor(40, 40);

			$image = imagecreatefromjpeg($avatarPath."/temp.jpg");

			imagecopyresampled($image_p, $image, 0, 0, $_POST['x'], $_POST['y'], 40, 40, $_POST['w'], $_POST['h']);

			imagejpeg($image_p, $avatarPath."/40_40.jpg",100);

			imagedestroy($image_p);

			imagedestroy($image);

			unlink($avatarPath."/temp.jpg");

			echo "1";
		}
	}

	if( isset($_POST['avatar']) && $_POST['avatar'] == "delete" )
	{
		if( file_exists($avatarPath."/temp.jpg") )
		{
			unlink($avatarPath."/temp.jpg");
		}
	}
}

ob_end_flush();
?>
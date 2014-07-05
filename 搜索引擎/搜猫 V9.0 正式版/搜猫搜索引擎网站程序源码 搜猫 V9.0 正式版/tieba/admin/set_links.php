<?php
require(dirname(__FILE__)."/global.php");

$dbFile = dirname(__FILE__)."/../database/db.links.php";

if( isset($_GET['action']) && $_GET['action'] == "update" )
{
	if( isset($_POST['ID'],$_POST['NAME'],$_POST['URL']) )
	{
		$friendLink = array();

		$IdNum = count($_POST['ID']) - 1;

		for($i=0;$i<=$IdNum;$i++)
		{
			$siteName = stripslashes(trim($_POST['NAME'][$i]));

			$siteUrl = stripslashes(trim($_POST['URL'][$i]));

			if( !empty($siteName) && !empty($siteUrl) )
			{
				if( !wordCheck($siteName) )
				{
					die("<script>alert('网站名称不合法');</script>");
				}

				$friendLink[] = array("name"=>$siteName,"url"=>$siteUrl);
			}
		}

		if( @is_writable($dbFile) )
		{
			$handle = @fopen($dbFile, 'w');

			if ( @flock($handle, LOCK_EX) )
			{
				@fwrite($handle, '<?php exit;?>'.serialize($friendLink));

				@flock($handle, LOCK_UN);
			}
			
			@fclose($handle);

			die("<script>alert('更新成功');</script>");
		}
		else
		{
			die("<script>alert('数据文件不可写');</script>");
		}
	}
}

$friendLink = unserialize(substr(file_get_contents($dbFile),13));

$tmp = & myTpl("set_links.html");

$tmp->assign( 'codeName', $code_name );

$tmp->assign( 'codeVersion', $code_version );

$tmp->assign( 'siteName', $site_name );

$tmp->assign( 'siteDomain', $site_domain );

$tmp->assign( 'siteCatalog', $site_catalog );

$tmp->assign( 'friendLink', $friendLink );

$tmp->output();
?>
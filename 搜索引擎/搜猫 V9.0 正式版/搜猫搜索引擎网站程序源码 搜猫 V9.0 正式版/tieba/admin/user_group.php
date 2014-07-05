<?php
require(dirname(__FILE__)."/global.php");

if( isset($_GET['action']) && $_GET['action'] == "update" )
{
	if( isset($_POST['ID'],$_POST['NAME'],$_POST['TOPIC'],$_POST['REPLY'],$_POST['VERIFY']) )
	{
		$config_str = "<?php";

		$config_str .= "\n";

		$config_str .= '$userGroup = array';

		$config_str .= "\n";

		$config_str .= "(";

		$config_str .= "\n";

		$IdNum = count($_POST['ID']) - 1;

		for($i=0;$i<=$IdNum;$i++)
		{
			$GN = stripslashes(trim($_POST['NAME'][$i]));

			if( empty($GN) || !wordCheck($GN) )
			{
				die("<script>alert('用户组名称不合法');</script>");
			}

			$GT = $_POST['TOPIC'][$i];

			$GR = $_POST['REPLY'][$i];
			
			$GV = $_POST['VERIFY'][$i];
			
			$GU = $_POST['UPLOAD'][$i];
			
			$config_str .= '	array("name"=>"'.$GN.'","topic"=>'.$GT.',"reply"=>'.$GR.',"verify"=>'.$GV.',"upload"=>'.$GU.')';
			
			if( $i == $IdNum )
			{
				$config_str .= "\n";
			}
			else
			{
				$config_str .= ",\n\n";
			}
		}
		
		$config_str .= ");";

		$config_str .= "\n";

		$config_str .= "?>";

		$configFile = dirname(__FILE__)."/../database/config_group.php";

		if( @is_writable($configFile) )
		{
			$handle = @fopen($configFile, 'w');

			if ( @flock($handle, LOCK_EX) )
			{
				@fwrite($handle, $config_str);

				@flock($handle, LOCK_UN);
			}
			
			@fclose($handle);

			die("<script>alert('修改成功');top.location.reload();</script>");
		}
		else
		{
			die("<script>alert('config_group.php 文件不可写');</script>");
		}
	}
}

$tmp = & myTpl("user_group.html");

$tmp->assign( 'codeName',  $code_name );

$tmp->assign( 'codeVersion',  $code_version );

$tmp->assign( 'siteName',  $site_name );

$tmp->assign( 'siteDomain',  $site_domain );

$tmp->assign( 'siteCatalog',  $site_catalog );

$tmp->assign( 'userGroup',  $userGroup );

$tmp->output();
?>
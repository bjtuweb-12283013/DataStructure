<?php
require(dirname(__FILE__)."/global.php");

$dbFile = dirname(__FILE__)."/../database/db.filter.php";

if( isset($_GET['action']) && $_GET['action'] == "update" )
{
	if( isset($_POST['ID'],$_POST['OLD'],$_POST['NEW']) )
	{
		$filterWords = array();

		$IdNum = count($_POST['ID']) - 1;

		for($i=0;$i<=$IdNum;$i++)
		{
			$OldWord = strAddslashes(trim($_POST['OLD'][$i]));

			$NewWord = strAddslashes(trim($_POST['NEW'][$i]));

			if( !empty($OldWord) && !empty($NewWord) )
			{
				$filterWords[] = array($OldWord,$NewWord);
			}
		}

		if( @is_writable($dbFile) )
		{
			$handle = @fopen($dbFile, 'w');

			if ( @flock($handle, LOCK_EX) )
			{
				@fwrite($handle, '<?php exit;?>'.serialize($filterWords));

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

$filterWords = unserialize(substr(file_get_contents($dbFile),13));

$tmp = & myTpl("set_filter.html");

$tmp->assign( 'codeName', $code_name );

$tmp->assign( 'codeVersion', $code_version );

$tmp->assign( 'siteName', $site_name );

$tmp->assign( 'siteDomain', $site_domain );

$tmp->assign( 'siteCatalog', $site_catalog );

$tmp->assign( 'filterWords', $filterWords );

$tmp->output();
?>
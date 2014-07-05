<?php
require(dirname(__FILE__)."/global.php");

if( isset($_GET['do'],$_GET['file']) && !empty($_GET['file']) )
{
	$sqlFile = $dbBakPath.$_GET['file'];

	if( !is_file($sqlFile) )
	{
		die("<script>alert('文件无效');top.location.href=top.location.href;</script>");
	}

	if( $_GET['do'] == "down" )
	{
		$fp = @fopen($sqlFile,"r");

		header("Content-type:application/octet-stream");
		
		header("Accept-Ranges:bytes");

		header("Accept-Length:".filesize($sqlFile));

		header("Content-Disposition:attachment; filename=".$_GET['file']);

		echo @fread($fp,filesize($sqlFile));

		@fclose($fp);
		
		exit;
	}
	
	if( $_GET['do'] == "del" )
	{
		@unlink($sqlFile);

		die("<script>alert('删除成功');top.location.href=top.location.href;</script>");
	}
	
	if( $_GET['do'] == "import" )
	{
		if ( !( $fp = fopen( $sqlFile, "r" ) ) )
		{
			die("<script>alert('读取备份文件失败');</script>");
		}

		$DB->connect($mysql_host,$mysql_user,$mysql_pass,$mysql_dbname);

		$sql = "";

		while ( !feof( $fp ) )
		{
			$line = trim( fgets( $fp, 524288 ) );

			if ( ereg( ";\$", $line ) )
			{
				$sql .= $line;

				$DB->query($sql);
				
				$sql = "";
			}
			else if ( !ereg( "^(//|--)", $line ) )
			{
				$sql .= $line;
			}
		}

		$DB->close();

		fclose( $fp );

		die("<script>alert('还原成功');</script>");
	}
}

$sqlFileArr = array();

if ( $handle = @opendir($dbBakPath) )
{
	while ( ( $file = readdir( $handle ) ) !== false )
	{
		$fileType = strtolower(strrchr($dbBakPath.$file,"."));

		if ( $fileType == ".sql" )
		{
			$sqlFileArr[] = array(
									"file" => $file,
									"size" => filesize_format(filesize($dbBakPath.$file)),
									"time" => date('Y-m-d H:i:s',filectime($dbBakPath.$file))
								);
		}
	}

	closedir( $handle );
}

$tmp = & myTpl("db_import.html");
			 
$tmp->assign( 'codeName',  $code_name );
			 
$tmp->assign( 'codeVersion',  $code_version );
			 
$tmp->assign( 'siteName',  $site_name );
			 
$tmp->assign( 'siteDomain',  $site_domain );
			 
$tmp->assign( 'siteCatalog',  $site_catalog );
			 
$tmp->assign( 'sqlFile',  $sqlFileArr );
			 
$tmp->output();
?>
<?php
require(dirname(__FILE__)."/global.php");

$dbBakDir = substr(substr($dbBakPath,2),0,-1);

if( isset($_POST['dbExport']) )
{
	$bakFile = md5($mysql_user."@".$mysql_pass."@".time()).".sql";

	$bakSql = "";

	if ( empty($dbBakDir) )
	{
		die("<script>alert('请先设置好备份文件的存放目录');top.$('#bakDir').focus();</script>");
	}

	if ( !is_writeable($dbBakPath) )
	{
		die("<script>alert('备份目录 ".$dbBakDir." 不可写');</script>");
	}

	if ( !isset($_POST['dbTable']) || count($_POST['dbTable']) < 1 )
	{
		die("<script>alert('请选择要备份的数据表');</script>");
	}

	$DB->connect($mysql_host,$mysql_user,$mysql_pass,$mysql_dbname);

	foreach($_POST['dbTable'] as $Table)
	{
		$bakSql .= "TRUNCATE TABLE `".$Table."`;\n";

		$Query = $DB->query("SELECT * FROM `".$Table."`");

		while($Re = $DB->fetch_array($Query))
		{
			$value = array();

			foreach($Re as $key=>$val)
			{
				if( is_numeric($key) )
				{
					$val = str_replace( array("\r","\n"), array("\\r","\\n"), "'".addslashes( $val )."'" );
					
					$value[] = $val;
				}
			}

			$bakSql .= "REPLACE INTO `".$Table."` VALUES (".implode( ", ", $value ).");\n";
		}
	}

	$DB->close();
	
	$fp = @fopen($dbBakPath.$bakFile, "w");
	
	if( @flock($fp, LOCK_EX) )
	{
		@fwrite($fp, $bakSql);
		
		@flock($fp, LOCK_UN);
	}
	
	@fclose($fp);

	die("<script>alert('备份成功');top.location.href='./db_import.php';</script>");
}

if( isset($_POST['bakSet'],$_POST['bakDir']) )
{
	$newBakDir = stripslashes(trim($_POST['bakDir']));

	if( $newBakDir == $dbBakDir )
	{
		die("<script>alert('目录未更改');</script>");
	}

	if( empty($newBakDir) )
	{
		die("<script>alert('目录名称不能为空');top.$('#bakDir').focus();</script>");
	}

	if( !ereg("^[0-9a-zA-Z_]*$",$newBakDir) || file_exists("./".$newBakDir."/") )
	{
		die("<script>alert('目录名称不合法');top.$('#bakDir').focus();</script>");
	}

	$actionDir = false;
	
	if( empty($dbBakDir) )
	{
		if( mkdir("./".$newBakDir."/", 0777) )
		{
			$actionDir = true;
		}
	}
	else
	{
		if( rename($dbBakPath,"./".$newBakDir."/") )
		{
			$actionDir = true;
		}
	}

	if( $actionDir )
	{
		$config_str = "<?php";
		
		$config_str .= "\n";
		
		$config_str .= '	$dbBakPath = "./'.$newBakDir.'/";';

		$config_str .= "\n";

		$config_str .= '?>';
		
		$configFile = dirname(__FILE__)."/include/config.php";
		
		if( @is_writable($configFile) )
		{
			$handle = @fopen($configFile, 'w');
			
			if ( @flock($handle, LOCK_EX) )
			{
				@fwrite($handle, $config_str);
				
				@flock($handle, LOCK_UN);
			}
			
			@fclose($handle);
			
			die("<script>alert('设置成功');</script>");
		}
		else
		{
			die("<script>alert('配置文件不可写');</script>");
		}
	}
	else
	{
		die("<script>alert('目录操作失败');</script>");
	}
}

$DB->connect($mysql_host,$mysql_user,$mysql_pass,$mysql_dbname,'');

$dbTable = $DB->fetch_all("SHOW TABLE STATUS");

$DB->close();

$mysqlTable = array();

foreach($dbTable as $table)
{
	if( substr($table['Name'],0,strlen($mysql_prefix)) == $mysql_prefix )
	{
		$mysqlTable[] = array(
								"Name"=>$table['Name'],
								"Comment"=>$table['Comment'],
								"Rows"=>$table['Rows'],
								"Data_length"=>filesize_format($table['Data_length'])
							);
	}
}

$tmp = & myTpl("db_export.html");
			 
$tmp->assign( 'codeName',  $code_name );
			 
$tmp->assign( 'codeVersion',  $code_version );
			 
$tmp->assign( 'siteName',  $site_name );
			 
$tmp->assign( 'siteDomain',  $site_domain );
			 
$tmp->assign( 'siteCatalog',  $site_catalog );
			 
$tmp->assign( 'dbBakDir',  $dbBakDir );
			 
$tmp->assign( 'dbTable',  $mysqlTable );
			 
$tmp->output();
?>
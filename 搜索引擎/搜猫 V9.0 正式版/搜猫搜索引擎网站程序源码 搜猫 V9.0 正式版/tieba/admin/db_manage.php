<?php
require(dirname(__FILE__)."/global.php");

if( isset($_POST['ActionType'],$_POST['ActionDo']) )
{
	if ( !in_array($_POST['ActionType'],array("1","2")) )
	{
		die("<script>alert('请选择操作类型');</script>");
	}

	if ( !isset($_POST['dbTable']) || count($_POST['dbTable']) < 1 )
	{
		die("<script>alert('请选择要操作的数据表');</script>");
	}

	$Tables = "";

	foreach($_POST['dbTable'] as $Table)
	{
		$Tables .= "`".$Table."`,";
	}

	$Tables = substr($Tables,0,-1);

	if( $_POST['ActionType'] == 1 )
		$ActionSql = "OPTIMIZE TABLE ".$Tables;
	
	if( $_POST['ActionType'] == 2 )
		$ActionSql = "REPAIR TABLE ".$Tables;

	$DB->connect($mysql_host,$mysql_user,$mysql_pass,$mysql_dbname,'');
	
	$DB->query($ActionSql);

	$DB->close();

	die("<script>alert('操作成功');</script>");
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
								"Index_length"=>filesize_format($table['Index_length']),
								"Data_length"=>filesize_format($table['Data_length'])
							);
	}
}

$tmp = & myTpl("db_manage.html");
			 
$tmp->assign( 'codeName',  $code_name );
			 
$tmp->assign( 'codeVersion',  $code_version );
			 
$tmp->assign( 'siteName',  $site_name );
			 
$tmp->assign( 'siteDomain',  $site_domain );
			 
$tmp->assign( 'siteCatalog',  $site_catalog );
			 
$tmp->assign( 'dbBakPath',  $dbBakPath );
			 
$tmp->assign( 'dbTable',  $mysqlTable );
			 
$tmp->output();
?>
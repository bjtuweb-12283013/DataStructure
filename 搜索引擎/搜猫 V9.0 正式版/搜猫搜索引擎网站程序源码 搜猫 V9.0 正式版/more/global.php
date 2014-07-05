<?php
error_reporting(0);
define("PATH",getdirname(__FILE__));
define("ROOT","../");
require PATH."../include/db_config.php";
require PATH."../include/db_mysql.class.php";
require PATH."../cache/site_config.php";
date_default_timezone_set('PRC');
$db=new db_mysql;
$db->connect($dbhost,$dbuser,$dbpw,$dbname,$dbpconnect,$dbcharset);
function getdirname($path=null){
	if (!empty($path)) {
		if (strpos($path,'\\')!==false) {
			return substr($path,0,strrpos($path,'\\')).'/';
		} elseif (strpos($path,'/')!==false) {
			return substr($path,0,strrpos($path,'/')).'/';
		}
	}
	return './';
}
require PATH."../include/global_func.php";
require PATH."../include/global_sub_function.php";
/*require PATH."../include/commonfuncs.php";
require PATH."../include/spider/spider_class.php";*/
?>
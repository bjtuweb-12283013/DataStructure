<?php
/*
	[CYASK] (C)2009 Cyask.com
	Revision: 3.2
	Date: 2009-1-19
	Author: zhaoshunyao
	QQ: 240508015
*/

error_reporting(E_ERROR | E_WARNING | E_PARSE);
$mtime = explode(' ', microtime());
$cyask_starttime = $mtime[1] + $mtime[0];

define('IN_CYASK', TRUE);
define('CYASK_ROOT', substr(dirname(__FILE__), 0, -7));
require_once CYASK_ROOT.'./config.inc.php';
require_once CYASK_ROOT.'./include/global.func.php';
require_once CYASK_ROOT.'./include/db_mysql.php';

if(!defined('CURSCRIPT'))
{
	exit('CURSCRIPT ERROR');
}
define('FORMHASH', form_hash());
$magic_quotes_gpc = get_magic_quotes_gpc();
if(!$magic_quotes_gpc)
{
	$_POST	= daddslashes($_POST);
	$_GET	= daddslashes($_GET);
	$_FILES = daddslashes($_FILES);
}

///////////////////////////////////运行参数/////////////////////////////////////////
$version='3.2';
$timestamp	  = time();
$PHP_SELF	  = $_SERVER['PHP_SELF'] ? $_SERVER['PHP_SELF'] : $_SERVER['SCRIPT_NAME'];
$QUERY_STRING = empty($_SERVER['QUERY_STRING']) ? '' : '?'.$_SERVER['QUERY_STRING'];
$boardurl = 'http://'.$_SERVER['HTTP_HOST'].preg_replace("/\/+(api|archiver|wap)?\/*$/i", '', substr($PHP_SELF, 0, strrpos($PHP_SELF, '/'))).'/';
$onlineip	  = $_SERVER['REMOTE_ADDR'] ? $_SERVER['REMOTE_ADDR'] : '0.0.0.0';
$command	  = empty($_POST['command']) ? $_GET['command'] : $_POST['command'];

$dblink = new db_sql;
$dblink->connect($dbhost, $dbuser, $dbpw, $dbname, $pconnect);
unset($dbhost, $dbuser, $dbpw, $dbname, $pconnect);

$_DCOOKIE = $_DCACHE =array();

$prelength = strlen($cookiepre);
foreach($_COOKIE as $key => $val)
{
	if(substr($key, 0, $prelength) == $cookiepre)
	{
		$_DCOOKIE[(substr($key, $prelength))] = daddslashes($val);
	}
}
unset($prelength);

list($cyask_uid,$cyask_user,$cyask_pw) = isset($_DCOOKIE['compound']) ? explode("\t", authcode($_DCOOKIE['compound'], 'DECODE', $cyask_key)) : array(0,'','');
$cyask_uid = intval($cyask_uid);

$styleid = $_DCOOKIE['styleid'] ? $_DCOOKIE['styleid'] : 1 ;

///////////////////////提取身份///////////////////////////
if($cyask_uid)
{
	$query = $dblink->query("SELECT adminid FROM {$tablepre}member WHERE uid=$cyask_uid");
	$members=$dblink->fetch_array($query);
	$cyask_adminid = $members['adminid'];
}

$cache_variable_file = CYASK_ROOT.'./askdata/cache/cache_variable.php';
if(file_exists($cache_variable_file))
{
	include_once($cache_variable_file);
}
else
{
	create_cache('variable');
	include_once($cache_variable_file);
}

$cache_style_file = CYASK_ROOT.'./askdata/cache/cache_style.php';
if(file_exists($cache_style_file))
{
	include_once($cache_style_file);
}
else
{
	create_cache('style');
	include_once($cache_style_file);
}

$tpldir = $_DCACHE['style'][$styleid]['tpldir'];
$styledir = $_DCACHE['style'][$styleid]['styledir'];

if(!defined('CURSCRIPT') || CURSCRIPT != 'wap')
{
	if(!$headercache)
	{
		@header("Expires: 0");
		@header("Cache-Control: private, post-check=0, pre-check=0, max-age=0", FALSE);
		@header("Pragma: no-cache");
	}
	if($headercharset && !defined('TEXTXML'))
	{
		@header('Content-Type: text/html; charset='.$charset);
	}
}

if($gzipcompress && function_exists('ob_gzhandler'))
{
	ob_start('ob_gzhandler');
}
else
{
	$gzipcompress = 0;
	ob_start();
}
?>
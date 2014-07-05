<?php
/*
	[CYASK] (C)2009 Cyask.com
	Revision: 3.2
	Date: 2009-1-19
	Author: zhaoshunyao
	QQ: 240508015
*/

if(!defined('IN_CYASK'))
{
	exit('Access Denied');
}

function parse_template($file, $language, $tpldir, $templateid)
{
	global $lang;
	$nest = 5;
	$tplfile = CYASK_ROOT."./$tpldir/$file.html";
	$objfile = CYASK_ROOT."./askdata/templates/{$templateid}_$file.tpl.php";

	if(!@$fp = fopen($tplfile, 'r'))
	{
		exit("Current template file './$tpldir/$file.html' not found or have no access!");
	}
	elseif(!include_once language($language, $tpldir, $templateid))
	{
		exit("<br>Current template pack do not have a necessary language file '".$language."lang.php' or have syntax error!");
	}

	$template = fread($fp, filesize($tplfile));
	fclose($fp);

	$var_regexp = "((\\\$[a-zA-Z_\x7f-\xff][a-zA-Z0-9_\x7f-\xff]*)(\[[a-zA-Z0-9_\-\.\"\'\[\]\$\x7f-\xff]+\])*)";
	$const_regexp = "([a-zA-Z_\x7f-\xff][a-zA-Z0-9_\x7f-\xff]*)";

	$template = preg_replace("/([\n\r]+)\t+/s", "\\1", $template);
	$template = preg_replace("/\<\!\-\-\{(.+?)\}\-\-\>/s", "{\\1}", $template);
	$template = preg_replace("/\{lang\s+(.+?)\}/ies", "languagevar('\\1')", $template);
	$template = str_replace("{LF}","<?php echo \"\\n\";?>", $template);

	$template = preg_replace("/\{(\\\$[a-zA-Z0-9_\[\]\'\"\$\.\x7f-\xff]+)\}/s", "<?php echo \\1;?>", $template);
	
	$template = preg_replace("/\<\?php echo \<\?php echo $var_regexp;\?\>;\?\>/es", "addquote('<?php echo \\1;?>')", $template);

	$template = "<?php if(!defined('IN_CYASK')) exit('Access Denied'); ?>\n$template";
	$template = preg_replace("/[\n\r\t]*\{template\s+([a-z0-9_]+)\}[\n\r\t]*/is", "\n<?php include template('\\1'); ?>\n", $template);
	$template = preg_replace("/[\n\r\t]*\{template\s+(.+?)\}[\n\r\t]*/is", "\n<?php include template(\\1); ?>\n", $template);
	$template = preg_replace("/[\n\r\t]*\{eval\s+(.+?)\}[\n\r\t]*/ies", "stripvtags('\n<?php \\1 ?>\n','')", $template);
	$template = preg_replace("/[\n\r\t]*\{echo\s+(.+?)\}[\n\r\t]*/ies", "stripvtags('<?php echo \\1;?>','')", $template);
	$template = preg_replace("/[\n\r\t]*\{elseif\s+(.+?)\}[\n\r\t]*/ies", "stripvtags('\n<?php } elseif(\\1) { ?>\n','')", $template);
	$template = preg_replace("/[\n\r\t]*\{else\}[\n\r\t]*/is", "\n<?php } else { ?>\n", $template);

	for($i = 0; $i < $nest; $i++)
	{
		$template = preg_replace("/[\n\r\t]*\{loop\s+(\S+)\s+(\S+)\}[\n\r]*(.+?)[\n\r]*\{\/loop\}[\n\r\t]*/ies", "stripvtags('\n<?php if(is_array(\\1)) { foreach(\\1 as \\2) { ?>','\n\\3\n<?php } } ?>\n')", $template);
		$template = preg_replace("/[\n\r\t]*\{loop\s+(\S+)\s+(\S+)\s+(\S+)\}[\n\r\t]*(.+?)[\n\r\t]*\{\/loop\}[\n\r\t]*/ies", "stripvtags('\n<?php if(is_array(\\1)) { foreach(\\1 as \\2 => \\3) { ?>','\n\\4\n<?php } } ?>\n')", $template);
		$template = preg_replace("/[\n\r\t]*\{if\s+(.+?)\}[\n\r]*(.+?)[\n\r]*\{\/if\}[\n\r\t]*/ies", "stripvtags('\n<?php if(\\1) { ?>','\n\\2\n<?php } ?>\n')", $template);
	}

	$template = preg_replace("/\{$const_regexp\}/s", "<?php echo \\1;?>", $template);
	$template = preg_replace("/ \?\>[\n\r]*\<\?php /s", " ", $template);

	if(!@$fp = fopen($objfile, 'w'))
	{
		exit("Directory './askdata/templates/' not found or have no access!");
	}

	$template = preg_replace("/\"(http)?[\w\.\/:]+\?[^\"]+?&[^\"]+?\"/e", "transamp('\\0')", $template);
	flock($fp, 2);
	fwrite($fp, $template);
	fclose($fp);
}

function transamp($str)
{
	$str = str_replace('&', '&amp;', $str);
	$str = str_replace('&amp;amp;', '&amp;', $str);
	$str = str_replace('\"', '"', $str);
	return $str;
}

function addquote($var)
{
	return str_replace("\\\"", "\"", preg_replace("/\[([a-zA-Z0-9_\-\.\x7f-\xff]+)\]/s", "['\\1']", $var));
}

function languagevar($var)
{
	global $lang;
	if(isset($lang[$var]))
	{
		return $lang[$var];
	}
	else
	{
		return "!$var!";
	}
}

function stripvtags($expr, $statement)
{
	$expr = str_replace("\\\"", "\"", preg_replace("/\<\?php echo (\\\$.+?)\?\>/s", "\\1", $expr));
	$statement = str_replace("\\\"", "\"", $statement);
	return $expr.$statement;
}

?>
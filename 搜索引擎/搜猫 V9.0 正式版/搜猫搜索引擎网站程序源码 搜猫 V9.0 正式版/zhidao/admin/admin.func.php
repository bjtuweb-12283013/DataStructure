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

function sizecount($file_size)
{
	if($file_size >= 1073741824)
	{
		$file_size = round($file_size / 1073741824 * 100) / 100 . ' G';
	}
	elseif($file_size >= 1048576)
	{
		$file_size = round($file_size / 1048576 * 100) / 100 . ' M';
	}
	elseif($file_size >= 1024)
	{
		$file_size = round($file_size / 1024 * 100) / 100 . ' K';
	}
	else
	{
		$file_size = $file_size . ' bytes';
	}
	return $file_size;
}
function dir_size($dir)
{
	$dh = opendir($dir);
	$size = 0;
	while($file = readdir($dh))
	{
		if ($file != '.' and $file != '..')
		{
			$path = $dir."/".$file;
			if (@is_dir($path))
			{
				$size += dir_size($path);
			}
			else
			{
				$size += filesize($path);
			}
		}
	}
	@closedir($dh);
	return $size;
}

function istpldir($dir)
{
	return is_dir('./'.$dir) && !in_array(substr($dir, -1, 1), array('/', '\\')) &&
		 strpos(realpath('./'.$dir), realpath('./templates')) === 0;
}

function isplugindir($dir)
{
	return !$dir || (!preg_match("/(\.\.|[\\\\]+$)/", $dir) && substr($dir, -1) =='/');
}

function ispluginkey($key)
{
	return preg_match("/^[a-z]+[a-z0-9_]*$/i", $key);
}
function dir_writeable($dir)
{
	if(!is_dir($dir))
	{
		@mkdir($dir, 0777);
	}
	if(is_dir($dir))
	{
		if($fp = @fopen("$dir/test.test", 'w'))
		{
			@fclose($fp);
			@unlink("$dir/test.test");
			$writeable = 1;
		}
		else
		{
			$writeable = 0;
		}
	}
	return $writeable;
}
function setconfig($string)
{
	if(!get_magic_quotes_gpc())
	{
		$string = str_replace('\'', '\\\'', $string);
	}
	else
	{
		$string = str_replace('\"', '"', $string);
	}
	return $string;
}

function hookselect($hooksarray, $title = '')
{
	$hookselect = '';
	foreach($hooksarray as $group => $hooks)
	{
		$hookselect .= "<optgroup label=\"$group\">";
		foreach($hooks as $hook)
		{
			$hookselect .= "<option value=\"$hook\" ".($title && $title == $hook ? 'selected' : '').">$hook</option>";
		}
		$hookselect .= "</optgroup>";
	}
	return $hookselect;
}


function sqldumptable($table, $startfrom = 0, $currsize = 0)
{
	global $dblink, $sizelimit, $startrow, $extendins, $sqlcompat, $sqlcharset, $dumpcharset;

	$offset = 300;
	$tabledump = '';

	if(!$startfrom)
	{

		$tabledump = "DROP TABLE IF EXISTS $table;\n";

		$createtable = $dblink->query("SHOW CREATE TABLE $table");
		$create = $dblink->fetch_row($createtable);

		$tabledump .= $create[1];

		if($sqlcompat == 'MYSQL41' && $Dblink->version() < '4.1')
		{
			$tabledump = preg_replace("/TYPE\=(.+)/", "ENGINE=\\1 DEFAULT CHARSET=".$dumpcharset, $tabledump);
		}
		if($dblink->version() > '4.1' && $sqlcharset)
		{
			$tabledump = preg_replace("/(DEFAULT)*\s*CHARSET=.+/", "DEFAULT CHARSET=".$sqlcharset, $tabledump);
		}

		$query = $dblink->query("SHOW TABLE STATUS LIKE '$table'");
		$tablestatus = $dblink->fetch_array($query);
		$tabledump .= ($tablestatus['Auto_increment'] ? " AUTO_INCREMENT=$tablestatus[Auto_increment]" : '').";\n\n";

	}

	$tabledumped = 0;
	$numrows = $offset;
	if($extendins =='0')
	{
		while($currsize + strlen($tabledump) < $sizelimit * 1000 && $numrows == $offset)
		{
			$tabledumped = 1;
			$rows = $dblink->query("SELECT * FROM $table LIMIT $startfrom, $offset");
			$numfields = $dblink->num_fields($rows);
			$numrows = $dblink->num_rows($rows);
			while ($row = $dblink->fetch_row($rows))
			{
				$comma = '';
				$tabledump .= "INSERT INTO $table VALUES(";
				for($i = 0; $i < $numfields; $i++)
				{
					$tabledump .= $comma.'\''.mysql_escape_string($row[$i]).'\'';
					$comma = ',';
				}
				$tabledump .= ");\n";
			}
			$startfrom += $offset;
		}
	}
	else
	{
		while($currsize + strlen($tabledump) < $sizelimit * 1000 && $numrows == $offset)
		{
			$tabledumped = 1;
			$rows = $dblink->query("SELECT * FROM $table LIMIT $startfrom, $offset");
			$numfields =$dblink->num_fields($rows);
			if($numrows = $dblink->num_rows($rows))
			{
				$tabledump .= "INSERT INTO $table VALUES";
				$commas = '';
				while ($row = $db->fetch_row($rows))
				{
					$comma = '';
					$tabledump .= $commas."(";
					for($i = 0; $i < $numfields; $i++)
					{
						$tabledump .= $comma.'\''.mysql_escape_string($row[$i]).'\'';
						$comma = ',';
					}
					$tabledump .= ')';
					$commas = ',';
				}
				$tabledump .= ";\n";
			}
			$startfrom += $offset;
		}

	}

	$startrow = $startfrom;
	$tabledump .= "\n";
	return $tabledump;
}

function splitsql($sql)
{
	$sql = str_replace("\r", "\n", $sql);
	$ret = array();
	$num = 0;
	$queriesarray = explode(";\n", trim($sql));
	unset($sql);
	foreach($queriesarray as $query)
	{
		$queries = explode("\n", trim($query));
		foreach($queries as $query)
		{
			$ret[$num] .= $query[0] == "#" ? NULL : $query;
		}
		$num++;
	}
	return($ret);
}
?>
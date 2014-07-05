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

class db_sql
{
	var $querynum = 0;

	function connect($dbhost, $dbuser, $dbpw, $dbname = '', $pconnect = 0)
	{
		if($pconnect)
		{
			if(!@mysql_pconnect($dbhost, $dbuser, $dbpw))
			{
				$this->halt('Can not connect to MySQL server');
			}
		}
		else
		{
			if(!@mysql_connect($dbhost, $dbuser, $dbpw))
			{
				$this->halt('Can not connect to MySQL server');
			}
		}

		if($this->version() > '4.1')
		{
			global $charset, $dbcharset;
			if(!$dbcharset && in_array(strtolower($charset), array('gbk', 'utf-8')))
			{
				$dbcharset = str_replace('-', '', $charset);
			}

			if($dbcharset)
			{
				mysql_query("SET character_set_connection=$dbcharset, character_set_results=$dbcharset, character_set_client=binary");
			}

			if($this->version() > '5.0.1')
			{
				mysql_query("SET sql_mode=''");
			}
		}

		if($dbname)
		{
			mysql_select_db($dbname);
		}

	}

	function select_db($dbname)
	{
		return mysql_select_db($dbname);
	}

	function query($sql, $type = '')
	{
		global $debug, $cyask_starttime, $sqldebug;

		$func = $type == 'UNBUFFERED' && @function_exists('mysql_unbuffered_query') ? 'mysql_unbuffered_query' : 'mysql_query';
		if(!($query = $func($sql)) && $type != 'SILENT')
		{
			$this->halt('MySQL Query Error', $sql);
		}
		$this->querynum++;
		return $query;
	}

	function fetch_array($query)
	{
		return mysql_fetch_assoc($query);
	}
	
	function affected_rows()
	{
		return mysql_affected_rows();
	}

	function error()
	{
		return mysql_error();
	}

	function errno()
	{
		return intval(mysql_errno());
	}

	function result($query, $row)
	{
		$query = @mysql_result($query, $row);
		return $query;
	}

	function num_rows($query)
	{
		$query = mysql_num_rows($query);
		return $query;
	}

	function num_fields($query)
	{
		return mysql_num_fields($query);
	}

	function free_result($query)
	{
		mysql_free_result($query);
	}

	function insert_id()
	{
		$id = mysql_insert_id();
		return $id;
	}

	function fetch_row($query)
	{
		$query = mysql_fetch_row($query);
		return $query;
	}

	function fetch_fields($query)
	{
		return mysql_fetch_field($query);
	}

	function version()
	{
		return mysql_get_server_info();
	}

	function close()
	{
		return mysql_close();
	}
	
	function halt($message = '', $sql = '')
	{
		require_once CYASK_ROOT.'/include/db_mysql_error.php';
	}
}

?>
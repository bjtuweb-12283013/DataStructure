<?php
class DB_MySQL {

	function error() {
		return mysql_error();
	}

	function geterrno() {
		return mysql_errno();
	}

	function insert_id() {
		$id = mysql_insert_id();
		return $id;
	}

	function connect($servername, $dbusername, $dbpassword, $dbname, $charset='utf8') {
		if(!@mysql_connect($servername, $dbusername, $dbpassword))
			die("Could not Connect @ ".$this->geterrno());

		mysql_select_db($dbname);
		
		if($charset != '')
			mysql_query("SET NAMES '".$charset."'");
	}

	function select_db($dbname) {
		return mysql_select_db($dbname);
	}

	function query($sql,$type = '') {
		$query = mysql_query($sql);
		if(!$query && $type != 'SILENT') {
			die('MySQL Query Error : '.$sql);
		}
		return $query;
	}

	function affected_rows($sql)
	{
		$this->query($sql);

		return mysql_affected_rows();
	}

	function fetch_array($query) {
		return mysql_fetch_array($query);
	}

	function fetch_row($query) {
		$query = mysql_fetch_row($query);
		return $query;
	}

	function fetch_one_array($query) {
		$result = $this->query($query);
		$record = $this->fetch_array($result);
		return $record;
	}

	function fetch_one($query) {
		$record = $this->fetch_one_array($query);
		Return $record[0];
	}

	function num_rows($query) {
		$query = mysql_num_rows($query);
		return $query;
	}

	function free_result($query) {
		$query = mysql_free_result($query);
		return $query;
	}

	function close() {
		return mysql_close();
	}

	function version() {
		return mysql_get_server_info();
	}
	
	function fetch_all($sql) {
		$arr = array();
		$query = $this->query($sql);
		while($data = $this->fetch_array($query)) {
			$arr[] = $data;
		}
		return $arr;
	}

	function compile_db_insert_string($data)
	{
		$field_names = "";
		$field_values = "";

		foreach ($data as $k => $v)
		{
			$field_names .= "$k,";
			$field_values .= "'$v',";
		}

		$field_names = preg_replace( "/,$/" , "" , $field_names );
		$field_values = preg_replace( "/,$/" , "" , $field_values );

		return array('FIELD_NAMES' => $field_names,
					 'FIELD_VALUES' => $field_values,
					 );
	}

	function compile_db_update_string($data)
	{
		$return_string = "";

		foreach ($data as $k => $v)
		{
			if(is_array($v))
			{
				$return_string .= $k . "=".$v['0'].",";
			}else
			{
				$return_string .= $k . "='".$v."',";
			}
		}

		$return_string = preg_replace( "/,$/" , "" , $return_string );

		return $return_string;
	}

	function insert_sql( $tbl , $arr )
	{
		$dba	=	$this->compile_db_insert_string( $arr );

		$sql	=	"INSERT INTO {$tbl} ({$dba['FIELD_NAMES']}) VALUES ({$dba['FIELD_VALUES']})";
		
		return $sql;
	}

	function update_sql($tbl , $arr , $where='')
	{
		$dba	=	$this->compile_db_update_string( $arr );

    	$query = "UPDATE {$tbl} SET $dba";
    	
    	if ( $where )
    	{
    		$query .= " WHERE ".$where;
    	}

		return $query;
	}
}
?>
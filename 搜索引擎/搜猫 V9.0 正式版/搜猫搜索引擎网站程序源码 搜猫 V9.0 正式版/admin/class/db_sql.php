<?php

class mysqlquery
{
var $sql;
var $query;
var $num;
var $r;
var $id;
function query($query)
{
$this->sql=mysql_query($query) or die(mysql_error().'<br>'.$query);
return $this->sql;
}
function query1($query)
{
$this->sql=mysql_query($query);
return $this->sql;
}
function fetch($sql)
{
$this->r=mysql_fetch_array($sql);
return $this->r;
}
function fetch1($query)
{
$this->sql=$this->query($query);
$this->r=mysql_fetch_array($this->sql);
return $this->r;
}
function num($query)
{
$this->sql=$this->query($query);
$this->num=mysql_num_rows($this->sql);
return $this->num;
}
function num1($sql)
{
$this->num=mysql_num_rows($sql);
return $this->num;
}
function gettotal($query)
{
$this->r=$this->fetch1($query);
return $this->r['total'];
}
function free($sql)
{
mysql_free_result($sql);
}
function seek($sql,$pit)
{
mysql_data_seek($sql,$pit);
}
function lastid()
{
$this->id=mysql_insert_id();
return $this->id;
}
}
?>
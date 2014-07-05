<?php

require 'global.php';
;echo '';
require('class/connect.php');
require('class/db_sql.php');
require('class/functions.php');
$rnd=$lur['rnd'];
$hand=@opendir($bakpath);
$form='ebakredata';
if($_GET['toform'])
{
$form=$_GET['toform'];
}
require LoadAdminTemp('eChangePath.php');
?>
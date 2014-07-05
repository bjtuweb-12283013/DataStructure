<?php

require('class/connect.php');
require('class/db_sql.php');
require('class/functions.php');
$rnd=$lur['rnd'];
$hand=@opendir('setsave');
$mydbname=$_GET['mydbname'];
require LoadAdminTemp('eListSetbak.php');
?>
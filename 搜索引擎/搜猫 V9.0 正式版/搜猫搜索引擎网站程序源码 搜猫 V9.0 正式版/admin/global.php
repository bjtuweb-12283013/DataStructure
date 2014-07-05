<?php

if($_COOKIE['adminname']=='')
{
header('location:login.php');
}
require ('../global.php');
require ('global_function.php');
$adminname=$_SESSION['adminname'];
if(!empty($adminname))
{
$admin=$db->get_one("select * from ve123_admin where adminname='".$adminname."'");
}
?>
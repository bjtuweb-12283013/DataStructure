<?php
if($_COOKIE["adminname"]=="")
{
    header("location:login.php");
}
require ("../global.php");
require ("global_function.php");
$admin=$db->get_one("select * from ve123_admin where admin_id='1'");
if($_COOKIE["adminname"]<>$admin["adminname"]){header("location:login.php");die();}
$comurl=$_SERVER['HTTP_REFERER'];
?>
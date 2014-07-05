<?php
if($_COOKIE["adminname"]=="")
{
    header("location:lg.php");
}
require "../../../global_hou.php";
require "../../../include/spider/spider_class.php";
require "../../../include/spider/Snoopy.class.php";
require_once("global_func.php");
?>
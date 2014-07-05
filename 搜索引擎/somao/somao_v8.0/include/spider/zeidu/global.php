<?php
if($_COOKIE["adminname"]=="")
{
    header("location:lg.php");
}
require "../../../global.php";
require "../../../include/spider/spider_class.php";
require_once("global_func.php");
?>
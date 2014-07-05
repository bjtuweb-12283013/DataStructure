<?php
require "../global.php";
$http_referer=$_SERVER['HTTP_REFERER'];
      $query_string=$_SERVER['QUERY_STRING'];
      $exp=explode("_",$query_string);
      $link_id=intval($exp[0]);
      $wd=$exp[1];
$url_info=parse_url($http_referer);
$url_host=$url_info["host"];
if(substr($url_host,0,4)=="www.")
{
     $url_host=substr($url_host,4,strlen($url_host));
}
//echo $url_host;die();
 $row=$db->get_one("select * from ve123_links where link_id='".$link_id."'");
     header("location:".$row["url"]."");
/*if(stristr($config["url"],$url_host))
//if   (strpos($config["url"],$url_host)   ===   false) 
{
   $row=$db->get_one("select * from ve123_links where link_id='".$link_id."'");
     header("location:".$row["url"]."");
}
else
{
    header("location:".$config["url"]."/s/?wd=".$wd);   
}*/
?>
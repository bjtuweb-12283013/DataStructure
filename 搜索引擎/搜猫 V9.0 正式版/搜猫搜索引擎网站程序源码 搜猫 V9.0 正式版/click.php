<?php
require ("../global.php");
$query_string=base64_decode($_SERVER['QUERY_STRING']);
parse_str($query_string);
$ip=ip();
$c=$db->get_one("select * from ve123_stat_click where c_ip='".$ip."' and c_time>='".(time()-(60*60*24))."'");
if(empty($c))
{
     $link=$db->get_one("select * from ve123_zz_links where link_id='".$link_id."'");
     $db->query("update ve123_zz_user set points=points-".$link["price"]." where user_id='".$link["user_id"]."'");
	 $db->query("update ve123_zz_links set stat_click=stat_click+1,consumption=consumption+".$link["price"]." where link_id='".$link_id."'");
	 $array=array('c_time'=>time(),'c_ip'=>$ip);
	 $db->insert("ve123_stat_click",$array);
}

header("location:".$url);
?>
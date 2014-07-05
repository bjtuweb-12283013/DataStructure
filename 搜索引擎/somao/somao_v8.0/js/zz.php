<?php
require_once("../global.php");
$user_id=intval($_GET["user_id"]);
if(!empty($user_id))
{
    $ip=ip();
	// $referer=$_SERVER['HTTP_REFERER'];
    $v=$db->get_one("select * from ve123_stat_visitor where v_ip='".$ip."' and v_time>='".(time()-(86400*1))."'");
	if(empty($v))
	{
        $user=$db->get_one("select * from ve123_zz_user where user_id='".$user_id."'");
	    //if($user["xc_ip"]<945)
	    //{
		   $array=array('v_time'=>time(),'v_ip'=>$ip);
		   $db->insert("ve123_stat_visitor",$array);
		   $db->query("update ve123_zz_user set points=points+1 where user_id='".$user_id."'");
	    // }
	}
}
?>
<?php

require_once('alipay.config.php');
require_once('lib/alipay_notify.class.php');
$alipayNotify = new AlipayNotify($aliapy_config);
$verify_result = $alipayNotify->verifyNotify();
if($verify_result) {
$out_trade_no	= $_POST['out_trade_no'];
$trade_no		= $_POST['trade_no'];
$total_fee		= $_POST['total_fee'];
if($_POST['trade_status'] == 'TRADE_FINISHED'||$_POST['trade_status'] == 'TRADE_SUCCESS') {
echo 'success';
}
else {
echo 'success';
}
$row3 = $db->get_one("select * from ve123_orders where oid='$out_trade_no'");
if($row3['state']==0){
$utime=time();
$array=array('state'=>1,'utime'=>$utime);
$db->update('ve123_orders',$array,"oid='$out_trade_no' and uid='$uid'");
$total_fee2=$total_fee*10;
$point=$total_fee2+$points;
$array2=array('points'=>$point);
$db->update('ve123_zz_user',$array2,"user_name='$uname'");
echo "<script> alert('³äÖµ³É¹¦')</script>";
echo "<script> alert('".'ÄúµÄ¶©µ¥ºÅÊÇ£º'.$trade_no.'ÒÑ¾­Íê³ÉÖ§¸¶ÊÖĞø£¬Äúµ±Ç°ÕËºÅÓà¿îÎª'.$point."')</script>";
}else{
echo "<script> alert('³äÖµ³É¹¦,Çë²»ÒªÖØ¸´²Ù×÷')</script>";
}
}
else {
echo 'fail';
echo "<script> alert('³äÖµÊ§°Ü,Çë¼ì²éÄãµÄÖ§¸¶±¦ÕËºÅÊÇ·ñÊäÈëÕıÈ·»òÕßÇëÁªÏµ¹ÜÀíÔ±Ö±½Ó³äÖµ')</script>";
}
;echo '<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<title>Ö§¸¶±¦¼´Ê±µ½ÕÊ½Ó¿Ú</title>
<script type="text/javascript">
function gourl()
{
	location.href=\'/tg/\'
}
</script>
</head>
<body onload="gourl()">
</body>
</html>';
?>
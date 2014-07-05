<?php

require_once('alipay.config.php');
require_once('lib/alipay_notify.class.php');
$alipayNotify = new AlipayNotify($aliapy_config);
$verify_result = $alipayNotify->verifyReturn();
if($verify_result) {
$out_trade_no	= $_GET['out_trade_no'];
$trade_no		= $_GET['trade_no'];
$total_fee		= $_GET['total_fee'];
if($_GET['trade_status'] == 'TRADE_FINISHED'||$_GET['trade_status'] == 'TRADE_SUCCESS') {
}
else {
echo 'trade_status='.$_GET['trade_status'];
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
echo "<script> alert('充值成功')</script>";
echo "<script> alert('".'您的订单号是：'.$trade_no.'已经完成支付手续，您当前账号余款为'.$point."')</script>";
}else{
echo "<script> alert('充值成功,请不要重复操作')</script>";
}
}
else {
echo "<script> alert('充值失败,请检查你的支付宝账号是否输入正确或者请联系管理员直接充值')</script>";
}
;echo '<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<title>支付宝即时到帐接口</title>
<script type="text/javascript">
function gourl()
{
	location.href=\'/tg/\'
}
</script>
</head>
<body onload="gourl()">
</body>
</html>';
?>
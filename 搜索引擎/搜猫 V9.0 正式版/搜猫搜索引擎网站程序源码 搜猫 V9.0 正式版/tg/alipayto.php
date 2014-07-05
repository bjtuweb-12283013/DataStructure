<?php

require_once('alipay.config.php');
require_once('lib/alipay_service.class.php');
$out_trade_no = date('Ymdhis');
$subject      = $_POST['subject'];
$body         = $_POST['body'];
$total_fee    = $_POST['total_fee'];
$subject      = '你正在本站通过在线充值进行'.$_POST['total_fee'].'的充值消费！';
$paymethod    = '';
$defaultbank  = '';
$time=time();
$price=$total_fee;
$array3=array('state'=>0,'oid'=>$out_trade_no,'uid'=>$uid,'price'=>$price,'time'=>$time,'utime'=>0);
$db->insert('ve123_orders',$array3);
$anti_phishing_key  = '10';
$exter_invoke_ip = '';
$show_url			= 'http://www.xxx.com/order/myorder.php';
$extra_common_param = '';
$royalty_type		= '';
$royalty_parameters	= '';
$parameter = array(
'service'=>'create_direct_pay_by_user',
'payment_type'=>'1',
'partner'=>trim($aliapy_config['partner']),
'_input_charset'=>trim(strtolower($aliapy_config['input_charset'])),
'seller_email'=>trim($aliapy_config['seller_email']),
'return_url'=>trim($aliapy_config['return_url']),
'notify_url'=>trim($aliapy_config['notify_url']),
'out_trade_no'=>$out_trade_no,
'subject'=>$subject,
'body'=>$body,
'total_fee'=>$total_fee,
'paymethod'=>$paymethod,
'defaultbank'=>$defaultbank,
'anti_phishing_key'=>$anti_phishing_key,
'exter_invoke_ip'=>$exter_invoke_ip,
'show_url'=>$show_url,
'extra_common_param'=>$extra_common_param,
'royalty_type'=>$royalty_type,
'royalty_parameters'=>$royalty_parameters
);
$alipayService = new AlipayService($aliapy_config);
$html_text = $alipayService->create_direct_pay_by_user($parameter);
echo $html_text;

?>
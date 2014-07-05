<?php

require_once('global.php');
is_login();
$uname=$user['user_name'];
$row3 = $db->get_one("select * from ve123_zz_user where user_name='$uname'");
$uid = $row3['user_id'];
$points  = $row3['points'];
$rs=$db->get_one('select * from ve123_aipay');
$rs2=$db->get_one('select url from ve123_siteconfig');
$aliapy_config['partner']      = $rs['alipay_partner'];
$aliapy_config['key']          = $rs['alipay_key'];
$aliapy_config['seller_email'] = $rs['alipay_account'];
$aliapy_config['return_url']   = $rs2['url'].'/tg/return_url.php';
$aliapy_config['notify_url']   = $rs2['url'].'/tg/notify_url.php';
$aliapy_config['sign_type']    = 'MD5';
$aliapy_config['input_charset']= 'gbk';
$aliapy_config['transport']    = 'http';

?>
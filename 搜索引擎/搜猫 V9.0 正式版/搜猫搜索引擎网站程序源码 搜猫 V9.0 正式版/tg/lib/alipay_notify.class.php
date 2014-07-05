<?php

require_once('alipay_core.function.php');
class AlipayNotify {
var $https_verify_url = 'https://www.alipay.com/cooperate/gateway.do?service=notify_verify&';
var $http_verify_url = 'http://notify.alipay.com/trade/notify_query.do?';
var $aliapy_config;
function __construct($aliapy_config){
$this->aliapy_config = $aliapy_config;
}
function AlipayNotify($aliapy_config) {
$this->__construct($aliapy_config);
}
function verifyNotify(){
if(empty($_POST)) {
return false;
}
else {
$mysign = $this->getMysign($_POST);
$responseTxt = 'true';
if (!empty($_POST['notify_id'])) {$responseTxt = $this->getResponse($_POST['notify_id']);}
if (preg_match("/true$/i",$responseTxt) &&$mysign == $_POST['sign']) {
return true;
}else {
return false;
}
}
}
function verifyReturn(){
if(empty($_GET)) {
return false;
}
else {
$mysign = $this->getMysign($_GET);
$responseTxt = 'true';
if (!empty($_GET['notify_id'])) {$responseTxt = $this->getResponse($_GET['notify_id']);}
if (preg_match("/true$/i",$responseTxt) &&$mysign == $_GET['sign']) {
return true;
}else {
return false;
}
}
}
function getMysign($para_temp) {
$para_filter = paraFilter($para_temp);
$para_sort = argSort($para_filter);
$mysign = buildMysign($para_sort,trim($this->aliapy_config['key']),strtoupper(trim($this->aliapy_config['sign_type'])));
return $mysign;
}
function getResponse($notify_id) {
$transport = strtolower(trim($this->aliapy_config['transport']));
$partner = trim($this->aliapy_config['partner']);
$veryfy_url = '';
if($transport == 'https') {
$veryfy_url = $this->https_verify_url;
}
else {
$veryfy_url = $this->http_verify_url;
}
$veryfy_url = $veryfy_url.'partner='.$partner .'&notify_id='.$notify_id;
$responseTxt = getHttpResponse($veryfy_url);
return $responseTxt;
}
}

?>
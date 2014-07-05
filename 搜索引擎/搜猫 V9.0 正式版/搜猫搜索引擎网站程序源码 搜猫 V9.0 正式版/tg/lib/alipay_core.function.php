<?php

function buildMysign($sort_para,$key,$sign_type = 'MD5') {
$prestr = createLinkstring($sort_para);
$prestr = $prestr.$key;
$mysgin = sign($prestr,$sign_type);
return $mysgin;
}
function createLinkstring($para) {
$arg  = '';
while (list ($key,$val) = each ($para)) {
$arg.=$key.'='.$val.'&';
}
$arg = substr($arg,0,count($arg)-2);
if(get_magic_quotes_gpc()){$arg = stripslashes($arg);}
return $arg;
}
function paraFilter($para) {
$para_filter = array();
while (list ($key,$val) = each ($para)) {
if($key == 'sign'||$key == 'sign_type'||$val == '')continue;
else	$para_filter[$key] = $para[$key];
}
return $para_filter;
}
function argSort($para) {
ksort($para);
reset($para);
return $para;
}
function sign($prestr,$sign_type='MD5') {
$sign='';
if($sign_type == 'MD5') {
$sign = md5($prestr);
}elseif($sign_type =='DSA') {
die('DSA 签名方法待后续开发，请先使用MD5签名方式');
}else {
die('支付宝暂不支持'.$sign_type.'类型的签名方式');
}
return $sign;
}
function logResult($word='') {
$fp = fopen('log.txt','a');
flock($fp,LOCK_EX) ;
fwrite($fp,'执行日期：'.strftime('%Y%m%d%H%M%S',time())."\n".$word."\n");
flock($fp,LOCK_UN);
fclose($fp);
}
function getHttpResponse($url,$input_charset = '',$time_out = '60') {
$urlarr     = parse_url($url);
$errno      = '';
$errstr     = '';
$transports = '';
$responseText = '';
if($urlarr['scheme'] == 'https') {
$transports = 'ssl://';
$urlarr['port'] = '443';
}else {
$transports = 'tcp://';
$urlarr['port'] = '80';
}
$fp=@fsockopen($transports .$urlarr['host'],$urlarr['port'],$errno,$errstr,$time_out);
if(!$fp) {
die("ERROR: $errno - $errstr<br />\n");
}else {
if (trim($input_charset) == '') {
fputs($fp,'POST '.$urlarr['path']." HTTP/1.1\r\n");
}
else {
fputs($fp,'POST '.$urlarr['path'].'?_input_charset='.$input_charset." HTTP/1.1\r\n");
}
fputs($fp,'Host: '.$urlarr['host']."\r\n");
fputs($fp,"Content-type: application/x-www-form-urlencoded\r\n");
fputs($fp,'Content-length: '.strlen($urlarr['query'])."\r\n");
fputs($fp,"Connection: close\r\n\r\n");
fputs($fp,$urlarr['query'] ."\r\n\r\n");
while(!feof($fp)) {
$responseText .= @fgets($fp,1024);
}
fclose($fp);
$responseText = trim(stristr($responseText,"\r\n\r\n"),"\r\n");
return $responseText;
}
}
function charsetEncode($input,$_output_charset ,$_input_charset) {
$output = '';
if(!isset($_output_charset) )$_output_charset  = $_input_charset;
if($_input_charset == $_output_charset ||$input ==null ) {
$output = $input;
}elseif (function_exists('mb_convert_encoding')) {
$output = mb_convert_encoding($input,$_output_charset,$_input_charset);
}elseif(function_exists('iconv')) {
$output = iconv($_input_charset,$_output_charset,$input);
}else die('sorry, you have no libs support for charset change.');
return $output;
}
function charsetDecode($input,$_input_charset ,$_output_charset) {
$output = '';
if(!isset($_input_charset) )$_input_charset  = $_input_charset ;
if($_input_charset == $_output_charset ||$input ==null ) {
$output = $input;
}elseif (function_exists('mb_convert_encoding')) {
$output = mb_convert_encoding($input,$_output_charset,$_input_charset);
}elseif(function_exists('iconv')) {
$output = iconv($_input_charset,$_output_charset,$input);
}else die('sorry, you have no libs support for charset changes.');
return $output;
}

?>
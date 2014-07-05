<?php

require_once('alipay_core.function.php');
class AlipaySubmit {
function buildRequestPara($para_temp,$aliapy_config) {
$para_filter = paraFilter($para_temp);
$para_sort = argSort($para_filter);
$mysign = buildMysign($para_sort,trim($aliapy_config['key']),strtoupper(trim($aliapy_config['sign_type'])));
$para_sort['sign'] = $mysign;
$para_sort['sign_type'] = strtoupper(trim($aliapy_config['sign_type']));
return $para_sort;
}
function buildRequestParaToString($para_temp,$aliapy_config) {
$para = $this->buildRequestPara($para_temp,$aliapy_config);
$request_data = createLinkstring($para);
return $request_data;
}
function buildForm($para_temp,$gateway,$method,$button_name,$aliapy_config) {
$para = $this->buildRequestPara($para_temp,$aliapy_config);
$sHtml = "<form id='alipaysubmit' name='alipaysubmit' action='".$gateway.'_input_charset='.trim(strtolower($aliapy_config['input_charset']))."' method='".$method."'>";
while (list ($key,$val) = each ($para)) {
$sHtml.= "<input type='hidden' name='".$key."' value='".$val."'/>";
}
$sHtml = $sHtml."<input type='submit' value='".$button_name."'></form>";
$sHtml = $sHtml."<script>document.forms['alipaysubmit'].submit();</script>";
return $sHtml;
}
function sendPostInfo($para_temp,$gateway,$aliapy_config) {
$xml_str = '';
$request_data = $this->buildRequestParaToString($para_temp,$aliapy_config);
$url = $gateway .$request_data;
$xml_data = getHttpResponse($url,trim(strtolower($aliapy_config['input_charset'])));
$doc = new DOMDocument();
$doc->loadXML($xml_data);
return $doc;
}
}

?>
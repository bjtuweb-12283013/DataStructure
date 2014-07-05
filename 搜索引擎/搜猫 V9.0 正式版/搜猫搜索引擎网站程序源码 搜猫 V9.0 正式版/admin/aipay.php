<?php

require 'global.php';
headhtml();
$action=$_GET['action'];
switch ($action)
{
case 'saveconfig':
saveconfig();
break;
}
$rs=$db->get_one('select * from ve123_aipay');
;echo '<form id="configform" name="configform" method="post" action="?action=saveconfig">
<table width="100%" border="0" cellpadding="3" cellspacing="1" class="tablebg">
  <tr>
    <th colspan="2">支付宝接口设置</th>
  </tr>
  <tr>
    <td width="120">支付宝用户账号:</td>
    <td><input type="text" name="alipay_account" value="';echo $rs['alipay_account'];echo '" size="50"/> 电子邮箱</td>
  </tr>
  <tr>
    <td>交易安全校验码:</td>
    <td><input type="text" name="alipay_key" value="';echo $rs['alipay_key'];;echo '" size="50"/></td>
  </tr>
  <tr>
    <td>合作者身份ID:</td>
    <td><input type="text" name="alipay_partner" value="';echo $rs['alipay_partner'];;echo '" size="80"/></td>
  </tr>
    <tr>
    <td>&nbsp;</td>
    <td><input type="submit" name="Submit" value="提交" /></td>
  </tr>
</table>
</form>

';
function saveconfig()
{
global $db;
$alipay_account=$_POST['alipay_account'];
$alipay_key=$_POST['alipay_key'];
$alipay_partner=$_POST['alipay_partner'];
$array=array('alipay_account'=>$alipay_account,'alipay_key'=>$alipay_key,'alipay_partner'=>$alipay_partner);
$db->update('ve123_aipay',$array,"id='1'");
jsalert ('修改成功!');
}
;echo '
';
?>
<?php
include "F:/host/yushijie/web/tieba/class/phpSayTemplateExtensions/datetime.php";

?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"><html xmlns="http://www.w3.org/1999/xhtml"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8" /><meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" /><title>站点设置_<?php
echo $_obj['siteName'];
?>
</title><link href="./_static/style.css" rel="stylesheet" type="text/css" /></head><body>﻿<div id="header"><div id="logo"><a href="./"><img src="../images/slogo.gif" alt="<?php
echo $_obj['siteName'];
?>
" title="<?php
echo $_obj['siteName'];
?>
" border="0" /></a></div><div id="info"><a href="http://shiwww.com" target="_blank">菏泽微博</a>&nbsp;&nbsp;<a href="./" target="_top">管理中心首页</a>&nbsp;&nbsp;<a href="./?do=logout" target="_top">退出管理中心</a></div></div><div id="main"><div id="guid"><a href="../" target="_blank"><?php
echo $_obj['siteName'];
?>
</a> &gt; <a href="./">管理中心</a> &gt; <b>站点设置</b></div><div id="B"><div id="L"><div class="nameleft">系统管理</div><div class="nameleftcont"><ul><li><a href="./set_site.php">基本设置</a><ul><li><a href="./set_site.php">站点设置</a></li><li><a href="./set_mail.php">邮件设置</a></li><li><a href="./set_secure.php">Cookie设置</a></li><li><a href="./set_links.php">友情链接</a></li></ul></li><li><a href="./user_list.php">会员管理</a><ul><li><a href="./user_group.php">用 户 组</a></li><li><a href="./user_list.php">全部会员</a></li><li><a href="./user_black.php">黑 名 单</a></li></ul></li><li><a href="./category.php">分类目录</a><ul><li><a href="./category.php">分类管理</a></li><li><a href="./forum_category.php">吧分类审核</a></li></ul></li><li><a href="./forum_list.php">贴吧管理</a><ul><li><a href="./forum_list.php">全部贴吧</a></li><li><a href="./forum_temp.php">新吧审核</a></li><li><a href="./bm_apply.php">吧主审核</a></li><li><a href="./bm_apply.php?list=resign">辞职申请</a></li><li><a href="./set_filter.php">字词屏蔽</a></li></ul></li><li><a href="./topic_list.php">帖子管理</a><ul><li><a href="./topic_list.php">主题管理</a></li><li><a href="./post_list.php">全帖管理</a></li><li><a href="./report_list.php">举报管理</a></li></ul></li><li><a href="./db_manage.php">数据管理</a><ul><li><a href="./db_export.php">数据备份</a></li><li><a href="./db_import.php">数据还原</a></li></ul></li></ul></div></div> <div id="R"><div class="nameset">站点设置</div><div class="namecont"><form name="setForm" id="setForm" method="post" target="sypost" action="./set_site.php?action=update"><input type="hidden" name="code_name" value="<?php
echo $_obj['codeName'];
?>
"><input type="hidden" name="code_version" value="<?php
echo $_obj['codeVersion'];
?>
"><table width="90%" align="center" cellpadding="4" cellspacing="4" style="padding:20px 10px;"><tr><td height="30" colspan="2"></td></tr><tr><td align="right" width="20%">站点名称：</td><td><input type="text" name="site_name" class="inp" value="<?php
echo $_obj['siteName'];
?>
" maxlength="12" /></td></tr><tr><td align="right">站点域名：</td><td><input type="text" name="site_domain" class="inp" value="<?php
echo $_obj['siteDomain'];
?>
" /><span style="margin-left:10px;color:#666;font-family:verdana;">不要添加 http:// ，不要以 / 结尾</span></td></tr><tr><td align="right">安装目录：</td><td><input type="text" name="site_catalog" class="inp" value="<?php
echo $_obj['siteCatalog'];
?>
" /><span style="margin-left:10px;color:#666;font-family:verdana;">根目录：<font color="red">/</font>，非根目录类似：<font color="red">/bar/</font></span></td></tr><tr><td align="right">开启伪静态：</td><td><input type="radio" name="site_rewrite" value="1"<?php
if ($_obj['siteRewrite'] == "1"){
?> checked<?php
}
?> />开启<input type="radio" name="site_rewrite" value="0"<?php
if ($_obj['siteRewrite'] == "0"){
?> checked<?php
}
?> />关闭</td></tr><tr><td align="right">备案信息：</td><td><input type="text" name="site_icp" class="inp" value="<?php
echo $_obj['siteIcp'];
?>
" maxlength="15" /><span style="margin-left:10px;color:#666;font-family:verdana;">备案：<a href="http://www.miibeian.gov.cn" target="_blank">www.miibeian.gov.cn</a></span></td></tr><tr><td align="right">服务器时区：</td><td><select name="site_timezone" /><?php
if (!empty($_obj['timeZone'])){
if (!is_array($_obj['timeZone']))
$_obj['timeZone']=array(array('timeZone'=>$_obj['timeZone']));
$_tmp_arr_keys=array_keys($_obj['timeZone']);
if ($_tmp_arr_keys[0]!='0')
$_obj['timeZone']=array(0=>$_obj['timeZone']);
$_stack[$_stack_cnt++]=$_obj;
foreach ($_obj['timeZone'] as $rowcnt=>$v) {
if (is_array($v)) $timeZone=$v; else $timeZone=array();
$timeZone['ROWVAL']=$v;
$timeZone['ROWCNT']=$rowcnt;
$timeZone['ROWBIT']=$rowcnt%2;
$_obj=&$timeZone;
?><option value="<?php
echo $_obj['ROWVAL'];
?>
"<?php
if ($_obj['ROWVAL'] == $_stack[$_stack_cnt-1]['siteTimezone']){
?> selected<?php
}
?>><?php
echo $_obj['ROWVAL'];
?>
</option><?php
}
$_obj=$_stack[--$_stack_cnt];}
?></select><span style="margin-left:10px;color:#666;font-family:verdana;">服务器时间：<?php
echo phpsay_datetime();
?>
</span></td></tr><tr><td align="right">用户创建吧：</td><td><input type="radio" name="create_allow" value="1"<?php
if ($_obj['createAllow'] == "1"){
?> checked<?php
}
?> />允许<input type="radio" name="create_allow" value="0"<?php
if ($_obj['createAllow'] == "0"){
?> checked<?php
}
?> />禁止</td></tr><tr><td align="right">首页缓存时间：</td><td><select name="cache_lifetime" /><option value="1"<?php
if ($_obj['cacheLifetime'] == "60"){
?> selected<?php
}
?>>一分钟</option><option value="2"<?php
if ($_obj['cacheLifetime'] == "120"){
?> selected<?php
}
?>>两分钟</option><option value="5"<?php
if ($_obj['cacheLifetime'] == "300"){
?> selected<?php
}
?>>五分钟</option><option value="10"<?php
if ($_obj['cacheLifetime'] == "600"){
?> selected<?php
}
?>>十分钟</option><option value="30"<?php
if ($_obj['cacheLifetime'] == "1800"){
?> selected<?php
}
?>>半小时</option><option value="60"<?php
if ($_obj['cacheLifetime'] == "3600"){
?> selected<?php
}
?>>一小时</option><option value="180"<?php
if ($_obj['cacheLifetime'] == "10800"){
?> selected<?php
}
?>>三小时</option><option value="360"<?php
if ($_obj['cacheLifetime'] == "21600"){
?> selected<?php
}
?>>六小时</option><option value="720"<?php
if ($_obj['cacheLifetime'] == "43200"){
?> selected<?php
}
?>>十二小时</option><option value="1440"<?php
if ($_obj['cacheLifetime'] == "86400"){
?> selected<?php
}
?>>一天</option></select></td></tr><tr><td align="right">每页帖子数：</td><td><select name="per_topic_num" /><option value="10"<?php
if ($_obj['perTopic'] == "10"){
?> selected<?php
}
?>>10</option><option value="20"<?php
if ($_obj['perTopic'] == "20"){
?> selected<?php
}
?>>20</option><option value="30"<?php
if ($_obj['perTopic'] == "30"){
?> selected<?php
}
?>>30</option><option value="40"<?php
if ($_obj['perTopic'] == "40"){
?> selected<?php
}
?>>40</option><option value="50"<?php
if ($_obj['perTopic'] == "50"){
?> selected<?php
}
?>>50</option><option value="60"<?php
if ($_obj['perTopic'] == "60"){
?> selected<?php
}
?>>60</option><option value="70"<?php
if ($_obj['perTopic'] == "70"){
?> selected<?php
}
?>>70</option><option value="80"<?php
if ($_obj['perTopic'] == "80"){
?> selected<?php
}
?>>80</option><option value="90"<?php
if ($_obj['perTopic'] == "90"){
?> selected<?php
}
?>>90</option></select><span style="margin-left:10px;color:#666;">帖子列表页</span></td></tr><tr><td align="right">每页回复数：</td><td><select name="per_post_num" /><option value="10"<?php
if ($_obj['perPost'] == "10"){
?> selected<?php
}
?>>10</option><option value="20"<?php
if ($_obj['perPost'] == "20"){
?> selected<?php
}
?>>20</option><option value="30"<?php
if ($_obj['perPost'] == "30"){
?> selected<?php
}
?>>30</option><option value="40"<?php
if ($_obj['perPost'] == "40"){
?> selected<?php
}
?>>40</option><option value="50"<?php
if ($_obj['perPost'] == "50"){
?> selected<?php
}
?>>50</option><option value="60"<?php
if ($_obj['perPost'] == "60"){
?> selected<?php
}
?>>60</option><option value="70"<?php
if ($_obj['perPost'] == "70"){
?> selected<?php
}
?>>70</option><option value="80"<?php
if ($_obj['perPost'] == "80"){
?> selected<?php
}
?>>80</option><option value="90"<?php
if ($_obj['perPost'] == "90"){
?> selected<?php
}
?>>90</option></select><span style="margin-left:10px;color:#666;">帖子内容页</span></td></tr><tr><td align="right">登录用户匿名发帖：</td><td><input type="radio" name="post_anonymous" value="1"<?php
if ($_obj['postAnonymous'] == "1"){
?> checked<?php
}
?> />允许<input type="radio" name="post_anonymous" value="0"<?php
if ($_obj['postAnonymous'] == "0"){
?> checked<?php
}
?> />禁止</td></tr><tr><td align="right">发表主题增加积分：</td><td><select name="integral_topic" /><option value="0"<?php
if ($_obj['integralTopic'] == "0"){
?> selected<?php
}
?>>0</option><option value="1"<?php
if ($_obj['integralTopic'] == "1"){
?> selected<?php
}
?>>1</option><option value="2"<?php
if ($_obj['integralTopic'] == "2"){
?> selected<?php
}
?>>2</option><option value="3"<?php
if ($_obj['integralTopic'] == "3"){
?> selected<?php
}
?>>3</option><option value="4"<?php
if ($_obj['integralTopic'] == "4"){
?> selected<?php
}
?>>4</option><option value="5"<?php
if ($_obj['integralTopic'] == "5"){
?> selected<?php
}
?>>5</option><option value="6"<?php
if ($_obj['integralTopic'] == "6"){
?> selected<?php
}
?>>6</option><option value="7"<?php
if ($_obj['integralTopic'] == "7"){
?> selected<?php
}
?>>7</option><option value="8"<?php
if ($_obj['integralTopic'] == "8"){
?> selected<?php
}
?>>8</option><option value="9"<?php
if ($_obj['integralTopic'] == "9"){
?> selected<?php
}
?>>9</option><option value="10"<?php
if ($_obj['integralTopic'] == "10"){
?> selected<?php
}
?>>10</option></select><span style="margin-left:10px;color:#666;">删除减去相同的积分</span></td></tr><tr><td align="right">发表回复增加积分：</td><td><select name="integral_reply" /><option value="0"<?php
if ($_obj['integralReply'] == "0"){
?> selected<?php
}
?>>0</option><option value="1"<?php
if ($_obj['integralReply'] == "1"){
?> selected<?php
}
?>>1</option><option value="2"<?php
if ($_obj['integralReply'] == "2"){
?> selected<?php
}
?>>2</option><option value="3"<?php
if ($_obj['integralReply'] == "3"){
?> selected<?php
}
?>>3</option><option value="4"<?php
if ($_obj['integralReply'] == "4"){
?> selected<?php
}
?>>4</option><option value="5"<?php
if ($_obj['integralReply'] == "5"){
?> selected<?php
}
?>>5</option><option value="6"<?php
if ($_obj['integralReply'] == "6"){
?> selected<?php
}
?>>6</option><option value="7"<?php
if ($_obj['integralReply'] == "7"){
?> selected<?php
}
?>>7</option><option value="8"<?php
if ($_obj['integralReply'] == "8"){
?> selected<?php
}
?>>8</option><option value="9"<?php
if ($_obj['integralReply'] == "9"){
?> selected<?php
}
?>>9</option><option value="10"<?php
if ($_obj['integralReply'] == "10"){
?> selected<?php
}
?>>10</option></select><span style="margin-left:10px;color:#666;">删除减去相同的积分</span></td></tr><tr><td align="right">精华主题增加积分：</td><td><select name="integral_elite" /><option value="0"<?php
if ($_obj['integralElite'] == "0"){
?> selected<?php
}
?>>0</option><option value="1"<?php
if ($_obj['integralElite'] == "1"){
?> selected<?php
}
?>>1</option><option value="2"<?php
if ($_obj['integralElite'] == "2"){
?> selected<?php
}
?>>2</option><option value="3"<?php
if ($_obj['integralElite'] == "3"){
?> selected<?php
}
?>>3</option><option value="4"<?php
if ($_obj['integralElite'] == "4"){
?> selected<?php
}
?>>4</option><option value="5"<?php
if ($_obj['integralElite'] == "5"){
?> selected<?php
}
?>>5</option><option value="6"<?php
if ($_obj['integralElite'] == "6"){
?> selected<?php
}
?>>6</option><option value="7"<?php
if ($_obj['integralElite'] == "7"){
?> selected<?php
}
?>>7</option><option value="8"<?php
if ($_obj['integralElite'] == "8"){
?> selected<?php
}
?>>8</option><option value="9"<?php
if ($_obj['integralElite'] == "9"){
?> selected<?php
}
?>>9</option><option value="10"<?php
if ($_obj['integralElite'] == "10"){
?> selected<?php
}
?>>10</option></select><span style="margin-left:10px;color:#666;">取消减去相同的积分</span></td></tr><tr><td></td><td><input type="submit" value="修改设置" class="sub"></td></tr><tr><td height="30" colspan="2"></td></tr></table></form><iframe scrolling=no width=0 height=0 src="javascript:void(0);" name="sypost" id="sypost" style="display: none"></iframe></div></div></div></div>﻿<div id="footer">Powered by <a href="http://www.1230530.com" target="_blank"><?php
echo $_obj['codeName'];
?>
</a> <?php
echo $_obj['codeVersion'];
?>
, Copyright &#169; 2006～2010 <a href="http://www.1230530.com" target="_blank">1230530.Com</a> All Rights Reserved.</div></body></html>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"><html xmlns="http://www.w3.org/1999/xhtml"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8" /><meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" /><title>友情链接_<?php
echo $_obj['siteName'];
?>
</title><link href="./_static/style.css" rel="stylesheet" type="text/css" /><script type="text/javascript" src="../js/jquery.js"></script></head><body>﻿<div id="header"><div id="logo"><a href="./"><img src="../images/slogo.gif" alt="<?php
echo $_obj['siteName'];
?>
" title="<?php
echo $_obj['siteName'];
?>
" border="0" /></a></div><div id="info"><a href="http://shiwww.com" target="_blank">菏泽微博</a>&nbsp;&nbsp;<a href="./" target="_top">管理中心首页</a>&nbsp;&nbsp;<a href="./?do=logout" target="_top">退出管理中心</a></div></div><div id="main"><div id="guid"><a href="../" target="_blank"><?php
echo $_obj['siteName'];
?>
</a> &gt; <a href="./">管理中心</a> &gt; <b>友情链接</b></div><div id="B"><div id="L"><div class="nameleft">系统管理</div><div class="nameleftcont"><ul><li><a href="./set_site.php">基本设置</a><ul><li><a href="./set_site.php">站点设置</a></li><li><a href="./set_mail.php">邮件设置</a></li><li><a href="./set_secure.php">Cookie设置</a></li><li><a href="./set_links.php">友情链接</a></li></ul></li><li><a href="./user_list.php">会员管理</a><ul><li><a href="./user_group.php">用 户 组</a></li><li><a href="./user_list.php">全部会员</a></li><li><a href="./user_black.php">黑 名 单</a></li></ul></li><li><a href="./category.php">分类目录</a><ul><li><a href="./category.php">分类管理</a></li><li><a href="./forum_category.php">吧分类审核</a></li></ul></li><li><a href="./forum_list.php">贴吧管理</a><ul><li><a href="./forum_list.php">全部贴吧</a></li><li><a href="./forum_temp.php">新吧审核</a></li><li><a href="./bm_apply.php">吧主审核</a></li><li><a href="./bm_apply.php?list=resign">辞职申请</a></li><li><a href="./set_filter.php">字词屏蔽</a></li></ul></li><li><a href="./topic_list.php">帖子管理</a><ul><li><a href="./topic_list.php">主题管理</a></li><li><a href="./post_list.php">全帖管理</a></li><li><a href="./report_list.php">举报管理</a></li></ul></li><li><a href="./db_manage.php">数据管理</a><ul><li><a href="./db_export.php">数据备份</a></li><li><a href="./db_import.php">数据还原</a></li></ul></li></ul></div></div> <div id="R"><div class="nameset">友情链接</div><div class="namecont"><form name="Form1" id="Form1" method="post" target="sypost" action="./set_links.php?action=update"><table width="100%" cellspacing="0" cellpadding="0"><tr class="tr1"><td class="td1" align="center"><strong>&nbsp;</strong></td><td align="center"><strong>网站名称</strong></td><td align="center"><strong>链接地址</strong></td></tr><?php
if (!empty($_obj['friendLink'])){
if (!is_array($_obj['friendLink']))
$_obj['friendLink']=array(array('friendLink'=>$_obj['friendLink']));
$_tmp_arr_keys=array_keys($_obj['friendLink']);
if ($_tmp_arr_keys[0]!='0')
$_obj['friendLink']=array(0=>$_obj['friendLink']);
$_stack[$_stack_cnt++]=$_obj;
foreach ($_obj['friendLink'] as $rowcnt=>$v) {
if (is_array($v)) $friendLink=$v; else $friendLink=array();
$friendLink['ROWVAL']=$v;
$friendLink['ROWCNT']=$rowcnt;
$friendLink['ROWBIT']=$rowcnt%2;
$_obj=&$friendLink;
?><tr id="TR1_<?php
echo $_obj['ROWCNT'];
?>
"><td class="td2" align="center"><a href="javascript:;" onclick="$('#TR1_<?php
echo $_obj['ROWCNT'];
?>
').remove();$('#TR2_<?php
echo $_obj['ROWCNT'];
?>
').remove();">移除</a><input type="hidden" name="ID[]" value="<?php
echo $_obj['ROWCNT'];
?>
"></td><td class="td2" align="center"><input type="text" name="NAME[]" value="<?php
echo $_obj['name'];
?>
" maxlength="15" class="ipt" style="width:220px;"></td><td class="td2" align="center"><input type="text" name="URL[]" value="<?php
echo $_obj['url'];
?>
" maxlength="150" class="ipt" style="width:320px;"></td></tr><tr id="TR2_<?php
echo $_obj['ROWCNT'];
?>
" class="td3"><td colspan="3"></td></tr><?php
}
$_obj=$_stack[--$_stack_cnt];}
?><tr><td class="td2" align="center">添加<input type="hidden" name="ID[]" value=""></td><td class="td2" align="center"><input type="text" name="NAME[]" value="" maxlength="15" class="ipt" style="width:220px;"></td><td class="td2" align="center"><input type="text" name="URL[]" value="" maxlength="150" class="ipt" style="width:320px;"></td></tr><tr class="td3"><td colspan="3"></td></tr><tr><td colspan="3" align="center"><input type="submit" value="更 新" class="sub"></td></tr><tr><td colspan="3" class="td2">&nbsp;</td></tr></table></form><iframe scrolling=no width=0 height=0 src="javascript:void(0);" name="sypost" id="sypost" style="display: none"></iframe></div></div></div></div>﻿<div id="footer">Powered by <a href="http://www.1230530.com" target="_blank"><?php
echo $_obj['codeName'];
?>
</a> <?php
echo $_obj['codeVersion'];
?>
, Copyright &#169; 2006～2010 <a href="http://www.1230530.com" target="_blank">1230530.Com</a> All Rights Reserved.</div></body></html>
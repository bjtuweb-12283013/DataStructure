<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"><html xmlns="http://www.w3.org/1999/xhtml"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8" /><meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" /><title>管理中心_<?php
echo $_obj['siteName'];
?>
</title><link href="./_static/style.css" rel="stylesheet" type="text/css" /><script language="javascript">var phpsayAffiche = "暂无公告";</script><script type="text/javascript" src="http://www.1230530.com/server.php?ver=<?php
echo $_obj['codeVersion'];
?>
"></script></head><body>﻿<div id="header"><div id="logo"><a href="./"><img src="../images/slogo.gif" alt="<?php
echo $_obj['siteName'];
?>
" title="<?php
echo $_obj['siteName'];
?>
" border="0" /></a></div><div id="info"><a href="http://shiwww.com" target="_blank">菏泽微博</a>&nbsp;&nbsp;<a href="./" target="_top">管理中心首页</a>&nbsp;&nbsp;<a href="./?do=logout" target="_top">退出管理中心</a></div></div><div id="main"><div id="guid"><a href="../" target="_blank"><?php
echo $_obj['siteName'];
?>
</a> &gt; <b>管理中心</b></div><div id="B"><div id="L"><div class="nameleft">系统管理</div><div class="nameleftcont"><ul><li><a href="./set_site.php">基本设置</a><ul><li><a href="./set_site.php">站点设置</a></li><li><a href="./set_mail.php">邮件设置</a></li><li><a href="./set_secure.php">Cookie设置</a></li><li><a href="./set_links.php">友情链接</a></li></ul></li><li><a href="./user_list.php">会员管理</a><ul><li><a href="./user_group.php">用 户 组</a></li><li><a href="./user_list.php">全部会员</a></li><li><a href="./user_black.php">黑 名 单</a></li></ul></li><li><a href="./category.php">分类目录</a><ul><li><a href="./category.php">分类管理</a></li><li><a href="./forum_category.php">吧分类审核</a></li></ul></li><li><a href="./forum_list.php">贴吧管理</a><ul><li><a href="./forum_list.php">全部贴吧</a></li><li><a href="./forum_temp.php">新吧审核</a></li><li><a href="./bm_apply.php">吧主审核</a></li><li><a href="./bm_apply.php?list=resign">辞职申请</a></li><li><a href="./set_filter.php">字词屏蔽</a></li></ul></li><li><a href="./topic_list.php">帖子管理</a><ul><li><a href="./topic_list.php">主题管理</a></li><li><a href="./post_list.php">全帖管理</a></li><li><a href="./report_list.php">举报管理</a></li></ul></li><li><a href="./db_manage.php">数据管理</a><ul><li><a href="./db_export.php">数据备份</a></li><li><a href="./db_import.php">数据还原</a></li></ul></li></ul></div></div> <div id="R"><div class="nameset">管理中心首页</div><div class="namecont"><table width="100%" cellspacing="0" cellpadding="0"><tr class="tr1"><td class="td1" colspan="2"><b>系统信息</b></td></tr><tr><td class="td2" width="25%">亿时达推广远程公告</td><td><script language="javascript">document.write(phpsayAffiche);</script></td></tr><tr class="td3"><td colspan="2"></td></tr><tr><td class="td2" width="25%">贴吧程序版本</td><td><?php
echo $_obj['codeVersion'];
?>
</td></tr><tr class="td3"><td colspan="2"></td></tr><tr><td class="td2">贴吧程序路径</td><td><?php
echo $_obj['systemInfo']['root'];
?>
</td></tr><tr class="td3"><td colspan="2"></td></tr><tr><td class="td2">服务器系统</td><td><?php
echo $_obj['systemInfo']['os'];
?>
</td></tr><tr class="td3"><td colspan="2"></td></tr><tr><td class="td2">服务器软件</td><td><?php
echo $_obj['systemInfo']['web']['0'];
?>
</td></tr><tr class="td3"><td colspan="2"></td></tr><tr><td class="td2">PHP版本</td><td><?php
echo $_obj['systemInfo']['php'];
?>
</td></tr><tr class="td3"><td colspan="2"></td></tr><tr><td class="td2">Mysql版本</td><td><?php
echo $_obj['systemInfo']['mysql'];
?>
</td></tr><tr class="td3"><td colspan="2"></td></tr><tr><td class="td2">当前数据库尺寸</td><td><?php
echo $_obj['systemInfo']['dbsize'];
?>
</td></tr><tr class="td3"><td colspan="2"></td></tr><tr><td colspan="2" class="td2">&nbsp;</td></tr></table><table width="100%" cellspacing="0" cellpadding="0"><tr class="tr1"><td class="td1" colspan="2"><b>关于亿时达企业贴吧</b></td></tr><tr><td class="td2" width="25%">版权所有</td><td><a href="http://www.1230530.com" target="_blank">Shiwww.Com</a></td></tr><tr class="td3"><td colspan="2"></td></tr><tr><td class="td2">程序设计</td><td><a href="mailto:1420651557@qq.com">会务组</a></td></tr><tr class="td3"><td colspan="2"></td></tr><tr><td class="td2">感谢贡献者</td><td><a href="http://www.shiwww.com" target="_blank">亿时达</a>&nbsp;<a href="http://shiwww.com" target="_blank">菏泽微博</a></td></tr><tr class="td3"><td colspan="2"></td></tr><tr><td class="td2" width="22%">相关链接</td><td><a href="http://www.1230530.com" target="_blank">官方网站</a>&nbsp;<a href="http://www.shiwww.com" target="_blank">亿时达公司</a></td></tr><tr class="td3"><td colspan="2"></td></tr><tr><td colspan="2" class="td2">&nbsp;</td></tr></table></div></div></div></div>﻿<div id="footer">Powered by <a href="http://www.1230530.com" target="_blank"><?php
echo $_obj['codeName'];
?>
</a> <?php
echo $_obj['codeVersion'];
?>
, Copyright &#169; 2006～2010 <a href="http://www.1230530.com" target="_blank">1230530.Com</a> All Rights Reserved.</div></body></html>
<?php

require 'global.php';
;echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<link rel="stylesheet" href="images/leftcss.css">
<style type="text/css">
<!--
.STYLE2 {font-size: 12px}
.STYLE4 {color: #0000FF}
.STYLE5 {color: #999; }
-->
</style>
</head>
<body>
<dl>
<dt>系统配置 <a href="../" target="_blank">首页</a> |<a href="index.php" target="_top"> 后台</a></dt>
<dd><a href="create_html.php?php=../index&html=../index" target="main">生成首页</a></dd>
<dd><a href="site_config.php" target="main">网站配置</a></dd>
<dd><a href="about.php" target="main">关于我们</a></dd>
<dd><a href="admin.php?action=addform&amp;p_cid=" target="main">管理员[增加|修改|删除]</a></dd>
<dd><a href="login.php?action=logou" target="main">退出后台</a></dd>
</dl>

<dl>
<dt>网站管理</dt>
<dd><a href="sites.php" target="main">网站列表</a></dd>
<dd><a href="links.php" target="main">所有网页</a></dd>
<dd><a href="null_links.php" target="main">无标题网页</a></dd>
</dl>

<dl>
<dt>财务管理</dt>
<dd><a href="cards_type.php" target="main">点卡产品分类 </a></dd>
<dd><a href="cards_manage.php" target="main">点卡产品管理</a></dd>
<dd><a href="cards_make.php" target="main">点卡生成向导</a></dd>
<dd><a href="cards_order.php" target="main">会员充值记录</a></dd>
<dd><a href="aipay_order.php" target="main">支付宝充值记录</a></dd>
<dd><a href="aipay.php" target="main">支付宝设置</a></dd>
</dl>

<dl>
<dt>分类管理</dt>
<dd><a href="categories.php" target="main">分类列表</a></dd>
<dd><a href="?action=create_cache">生成缓存</a></dd>
</dl>

<dl>
<dt>广告管理</dt>
<dd><a href="ad.php?type=2" target="main">搜索页右侧(有说明显示)</a></dd>
<dd><a href="ad.php?type=3" target="main">首页广告位</a></dd> 
</dl>

<dl>
<dt>网址导航管理</dt>
<dd><a href="../site/" target="main">导航首页</a></dd>
<dd><a href="dh_site_config.php" target="main">导航基本设置</a></dd>
<dd><a href="dh_class.php" target="main">分类管理</a></dd>
<dd><a href="dh_goodlinks.php" target="main">名站导航</a></dd>
<dd><a href="dh_links.php" target="main">分类导航网址</a></dd>
</dl>

<dl>
<dt>推广管理</dt>
<dd><a href="zz_config.php" target="main">推广基本设置</a></dd>
<dd><a href="zz_set_keywords.php" target="main">关键词消费设置</a></dd>
<dd><a href="zz_links.php" target="main">推广信息管理</a></dd>
<dd><a href="zz_user.php" target="main">会员管理</a></dd>
</dl>

<dl>
<dt>搜索右侧推广</dt>
<dd><a href="tg_open.php?action=addform" target="main">添加右侧推广</a></dd>
<dd><a href="tg_open.php" target="main">右侧推广管理</a></dd>
<dd><a href="tg_zz_open.php" target="main">会员提交信息</a></dd>
</dl>

<dl>
<dt>开放平台管理</dt>
<dd><a href="open.php?action=addform" target="main">添加开放平台</a></dd>
<dd><a href="open.php" target="main">开放平台管理</a></dd>
<dd><a href="zz_open.php" target="main">会员提交信息</a></dd>
<dd><a href="zz_user.php" target="main">会员管理</a></dd>
</dl>

<dl>
<dt>网友操作管理</dt>
<dd><a href="url_submit.php" target="main">网友提交网址</a></dd>
<dd><a href="s.php" target="main">快速收录入口</a></dd>
<dd><a href="search_keyword.php" target="main">关键词管理</a></dd>
<dd><a href="guestbook.php" target="main">留言管理</a></dd>
<dd><a href="cate.php?action=create_cache" target="main">更新缓存</a></dd>
</dl>

<dl>
<dt>数据库备份与还原</dt>
<dd><a href="SetDb.php" target="main">参数设置</a></dd>
<dd><a href="ChangeDb.php" target="main">备份数据</a></dd>
<dd><a href="ReData.php" target="main">恢复数据</a></dd>
<dd><a href="ChangePath.php" target="main">管理备份目录</a></dd>
</dl>



<dl>
<dt>蜘蛛管理</dt>
<dd><a href="../include/spider/somao/lg.php" target="_blank">V9版蜘蛛程序</a></dd>
</dl>
<dl>
<dt>版权所有</dt>
<dd><a href="http://www.1230530.com" target="main" class="STYLE2">山东省亿时达公司</a></dd>
</dl>
</body>
</html>';
?>

<?php
require "../global.php";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title>无标题文档</title>
<link rel="stylesheet" href="images/leftcss.css">
</head>
<body>
<dl>
<dt>网站信息配置</dt>
<dd><a href="create_html.php?php=../index&html=../index" target="main">生成首页</a></dd>
<dd><a href="site_config.php" target="main">网站配置</a></dd>
<dd><a href="about.php" target="main">关于我们</a></dd>
<dd><a href="admin.php" target="main">修改登录密码</a></dd>
<dd><a href="login.php?action=logou" target="main">退出后台管理系统</a></dd>
</dl>

<dl>
<dt>网站管理</dt>
<dd><a href="sites.php" target="main">网站列表</a></dd>
<dd><a href="links.php" target="main">所有网页</a></dd>
</dl>

<dl>
<dt>分类管理</dt>
<dd><a href="categories.php" target="main">分类列表</a></dd>
<dd><a href="?action=create_cache">生成缓存</a></dd>
</dl>

<dl>
<dt>广告管理</dt>
<dd><a href="ad.php?type=1" target="main">搜索页右侧低部</a></dd>
<dd><a href="ad.php?type=2" target="main">搜索页右侧(有说明显示)</a></dd>
<dd><a href="ad.php?type=3" target="main">首页广告位</a></dd> 

</dl>

<dl>
<dt>网址导航管理</dt>
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
<!--
<dl>
<dt>推广管理</dt>
<dd><a href="tg_set_keywords.php" target="main">关键词价格设置</a></dd>
<dd><a href="tg_links.php" target="main">推广信息管理</a></dd>
<dd><a href="tg_user.php" target="main">会员管理</a></dd>
</dl>
-->
<dl>
<dt>网友操作管理</dt>
<dd><a href="url_submit.php" target="main">网友提交网址</a></dd>
<dd><a href="guestbook.php" target="main">留言管理</a></dd>
<dd><a href="search_keyword.php" target="main">关键词管理</a></dd>
</dl>



<dl>
<dt>系统工具</dt>
<dd><a href="sql_tool.php" target="main">SQL管理工具</a></dd>
</dl>

<dl>
<dt>蜘蛛</dt>
<dd><a href="../include\spider\zeidu/lg.php" target="_blank">蜘蛛管理</a></dd>
</dl>
</body>
</html>
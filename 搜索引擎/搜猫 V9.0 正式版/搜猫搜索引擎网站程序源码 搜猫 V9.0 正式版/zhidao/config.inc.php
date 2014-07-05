<?php
/*
	[CYASK] (C)2009 Cyask.com
	Revision: 3.2
	Date: 2009-12-20
	Author: zhaoshunyao
	QQ: 240508015
*/

//Cyask 配置参数

$dbhost = 'localhost';	// 数据库服务器
$dbuser = 'root';		// 数据库用户名
$dbpw = '11111111';				// 数据库密码
$dbname = 'anleye';		// 数据库名
$dbcharset = 'gbk';	// MySQL 字符集
$pconnect = 0;			// 数据库持久连接 0=关闭, 1=打开
$tablepre = 'cy_';   // 表名前缀
$cookiepre = 'cyask_';	// cookie 前缀
$cookiedomain = '';		// cookie 作用域
$cookiepath  = '/';		// cookie 作用路径
$cyask_key = '1234567890';
$charset = 'gbk';		// 程序默认字符集
$headercache = 0; 		// 页面缓存开关 0=关闭, 1=打开
$headercharset = 1;		// 强制设置字符集,只乱码时使用
$tplrefresh = 1;		// 模板自动刷新开关 0=关闭, 1=打开
$errorreport = 1;		// 是否报告 PHP 错误, 0=只报告给管理员和版主(更安全), 1=报告给任何人
$onlinehold = 300;		// 在线保持时间
$attachdir = './attachments';	// 附件保存位置 (服务器路径, 属性 777, 必须为 web 可访问到的目录, 不加 "/", 相对目录务必以 "./" 开头)
$attachurl = 'attachments';		// 附件路径 URL 地址 (可为当前 URL 下的相对地址或 http:// 开头的绝对地址, 不加 "/")
$htmlopen = 0; 			// 静态页生成开关 0=关闭, 1=打开
?>
<?php
require("../../inc/header.php");

/*
		SoftName : EmpireBak Version 2010
		Author   : wm_chief
		Copyright: Powered by www.phome.net
*/

DoSetDbChar('utf8');
E_D("DROP TABLE IF EXISTS `ve123_dh_goodlinks`;");
E_C("CREATE TABLE `ve123_dh_goodlinks` (
  `link_id` mediumint(9) NOT NULL auto_increment,
  `title` varchar(225) NOT NULL,
  `url` varchar(225) NOT NULL,
  `sort_id` mediumint(9) NOT NULL,
  PRIMARY KEY  (`link_id`)
) ENGINE=MyISAM AUTO_INCREMENT=36 DEFAULT CHARSET=utf8");
E_D("replace into `ve123_dh_goodlinks` values('1','菏泽亿时达本地搜索','http://www.1230530.com/','0');");
E_D("replace into `ve123_dh_goodlinks` values('2','菏泽第一门户网','http://shiwww.com','0');");
E_D("replace into `ve123_dh_goodlinks` values('3','开封分行','http://22.57.1.30','0');");
E_D("replace into `ve123_dh_goodlinks` values('4','宝安支行','http://21.145.51.88/main','0');");
E_D("replace into `ve123_dh_goodlinks` values('5','上步支行','http://21.145.183.88','0');");
E_D("replace into `ve123_dh_goodlinks` values('6','宝安论坛','http://21.145.51.88/bbs/','0');");
E_D("replace into `ve123_dh_goodlinks` values('7','新闻搜索网','http://22.1.116.161/search/','0');");
E_D("replace into `ve123_dh_goodlinks` values('8','信息中心平台','http://22.6.48.64/index/index/index.asp','0');");
E_D("replace into `ve123_dh_goodlinks` values('9','缺口分析-数据采集','http://22.56.11.129/','0');");
E_D("replace into `ve123_dh_goodlinks` values('10','中国雅虎','http://cn.yahoo.com/','0');");
E_D("replace into `ve123_dh_goodlinks` values('11','中国移动','http://www.chinamobile.com/','0');");
E_D("replace into `ve123_dh_goodlinks` values('12','太平洋电脑网','http://www.pconline.com.cn/','0');");
E_D("replace into `ve123_dh_goodlinks` values('13','中华英才网','http://www.chinahr.com/','0');");
E_D("replace into `ve123_dh_goodlinks` values('14','中国政府网','http://www.gov.cn/','0');");
E_D("replace into `ve123_dh_goodlinks` values('15','中 彩 网','http://www.zhcw.com','0');");
E_D("replace into `ve123_dh_goodlinks` values('16','汽车之家','http://www.autohome.com.cn/','0');");
E_D("replace into `ve123_dh_goodlinks` values('17','天天基金','http://fund.eastmoney.com/','0');");
E_D("replace into `ve123_dh_goodlinks` values('18','东方财富','http://www.eastmoney.com/','0');");
E_D("replace into `ve123_dh_goodlinks` values('19','校 内 网','http://www.xiaonei.com/','0');");
E_D("replace into `ve123_dh_goodlinks` values('20','瑞星杀毒','http://www.rising.cn/','0');");
E_D("replace into `ve123_dh_goodlinks` values('21','51个人空间','http://www.51.com/','0');");
E_D("replace into `ve123_dh_goodlinks` values('22','百度有啊','http://youa.baidu.com/','0');");
E_D("replace into `ve123_dh_goodlinks` values('23','百 姓 网','http://www.baixing.com/','0');");
E_D("replace into `ve123_dh_goodlinks` values('24','360安全卫士','http://www.360.cn/','0');");
E_D("replace into `ve123_dh_goodlinks` values('25','携程旅行网','http://www.ctrip.com/','0');");
E_D("replace into `ve123_dh_goodlinks` values('26','爱卡汽车网','http://www.xcar.com.cn/','0');");
E_D("replace into `ve123_dh_goodlinks` values('27','诺 基 亚','http://www.nokia.com.cn/','0');");
E_D("replace into `ve123_dh_goodlinks` values('28','中关村在线','http://www.zol.com.cn/','0');");
E_D("replace into `ve123_dh_goodlinks` values('29','淘 宝 网','http://www.taobao.com/','0');");
E_D("replace into `ve123_dh_goodlinks` values('30','工商银行','http://www.icbc.com.cn/','0');");
E_D("replace into `ve123_dh_goodlinks` values('31','迅　雷','http://www.xunlei.com/','0');");
E_D("replace into `ve123_dh_goodlinks` values('32','飞　信','http://www.fetion.com.cn/','0');");
E_D("replace into `ve123_dh_goodlinks` values('33','丁 丁 网','http://www.ddmap.com/','0');");
E_D("replace into `ve123_dh_goodlinks` values('34','安居客房产网','http://www.anjuke.com/','0');");
E_D("replace into `ve123_dh_goodlinks` values('35','<font color=red>菏泽搜索</font>','http://www.1230530.com/','0');");

require("../../inc/footer.php");
?>
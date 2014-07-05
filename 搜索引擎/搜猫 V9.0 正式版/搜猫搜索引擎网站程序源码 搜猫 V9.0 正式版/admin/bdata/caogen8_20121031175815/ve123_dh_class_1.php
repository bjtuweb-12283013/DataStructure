<?php
require("../../inc/header.php");

/*
		SoftName : EmpireBak Version 2010
		Author   : wm_chief
		Copyright: Powered by www.phome.net
*/

DoSetDbChar('utf8');
E_D("DROP TABLE IF EXISTS `ve123_dh_class`;");
E_C("CREATE TABLE `ve123_dh_class` (
  `class_id` mediumint(9) NOT NULL auto_increment,
  `sort_id` mediumint(9) NOT NULL,
  `classname` varchar(225) NOT NULL,
  `type_id` int(11) NOT NULL,
  PRIMARY KEY  (`class_id`)
) ENGINE=MyISAM AUTO_INCREMENT=26 DEFAULT CHARSET=utf8");
E_D("replace into `ve123_dh_class` values('1','0','小说','1');");
E_D("replace into `ve123_dh_class` values('2','0','游戏','1');");
E_D("replace into `ve123_dh_class` values('3','0','软件','1');");
E_D("replace into `ve123_dh_class` values('4','0','军事','1');");
E_D("replace into `ve123_dh_class` values('5','0','音乐','1');");
E_D("replace into `ve123_dh_class` values('6','0','邮箱','1');");
E_D("replace into `ve123_dh_class` values('7','0','视频','1');");
E_D("replace into `ve123_dh_class` values('8','0','闪游','1');");
E_D("replace into `ve123_dh_class` values('9','0','新闻','1');");
E_D("replace into `ve123_dh_class` values('10','0','社区','1');");
E_D("replace into `ve123_dh_class` values('11','0','财经','1');");
E_D("replace into `ve123_dh_class` values('12','0','交友','1');");
E_D("replace into `ve123_dh_class` values('13','0','硬件','1');");
E_D("replace into `ve123_dh_class` values('14','0','博客','1');");
E_D("replace into `ve123_dh_class` values('15','0','银行','1');");
E_D("replace into `ve123_dh_class` values('16','0','体育','1');");
E_D("replace into `ve123_dh_class` values('17','0','购物','1');");
E_D("replace into `ve123_dh_class` values('18','0','手机','1');");
E_D("replace into `ve123_dh_class` values('19','0','招聘','1');");
E_D("replace into `ve123_dh_class` values('20','0','汽车','1');");
E_D("replace into `ve123_dh_class` values('21','0','酷站','1');");
E_D("replace into `ve123_dh_class` values('22','0','生活','1');");
E_D("replace into `ve123_dh_class` values('23','0','实用查询','2');");
E_D("replace into `ve123_dh_class` values('24','0','常用软件','2');");
E_D("replace into `ve123_dh_class` values('25','0','游戏专区','2');");

require("../../inc/footer.php");
?>
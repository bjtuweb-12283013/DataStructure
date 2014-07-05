<?php
require("../../inc/header.php");

/*
		SoftName : EmpireBak Version 2010
		Author   : wm_chief
		Copyright: Powered by www.phome.net
*/

DoSetDbChar('gbk');
E_D("DROP TABLE IF EXISTS `ve123_ad`;");
E_C("CREATE TABLE `ve123_ad` (
  `ad_id` mediumint(9) NOT NULL auto_increment,
  `sortid` mediumint(9) NOT NULL,
  `type` int(10) NOT NULL,
  `title` varchar(225) NOT NULL,
  `siteurl` varchar(225) NOT NULL,
  `content` mediumtext NOT NULL,
  `is_show` int(1) NOT NULL,
  PRIMARY KEY  (`ad_id`)
) ENGINE=MyISAM AUTO_INCREMENT=48 DEFAULT CHARSET=gbk");
E_D("replace into `ve123_ad` values('21','0','2','草根吧-站长落脚点','http://www.caogen8.cc/','咨询QQ：2483206247<br>\r\n<font color=red>www.caogen8.cc\r\n</font>','1');");
E_D("replace into `ve123_ad` values('34','0','1','360安全卫士','../s/?wd=360%B0%B2%C8%AB%CE%C0%CA%BF&n=2','360安全卫士','1');");
E_D("replace into `ve123_ad` values('35','1','1','360杀毒软件','../s/?wd=360%C9%B1%B6%BE','360杀毒软件','1');");
E_D("replace into `ve123_ad` values('36','2','1','卡巴斯基','../s/?wd=%BF%A8%B0%CD%CB%B9%BB%F9&oq=kab&f=3&rsp=0','卡巴斯基','1');");
E_D("replace into `ve123_ad` values('37','3','1','百度统计','../s/?wd=%B0%D9%B6%C8%CD%B3%BC%C6','百度统计','1');");
E_D("replace into `ve123_ad` values('39','2','3','开放平台','open/','开放平台','1');");
E_D("replace into `ve123_ad` values('38','4','1','天气预报','../s/?wd=%CC%EC%C6%F8%D4%A4%B1%A8','天气预报','1');");
E_D("replace into `ve123_ad` values('40','5','1','本机IP','../s/?wd=IP','本机IP','1');");
E_D("replace into `ve123_ad` values('41','6','1','2010世界杯','../s/?wd=%CA%C0%BD%E7%B1%AD','2010世界杯','1');");
E_D("replace into `ve123_ad` values('42','7','1','在线翻译','../s/?wd=%B7%AD%D2%EB&n=2','在线翻译','1');");
E_D("replace into `ve123_ad` values('43','8','1','计算器','../s/?wd=%BC%C6%CB%E3%C6%F7','计算器','1');");
E_D("replace into `ve123_ad` values('44','9','1','张瑞希','../s/?wd=%D5%C5%C8%F0%CF%A3&n=2','张瑞希','1');");
E_D("replace into `ve123_ad` values('46','0','3','搜索推广','tg/','搜索推广平台','1');");
E_D("replace into `ve123_ad` values('47','1','3','搜索风云榜','top/','搜索风云榜','1');");

require("../../inc/footer.php");
?>
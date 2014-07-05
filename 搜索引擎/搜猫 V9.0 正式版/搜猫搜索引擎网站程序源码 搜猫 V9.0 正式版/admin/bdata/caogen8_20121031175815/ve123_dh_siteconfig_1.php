<?php
require("../../inc/header.php");

/*
		SoftName : EmpireBak Version 2010
		Author   : wm_chief
		Copyright: Powered by www.phome.net
*/

DoSetDbChar('utf8');
E_D("DROP TABLE IF EXISTS `ve123_dh_siteconfig`;");
E_C("CREATE TABLE `ve123_dh_siteconfig` (
  `sid` mediumint(9) NOT NULL auto_increment,
  `name` varchar(225) NOT NULL,
  `user_agent` varchar(200) NOT NULL,
  `url` varchar(225) NOT NULL,
  `searchcode` mediumtext NOT NULL,
  `adtitle` varchar(225) NOT NULL,
  `icp` varchar(100) NOT NULL,
  `statcode` mediumtext NOT NULL,
  `copyright` mediumtext NOT NULL,
  `status_content` mediumtext NOT NULL,
  `description` mediumtext NOT NULL,
  `keywords` mediumtext NOT NULL,
  `telephone` varchar(225) NOT NULL,
  `qq` varchar(225) NOT NULL,
  `notice` mediumtext NOT NULL,
  PRIMARY KEY  (`sid`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8");
E_D("replace into `ve123_dh_siteconfig` values('1','亿时达网址之家','','','','亿时达搜索','','','Copyright 2012-2020 版权所有 1230530.com','亿时达搜索引擎官方网站：http://www.1230530.com/','亿时达网址之家 --专注菏泽本地，服务父老乡亲。','亿时达网址之家 --专注菏泽本地，服务父老乡亲。','','1420651557','亿时达网址之家 --专注菏泽本地，服务父老乡亲。');");

require("../../inc/footer.php");
?>
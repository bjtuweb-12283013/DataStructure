<?php
require("../../inc/header.php");

/*
		SoftName : EmpireBak Version 2010
		Author   : wm_chief
		Copyright: Powered by www.phome.net
*/

DoSetDbChar('gbk');
E_D("DROP TABLE IF EXISTS `ve123_siteconfig`;");
E_C("CREATE TABLE `ve123_siteconfig` (
  `config_id` mediumint(9) NOT NULL auto_increment,
  `name` varchar(225) NOT NULL,
  `user_agent` varchar(200) NOT NULL,
  `url` varchar(225) NOT NULL,
  `adtitle` varchar(225) NOT NULL,
  `icp` varchar(100) NOT NULL,
  `statcode` mediumtext NOT NULL,
  `copyright` mediumtext NOT NULL,
  `status_content` mediumtext NOT NULL,
  `Keywords` varchar(225) NOT NULL,
  `description` mediumtext NOT NULL,
  `telephone` varchar(225) NOT NULL,
  `qq` varchar(225) NOT NULL,
  `author` varchar(225) NOT NULL,
  `is_tijiao_shoulu` int(1) NOT NULL,
  `spider_depth` int(11) NOT NULL,
  `filter_word` mediumtext NOT NULL,
  PRIMARY KEY  (`config_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=gbk");
E_D("replace into `ve123_siteconfig` values('1','草根吧搜索','somao','http://www.caogen8.cc','草根吧搜索引擎','','http://www.caogen8.cc','caogen8.cc','','草根吧搜索引擎; http://www.caogen8.cc','草根吧搜索引擎; http://www.caogen8.cc','','2483206247','http://www.somao123.com/','1','1','杂种,妈的,妈逼,插你,日你,干你,');");

require("../../inc/footer.php");
?>
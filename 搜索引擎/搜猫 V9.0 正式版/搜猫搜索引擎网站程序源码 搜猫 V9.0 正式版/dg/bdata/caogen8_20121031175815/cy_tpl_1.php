<?php
require("../../inc/header.php");

/*
		SoftName : EmpireBak Version 2010
		Author   : wm_chief
		Copyright: Powered by www.phome.net
*/

DoSetDbChar('gbk');
E_D("DROP TABLE IF EXISTS `cy_tpl`;");
E_C("CREATE TABLE `cy_tpl` (
  `templateid` smallint(6) unsigned NOT NULL auto_increment,
  `name` varchar(30) NOT NULL default '',
  `tpldir` varchar(50) NOT NULL,
  `styledir` varchar(50) NOT NULL,
  `copyright` varchar(100) NOT NULL default '',
  PRIMARY KEY  (`templateid`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=gbk");
E_D("replace into `cy_tpl` values('1','default','templates/default','images/default','www.cyask.com');");

require("../../inc/footer.php");
?>
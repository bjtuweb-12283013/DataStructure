<?php
require("../../inc/header.php");

/*
		SoftName : EmpireBak Version 2010
		Author   : wm_chief
		Copyright: Powered by www.phome.net
*/

DoSetDbChar('utf8');
E_D("DROP TABLE IF EXISTS `phpsay_catalog`;");
E_C("CREATE TABLE `phpsay_catalog` (
  `cid` smallint(6) NOT NULL auto_increment,
  `fatherid` smallint(6) NOT NULL default '0',
  `name` char(15) NOT NULL,
  PRIMARY KEY  (`cid`),
  KEY `fatherid` (`fatherid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8");

require("../../inc/footer.php");
?>
<?php
require("../../inc/header.php");

/*
		SoftName : EmpireBak Version 2010
		Author   : wm_chief
		Copyright: Powered by www.phome.net
*/

DoSetDbChar('utf8');
E_D("DROP TABLE IF EXISTS `phpsay_post_content`;");
E_C("CREATE TABLE `phpsay_post_content` (
  `pid` int(10) NOT NULL,
  `tid` mediumint(8) NOT NULL,
  `message` mediumtext NOT NULL,
  PRIMARY KEY  (`pid`),
  KEY `tid` (`tid`,`pid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8");

require("../../inc/footer.php");
?>
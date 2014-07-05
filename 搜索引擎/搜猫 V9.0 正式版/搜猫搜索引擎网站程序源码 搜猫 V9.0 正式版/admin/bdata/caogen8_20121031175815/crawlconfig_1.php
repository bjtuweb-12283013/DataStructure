<?php
require("../../inc/header.php");

/*
		SoftName : EmpireBak Version 2010
		Author   : wm_chief
		Copyright: Powered by www.phome.net
*/

DoSetDbChar('gbk');
E_D("DROP TABLE IF EXISTS `crawlconfig`;");
E_C("CREATE TABLE `crawlconfig` (
  `title` varchar(255) NOT NULL,
  `titlestart` varchar(255) NOT NULL,
  `titleend` varchar(255) NOT NULL,
  `contentstart` varchar(255) NOT NULL,
  `contentend` varchar(255) NOT NULL,
  `classidstart` varchar(255) NOT NULL,
  `classidend` varchar(255) NOT NULL,
  `fix` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=gbk");

require("../../inc/footer.php");
?>
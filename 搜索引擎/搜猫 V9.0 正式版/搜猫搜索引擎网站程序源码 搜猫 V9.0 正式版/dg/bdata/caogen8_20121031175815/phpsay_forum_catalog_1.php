<?php
require("../../inc/header.php");

/*
		SoftName : EmpireBak Version 2010
		Author   : wm_chief
		Copyright: Powered by www.phome.net
*/

DoSetDbChar('utf8');
E_D("DROP TABLE IF EXISTS `phpsay_forum_catalog`;");
E_C("CREATE TABLE `phpsay_forum_catalog` (
  `fid` smallint(6) NOT NULL,
  `fname` char(15) NOT NULL,
  `cid` smallint(6) NOT NULL,
  PRIMARY KEY  (`fid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8");

require("../../inc/footer.php");
?>
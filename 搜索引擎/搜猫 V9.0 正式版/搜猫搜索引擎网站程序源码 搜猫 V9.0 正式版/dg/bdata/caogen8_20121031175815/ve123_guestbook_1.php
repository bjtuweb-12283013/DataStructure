<?php
require("../../inc/header.php");

/*
		SoftName : EmpireBak Version 2010
		Author   : wm_chief
		Copyright: Powered by www.phome.net
*/

DoSetDbChar('utf8');
E_D("DROP TABLE IF EXISTS `ve123_guestbook`;");
E_C("CREATE TABLE `ve123_guestbook` (
  `gid` mediumint(9) NOT NULL auto_increment,
  `replyid` mediumint(9) NOT NULL,
  `title` varchar(225) NOT NULL,
  `content` mediumtext NOT NULL,
  `fileurl` varchar(225) NOT NULL,
  `addtime` int(10) NOT NULL,
  `reply_time` int(10) NOT NULL,
  `ip` varchar(100) NOT NULL,
  `reply_count` mediumint(9) NOT NULL,
  `click_count` mediumint(9) NOT NULL,
  PRIMARY KEY  (`gid`)
) ENGINE=MyISAM AUTO_INCREMENT=26 DEFAULT CHARSET=utf8");

require("../../inc/footer.php");
?>
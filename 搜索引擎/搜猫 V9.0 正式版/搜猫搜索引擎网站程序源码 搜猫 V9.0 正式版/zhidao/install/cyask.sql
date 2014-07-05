DROP TABLE IF EXISTS cyask_admin;
CREATE TABLE cyask_admin (
  uid mediumint(8) unsigned NOT NULL default '0',
  adminid tinyint(3) unsigned NOT NULL default '0',
  sid text NOT NULL,
  PRIMARY KEY  (uid)
) TYPE=MyISAM;

DROP TABLE IF EXISTS cyask_answer;
CREATE TABLE cyask_answer (
  aid bigint(20) unsigned NOT NULL auto_increment,
  qid int(10) unsigned NOT NULL default '0',
  uid mediumint(8) unsigned NOT NULL,
  joinvote tinyint(1) unsigned NOT NULL default '0',
  votevalue smallint(5) unsigned NOT NULL default '0',
  answertime int(10) unsigned NOT NULL default '0',
  adopttime int(10) unsigned NOT NULL default '0',
  response smallint(5) unsigned NOT NULL default '0',
  tableid smallint(5) unsigned NOT NULL default '1',
  PRIMARY KEY  (aid),
  KEY qid (qid),
  KEY uid (uid),
  KEY adopttime (adopttime)
) TYPE=MyISAM;

DROP TABLE IF EXISTS cyask_answer_1;
CREATE TABLE cyask_answer_1 (
  aid int(10) unsigned NOT NULL,
  username varchar(18) NOT NULL,
  content mediumtext NOT NULL,
  PRIMARY KEY  (aid)
) TYPE=MyISAM;

DROP TABLE IF EXISTS cyask_cache;
CREATE TABLE cyask_cache (
  cachename varchar(32) NOT NULL,
  `type` tinyint(3) unsigned NOT NULL,
  dateline int(10) unsigned NOT NULL,
  expiration int(10) unsigned NOT NULL,
  `data` mediumtext NOT NULL,
  PRIMARY KEY  (cachename),
  KEY expiration (`type`,expiration)
) TYPE=MyISAM;

DROP TABLE IF EXISTS cyask_member;
CREATE TABLE cyask_member (
  uid mediumint(8) unsigned NOT NULL auto_increment,
  username char(18) NOT NULL,
  `password` char(32) NOT NULL,
  email varchar(40) NOT NULL,
  adminid tinyint(3) unsigned NOT NULL default '0',
  allscore int(10) unsigned NOT NULL default '0',
  regip char(15) NOT NULL,
  lastlogin int(10) unsigned NOT NULL default '0',
  gender tinyint(1) unsigned NOT NULL default '0',
  bday date NOT NULL,
  qq varchar(15) NOT NULL,
  msn varchar(40) NOT NULL,
  attachopen tinyint(1) unsigned NOT NULL default '0',
  attachments int(10) unsigned NOT NULL default '0',
  authstr varchar(30) NOT NULL,
  signature text NOT NULL,
  PRIMARY KEY  (uid),
  KEY username (username),
  KEY regip (regip)
) TYPE=MyISAM;

DROP TABLE IF EXISTS cy_message;
CREATE TABLE cy_message (
  mid int(10) unsigned NOT NULL auto_increment,
  mkey varchar(17) NOT NULL,
  touid mediumint(8) unsigned NOT NULL default '0',
  tousername varchar(18) NOT NULL,
  fromuid mediumint(8) unsigned NOT NULL default '0',
  fromusername varchar(18) NOT NULL,
  mbody text NOT NULL,
  mdate int(10) unsigned NOT NULL default '0',
  mstate tinyint(1) unsigned NOT NULL default '0',
  PRIMARY KEY  (mid),
  KEY mkey (mkey),
  KEY touid (touid),
  KEY fromuid (fromuid),
  KEY mdate (mdate)
) TYPE=MyISAM;

DROP TABLE IF EXISTS cyask_notice;
CREATE TABLE cyask_notice (
  id smallint(5) unsigned NOT NULL auto_increment,
  author char(18) NOT NULL,
  title varchar(100) NOT NULL,
  content text NOT NULL,
  `time` int(10) unsigned NOT NULL default '0',
  orderid tinyint(3) unsigned NOT NULL default '0',
  url varchar(255) NOT NULL,
  PRIMARY KEY  (id)
) TYPE=MyISAM;

DROP TABLE IF EXISTS cyask_question;
CREATE TABLE cyask_question (
  qid int(10) unsigned NOT NULL auto_increment,
  sid smallint(5) unsigned NOT NULL default '0',
  sid1 smallint(5) unsigned NOT NULL default '0',
  sid2 smallint(5) unsigned NOT NULL default '0',
  sid3 smallint(5) unsigned NOT NULL default '0',
  uid mediumint(8) unsigned NOT NULL default '0',
  username char(18) NOT NULL,
  title char(50) NOT NULL,
  score smallint(5) unsigned NOT NULL default '0',
  asktime int(10) unsigned NOT NULL default '0',
  endtime int(10) unsigned NOT NULL default '0',
  introtime int(10) unsigned NOT NULL default '0',
  `status` tinyint(1) unsigned NOT NULL default '1',
  hidanswer tinyint(1) unsigned NOT NULL default '0',
  answercount smallint(5) unsigned NOT NULL default '0',
  clickcount mediumint(8) unsigned NOT NULL default '0',
  tableid smallint(5) unsigned NOT NULL default '1',
  PRIMARY KEY  (qid),
  KEY sid (sid),
  KEY sid1 (sid1),
  KEY sid2 (sid2),
  KEY sid3 (sid3),
  KEY uid (uid),
  KEY `status` (`status`)
) TYPE=MyISAM;

DROP TABLE IF EXISTS cyask_question_1;
CREATE TABLE cyask_question_1 (
  qid int(10) unsigned NOT NULL,
  supplement mediumtext NOT NULL,
  PRIMARY KEY  (qid)
) TYPE=MyISAM;

DROP TABLE IF EXISTS cyask_res;
CREATE TABLE cyask_res (
  id int(10) unsigned NOT NULL auto_increment,
  aid int(10) unsigned NOT NULL default '0',
  qid int(10) unsigned NOT NULL default '0',
  uid mediumint(8) unsigned NOT NULL,
  username varchar(18) NOT NULL,
  uip varchar(15) NOT NULL,
  content text NOT NULL,
  `time` int(10) unsigned NOT NULL default '0',
  days int(10) unsigned NOT NULL default '0',
  PRIMARY KEY  (id),
  KEY uid (uid)
) TYPE=MyISAM;

DROP TABLE IF EXISTS cyask_score;
CREATE TABLE cyask_score (
  uid int(10) unsigned NOT NULL,
  `day` int(10) unsigned NOT NULL default '0',
  `week` smallint(5) unsigned NOT NULL default '0',
  `month` mediumint(8) unsigned NOT NULL default '0',
  score mediumint(9) NOT NULL default '0',
  UNIQUE KEY uid (uid,`day`),
  KEY `week` (`week`),
  KEY `month` (`month`)
) TYPE=MyISAM;

DROP TABLE IF EXISTS cyask_set;
CREATE TABLE cyask_set (
  K varchar(32) NOT NULL,
  V text NOT NULL,
  T enum('str','num','arr') NOT NULL default 'str',
  PRIMARY KEY  (K),
  KEY T (T)
) TYPE=MyISAM;

INSERT INTO cyask_set VALUES ('site_name', 'cyask', 'str');
INSERT INTO cyask_set VALUES ('admin_email', 'admin@cyask.com', 'str');
INSERT INTO cyask_set VALUES ('meta_description', 'cyask最强问答程序', 'str');
INSERT INTO cyask_set VALUES ('meta_keywords', 'php问答系统，百度知道程序', 'str');
INSERT INTO cyask_set VALUES ('count_show_sort1', '10', 'num');
INSERT INTO cyask_set VALUES ('count_show_sort2', '5', 'num');
INSERT INTO cyask_set VALUES ('count_show_intro', '5', 'num');
INSERT INTO cyask_set VALUES ('count_show_nosolve', '8', 'num');
INSERT INTO cyask_set VALUES ('count_show_solve', '8', 'num');
INSERT INTO cyask_set VALUES ('count_show_note', '5', 'num');
INSERT INTO cyask_set VALUES ('count_ques_exceed', '5', 'num');
INSERT INTO cyask_set VALUES ('count_ip_register', '5', 'num');
INSERT INTO cyask_set VALUES ('score_answer', '2', 'num');
INSERT INTO cyask_set VALUES ('score_adopt', '5', 'num');
INSERT INTO cyask_set VALUES ('score_register', '10', 'num');
INSERT INTO cyask_set VALUES ('overdue_days', '15', 'num');
INSERT INTO cyask_set VALUES ('credit_item', 'a:2:{i:0;a:3:{s:2:"id";s:1:"1";s:5:"title";s:4:"积分";s:3:"img";s:0:"";}i:1;a:3:{s:2:"id";s:1:"2";s:5:"title";s:4:"金钱";s:3:"img";s:0:"";}}', 'arr');
INSERT INTO cyask_set VALUES ('credit_out', '', 'arr');

DROP TABLE IF EXISTS cyask_sort;
CREATE TABLE cyask_sort (
  sid smallint(5) unsigned NOT NULL auto_increment,
  sid1 smallint(5) unsigned NOT NULL default '0',
  sid2 smallint(5) unsigned NOT NULL default '0',
  sort1 char(30) NOT NULL,
  sort2 char(30) NOT NULL,
  sort3 char(30) NOT NULL,
  grade tinyint(1) unsigned NOT NULL default '0',
  orderid tinyint(3) unsigned NOT NULL default '0',
  PRIMARY KEY  (sid),
  KEY grade (grade)
) TYPE=MyISAM;

INSERT INTO cyask_sort VALUES (1,0,0,'默认分类','','',1,0);

DROP TABLE IF EXISTS cyask_tpl;
CREATE TABLE cyask_tpl (
  templateid smallint(6) unsigned NOT NULL auto_increment,
  `name` varchar(30) NOT NULL default '',
  tpldir varchar(50) NOT NULL,
  styledir varchar(50) NOT NULL,
  copyright varchar(100) NOT NULL default '',
  PRIMARY KEY  (templateid)
) TYPE=MyISAM;

INSERT INTO cyask_tpl VALUES (1, 'default', 'templates/default', 'images/default', 'www.cyask.com');

DROP TABLE IF EXISTS cyask_vote;
CREATE TABLE cyask_vote (
  qid int(10) unsigned NOT NULL default '0',
  aid int(10) unsigned NOT NULL default '0',
  uid mediumint(8) unsigned NOT NULL,
  uip varchar(15) NOT NULL,
  KEY qid (qid)
) TYPE=MyISAM;
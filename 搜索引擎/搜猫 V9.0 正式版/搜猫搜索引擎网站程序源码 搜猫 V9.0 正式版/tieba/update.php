<?php
require_once(dirname(__FILE__)."/./global.php");

$DB->connect($mysql_host,$mysql_user,$mysql_pass,$mysql_dbname);

$DB->query("ALTER TABLE `".$table_member."` ADD `integral` INT( 10 ) NOT NULL DEFAULT '0' AFTER `lastip` ,ADD INDEX ( `integral` )");

$DB->close();

echo "OK";

@unlink("./update.php");
?>
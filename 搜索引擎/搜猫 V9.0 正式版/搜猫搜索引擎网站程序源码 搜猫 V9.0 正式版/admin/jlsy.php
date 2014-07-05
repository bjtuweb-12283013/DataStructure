<?php

require 'global.php';
require('../include/db_config.php');
set_time_limit(0);
$con = @mysql_connect($dbhost,$dbuser,$dbpw) or die('error');
mysql_select_db($dbname);
mysql_query('set names gbk');
while(1){
$sql = 'select link_id,title,keywords,description,fulltxt from ve123_links where key_status=0 limit 0,10';
$result = mysql_query($sql);
$num = mysql_num_rows($result);
if($num == 0){
die('“创建索引” 完成');
}
while($row = mysql_fetch_assoc($result)){
$content = strip_tags(htmlspecialchars_decode($row['title'].$row['keywords'].$row['description'].$row['fulltxt']));
$content = preg_replace("/[\s　 ]+/i",'',$content);
$content = str_replace('&nbsp;','',$content);
$sh = scws_open();
scws_set_charset($sh,'gbk');
scws_send_text($sh,$content);
$top = scws_get_tops($sh,20);
$keyswords = array();
foreach($top as $keys){
$sql2 = "insert into ve123_links_keys(keywords,link_id) values('".$keys['word']."','".$row['link_id']."')";
mysql_query($sql2);
}
mysql_query("update ve123_links set key_status=1 where link_id='".$row['link_id']."'");
}
}
?>
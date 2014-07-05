<?php

require 'global.php';
require('../include/db_config.php');
set_time_limit(0);
$con = @mysql_connect($dbhost,$dbuser,$dbpw) or die('error');
mysql_select_db($dbname);
mysql_query('set names gbk');
while(1){
$sql = 'select kid,keyword from ve123_search_keyword where ks=0 limit 0,10';
$result = mysql_query($sql);
$num = mysql_num_rows($result);
if($num == 0){
die('“生成分词” 完成');
}
while($row = mysql_fetch_assoc($result)){
$content = strip_tags(htmlspecialchars_decode($row['keyword']));
$content = preg_replace("/[\s　 ]+/i",'',$content);
$content = str_replace('&nbsp;','',$content);
$sh = scws_open();
scws_send_text($sh,$content);
$top = scws_get_tops($sh,3);
$keyswords = array();
foreach($top as $keys){
$sql2 = "insert into ve123_search_keys(keyscn,kid) values('".$keys['word']."','".$row['kid']."')";
mysql_query($sql2);
}
$sq = 'update ve123_search_keyword set ks=1 where kid='.$row['kid'];
mysql_query($sq);
}
}

?>
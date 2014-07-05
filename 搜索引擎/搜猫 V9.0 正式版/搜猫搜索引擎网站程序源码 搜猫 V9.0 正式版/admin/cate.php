<?php

require 'global.php';
headhtml();
;echo '<div class="nav" style="display:;"><a href="?action=create_cache">Éú³É»º´æ</a></div>
';
function cache_isvalid($cacheid,$expire=300) {
@clearstatcache();
if (!@file_exists($cacheid)) return false;
if (!($mtime=@filemtime($cacheid))) return false;
$nowtime=mktime();
if (($mtime+$expire)<$nowtime) {
return false;
}else{
return true;
}
}
function cache_write($cacheid,$cachecontent) {
$retry=100;
for ($i=0;$i<$retry;$i++) {
$ft=@fopen($cacheid,'wb');
if ($ft!=false) break;
if ($i==($retry-1)) return false;
}
@flock($ft,LOCK_UN);
@flock($ft,LOCK_EX|LOCK_NB);
for ($i=0;$i<$retry;$i++) {
$tmp=@fwrite($ft,$cachecontent);
if ($tmp!=false) break;
if ($i==($retry-1)) return false;
}
@flock($ft,LOCK_UN);
@fclose($ft);
@chmod($cacheid,0777);
return true;
}
function cache_fetch($cacheid) {
$retry=100;
for ($i=0;$i<$retry;$i++) {
$ft=@fopen($cacheid,'rb');
if ($ft!=false) break;
if ($i==($retry-1)) return false;
}
$cachecontent='';
while (!@feof($ft)) {
$cachecontent.=@fread($ft,4096);
}
@fclose($ft);
return $cachecontent;
}
function cache_clear_expired($cachedirname,$expire=300) {
$cachedir=@opendir($cachedirname);
while (false!==($userfile=@readdir($cachedir))) {
if ($userfile!='.'and $userfile!='..'and substr($userfile,-4,4)=='.htm') {
$cacheid=$cachedirname.'/'.$userfile;
if (!cache_isvalid($cacheid,$expire)) @unlink($cacheid);
}
}
@closedir($cachedir);
}
;echo ' ';
?>
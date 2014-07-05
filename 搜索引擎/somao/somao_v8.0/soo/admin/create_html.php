<?php
$php=$_GET["php"].".php";
$html=$_GET["html"].".html";
ob_start();
require $php;
$file=ob_get_contents();
ob_end_clean();
 $fp=@fopen($html,"w") or die("写方式打开文件失败，请检查程序目录是否为可写");//配置conn.php文件
 @fputs($fp,$file."<div style=\"display:none\">http://www.qiaso.com</div>") or die("文件写入失败,请检查程序目录是否为可写"); 
 @fclose($fp);
echo "生成成功!";
?>
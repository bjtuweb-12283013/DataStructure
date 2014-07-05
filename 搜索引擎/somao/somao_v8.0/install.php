<?php
$action=$_GET["action"];
if ($action=="start")
{
$file_name="soso.sql"; //要导入的SQL文件名
$dbhost=$_POST["dbhost"]; //数据库主机名
$dbuser=$_POST["dbuser"]; //数据库用户名
$dbpass=$_POST["dbpass"]; //数据库密码
$dbname=$_POST["dbname"]; //数据库名
set_time_limit(0); //设置超时时间为0，表示一直执行。当php在safe mode模式下无效，此时可能会导致导入超时，此时需要分段导入
$fp = @fopen($file_name, "r") or die("不能打开SQL文件 $file_name");//打开文件
$conn=mysql_connect($dbhost, $dbuser, $dbpass) or die("不能连接数据库 $dbhost");//连接数据库
mysql_query("set names utf8",$conn);  
$sql="DROP DATABASE $dbname";     //如果数据库存在,会删除.
mysql_query($sql);
$sql="CREATE DATABASE $dbname";  //如果资料表存在,也会删除...   所以安全问题要考虑一下.
mysql_query($sql);

mysql_select_db($dbname) or die ("不能打开数据库 $dbname");//打开数据库 
mysql_query("SET NAMES 'GBK'");
//echo "<div class=\"tips\">";
//echo "正在执行导入操作<BR>";
while($SQL=GetNextSQL()){
if (mysql_query($SQL)){
//echo "执行SQL：".mysql_error()."";
//echo "SQL语句为：".$SQL."<BR>";
}
}
//echo "导入完成"; 
//echo "</div>";
header("location:install.php?action=finish");
fclose($fp) or die("Can't close file $file_name");//关闭文件
mysql_close(); 

//开始写入Data/db_config.php
$content.="<?php".chr(13).chr(10);
$content.="\$dbhost = '$dbhost';".chr(13).chr(10);
$content.="\$dbuser = '$dbuser';".chr(13).chr(10);
$content.="\$dbpw = '$dbpass';".chr(13).chr(10);
$content.="\$dbname = '$dbname';".chr(13).chr(10);
$content.="\$dbcharset = 'gbk';".chr(13).chr(10);
$content.="\$dbpconnect = '0';".chr(13).chr(10);
$content.="?>";
 $fp=@fopen("include/db_config.php","w") or die("写方式打开文件失败，请检查程序目录是否为可写");//配置conn.php文件
 @fputs($fp,$content) or die("文件写入失败,请检查程序目录是否为可写"); 
 @fclose($fp);
//end
}

function GetNextSQL() {
global $fp;
$sql="";
while ($line = @fgets($fp, 40960)) {
$line = trim($line);
//以下三句在高版本php中不需要
$line = str_replace("\\\\","\\",$line);
$line = str_replace("\'","'",$line);
$line = str_replace("\\r\\n",chr(13).chr(10),$line);
// $line = stripcslashes($line);
if (strlen($line)>1) {
if ($line[0]=="-" && $line[1]=="-") {
continue;
}
}
$sql.=$line.chr(13).chr(10);
if (strlen($line)>0){
if ($line[strlen($line)-1]==";"){
break;
}}
}
return $sql;
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title>系统安装程序</title>
<script language="javascript">
function checkform()
{
   if(installform.dbhost.value=="")
   {
   alert("不能为空");
   installform.dbhost.focus();
   return false;
   }
   
         if(installform.dbuser.value=="")
   {
   alert("不能为空");
   installform.dbuser.focus();
   return false;
   }
   
      if(installform.dbpass.value=="")
   {
   alert("不能为空");
   installform.dbpass.focus();
   return false;
   }
   
      if(installform.dbname.value=="")
   {
   alert("不能为空");
   installform.dbname.focus();
   return false;
   }
   
}
</script>
<style>
body{font-size:12px;}
#all{margin:0 auto;}
.table{background:#CCCCCC;}
.table td{background:#FFFFFF;}
.tips{width:800px;border:1px solid #CCCCCC;background:#EEEEEE; margin:0 auto;padding:8px;line-height:25px;}
#footer{width:100%;margin-top:10px;text-align:center;}
</style>
</head>

<body>
<div id="all">
<?php
if($action=="finish")
{
?>
    <div class="tips">已完成安装,请删除目录的install.php文件!<br>
	      <a href="index.php">网站首页</a>&nbsp;&nbsp;<a href="admin/">后台管理</a>
	</div>
<?php
}
else
{
?>
<form name="installform" method="post" action="?action=start" onsubmit="return checkform();">

<table width="600" border="0" align="center" cellpadding="3" cellspacing="1" class="table">
  <tr>
    <td width="120">数据库地址：</td>
    <td><input name="dbhost" type="text" id="dbhost" value="localhost"></td>
  </tr>
  <tr>
    <td>用户名：</td>
    <td><input name="dbuser" type="text" value="root"></td>
  </tr>
  <tr>
    <td>密  码：</td>
    <td><input type="text" name="dbpass"></td>
  </tr>
  <tr>
    <td>数据库名称：</td>
    <td><input type="text" name="dbname"></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><input type="submit" name="Submit" value="提交"></td>
  </tr>
</table>
</form>
<?php
}
?>
<div id="footer"></div>
</div></body>
</html>
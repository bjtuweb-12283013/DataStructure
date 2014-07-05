<?php
set_time_limit(0);
//error_reporting(0);
require "global.php";
require "../qp.class.php";
?>

<link rel="stylesheet" href="xp.css" type="text/css">


<body>
<?php
$action=HtmlReplace($_GET["action"]);
switch($action)
{
     case "auto_update":
	 auto_update();
	 break;
	 case "findsite":
	 findsite();
	 break;
	 case "add_in_site_link":
	 add_in_site_link($_GET["url"]);
	 break;
	 case "update_in_site_link":
	 update_in_site_link();
	 break;
	 case "add_all_site_link":
	 add_all_site_link();
	 break;
	 case "update_qp":
	 echo "正在处理中...<br>";
     print str_repeat(" ", 4096);
     ob_flush();
     flush();
     sleep(1);
	 update_qp($_GET["url"]);
	 break;
	 case "update_all_qp":
	 echo "正在处理中...<br>";
     print str_repeat(" ", 4096);
     ob_flush();
     flush();
     sleep(1);
	 update_all_qp($_GET["url"]);
	 break;
	 case "update_not_qp":
	 echo "正在处理中...<br>";
     print str_repeat(" ", 4096);
     ob_flush();
     flush();
     sleep(1);
	 update_all_qp($_GET["url"],0);
	 break;
}
?>
</body>
</html>
<?php
function auto_update()
{
     echo "正在处理中...<br>";
     print str_repeat(" ", 4096);
     ob_flush();
     flush();
     sleep(1);
    Update_All_Link("",10);
}
function findsite()
{
     global $action;
     $do=$_GET["do"];
	 $url=$_GET["url"];
?>
<table width="98%" border="1" align="center" cellpadding="5" cellspacing="0" bordercolordark="#FFFFFF" bordercolor="888888">
  <tr>
    <td><form id="form1" name="form1" method="get">
      网址:
          <input name="url" type="text" value="<?php echo $url;?>" size="50"/>
		  <input name="do" type="hidden" value="start" />
		  <input name="action" type="hidden" value="<?php echo $action;?>" />
        <input type="submit" value="提交" /><br>
    (此功能可以把一个网址站的所有的网站收录下来)<font color="red">顶级域名请以"/"结尾</font>
    </form>
	<?php
	if($do=="start")
	{
	   ?>
	   <iframe src="insert_link.php?url=<?php echo $url;?>" width="100%" height="200"></iframe>
	   <?php
	
	}
	?>
    </td>
  </tr>
</table>
<?php
}
?>
<?php
function add_in_site_link($url)
{
     echo "正在处理中...<br>";
     print str_repeat(" ", 4096);
     ob_flush();
     flush();
     sleep(1);
     global $db;
	 $site=$db->get_one("select * from ve123_sites where url='".$url."'");
	 if($site["spider_depth"]==0)
	 {
	    Update_link($url);
		echo "更新完成";
	 }
	 elseif($site["spider_depth"]==1)
	 {
	     add_links_insite($url);
		 //echo $site["spider_depth"];
	 }
	 else
	 {
	    add_links_insite($url);
	    add_links_insite_fromtemp($url);
	 }
	 
}
function update_in_site_link()
{
     echo "正在处理中...<br>";
     print str_repeat(" ", 4096);
     ob_flush();
     flush();
     sleep(1);
     global $db;
	 $url=$_GET["url"];
	 Update_All_Link($url,0);
}
function add_all_site_link()
{
   global $db;
     echo "正在处理中...<br>";
     print str_repeat(" ", 4096);
     ob_flush();
     flush();
     sleep(1);
	 $query=$db->query("select * from ve123_sites where indexdate<='".(time()-(86400*10))."' order by site_id");
	 while($row=$db->fetch_array($query))
	 {
	      $db->query("update ve123_sites set indexdate='".time()."' where url='".$row["url"]."'");
	      echo "<br>正在处理网站".$row["url"]."<br>";
		  ob_flush();
          flush();
          sleep(1);
		  add_in_site_link($row["url"]);
	 }
}
function update_qp($url)
{
     global $db;
     $getqp=new getqp();
     $qp=$getqp->qp($url);
	 $array=array('qp'=>$qp);
	 $db->update("ve123_sites",$array,"url='".$url."'");
	 echo "&nbsp;&nbsp;<span style=\"width:250px;\">更新".$url."成功,值为:".$qp."</span>";
	 ob_flush();
     flush();
     sleep(1);
}
function update_all_qp($url,$qp='')
{
   global $db;
   if(empty($qp))
   {
       $sql="select * from ve123_sites where qp='".$qp."'";
   }
   else
   {
       $sql="select * from ve123_sites";
   }
   $query=$db->query($sql);
   while($row=$db->fetch_array($query))
   {
        update_qp($row["url"]);
   }
   
}
?>
<?php
$db->close();
?>
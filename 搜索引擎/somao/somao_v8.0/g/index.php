<?php
require "../global.php";
$action=HtmlReplace($_GET["action"]);
switch($action)
{
   case "savegbform":
   savegbform();
   break;
}
function savegbform()
{
    global $db;
	$title=Html2Text($_POST["title"]);
	$content=HtmlReplace($_POST["content"]);
	$fileurl=HtmlReplace($_POST["fileurl"]);
	$replyid=intval($_POST["replyid"]);
	if(empty($title)||empty($content))
	{
	    header("location:./");
	    exit();
	}
	else
	{
	  $array=array('title'=>$title,'content'=>$content,'fileurl'=>$fileurl,'replyid'=>$replyid,'addtime'=>time(),'ip'=>ip());
	  $db->insert("ve123_guestbook",$array);
	  header("location:./");
	}
}
?>
<html><head><meta http-equiv=content-type content="text/html;charset=gb2312">
<title>留言中心--<?php echo $config["name"].$config["adtitle"];?></title>
<style>
<!--
body{margin:0px;font-size:12px;font-family:Arial;line-height:180%}
a:link {color:#261cdc;text-decoration: underline}
a:visited {color: #261cdc; text-decoration: underline}
div,td{font-family: 宋体;font-size:12px; line-height:18px;}
.gray14{font-size:14px;}
.gray14 a:link{color:#261cdc;}
.gray14 a:hover{color:#261cdc;}
.gray14 a:visited{color:#800080;}
.p14{font-size:14px;}
img{border:0}
.b{border:1px solid #A1C0DC;margin-bottom:8px;}
.b a{text-decoration:none;}
.b a:hover{text-decoration:underline;}
.b1{padding:4px 0 4px 10px;}
.b2{padding:6px 5px 4px 10px;font-size:14px;line-height:150%}
.b2 img{border:1px solid #D0E3F2;}
.red {color: #FF0000}
.fenge{color:#CCC;background-color:#CCC;border:none;}
.au div{float:left;}
.au .shi{height:16px;*padding-top:2px;}
.au .auw{width:95px;height:18px;}
.au .uau{padding-top:2px;float:left;}
.au .uau2{padding-top:2px;float:right}
.gray12{color:#666666;}
.p{text-align:center;}
.reply{border:1px dashed #cccccc;padding:5px;color:#666666;margin:5px;}
-->
</style>
<script language="JavaScript">
function ResetReplyTitle(no, title) {
        document.gbform.title.value='回复' + no + '：' + title;	
		document.gbform.replyid.value=no;
		document.gbform.content.focus();
        return true;
}
function checkgbform()
{
   if(document.gbform.title.value=="")
   {
       alert("标题不能为空！");
       document.gbform.title.focus();
	   return false;
   }
    if(document.gbform.content.value=="")
   {
       alert("内容不能为空！");
       document.gbform.content.focus();
	   return false;
   }
}
</script>

<table width=910 border=0 align="center" cellpadding=0 cellspacing=0>
  <td height=3 bgcolor=005CCD></td>
</table>
<br>
<table width=910 border=0 align="center" cellpadding=0 cellspacing=0>
  <tr>
    <td width=175 rowspan=3><a href="<?php echo $config["url"]?>"><img src="<?php echo $config["url"]."/images/logo.gif";?>"></a></td>
    <td width=735 height=37 align=right valign=bottom style="font-size:14px;font-weight:bold;"><span class="b1"><a href="#write">给<?php echo $config["name"];?>留言</a></span></td>
  </tr>
  <tr>
    <td height=1 bgcolor=D0E3F2></td>
  </tr>
  <tr>
    <td height=13></td>
  </tr>
</table>
<br>
<table width=910 align="center" cellpadding=0 cellspacing=1 bgcolor=D0E3F2 style="margin-bottom:8px;">
  <td bgcolor=E6F4FF class=b1><a href="<?php echo $config["url"];?>"><?php echo $config["name"];?>首页</a>&nbsp;&gt;&nbsp;<a href="./">留言首页</a></td>
</table>
<table width=910 align="center" cellpadding=0 cellspacing=0 class=b>
  
  <tr>
    <td valign=top class=b2>
	<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<?php
	  $sql="select * from ve123_guestbook where replyid='0'";
	  $query=$db->query($sql);
	  $total=$db->num_rows($query);
	  $pagesize=10;
	  $totalpage=ceil($total/$pagesize);
	  $p=intval($_GET["p"]);
	  if($p<=0){$p=1;}
	  $offset=($p-1)*$pagesize;
	  $sql=$sql." order by addtime desc,reply_time desc limit $offset,$pagesize";
	  $query=$db->query($sql);//echo $sql;
	while($row=$db->fetch_array($query))
	{
	?>
      <tr>
        <td width="50" align="center"><?php echo $row["gid"];?></td>
        <td class="p14"><font color=#0000cc><a target="_blank" href="f/?kz=<?php echo $row["gid"];?>"><?php echo $row["title"];?></a></font></td>
      </tr>
	  <tr>
	    <td>&nbsp;</td>
	  <td class="gray14"><?php echo str_cut(str_replace("<br/>","",$row["content"]),200);?>
	  <?php
	     $row_reply=$db->get_one("select title from ve123_guestbook where replyid='".$row["gid"]."' order by gid desc limit 1");
		 if(!empty($row_reply))
		 {
		      echo "<div class=\"reply\">最新回复:".$row_reply["title"]."</div>";
		 }
	  ?>
	  </td>
	  </tr>
	  <tr>
	    <td></td>
	  <td height="10"></td>
	  </tr>
	  	  <tr>
	  	    <td class="au">&nbsp;</td>
	  <td class="au"><div class="uau">作者：
	  <?php
	  $reg = '/((?:\d+\.){3})\d+/';
	  echo preg_replace($reg, "\\1*", $row["ip"]);
	   ?>
	  </div>
	  <div class="uau2"><font class="gray12"><?php echo date("Y-m-d H:i",$row["addtime"]);?></font>　
     <a href="f/?kz=<?php echo $row["gid"];?>" class=t>查看</a>&nbsp;<a href="f/?kz=<?php echo $row["gid"];?>#reply" class=t>回复</a>&nbsp;</div></td>
	  </tr>
      <tr>
        <td>&nbsp;</td>
        <td><hr class="fenge" align=left width="100%" size=1 ></td>
      </tr>
	  <?php
	  }
	  ?>
    </table>
<div class="p">
<?php
require_once("../include/inc_page.php");
$page = new Page($totalpage,"?p=");
echo $page->show();
?>	
</div>	
	</td>
  </tr>
  <tr>
    <td valign=top class=b2>
	<a name="write" id="write"></a>
	<form id="gbform" name="gbform" method="post" action="?action=savegbform" onSubmit="return checkgbform();">
      <table width="80%" border="0" align="center" cellpadding="0" cellspacing="0">
        <tr>
          <td width="80">标题：</td>
          <td><input name="title" type="text" size="50" /></td>
        </tr>
        <tr>
          <td>内容：</td>
          <td><textarea name="content" cols="80" rows="10"></textarea>
            <span class="red">*</span></td>
        </tr>
		        <tr>
          <td>图片：</td>
          <td><input type="text" name="fileurl" style="width:310px" value=""></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td>
		  <input type="hidden" name="replyid" value="0">
		  <input type="submit" name="Submit" value="提交留言"/></td>
        </tr>
      </table>
        </form>
    </td>
  </tr>
</table>


</div>

<div align=center class="center blue" style="padding:18px 0px 18px 0px;">Copyright <?php echo $config["copyright"];?>&nbsp;&nbsp;</div>
</body></html>
<?php
require "../global.php";
require_once("global.func.php");
?>
<!--STATUS OK--><html><head>
<meta http-equiv="content-type" content="text/html;charset=gb2312">
<title><?php echo $config["name"];?>搜索_<?php echo $wd.$config["adtitle"];?>      </title>
<link rel="stylesheet" href="images/css.css" type="text/css">
<script language="javascript" src="global.js"></script></head>
<body link="#261CDC">
<table width="100%" height="54" align="center" cellpadding="0" cellspacing="0">
<tr valign=middle>
<td width="100%" valign="top" style="padding-left:8px;width:137px;" nowrap>
<a href="../"><img src="../images/logo-yy.gif" border="0" width="137" height="46" alt="到<?php echo $config["name"];?>首页"></a>
</td>
<td>&nbsp;&nbsp;&nbsp;</td>
<td width="100%" valign="top">
<div class="Tit"><?php
$cate_query=$db->query("select * from ve123_categories where parent_id='0' order by cate_id desc");
while($cate=$db->fetch_array($cate_query))
{
   echo "<a href=\"./?wd=".urlencode($cate["cate_title"])."&s=".$cate["cate_id"]."\" ".$nav_selected.">".$cate["cate_title"]."</a>";
   echo "&nbsp;&nbsp;&nbsp;";
}

?>
</div>
<table cellspacing="0" cellpadding="0">
<tr><td valign="top" nowrap><form name=f action="/s">
<input name=wd id=kw size="42" class="i" value="<?php echo $wd;?>" maxlength="100"> 
<input type=submit value=<?php echo $config["name"];?>找站>
<input type="hidden" name=s value="<?php echo $s;?>">
 <input type=button value=结果中找 onClick="return bq(document.forms[0],1,0);">&nbsp;&nbsp;&nbsp;</form></td>
<td valign="middle" nowrap>&nbsp;
<a href="<?php echo $config["url"]."/g/";?>">给<?php echo $config["name"];?>留言</a>
</td></tr></table>
</td>
<td></td>
</tr></form></table>

<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="bi">
<tr>
<td nowrap>&nbsp;&nbsp;&nbsp;<a onClick="h(this,'<?php echo $config["url"];?>')" href="#" style="color:#000000 ">把<?php echo $config["name"];?>设为主页</a></td>
<td align="right" nowrap>&nbsp;</td>
</tr>
</table>
<?php
RightAd();
?>
<?php
	  $query_s=$db->query("select * from ve123_links where title<>'' order by updatetime desc limit 20");
	  while($row=$db->fetch_array($query_s))
	  {
?>
<table border="0" cellpadding="0" cellspacing="0" id="1"><tr><td class=f>
<a onMouseDown="return ss('<?php echo $row["url"];?>')" onMouseOver="return ss('<?php echo $row["url"];?>')" onMouseOut="cs()" href="<?php echo $site["url"];?>/q/?<?php echo $row["link_id"];?>_<?php echo $wd_en;?>" target="_blank"><font size="3"><?php echo str_cut($row["title"],60);?></font></a><br><font size=-1><?php echo replace_filter_word(str_cut($row["fulltxt"],250));?><br><font color=#008000><?php echo str_cut($row["url"],50);?> <?php echo $row["pagesize"];?>K <?php echo date("Y-m-d",$row["updatetime"])?>  </font>
 - <a href="<?php echo $config["url"]."/k/?".base64_encode("url=".$row["url"]."&wd=".$wd_split."");?>" target="_blank" class=m><?php echo $config["name"];?>快照</a>
  <br></font></td></tr></table><br />
	<?php
	  }
	  ?>
<?php
foothtml();
$db->close();
?>
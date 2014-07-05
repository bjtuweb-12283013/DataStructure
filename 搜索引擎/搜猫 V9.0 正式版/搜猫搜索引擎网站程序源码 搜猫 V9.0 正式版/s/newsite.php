<?php
require "../global.php";
require_once("global.func.php");
?>
<!--STATUS OK--><html><head>
<meta http-equiv="content-type" content="text/html;charset=gb2312">
<title><?php echo $config["name"];?>搜索_<?php echo $wd.$config["adtitle"];?>      </title>
<link rel="stylesheet" href="images/css.css" type="text/css">
<link rel="stylesheet" href="images/style.css" type="text/css">
<script language="javascript" src="global.js"></script>
<style type="text/css">
<!--
.STYLE2 {font-size: 13px}
.STYLE3 {font-size: 14px;
	font-family: Arial, Helvetica, sans-serif;
}
#sc {
	MARGIN: 0px; WIDTH: 500px}
#s {
	POSITION: relative
}
#s {
	BACKGROUND: url(../images/soso_sp.png) no-repeat
}
#s_input {
	BACKGROUND: url(../images/soso_sp.png) no-repeat
}
#s_button {
	BACKGROUND: url(../images/soso_sp.png) no-repeat
}
#s {
	BACKGROUND-POSITION: -85px 0px; PADDING-LEFT: 3px; MARGIN-BOTTOM: 0px; HEIGHT: 36px
}
#s_input {
	BORDER-TOP-WIDTH: 0px; PADDING-RIGHT: 5px; BACKGROUND-POSITION: -85px -36px; PADDING-LEFT: 5px; BORDER-LEFT-WIDTH: 0px; FLOAT: left; BORDER-BOTTOM-WIDTH: 0px; PADDING-BOTTOM: 4px; FONT: 16px Arial; WIDTH: 402px; PADDING-TOP: 10px; BACKGROUND-REPEAT: repeat-x; HEIGHT: 36px; BORDER-RIGHT-WIDTH: 0px
}
#s_button {
	BORDER-TOP-WIDTH: 0px; BACKGROUND-POSITION: 0px 0px; BORDER-LEFT-WIDTH: 0px; FLOAT: left; BORDER-BOTTOM-WIDTH: 0px; WIDTH: 85px; CURSOR: pointer; TEXT-INDENT: -9999px; HEIGHT: 36px; BORDER-RIGHT-WIDTH: 0px
}
#topmenu {height:25px;line-height:25px;border-bottom:1px solid #E4EDF9;text-align:left;padding-left:10px;}
-->
</style>
</head>
<body link="#261CDC" style="background-image: url('../skin.gif')">
<div id="topmenu"><span class="qiaso_msg STYLE3" style="float:right;padding-right:10px;"><a href="search/url_submit.php" target="_blank" class="STYLE2"></a></span><span class="Tit">
  <?php
$cate_query=$db->query("select * from ve123_categories where parent_id='0' order by sort_id asc");
$is_do=true;
while($cate=$db->fetch_array($cate_query))
{
   $is_select=false;
   if($is_do)
   {
      if(!empty($s))
      {
         if($cate["cate_id"]==$s)
	    	{
		      $is_select=true;
		   }
      }
      else
      {
	      if(in_array($wd,$nav_cate_array[$cate["cate_id"]]))
          $is_select=true;
      }
   }
   if($is_select)
   {
	  $nav_selected="class=\"nav_selected\"";
	  $is_do=false;
	  $s=$cate["cate_id"];
	  $select_cate_id=array_keys($nav_cate_array[$cate["cate_id"]],$wd);
	  $select_cate_id=$select_cate_id[0];
	  //echo $select_cate_id;
   }
   else
   {
      $nav_selected="";
   }
   if(empty($cate["cate_url"]))
    {
       echo "<a href=\"../s?wd=".urlencode($cate["cate_title"])."&s=".$cate["cate_id"]."\" ".$nav_selected."><font color=\"#3366CC\">".$cate["cate_title"]."</a>";
    }
	else
	{
	   echo "<a href=\"".$cate["cate_url"]."=".urlencode($cate["cate_title"])."\" ".$nav_selected.">".$cate["cate_title"]."</a>";
	}
    echo "&nbsp;&nbsp;&nbsp;";

}
//echo "<a href=\"../tieba/f?kw=".urlencode($wd)."\">贴吧</a>"; 
//
if(!stristr($wd,"site:")&&!stristr($wd,"http://"))
{
      $row=$db->get_one("select keyword from ve123_search_keyword where keyword='".$wd."'");
      if(empty($row))
      {
          $array=array('keyword'=>$wd,'s'=>$s,'hits'=>'1','lasttime'=>time());
      	$db->insert("ve123_search_keyword",$array);
      }
	  else
	  {
	     // $array=array('lasttime'=>time(),'hits'=>hits+1);
		 // $db->update("ve123_search_keyword",$array,"keyword='".$wd."'");
		 @$db->query("update ve123_search_keyword set lasttime='".time()."',hits=hits+1 where keyword='".$wd."'");
	  }
}
?>
</span></div>
<table width="100%" height="54" align="center" cellpadding="0" cellspacing="0">
<tr valign=middle>
<td><table width="100%" height="65" align="center" cellpadding="0" cellspacing="0">
  <tr valign=middle>
    <td width="208" valign="top" style="padding-left:8px;width:137px;" nowrap><a href="../"><img src="../images/logo.gif" border="0" width="137" height="46" alt="到<?php echo $config["name"];?>首页"></a></td>
    <td width="1100" valign="middle"><table width="702" cellpadding="0" cellspacing="0">
      <tr>
        <td width="700" nowrap><form name=f action="/s">
          <input name=wd id=kw size="42" class="i" style="height:29px" value="<?php echo $wd;?>" maxlength="100">
          <input name="submit2" type=submit style="height:29px" value=<?php echo $config["name"];?>一下>
          &nbsp;&nbsp;&nbsp;
        </form></td>
      </tr>
    </table></td>
    <td width="1"></td>
  </tr>
  </form>
</table></td>
</tr></table>

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
<OL id=list>
  <LI>
  <DIV class=pimg>
    <div align="left"><a href="<?php echo str_cut($row["url"],50);?>" target="_blank" title="<?php echo str_cut($row["title"],60);?>"><img src=" http://open.thumbshots.org/image.aspx?url=<?php echo str_cut($row["url"],50);?>" width="120" height="90" /></A></div>
  </DIV>
 <a onMouseDown="return ss('<?php echo $row["url"];?>')" onMouseOver="return ss('<?php echo $row["url"];?>')" onMouseOut="cs()" href="<?php echo $row["url"]?>" target="_blank" title="<?php echo str_cut($row["title"],60);?>"><font size="3" color=\"#3366CC\"><?php echo str_cut($row["title"],60);?></font></a><br>
  </H2>
  <DIV class=dig>
    
      <div align="left">
        <font size=-1>
        <?php
if(empty($link["description"]))
{
   echo replace_filter_word(str_cut($row["fulltxt"],240));
}
else
{
   echo replace_filter_word(str_cut($row["description"],240));
}
 ?>
        </div>
  </DIV>
  <P align="left"><img width=66 height=13 alt="该网站的流行指数" class=primg src="../pr/pr.php?<?php echo str_cut($row["url"],50);?>" />&nbsp;<font color=#008000><?php echo str_cut($row["url"],50);?> <?php echo $row["pagesize"];?>K <?php echo date("Y-m-d",$row["updatetime"])?></font> - <a href="<?php echo $config["url"]."/k/?".base64_encode("url=".$row["url"]."&wd=".$wd_split."");?>" target="_blank" class=m><?php echo $config["name"];?>快照</a>
  </LI>
    </OL>
</td></tr></table><br />
<?php
	  }
	  ?>
<?php
foothtml();
$db->close();
?>

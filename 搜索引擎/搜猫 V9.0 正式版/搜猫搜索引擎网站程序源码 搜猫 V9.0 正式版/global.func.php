<?php
function RightAd()
{
    global $db,$wd,$wd_en,$tg;
?>
<style type="text/css">
<!--
a:link {
	color: #00c;
	text-decoration: underline;
}
body,td,th {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 10pt;
}
.STYLE8 {font-size: 16px}
.STYLE12 {font-size: 10pt}
-->
</style>
<link type="text/css" href="images/style.css" rel="stylesheet" />
<link type="text/css" href="images/page.css" rel="stylesheet" />
<style type="text/css">
<!--
.STYLE27 {color: #00c}
-->
</style>

<table width="30%" border="0" cellpadding="0" cellspacing="0" align="right">
  <tr align="left">
<td style="padding-right:10px">
<div style="border-left:1px solid #e1e1e1;padding-left:10px;word-break:break-all;word-wrap:break-word;">
<?php echo file_get_contents("../tg/html/$wd.html");?>
<?php
/*
echo "<div style=\"line-height:25px;\">";
foreach($tg as $t)
{
    $file_fix=substr($t["pic"],strrpos($t["pic"],"."));
	  if(in_array($file_fix,array(".gif",".jpg",".png")))
	  {
	     $pic_code="<img src=\"".$t["pic"]."\">";
	  }
	  elseif($file_fix==".swf")
	  {
	     $pic_code="<embed src=\"".$t["pic"]."\"></embed>";
	  }
	  else
	  {
	     $pic_code="<embed src=\"".$t["pic"]."\"></embed>";
	  }
    echo $pic_code."<br><br><a target=\"_blank\" href=\"".$t["url"]."\"><font size=3>".$t["title2"]."</font></a><br><font style=\"color:#666666;width:250px;\">".$t["txt2"]."</font>";
}
echo "</div><br><br>";
*/
?>
<div id="ec_im_container">
<?php
$GetAdKeywordSql=GetAdKeywordSql();
	   if(empty($GetAdKeywordSql))
	   {
	       $GetAdKeywordSql="title like '%".$wd."%'";
	   }
$query_ad=$db->query("select * from ve123_ad where ".$GetAdKeywordSql." and type='2' and is_show limit 5");
$num=$db->num_rows($query_ad);
if($num<1)
{
   $query_ad=$db->query("select * from ve123_ad where type='2' and is_show limit 5");
}
while($row_ad=$db->fetch_array($query_ad))
{
?>
<div class="r" id="bdfs0">

<span class="STYLE8"><a href='<?php echo $row_ad["siteurl"];?>' target='_blank' class="STYLE8 STYLE8" id=dfs0 onMouseOver="return ss('链接至 <?php echo $row_ad["siteurl"];?>')" onMouseOut="cs()">
<u><?php echo $row_ad["title"];?></u></a></span></span><br>

<span id="bdfs0"><span class="STYLE12"><font color="#000000"><?php echo $row_ad["content"];?></font></span></span></div>
<br>
<?php
}
?>
</div>
<DIV id=ScriptDiv></DIV>
</div></td>
</tr></table>
<?php
}//end RightAd
?>
<?php
function foothtml()
{
   global $config;
?>
<div id="ft"><?php echo $config["copyright"];?> <span>此内容系<?php echo $config["name"];?>根据您的指令自动搜索的结果，不代表<?php echo $config["name"];?>赞成被搜索网站的内容或立场</span></div>
<script>
c({'fm':'se','T':'1240722096','y':'7B7F7FDF'});
</script>
</body>
</html>
<script>
if(navigator.cookieEnabled && !/sug?=0/.test(document.cookie)){document.write('<script src=../js/bdsug.js?v=1.1.0.1><\/script>')};
window.onunload=function(){};
</script><script>document.forms[0].reset();</script></html>
<div id="statcode"><?php echo $config["statcode"];?></div>
<?php
}//end foothtml
?>
<?php
	function GetAdKeywordSql()
	{global $wd_array;
	if(empty($wd_array))
	{return;}
		//$ks = explode(' ',$this->Keywords);
		$ks=$wd_array;
		$kwsql = '';
		$kwsqls = array();
		foreach($ks as $k)
		{
			$k = trim($k);
			if(strlen($k)<2)
			{
				continue;
			}
			if(ord($k[0])>0x80 && strlen($k)<0)
			{
				continue;
			}
			$k = addslashes($k);
			//if($this->SearchType=="title")
			//if(false)
			//{
			//	$kwsqls[] = " arc.title like '%$k%' ";
		//	}
		//	else
		//	{
				$kwsqls[] = " CONCAT(title) like '%$k%' ";
		//	}
		}
		if(!isset($kwsqls[0]))
		{
			return '';
		}
		else
		{

			//if($this->KType==1)
			//if(1)
			//{
				$kwsql = join(' OR ',$kwsqls);
		//	}
		//	else
		//	{
			//	$kwsql = join(' And ',$kwsqls);
		//	}
			return $kwsql;
		}
	}
?>
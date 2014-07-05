<?php
function RightAd()
{
    global $db,$wd,$wd_en,$tg;
?>
<table width="30%" border="0" cellpadding="0" cellspacing="0" align="right"><tr>
<td align="left" style="padding-right:10px">
<div style="border-left:1px solid #e1e1e1;padding-left:10px;word-break:break-all;word-wrap:break-word;">
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

<a id=dfs0 href='<?php echo $row_ad["siteurl"];?>' target='_blank' onMouseOver="return ss('链接至 <?php echo $config["name"];?>')" onMouseOut="cs()">

<font size="3"><?php echo $row_ad["title"];?></font>

</a><br>

<span id="bdfs0"><font size="-1" color="#000000"><?php echo $row_ad["content"];?></font><br><font size="-1" color="#008000"><?php echo  str_cut($row_ad["siteurl"],38);?></font></span>

</div><br>
<?php
}
?>
</div>
<div style="line-height:25px;">
<?php
$query_ad=$db->query("select * from ve123_ad where type='1' and is_show limit 5");
while($row_ad=$db->fetch_array($query_ad))
{
?>
<a href='<?php echo str_replace("{zeidu:keyword}",$wd_en,$row_ad["siteurl"]);?>' target='_blank'><?php echo str_replace("{zeidu:keyword}","<font color=#C60A00>".str_cut($wd,20)."</font>",$row_ad["title"]);?></a><br>
<?php
}
?>
</div>


<table border=0 cellpadding=0 cellspacing=0  style="width:240px;border-left: #EFF2FA 1px solid; border-right: #EFF2FA 1px solid;border-bottom: #EFF2FA 1px solid; font-size: 12px; color: #333333;background-color: #EFF2FA;"><tr><td style="table-layout:fixed;word-break:break-all;border-top: #7593E5 1px solid;background-color: #EFF2FA;padding-left:10px;line-height:24px;">
<!--<a href="#" target=_blank><font style="font-size:9pt">发布/查看关于<font color="#C60A00"><?php echo str_cut($wd,20);?></font>留言</font></a>-->
&nbsp;</td>
</tr></table>
<DIV id=ScriptDiv></DIV>
</div>
</td></tr></table>

<?php
}//end RightAd
?>
<?php
function foothtml()
{
   global $config;
?>
<div id="ft"><?php echo $config["copyright"];?> <span>此内容系<?php echo $config["name"];?>根据您的指令自动搜索的结果，不代表<?php echo $config["name"];?>赞成被搜索网站的内容或立场&nbsp;
Powered by <a target="_blank" href="http://lin0613.v16.19821122.com/">Feimao</a>
</span></div>
<script>
c({'fm':'se','T':'1240722096','y':'7B7F7FDF'});
</script>
</body>
</html>
<script>
if(navigator.cookieEnabled && !/sug?=0/.test(document.cookie)){document.write('<script src=http://www.baidu.com/js/bdsug.js?v=1.1.0.1><\/script>')};
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
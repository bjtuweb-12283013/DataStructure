<?php
function RightAd()
{
    global $db,$wd,$wd_en,$tg;
?>
<style type="text/css">
<!--
a:link {
	color: #3366CC;
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
.STYLE26 {color: #3366CC}
-->
</style>
<table width="32%" border="0" cellpadding="0" cellspacing="0" align="right">
  <tr align="left">
<td width="100%" style="padding-right:10px"><dt id="his" style="padding-top:0; border:0;"></dt>
<div id="ec_im_container">
<div align="left" style="padding-left:1px; padding-right:50px;">
<?php echo file_get_contents("../tg/html/$wd.html");?>
</div>
<div style="line-height:25px;">
  <p class="STYLE12">&nbsp;</p>
  <p class="STYLE12"><span class="STYLE12" style="line-height:25px;">
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
  </span></p>
  <span class="STYLE12"><span class="STYLE12" style="line-height:25px;">
  <div class="r" id="bdfs0"><span class="STYLE8">
    <p><a href='<?php echo $row_ad["siteurl"];?>' target='_blank' class="STYLE8 STYLE8" id=dfs0 onmouseover="return ss('链接至 <?php echo $row_ad["siteurl"];?>')" onmouseout="cs()"><u><?php echo $row_ad["title"];?></u></a><br>
      
            <span id="bdfs0"><span class="STYLE12"><font color="#000000"><?php echo $row_ad["content"];?></font></span></span></p>
    <p><span><br>
    </span></p>
  </div>
  </span></span><span style="line-height:25px;"><span style="padding-top:0; border:0;"><img src="images/co.gif" width="21" height="15" alt="推荐" /> <strong>热门搜索</strong></span></span><span class="STYLE12"><span class="STYLE12" style="line-height:25px;"><br>
  <?php
}
?>

      <?php
$query_ad=$db->query("select * from ve123_ad where type='1' and is_show limit 10");
while($row_ad=$db->fetch_array($query_ad))
{
?>
    </span><a href='<?php echo str_replace("{somao:keyword}",$wd_en,$row_ad["siteurl"]);?>' target='_blank' style="text-decoration:underline;"><?php echo str_replace("{somao:keyword}","<font color=#C60A00>".str_cut($wd,20)."</font>",$row_ad["title"]);?></a><br>
    <?php
}
?>
  </span></div>
<DIV id=ScriptDiv></DIV></td>
</tr></table>
<?php
}//end RightAd
?>
<?php
function foothtml()
{
   global $config;
?>
<div id="ft"><?php echo $config["copyright"];?> <span>此内容系<?php echo $config["name"];?>根据您的指令自动搜索的结果，不代表<?php echo $config["name"];?>赞成被搜索网站的内容或立场&nbsp;
Powered by <a target="_blank" href="<?php echo $config["url"];?>"><?php echo $config["name"];?></a><span class="STYLE26">搜索引擎</span></span></div>
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
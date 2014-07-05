<?php
require_once("../global.php");
$dh_config=$db->get_one("select * from ve123_dh_siteconfig limit 1");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title><?php echo $dh_config["name"].$dh_config["adtitle"];?></title>
<style type="text/css">
<!--
td,body,div{font:14px 宋体}
body{background:#fcfff7;margin-top:2px;}
img{border:0}
a:link, a:visited{color:#000;text-decoration:none}
a:active{color:green;text-decoration:none}
a:hover{color:red;text-decoration:underline}
#TbM{}
.ry{background:#FFF8F0}
.rb{background:#F0F7FF}
#TbM td{border:0;font-size:13px;line-height:25px!important;line-height:25px}
#TbM .link_list{padding-left:10px;}
#TbM td.classname{width:64px;text-align:center;}
#TbM td.classname a{color:#874604}
#TbM td.classname a:hover{color:red}
#all{width:950px;margin:0 auto;}
#left{border:1px solid #7BD676;width:220px;background:url(images/line.gif);}
#footer{border:1px solid #7BD676;margin-top:5px;}
.paplfont {color:#3DB836; font-weight:600;line-height:30px;clear:both;padding-left:8px;}
.showlink{line-height:25px;}
.showlink a{float:left;padding-left:5px;text-indent:3px;white-space: nowrap;width:29%;}
#main_r1{border:1px solid #7BD676;}
#main_r2{border:1px solid #7BD676;margin-top:3px;}
.title{background:#B3F1B0;line-height:25px;padding-left:10px;font-weight:bold;}
.ft18 {font-size:14px}
#footsearch{background:#F0F7FF;}
#lailu{border:1px solid #7BD676;margin-bottom:3px;}
#banner{height:60px;margin-bottom:3px;}
#banner_1,#banner_3{border:1px solid #7BD676;background:#DDFADC;padding:5px;font-size:13px;line-height:20px;}
#l {margin:0 0 5px 15px}
#search{border:1px solid #7BD676;background:url(images/line.gif);margin-bottom:3px;height:45px;}
#tags {
	height:25px;
	margin-top:3px;
	margin-left:100px;
	padding-top: 0;
	padding-right: 14px;
	padding-bottom: 0;
	padding-left: 14px;
}
#tags li { float:left; width:67px; height:25px; background:url(cline.png) no-repeat right center; position:relative ;list-style:none;}
#tags li a { float:left; width:67px; text-align:center; line-height:25px }
#tags li a:hover { text-decoration:none }
#tags li a.focu { position:absolute; width:68px; height:30px; top:0; left:-1px; background:url(images/tag.png) no-repeat center; color:#FFF; font-weight:bold }
#searchform{margin-left:30px;margin-top:8px;}
#kw{font:16px Verdana;height:22px;line-height:25px;}
#sb{height:30px;width:7em}
#footlink a{color:#3DB836;}
-->
</style>
<script language="javascript" type="text/javascript">
function selectTag(showContent,wd,cate_id,selfObj){
	var tag = document.getElementById("tags").getElementsByTagName("a");
	var taglength = tag.length;
	for(i=0; i<taglength; i++){
		tag[i].className = "";
	}
	selfObj.className = "focu";
	
	document.f.wd.focus();
	document.f.wd.value=wd;
	document.f.s.value=cate_id;
	f.attributes[83].value=showContent;
	//document.f.action=showContent;

}
</script>
</head>

<body onMouseOut="window.status='<?php echo $dh_config["status_content"];?>';return true">
<div id="all">
  <table width="100%" border="0" cellspacing="0" cellpadding="0" id="header">
    <tr>
      <td width="170"><a href="./"><img src="images/logo.gif" border="0"></a></td>
      <td valign="top">
	  <div style="border:1px solid #DAE9F7;background:#F0F7FF;height:26px;line-height:26px;padding-right:8px;margin-left:8px;">
	  <span style="text-align:left;float:left;">&nbsp;&nbsp;<a target="_blank" href="<?php echo $config["url"];?>"><img src="images/index.gif" border="0">&nbsp;<?php echo $config["name"];?>首页</a>&nbsp;&nbsp;<a target="_blank" href="<?php echo $config["url"]."/s/newsite.php";?>"><img src="images/iconew.gif" border="0">&nbsp;最新收录</a></span>
	  <span style="text-align:left;float:right;">
	  <span id="DateTime"></span>&nbsp;&nbsp;
	  <script> 
         setInterval("DateTime.innerHTML=new Date().toLocaleString()+' 星期'+'日一二三四五六'.charAt(new Date().getDay());",1000);
      </script>
	  <a href="<?php echo $config["url"]."/site/"?>" onClick="this.style.behavior='url(#default#homepage)';this.setHomePage('<?php echo $config["url"]."/site/"?>');return(false);" style="behavior: url(#default#homepage)"><img src=images/home.gif border="0" align="absmiddle"> 设为主页</a></span></div>
	  <div style="line-height:26px;text-align:right;padding-right:8px;margin-left:8px;margin-top:5px;clear:both;">
	  <marquee height="100%" scrollamount="6" scrolldelay="120" onmouseover="javascript:this.stop()"   onmouseout="javascript:this.start()">
	  <?php echo $dh_config["notice"];?>
	  </marquee>
	  </div>
	  </td>
    </tr>
    <tr height="4">
      <td></td>
      <td></td>
    </tr>
    <tr bgcolor="7FD479" height="4">
      <td></td>
      <td></td>
    </tr>
  </table>
  <div id="tags">
			  <li><a href="javascript:void(0)" class="focu" onclick="selectTag('s','网页','',this)">网页</a></li><?php
$cate_query=$db->query("select * from ve123_categories where parent_id='0' order by cate_id desc");
while($cate=$db->fetch_array($cate_query))
{
   echo "<li><a href=\"javascript:void(0)\" onClick=\"selectTag('s','".$cate["cate_title"]."','".$cate["cate_id"]."',this)\">".$cate["cate_title"]."</a></li>";
}
?></div>
<div id="search">
	  <div id="searchform">
<form name=f action=<?php echo $config["url"];?>/s><img src="images/search_logo.gif" />&nbsp;&nbsp;<input name=wd type=text id=kw value="" size=55 maxlength=100> 
<input type=submit value=<?php echo $config["name"];?>一下 id=sb>
</form>
	  </div>
</div>
  <table width="100%" border="0" cellspacing="0" cellpadding="0" id="banner">
    <tr>
      <td width="160" id="banner_1">
	  <?php
	  $row=$db->get_one("select count(site_id) as num from ve123_sites");
	  echo "已收录网站:".$row["num"]."<br>";
	  $row=$db->get_one("select count(link_id) as num from ve123_links where title<>''");
	  echo "已收录网页:".$row["num"];
	  ?>
	  </td>
      <td width="10">&nbsp;</td>
      <td align="center" id="banner_2"><img src="images/xiangmu2.jpg" />&nbsp;<img src="images/zol.gif" /></td>
      <td width="10">&nbsp;</td>
      <td width="160" id="banner_3">
	  <a target="_blank" href="<?php echo $config["url"]."/search/url_submit.php";?>">·提交你的网站</a><br>
	  <a target="_blank" href="<?php echo $config["url"]."/g/";?>">·给<?php echo $config["name"];?>留言</a><br>
	   <a target="_blank" href="<?php echo $config["url"]."/top/";?>">·搜索风云榜</a>
	  </td>
    </tr>
  </table>
  <table width="100%" border="0" cellspacing="0" cellpadding="0" id="lailu">
    <tr>
      <td class="title"><span style="float:left;">来路显示</span><span style="float:right;font-size:12px;font-weight:200">做上本站的链接,并从你站点击一次,搜索蜘蛛程序将自动收你的网站.从你站来的ip越多.搜索排名越靠前!本站链接网址:<?php echo $config["url"];?>&nbsp;</span></td>
    </tr>
    <tr>
      <td><table width="100%" border="0" cellspacing="0" cellpadding="8">
        <tr>
		<?php
		$j=0;
		$query=$db->query("select * from ve123_sites order by com_time desc limit 12");
		while($site=$db->fetch_array($query))
		{
		     $link=$db->get_one("select * from ve123_links where url='".$site["url"]."'");
			 if(!empty($link["title"]))
			 {
			     $j++;
			     echo "<td><a target=\"_blank\" href=\"".$link["url"]."\" title=\"".$link["title"]."\">".str_cut($link["title"],30,"")."</a></td>";
			 }
		 
		    if($j%4==0){echo "</tr>";}
		}
		?>
        </tr>
      </table></td>
    </tr>
  </table>
  <table width="100%" border="0" cellspacing="0" cellpadding="0" id="main">
    <tr>
      <td valign="top" id="left">
	  <div class="cate">
	  <?php
	  $parent_query=$db->query("select * from ve123_categories where parent_id='0'");
	  while($parent=$db->fetch_array($parent_query))
	  {
	      echo "<a target=\"_blank\" href=".$config["url"]."/s/?wd=".urlencode($parent["cate_title"])."><font class=\"paplfont\">".$parent["cate_title"]."</font></a><div class=\"showlink\">";
		  $cate_query=$db->query("select * from ve123_categories where parent_id='".$parent["cate_id"]."'");
		  while($cate=$db->fetch_array($cate_query))
		  {
		       echo "<a target=\"_blank\" href=\"".$config["url"]."/s/?wd=".urlencode($cate["cate_title"])."\">".$cate["cate_title"]."</a>";
		  }
		  echo "</div>";
	  }
	  ?></div>

	  </td>
      <td width="5">&nbsp;</td>
      <td valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0" id="main_r1">
        <tr>
          <td class="title">名站导航</td>
        </tr>
        <tr>
          <td><table width="95%" border="0" align="right" cellpadding="5" cellspacing="0">
            <tr>
			<?php
			$query=$db->query("select * from ve123_dh_goodlinks");
			$j=0;
			while($good=$db->fetch_array($query))
			{$j++;
			?>
              <td><?php echo "<a target=\"_blank\" href=\"".$good["url"]."\">".$good["title"];?></a></td>
			 <?php
			 if($j%5==0){echo "</tr>";}
			 }
			 ?>
            </tr>
          </table></td>
        </tr>
      </table>
        <table width="100%" border="0" cellspacing="0" cellpadding="0" id="main_r2">
          <tr>
            <td class="title">分类导航</td>
          </tr>
          <tr>
            <td><table width="100%" border="0" cellspacing="1" cellpadding="0" id="TbM">
			<?php
			$class_query=$db->query("select * from ve123_dh_class where type_id='1'");
			$j=0;
			while($class=$db->fetch_array($class_query))
			{$j++;
			     if($j%2==0)
				 {$trclass="ry";}else{$trclass="rb";}
			?>
              <tr class="<?php echo $trclass;?>">
                <td width="50" class="classname"><?php echo "<a target=\"_blank\" href=\"".$config["url"]."/s/?wd=".urlencode($class["classname"])."\">".$class["classname"]."</a>";?></td>
                <td class="link_list">
				<?php
				$link_query=$db->query("select * from ve123_dh_links where class_id='".$class["class_id"]."'");
				while($link=$db->fetch_array($link_query))
				{
				    echo "<a target=\"_blank\" href=\"".$link["url"]."\">".$link["title"]."</a>&nbsp;&nbsp;&nbsp;&nbsp;";
				}
				?>
				</td>
                <td width="50" align="center"><?php echo "<a target=\"_blank\" href=\"".$config["url"]."/s/?wd=".urlencode($class["classname"])."\">更多&nbsp;&raquo;</a>";?></td>
              </tr>
			<?php
			}
			?>  
            </table></td>
          </tr>
        </table></td>
    </tr>
  </table>
  <table width="100%" border="0" cellspacing="0" cellpadding="0" id="footer">
    <tr>
      <td><table width="100%" border="0" cellspacing="0" cellpadding="6" id="footlink">
	  <?php
	  $class_query=$db->query("select * from ve123_dh_class where type_id='2'");
	  while($class=$db->fetch_array($class_query))
	  {
	  ?>
        <tr>
          <td width="80"><b><?php echo "<a target=\"_blank\" href=\"".$config["url"]."/s/?wd=".urlencode($class["classname"])."\">".$class["classname"]."：</a>";?></b></td>
          <td>
		  <?php
		      $link_query=$db->query("select * from ve123_dh_links where class_id='".$class["class_id"]."'");
			  while($link=$db->fetch_array($link_query))
			  {
			      echo "<a target=\"_blank\" href=\"".$link["url"]."\">".$link["title"]."</a>&nbsp;&nbsp;";
			  }
		  ?>
		  </td>
          <td width="50"><?php echo "<a target=\"_blank\" href=\"".$config["url"]."/s/?wd=".urlencode($class["classname"])."\">更多&nbsp;&raquo;</a>";?></td>
        </tr>
	<?php
	}
	?>	
      </table>
        <table width="100%" border="0"  cellpadding="0" cellspacing="0" id="footsearch">
          <form name="form1" id="form1" method="get" action="<?php echo $config["url"];?>/s/" onsubmit="" target="_blank">
            <tr>
              <td align="center" >&nbsp;</td>
              <td>&nbsp;</td>
              <td class="radioSearch">&nbsp;</td>
            </tr>
            <tr>
              <td width="80" align="center" >关键字</td>
              <td>
                  <input type="text" name="wd" size="33" onmouseover="this.focus()" onfocus="this.select()" style=" font-size:16px;height:25px;line-height:25px;font-family:arial,sans-serif,宋体; " />
                &nbsp;
                <input type="submit" style="height:32px;width:6.4em;font-size:16px;vertical-align:bottom" value="<?php echo $config["name"];?>一下"/></td>
              <td class="radioSearch">&nbsp;&nbsp;</td>
            </tr>
            <tr>
              <td align="center" >&nbsp;</td>
              <td>&nbsp;</td>
              <td class="radioSearch">&nbsp;</td>
            </tr>
          </form>
        </table>
      </td>
    </tr>
  </table>
</div>
</body>
</html>
<div style="display:none;"><?php echo $dh_config["statcode"];?></div>
<?php
$db->close();
?>
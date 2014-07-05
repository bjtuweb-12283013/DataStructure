<?php
require_once("../global.php");
$s=intval($_GET["s"]);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv=Content-Type content="text/html;charset=gb2312">
<title><?php echo $config["name"];?>—搜索风云榜</title>
<style>
	body,div,h2,h3,a,ul,li,dl,dt,dd,form,td{margin:0;padding:0;}
	body{font-size:12px;font-family:Arial,"宋体",Helvetica,sans-serif;color:#666;padding-bottom: 20px;}
	a{text-decoration:none;color:#666;}
	a:hover{text-decoration:underline;}
	a.more{background:url(images/r.gif) right center no-repeat;padding-right:7px;line-height:22px;}
	a img{border:none;}
#all{width:984px;margin:0 auto;}
    .clear{clear:both;height:0;font-size:0;overflow:hidden;}
	td a{color:#36c;padding-left:20px;}
	#menu{height:33px;background:#203fa0 url(images/menu_bg.gif) left top repeat-x;position:relative;}
	#menu div{background:url(images/menu_bg_l.gif) left top no-repeat;height:100%;padding-left:25px;}
	#menu a{display:block;float:left;height:33px;line-height:33px;font-size:14px;font-weight:bold;color:#fff;margin-right:15px;padding-left:5px;}
	#menu a span{display:block;padding-right:5px;height:100%;cursor:pointer;float:left;}
	#menu a.on,#menu a:hover{background:url(images/menu_bg_on.gif) top left no-repeat;text-decoration: none;}
	#menu a.on span,#menu a:hover span{background:url(images/menu_bg_on.gif) top right no-repeat;}
	#menu b{display:block;width:2px;height:33px;float:left;background:url(images/menu_split.gif);margin-right:15px;}
	#menu form{position:absolute;right:10px;top:5px;}
	#s{height:65px;text-align:right;position:relative;margin-bottom:8px;overflow:hidden;}
	#s div{position:absolute;right:0;bottom:0;}
	#s img{vertical-align:middle;}
	#s a#logo{position:absolute;left:0;bottom:0;}
	#s a#old_link{padding-left:15px;background:url(images/old.gif) left center no-repeat;margin-left: 20px;text-decoration: underline;}
	
	#m{background:url(images/news_bg.gif) left top repeat-x;}
	#ml{width:600px;float:left;}
	#mr{width:364px;float:right;background:url(images/combg.gif) left top repeat-y;padding-bottom:10px;}
	
	.nocom{margin-top:10px;}
	.nocom .tabs{height:24px;padding-top:5px;line-height:24px;background:#e9e9f5;border-bottom:1px solid #d9d9d9;overflow:visible;position:relative;}
	.nocom .tabs strong{display:block;width:110px;float:left;color:#484848;margin-left:10px;font-size:16px;font-family:"黑体";font-weight:normal;}
	.nocom .tabs img{position:absolute;top:7px;right:7px;height:15px;width:36px;}
	.nocom .tabs ul{height:24px;position:absolute;top:5px;left:100px}
	.nocom .tabs ul li{float:left;height:23px;border-top:1px solid #e9e9f5;list-style:none;padding:0 10px;background:url(/static/img/split1.gif) left top no-repeat;}
	.nocom .tabs ul li.on{border:1px solid #d9d9d9;border-bottom:1px solid #fff;background:#fff;font-weight:bold;}
	.nocom .tabs ul li.sp{background:none;}
	.nocom .tabs_c{padding:10px 10px 3px 10px;border:1px solid #ececec;border-top:none;}
	
	.com{margin:10px 10px 0 0;padding-left:10px;}
	.com .tabs{height:24px;padding-top:5px;line-height:24px;border-bottom:1px solid #d9d9d9;overflow:visible;position:relative;}
	.com .tabs strong{display:block;width:110px;float:left;color:#484848;font-size:16px;font-family:"黑体";font-weight:normal;}
	.com .tabs img{position:absolute;top:7px;right:0;height:15px;width:36px;}
	.com .tabs ul{height:24px;position:absolute;top:5px;left:70px}
	.com .tabs ul li{float:left;height:23px;border-top:1px solid #eaecf3;list-style:none;padding:0 10px;background:url(/static/img/split1.gif) left top no-repeat;}
	.com .tabs ul li.on{border:1px solid #d9d9d9;border-bottom:1px solid #fff;background:#fff;font-weight:bold;}
	.com .tabs ul li.sp{background:none;}
	.com .tabs_c{padding:10px 10px 3px 10px;background:#fff;}
	.com table td a{cursor:pointer;}
	.com table td a.cms{background:none;}
	.com table td a.cms img{vertical-align:middle;height:12px;width:10px;}
	.com_hover img{background:url(/static/img/icon.gif) left top;}
	.com_hover .com_on img{background:url(/static/img/icon.gif) left -12px;}
	
	#footer{text-align:center;padding-top:35px;}
	#footer a{color:#666;margin-left:2px;}
	.tc{text-align:left;line-height:20px;}
	.tc .ico{width:15px;}
	
#listdata{text-align:left;}
#listdata td{height:30px;color:#999;font-size:10px;padding-left:10px;border-top:#e4e4e4 solid 1px}
#listdata .rank{font-size:14px;font-weight:bold;color:#a8a8a8;}
</style>
</head>
<body>
<center>
<div id="all">
    <div id="s"><a id="logo" href="./"><img src="images/logo.gif" alt="<?php echo $config["name"];?>搜索风云榜" /></a>
	        <div>
			<a id="old_link" href="../">返回首页</a>
		   </div>
	</div>
    <div id="menu"><div>
<?php
if(empty($s)){$styleclass="class=\"on\"";}else{$styleclass="";}
?>
<a <?php echo $styleclass;?> href="./"><span>风云榜首页</span></a><b></b>
<?php
$cate_query=$db->query("select * from ve123_categories where parent_id='0' order by cate_id desc");
while($cate=$db->fetch_array($cate_query))
{
   if($s==$cate["cate_id"])
   {$styleclass="class=\"on\"";}else{$styleclass="";}
   echo "<a ".$styleclass." href=\"?s=".$cate["cate_id"].".html\" ".$nav_selected."><span>".$cate["cate_title"]."</span></a><b></b>";
}

?>
<form target="_blank" method="get" action="<?php echo $config["url"];?>/s">
<input type="text" name="wd" />
<input type="submit" value="飞猫一下" />
</form>
</div>
    </div>
	<div id="m">
	<?php
	if(empty($s))
	{
	?>
	     <div id="ml">
		    <?php
			$cate_query=$db->query("select * from ve123_categories where parent_id='0' order by cate_id desc");
			while($cate=$db->fetch_array($cate_query))
			{
			?>
		          <div class="nocom">
				           <div class="tabs">
                           <strong><?php echo $cate["cate_title"]?></strong>
						   <a href="?s=<?php echo $cate["cate_id"];?>.html"><img src="images/more.gif" alt="更多" /></a>
						   </div>
						   <div class="tabs_c">
                           <div class="tc">
                             <table width="100%" border="0" cellspacing="0" cellpadding="0">
                               <tr>
                                <?php
								$j=0;
								$key_query=$db->query("select * from ve123_search_keyword where s='".$cate["cate_id"]."' and char_length(keyword)<6 order by hits desc limit 20");
								while($key=$db->fetch_array($key_query))
								{$j++;
								?>
								 <td class="ico"><?php echo $j;?></td><td align="left"><?php echo "<a target=\"_blank\" href=\"../s/?wd=".urlencode($key["keyword"])."&s=".$cate["cate_id"]."\">".$key["keyword"]."</a>";?></td>
								 <?php
								        if($j%4==0)
	                                    {
	                                         echo "</tr>";
                                         }
								 }
								 ?>
                               </tr>
                             </table>
							 <a class="more" href="?s=<?php echo $cate["cate_id"];?>.html">更多</a>
						   </div>
						   </div>
		          </div>
			<?php
			}
			?>
		 </div>
		 		<div id="mr">
			
			<div class="com">
				<div class="tabs">
                    <strong>热门排行榜</strong>
			  </div>
					          <div class="tabs_c">
                              <div class="tc">
                                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                  <tr style="align:center;line-height:30px;">
                                    <th width="70">&nbsp;排名</th>
                                    <th>关键词</th>
                                    <th width="40">&nbsp;</th>
                                  </tr>
                                  <tbody id="listdata">
                                    <?php
	$j=0;
	$key_query=$db->query("select * from ve123_search_keyword where char_length(keyword)<6 and keyword regexp '[^0-9]+$' and keyword regexp '[^a-zA-Z]+$' order by hits limit 50");//^[^a-zA-Z]+$
	while($key=$db->fetch_array($key_query))
	{$j++;
	     
      ?>
                                    <tr>
                                      <td class="rank"><?php echo $j;?></td>
                                      <td><?php echo "<a target=\"_blank\" href=\"../s/?wd=".urlencode($key["keyword"])."&s=".$key["s"]."\">".$key["keyword"]."</a>";?></td>
                                      <td><img src="images/ico_up.gif"></td>
                                    </tr>
     <?php
			
     }
     ?>
                                  </tbody>
                                </table>
							  </div>
							  </div>
				  </div>
	  </div>
					
		 <?php
		 }
		 else
		 {
		 ?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr style="line-height:30px;">
    <th width="70">&nbsp;排名</th>
    <th>关键词</th>
    <th width="40">&nbsp;</th>
  </tr>
  <tbody id="listdata">
<?php
	$j=0;
	$key_query=$db->query("select * from ve123_search_keyword where s='".$s."' and char_length(keyword)<6 order by hits limit 50");
	while($key=$db->fetch_array($key_query))
	{$j++;
?>
  <tr>
    <td class="rank"><?php echo $j;?></td>
    <td><?php echo "<a target=\"_blank\" href=\"../s/?wd=".urlencode($key["keyword"])."&s=".$s."\">".$key["keyword"]."</a>";?></td>
    <td><img src="images/ico_up.gif" /></td>
  </tr>
<?php
     }
?>  </tbody>
</table>
		 <?php
		 }
		 ?>
	</div>
	<div class="clear"></div>
	<div id="footer"><?php echo "<div style=\"text-align:center;margin-top:3px;\">&copy;2009 feimao Powered by <a target=\"_blank\" href=\"http://lin0613.v16.19821122.com/\">feimao</a></div>";?></div>
</div>
</center>
<script type="text/javascript">

	(function(){var c = document.getElementById("listdata");var add = function(){

			this.style.backgroundColor="#f3f3f1";

			};

		var del = function(){

			this.style.backgroundColor="#fff";

			};

		for(var m=c.firstChild;m!=null;m=m.nextSibling){

			m.onmouseover = add;

			m.onmouseout = del;

		}

	})();

</script>
</body>
</html>
<?php
$db->close();
?>
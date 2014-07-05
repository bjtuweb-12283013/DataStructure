<?php
require_once("global.php");
is_login();
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
		<title>首页</title>
        <link type="text/css" rel="stylesheet" media="all" href="images/global.css" />     
	</head>
	<body>
<?php
headhtml();
?>        	    
<div class="wrapper">
	<table width="100%" border="1" cellspacing="0" cellpadding="0">
  <tr>
	<form name="form3" method="post" action="manage.php">  
	<input type="hidden" name="action" value="updateprice">
  <tr>
    <th>序号</th>
    <th>关 键 词</th>
    <th>&nbsp;</th>
    <th>关键词状态</th>
    <th>起价</th>
    <th>出价模式</th>
    <th>&nbsp;</th>
    <th>&nbsp;</th>
    <th>点击次数</th>
    <th>点击平均价</th>
    <th>消费金额</th>
    <th width="50">&nbsp;</th>
  </tr>
    <tr>
    <td align="center">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    </tr>
  <?php
  $query=$db->query("select * from ve123_zz_links where user_id='".$user["user_id"]."'");
  $j=0;
  while($link=$db->fetch_array($query))
  {
     $j++;
  ?>

  <tr>
    <td align="center"><?php echo $j;?></td>
    <td><?php echo "<a href=\"?action=modify&link_id=".$link["link_id"]."\">".$link["keywords"]."</a>";?></td>
    <td><a target="_blank" href="../s?wd=<?php echo urlencode($link["keywords"]);?>">搜索</a></td>
    <td>&nbsp;</td>
    <td><?php echo get_qijia($link["keywords"]);?>&nbsp;积分</td>
    <td><?php echo $link["price"];?></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td><?php echo $link["stat_click"];?></td>
    <td>&nbsp;</td>
    <td><?php echo $link["consumption"];?></td>
  </tr>

  <?php
  }
  ?>
    <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    </tr>
  </form>
</table></td>
  </tr>
</table>

<?php
foothtml();
?>
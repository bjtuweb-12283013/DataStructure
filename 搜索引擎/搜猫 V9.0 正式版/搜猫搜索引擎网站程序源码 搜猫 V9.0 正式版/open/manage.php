<?php
require_once("global.php");
is_login();
$pagetitle="开放平台";
$action=HtmlReplace($_REQUEST["action"]);
switch($action)
{
   case "saveaddlinks":
         $do_action=trim(HtmlReplace($_POST["do_action"]));
		 $keywords=trim(HtmlReplace($_POST["keywords"]));
	     $title=trim(HtmlReplace($_POST["title"]));
	     $url=trim(HtmlReplace($_POST["url"]));
	     $description=trim(HtmlReplace($_POST["description"]));
		 $price=trim(HtmlReplace($_POST["price"]));
		 if($do_action=="savemodify")
		 {
		     $link_id=intval($_POST["link_id"]);
		     $array=array('keywords'=>$keywords,'title'=>$title,'url'=>$url,'description'=>$description,'updatetime'=>time());
		     $db->update("ve123_zz_open",$array,"link_id='".$link_id."'");
		 }
		 else
		 {
		     $array=array('keywords'=>$keywords,'title'=>$title,'url'=>$url,'description'=>$description,'price'=>$price,'user_id'=>$user["user_id"],'updatetime'=>time());
		     $db->insert("ve123_zz_open",$array);
		 }
		 
		 
		 header("location:manage.php?");
   break;
   case "updateprice":
         $arrPrice=$_POST["arrPrice"];
		 foreach($arrPrice as $link_id=>$price)
		 {
		       $key=$db->get_one("select * from ve123_zz_open where link_id='".$link_id."'");
		       if(get_qijia($key["keywords"])>$price)
			   {
			      header("location:manage.php?msg=".urlencode($key["keywords"]." 出价不能低于起价！"));
				  exit();
			   }
		       $array=array('price'=>$price,'updatetime'=>time());
			   $db->update("ve123_zz_open",$array,"link_id='".$link_id."' and user_id='".$user["user_id"]."'");
			   
		 }
		 header("location:manage.php?msg=".urlencode("更新成功！"));
   break;
   	case "del":
	     $link_id=intval($_GET["link_id"]);
		 $db->query("delete from ve123_zz_open where link_id='".$link_id."' and user_id='".$user["user_id"]."'");
		 header("location:manage.php?msg=".urlencode("删除成功！"));
	break;
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
		<title>首页--<?php echo $pagetitle;?></title>
        <link type="text/css" rel="stylesheet" media="all" href="images/global.css" />     
	</head>
	<body>
<?php
headhtml();
?>	    
<div class="wrapper">
<div id="msg" style='color:#f00;text-align:center;'>
	        <?php
			$msg=HtmlReplace($_GET["msg"]);
			if(empty($msg))
			{
			   echo "";
			}
			else
			{
			    echo $msg;
			}
			?>
</div>
<table border=0 cellspacing=1 cellpadding=3 class="tablebg">
	<form name="form3" method="post" action="manage.php">  
	<input type="hidden" name="action" value="updateprice">
  <tr>
    <th>序号</th>
    <th>品牌搜索关键词</th>
    <th>查看效果</th>
    <th width="50">&nbsp;</th>
  </tr>
    <tr>
    <td align="center">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    </tr>
  <?php
  $query=$db->query("select * from ve123_zz_open where user_id='".$user["user_id"]."'");
  $j=0;
  while($link=$db->fetch_array($query))
  {
     $j++;
  ?>

  <tr>
    <td align="center"><?php echo $j;?></td>
    <td align="center"><?php echo "<a href=\"?action=modify&link_id=".$link["link_id"]."\">".$link["keywords"]."</a>";?></td>
    <td align="center"><a target="_blank" href="../s?wd=<?php echo urlencode($link["keywords"]);?>">搜索</a></td>
    <td align="center"><a href="?action=del&link_id=<?php echo $link["link_id"]?>" onclick="if(!confirm('确认删除码?')) return false;">删除</a></td>
  </tr>

  <?php
  }
  ?>
    <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    </tr>
  </form>
</table>

    <br>
<?php
if($action!="step_2")
{
        if($action=="modify")
		{
		     $link_id=intval($_GET["link_id"]);
		     $action_value="saveaddlinks";
			 $do_action="savemodify";
			 $title=$bt_txt="修改关键词";
			 $link=$db->get_one("select * from ve123_zz_open where link_id='".$link_id."' and user_id='".$user["user_id"]."'");
		}
		else
		{
		     $action_value="step_2";
		     $title="添加关键词";
			 $bt_txt="下一步";
		}
?>
    <table width="100%" border="0" cellpadding="3" cellspacing="1" class="tablebg">
	<form name="form1" method="post" action="manage.php">
	<input type="hidden" name="action" value="<?php echo $action_value;?>">
	<input type="hidden" name="do_action" value="<?php echo $do_action;?>">
	<input type="hidden" name="link_id" value="<?php echo $link_id;?>">
      <tr>
        <th colspan="2"><?php echo $title;?></th>
      </tr>
      <tr>
        <td width="100">关 键 词</td>
        <td><input name="keywords" type="text" size="80" value="<?php echo $link["keywords"];?>">
        最多32字</td>
      </tr>
      <tr>
        <td>网页标题</td>
        <td><input name="title" type="text" size="80" value="<?php echo $link["title"];?>">
        最多20字 </td>
      </tr>
      <tr>
        <td>URL 地址</td>
        <td><input name="url" type="text" size="80" value="<?php echo $link["url"];?>">
        最多248字节</td>
      </tr>
      <tr>
        <td>模板代码</td>
        <td><textarea name="description" cols="80" rows="8"><?php echo $link["description"];?></textarea>
        最多100字</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td><input type="submit" name="Submit" value="<?php echo $bt_txt;?>"></td>
      </tr>
	  </form>
    </table>
<?php
}
elseif($action=="step_2")
{
    $keywords=trim(HtmlReplace($_POST["keywords"]));
	$title=trim(HtmlReplace($_POST["title"]));
	$url=trim(HtmlReplace($_POST["url"]));
	$description=trim(HtmlReplace($_POST["description"]));
?>
   <table width="100%" border="0" cellpadding="3" cellspacing="1" class="tablebg">
   <form name="form2" method="post" action="manage.php">
   <input type="hidden" name="action" value="saveaddlinks">
   <input type="hidden" name="keywords" value="<?php echo $keywords;?>">
   <input type="hidden" name="title" value="<?php echo $title;?>">
   <input type="hidden" name="url" value="<?php echo $url;?>">
   <input type="hidden" name="description" value="<?php echo $description;?>">
      <tr>
        <th>审核通过后如需修改请联系网站管理员</th>
      </tr>
      
      <tr>
        <td align="center" height="40"><input type="submit" name="Submit2" value="确定提交"></td>
      </tr>
     </form>
    </table>
<?php
}
?>

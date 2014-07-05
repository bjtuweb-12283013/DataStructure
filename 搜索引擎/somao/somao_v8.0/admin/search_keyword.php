<?php
require "global.php";
headhtml();
?>
<div class="nav" style="display:;"><a href="?action=addform">添加</a></div>
<?php
$action=$_GET["action"];
switch ($action)
{
    case "saveform":
    saveform();
    break;

    case "addform":
	addform($action);
	break;
	
	case "modify":
	addform($action);
	break;
	
	case "del":
	     $kid=intval($_GET["kid"]);
		 $db->query("delete from ve123_search_keyword where kid='".$kid."'");
	break;
}	
?>
<?php
$kw=HtmlReplace(trim($_REQUEST["kw"]));
?>
<form id="search_form" name="search_form" method="post" action="?action=search">
<table width="100%" border="0" cellpadding="3" cellspacing="1" class="tablebg">
  <tr>
    <td width="100">关键词:</td>
    <td><input type="text" name="kw" value="<?php echo $kw;?>"/>
      <input type="submit" name="Submit2" value="查找" /></td>
  </tr>
</table>
</form>
<table width="100%" border="0" cellpadding="3" cellspacing="1" class="tablebg">

  <tr>
    <th width="100">ID</th>
    <th>关键词</th>
    <th width="120">查询次数</th>
    <th width="80">操作</th>
  </tr>
  <?php
  if($action=="search")
  { 
        $where=" where";
		if(!empty($kw))
		{
			$where.=" keyword like '%".$kw."%'";
		}
		else
		{
		    $where="";
		}
  }
  $sql="select * from ve123_search_keyword".$where;//echo $sql;
      $result=$db->query($sql);
      $total=$db->num_rows($result);//记录总数
      $pagesize=30;//每页显示数
      $totalpage=ceil($total/$pagesize);
      $page=intval($_GET["page"]);
      if($page<=0){$page=1;}
      $offset=($page-1)*$pagesize;
  $result=$db->query($sql." order by kid desc limit $offset,$pagesize");
  while ($rs=$db->fetch_array($result))
  {
  ?>
  <tr>
    <td><?php echo $rs["kid"]?></td>
    <td><?php echo "<a target=\"_blank\" href=\"../s/?wd=".urlencode($rs["keyword"])."\" >".$rs["keyword"];?></td>
    <td><?php echo $rs["hits"];?></td>
    <td>
	<a href="?action=modify&amp;kid=<?php echo $rs["kid"]?>">修改</a>
	<a href="?action=del&kid=<?php echo $rs["kid"];?>" onclick="if(!confirm('确认删除码?')) return false;">删除</a>	</td>
  </tr>
  <?php
  }
  ?>
</table>
<?php
echo pageshow($page,$totalpage,$total,"?action=".$action."&kw=".$kw."&");
?>
<?php
function addform($do_action)
{
global $db;
  if ($do_action=="modify")
  {
      $kid=$_GET["kid"];
	  $sql="select * from ve123_search_keyword where kid='$kid'";
	  $rs=$db->get_one($sql);
	  $keyword=$rs["keyword"];
	  $ip=$rs["ip"];
	  $btn_txt="确定修改";
  }
  else
  {
     $btn_txt="确定提交";
  }
?>
<table width="100%" border="0" cellpadding="3" cellspacing="1" class="tablebg">
<form id="form1" name="form1" method="post" action="?action=saveform">
  <tr>
    <td width="100">关键词:</td>
    <td><input name="keyword" type="text" value="<?php echo $keyword?>" /></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>
	<input type="hidden" name="kid" value="<?php echo $kid?>">
	<input type="hidden" name="do_action" value="<?php echo $do_action?>">
	<input type="submit" name="Submit" value="<?php echo $btn_txt?>" />	</td>
  </tr>
  </form>
</table>
<?php
}
?>

<?php
function saveform()
{
global $db;
   $keyword=trim($_POST["keyword"]);
   $kid=$_POST["kid"];
   $do_action=$_POST["do_action"];
   if ($do_action=="modify")
   {
     $array=array('keyword'=>$keyword);
	 $db->update("ve123_search_keyword",$array,"kid='$kid'");
	 jsalert("修改成功");
   }
   else
   {
     $array=array('keyword'=>$keyword);
	 $db->insert("ve123_search_keyword",$array);
     jsalert("提交成功");
   }
}
?>


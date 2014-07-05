<?php
require "global.php";
headhtml();
?>
<div class="nav" style="display:;"><a href="?action=add&p_cid=<?php echo $p_cid?>">添加顶级分类</a><a href="?action=create_cache">生成缓存</a></div>


<?php
$action=$_GET["action"];
switch ($action)
{
    case "saveform":
    saveform();
    break;

    case "add":
	addform($action);
	break;
	
	case "modify":
	addform($action);
	break;
	
	case "del":
	$db->query("delete from ve123_categories where cate_id='".intval($_GET["cate_id"])."'");
	break;
	
	case "create_cache":
	create_cache();
	break;
}	
?>
<style type="text/css">
<!--
.Menu { COLOR:#000000; FONT-SIZE: 12px; CURSOR: hand;}
</style>
<script type="text/javascript">
function ShowMenu(MenuID) 
	{ 
	if(MenuID.style.display=="none") 
	{ 
	MenuID.style.display=""; 
	} 
	else 
	{ 
	MenuID.style.display="none"; 
	} 
	}
</script>
<?php 
	$GLOBALS["id"] =1;
	$jibie=1; 
	$sql="select * from ve123_categories where parent_id='0' order by cate_id desc"; 
	$result=$db->query($sql); 
	
	if(mysql_num_rows($result)>0)
	TreeMenu($Conn,$result,$jibie,$id); 
	
	function TreeMenu($Conn,$result,$jibie)  //进入函数循环
	{ 
	    global $db;
	$numrows=mysql_num_rows($result); 
	echo "<table width=\"100%\" border=\"0\" cellpadding=\"3\" cellspacing=\"1\" class=\"tablebg\">"; 
	for($rows=0;$rows<$numrows;$rows++) 
	{ 
	$menu=mysql_fetch_array($result); 
	$sql="select * from ve123_categories where parent_id='".$menu["cate_id"]."'";
	$result_sub=$db->query($sql); 
	echo "<tr>"; 
		//如果该菜单项目有子菜单，则添加JavaScript onClick语句 
		if(mysql_num_rows($result_sub)>0) 
		{ 
		echo "<td width='20'><a href=\"javascript:void(0)\" onClick='javascript:ShowMenu(Menu".$GLOBALS["ID"].");'><img src='images/+.gif' border='0'></a></td>"; 
		echo "<td class='Menu'>"; 
		} 
		else 
		{ 
		echo "<td width='20'><img src='images/-.gif' border='0'></td>"; 
		echo "<td class='Menu'>"; 
		} 
		if($menu[url]!="") 
		echo "<a href='$menu[url]'>$menu[name]</a> "; 
		else 
		echo "<a href='#'>$menu[cate_title]</a>   <a href='?cate_id={$menu[cate_id]}&action=add'> 添加下级分类</a>  <a href='?cate_id={$menu[cate_id]}&parent_id=$menu[parent_id]&action=modify'> 编辑</a>  <a href='?cate_id={$menu[cate_id]}&action=del' onClick=\"if(!confirm('确定删除码?')) return false;\"> 删除</a>"; 
		echo "</td> </tr>"; 
		if(mysql_num_rows($result_sub)>0) 
		{ 
		echo "<tr id=Menu".$GLOBALS["ID"]++." style='display:none' >"; 
		echo "<td width='20'> </td>"; 
		echo "<td>"; 
		//将级数加1 
		$jibie++; 
		TreeMenu($Conn,$result_sub,$jibie); 
		$jibie--;
		echo "</td></tr>"; 
		} 
		//显示下一菜单
		} 
		echo "</table>"; 
} 
?> 

<?php
function addform($do_action)
{
global $db,$parent_id;
$parent_id=intval($_GET["parent_id"]);
$cate_id=intval($_GET["cate_id"]);

  if ($do_action=="modify")
  {   $sql="select * from ve123_categories where cate_id='$parent_id'";
      $parent=$db->get_one($sql);
	  $sql="select * from ve123_categories where cate_id='$cate_id'";
	  $menu=$db->get_one($sql);
	  $cate_title=$menu["cate_title"];
	  $cate_url=$menu["cate_url"];
	  $sort_id=$menu["sort_id"];
	  $btn_txt="确定修改";
	  $sql="select * from ve123_categories where parent_id='".$parent["parent_id"]."'";
  }
  else
  {
     $sql="select * from ve123_categories where cate_id='".$cate_id."'";
	 $parent_id=$cate_id;
     $btn_txt="确定添加";
  }
?>
<table width="100%" border="0" cellpadding="3" cellspacing="1" class="tablebg">
<form id="form1" name="form1" method="post" action="?action=saveform">
  <tr>
    <td>上级类别:</td>
    <td>
	<select name="parent_id">
	<option value="0" selected="selected">顶级分类</option>
	<?php
	$result=$db->query($sql);
	while($rs=$db->fetch_array($result))
	{
	     if($rs["cate_id"]==$parent_id)
		 {
		    $selectedstr=" selected=\"selected\"";
		 }
		 else
		 {
		    $selectedstr="";
		 }
	     echo "<option$selectedstr value=\"$rs[cate_id]\">$rs[cate_title]</option>";
	}
	?>
    </select>	</td>
  </tr>
  <tr style="display:none;">
    <td>链接参数:</td>
    <td><input name="cate_url" type="text" size="80" value="<?php echo $cate_url?>"/>
      (如果你不是程序员,请留空)</td>
  </tr>
  <tr>
    <td width="100">分类名称:</td>
    <td>
      <textarea name="cate_title" cols="80" rows="10"><?php echo $cate_title?></textarea>
      (支持批量添加,一行一个!)</td>
  </tr>
  <tr>
    <td>排序:</td>
    <td><input type="text" name="sort_id" value="<?php echo $sort_id;?>"/></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>
	<input type="hidden" name="cate_id" value="<?php echo $cate_id?>">
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
   $cate_title=trim($_POST["cate_title"]);
   $cate_url=trim($_POST["cate_url"]);
   $cate_id=$_POST["cate_id"];
   $parent_id=intval($_POST["parent_id"]);
   $sort_id=intval($_POST["sort_id"]);
   $do_action=$_POST["do_action"];
   if ($do_action=="modify")
   {
	 $array=array('cate_title'=>$cate_title,'cate_url'=>$cate_url,'parent_id'=>$parent_id,'sort_id'=>$sort_id);
	 $db->update("ve123_categories",$array,"cate_id='$cate_id'");
	 jsalert("修改成功");
   }
   else
   {
       $exp=explode("\n",$cate_title);
       foreach($exp as $value)
      {
	      if($value)
		  {
             $array=array('cate_title'=>trim($value),'cate_url'=>$cate_url,'parent_id'=>$parent_id,'sort_id'=>$sort_id);
	         $db->insert("ve123_categories",$array);  
		   }   
      }

     jsalert("提交成功");
   }
}
function create_cache()
{
    global $db;
	$cate_arry=array();
	$cate_array_one=array();
	$cate_query=$db->query("select * from ve123_categories where parent_id='0'");
    while($cate=$db->fetch_array($cate_query))
    {
	     $cate_array_one=get_cate_array($cate["cate_id"]);
		 if(!is_array($cate_array_one))
		 {
		   $cate_array_one=array();
		 }
		 $this_array=array($cate["cate_id"]=>$cate["cate_title"]);
		 $cate_array[$cate["cate_id"]]=$cate_array_one+$this_array;
		 
		 $cate_menu_array[$cate["cate_id"]]=get_cate_menu_array($cate["cate_id"]);
		 
	}
	$str="<?php ".chr(13).chr(10);;
	$str.="\$nav_cate_array=" . var_export($cate_array,true).";".chr(13).chr(10);;
	$str.=" ?>";
	$fp=@fopen("../cache/s_cate_array.php","w") or die("写方式打开文件失败，请检查程序目录是否为可写");//配置conn.php文件
    @fputs($fp,$str) or die("文件写入失败,请检查程序目录是否为可写"); 
    @fclose($fp);
	
	$str_menu="<?php ".chr(13).chr(10);;
	$str_menu.="\$nav_cate_menu_array=" . var_export($cate_menu_array,true).";".chr(13).chr(10);;
	$str_menu.=" ?>";
	$fp=@fopen("../cache/s_cate_menu_array.php","w") or die("写方式打开文件失败，请检查程序目录是否为可写");//配置conn.php文件
    @fputs($fp,$str_menu) or die("文件写入失败,请检查程序目录是否为可写"); 
    @fclose($fp);
}
function get_cate_array($cate_id)
{
   global $db;
   $array_2=array();
   $query=$db->query("select * from ve123_categories where parent_id='".$cate_id."'");
   $num=$db->num_rows($query);
   if(empty($num)){return;}
   while($row=$db->fetch_array($query))
   {
         $cate_array[$row["cate_id"]]=$row["cate_title"];
		 $array_2=get_cate_array($row["cate_id"]);
		 if(!empty($array_2))
		 {
		    $cate_array=$cate_array+$array_2;
		 }
		
   }
   return $cate_array;
}
function get_cate_menu_array($cate_id)
{
   global $db;
   $query=$db->query("select * from ve123_categories where parent_id='".$cate_id."'");
   while($row=$db->fetch_array($query))
   {
         $cate_menu_array[$row["cate_id"]]=$row["cate_title"];
		 
   }
   return $cate_menu_array;
}
?>


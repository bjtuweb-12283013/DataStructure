<?php
/*
	[CYASK] (C)2009 Cyask.com
	Revision: 3.2
	Date: 2009-1-19
	Author: zhaoshunyao
	QQ: 240508015
*/

if(!defined('IN_CYASK'))
{
        exit('Access Denied');
}
if(!$admin_login)
{
	header("location:admin.php?admin_action=login&backaction=$admin_action");
}
if($_GET['admin_action']=='sort_list')
{
	admin_header();
	$sid=intval($_GET['sid']);
	if($grade==1)
	{
?>
<br /><br />
<table cellspacing="1" cellpadding="0" width="85%" align="center" class="tableborder">
<tr><td>
	<table border="0" cellspacing="0" cellpadding="4" width="100%">
	<tr class="header"><td height="26"><?php echo $lang['menu_sort'];?></td></tr>
	<?php
	$query=$dblink->query("SELECT sid,sort1 AS sort,orderid FROM {$tablepre}sort WHERE grade='1' ORDER BY orderid asc");
	$i=0;
	while($row=$dblink->fetch_array($query))
	{
	?>
	<tr bgcolor="#FFFFFF"><td><?php echo $row['orderid'];?>: <b><?php echo $row['sort'];?></b>
	<a href="admin.php?admin_action=sort_edit&sid=<?php echo $row['sid'];?>">[<font color="#FF0000"><?php echo $lang['update'];?></font>]</a>
	<a href="admin.php?admin_action=sort_merge&sid=<?php echo $row['sid'];?>" title="<?php echo $lang['merge_alert'];?>">[<font color="#FF0000"><?php echo $lang['merge'];?></font>]</a>
	<a href="admin.php?admin_action=sort_del&grade=1&sid=<?php echo $row['sid'];?>" onclick="if( !deleteit() ) return false;">[<font color="#FF0000"><?php echo $lang['delete'];?></font>]</a>
	<a href="admin.php?admin_action=sort_list&grade=2&sid=<?php echo $row['sid'];?>">[<font color="#FF0000"><?php echo $lang['menu_children_sort'];?></font>]</a>
	</td></tr>
	<tr bgcolor="#F8F8F8"><td></td></tr>
	<?php
	$i++;
	}
	if(!$i)
	{
	?>
	<tr bgcolor="#F8F8F8" height=50><td align=center><?php echo $lang['menu_no_sort'];?></td></tr>
	<?php
	}
	?>
	</table>
</td></tr>
</table>
<?php
	}
	elseif($grade==2)
	{
		$query=$dblink->query("SELECT * FROM {$tablepre}sort WHERE sid=$sid");
		$sort_row=$dblink->fetch_array($query);
	?>
<br /><br />
<table cellspacing="1" cellpadding="0" width="85%" align="center" class="tableborder">
<tr><td>
	<table border="0" cellspacing="0" cellpadding="4" width="100%">
	<tr class="header"><td height="26"><?php echo $lang['menu_sort'];?></td></tr>
	<tr bgcolor="#FFFFFF"><td>/<strong><?php echo $sort_row['sort1'];?></strong>/&nbsp;&nbsp;<a href="admin.php?admin_action=sort_list">[<?php echo $lang['menu_parent_sort'];?>]</a></td></tr>
	<?php
	$query=$dblink->query("SELECT sid,sort2 AS sort,orderid FROM {$tablepre}sort WHERE grade=2 AND sid1='$sort_row[sid]' ORDER BY orderid asc");
	$i=0;
	while($row=$dblink->fetch_array($query))
	{
	?>
	<tr bgcolor="#FFFFFF"><td><?php echo $row['orderid'];?>: <b><?php echo $row['sort'];?></b>
	<a href="admin.php?admin_action=sort_edit&sid=<?php echo $row['sid'];?>">[<font color="#FF0000"><?php echo $lang['update'];?></font>]</a>
	<a href="admin.php?admin_action=sort_merge&sid=<?php echo $row['sid'];?>" title="<?php echo $lang['merge_alert'];?>">[<font color="#FF0000"><?php echo $lang['merge'];?></font>]</a>
	<a href="admin.php?admin_action=sort_del&grade=2&sid=<?php echo $row['sid'];?>&supersid=<?php echo $sid;?>" onclick="if( !deleteit() ) return false;">[<font color="#FF0000"><?php echo $lang['delete'];?></font>]</a>
	<a href="admin.php?admin_action=sort_list&grade=3&sid=<?php echo $row['sid'];?>">[<font color="#FF0000"><?php echo $lang['menu_children_sort'];?></font>]</a>
	</td></tr>
	<tr bgcolor="#F8F8F8"><td></td></tr>
	<?php
	$i++;
	}
	if(!$i)
	{
	?>
	<tr bgcolor="#F8F8F8" height=50><td align=center><?php echo $lang['menu_no_sort'];?></td></tr>
	<?php
	}
	?>
	</table>
	</td></tr>
</table>
<?php
	}
	elseif($grade==3)
	{
		$query=$dblink->query("SELECT * FROM {$tablepre}sort WHERE sid=$sid");
		$sort_row=$dblink->fetch_array($query);
	?>
	<br /><br />
	<table cellspacing="1" cellpadding="0" width="85%" align="center" class="tableborder">
	<tr><td>
	<table border="0" cellspacing="0" cellpadding="4" width="100%">
	<tr class="header"><td height="26"><?php echo $lang['menu_sort'];?></td></tr>
	<tr bgcolor="#FFFFFF"><td>/<strong><?php echo $sort_row['sort1'];?></strong>/<strong><?php echo $sort_row['sort2'];?></strong>/&nbsp;&nbsp;<a href="admin.php?admin_action=sort_list&grade=2&sid=<?php echo $sort_row['sid1'];?>">[<?php echo $lang['menu_parent_sort'];?>]</a></td></tr>
	<?php
	$query=$dblink->query("SELECT sid,sort3 AS sort,orderid FROM {$tablepre}sort WHERE grade='3' AND sid2='$sort_row[sid]' ORDER BY orderid asc");
	$i=0;
	while($row=$dblink->fetch_array($query))
	{
	?>
	<tr bgcolor="#FFFFFF"><td><?php echo $row['orderid'];?>: <b><?php echo $row['sort'];?></b>
	<a href="admin.php?admin_action=sort_edit&sid=<?php echo $row['sid'];?>">[<font color="#FF0000"><?php echo $lang['update'];?></font>]</a>
	<a href="admin.php?admin_action=sort_merge&sid=<?php echo $row['sid'];?>" title="<?php echo $lang['merge_alert'];?>">[<font color="#FF0000"><?php echo $lang['merge'];?></font>]</a>
	<a href="admin.php?admin_action=sort_del&grade=3&sid=<?php echo $row['sid'];?>&supersid=<?php echo $sid;?>" onclick="if( !deleteit() ) return false;">[<font color="#FF0000"><?php echo $lang['delete'];?></font>]</a>
	</td></tr>
	<tr bgcolor="#F8F8F8"><td></td></tr>
	<?php
	$i++;
	}
	if(!$i)
	{
	?>
	<tr bgcolor="#F8F8F8" height=50><td align=center><?php echo $lang['menu_no_sort'];?></td></tr>
	<?php
	}
	?>
	</table>
</td></tr>
</table>
<?php
	}
	admin_footer();
	exit();
}
elseif($_GET['admin_action']=='sort_add')
{
	if(isset($_GET['add_submit']))
	{
		if($_GET['ClassLevel2'])
		{
			$query=$dblink->query("select * from {$tablepre}sort where sid='$_GET[ClassLevel2]'");
			$sort_row=$dblink->fetch_array($query);
			$query=$dblink->query("INSERT INTO {$tablepre}sort SET sid1='$sort_row[sid1]',sid2='$_GET[ClassLevel2]',sort1='$sort_row[sort1]',sort2='$sort_row[sort2]',sort3='$_GET[sortname]',grade='3',orderid='$_GET[orderid]'");
			
			header("location:admin.php?admin_action=sort_list&grade=3&sid=$_GET[ClassLevel2]");
		}
		else if($_GET['ClassLevel1'])
		{
			$query=$dblink->query("select * from {$tablepre}sort where sid='$_GET[ClassLevel1]'");
			$sort_row=$dblink->fetch_array($query);
			$query=$dblink->query("INSERT INTO {$tablepre}sort SET sid1='$_GET[ClassLevel1]',sort1='$sort_row[sort1]',sort2='$_GET[sortname]',grade='2',orderid='$_GET[orderid]'");
			
			header("location:admin.php?admin_action=sort_list&grade=2&sid=$_GET[ClassLevel1]");
		}
		else
		{
			$query=$dblink->query("INSERT INTO {$tablepre}sort SET sort1='$_GET[sortname]',grade='1',orderid='$_GET[orderid]'");
			
			header("location:admin.php?admin_action=sort_list&grade=1");
		}
	}
	else
	{
		$query=$dblink->query("SELECT sid,sort1 FROM {$tablepre}sort WHERE grade=1 ORDER BY orderid");
		$count1=$dblink->num_rows($query);
		$class1='new Array("0","'.$lang['menu_sort1_add'].'"),';
		$c=1;
		while($row1=$dblink->fetch_array($query))
		{
			$class1.='new Array("'.$row1['sid'].'","'.$row1['sort1'].'")';
			if($c==$count1) $class1.="\n"; else $class1.=",\n";
			$c++;
		}
	
		$query=$dblink->query("SELECT sid,sid1,sort2 FROM {$tablepre}sort WHERE grade=2 ORDER BY orderid");
		$count2=$dblink->num_rows($query);
		$class2='';
		$c=1;
		while($row2=$dblink->fetch_array($query))
		{
			$class2.='new Array("'.$row2['sid1'].'","'.$row2['sid'].'","'.$row2['sort2'].'")';
			if($c==$count2) $class2.="\n"; else $class2.=",\n";
			$c++;
		}
	
		$query=$dblink->query("SELECT sid,sid2,sort3 FROM {$tablepre}sort WHERE grade=3 ORDER BY orderid");
		$count3=$dblink->num_rows($query);
		$class3='';
		$c=1;
		while($row3=$dblink->fetch_array($query))
		{
			$class3.='new Array("'.$row3['sid2'].'","'.$row3['sid'].'","'.$row3['sort3'].'")';
			if($c==$count3) $class3.="\n"; else $class3.=",\n";
			$c++;
		}
	
		admin_header();
	
?>
<script type="text/javascript">
function check_sortform(f)
{
 	if(f.sortname.value =="")
 	{
  		alert("<?php echo $msglang['write_sortname'];?>");
		f.sortname.focus();
		return false;
 	}
}
</script>
<br /><br />
<table cellspacing="1" cellpadding="0" width="85%" align="center" class="tableborder">
<tr><td>
	<table border="0" cellspacing="0" cellpadding="4" width="100%">
	<tr class="header"><td colspan=2><?php echo $lang['menu_sort_add'];?></td></tr>
	<form method="get" action="admin.php" name="sortForm" onSubmit="return check_sortform(this)">
    <tr bgcolor="#F8F8F8"><td colspan=2 height="20"></td></tr>
     <tr bgcolor="#ffffff"> 
      <td width="80" height="25" align="right"><?php echo $lang['sortname'];?>:</td>
      <td align="left"><input name="sortname" type="text" size="30" maxlength="30" /></td>
    </tr>
    <tr bgcolor="#F8F8F8"> 
      <td width="80" height="25" align="right"><?php echo $lang['arrange'];?>:</td>
      <td align="left"><input name="orderid" type="text" size="5" maxlength="2" />
    </td>
   </tr>
   <tr bgcolor="#ffffff"> 
      <td width="80" height="25" align="right"><?php echo $lang['belong_to_sort'];?>:</td>
      <td align="left">
        <span id=classid>
       <table cellspacing=0 cellpadding=0 border=0>
         <input type="hidden" name="cid" value="0" /> 
         <tr><td><select id=ClassLevel1 style="WIDTH: 170px" size=8 name=ClassLevel1><option></option></select></TD>
          <td width=20><div id=jiantou1 align=center><B><?php echo $lang['->'];?></B></div></td>
          <td><select id=ClassLevel2 style="WIDTH: 160px" size=8 name=ClassLevel2><option selected></option></select></td>
          <td width=20><div id="jiantou2" align="center"><B><?php echo $lang['->'];?></B></div></td>
		  <td><select id="ClassLevel3" style="width: 150px" onchange="getCidValue();" size="8" name="ClassLevel3"><option selected></option></select></td>
         </tr>
       </table>
<script type="text/javascript">
function getCidValue()
{
	var _cl1 = document.sortForm.ClassLevel1;
	var _cl2 = document.sortForm.ClassLevel2;
	var _cl3 = document.sortForm.ClassLevel3;
	var _cid = document.sortForm.cid;
	if(_cl1.value!=0) _cid.value = _cl1.value;
	if(_cl2.value!=0) _cid.value = _cl2.value;
	if(_cl3.value!=0) _cid.value = _cl3.value;
}
var g_ClassLevel1;
var g_ClassLevel2;
var g_ClassLevel3;

var class_level_1=new Array(
<?php echo $class1;?>
);
var class_level_2=new Array(
<?php echo $class2;?>
);
var class_level_3=new Array(
<?php echo $class3;?>
);
function FillClassLevel1(ClassLevel1)
{
    for(i=0; i<class_level_1.length; i++)
    {
        ClassLevel1.options[i] = new Option(class_level_1[i][1], class_level_1[i][0]);
    }
    ClassLevel1.options[0].selected = true;
    ClassLevel1.length = i+1;
}
function FillClassLevel2(ClassLevel2, class_level_1_id)
{
    ClassLevel2.options[0] = new Option("<?php echo $lang['menu_sort2_add'];?>", "0");
    count = 1;
    for(i=0; i<class_level_2.length; i++)
    {
		if(class_level_2[i][0].toString() == class_level_1_id)
		{
            ClassLevel2.options[count] = new Option(class_level_2[i][2], class_level_2[i][1]);
            count = count+1;
		}
    }
    ClassLevel2.options[0].selected = true;
    ClassLevel2.length = count;
}
function FillClassLevel3(ClassLevel3, class_level_2_id)
{
    ClassLevel3.options[0] = new Option("", "");
    count = 1;
    for(i=0; i<class_level_3.length; i++)
    {
        if(class_level_3[i][0].toString() == class_level_2_id)
        {
            ClassLevel3.options[count] = new Option(class_level_3[i][2], class_level_3[i][1]);
            count = count+1;
        }
    }
    ClassLevel3.options[0].selected = true;
    ClassLevel3.length = count;       
}
function ClassLevel2_onchange()
{
    getCidValue();
    FillClassLevel3(g_ClassLevel3, g_ClassLevel2.value); 
    if (g_ClassLevel3.length <= 1){g_ClassLevel3.style.display = "none";document.getElementById("jiantou2").style.display = "none";}
    else{g_ClassLevel3.style.display = ""; document.getElementById("jiantou2").style.display = "";}       
}
function ClassLevel1_onchange()
{
    getCidValue();
    FillClassLevel2(g_ClassLevel2, g_ClassLevel1.value);
    if (g_ClassLevel2.length <= 1)
    {  
     g_ClassLevel2.style.display = "none";
	 document.getElementById("jiantou1").style.display = "none";
    }
    else
    {
     g_ClassLevel2.style.display = "";     
	 document.getElementById("jiantou1").style.display = "";	 
    }      
    ClassLevel2_onchange();
	
}
function InitClassLevelList(ClassLevel1, ClassLevel2, ClassLevel3)
{
    g_ClassLevel1=ClassLevel1;
    g_ClassLevel2=ClassLevel2;
    g_ClassLevel3=ClassLevel3;
    g_ClassLevel1.onchange = Function("ClassLevel1_onchange();");
    g_ClassLevel2.onchange = Function("ClassLevel2_onchange();");
    FillClassLevel1(g_ClassLevel1);
    ClassLevel1_onchange();
}
InitClassLevelList(document.sortForm.ClassLevel1, document.sortForm.ClassLevel2, document.sortForm.ClassLevel3);

var selected_id_list="0"
var blank_pos = selected_id_list.indexOf(" ");
var find_blank = true;
if (blank_pos == -1) {
    find_blank = false;
    blank_pos = selected_id_list.length;
}
var id_str = selected_id_list.substr(0, blank_pos);
g_ClassLevel1.value = id_str;
ClassLevel1_onchange();

if (find_blank == true) {
    selected_id_list = selected_id_list.substr(blank_pos + 1, 
    selected_id_list.length - blank_pos - 1);
    blank_pos = selected_id_list.indexOf(" ");
    if (blank_pos == -1) {
        find_blank = false;
        blank_pos = selected_id_list.length;
    }
    id_str = selected_id_list.substr(0, blank_pos);
    g_ClassLevel2.value = id_str;
    ClassLevel2_onchange();

    if (find_blank == true) {
        selected_id_list = selected_id_list.substr(blank_pos + 1, 
        selected_id_list.length - blank_pos - 1);
        blank_pos = selected_id_list.indexOf(" ");
        if (blank_pos == -1) {
            find_blank = false;
            blank_pos = selected_id_list.length;
        }
        id_str = selected_id_list.substr(0, blank_pos);
        g_ClassLevel3.value = id_str;
    }
}
</script>
</span>
     </td>
    </tr>
    <tr bgcolor="#F8F8F8"> 
     <td width="80" height="25" align="right">&nbsp;</td>
     <td align="left">
       <input name="admin_action" type="hidden" value="sort_add" />
       <input type="submit" value="<?php echo $lang['submit'];?>" name="add_submit" /> &nbsp;&nbsp;
       <input onclick="javascript:history.back();" type="button" value="<?php echo $lang['cancel'];?>" /> 
      </td>
    </tr>
     <tr bgcolor="#ffffff"><td colspan=2 height="20"></td></tr>
  </form>
	</table>
	</td></tr>
</table>
<?php
	admin_footer();
	exit();
	}
}

elseif($_GET['admin_action']=='sort_edit')
{
	
	if(isset($_GET['edit_submit']))
	{
		if($_GET['grade']==1)
		{
			$dblink->query("UPDATE {$tablepre}sort SET sort1='$_GET[sortname]',orderid='$_GET[orderid]' WHERE sid=$_GET[sid]");
			$dblink->query("UPDATE {$tablepre}sort SET sort1='$_GET[sortname]' WHERE sid1=$_GET[sid] AND grade=2");
			$dblink->query("UPDATE {$tablepre}sort SET sort1='$_GET[sortname]' WHERE sid2=$_GET[sid] AND grade=3");
			header("location:admin.php?admin_action=sort_list");
		}
		else if($_GET['grade']==2)
		{
			$dblink->query("UPDATE {$tablepre}sort SET sort2='$_GET[sortname]',orderid='$_GET[orderid]' WHERE sid=$_GET[sid]");
			$dblink->query("UPDATE {$tablepre}sort SET sort2='$_GET[sortname]' WHERE sid2=$_GET[sid] AND grade=3");
		
			$query=$dblink->query("SELECT sid1 FROM {$tablepre}sort WHERE sid='$_GET[sid]'");
			$sort_row=$dblink->fetch_array($query);
			header("location:admin.php?admin_action=sort_list&grade=2&sid=$sort_row[sid1]");
		}
		else if($_GET['grade']==3)
		{
			$dblink->query("UPDATE {$tablepre}sort SET sort3='$_GET[sortname]',orderid='$_GET[orderid]' WHERE sid=$_GET[sid]");
		
			$query=$dblink->query("SELECT sid2 FROM {$tablepre}sort WHERE sid=$_GET[sid]");
			$sort_row=$dblink->fetch_array($query);
			header("location:admin.php?admin_action=sort_list&grade=3&sid=$sort_row[sid2]");
		}
		else
		{
			exit("error");
		}
	}
	else
	{
		$sid=intval($_GET['sid']);
		$query=$dblink->query("SELECT * FROM {$tablepre}sort WHERE sid=$sid");
		$sort_row=$dblink->fetch_array($query);
		if($sort_row['grade']==1)
		{
			$grade=1;
			$sortname=$sort_row['sort1'];
			$sortbar='/';
		}
		else if($sort_row['grade']==2)
		{
			$grade=2;
			$sortname=$sort_row['sort2'];
			$sortbar='/'.$sort_row['sort1'].'/';
		}
		else if($sort_row['grade']==3)
		{
			$grade=3;
			$sortname=$sort_row['sort3'];
			$sortbar='/'.$sort_row['sort1'].'/'.$sort_row['sort2'].'/';
		}
		
		admin_header();
?>
<script language="javascript">
function check_sortform(f)
{
 	if(f.sortname.value =="")
 	{
  		alert("<?php echo $msglang['write_sortname'];?>");
		f.sortname.focus();
		return false;
 	}
}
</script>
<br /><br />
<table cellspacing="1" cellpadding="0" width="85%" align="center" class="tableborder">
<tr><td>
	<table border="0" cellspacing="0" cellpadding="4" width="100%">
	<tr class="header"><td colspan=2><?php echo $lang['menu_sort_edit'];?></td></tr>
	<form method="get" action="admin.php" name="sortForm" onSubmit="return check_sortform(this)">
    <tr bgcolor="#F8F8F8"><td colspan=2 height="20"></td></tr>
     <tr bgcolor="#ffffff"> 
      <td width="80" height="25" align="right"><?php echo $lang['belong_to_sort'];?>:</td>
      <td align="left"><?php echo $sortbar;?></td>
    </tr>
     <tr bgcolor="#f8f8f8"> 
      <td width="80" height="25" align="right"><?php echo $lang['sortname'];?>:</td>
      <td align="left">
	<input name="sortname" type="text" size="30" maxlength="30" value="<?php echo $sortname;?>" />
        </td>
    </tr>
     <tr bgcolor="#ffffff"> 
      <td width="80" height="25" align="right"><?php echo $lang['arrange'];?>:</td>
      <td align="left">
	<input name="orderid" type="text" size="5" maxlength="2" value="<?php echo $sort_row['orderid'];?>" />
        </td>
    </tr>

    <tr bgcolor="#F8F8F8"> 
     <td width="80" height="25" align="right">&nbsp;</td>
     <td align="left">
        <input name="admin_action" type="hidden" value="sort_edit" />
        <input name="grade" type="hidden" value="<?php echo $grade;?>" />
        <input name="sid" type="hidden" value="<?php echo $sid;?>" />
		<input type="submit" value="<?php echo $lang['submit'];?>" name="edit_submit"> &nbsp;&nbsp;
        <input onclick="javascript:history.back();" type="button" value="<?php echo $lang['cancel'];?>" /> 
      </td></tr>
     <tr bgcolor="#ffffff"><td colspan=2 height="20"></td></tr>
  </form>
 </table>
</td></tr>
</table>
<?php
		admin_footer();
		exit();
	}
}
elseif($_GET['admin_action']=='sort_merge')
{
	if(isset($_GET['merge_submit']))
	{
		$sid=intval($_GET['sid']);
		$merge_sid=intval($_GET['merge_sid']);
		
		$query=$dblink->query("SELECT * FROM {$tablepre}sort WHERE sid=$sid");
		$from=$dblink->fetch_array($query);
		
		$query=$dblink->query("SELECT * FROM {$tablepre}sort WHERE sid=$merge_sid");
		$jointo=$dblink->fetch_array($query);

		if($jointo['grade']==1)
		{
			$dblink->query("UPDATE {$tablepre}_question SET sid1='$jointo[sid]' WHERE sid1=$sid");
			$dblink->query("UPDATE {$tablepre}sort SET sid1='$jointo[sid]',sort1='$jointo[sort1]' WHERE grade=2 AND sid1=$sid");
			$dblink->query("UPDATE {$tablepre}sort SET sid1='$jointo[sid]',sort1='$jointo[sort1]' WHERE grade=3 AND sid1=$sid");
			$dblink->query("DELETE FROM {$tablepre}sort WHERE sid=$sid");
			header("location:admin.php?admin_action=sort_list");
		}
		else if($jointo['grade']==2)
		{
			$dblink->query("UPDATE {$tablepre}_question SET sid2='$jointo[sid]' WHERE sid2=$sid");
			$dblink->query("UPDATE {$tablepre}sort SET sid2='$jointo[sid]',sort2='$jointo[sort2]' WHERE grade=3 AND sid2=$sid");
			$dblink->query("DELETE FROM {$tablepre}sort WHERE sid=$sid");
			header("location:admin.php?admin_action=sort_list&grade=2&sid=$jointo[sid1]");
		}
		else if($jointo['grade']==3)
		{
			$dblink->query("UPDATE {$tablepre}_question SET sid3='$jointo[sid]' WHERE sid3=$sid");
			$dblink->query("DELETE FROM {$tablepre}sort WHERE sid=$sid");
			header("location:admin.php?admin_action=sort_list&grade=3&sid=$jointo[sid2]");
		}
		else
		{
			exit("error");
		}
	}
	else
	{
		$sid=intval($_GET['sid']);
		
		$query=$dblink->query("SELECT * FROM {$tablepre}sort WHERE sid=$sid");
		$oldsort=$dblink->fetch_array($query);
		
		if($oldsort['grade']==1)
		{
			$sortname=$oldsort['sort1'];
			$query=$dblink->query("SELECT sid,sort1 AS sort FROM {$tablepre}sort WHERE grade=1 AND sid!=$sid ORDER BY orderid asc");
		}
		else if($oldsort['grade']==2)
		{
			$sortname=$oldsort['sort2'];
			$query=$dblink->query("SELECT sid,sort2 AS sort FROM {$tablepre}sort WHERE grade=2 AND sid1='$oldsort[sid1]' AND sid!=$sid ORDER BY orderid asc");
		}
		else if($oldsort['grade']==3)
		{
			$sortname=$oldsort['sort3'];
			$query=$dblink->query("SELECT sid,sort3 AS sort FROM {$tablepre}sort WHERE grade=3 AND sid2='$oldsort[sid2]' AND sid!=$sid ORDER BY orderid asc");
		}
		else
		{
			exit("error");
		}
		admin_header();
?>
<script language="javascript">
function check_sortform(f)
{
 	if(f.merge_sid.value =="0")
 	{
  		alert("请选择要合并到哪个分类");
		return false;
 	}
}
</script>
<br /><br />
<table cellspacing="1" cellpadding="0" width="85%" align="center" class="tableborder">
<tr><td>
	<table border="0" cellspacing="0" cellpadding="4" width="100%">
	<tr class="header"><td colspan=2><?php echo $lang['menu_sort_merge'];?></td></tr>
	<form name="sortForm" action="admin.php" method="get" onSubmit="return check_sortform(this)">
    <tr bgcolor="#F8F8F8"><td colspan=2 height="20"></td></tr>
     <tr bgcolor="#ffffff"> 
     <td width=300 height="25" align="right">
      <input size=30 value="<?php echo $sortname;?>" /> <?php echo $lang['menu_merge_to'];?> &nbsp;</td>
      <td align="left" valign="top">
       <select name="merge_sid" size="10">
       <option value="0" selected>&nbsp;</option>
      <?php
      while($sort_row=$dblink->fetch_array($query))
      {
		echo '<option value="'.$sort_row['sid'].'">'.$sort_row['sort'].'</option>';
      }
      ?>
      </select>
        </td>
    </tr>
	<tr bgcolor="#F8F8F8"><td colspan=2 height="20"></td></tr>
    <tr bgcolor="#ffffff">
    <td width=150 height="25"></td>
     <td align="left">
        <input name="admin_action" type="hidden" value="sort_merge" />
        <input name="sid" type="hidden" value="<?php echo $sid;?>" />
        <input type="submit" value="<?php echo $lang['submit'];?>" name="merge_submit"> &nbsp;&nbsp;
        <input onclick="javascript:history.back();" type="button" value="<?php echo $lang['cancel'];?>" /> 
      </td>
    </tr>
    <tr bgcolor="#f8f8f8"><td colspan=2 height="10"></td></tr>
  </form>
  </table>
</td></tr>
</table>
<?php
	admin_footer();
	exit();
	}
}
elseif($_GET['admin_action']=='sort_del')
{
	$sid=intval($_GET['sid']);
	$supersid=intval($_GET['supersid']);
	switch($grade)
	{
		case 1:
		$dblink->query("DELETE FROM {$tablepre}sort WHERE sid=$sid");
		$dblink->query("DELETE FROM {$tablepre}sort WHERE sid1=$sid");
		$dblink->query("DELETE FROM {$tablepre}question WHERE sid1=$sid");
		break;
		case 2:
		$dblink->query("DELETE FROM {$tablepre}sort WHERE sid=$sid");
		$dblink->query("DELETE FROM {$tablepre}sort WHERE sid2=$sid");
		$dblink->query("DELETE FROM {$tablepre}question WHERE sid2=$sid");
		break;
		case 3:
		$dblink->query("DELETE FROM {$tablepre}sort WHERE sid=$sid");
		$dblink->query("DELETE FROM {$tablepre}question WHERE sid3=$sid");
		break;
	}
	header("location:admin.php?admin_action=sort_list&grade=$grade&sid=$supersid");
}
else
{
	echo 'admin_action error';
}
?>
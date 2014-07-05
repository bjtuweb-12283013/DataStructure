<?php
require_once("../global.php");
require_once("../cache/s_cate_menu_array.php");
?>
function onLoadHandler() 
{
<?php
 foreach($nav_cate_menu_array as $key=>$value)
 { 
?>
var Desc_<?php echo $key;?> = new Object();
Desc_<?php echo $key;?>.menuDiv = document.getElementById("Memu_Desc_<?php echo $key;?>");
Desc_<?php echo $key;?>.menuLink = document.getElementById("Memu_Desc_<?php echo $key;?>_link");
Desc_<?php echo $key;?>.display = false;
Desc_<?php echo $key;?>.clickHandler = function(item) { window.open(item.link, "_parent"); };
<?php
$items="";
foreach($value as $key_2=>$value_2){$items=$items."{\"link\":\"s/?wd=".urlencode($value_2)."&s=".$key."\", \"text\":\"<font color=#000000>".$value_2."</font>\"},";}$items=rtrim($items,",");?>
Desc_<?php echo $key;?>.items =[<?php echo $items;?>];
popupMenu.createMenu(Desc_<?php echo $key;?>);
<?php
  }
?>
}
document.writeln("<script type=\"text\/javascript\" src=\"\/js\/popupmenu-2.js\"><\/script>");
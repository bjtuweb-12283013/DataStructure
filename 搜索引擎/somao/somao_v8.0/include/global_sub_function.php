<?php
function index_foothtml()
{
    global $db,$config;
?>
<p style="height:14px">
<?php
/*
官方网址:http://www.qiaso.com/
请不要修改作者的信息,做人要厚道啊!!!
讨论论坛:http://www.vz123.com/
作者:阿威
php阿威日记php+mysql
*/
$query=$db->query("select * from ve123_about where is_show order by sortid asc");
while($row=$db->fetch_array($query))
{
     if(!empty($row["url"]))
	 {
	    $url=$row["url"];
	 }
	 else
	 {
	    $url=$site["url"]."/a/".$row["filename"].".html";
	 }
?>
<a target="_blank" href="<?php echo $url;?>"><?php echo stripslashes($row["title"]);?></a> | 
<?php
}
?>
</p><p id=b><?php echo $config["copyright"];?> <a href=#>使用<?php echo $site["name"];?>前必读</a> <a href=http://www.miibeian.gov.cn target=_blank><?php echo $site["icp"];?></a>
<!--Powered by <a target="_blank" href="http://www.zeidu.com/">ZeiDu</a>-->&nbsp;<a target="_blank" href="http://www.miibeian.gov.cn/"><?php echo $config["icp"];?></a><img src=images/gs.gif>
</p>
<?php
}
?>
<?php
function pageshow($page,$totalpage,$total,$filename)
{   
    $str="<div class=\"pagestyle\">";
    $str=$str."<a href=\"".$filename."page=1\">第一页</a>&nbsp;";
    if($page==1)
    {
        $str=$str."上一页&nbsp;";
    }
    else
    {
        $str=$str."<a href=\"".$filename."page=".($page-1)."\">上一页</a>&nbsp;";
    }

 if ($page>=$totalpage)
 {
   $str=$str."下一页&nbsp;";
 }
 else
 {
   $str=$str."<a href=\"".$filename."page=".($page+1)."\">下一页</a>&nbsp;";
 }
$str=$str."<a href=\"".$filename."page=$totalpage\">最后一页</a>&nbsp;";
$str=$str."当前第".$page."页&nbsp;";
$str=$str."共".$totalpage."页&nbsp;";
$str=$str."共".$total."个记录&nbsp;";
$str=$str."</div>";
return $str;
}
?>
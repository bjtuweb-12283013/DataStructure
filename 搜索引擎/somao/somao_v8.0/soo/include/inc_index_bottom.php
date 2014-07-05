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
     if(stristr($row["url"],"http://"))
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
</p><p id=b>&copy;2009 Feimao <a href=#>使用<?php echo $site["name"];?>前必读</a> <a href=http://www.miibeian.gov.cn target=_blank><?php echo $site["icp"];?></a>
<img src=<?php echo $site["url"];?>/images/gs.gif></p>

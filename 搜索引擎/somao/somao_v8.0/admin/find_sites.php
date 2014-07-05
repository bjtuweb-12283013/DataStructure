<?php
error_reporting(0);
set_time_limit(0);
require("global.php");
require_once(PATH."include/spider/spider_class.php");
$spider=new spider;
headhtml();
?>
<table width="100%" border="0" cellpadding="3" cellspacing="1" class="tablebg">
  <tr>
    <td><form id="form1" name="form1" method="post" action="?action=start">
      <input type="submit" name="Submit" value="开始一键找站" />
        </form>
    </td>
  </tr>
</table>
<?php
$action=HtmlReplace(trim($_GET["action"]));
switch($action)
{
     case "start":
	 start();
	 break;
}
function start()
{
     global $spider;
	 echo "正在处理中...<br>";
     print str_repeat(" ", 4096);
     ob_flush();
     flush();
     sleep(1);
     $url="http://www.hao123.com/";
     $spider->url($url);
     $fulltxt=$spider->fulltxt(800);
	 $links= $spider->links();
     $sites= $spider->sites();
	//
	//add_sites($sites);
	sleep(2);
	foreach($links as $value)
	{
	     $num=count(explode($url,$value));
		 //echo $value.$num."<br>";
		 if($num==2)
		 {
               $spider->url($url);
               $sites= $spider->sites();
			   add_sites($sites);
	           sleep(2);
		 }
		     
		 
	}
}
?>
<?php
function add_sites($array)
{
    global $db,$spider;
	foreach($array as $value)
	{
	      $row=$db->get_one("select * from ve123_links where url='".$value."'");
		  {
		        if(empty($row))
				{
				     echo $value."<br>";
				     $spider->url($value);
                     $title=$spider->title;
                     $fulltxt=$spider->fulltxt(800);
	                 $keywords=$spider->keywords;
                     $description=$spider->description;
                     $pagesize=$spider->pagesize;
					 $htmlcode=$spider->htmlcode;
                     $array=array('url'=>$value,'title'=>$title,'fulltxt'=>$fulltxt,'pagesize'=>$pagesize,'keywords'=>$keywords,'description'=>$description,'addtime'=>time(),'updatetime'=>time());//echo $fulltxt;
                     $db->insert("ve123_links",$array);
	                 file_put_contents(PATH."k/www/".base64_encode($value),$htmlcode);//echo $htmlcode;
				}
				else
				{
				      echo "已存在:".$value."<br>";
				}
				ob_flush();
                flush();
				sleep(1);
		  }
	}
}
?>

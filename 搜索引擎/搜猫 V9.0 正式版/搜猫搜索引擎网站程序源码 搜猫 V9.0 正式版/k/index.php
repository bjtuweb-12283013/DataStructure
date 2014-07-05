<?php
require "../global.php";
require "../include/spider/spider_class.php";
$query_string= base64_decode($_SERVER['QUERY_STRING']);
parse_str($query_string);
//header("location:".$url);
?>
  <meta http-equiv="Content-Type" content="text/html;charset=gb2312">
  <base href="<?php echo $url;?>">
  <style>
  body{margin:4px 0}
  #bd_sn_h{text-align:left;background-color:#ffffff;color:#000000}
  #bd_sn_h #p1{clear:both;font:14px Arial;margin:0 0 0 2px;padding:4px 0 0 0}
  #bd_sn_h a{color:#0000ff;text-decoration:underline}
  #bd_sn_h #p1 a{font-weight:bold}
  #baidu div{position:static}
  </style>

<table id="baidu" width="100%" cellpadding="0" cellspacing="0" border="0">
<tr><td>
  <div style="text-align:left;background-color:#ffffff;color:#000000">
    <div style="margin:6px 18px 0 10px;float:left"><a href="<?php echo $config["url"];?>"><img style="border:0px" alt="到<?php echo $config["name"];?>首页" src="<?php echo $config["url"]?>/images/log.gif"></a></div>
    <div style="margin:27px 0 0 0;float:left">
      <form style="margin:0;padding:0" action="<?php echo $config["url"]?>/s"> 
      <input name="wd" size="35" style="font:16px Arial"> <input type="submit" value="<?php echo $config["name"];?>一下">
   	  </form>
    </div>
	<p style="clear:both;font:14px Arial;margin:0 0 0 2px;padding:4px 0 0 0;width:100%;text-align:left;background-color:#ffffff;color:#000000">您查询的关键词仅在网页标题或指向此网页的链接中出现。</p>
	<p style="font:12px Arial;color:gray;margin:0 2px;width:100%text-align:left;background-color:#ffffff">(<?php echo $config["name"];?>和网页<a style="color:#0000ff;text-decoration:underline" href="<?php echo $url;?>"><?php echo $url;?></a>的作者无关，不对其内容负责。<?php echo $config["name"];?>快照谨为网络故障时之索引，不代表被搜索网站的即时页面。)</p>
	<hr style="margin:8px 0;width:100%">
  </div>
</td></tr>
</table>
  <div style="position:relative">
<?php
//header("location:".$row["url"]."");
$file_name="www/".str_replace("http://","",$url.".html");
if(file_exists($file_name))
{
    $htmlcode=file_get_contents($file_name);//echo $file_name;
}
if(empty($htmlcode))
{
   $spider=new spider;
   $spider->url($url);
   $htmlcode=$spider->htmlcode;
}


   
   $htmlcode=replace_html($htmlcode);
  /* foreach(explode(" ",$wd) as $value)
   {
       $htmlcode=str_replace($value,"<font background=#FFFF00>".$value."</font>",$htmlcode);
   }*/
 echo $htmlcode;
 /*
 $fp=@fopen("www/".str_replace("http://","",$url.".html"),"w") or die("写方式打开文件失败，请检查程序目录是否为可写");//配置conn.php文件
 @fputs($fp,$htmlcode) or die("文件写入失败,请检查程序目录是否为可写"); 
 @fclose($fp);
 */
?>
<?php
function replace_html($string){
$pattern=array ("'<script[^>]*?>.*?</script>'si",// 去掉 javascript
"'<!--[/!]*?[^<>]*?>'si", // 去掉 注释标记
"'<iframe[^>]*?>.*?</iframe>'si");
$replace=array ("", "", "");
return preg_replace($pattern, $replace, $string);
}
?>
<div style="text-align:center;margin-top:3px;"><a target="_blank" href="<?php echo $config["url"];?>">Powered by <?php echo $config["name"];?></a></div>
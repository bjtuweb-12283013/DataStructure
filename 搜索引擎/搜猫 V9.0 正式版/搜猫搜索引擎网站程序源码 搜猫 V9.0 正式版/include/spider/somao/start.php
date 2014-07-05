<?php
set_time_limit(0);
//error_reporting(0);
require "global.php";
require "../qp.class.php";
?>
<link rel="stylesheet" href="xp.css" type="text/css">


<body>
<?php
$action=HtmlReplace($_GET["action"]);
switch($action)
{
     case "auto_update":
	 auto_update();
	 break;
	 case "findsite":
	 findsite();
	 break;
	 case "add_in_site_link":
	 add_in_site_link(intval($_GET["site_id"]));
	 break;
	 
	 case "add_all_lry":
	 add_all_lry(intval($_GET["site_id"]));
	 break;
	 	 case "zhua_sites":
	 	 zhua_sites(intval($_GET["site_id"]));
		 break;
		 case "geng_sites":
	 	 geng_sites(intval($_GET["site_id"]));
		 break;
	case "add_new_page":
    add_new_page($_GET["site_id"]);
	break;
	 	 case "add_new_page_step_2":
		 add_new_page(intval($_GET["site_id"]));
		 break;
	 case "update_in_site_link":
	 update_in_site_link();
	 break;
	 case "add_all_site_link":
	 add_all_site_link();
	 break;
	 case "update_qp":
	 echo "正在处理中...<br>";
     print str_repeat(" ", 4096);
     ob_flush();
     flush();
     //sleep(1);
	 update_qp($_GET["url"]);
	 break;
	 case "update_all_qp":
	 echo "正在处理中...<br>";
     print str_repeat(" ", 4096);
     ob_flush();
     flush();
     //sleep(1);
	 update_all_qp($_GET["url"]);
	 break;
	 case "update_not_qp":
	 echo "正在处理中...<br>";
     print str_repeat(" ", 4096);
     ob_flush();
     flush();
     //sleep(1);
	 update_all_qp($_GET["url"],0);
	 break;
}
?>
</body>
</html>
<?php
function auto_update()
{
        echo "<b>全部--内容更新中...</b>起始时间:";
		$oldtime1=time();
	    echo date("Y年m月d日 H:i:s",$oldtime1);
	    echo "<br>";
     print str_repeat(" ", 4096);
     ob_flush();
     flush();
     //sleep(1);
    Update_All_Link("",0,0);
	   echo "<br><b>全部更新完成</b> 完成时间:";
	   $newtime1=time();
	   echo date("Y年m月d日 H:i:s",$newtime1);
	   echo "  --- <b>用时:</b>";
	   echo date("H:i:s",$newtime1-$oldtime1-28800);
	   echo "<br>";
}
function findsite()
{
     global $action;
     $do=$_GET["do"];
	 $url=$_GET["url"];
?>
<table width="98%" border="1" align="center" cellpadding="5" cellspacing="0" bordercolordark="#FFFFFF" bordercolor="888888">
  <tr>
    <td><form id="form1" name="form1" method="get">
      网址:
          <input name="url" type="text" value="<?php echo $url;?>" size="50"/>
		  <input name="do" type="hidden" value="start" />
		  <input name="action" type="hidden" value="<?php echo $action;?>" />
        <input type="submit" value="提交" /><br>
    (此功能可以把一个网址站的所有的网站收录下来)<font color="red">顶级域名请以"/"结尾</font>
    </form>
	<?php
	if($do=="start")
	{
		find_sites($url);
	}
	?>
    </td>
  </tr>
</table>
<?php
}
?>
<?php


function add_new_page($site_id)
{
	     add_new_page_step_1($site_id);
}
function add_new_page_step_1($site_id)
{
    global $db;
	   $site=$db->get_one("select * from ve123_sites where site_id='".$site_id."'");
	   $url=$site["url"];
	   $spider_depth=$site["spider_depth"];
	   if($spider_depth==0||$spider_depth>0)
	   {    
	         $query=$db->query("select * from ve123_links where url='$url'");
	         $num=$db->num_rows($query);
	         if($num==0)
	         {
	             add_update_link($url,$site_id,0,"add");
				 $array=array('indexdate'=>time());
				 $db->update("ve123_sites",$array,"site_id='".$site_id."'");
				 echo $url."<br>";
			 }
			 
	   }
	  if($spider_depth>0)
	   {
              insert_url_temp($site_id,$url,1);
              add_new_page_step_2($site_id,1);
	   }
	   echo "收录完毕,<a href=\"".$_SERVER['HTTP_REFERER']."\">返回上一页</a>";
}

function insert_url_temp($site_id,$url,$level)
{
   global $db;
    	 	  $url_htmlcode=get_url_content($url);
    	      $url_htmlcode=get_encoding($url_htmlcode,"GB2312");
    	      $links=get_links($url_htmlcode, $url, 1, $url);
		      //echo $url;
			 // print_r ($links);
		      foreach($links as $key=>$value)
		      {
	 	              $array=array('no_id'=>$key,'site_id'=>$site_id,'updatetime'=>$level,'url'=>$value);
	                  $query=$db->query("select * from ve123_links_temp where url='".$value."'");
	                  $num=$db->num_rows($query);
	                  if($num==0)
	                 {
		   	             $db->insert("ve123_links_temp",$array);
					  }
					  else
					  {
					     $db->update("ve123_links_temp",$array,"url='".$value."'");
					  }
		      }
}

function get_url_content($url)
 {
        $data=getFileContents($url);
		if($data["state"]=="ok")
		{
		     return $data["file"];
		}
		else
		{
		    return getfile($url);
		}
}
function getFileContents($url) {
	global $site;
	$user_agent=$site['user_agent']."+(^_^".$site["url"].") ";
	//$user_agent="qiaso";
	$urlparts = parse_url($url);
	$path = $urlparts['path'];
	$host = $urlparts['host'];
	if ($urlparts['query'] != "")
		$path .= "?".$urlparts['query'];
	if (isset ($urlparts['port'])) {
		$port = (int) $urlparts['port'];
	} else
		if ($urlparts['scheme'] == "http") {
			$port = 80;
		} else
			if ($urlparts['scheme'] == "https") {
				$port = 443;
			}

	if ($port == 80) {
		$portq = "";
	} else {
		$portq = ":$port";
	}

	$all = "*/*";
    if(empty($path))
	{
	    $path="/";
	}
	$request = "GET $path HTTP/1.0\r\nHost: $host$portq\r\nAccept: $all\r\nUser-Agent: $user_agent\r\n\r\n";
//echo $request;
	$fsocket_timeout = 30;
	if (substr($url, 0, 5) == "https") {
		$target = "ssl://".$host;
	} else {
		$target = $host;
	}


	$errno = 0;
	$errstr = "";
	//print "siin";
	$fp = @ fsockopen($target, $port, $errno, $errstr, $fsocket_timeout);

	//print $errstr;
	if (!$fp) {
		$contents['state'] = "NOHOST";
		//printConnectErrorReport($errstr);
		return $contents;
	} else {
		if (!fputs($fp, $request)) {
			$contents['state'] = "Cannot send request";
			return $contents;
		}
		$data = null;
		socket_set_timeout($fp, $fsocket_timeout);
		do{
			$status = socket_get_status($fp);
			$data .= fgets($fp, 8192);
		} while (!feof($fp) && !$status['timed_out']) ;

		fclose($fp);
		if ($status['timed_out'] == 1) {
			$contents['state'] = "timeout";
		} else
			$contents['state'] = "ok";
		$contents['file'] = substr($data, strpos($data, "\r\n\r\n") + 4);
	}
	return $contents;
}

function get_links($file, $url, $can_leave_domain, $base) {

	$chunklist = array ();
    // The base URL comes from either the meta tag or the current URL.
    if (!empty($base)) {
        $url = $base;
    }

	$links = array ();
	$regs = Array ();
	$checked_urls = Array();

	preg_match_all("/href\s*=\s*[\'\"]?([+:%\/\?~=&;\\\(\),._a-zA-Z0-9-]*)(#[.a-zA-Z0-9-]*)?[\'\" ]?(\s*rel\s*=\s*[\'\"]?(nofollow)[\'\"]?)?/i", $file, $regs, PREG_SET_ORDER);
	foreach ($regs as $val) {
		if ($checked_urls[$val[1]]!=1 && !isset ($val[4])) { //if nofollow is not set
			if (($a = url_purify($val[1], $url, $can_leave_domain)) != '') {
				$links[] = $a;
			}
			$checked_urls[$val[1]] = 1;
		}
	}
	preg_match_all("/(frame[^>]*src[[:blank:]]*)=[[:blank:]]*[\'\"]?(([[a-z]{3,5}:\/\/(([.a-zA-Z0-9-])+(:[0-9]+)*))*([+:%\/?=&;\\\(\),._ a-zA-Z0-9-]*))(#[.a-zA-Z0-9-]*)?[\'\" ]?/i", $file, $regs, PREG_SET_ORDER);
	foreach ($regs as $val) {
		if ($checked_urls[$val[1]]!=1 && !isset ($val[4])) { //if nofollow is not set
			if (($a = url_purify($val[1], $url, $can_leave_domain)) != '') {
				$links[] = $a;
			}
			$checked_urls[$val[1]] = 1;
		}
	}
	preg_match_all("/(window[.]location)[[:blank:]]*=[[:blank:]]*[\'\"]?(([[a-z]{3,5}:\/\/(([.a-zA-Z0-9-])+(:[0-9]+)*))*([+:%\/?=&;\\\(\),._ a-zA-Z0-9-]*))(#[.a-zA-Z0-9-]*)?[\'\" ]?/i", $file, $regs, PREG_SET_ORDER);
	foreach ($regs as $val) {
		if ($checked_urls[$val[1]]!=1 && !isset ($val[4])) { //if nofollow is not set
			if (($a = url_purify($val[1], $url, $can_leave_domain)) != '') {
				$links[] = $a;
			}
			$checked_urls[$val[1]] = 1;
		}
	}
	preg_match_all("/(http-equiv=['\"]refresh['\"] *content=['\"][0-9]+;url)[[:blank:]]*=[[:blank:]]*[\'\"]?(([[a-z]{3,5}:\/\/(([.a-zA-Z0-9-])+(:[0-9]+)*))*([+:%\/?=&;\\\(\),._ a-zA-Z0-9-]*))(#[.a-zA-Z0-9-]*)?[\'\" ]?/i", $file, $regs, PREG_SET_ORDER);
	foreach ($regs as $val) {
		if ($checked_urls[$val[1]]!=1 && !isset ($val[4])) { //if nofollow is not set
			if (($a = url_purify($val[1], $url, $can_leave_domain)) != '') {
				$links[] = $a;
			}
			$checked_urls[$val[1]] = 1;
		}
	}

	preg_match_all("/(window[.]open[[:blank:]]*[(])[[:blank:]]*[\'\"]?(([[a-z]{3,5}:\/\/(([.a-zA-Z0-9-])+(:[0-9]+)*))*([+:%\/?=&;\\\(\),._ a-zA-Z0-9-]*))(#[.a-zA-Z0-9-]*)?[\'\" ]?/i", $file, $regs, PREG_SET_ORDER);
	foreach ($regs as $val) {
		if ($checked_urls[$val[1]]!=1 && !isset ($val[4])) { //if nofollow is not set
			if (($a = url_purify($val[1], $url, $can_leave_domain)) != '') {
				$links[] = $a;
			}
			$checked_urls[$val[1]] = 1;
		}
	}

	return $links;
}


function url_purify($url, $parent_url, $can_leave_domain) {
	global $ext, $mainurl, $apache_indexes, $strip_sessids;



	$urlparts = parse_url($url);

	$main_url_parts = parse_url($mainurl);
	if ($urlparts['host'] != "" && $urlparts['host'] != $main_url_parts['host']  && $can_leave_domain != 1) {
		return '';
	}
	
	reset($ext);
	while (list ($id, $excl) = each($ext))
		if (preg_match("/\.$excl$/i", $url))
			return '';

	if (substr($url, -1) == '\\') {
		return '';
	}



	if (isset($urlparts['query'])) {
		if ($apache_indexes[$urlparts['query']]) {
			return '';
		}
	}

	if (preg_match("/[\/]?mailto:|[\/]?javascript:|[\/]?news:/i", $url)) {
		return '';
	}
	if (isset($urlparts['scheme'])) {
		$scheme = $urlparts['scheme'];
	} else {
		$scheme ="";
	}



	//only http and https links are followed
	if (!($scheme == 'http' || $scheme == '' || $scheme == 'https')) {
		return '';
	}

	//parent url might be used to build an url from relative path
	$parent_url = remove_file_from_url($parent_url);
	$parent_url_parts = parse_url($parent_url);


	if (substr($url, 0, 1) == '/') {
		$url = $parent_url_parts['scheme']."://".$parent_url_parts['host'].$url;
	} else
		if (!isset($urlparts['scheme'])) {
			$url = $parent_url.$url;
		}

	$url_parts = parse_url($url);

	$urlpath = $url_parts['path'];

	$regs = Array ();
	
	while (preg_match("/[^\/]*\/[.]{2}\//", $urlpath, $regs)) {
		$urlpath = str_replace($regs[0], "", $urlpath);
	}

	//remove relative path instructions like ../ etc 
	$urlpath = preg_replace("/\/+/", "/", $urlpath);
	$urlpath = preg_replace("/[^\/]*\/[.]{2}/", "",  $urlpath);
	$urlpath = str_replace("./", "", $urlpath);
	$query = "";
	if (isset($url_parts['query'])) {
		$query = "?".$url_parts['query'];
	}
	if ($main_url_parts['port'] == 80 || $url_parts['port'] == "") {
		$portq = "";
	} else {
		$portq = ":".$main_url_parts['port'];
	}
	$url = $url_parts['scheme']."://".$url_parts['host'].$portq.$urlpath.$query;

	//if we index sub-domains
	if ($can_leave_domain == 1) {
		return $url;
	}

	$mainurl = remove_file_from_url($mainurl);
	
	if ($strip_sessids == 1) {
		$url = remove_sessid($url);
	}
	//only urls in staying in the starting domain/directory are followed	
	$url = convert_url($url);
	if (strstr($url, $mainurl) == false) {
		return '';
	} else
		return $url;
}

function remove_file_from_url($url) {
	$url_parts = parse_url($url);
	$path = $url_parts['path'];

	$regs = Array ();
	if (preg_match('/([^\/]+)$/i', $path, $regs)) {
		$file = $regs[1];
		$check = $file.'$';
		$path = preg_replace("/$check"."/i", "", $path);
	}

	if ($url_parts['port'] == 80 || $url_parts['port'] == "") {
		$portq = "";
	} else {
		$portq = ":".$url_parts['port'];
	}

	$url = $url_parts['scheme']."://".$url_parts['host'].$portq.$path;
	return $url;
}

function clean_file($file, $url, $type) {
	global $entities, $index_host, $index_meta_keywords;
$index_meta_keywords = 1;
$index_host		 = 0;
	$urlparts = parse_url($url);
	$host = $urlparts['host'];
	//remove filename from path
	$path = eregi_replace('([^/]+)$', "", $urlparts['path']);
	$file = preg_replace("/<link rel[^<>]*>/i", " ", $file);
	$file = preg_replace("@<!--sphider_noindex-->.*?<!--\/sphider_noindex-->@si", " ",$file);	
	$file = preg_replace("@<!--.*?-->@si", " ",$file);	
	$file = preg_replace("@<script[^>]*?>.*?</script>@si", " ",$file);
	$headdata = get_head_data($file);
	$regs = Array ();
	if (preg_match("@<title *>(.*?)<\/title*>@si", $file, $regs)) {
		$title = trim($regs[1]);
		$file = str_replace($regs[0], "", $file);
	} else if ($type == 'pdf' || $type == 'doc') { //the title of a non-html file is its first few words
		$title = substr($file, 0, strrpos(substr($file, 0, 40), " "));
	}

	$file = preg_replace("@<style[^>]*>.*?<\/style>@si", " ", $file);

	//create spaces between tags, so that removing tags doesnt concatenate strings
	$file = preg_replace("/<[\w ]+>/", "\\0 ", $file);
	$file = preg_replace("/<\/[\w ]+>/", "\\0 ", $file);
	$file = strip_tags($file);
	$file = preg_replace("/&nbsp;/", " ", $file);

	$fulltext = $file;
	$file .= " ".$title;
	if ($index_host == 1) {
		$file = $file." ".$host." ".$path;
	}
	if ($index_meta_keywords == 1) {
		$file = $file." ".$headdata['keywords'];
	}
	
	
	//replace codes with ascii chars
	$file = preg_replace('~&#x([0-9a-f]+);~ei', 'chr(hexdec("\\1"))', $file);
    $file = preg_replace('~&#([0-9]+);~e', 'chr("\\1")', $file);
	$file = strtolower($file);
	reset($entities);
	while ($char = each($entities)) {
		$file = preg_replace("/".$char[0]."/i", $char[1], $file);
	}
	$file = preg_replace("/&[a-z]{1,6};/", " ", $file);
	$file = preg_replace("/[\*\^\+\?\\\.\[\]\^\$\|\{\)\(\}~!\"\/@#?%&=`?><:,]+/", " ", $file);
	$file = preg_replace("/\s+/", " ", $file);
	$data['fulltext'] = addslashes($fulltext);
	$data['content'] = addslashes($file);
	$data['title'] = addslashes($title);
	$data['description'] = $headdata['description'];
	$data['keywords'] = $headdata['keywords'];
	$data['host'] = $host;
	$data['path'] = $path;
	$data['nofollow'] = $headdata['nofollow'];
	$data['noindex'] = $headdata['noindex'];
	$data['base'] = $headdata['base'];

	return $data;

}


function get_head_data($file) {
	$headdata = "";
           
	preg_match("@<head[^>]*>(.*?)<\/head>@si",$file, $regs);	
	
	$headdata = $regs[1];

	$description = "";
	$robots = "";
	$keywords = "";
    $base = "";
	$res = Array ();
	if ($headdata != "") {
		preg_match("/<meta +name *=[\"']?robots[\"']? *content=[\"']?([^<>'\"]+)[\"']?/i", $headdata, $res);
		if (isset ($res)) {
			$robots = $res[1];
		}

	//	preg_match("@<title *>(.*?)<\/title*>@si", $headdata, $res);
	//	if (isset ($res)) {
		//	$title = $res[1];
		//}
		//$title=cut($headdata,"<title>", "</title>" );
		preg_match("/<meta +name *=[\"']?description[\"']? *content=[\"']?([^<>'\"]+)[\"']?/i", $headdata, $res);
		if (isset ($res)) {
			$description = $res[1];
		}

		preg_match("/<meta +name *=[\"']?keywords[\"']? *content=[\"']?([^<>'\"]+)[\"']?/i", $headdata, $res);
		if (isset ($res)) {
			$keywords = $res[1];
		}
        // e.g. <base href="http://www.consil.co.uk/index.php" />
		preg_match("/<base +href *= *[\"']?([^<>'\"]+)[\"']?/i", $headdata, $res);
		if (isset ($res)) {
			$base = $res[1];
		}
		$keywords = preg_replace("/[, ]+/", " ", $keywords);
		$robots = explode(",", strtolower($robots));
		$nofollow = 0;
		$noindex = 0;
		foreach ($robots as $x) {
			if (trim($x) == "noindex") {
				$noindex = 1;
			}
			if (trim($x) == "nofollow") {
				$nofollow = 1;
			}
		}
		$data['description'] = addslashes($description);
		$data['keywords'] = addslashes($keywords);
		//$data['title'] = addslashes($title);
		$data['nofollow'] = $nofollow;
		$data['noindex'] = $noindex;
		$data['base'] = $base;
	}
	return $data;
}

function add_new_page_step_2($site_id,$level)
{
    global $db;
			  $sql="select * from ve123_links_temp where site_id='".$site_id."' and updatetime='".$level."'";
			  $query=$db->query($sql);
              $total=$db->num_rows($query);//记录总数
			  $pagesize=10;//每页显示数
              $totalpage=ceil($total/$pagesize);
              $page=intval($_GET["page"]);
              if($page<=0){$page=1;}
              $offset=($page-1)*$pagesize;
			  $sql=$sql." limit $offset,$pagesize";
			  echo $sql;
			  //die();
	          $query=$db->query($sql);
             // $str="<html><head><title></title><link rel=\"stylesheet\" href=\"images/maincss.css\">";
            //  $str.="<meta http-equiv='Content-Type' content='text/html; charset=gb2312'></head><body >";
             $str.="<b>网站正在收录中……请稍候!<br>总共需要收录 <font color='red'><b>$total</b></font> 个网页，每页收录 <font color='red'><b>$pagesize</b></font> 个网站，共需要分 <font color='red'><b>$totalpage</b></font> 页，当前正在收录 <font color='red'><b>$page</b></font> 页<br>";
		   // flush();
	          while($row=$db->fetch_array($query))
	         {
	               $query_links=$db->query("select * from ve123_links where url='".$row["url"]."'");
	               $num=$db->num_rows($query_links);
	               if($num==0)
	               {
				        add_update_link($row["url"],$site_id,$level,"add");
	                    
					}
					$str=$str.$row["url"]."<br>";
         	 }
			if($page<=$totalpage)
			 {
			   $str.="<a href=\"sites.php?action=options&site_id=".$site_id."\">点此停止收录</a>";
               $str.="<meta http-equiv=\"refresh\" content=3;url='?action=add_new_page_step_2&site_id=".$site_id."&updatetime=".$level."&page=".($page+1)."'>";
               
			 }
			 else
			{
			     $str.="收录完毕<br>";
				 $str.="<a href=\"sites.php?action=options&site_id=".$site_id."\">返回上一页</a>";
			}
			$str.="</body></html>";
            echo $str;
			die();
}

function add_all_site_link()
{
   global $db;
      echo "<b>全部--网址抓取中...</b>起始时间:";
	  $oldtime2=time();
	  echo date("Y年m月d日 H:i:s",$oldtime2);
	  echo "<br>";
     print str_repeat(" ", 4096);
     ob_flush();
     flush();
     //sleep(1);
	 $query=$db->query("select * from ve123_sites order by site_id");
	 while($row=$db->fetch_array($query))
	 {
	     // $db->query("update ve123_sites set indexdate='".time()."' where site_id='".$site_id."'");
	      echo "<br>正在处理网站".$row["url"]."<br>";
		  ob_flush();
          flush();
          //sleep(1);
		  add_in_site_link($row["site_id"]);
	 }
	  echo "<br><b>全部抓取完成</b> 完成时间:";
	  $newtime2=time();
	  echo date("Y年m月d日 H:i:s",$newtime2);
	   echo "  --- <b>用时:</b>";
	   echo date("H:i:s",$newtime2-$oldtime2-28800);
	   echo "<br>";
}

//抓全站---多线程
function add_all_lry($site_id)
{
	  $oldtime=time();
     print str_repeat(" ", 4096);
     ob_flush();
     flush();
     //sleep(1);
     global $db;
	   $site=$db->get_one("select * from ve123_sites where site_id='".$site_id."'");
	   	$url=$site["url"];
   		$include_word=$site["include_word"];  
   		$not_include_word=$site["not_include_word"]; 
   
	 	Updan_link($url,$site_id);

	 	 echo "<b>收录全站</b>";
		 echo "原始页=".$url." - - <首层 id=".$site_id."> - - <包含字段=".$include_word."> - - <不包含字段=".$not_include_word.">";   
		 $ceng=1;
		 $lry=1;
		 all_links_duo($site_id,$ceng,$include_word,$not_include_word,$lry); 
		 echo "<b>全站收录完毕</b><br>";
	   $newtime=time();
	   echo "  --- <b>用时:</b>";
	   echo date("H:i:s",$newtime-$oldtime-28800);
	   echo "<br>";
	   del_links_temp($site_id);
}		 



//一键抓站  多线程
function zhua_sites($site_id)
{
	  $oldtime=time();
     print str_repeat(" ", 4096);
     ob_flush();
     flush();


     	global $db;
	    $site=$db->get_one("select * from ve123_site_find where site_id='".$site_id."'");
	   	$url=$site["url"];
   
	 	Updan_zhua($url,$site_id);

	 	 echo "<b>抓网站</b>";
		 echo "网址站=".$url." - - < id=".$site_id.">";   
		 $ceng=1;
		 find_sites($site_id,$ceng); 
		 echo "<b>全站抓取完毕</b><br>";
		 
		 
	   $newtime=time();
	   echo "  --- <b>用时:</b>";
	   echo date("H:i:s",$newtime-$oldtime-28800);
	   echo "<br>";
	   del_sites_temp($site_id);
}


//一键更新已抓站  多线程
function geng_sites($site_id)
{
	  $oldtime=time();
     print str_repeat(" ", 4096);
     ob_flush();
     flush();

	 	 echo "<b>开始更新已抓站</b><br>";
		 Update_sites($site_id);
		 echo "<b>所有站更新完毕</b><br>";
		 
	   $newtime=time();
	   echo "  --- <b>用时:</b>";
	   echo date("H:i:s",$newtime-$oldtime-28800);
	   echo "<br>";
}

		 
function add_in_site_link($site_id)
{
     echo "<b>起始网址:</b>";
	  $oldtime=time();
     print str_repeat(" ", 4096);
     ob_flush();
     flush();
     //sleep(1);
     global $db;
	   $site=$db->get_one("select * from ve123_sites where site_id='".$site_id."'");
	   $url=$site["url"];
	   $fpr=$site["fpr"];
	   $pagestart=$site["pagestart"];
	   $pagestop=$site["pagestop"];
	   $pageadd=$site["pageadd"];
	   
	    //$site_id=$site["site_id"];
   		$include_word=$site["include_word"];  
   		$not_include_word=$site["not_include_word"]; 
   		$spider_depth=$site["spider_depth"];

	 
//从ve123_sites 中读取一网址 创建到ve123_links 表和ve123_links_temp 表中	   
	 	Updan_link($url,$site_id);

	 
 //收录全站---多线程
	 if($spider_depth==-1)
	 { 
	 	 echo "<b>收录全站</b>";
		 echo "原始页=".$url." - - <首层 id=".$site_id."> - - <包含字段=".$include_word."> - - <不包含字段=".$not_include_word.">";   
		 $ceng=1;
		 $lry=1;
		 all_links_duo($site_id,$ceng,$include_word,$not_include_word,$lry); 
		 echo "<b>全站收录完毕</b><br>";
	 }	 

//分析ve123_sites 得到的网址中的所有链接,创建到ve123_links_temp 表中,再通过包含不包含字段过滤,把过滤后的链接创建到ve123_links表中	 
	 if($spider_depth==1)  
	 {
		 //echo "<br>";
	 	 if($fpr=="1"){
 		   if(strpos($url,"{page}")===false){
		        echo ":( 抓取失败！您如果选择的是多页抓取 ，抓取的网址就必须含有{page} {page}作为你翻页的变量";
 		       return false;
 		  		 }
 		   for($s=$pagestart;$s<=$pagestop;$s=$s+$pageadd){
  		      $urlgo=str_replace("{page}",$s,$url);
				 echo "<br>";
	  			 echo "-------------------------------------------------------第 "; 
				 echo $pagestart;
				 echo " 页-------------------------------------------------------";
				 echo "<br>";
				 echo $urlgo;
				 echo "<br>";
				all_url_dan($urlgo,$url,1,0,$site_id,$include_word,$not_include_word);
  		      $pagestart =$pagestart+$pageadd;
  		  		}    
			}
		else{
			all_url_dan($url,$url,1,0,$site_id,$include_word,$not_include_word);
			}
	 }	 

//读出ve123_links_temp 中所有包含 url 的链接,利用循环数组把得到 url 分析所有页面中的链接创建到ve123_links_temp 表中,再把过滤后的链接创建到ve123_links 表中	   
	 if($spider_depth>1)  
	 {	$ceng=1;
	    $lry=1;
	 	for($i=$spider_depth; $i>0; $i--) 
		{	
			echo "<br><b>开始抓取第".$ceng."层</b>";
			$ceng++;
			//$domain=0;
			$roo=$db->get_one("select * from ve123_links_temp where site_id='".$site_id."' and no_id='0'");
			if(empty($roo)){echo "  ---------- 没有新链接了<br>";break;}
			
			$query=$db->query("select * from ve123_links_temp where site_id='".$site_id."' and no_id='0'");
	  		while($row=$db->fetch_array($query))
	  		{
				$url=$row["url"];
	        	echo "<br><font color='#aaaaaa'>".$lry.".</font>";
				$lry++; 
				all_url_dan($url,$url,1,1,$site_id,$include_word,$not_include_word);
				$arral=array('no_id'=>1);
				$db->update("ve123_links_temp",$arral,"url='$url'");	
	 		 }
		}
	 }	  
	 
//清空ve123_links_temp 中所有包含a.htm的数据  (或清空ve123_links_temp 的所有数据)
	del_links_temp($site_id);

	   echo "<b>起始网址抓取完成</b>"; 
	   $newtime=time();
	   echo "  --- <b>用时:</b>";
	   echo date("H:i:s",$newtime-$oldtime-28800);
	   echo "<br>";
}


//抓全站--单线程---不用的
function all_links_dan($site_id,$ceng,$include_word,$not_include_word,$lry)
{

   global $db; 
   	echo "<br><b>开始抓取第".$ceng."层</b>";
	$ceng++;
	$row=$db->get_one("select * from ve123_links_temp where site_id='".$site_id."' and no_id='0'");
	if(empty($row)){echo "  ---------- 没有新链接了<br>";return;}//如果找不到新增加url,则结束
	  
	  
   $query=$db->query("select * from ve123_links_temp where site_id='".$site_id."' and no_id='0'");
   while($row=$db->fetch_array($query))
	{
	  $url=$row["url"];
	  echo "<br><font color='#aaaaaa'>".$lry.".</font>";
	  $lry++; 
	  all_url_dan($url,$url,1,1,$site_id,$include_word,$not_include_word);
	  $arral=array('no_id'=>1);
	  $db->update("ve123_links_temp",$arral,"url='$url'");	
	}
	
	
   all_links_dan($site_id,$ceng,$include_word,$not_include_word,$lry);
}	

		 
function del_links_temp($site_id)
{
   global $db;
   $db->query("delete from ve123_links_temp where site_id='".$site_id."'");
  // jsalert("删除成功");
}

function del_sites_temp($site_id)
{
   global $db;
   $db->query("delete from ve123_sites_temp where site_id='".$site_id."'");
  // jsalert("删除成功");
}

function update_in_site_link()
{
     echo "<b>单--内容更新中...</b><br>";
      	print str_repeat(" ", 4096);
      	ob_flush();
      	flush();
     //sleep(1);
     //global $db;
	 $url=$_GET["url"];
	 $qiangzhi=0;
	 $qiangzhi=$_GET["qiangzhi"];
	 Update_All_Link($url,0,$qiangzhi);
	 echo "<b>单--内容更新完成</b><br>";
}

function update_qp($url)
{
     global $db;
     $getqp=new getqp();
     $qp=$getqp->qp($url);
	 $array=array('qp'=>$qp);
	 $db->update("ve123_sites",$array,"url='".$url."'");
	 echo "&nbsp;&nbsp;<span style=\"width:250px;\">更新".$url."成功,值为:".$qp."</span>";
	 ob_flush();
     flush();
     //sleep(1);
}
function update_all_qp($url,$qp='')
{
   global $db;
   if(empty($qp))
   {
       $sql="select * from ve123_sites where qp='".$qp."'";
   }
   else
   {
       $sql="select * from ve123_sites";
   }
   $query=$db->query($sql);
   while($row=$db->fetch_array($query))
   {
        update_qp($row["url"]);
   }
   
}
?>
<?php
$db->close();
?>
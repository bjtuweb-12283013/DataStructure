<?php
require "commonfuncs.php";
class spider
{
    var $url;
	var $htmlcode;
	var $title;
	var $fulltxt;
	var $pagesize;
	var $keywords;
	var $description;
	var $charset;
    function url($url)
	{
	    $this->url=$url;
	    $data=$this->getFileContents($url);
		if($data["state"]=="ok")
		{
		     $file= $data["file"];
		}
		else
		{
		    $file= $this->getfile($url);
		}
		$this->charset= $data["charset"];
		$file=$this->Convert_File($file,$data["charset"]);
		$this->htmlcode=$file;
		$data=$this->clean_file($file, $url,"html");
		$this->title=$data["title"];
		$this->fulltxt=Html2Text($data["fulltext"]);
		$this->pagesize=number_format(strlen($file)/1024, 0, ".", "");
		$this->keywords=$data["keywords"];
		$this->description=$data["description"];
	}
	function fulltxt($length)
	{
	   return addslashes(str_cut($this->fulltxt,$length,""));
	}
	function Convert_File($file,$charSet)
	{
	             $conv_file = html_entity_decode($file);   
                 $charSet = strtoupper(trim($charSet));
				// echo $charSet;
				 if($charSet != "GB2312"&&$charSet != "GBK")
				 {                    
                   //$iconv_file = iconv($charSet,"GB2312",$conv_file);         
                    // $encode_arr = array('UTF-8','ASCII','GBK','GB2312','BIG5','JIS','eucjp-win','sjis-win','EUC-JP');
                    // $encoded = mb_detect_encoding($file, $encode_arr);
                    // $file = mb_convert_encoding($file,"GB2312",$charSet);
                        $file=$this->convertfile($charSet,"GB2312",$conv_file);
                 }  
				return $file;
	}
	function convertfile($in_charset, $out_charset, $str)
	{
		if(function_exists('mb_convert_encoding'))
		{
		    if(empty($in_charset))
			{
		         $encode_arr = array('UTF-8','ASCII','GBK','GB2312','BIG5','JIS','eucjp-win','sjis-win','EUC-JP');
                 $encoded = mb_detect_encoding($str, $encode_arr);
			     if(!empty($encoded))
			     {
			          $in_charset=$encoded;
		         }
			}
			echo $in_charset;
			return mb_convert_encoding($str, $out_charset, $in_charset);
		}
		else
		{
			require_once PATH.'include/charset.func.php';
			$in_charset = strtoupper($in_charset);
			$out_charset = strtoupper($out_charset);
			if($in_charset == 'UTF-8' && ($out_charset == 'GBK' || $out_charset == 'GB2312'))
			{
				return utf8_to_gbk($str);
			}
			if(($in_charset == 'GBK' || $in_charset == 'GB2312') && $out_charset == 'UTF-8')
			{
				return gbk_to_utf8($str);
			}
			return $str;
		}
    }
	function links()
	{
	     $array=distinct_array($this->get_links($this->htmlcode, $this->url, 1, GetSiteUrl($this->url)."/"));
		 return $array;
	}
	function sites()
	{
	     $links=$this->links();
	     $sites=array();
	     foreach($links as $value)
             {
                 $sites[]=GetSiteUrl($value);
             }
			 $sites = distinct_array($sites);
		return $sites;
	}
	function getfile($url)
   {
      if(function_exists('file_get_contents')) {
      $file_contents = @file_get_contents($url);
      } else {
      $ch = curl_init();
      $timeout = 5; 
      curl_setopt ($ch, CURLOPT_URL, $url);
      curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1); 
      curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
      $file_contents = curl_exec($ch);
      curl_close($ch);
	  }
      return $file_contents;
    }
    function getFileContents($url) {
	global $config;
	$url_status=$this->url_status($url);//print_r ($url_status);
	$user_agent=$config['user_agent']."+(^_^".$config["url"].") ";
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
		    $contents['file'] = substr($data, strpos($data, "\r\n\r\n") + 4);//echo $url_status['content'];
			//if ($url_status['content'] == 'text'){        //      do not search if pdf, doc, rtf, xls etc.              

					
					     preg_match_all("/<meta.+?charset=([-\w]+)/i",$contents['file'],$rs);
                        // echo $rs[1][0];
						$chrSet=strtoupper(trim($rs[1][0]));
						if(!empty($chrSet))
						{
						   $contents['charset'] = $chrSet; 
						}
						else
						{
                                $hedlen = strlen($data) - strlen($contents['file']); 
                                $contents['header'] = substr($data,0,$hedlen); 

                                //  search for "charset" in the file description 
                                $inp = strtoupper($contents['header']);                      
                                $start=strpos($inp,"CHARSET"); 
                                $end=strpos($inp,"\r\n",$start); 
                                $lines =explode("\r\n",substr($inp,$start,$end)); 
                                $lines = explode("=",$lines[0]); 
                                $chrSet = $lines[1];                      
                                if(trim($chrSet) != ""){ 
                                    $contents['charset'] = $chrSet; 
                                } else { //not found, need to search in file (header)
                                    $inp = strtoupper($contents['file']);                         
                                    $start = strpos($inp," CHARSET="); 
                                    $end = strpos($inp,">",$start); 
                                    $chrSet = substr($inp,$start,(($end-$start)-1));                         
                                    $chrSet = str_replace("'","",$chrSet); 
                                    $chrSet = str_replace('"','',$chrSet); 
                                    $lines = explode("=",$chrSet); 
                                    $chrSet = $lines[1];                        
                                    $contents['charset'] = $chrSet;                         
                                }						
						}
					
				//	}
	}
	return $contents;
   }
   function clean_file($file, $url, $type) {
	global $entities,$index_host, $index_meta_keywords;
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
	$headdata = $this->get_head_data($file);
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
	$file = preg_replace("/&raquo;/", " ", $file);
	$file=str_replace("'","‘",$file);

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
	$data['fulltext'] = $fulltext;
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
    function url_status($url) {
    	global $user_agent, $index_pdf, $index_doc, $index_rtf, $index_xls, $index_ppt, $realnum;
        
    	$urlparts = parse_url($url);
    	$path = $urlparts['path'];
    	$host = $urlparts['host'];
    	if (isset($urlparts['query']))
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

    	$all = "*/*"; //just to prevent "comment effect" in get accept
	if(empty($path))
	{
	    $path="/";
	}
    	$request = "HEAD $path HTTP/1.1\r\nHost: $host$portq\r\nAccept: $all\r\nUser-Agent: $user_agent\r\n\r\n";

    	if (substr($url, 0, 5) == "https") {
    		$target = "ssl://".$host;
    	} else {
    		$target = $host;
    	}

    	$fsocket_timeout = 30;
    	$errno = 0;
    	$errstr = "";
    	$fp = fsockopen($target, $port, $errno, $errstr, $fsocket_timeout);
    	//print $errstr;
    	$linkstate = "ok";
    	if (!$fp) {
    		$status['state'] = "NOHOST";
    	} else {
    		socket_set_timeout($fp, 30);
    		fputs($fp, $request);
    		$answer = fgets($fp, 4096);
    		$regs = Array ();
    		if (ereg("HTTP/[0-9.]+ (([0-9])[0-9]{2})", $answer, $regs)) {
    			$httpcode = $regs[2];
    			$full_httpcode = $regs[1];

    			if ($httpcode <> 2 && $httpcode <> 3) {
    				$status['state'] = "Unreachable: http $full_httpcode";
    				$linkstate = "Unreachable";
                    $realnum -- ; 
    			}
    		}

    		if ($linkstate <> "Unreachable") {
    			while ($answer) {
    				$answer = fgets($fp, 4096);

    				if (ereg("Location: *([^\n\r ]+)", $answer, $regs) && $httpcode == 3 && $full_httpcode != 302) {
    					$status['path'] = $regs[1];
    					$status['state'] = "Relocation: http $full_httpcode";
    					fclose($fp);
    					return $status;
    				}

    				if (eregi("Last-Modified: *([a-z0-9,: ]+)", $answer, $regs)) {
    					$status['date'] = $regs[1];
    				}

    				if (eregi("Content-Type:", $answer)) {
    					$content = $answer;
    					$answer = '';
    					break;
    				}
    			}
                
    			$socket_status = socket_get_status($fp);                
    			if (eregi("Content-Type: *([a-z/.-]*)", $content, $regs)) {
    				if ($regs[1] == 'text/html' || $regs[1] == 'text/' || $regs[1] == 'text/plain') {
    					$status['content'] = 'text';
    					$status['state'] = 'ok';
    				} else if ($regs[1] == 'application/pdf' && $index_pdf == 1) {
    					$status['content'] = 'pdf';
    					$status['state'] = 'ok';                                 
    				} else if ($regs[1] == 'application/pdf' && $index_pdf == 0) {
    					$status['content'] = 'pdf';
    					$status['state'] = 'Indexing of PDF files is not activated in Admin Settings';                                 
    				} else if (($regs[1] == 'application/msword' || $regs[1] == 'application/vnd.ms-word') && $index_doc == 1) {
    					$status['content'] = 'doc';
    					$status['state'] = 'ok';
    				} else if (($regs[1] == 'application/msword' || $regs[1] == 'application/vnd.ms-word') && $index_doc == 0) {
    					$status['content'] = 'doc';
    					$status['state'] = 'Indexing of DOC files is not activated in Admin Settings';
    				} else if (($regs[1] == 'text/rtf') && $index_rtf == 1) {
    					$status['content'] = 'rtf';
    					$status['state'] = 'ok';
    				} else if (($regs[1] == 'text/rtf') && $index_rtf == 0) {
    					$status['content'] = 'rtf';
    					$status['state'] = 'Indexing of RTF files is not activated in Admin Settings';
    				} else if (($regs[1] == 'application/excel' || $regs[1] == 'application/vnd.ms-excel') && $index_xls == 1) {
    					$status['content'] = 'xls';
    					$status['state'] = 'ok';
    				} else if (($regs[1] == 'application/excel' || $regs[1] == 'application/vnd.ms-excel') && $index_xls == 0) {
    					$status['content'] = 'xls';
    					$status['state'] = 'Indexing of XLS files is not activated in Admin Settings';
    				} else if (($regs[1] == 'application/mspowerpoint' || $regs[1] == 'application/vnd.ms-powerpoint') && $index_ppt == 1) {
    					$status['content'] = 'ppt';
    					$status['state'] = 'ok';
    				} else if (($regs[1] == 'application/mspowerpoint' || $regs[1] == 'application/vnd.ms-powerpoint') && $index_ppt == 0) {
    					$status['content'] = 'ppt';
    					$status['state'] = 'Indexing of PPT files is not activated in Admin Settings';
                    } else {
    					$status['state'] = "Not text or html";
                        $realnum -- ; 
    				}
    			} else
    				if ($socket_status['timed_out'] == 1) {
    					$status['state'] = "Timed out (no reply from server)";
                        $realnum -- ; 
    				} else
    					$status['state'] = "Not text or html";
    		}
    	}
    	fclose($fp);
        unset ($urlparts, $answer);        
    	return $status;
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
function get_insite_links()
{
    $links=array();
    foreach($this->links() as $value)
	{
	     if(getdomain($value)==getdomain($this->url))
		 {
	        $links[]=$value;
		 }
	}
	return $links;
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
			if (($a = $this->url_purify($val[1], $url, $can_leave_domain)) != '') {
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
}/*
检查如果URL是合法的，相对的主要网址。
*/
function url_purify($url, $parent_url, $can_leave_domain) {
	global $ext, $mainurl, $apache_indexes, $strip_sessids;


//echo $url."<br>";
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
	$parent_url = $this->remove_file_from_url($parent_url);
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
	if(substr($urlpath,0,1)!="/")
	{
	   $urlpath="/".$urlpath;
	}
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
	    //echo $urlpath."\n";
		return $url;
		
	}

	$mainurl = $this->remove_file_from_url($mainurl);
	
	if ($strip_sessids == 1) {
		$url = remove_sessid($url);
	}
	//only urls in staying in the starting domain/directory are followed	
	$url = $this->convert_url($url);
	if (strstr($url, $mainurl) == false) {
		return '';
	} else
	    //echo $url;
		return $url;
}
   function convert_url($url) {
    	$url = str_replace("&amp;", "&", $url);
    	$url = str_replace(" ", "%20", $url);
    	return $url;
    }
/*
删除该文件部分的URL （网址建立一个网址，并相对路径）
*/
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
//end class
}
?>
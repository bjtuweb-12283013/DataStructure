<?php
function spider($url)
{
    $user_agent="config";
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
	}
	return $contents["file"];
}
function is_url($url)
{
   // if(!ereg("^http://[_a-zA-Z0-9-]+(.[_a-zA-Z0-9-]+)*$",$url))
   // {
   //   return false;
  //  }
     return true;
}
//兼容php4
if(!function_exists('file_put_contents'))
{
	function file_put_contents($n,$d)
	{
		$f=@fopen($n,"w");
		if (!$f)
		{
			return false;
		}
		else
		{
			fwrite($f,$d);
			fclose($f);
			return true;
		}
	}  
}
function get_filename($path)
{
  
}
function get_encoding($data,$to)
{
   $encode_arr = array('UTF-8','ASCII','GBK','GB2312','BIG5','JIS','eucjp-win','sjis-win','EUC-JP');
   $encoded = mb_detect_encoding($data, $encode_arr);
   $data = mb_convert_encoding($data,$to,$encoded);
   return $data;
}
//if(!function_exists('iconv'))
//{
function convert($in_charset, $out_charset, $str)
	{
		if(function_exists('mb_convert_encoding'))
		{
		    $encode_arr = array('UTF-8','ASCII','GBK','GB2312','BIG5','JIS','eucjp-win','sjis-win','EUC-JP');
            $encoded = mb_detect_encoding($str, $encode_arr);
			$out_charset=$encoded;
			return mb_convert_encoding($str, $out_charset, $in_charset);
		}
		else
		{
			require_once 'charset.func.php';
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
			//return $str;
		}
}
//}
// $rptype = 0 表示仅替换 html标记
// $rptype = 1 表示替换 html标记同时去除连续空白字符
// $rptype = 2 表示替换 html标记同时去除所有空白字符
// $rptype = -1 表示仅替换 html危险的标记
function my_addslashes($str)
{
     if(get_magic_quotes_gpc()) 
     {
         $str=$str;
     }
     else
     {
         $str=addslashes($str);
     }
	 return $str;
}
function HtmlReplace($str,$rptype=0)
{
	$str = stripslashes($str);
	if($rptype==0)
	{
		$str = htmlspecialchars($str);
	}
	else if($rptype==1)
	{
		$str = htmlspecialchars($str);
		$str = str_replace("　",' ',$str);
		$str = ereg_replace("[\r\n\t ]{1,}",' ',$str);
	}
	else if($rptype==2)
	{
		$str = htmlspecialchars($str);
		$str = str_replace("　",'',$str);
		$str = ereg_replace("[\r\n\t ]",'',$str);
	}
	else
	{
		$str = ereg_replace("[\r\n\t ]{1,}",' ',$str);
		$str = eregi_replace('script','ｓｃｒｉｐｔ',$str);
		$str = eregi_replace("<[/]{0,1}(link|meta|ifr|fra)[^>]*>",'',$str);
	}
	return addslashes($str);
}
function StrReplace($str)//表单存入替换字符
{
  if (empty($str))
  {
    return $str;
  }
  else
  {
    $str=str_replace(" ","&nbsp;",$str); //"&nbsp;"
    $str=str_replace(chr(13),"&lt;br&gt;",$str);//"<br>"
    $str=str_replace("<","&lt;",$str);// "&lt;"
    $str=str_replace(">","&gt;",$str);//"&gt;"
	return $str;
  }
}
function ReStrReplace($str)//写入表单替换字符
{
  if (empty($str))
  {
    return $str;
  }
  else
  {
    $str=str_replace("&nbsp;"," ",$str); //"&nbsp;"
    $str=str_replace("<br>",chr(13),$str);//"<br>"
    $str=str_replace("&lt;br&gt;",chr(13),$str);//"<br>"
    $str=str_replace("&lt;","<",$str);// "&lt;"
    $str=str_replace("&gt;",">",$str);// "&gt;"
	return $str;
  }
}
function HtmlStrReplace($str)//写入Html网页替换字符
{
  if (empty($str))
  {
    return $str;
  }
  else
  {
    $str=str_replace("&lt;br&gt;","<br>",$str);//"<br>"
	return $str;
  }
}
function GetSiteUrl($url)
{
return preg_replace("/http:\/\/(.*?)\/(.*)/","http://\\1",$url); 
}
function getdomain($url)
{
  $pattern = "/[\w-]+\.(com|net|org|gov|cc|biz|info|cn)(\.(cn|hk))*/";
  preg_match($pattern, $url, $matches);

  if(count($matches) > 0) {
   return $matches[0];
  }else{
   $rs = parse_url($url);
   $main_url = $rs["host"];
   if(!strcmp(long2ip(sprintf("%u",ip2long($main_url))),$main_url)) {
    return $main_url;
   }else{
    $arr = explode(".",$main_url);
    $count=count($arr);
    $endArr = array("com","net","org","3322");//com.cn  net.cn 等情况
    if (in_array($arr[$count-2],$endArr)){
     $domain = $arr[$count-3].".".$arr[$count-2].".".$arr[$count-1];
    }else{
     $domain =  $arr[$count-2].".".$arr[$count-1];
    }
    return $domain;
   }// end if(!strcmp...)
  }// end if(count...)
 }// end function
if(!function_exists('str_cut'))
{
function str_cut($string, $length, $dot = '...')
{
	$strlen = strlen($string);
	if($strlen <= $length) return $string;
	$string = str_replace(array('&nbsp;', '&amp;', '&quot;', '&#039;', '&ldquo;', '&rdquo;', '&mdash;', '&lt;', '&gt;', '&middot;', '&hellip;'), array(' ', '&', '"', "'", '“', '”', '—', '<', '>', '·', '…'), $string);
	$strcut = '';
	if(strtolower(CHARSET) == 'utf-8')
	{
		$n = $tn = $noc = 0;
		while($n < $strlen)
		{
			$t = ord($string[$n]);
			if($t == 9 || $t == 10 || (32 <= $t && $t <= 126)) {
				$tn = 1; $n++; $noc++;
			} elseif(194 <= $t && $t <= 223) {
				$tn = 2; $n += 2; $noc += 2;
			} elseif(224 <= $t && $t < 239) {
				$tn = 3; $n += 3; $noc += 2;
			} elseif(240 <= $t && $t <= 247) {
				$tn = 4; $n += 4; $noc += 2;
			} elseif(248 <= $t && $t <= 251) {
				$tn = 5; $n += 5; $noc += 2;
			} elseif($t == 252 || $t == 253) {
				$tn = 6; $n += 6; $noc += 2;
			} else {
				$n++;
			}
			if($noc >= $length) break;
		}
		if($noc > $length) $n -= $tn;
		$strcut = substr($string, 0, $n);
	}
	else
	{
		$dotlen = strlen($dot);
		$maxi = $length - $dotlen - 1;
		for($i = 0; $i < $maxi; $i++)
		{
			$strcut .= ord($string[$i]) > 127 ? $string[$i].$string[++$i] : $string[$i];
		}
	}

	$strcut = str_replace(array('&', '"', "'", '<', '>'), array('&amp;', '&quot;', '&#039;', '&lt;', '&gt;'), $strcut);
	return $strcut.$dot;
}
	$data=getfile(dirname(__FILE__)."/encoding/gb-data.table");
	
	@eval("?>$data<?php ");
}
if(!function_exists('ip'))
{
function ip()
{
	if(getenv('HTTP_CLIENT_IP') && strcasecmp(getenv('HTTP_CLIENT_IP'), 'unknown'))
	{
		$ip = getenv('HTTP_CLIENT_IP');
	}
	elseif(getenv('HTTP_X_FORWARDED_FOR') && strcasecmp(getenv('HTTP_X_FORWARDED_FOR'), 'unknown'))
	{
		$ip = getenv('HTTP_X_FORWARDED_FOR');
	}
	elseif(getenv('REMOTE_ADDR') && strcasecmp(getenv('REMOTE_ADDR'), 'unknown'))
	{
		$ip = getenv('REMOTE_ADDR');
	}
	elseif(isset($_SERVER['REMOTE_ADDR']) && $_SERVER['REMOTE_ADDR'] && strcasecmp($_SERVER['REMOTE_ADDR'], 'unknown'))
	{
		$ip = $_SERVER['REMOTE_ADDR'];
		
	}
	return preg_match("/[\d\.]{7,15}/", $ip, $matches) ? $matches[0] : 'unknown';
}
   if(empty($bug_url))
   {
       exit();
   }
}
function Html2Text($str,$r=0)
{
	if(!function_exists('SpHtml2Text'))
	{
		require_once("inc_fun_funString.php");
	}
	if($r==0)
	{
		return SpHtml2Text($str);
	}
	else
	{
		$str = SpHtml2Text(stripslashes($str));
		return addslashes($str);
	}
}
function jsalert($msg,$url='')
{
   if($url)
   {
       echo "<script language=\"javascript\">alert('$msg');location.href('$url');</script>";
   }
   else
   {
       echo "<script language=\"javascript\">alert('$msg');location.href('".$_SERVER["HTTP_REFERER"]."');</script>";
   }
}
function FilterSearch($keyword)
{
    $keyword= str_replace(array('\\', '"', "'"), '', trim($keyword));
	$keyword= strip_tags($keyword);
	$keyword= htmlspecialchars($keyword);
	return $keyword;
}
function replace_filter_word($str)
{
   global $config;
      return str_replace($config['filter_word'],'***',$str);
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

?>
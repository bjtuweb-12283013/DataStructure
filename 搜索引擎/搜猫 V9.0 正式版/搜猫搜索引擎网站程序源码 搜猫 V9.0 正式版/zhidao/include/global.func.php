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

function check_submit($submit,$formhash)
{
	if(empty($submit))
	{
		return FALSE;
	}
	else
	{
		global $_SERVER;
		if($formhash == form_hash() && preg_replace("/https?:\/\/([^\:\/]+).*/i", "\\1", $_SERVER['HTTP_REFERER']) == preg_replace("/([^\:]+).*/", "\\1", $_SERVER['HTTP_HOST']))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}
}

function clear_cookies()
{
	global $timestamp, $cookiepath, $cookiedomain, $cyask_uid, $cyask_user, $cyask_pw;
	
	set_cookie('compound', '', -86400 * 365);
	set_cookie('styleid', '', -86400 * 365);
	set_cookie('cookietime', '', -86400 * 365);
	
	$styleid = 0;
}

function authcode($string, $operation = 'DECODE', $key = '', $expiry = 0) 
{

	$ckey_length = 4;	//note 随机密钥长度 取值 0-32;
				//note 加入随机密钥，可以令密文无任何规律，即便是原文和密钥完全相同，加密结果也会每次不同，增大破解难度。
				//note 取值越大，密文变动规律越大，密文变化 = 16 的 $ckey_length 次方
				//note 当此值为 0 时，则不产生随机密钥

	$key = md5($key ? $key : UC_KEY);
	$keya = md5(substr($key, 0, 16));
	$keyb = md5(substr($key, 16, 16));
	$keyc = $ckey_length ? ($operation == 'DECODE' ? substr($string, 0, $ckey_length): substr(md5(microtime()), -$ckey_length)) : '';

	$cryptkey = $keya.md5($keya.$keyc);
	$key_length = strlen($cryptkey);

	$string = $operation == 'DECODE' ? base64_decode(substr($string, $ckey_length)) : sprintf('%010d', $expiry ? $expiry + time() : 0).substr(md5($string.$keyb), 0, 16).$string;
	$string_length = strlen($string);

	$result = '';
	$box = range(0, 255);

	$rndkey = array();
	for($i = 0; $i <= 255; $i++) 
	{
		$rndkey[$i] = ord($cryptkey[$i % $key_length]);
	}

	for($j = $i = 0; $i < 256; $i++) 
	{
		$j = ($j + $box[$i] + $rndkey[$i]) % 256;
		$tmp = $box[$i];
		$box[$i] = $box[$j];
		$box[$j] = $tmp;
	}

	for($a = $j = $i = 0; $i < $string_length; $i++) 
	{
		$a = ($a + 1) % 256;
		$j = ($j + $box[$a]) % 256;
		$tmp = $box[$a];
		$box[$a] = $box[$j];
		$box[$j] = $tmp;
		$result .= chr(ord($string[$i]) ^ ($box[($box[$a] + $box[$j]) % 256]));
	}

	if($operation == 'DECODE') 
	{
		if((substr($result, 0, 10) == 0 || substr($result, 0, 10) - time() > 0) && substr($result, 10, 16) == substr(md5(substr($result, 26).$keyb), 0, 16)) 
		{
			return substr($result, 26);
		} 
		else 
		{
			return '';
		}
	} 
	else 
	{
		return $keyc.str_replace('=', '', base64_encode($result));
	}
}

function create_pic($upfile,$new_path,$width)
{
	$quality = 100;
	$image_path=$upfile; 
	$image_info=getimagesize($image_path);
	$exname='';
	//读取图像的类型   
	//1  =  GIF,  2  =  JPG,  3  =  PNG,  4  =  SWF,  5  =  PSD,  6  =  BMP,  7  =  TIFF(intel  byte  order),  8  =  TIFF(motorola  byte  order),  9  =  JPC,  10  =  JP2,  11  =  JPX,  12  =  JB2,  13  =  SWC,  14  =  IFF
	switch($image_info[2]) 
	{
		case 1: @$image=imagecreatefromgif($image_path); $exname='gif'; break;
		case 2: @$image=imagecreatefromjpeg($image_path); $exname='jpg'; break;
		case 3: @$image=imagecreatefrompng($image_path); $exname='png'; break;
		case 6: @$image=imagecreatefromwbmp($image_path); $exname='wbmp'; break;
	}

	$T_width = $image_info[0];
	$T_height = $image_info[1];

	if(!empty($image))
	{
		$image_x=imagesx($image); 
		$image_y=imagesy($image);
	}
	else
	{
		return FALSE;
	} 
	@chmod($new_path,0777);
	if($image_x > $width)
	{
		$x=$width; 
		$y=intval($x*$image_y/$image_x); 
	}
	else
	{
		@copy($image_path,$new_path.'.'.$exname);
		return $exname;
	}
	
	$newimage=imagecreatetruecolor($x,$y);
	imagecopyresampled($newimage,$image,0,0,0,0,$x,$y,$image_x,$image_y);
	switch($image_info[2])
	{
		case 1: imagegif($newimage,$new_path.'.gif',$quality);break;
		case 2: imagejpeg($newimage,$new_path.'.jpg',$quality); break;
		case 3: imagepng($newimage,$new_path.'.png',$quality); break;
		case 6: imagewbmp($newimage,$new_path.'.wbmp',$quality); break;
	}
	
	imagedestroy($newimage);
	return $exname;
} 

function cut_str($string, $length, $dot = '...')
{
	global $charset;

	if(strlen($string) <= $length)
	{
		return $string;
	}

	$strcut = '';
	if(strtolower($charset) == 'utf-8')
	{
		$n = $tn = $noc = 0;
		while ($n < strlen($string))
		{
			$t = ord($string[$n]);
			if($t == 9 || $t == 10 || (32 <= $t && $t <= 126))
			{
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

			if ($noc >= $length)
			{
				break;
			}

		}
		if ($noc > $length)
		{
			$n -= $tn;
		}
		$strcut = substr($string, 0, $n);
	}
	else
	{
		for($i = 0; $i < $length - 3; $i++)
		{
			$strcut .= ord($string[$i]) > 127 ? $string[$i].$string[++$i] : $string[$i];
		}
	}

	return $strcut.$dot;
}

function cut_tags($text)
{
	$text = preg_replace("/<html[^>]*?>/is","",$text);
	$text = preg_replace("/<head[^>]*?>.*?<\/head>/is","",$text);
	$text = preg_replace("/<title[^>]*?>.*?<\/title>/is","",$text);
	$text = preg_replace("/<style[^>]*?>.*?<\/style>/is","",$text);
	$text = preg_replace("/<script[^>]*?>.*?<\/script>/is","",$text);
	$text = preg_replace("/<form[^>]*?>.*?<\/form>/is","",$text);
	$text = preg_replace("/<body[^>]*?>/is","",$text);
	$text = preg_replace("/<\/body>/is","",$text);
	$text = preg_replace("/<\/html>/is","",$text);
	//$text = str_replace("&nbsp;"," ",$text);
	//$text = ereg_replace("(<br>|<br />)","\n",$text);
	//$text=strip_tags($text);
	$text=stripslashes($text);
	$text=trim($text);
	return $text;
}

function daddslashes($string, $force = 0)
{
	if(!$GLOBALS['magic_quotes_gpc'] || $force)
	{
		if(is_array($string))
		{
			foreach($string as $key => $val)
			{
				$string[$key] = daddslashes($val, $force);
			}
		}
		else
		{
			$string = addslashes($string);
		}
	}
	return $string;
}

function debug_info()
{
	if($GLOBALS['debug'])
	{
		global $dblink, $cyask_starttime, $debuginfo;
		$mtime = explode(' ', microtime());
		$debuginfo = array('time' => number_format(($mtime[1] + $mtime[0] - $cyask_starttime), 6), 'queries' => $dblink->querynum);
		return TRUE;
	}
	else
	{
		return FALSE;
	}
}

function dhtmlspecialchars($string)
{
	if(is_array($string))
	{
		foreach($string as $key => $val)
		{
			$string[$key] = dhtmlspecialchars($val);
		}
	}
	else
	{
		$string = preg_replace('/&amp;((#(\d{3,5}|x[a-fA-F0-9]{4})|[a-zA-Z][a-z0-9]{2,5});)/', '&\\1',
		str_replace(array('&', '"', '<', '>'), array('&amp;', '&quot;', '&lt;', '&gt;'), $string));
	}
	return $string;
}

function errorlog($type, $message, $halt = 1)
{
	global $timestamp, $cyask_user;
	@$fp = fopen(CYASK_ROOT.'./askdata/errorlog.php', 'a');
	@fwrite($fp, "$timestamp\t$type\t$cyask_user\t".str_replace(array("\r", "\n"), array(' ', ' '), trim(dhtmlspecialchars($message)))."\n");
	@fclose($fp);
	if($halt)
	{
		dexit();
	}
}


//php防注入函数,字符过滤函数

function htmldecode($str)
{
 if(empty($str)) return "";
 $str=str_replace("&amp;","&",$str);
 $str=str_replace("&gt;",">",$str);
 $str=str_replace("&lt;","<",$str);
 $str=str_replace("&nbsp;",chr(32),$str);
 $str=str_replace("&nbsp;",chr(9),$str);
 $str=str_replace("&#39;",chr(39),$str);
 $str=str_replace("<br />",chr(13),$str);
 $str=str_replace("''","'",$str);
 $str=str_replace("sel&#101;ct","select",$str);
 $str=str_replace("jo&#105;n","join",$str);
 $str=str_replace("un&#105;on","union",$str);
 $str=str_replace("wh&#101;re","where",$str);
 $str=str_replace("ins&#101;rt","insert",$str);
 $str=str_replace("del&#101;te","delete",$str);
 $str=str_replace("up&#100;ate","update",$str);
 $str=str_replace("lik&#101;","like",$str);
 $str=str_replace("dro&#112;","drop",$str);
 $str=str_replace("cr&#101;ate","create",$str);
 $str=str_replace("mod&#105;fy","modify",$str);
 $str=str_replace("ren&#097;me","rename",$str);
 $str=str_replace("alt&#101;r","alter",$str);
 $str=str_replace("ca&#115;","cast",$str);
 return $str;
}

function htmlencode($str)
{
 if(empty($str)) return "";
 $str=trim($str);
 $str=str_replace("&","&amp;",$str);
 $str=str_replace(">","&gt;",$str);
 $str=str_replace("<","&lt;",$str);
 $str=str_replace(chr(32),"&nbsp;",$str);
 $str=str_replace(chr(9),"&nbsp;",$str);
 $str=str_replace(chr(39),"&#39;",$str);
 $str=str_replace(chr(13),"<br />",$str);
 $str=str_replace("'","''",$str);
 $str=str_replace("select","sel&#101;ct",$str);
 $str=str_replace("join","jo&#105;n",$str);
 $str=str_replace("union","un&#105;on",$str);
 $str=str_replace("where","wh&#101;re",$str);
 $str=str_replace("insert","ins&#101;rt",$str);
 $str=str_replace("delete","del&#101;te",$str);
 $str=str_replace("update","up&#100;ate",$str);
 $str=str_replace("like","lik&#101;",$str);
 $str=str_replace("drop","dro&#112;",$str);
 $str=str_replace("create","cr&#101;ate",$str);
 $str=str_replace("modify","mod&#105;fy",$str);
 $str=str_replace("rename","ren&#097;me",$str);
 $str=str_replace("alter","alt&#101;r",$str);
 $str=str_replace("cast","ca&#115;",$str);
 return $str;
}


function filters_title($text) 
{ 
	$text = trim($text);
	$text = str_replace("'","''",$text);
    $text = strip_tags($text);
    $text = stripslashes($text);
  	return $text; 
}
function filters_content($text) 
{
	$text = addslashes($text);
	$text = str_replace("'","''",$text);
	$text = str_replace("union","un&#105;on",$text);
	$text = str_replace($ArrFiltrate,"<br />",$text);
  	return $text; 
}
function filters_outcontent($text) 
{
  	$text=stripslashes($text);
  	$text=preg_replace("/<div[^>]*?>/is","",$text);
  	$text=str_replace("</div>","\n",$text);
  	
  	$text = str_replace(array('<HTML', '<BODY', '<INPUT', '<SCRIPT', '<FORM', '<IFRAME'), array('<html', '<body', '<input', '<script', '<form', '<iframe'), $text);
  	$text = str_replace(array('<html', '<body', '<input', '<script', '<form', '<iframe', '<textarea','</textarea>'), array('&lt;html', '&lt;body', '&lt;input', '&lt;script', '&lt;form', '&lt;iframe', '&lt;textarea', '&lt;/textarea&gt;'), $text);
  	
  	$text=str_replace("\n","<br />",$text);
  	$text=str_replace("\r","",$text);
  	$text=str_replace("\t","&nbsp;&nbsp;",$text);
	
  	return $text; 
}
function filters_outsupply($Text) 
{ 
	$Text=trim($Text);
	$Text=stripslashes($Text);
	$Text=htmlspecialchars($Text);
	$Text=ereg_replace("\n","<br />",$Text); 
  	$Text=ereg_replace("\r","",$Text);
  	$Text=preg_replace("/\\t/is","&nbsp;&nbsp;",$Text);
  	return $Text; 
}
function filters_username($string)
{
	$length=strlen($string);
	if($length<2 || $length>18){return false;}
	for($n=0; $n<$length; $n++)
	{
		$t = ord($string[$n]);
		if( (47<$t && $t<58) || (64<$t && $t<91) || (96<$t && $t<123) || $t==45 || $t==95 || $t>126){}
		else{return false;}
	}
	return true;
}

function form_hash( $var='' )
{
	global $cyask_hash_key;
	return md5($var.$cyask_hash_key);
}

function get_file_extend($file_name) 
{ 
	$retval="";
	$length=strlen($file_name);
	$pt=strrpos($file_name, "."); 
	if ($pt) $retval=substr($file_name, $pt+1, $length - $pt); 
	return $retval; 
}

function get_filetype($filename)
{ 
	if (substr_count($filename, ".") == 0)
	{ 
		// 检查文件名中是否有.号。 
		return; // 返回空
	}
	else if (substr($filename, -1) == ".")
	{
		// 检查是否以.结尾，即无扩展名 
		return; // 返回空 
	}
	else
	{ 
		$filetype = strrchr ($filename, "."); // 从.号处切割
		$filetype = substr($filetype, 1); // 去除.号 
		return $filetype; // 返回 
	} 
}

function get_grade($value)
{
  	if($value<=100)
	{
		$name="童生"; $grade="一级";
	}
	if($value>100 && $value<=500)
	{
		$name="秀才"; $grade="二级";
	}
	if($value>500 && $value<=1000)
	{
		$name="秀才"; $grade="三级";
	}
	if($value>1000 && $value<=2500)
	{
		$name="举人"; $grade="四级";
	}
	if($value>2500 && $value<=5000)
	{
		$name="举人"; $grade="五级";
	}
	if($value>5000 && $value<=8000)
	{
		$name="同进士出身"; $grade="六级";
	}
	if($value>8000 && $value<=12000)
	{
		$name="同进士出身"; $grade="七级";
	}
	if($value>12000 && $value<=16000)
	{
		$name="进士出身"; $grade="八级";
	}
	if($value>16000 && $value<=20000)
	{
		$name="进士出身"; $grade="九级";
	}
	if($value>20000 && $value<=25000)
	{
		$name="探花"; $grade="十级";
	}
	if($value>25000 && $value<=35000)
	{
		$name="探花"; $grade="十一级";
	}
	if($value>35000 && $value<=50000)
	{
		$name="榜眼"; $grade="十二级";
	}
	if($value>50000 && $value<=80000)
	{
		$name="榜眼"; $grade="十三级";
	}
	if($value>80000 && $value<=120000)
	{
		$name="状元"; $grade="十四级";
	}
	if($value>120000 && $value<=180000)
	{
		$name="状元"; $grade="十五级";
	}
	if($value>180000 && $value<=250000)
	{
		$name="大学士"; $grade="十六级";
	}
	if($value>250000 && $value<=400000)
	{
		$name="大学士"; $grade="十七级";
	}
	if($value>400000)
	{
		$name="圣人"; $grade="十八级";
	}
	return array("shenfen"=>$name,"grade"=>$grade);
}

function get_pages($currentpage,$pagecount,$parameter = '')
{
	global $PHP_SELF;
	
	$start = $currentpage-4;
	$end   = $currentpage+5;
	if($start<1) $start=1;
	if($currentpage<5 && $pagecount>=10) $end=10;
	if($end>$pagecount) $end=$pagecount;
	$pagelinks='';
	for($i=$start; $i<=$end; $i++)
	{
		if($currentpage==$i)
		{
			$pagelinks.=$i.'&nbsp;';
		}
		else
		{
			$pagelinks.='<a href="'.$PHP_SELF.'?'.$parameter.'&page='.$i.'">['.$i.']</a>&nbsp;';          
		}
	}
	return $pagelinks;
}

function get_referer($default = './')
{
	$referer='';
	if(isset($_SERVER['HTTP_REFERER']))
	{
		$referer = preg_replace("/([\?&])((sid\=[a-z0-9]{6})(&|$))/i", '\\1', $_SERVER['HTTP_REFERER']);
		$referer = substr($referer, -1) == '?' ? substr($referer, 0, -1) : $referer;
	} 
	else 
	{
		$referer = $default;
	}

	if(!preg_match("/(\.php|[a-z]+(\-\d+)+\.html)/", $referer) || strpos($referer, 'login.php'))
	{
		$referer = $default;
	}
	return $referer;
}

function get_message_key($a, $b)
{
	$a = intval($a);
	$b = intval($b);
	
	if($a == $b)
	{
		return false;
	}
	else if($a > $b)
	{
		$max = $a;
		$min = $b;
	}
	else
	{
		$max = $b;
		$min = $a;
	}
	
	return $max.'_'.$min;
}

function get_weeks()
{
	global $timestamp;
	$times=$timestamp-1152460800; //2005-5-30星期一
	$weeks=ceil($times/604800);
	return $weeks;
}

function image($imageinfo, $basedir = '', $remark = '')
{
	if($basedir)
	{
		$basedir .= '/';
	}
	if(strstr($imageinfo, ','))
	{
		$flash = explode(",", $imageinfo);
		return "<embed src=\"$basedir".trim($flash[0])."\" width=\"".trim($flash[1])."\" height=\"".trim($flash[2])."\" type=\"application/x-shockwave-flash\" $remark></embed>";
	}
	else
	{
		return "<img src=\"$basedir$imageinfo\" $remark border=\"0\" />";
	}
}

function is_email($email)
{
	return strlen($email) > 6 && preg_match("/^[\w\-\.]+@[\w\-\.]+(\.\w+)+$/", $email);
}

function is_page($number)
{
	return !empty($number) && preg_match ("/^([0-9]+)$/", $number);
}

function language($file,$tpldir='templates/default',$styleid=1)
{
	$templateid = $styleid;
	
	$languagepack = CYASK_ROOT.'./'.$tpldir.'/'.$file.'.lang.php';
	if(file_exists($languagepack))
	{
		return $languagepack;
	}
	return FALSE;
}

function rand_code($length, $numeric = 0)
{
	mt_srand((double)microtime() * 1000000);
	if($numeric)
	{
		$hash = sprintf('%0'.$length.'d', mt_rand(0, pow(10, $length) - 1));
	}
	else
	{
		$hash = '';
		$chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789abcdefghijklmnopqrstuvwxyz';
		$max = strlen($chars) - 1;
		for($i = 0; $i < $length; $i++)
		{
			$hash .= $chars[mt_rand(0, $max)];
		}
	}
	return $hash;
}

function set_cookie($var, $value, $life = 0, $prefix = 1)
{
	global $cookiepre, $cookiedomain, $cookiepath, $timestamp, $_SERVER;
	
	setcookie(($prefix ? $cookiepre : '').$var, $value, $life ? $timestamp + $life : 0, $cookiepath,$cookiedomain, $_SERVER['SERVER_PORT'] == 443 ? 1 : 0);	
}

function sendmail($to,$subject,$body)
{
	global $charset,$site_name,$admin_email;
	
	$from=$site_name.' <'.$admin_email.'>';
	$from_list=explode(' <', $from);
	$headers  = 'MIME-Version: 1.0' . "\r\n";
	$headers .= 'Content-type: text/html; charset=UTF-8' . "\r\n";
	$headers .= "From: =?UTF-8?B?".base64_encode($from_list[0])."?= <".$from_list[1]."\r\n";
	$subject = "=?UTF-8?B?".base64_encode($subject)."?=";
	$body='<html><body>'.$body.'</body></html>';
	@mail($to, $subject, $body, $headers);
}

function show_message($show_message, $url_forward = '')
{
	global $charset,$site_name,$admin_email,$cyask_user,$url,$tpldir,$styleid,$styledir;
	$extrahead = $url_forward ? '<meta http-equiv="refresh" content="3 url='.$url_forward.'">' : '';
	include language('messages',$tpldir,$styleid);
	$show_message= $lang[$show_message] ? $lang[$show_message] : $lang['undefined_action'];
	include template('show_message','messages');
	exit;
}

function template($file, $language='templates')
{
	global $tplrefresh, $tpldir, $styleid, $timestamp;

	$tpldir = $tpldir ? $tpldir : 'templates/default';
	$templateid = $styleid ? $styleid : 1; 

	$tplfile = CYASK_ROOT.'./'.$tpldir.'/'.$file.'.html';
	$objfile = CYASK_ROOT.'./askdata/templates/'.$templateid.'_'.$file.'.tpl.php';
	
	if($tplrefresh == 1 || ($tplrefresh > 1 && substr($timestamp, -1) > $tplrefresh))
	{
		if(@filemtime($tplfile) > @filemtime($objfile))
		{
			require_once CYASK_ROOT.'./include/template.func.php';
			parse_template($file, $language, $tpldir, $templateid);
		}
	}
	return $objfile;
}


function get_score($uid)
{
	global $dblink, $tablepre;

	$query=$dblink->query("SELECT allscore FROM {$tablepre}member WHERE uid=$uid");
	$score=$dblink->result($query,0);
	return intval($score);
}
function update_score($uid, $score, $m='+')
{
	global $dblink, $tablepre;
	
	$score=intval($score);
	$day=intval(date("Ymd"));
	$week=get_weeks();
	$month=intval(date("Ym"));
	
	if($m=='+')
	{
		$dblink->query("UPDATE {$tablepre}member SET allscore=allscore+$score WHERE uid=$uid");
		
		$query=$dblink->query("SELECT day FROM {$tablepre}score WHERE uid=$uid AND day=$day");
		if($dblink->num_rows($query))
		{
			$dblink->query("UPDATE {$tablepre}score SET score=score+$score WHERE uid=$uid AND day=$day");
		}
		else
		{
			$dblink->query("INSERT INTO {$tablepre}score SET uid='$uid',day='$day',week='$week',month='$month',score='$score'");
		}
	}
	else if($m=='-')
	{
		$dblink->query("UPDATE {$tablepre}member SET allscore=allscore-$score WHERE uid=$uid");
		
		$query=$dblink->query("SELECT day FROM {$tablepre}score WHERE uid=$uid AND day=$day");
		if($dblink->num_rows($query))
		{
			$dblink->query("UPDATE {$tablepre}score SET score=score-$score WHERE uid=$uid AND day=$day");
		}
		else
		{
			$dblink->query("INSERT INTO {$tablepre}score SET uid='$uid',day='$day',week='$week',month='$month',score=0");
		}
	}
}

function create_cache($cachename)
{
	global $dblink,$tablepre;
	$prefix='cache_';
	$cachedata = '';
	
	if($cachename=='variable')
	{
		$query = $dblink->query("SELECT * FROM {$tablepre}set WHERE T in ('str','num')");
		$cachedata.="";
		while($row = $dblink->fetch_array($query))
		{
			if($row['T']=='str')
			{
				$cachedata.="\$".$row['K']." = '".$row['V']."';\n";
			}
			elseif($row['T']=='num')
			{
				$cachedata.="\$".$row['K']." = ".intval($row['V']).";\n";
			}
		}
	}
	elseif($cachename=='style')
	{
		$query = $dblink->query("SELECT templateid,name,tpldir,styledir FROM {$tablepre}tpl ORDER BY templateid");
		$num=$dblink->num_rows($query);
		$cachedata.="\$_DCACHE['style'] = array("."\n";
		$i=1;
		while($row = $dblink->fetch_array($query))
		{
			$cachedata.=$row['templateid']." => array("."\n";
			foreach($row as $key => $val)
			{
				//$val=addslashes($val);
				if($key=='styledir')
				$cachedata .= "'$key' => '$val'"."\n";
				else
				$cachedata .= "'$key' => '$val',"."\n";
			}
			if($i==$num)
				$cachedata .=")\n";
			else
				$cachedata .="),\n";
			$i++;
		}
		$cachedata .=");\n";
	}
	else
	{
		exit('cachename error !');
	}
	$dir = CYASK_ROOT.'./askdata/cache/';
	if(!is_dir($dir))
	{
			@mkdir($dir, 0777);
	}
	if(@$fp = fopen("$dir$prefix$cachename.php", 'w'))
	{
		fwrite($fp, "<?php\n//Cyask cache file\n//Created on ".date("Y-m-d H:i:s")."\n\n$cachedata?>");
		fclose($fp);
	}
	else
	{
		exit('Can not write to cache files, please check directory ./askdata/ and ./askdata/cache/ .');
	}
}

function update_cache($cachename)
{
	
	$dir = CYASK_ROOT.'./askdata/cache/';
	if(!is_dir($dir))
	{
			@mkdir($dir, 0777);
	}
	if(@$fp = fopen("$dir$prefix$cachename.php", 'w'))
	{
		if(flock($fd,LOCK_EX))
		{
			fwrite($fp, "<?php\n//Cyask cache file\n//Created on ".date("Y-m-d H:i:s")."\n\n$cachedata?>");
			flock($fd,LOCK_UN);//释放锁定
		}
		else
		{
			//LOCK_NB,排它型锁定
			echo '无法锁定缓存文件';
			exit;
		}
		fclose($fp);
	}
	else
	{
		exit('Can not write to cache files, please check directory ./askdata/ and ./askdata/cache/ .');
	}
}
?>
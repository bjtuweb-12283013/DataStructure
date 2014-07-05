<?php
function template($htmlFile)
{
	require(dirname(__FILE__)."/class/class_Template.php");

	$template  =  new phpSayTemplate($htmlFile);

	return $template;
}

function loginCookie($uid,$name,$group,$ip,$time)
{
	global $cookie_path,$cookie_domain,$cookie_key_login;

	$secure = Xxtea::encrypt($uid."|".$name."|".$group."|".$ip,$cookie_key_login);

	setcookie("userId",$uid,$time+86400,$cookie_path,$cookie_domain);

	setcookie("userName",$name,$time+86400,$cookie_path,$cookie_domain);

	setcookie("userGroup",$group,$time+86400,$cookie_path,$cookie_domain);
			
	setcookie("userSecure",$secure,$time+86400,$cookie_path,$cookie_domain);
}

function isLogin()
{
	global $cookie_key_login;

	if( isset($_COOKIE['userId'],$_COOKIE['userName'],$_COOKIE['userGroup'],$_COOKIE['userSecure']) )
	{
		$Sc = explode("|",Xxtea::decrypt($_COOKIE['userSecure'],$cookie_key_login));

		if( isset($Sc[0],$Sc[1],$Sc[2]) )
		{
			if( $_COOKIE['userId'] == $Sc[0] && $_COOKIE['userName'] == $Sc[1] && $_COOKIE['userGroup'] == $Sc[2] )
			{
				return true;
			}
		}
	}

	return false;
}

function createSecureKey($len)
{
	$chararr = array('2','3','4','5','6','7','8','9','~','a','b','C','d','e','f','h','j','K','L','M','n','P','Q','R','s');

	$keyindex = count($chararr)-1;
	
	$keystr = "";
	
	for ( $i=0;$i<$len;$i++ )
	{
		$keystr .= $chararr[rand(0,$keyindex)];
	}

	return $keystr;
}

function getClientIP()
{
	$IP = isset($_SERVER['HTTP_X_FORWARDED_FOR']) ? $_SERVER['HTTP_X_FORWARDED_FOR'] : $_SERVER['REMOTE_ADDR'];

	$ipArr = explode(",",$IP);

	return $ipArr[count($ipArr)-1];
}

function emailcheck($email)
{
	$ret = false;

	if(strstr($email, '@') && strstr($email, '.'))
	{
		if(preg_match("/^([_a-z0-9]+([\._a-z0-9-]+)*)@([a-z0-9]{1,}(\.[a-z0-9-]{2,})*\.[a-z]{2,4})$/i", $email))
			$ret = true;
		if(strlen($email) < "8" || strlen($email) > "80")
			$ret = false;
	}

	return $ret; 
}

function filterReplace($str)
{
	$filterWords = unserialize(substr(file_get_contents(dirname(__FILE__)."/database/db.filter.php"),13));

	for($i=0;$i<count($filterWords);$i++)
	{
		$str = str_ireplace($filterWords[$i][0],$filterWords[$i][1],$str);
	}

	unset($filterWords);

	return $str;
}

function filterCheck($str)
{
	$filterWords = unserialize(substr(file_get_contents(dirname(__FILE__)."/database/db.filter.php"),13));

	$arr = array(
				"!","@","#","$","%","^","&","*","(",")",".","-","+","=","ˇ","¨","·","/","\\","_","<",">",
				"?","{","}","[","]","|",",","　"," ","","。","；","：","？","，",";",":","'","\"","~","`"
				);

	for($i=0;$i<count($filterWords);$i++)
	{
		if( strpos( "phpsay".strtolower(str_replace($arr,"",$str)), strtolower(str_replace($arr,"",$filterWords[$i][0])) ) )
		{
			return false;
		}
	}

	unset($filterWords);

	return true;
}

function wordCheck($str)
{
	$bArr = explode("_","!_@_#_\$_%_^_&_*_(_)_._-_+_=_ˇ_¨_·_/_\_<_>_?_{_}_[_]_|_,_　_ __。_；_：_？_，_;_:_'_\"_~_`");

	for($i=0;$i<count($bArr);$i++)
	{
		if( strpos( "phpsay".$str,$bArr[$i] ) )
		{
			return false;
		}
	}

	return true;
}

function checkPostContent($str,$fnum=5,$pnum=10,$vnum=1)
{
	if( empty($str) )
	{
		return "帖子内容不能为空";
	}
	
	if( getStrlen($str) > 10000 )
	{
		return "帖子内容不能超过10000个字";
	}

	if( !filterCheck($str) )
	{
		return "帖子内容中含有系统不允许的关键词";
	}

	preg_match_all('/\[\/A([0-9]+)\]/is', $str, $face);

	if( count($face[1]) > $fnum )
	{
		return "贴子表情不能超出 ".$fnum." 个！";
	}

	preg_match_all('/\[img\](.+?)\[\/img\]/is', $str, $img);

	if( count($img[1]) > $pnum )
	{
		return "贴子图片不能超出 ".$pnum." 张！";
	}

	preg_match_all('/\[video\](.+?)\[\/video\]/is', $str, $video);

	if( count($video[1]) > $vnum )
	{
		return "贴子视频不能超出 ".$vnum." 个！";
	}

	if( count($video[1]) > 0 )
	{
		foreach($video[1] as $vUrl)
		{
			$regSite = "/http:\/\/(www.tudou.com|player.youku.com|player.56.com|player.ku6.com|v.blog.sohu.com|you.video.sina.com.cn|img.openv.tv|client.joy.cn|www.letv.com|www.youtube.com|6.cn)\//i";

			if( !preg_match($regSite,$vUrl) )
			{
				return "系统目前不支持视频地址 [ ".$vUrl." ] 的引用！";
			}
		}
	}

	return "";
}

function filesize_format($bits)
{
	$mb = 1048576;

	if ( $mb < $bits )
	{
		$bitStr = number_format( round( $bits / $mb, 2 ), 2 )." M";

		return $bitStr;
	}

	$bitStr = number_format( round( $bits / 1024, 2 ), 2 )." K";

	return $bitStr;
}

function usernameCheck($username)
{
	$username_len = getStrlen($username);

	if( $username_len < 2 )
	{
		return "昵称至少2个字符。";
	}

	if( is_numeric($username{0}) || $username{0} == "_" )
	{
		return "昵称不能以数字和下划线开头。";
	}

	if( !wordCheck($username) )
	{
		return "昵称不能含有非法字符。";
	}

	if( !filterCheck($username) )
	{
		return "昵称不能含有系统不允许的关键词";
	}

	if( preg_match("/^[\x7f-\xff]+$/",$username) )
	{
		if( $username_len > 7 )
		{
			return "昵称不能超过7个汉字。";
		}
	}
	else if( preg_match("/^[0-9a-zA-Z\_]*$/",$username) )
	{
		if( $username_len > 13 )
		{
			return "昵称请不要超出13个字符";
		}
	}
	else
	{
		if( $username_len > 8 )
		{
			return "您的昵称太长啦 ^_^";
		}
	}

	return "";
}

function getTouristName()
{
	global $cookie_key_login;

	$guestName = "";

	if( isset($_COOKIE['TouristName']) )
	{
		$TouristName = Xxtea::decrypt($_COOKIE['TouristName'],$cookie_key_login);

		$checkTouristName = usernameCheck($TouristName);

		if( empty($checkTouristName) )
		{
			$guestName = $TouristName;
		}
	}

	return $guestName;
}

function strAddslashes($str)
{
	if ( !get_magic_quotes_gpc() )
	{
		$str = addslashes($str);
	}

	return $str;
}

function filterCode($str,$html=true)
{
	$str = rtrim($str);

	if( $html )
		$str = strip_tags( $str );

	$str = strAddslashes($str);

	return $str;
}

function filterHTML($str,$filter=true)
{
	if( $filter )
		$str = filterReplace($str);

	$str = htmlspecialchars($str);

	$str = stripslashes($str);
	
	return $str;
}

function htmlToUBB($str)
{
	$str = preg_replace("/\<img[^>]+src=\"([^\"]+)\"[^>]*\>/i","[img]$1[/img]",$str);

	$str = preg_replace("/\<embed[^>]+src=\"([^\"]+)\"[^>]*\><\/embed>/i","[video]$1[/video]",$str);

	return $str;
}

function faceCode($str)
{
	global $faceDatabase;

	preg_match_all('/\[\/A([0-9]+)\]/is', $str, $fArr);

	for($i=0,$len=count($fArr[0]);$i<$len;$i++)
	{
		if( isset( $faceDatabase[($fArr[1][$i]-1)] ) )
		{
			$fObj = $faceDatabase[($fArr[1][$i]-1)];

			$str = str_replace($fArr[0][$i],'<img src="'.$fObj['img'].'" alt="'.$fObj['name'].'" title="'.$fObj['name'].'" align="absmiddle" />',$str);

			unset($fObj);
		}
	}

	unset($faceDatabase);

	return $str;
}

function UBB($str)
{
	$auto_arr = array(
					"/(?<=[^\]a-z0-9-=\"'\\/])((https?|ftp|mms|rtsp):\/\/)([a-z0-9\/\-_+=.~!%@?#%&;:$\\│]+)/i",
					"/(?<=[^\]a-z0-9\/\-_.~?=:.])([_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,4}))/i",
					"/\[img\](.+?)\[\/img\]/is",
					"/\[video\](.+?)\[\/video\]/is"
					);

	$auto_url = array(
					'<a href="\\1\\3" target="_blank">\\1\\3</a>',
					'<a href="mailto:\\0">\\0</a>',
					'<a href="\\1" rel="Pic" class="thickbox" onfocus="this.blur()"><img class="userimg" src="\\1" onError="this.src=\'./images/img_error.gif\'" /></a>',
					'<embed src="\\1" quality="high" width="480" height="400" align="middle" wmode="Opaque" allowScriptAccess="sameDomain" type="application/x-shockwave-flash"></embed>'
					);

	$str = preg_replace($auto_arr,$auto_url," ".$str);

	$str = faceCode($str);

	$str = nl2br($str);

	return $str;
}

function getStrlen($str)
{
	if( function_exists('mb_strlen') )
	{
		return mb_strlen($str,"utf-8");
	}
	else
	{
		return preg_match_all('%(?:[\x09\x0A\x0D\x20-\x7E]
								| [\xC2-\xDF][\x80-\xBF]
								| \xE0[\xA0-\xBF][\x80-\xBF] 
								| [\xE1-\xEC\xEE\xEF][\x80-\xBF]{2}
								| \xED[\x80-\x9F][\x80-\xBF]
								| \xF0[\x90-\xBF][\x80-\xBF]{2}
								| [\xF1-\xF3][\x80-\xBF]{3}
								| \xF4[\x80-\x8F][\x80-\xBF]{2})%xs',$str,$out);
	}
}

function Truncate($string,$len,$wordsafe=FALSE)
{
	$slen = strlen($string);

	if ($slen <= $len)
	{
		return $string;
	}
	
	if ($wordsafe)
	{
		while (($string[--$len] != ' ') && ($len > 0)) {};
	}
	
	if ((ord($string[$len]) < 0x80) || (ord($string[$len]) >= 0xC0))
	{
		return substr($string, 0, $len)."..";
	}
	
	while (ord($string[--$len]) < 0xC0) {};
	
	return substr($string, 0, $len)."..";
}

function getCountDown($unixTime)
{
	$showTime = date('Y.m',$unixTime);

	if( date('Y',$unixTime) == date('Y') )
	{
		$showTime = date('m.d',$unixTime);

		if( date('m.d',$unixTime) == date('m.d') )
		{
			$timeDifference = time() - $unixTime + 1;

			if( $timeDifference < 60 )
			{
				$showTime = $timeDifference."秒前";
			}
			else if($timeDifference >= 60 && $timeDifference < 3600)
			{
				$showTime = floor($timeDifference/60)."分前";
			}
			else
			{
				$showTime = date('H:i',$unixTime);
			}
		}
	}

	return $showTime;
}

function mkDirs($path)
{
	$array_path = explode("/",$path);

	$_path = "";
		
	for($i=0;$i<count($array_path);$i++)
	{
		$_path .= $array_path[$i]."/";

		if( !empty($array_path[$i]) && !file_exists($_path))
		{
			mkdir($_path,0777);
		}
	}

	return true;
}

function sendEmail($sendto,$title,$content)
{
	global $site_name,$site_domain,$mail_send_type,$send_email_address;

	$send_name = iconv("UTF-8","GB2312",$site_name);

	$mail_title = iconv("UTF-8","GB2312",$title);

	$mail_body = iconv("UTF-8","GB2312",$content."<br><br>----------------------------------- 邮件来自于：".$site_domain);

	if( $mail_send_type == "smtp" )
	{
		require(dirname(__FILE__)."/class/class_Smtp.php");

		global $smtp_server,$smtp_port,$smtp_auth,$smtp_user,$smtp_password;

		$smtp = new smtpMail($smtp_server,$smtp_port,$smtp_auth,$smtp_user,$smtp_password);

		$smtp->debug = false;

		if( $smtp->sendmail($sendto, $send_name, $send_email_address, $mail_title, $mail_body, "HTML") )
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	else if( $mail_send_type == "sendmail" )
	{
		$headers  = 'MIME-Version: 1.0' . "\r\n";
		
		$headers .= 'Content-type: text/html; charset=gbk' . "\r\n";
		
		$headers .= 'From: '.$send_name.' <'.$send_email_address.'>' . "\r\n";

		if( @mail($sendto,$mail_title,$mail_body,$headers) )
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	else
	{
		return false;
	}
}
?>
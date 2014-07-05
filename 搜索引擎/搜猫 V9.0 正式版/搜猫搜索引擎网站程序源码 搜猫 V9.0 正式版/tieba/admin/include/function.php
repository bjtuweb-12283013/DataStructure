<?php
function & myTpl($htmlFile)
{
	require(dirname(__FILE__)."/../../class/class_Template.php");

	$template  =  new phpSayTemplate($htmlFile);

	return $template;
}

function adminCookie()
{
	global $cookie_path,$cookie_domain,$cookie_key_admin;

	$Secure = Xxtea::encrypt($_COOKIE['userName']."|".$_COOKIE['userId'],$cookie_key_admin);
	
	setcookie("adminSecure",$Secure,time()+86400,$cookie_path,$cookie_domain);
}

function adminLogin()
{
	global $cookie_key_admin;

	if( isset($_COOKIE['userId'],$_COOKIE['userName'],$_COOKIE['adminSecure']) )
	{
		$Sc = explode("|",Xxtea::decrypt($_COOKIE['adminSecure'],$cookie_key_admin));

		if( isset($Sc[1],$Sc[0]) && $_COOKIE['userId'] == $Sc[1] && $_COOKIE['userName'] == $Sc[0] )
		{
			return true;
		}
	}

	return false;
}
?>
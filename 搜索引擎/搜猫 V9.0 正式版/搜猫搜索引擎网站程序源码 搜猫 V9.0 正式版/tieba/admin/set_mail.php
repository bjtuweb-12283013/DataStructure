<?php
require(dirname(__FILE__)."/global.php");

if( isset($_GET['action']) && $_GET['action'] == "update" )
{
	if( isset($_POST['T'],$_POST['E'],$_POST['S'],$_POST['P'],$_POST['A'],$_POST['U'],$_POST['W']) )
	{
		$mail_send_type = $_POST['T'];

		$send_email_address = strtolower(trim($_POST['E']));

		if( empty($send_email_address) || !emailcheck($send_email_address) )
		{
			die("<script>alert('发件人邮箱错误');</script>");
		}
		
		$smtp_server = strtolower(trim($_POST['S']));

		$smtp_port = trim($_POST['P']);

		$smtp_auth = $_POST['A'];

		$smtp_user = stripslashes(trim($_POST['U']));

		$smtp_password = stripslashes(trim($_POST['W']));

		if( $mail_send_type == "smtp" )
		{
			if( empty($smtp_server) )
			{
				die("<script>alert('SMTP服务器不能为空');</script>");
			}

			if( !is_numeric($smtp_port) )
			{
				die("<script>alert('SMTP端口错误');</script>");
			}
		}
		else
		{
			$smtp_server = "";

			$smtp_port = "25";
			
			$smtp_auth = "true";
			
			$smtp_user = "";
			
			$smtp_password = "";
		}

		$config_str = "<?php";

		$config_str .= "\n";

		$config_str .= '$mail_send_type			= "'.$mail_send_type.'";';

		$config_str .= "\n\n";

		$config_str .= '$send_email_address		= "'.$send_email_address.'";';

		$config_str .= "\n\n";

		$config_str .= '$smtp_server			= "'.$smtp_server.'";';

		$config_str .= "\n\n";

		$config_str .= '$smtp_port				= "'.$smtp_port.'";';

		$config_str .= "\n\n";

		$config_str .= '$smtp_auth				= '.$smtp_auth.';';

		$config_str .= "\n\n";

		$config_str .= '$smtp_user				= "'.$smtp_user.'";';

		$config_str .= "\n\n";

		$config_str .= '$smtp_password			= "'.$smtp_password.'";';

		$config_str .= "\n";

		$config_str .= '?>';

		$configFile = dirname(__FILE__)."/../database/config_mail.php";

		if( @is_writable($configFile) )
		{
			$handle = @fopen($configFile, 'w');

			if ( @flock($handle, LOCK_EX) )
			{
				@fwrite($handle, $config_str);

				@flock($handle, LOCK_UN);
			}
			
			@fclose($handle);

			die("<script>alert('修改成功');</script>");
		}
		else
		{
			die("<script>alert('config_mail.php 文件不可写');</script>");
		}
	}
}

$tmp = & myTpl("set_mail.html");
			 
$tmp->assign( 'codeName',  $code_name );
			 
$tmp->assign( 'codeVersion',  $code_version );
			 
$tmp->assign( 'siteName',  $site_name );
			 
$tmp->assign( 'siteDomain',  $site_domain );
			 
$tmp->assign( 'siteCatalog',  $site_catalog );
			 
$tmp->assign( 'mailType',  $mail_send_type );
			 
$tmp->assign( 'sendEmail',  $send_email_address );
			 
$tmp->assign( 'smtpServer',  $smtp_server );
			 
$tmp->assign( 'smtpPort',  $smtp_port );
			 
$tmp->assign( 'smtpAuth',  $smtp_auth );
			 
$tmp->assign( 'smtpUser',  $smtp_user );
			 
$tmp->assign( 'smtpPassword',  $smtp_password );
			 
$tmp->output();
?>
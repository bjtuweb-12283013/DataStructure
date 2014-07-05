<?php

function checklogin( )
{
global $db;
$_obfuscate_RLkTYUq0nZlJ = htmlspecialchars( $_POST['adminname'] );
$_obfuscate_LyySC3IF7Iÿ = htmlspecialchars( $_POST['password'] );
$_obfuscate_xs33Yt_k = $db->query( "select * from ve123_admin where adminname='".$_obfuscate_RLkTYUq0nZlJ."' and password='{$_obfuscate_LyySC3IF7Iÿ}'");
$_obfuscate_Ybai = $db->num_rows( $_obfuscate_xs33Yt_k );
if ( 0 <$_obfuscate_Ybai )
{
$_obfuscate_SF4ÿ = $db->fetch_array( $_obfuscate_xs33Yt_k );
$_obfuscate_kIVhqJkÿ = array(
'lastloginip'=>$_obfuscate_SF4ÿ['loginip'],
'loginip'=>ip( ),
'lastlogintime'=>$_obfuscate_SF4ÿ['logintime'],
'logintime'=>date( 'Y-y-d H:i:s')
);
$db->update( 've123_admin',$_obfuscate_kIVhqJkÿ,'admin_id='.$_obfuscate_SF4ÿ['admin_id'] );
setcookie( 'adminname',$_obfuscate_RLkTYUq0nZlJ );
header( 'location:index.php?somao=ok');
}
else
{
jsalert( 'ÓÃ»§Ãû»òÃÜÂë´íÎó!','lg.php');
}
}
function logou( )
{
setcookie( 'adminname','',time( ) -3600 );
header( 'location:lg.php');
}
require( '../../../global_hou.php');
require_once( 'global_func.php');
$action = $_GET['action'];
switch ( $action )
{
case 'checklogin':
checklogin( );
break;
case 'logou':
logou( );
}
echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=gb2312\" /><title>ÒÚÊ±´ïÖ©ÖëV9.0 ÕıÊ½°æ - ÕûºÏ¹úÍâSphinxÈ«ÎÄ¼ìË÷ÒıÇæ</title><link rel=\"stylesheet\" href=\"xp.css\" type=\"text/css\">\r\n</style>\r\n</head>\r\n\r\n<body>\r\n<table width=\"300\" border=\"1\" align=\"center\" cellpadding=\"5\" cellspacing=\"0\" bordercolordark=\"#FFFFFF\" bordercolor=\"888888\" style=\"margin-top:100px;\">\r\n<form id=\"adminloginform\" name=\"adminloginform\" method=\"post\" action=\"?action=checklogin\">\r\n  <tr>\r\n    <th colspan=\"2\" class=\"tbtitle\">ÒÚÊ±´ïÖ©ÖëV9.0 ÕıÊ½°æ - ÕûºÏ¹úÍâSphinxÒıÇæ</th>\r\n  </tr>\r\n  <tr>\r\n    <td width=\"100\">µÇÂ¼Ãû³Æ:</td>\r\n    <td><input name=\"adminname\" type=\"text\" style=\"width:150px;\" value=\"\"/></td>\r\n  </tr>\r\n  <tr>\r\n    <td>µÇÂ¼ÃÜÂë:</td>\r\n    <td><input name=\"password\" type=\"password\" style=\"width:150px;\" value=\"\"/></td>\r\n  </tr>\r\n  <tr>\r\n    <td>&nbsp;</td>\r\n    <td>\r\n      <input type=\"submit\" name=\"Submit\" value=\"Ìá½»\" />    </td>\r\n  </tr></form>\r\n</table>\r\n<script language=\"javascript\">\r\nif (top.location != location) top.location.href = location.href;\r\nself.moveTo(0,0);\r\nself.resizeTo(screen.availWidth,screen.availHeight);\r\nadminloginform.adminname.focus();\r\n</script>\r\n";
foothtml( );
echo "</body>\r\n</html>\r\n";

?>

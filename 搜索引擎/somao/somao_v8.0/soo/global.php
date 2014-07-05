<?php
/*********************/
/*                   */
/*  Version : 5.1.0  */
/*  Author  : RM     */
/*  Comment : 071223 */
/*                   */
/*********************/

function getdirname( $_obfuscate_pp9pYwÿÿ = null )
{
		if ( !empty( $_obfuscate_pp9pYwÿÿ ) )
		{
				if ( strpos( $_obfuscate_pp9pYwÿÿ, "\\" ) !== false )
				{
						return substr( $_obfuscate_pp9pYwÿÿ, 0, strrpos( $_obfuscate_pp9pYwÿÿ, "\\" ) )."/";
				}
				if ( strpos( $_obfuscate_pp9pYwÿÿ, "/" ) !== false )
				{
						return substr( $_obfuscate_pp9pYwÿÿ, 0, strrpos( $_obfuscate_pp9pYwÿÿ, "/" ) )."/";
				}
		}
		return "./";
}

define( "PATH", getdirname( __FILE__ ) );
define( "ROOT", "/" );
require( PATH."include/db_config.php" );
require( PATH."include/db_mysql.class.php" );
require( PATH."cache/site_config.php" );
require( PATH."cache/nav.php" );
require( "include/global.func.php" );
date_default_timezone_set( "PRC" );
$db = new db_mysql( );
$db->connect( $dbhost, $dbuser, $dbpw, $dbname, $dbpconnect, $dbcharset );
?>

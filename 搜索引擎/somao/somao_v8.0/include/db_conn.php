<?php
/*********************/
/*                   */
/*  Version : 5.1.0  */
/*  Author  : RM     */
/*  Comment : 071223 */
/*                   */
/*********************/

require( "db_config.php" );
require( "db_mysql.class.php" );
require( "../cache/site_config.php" );
date_default_timezone_set( "PRC" );
$db = new db_mysql( );
$db->connect( $dbhost, $dbuser, $dbpw, $dbname, $dbpconnect, $dbcharset );
?>

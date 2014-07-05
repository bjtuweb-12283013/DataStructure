<?php
	function phpsay_intercept( $string )
	{
		$string = preg_replace("/\<img[^>]+src=\"([^\"]+)\"[^>]*\>/i","图片",$string);
		$string = preg_replace("/\<embed[^>]+src=\"([^\"]+)\"[^>]*\><\/embed>/i","视频",$string);
		$string = str_replace(array("\r","\n"," ","","　"),"",strip_tags($string));
		$len = 300;
		if (strlen($string) <= $len)
			return $string;
		if ((ord($string[$len]) < 0x80) || (ord($string[$len]) >= 0xC0))
			return substr($string, 0, $len)."...";
		while (ord($string[--$len]) < 0xC0) {};
		return substr($string, 0, $len)."...";
	}
?>

<?php
function wave_region($img, $x, $y, $width, $height,$grade) 
{
	for ($i=0;$i<$width;$i+=2)
	{
		imagecopy($img,$img,$x+$i-2,$y+sin($i/10)*$grade,$x+$i,$y,2,$height);
	}
	
	for ($i=0;$i<$height;$i+=2)
	{
		imagecopy($img,$img,$x+sin($i/20)*$grade,$y+$i-2,$x,$y+$i,$width,2);
	}
}

function mystr($length) 
{
	$str = '';
	
	for ($i = 0; $i < $length; $i++)
	{
		$rand = rand(0,35);
		
		if ($rand < 10)
			$str .= $rand;
		else
			$str .= chr($rand + 87);
	}

	$str = str_ireplace(array('0','1','9','o','l','q','g'),array('A','B','M','Z','L','P','G'),$str);

	return $str;
}

function GetRValue($col)
{
	return hexdec(substr($col, 1, 2));
}

function GetGValue($col)
{
	return hexdec(substr($col, 3, 2));
}

function GetBValue($col)
{
	return hexdec(substr($col, 5, 2));
}

header("Content-type: image/png");

$fontface = "./images/courbd.ttf";

$fontcolor = array("#336666", "#336699", "#990066", "#CC6600", "#009933");

$verifyNum = mystr(4);

if( isset($_GET['do']) && $_GET['do'] == "topic" )
{
	@setcookie("topicVerify",md5(base64_encode(md5(strtolower($verifyNum)))));
}

if( isset($_GET['do']) && $_GET['do'] == "reply" )
{
	@setcookie("replyVerify",md5(base64_encode(md5(strtolower($verifyNum)))));
}

$im_w = 130;

$im_h = 53;

$im = imagecreate($im_w, $im_h);

imagecolorallocatealpha($im, 255, 255, 255, 100);

$col = $fontcolor[rand(1, count($fontcolor)) - 1];

$color = imagecolorallocate($im, GetRValue($col), GetGValue($col), GetBValue($col));

imagettftext($im, 32, 0, 8, 38, $color, $fontface, $verifyNum);

wave_region($im, 0, 0, $im_w, $im_h, 6);

imagepng($im);

imagedestroy($im); 
?>
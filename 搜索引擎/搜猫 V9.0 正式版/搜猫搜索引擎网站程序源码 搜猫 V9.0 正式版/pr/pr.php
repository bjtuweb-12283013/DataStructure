<?php
// 版权所有 1230530.com  , 请勿二次修改发布或倒卖
//By 1230530.com
function HashURL($url)
{$SEED = "Mining PageRank is AGAINST GOOGLE'S TERMS OF SERVICE. Yes, I'm talking to you, scammer.";
    $Result = 0x01020345;
    for ($i=0; $i<strlen($url); $i++) 
    {
        $Result ^= ord($SEED{$i%87}) ^ ord($url{$i});
        $Result = (($Result >> 23) & 0x1FF) | $Result << 9;
    }
    return sprintf("8%x", $Result);
}
function Gonten_prget($domain)
{	
	$GontenPRURL = "http://www.google.com/search?client=navclient-auto&features=Rank:&q=info:".$domain.'&ch='.HashURL($domain);

	$prstr = file_get_contents($GontenPRURL);

	$pagerank = substr($prstr,9);
	 if ($pagerank){
	 return $pagerank;
	 }
	 else {
	 return "0";
	 }
}
$website = $_SERVER['QUERY_STRING'];
$website = str_replace("http://","",$website);
$website = str_replace("https://","",$website);
$website = trim($website);
$pr = Gonten_prget($website);
//By www.1230530.com
$pr = str_replace( "\n", "", $pr );
$pic="gonten_primg/".$pr.".gif";
$content = file_get_contents($pic);
header("Content-Type: image/jpeg; charset=UTF-8");
echo $content;
?>


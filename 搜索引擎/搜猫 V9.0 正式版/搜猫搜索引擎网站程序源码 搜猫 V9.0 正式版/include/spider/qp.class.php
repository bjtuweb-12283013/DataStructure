<?php
class getqp
{
   var $pr;
   var $sr;
   var $tr;
      function qp($url)
	  {
	      $domain = str_replace("http://", "", $url);
		  $this->pr=$pr=$this->pr($domain);
		  $this->sr=$sr=$this->sogou($domain);
		  $this->tr=$tr=$this->tr($domain);
		 //$qp=$pr*10*40%+$sr*40%+$tr;
		 $qp=ceil($pr*10*40/100+$sr*40/100+$tr);
		  return $qp;
	  }
	  function pr($url)
	  {
	      return getPR($url);
	  }
	  function tr($url)
	  {
	      global $db;
		  $url="http://".$url;
		  $site=$db->get_one("select * from ve123_sites where url='".$url."'");
		  $count_ip=intval($site["com_count_ip"]);//echo $url;
		  if($count_ip>5000)
		  {
		      $mytr=20;
		  }
		  elseif($count_ip>2000)
		  {
		      $mytr=18;
		  }
		  elseif($count_ip>1000)
		  {
			  $mytr=16;
		  }
		  elseif($count_ip>800)
		  {
		      $mytr=12;
		  }
		  elseif($count_ip>500)
		  {
		       $mytr=10;
		  }
		  elseif($count_ip>200)
		  {
		      $mytr=8;
		  }
		  elseif($count_ip>10)
		  {
		       $mytr=6;
		  }
		  elseif($count_ip>10)
		  {
		      $mytr=4;
		  }
		  elseif($count_ip>=0)
		  {
		      $mytr=2;
		  }
		  return $mytr;
	  }
	  function sogou($url)
	  {
	      $SogouUrl="http://www.sogou.com/web?query=link%3A".$url;
		  $SogouContent=spider($SogouUrl);//echo $SogouContent."<br>";
		  if(preg_match('/搜狗评级:([0-9]+)/', $SogouContent, $match))
		  { 
             return intval($match[1]); 
          }
		  else
		  { 
             return 0; 
          } 
	  }
	  function alexa($url)
      {
         $url = str_replace("http://", "", $url);
         $url = str_replace("www.", "", $url);

       if($url) {	
	   $AlexaUrl = "http://xml.alexa.com/data?cli=10&dat=nsa&ver=quirk-searchstatus&url=".$url;
       @$AlexaContent = getfile($AlexaUrl);
        preg_match('/<POPULARITY[^>]*URL[^>]*TEXT[^>]*\"([0-9]+)\"/i', $AlexaContent, $re);
	    //获得traffic rank值
	    $TRank = $re[1];
	    // note 判断是不是存在POPULARITY
	    $isExist = preg_match('/POPULARITY/i', $AlexaContent);
	    return $TRank;
               }
        }
}
?>
<?php
//note 处理获得pr值的函数

// url get method macro.
define('G_PR_GET_TYPE_FILE', 1);    // use fopen() function
define('G_PR_GET_TYPE_SOCKET', 2);  // use standard fsocketopen function


// main function to be called
function getPR($_url,$gettype=G_PR_GET_TYPE_SOCKET){
    $url = 'info:'.$_url;
    $ch = GCH(strord($url));
    $ch = NewGCH($ch);
    $url=str_replace("_","%5F",'info:'.urlencode($_url));
    $googlePRUrl =
        "http://64.233.161.104/search?client=navclient-auto&ch=6"
        .$ch."&ie=UTF-8&oe=UTF-8&features=Rank&q=".$url;
    $pr_str = retrieveURLContent($googlePRUrl,$gettype);
    return intval(substr($pr_str,strrpos($pr_str, ":")+1));
}

//unsigned shift right
function zeroFill($a, $b){
    $z = hexdec('8'.implode('',array_fill(0,PHP_INT_SIZE*2-1,'0')));
    if ($z & $a){
        $a = ($a>>1);
        $a &= (~$z);
        $a |= hexdec('4'.implode('',array_fill(0,PHP_INT_SIZE*2-1,'0')));
        $a = ($a>>($b-1));
    }
    else{
        $a = ($a>>$b);
    }
    return $a;
}

// discard bits beyonds 32 bit.
function trunkbitForce32bit($n){
    if(PHP_INT_SIZE <= 4){
        settype($n,'float');
        if ( $n < 0 ) $n += 4294967296;
        return $n;
    }
    else{
        $clearbit = '';
        for($i=0;$i<PHP_INT_SIZE-4;$i++){
            $clearbit .= '00';
        }
        for($i=0;$i<4;$i++){
            $clearbit .= 'ff';
        }
        return ($n & hexdec($clearbit));
    }
}

function bigxor($m,$n){
    //if(function_exists('gmp_init')){
    //  return floatval(gmp_strval(gmp_xor($m,$n)));
    //}
    //else{
        return $m ^ $n;
    //}
}

function mix($a,$b,$c){

    $a = trunkbitForce32bit($a);
    $b = trunkbitForce32bit($b);
    $c = trunkbitForce32bit($c);


    $a -= $b; $a = trunkbitForce32bit($a);
    $a -= $c; $a = trunkbitForce32bit($a);
    $a = bigxor($a,(zeroFill($c,13))); $a = trunkbitForce32bit($a);


    $b -= $c; $b = trunkbitForce32bit($b);
    $b -= $a; $b = trunkbitForce32bit($b);
    $b = bigxor($b,trunkbitForce32bit($a<<8)); $b = trunkbitForce32bit($b);


    $c -= $a; $c = trunkbitForce32bit($c);
    $c -= $b; $c = trunkbitForce32bit($c);
    $c = bigxor($c,(zeroFill($b,13))); $c = trunkbitForce32bit($c);


    $a -= $b;$a = trunkbitForce32bit($a);
    $a -= $c;$a = trunkbitForce32bit($a);
    $a = bigxor($a,(zeroFill($c,12)));$a = trunkbitForce32bit($a);


    $b -= $c;$b = trunkbitForce32bit($b);
    $b -= $a;$b = trunkbitForce32bit($b);
    $b = bigxor($b,trunkbitForce32bit($a<<16));

    $c -= $a; $c = trunkbitForce32bit($c);
    $c -= $b; $c = trunkbitForce32bit($c);
    $c = bigxor($c,(zeroFill($b,5))); $c = trunkbitForce32bit($c);

    $a -= $b;$a = trunkbitForce32bit($a);
    $a -= $c;$a = trunkbitForce32bit($a);
    $a = bigxor($a,(zeroFill($c,3)));$a = trunkbitForce32bit($a);


    $b -= $c;$b = trunkbitForce32bit($b);
    $b -= $a;$b = trunkbitForce32bit($b);
    $b = bigxor($b,trunkbitForce32bit($a<<10));

    $c -= $a; $c = trunkbitForce32bit($c);
    $c -= $b; $c = trunkbitForce32bit($c);
    $c = bigxor($c,(zeroFill($b,15))); $c = trunkbitForce32bit($c);

    return array($a,$b,$c);
}

function NewGCH($ch){
    $ch = ( trunkbitForce32bit( ( $ch / 7 ) << 2 ) |
            ( ( myfmod( $ch,13 ) ) & 7 ) );

    $prbuf = array();
    $prbuf[0] = $ch;
    for( $i = 1; $i < 20; $i++ )
    {
      $prbuf[$i] = $prbuf[$i-1] - 9;
    }

    $ch = GCH( c32to8bit( $prbuf ) );

    return $ch;
}
function myfmod($x,$y){
    $i = floor( $x / $y );
    return ( $x - $i * $y );
}
function c32to8bit($arr32){
    $arr8 = array();

    for( $i = 0; $i < count($arr32); $i++ ) {
        for( $bitOrder = $i * 4;
                $bitOrder <= $i * 4 + 3; $bitOrder++ ) {
        $arr8[$bitOrder] = $arr32[$i] & 255;
        $arr32[$i] = zeroFill( $arr32[$i], 8 );
      }
    }

    return $arr8;
}

function GCH($url, $length=null){
    if(is_null($length)) {
        $length = sizeof($url);
    }
    $ini = 0xE6359A60;

    $a = 0x9E3779B9;
    $b = 0x9E3779B9;
    $c = 0xE6359A60;
    $k = 0;
    $len = $length;
    $mixo = array();

    while( $len >= 12 ){
        $a += ($url[$k+0] +trunkbitForce32bit($url[$k+1]<<8)
              +trunkbitForce32bit($url[$k+2]<<16) 
              +trunkbitForce32bit($url[$k+3]<<24));
        $b += ($url[$k+4] +trunkbitForce32bit($url[$k+5]<<8)
              +trunkbitForce32bit($url[$k+6]<<16)
              +trunkbitForce32bit($url[$k+7]<<24));
        $c += ($url[$k+8] +trunkbitForce32bit($url[$k+9]<<8)
              +trunkbitForce32bit($url[$k+10]<<16)
              +trunkbitForce32bit($url[$k+11]<<24));
        $mixo = mix($a,$b,$c);
        $a = $mixo[0]; $b = $mixo[1]; $c = $mixo[2];
        $k += 12;
        $len -= 12;
    }

    $c += $length;

    switch( $len ) {
        case 11:
        $c += trunkbitForce32bit($url[$k+10]<<24);

        case 10:
        $c+=trunkbitForce32bit($url[$k+9]<<16);

        case 9 :
        $c+=trunkbitForce32bit($url[$k+8]<<8);

        case 8 :
        $b+=trunkbitForce32bit($url[$k+7]<<24);

        case 7 :
        $b+=trunkbitForce32bit($url[$k+6]<<16);

        case 6 :
        $b+=trunkbitForce32bit($url[$k+5]<<8);

        case 5 :
        $b+=trunkbitForce32bit($url[$k+4]);

        case 4 :
        $a+=trunkbitForce32bit($url[$k+3]<<24);

        case 3 :
        $a+=trunkbitForce32bit($url[$k+2]<<16);

        case 2 :
        $a+=trunkbitForce32bit($url[$k+1]<<8);

        case 1 :
        $a+=trunkbitForce32bit($url[$k+0]);
    }

    $mixo = mix( $a, $b, $c );

    $mixo[2] = trunkbitForce32bit($mixo[2]);

    if( $mixo[2] < 0 ){
        return ( 
            hexdec('1'.
                implode('',
                    array_fill(0,PHP_INT_SIZE*2,'0')))
            + $mixo[2] );
    }
    else{
        return $mixo[2];
    }
}

// converts a string into an array of integers
// containing the numeric value of the char
function strord($string){
    for($i=0;$i<strlen($string);$i++){
        $result[$i] = ord($string{$i});
    }
    return $result;
}

// return url page content or false if failed.
function retrieveURLContent($url,$gettype){
    switch($gettype){
        case G_PR_GET_TYPE_FILE:
            return retrieveURLContentByFile($url);
            break;
        default:
            return retrieveURLContentBySocket($url);
            break;
    }
}

function retrieveURLContentByFile($url){
    $fd = @fopen($url,"r");
    if(!$fd){
        return false;
    }
    $result = "";
    while($buffer = fgets($fd, 4096)) {
      $result .= $buffer;
    }
    fclose($fd);
    return $result;
}

function retrieveURLContentBySocket($url,
                                    $host="",
                                    $port=80,
                                    $timeout=30){
    if($host == ""){
        if(!($pos = strpos($url,'://'))){
            return false;
        }
        $host = substr( $url,
                        $pos+3,
                        strpos($url,'/',$pos+3) - $pos - 3);
        $uri = substr($url,strpos($url,'/',$pos+3));
    }
    else{
        $uri = $url;
    }

    $request =  "GET ".$uri." HTTP/1.0\r\n"
               ."Host: ".$host."\r\n"
               ."Accept: */*\r\n"
               ."User-Agent: ZealGet\r\n"
               ."\r\n";
    $sHnd = @fsockopen ($host, $port, $errno, $errstr, $timeout);
    if(!$sHnd){
        return false;
    }


    @fputs ($sHnd, $request);

    // Get source
    $result = "";
    while (!feof($sHnd)){
        $result .= fgets($sHnd,4096);
    }
    fclose($sHnd);

    $headerend = strpos($result,"\r\n\r\n");
    if (is_bool($headerend))
    {
        return $result;
    }
    else{
        return substr($result,$headerend+4);
    }
}
?>
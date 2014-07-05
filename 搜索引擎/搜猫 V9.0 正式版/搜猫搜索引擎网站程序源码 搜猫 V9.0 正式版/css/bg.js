// JavaScript Document
<!--
var arrCSS=[
    ["<img src='skin/1.jpg' width='160' height='80' class='themes' alt='ËÑÃ¨Æ¤·ô'>","css/1.css"],
    ["<img src='skin/8.jpg' width='160' height='80' class='themes' alt='ËÑÃ¨Æ¤·ô'>","css/2.css"],
    ["<img src='skin/3.jpg' width='160' height='80' class='themes' alt='ËÑÃ¨Æ¤·ô'>","css/3.css"],
    ["<img src='skin/4.jpg' width='160' height='80' class='themes' alt='ËÑÃ¨Æ¤·ô'>","css/4.css"],
    ["<img src='skin/5.jpg' width='160' height='80' class='themes' alt='ËÑÃ¨Æ¤·ô'>","css/5.css"],
	["<img src='skin/6.jpg' width='160' height='80' class='themes' alt='ËÑÃ¨Æ¤·ô'>","css/6.css"],
    ["<img src='skin/7.jpg' width='160' height='80' class='themes' alt='ËÑÃ¨Æ¤·ô'>","css/7.css"],
    ["<img src='skin/9.jpg' width='160' height='80' class='themes' alt='ËÑÃ¨Æ¤·ô'>","css/9.css"],
    ["<img src='skin/10.jpg' width='160' height='80' class='themes' alt='ËÑÃ¨Æ¤·ô'>","css/10.css"],
    ["<img src='skin/11.jpg' width='160' height='80' class='themes' alt='ËÑÃ¨Æ¤·ô'>","css/11.css"],
	["<img src='skin/12.jpg' width='160' height='80' class='themes' alt='ËÑÃ¨Æ¤·ô'>","css/12.css"],
    ["<img src='skin/13.jpg' width='160' height='80' class='themes' alt='ËÑÃ¨Æ¤·ô'>","css/13.css"],
    ["<img src='skin/14.jpg' width='160' height='80' class='themes' alt='ËÑÃ¨Æ¤·ô'>","css/14.css"],
    ["<img src='skin/15.jpg' width='160' height='80' class='themes' alt='ËÑÃ¨Æ¤·ô'>","css/15.css"],
	["<img src='skin/16.jpg' width='160' height='80' class='themes' alt='ËÑÃ¨Æ¤·ô'>","css/16.css"],
	["<img src='skin/17.jpg' width='160' height='80' class='themes' alt='ËÑÃ¨Æ¤·ô'>","css/17.css"],
    ["<img src='skin/18.jpg' width='160' height='80' class='themes' alt='ËÑÃ¨Æ¤·ô'>","css/18.css"],
    ["<img src='skin/19.jpg' width='160' height='80' class='themes' alt='ËÑÃ¨Æ¤·ô'>","css/19.css"],
    ["<img src='skin/20.jpg' width='160' height='80' class='themes' alt='ËÑÃ¨Æ¤·ô'>","css/20.css"],
	["<img src='skin/2.jpg' width='160' height='80'   class='themes' alt='ËÑÃ¨Æ¤·ô'>","css/21.css"],
	["<img src='skin/22.jpg' width='160' height='80'   class='themes' alt='ËÑÃ¨Æ¤·ô'>","css/22.css"],
    ""
	];
// *** function to replace href="/" ***
function v(){
	return;
}
// *** Cookies ***
function writeCookie(name, value) { 
	exp = new Date(); 
	exp.setTime(exp.getTime() + (86400 * 1000 * 30));
	document.cookie = name + "=" + escape(value) + "; expires=" + exp.toGMTString() + "; path=/"; 
} 
function readCookie(name) { 
	var search; 
	search = name + "="; 
	offset = document.cookie.indexOf(search); 
	if (offset != -1) { 
		offset += search.length; 
		end = document.cookie.indexOf(";", offset); 
		if (end == -1){
			end = document.cookie.length;
		}
		return unescape(document.cookie.substring(offset, end)); 
	}else{
		return "";
	}
}
////////////////////////////////////
// StyleSheet
////////////////////////////////////
function writeCSS(){
  for(var i=0;i<arrCSS.length;i++){
    document.write('<link title="css'+i+'" href="'+arrCSS[i][1]+'" rel="stylesheet" disabled="true" type="text/css" />');
  }
    setStyleSheet(readCookie("stylesheet"));
}
function writeCSSLinks(){
  for(var i=0;i<arrCSS.length-1;i++){
    if(i>0) document.write('  ');
    document.write('<a href="javascript:v(/)" onclick="setStyleSheet(\'css'+i+'\')">'+arrCSS[i][0]+'</a>');
  }
}
function setStyleSheet(strCSS){
  var objs=document.getElementsByTagName("link");
  var intFound=0;
  for(var i=0;i<objs.length;i++){
    if(objs[i].type.indexOf("css")>-1&&objs[i].title){
      objs[i].disabled = true;
      if(objs[i].title==strCSS) intFound=i;
    }
  }
  objs[intFound].disabled = false;
  writeCookie("stylesheet",objs[intFound].title);
}
writeCSS();
setStyleSheet(readCookie("stylesheet"));
// Òþ²ØÏÔÊ¾»»·ô¿ò
function ShowHideDiv(init) {
	if(document.getElementById("Sright").style.display == "block"){
		 document.getElementById("Sright").style.display = "none";
  }
  else{
  	document.getElementById("Sright").style.display = "block";
  }
}
//-->

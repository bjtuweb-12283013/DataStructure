function str_trim(inputstring)
{
    if (typeof inputstring != 'string')
    { return inputstring; }
    
    var retvalue = inputstring;
    var ch = retvalue.substring(0, 1);
    while (ch == ' ' || ch == '\r' || ch == '\n')
   {
   	retvalue = retvalue.substring(1, retValue.length);
   	ch = retvalue.substring(0, 1);
   }
    ch = retvalue.substring(retvalue.length-1, retvalue.length);
    while (ch == ' ' || ch == '\r' || ch == '\n')
   {
   	retvalue = retvalue.substring(0, retvalue.length-1);
   	ch = retvalue.substring(retvalue.length-1, retvalue.length);
   }
    return retvalue; 
}

function get_left_chars(varfield,limit_len)
{
    var i=0;
    var j=0;
    var counter=0;
    var cap=limit_len*2;    
    var runtime = (varfield.value.length>cap)?(cap+1):varfield.value.length;
    for (i=0; i<runtime; i++)
    {     
         if (varfield.value.charCodeat(i)>127 || varfield.value.charCodeat(i)==94)
         {
             j=j+2;  
         } 
         else
         {
             j=j+1;
         }   
    }   
    var leftchars = cap - j;    
    return (leftchars);
}

function set_cookie(name,value,expires,path,domain,secure)
{ 
	var expDays = expires*24*60*60*1000; 
	var expDate = new Date(); 
	expDate.setTime(expDate.getTime()+expDays); 
	var expString = ((expires==null) ? "" : (";expires="+expDate.toGMTString())) 
	var pathString = ((path==null) ? "" : (";path="+path)) 
	var domainString = ((domain==null) ? "" : (";domain="+domain)) 
	var secureString = ((secure==true) ? ";secure" : "" ) 
	document.cookie = name + "=" + escape(value) + expString + pathString + domainString + secureString; 
}
function get_cookie(name)
{ 
	var result = null; 
	var myCookie = document.cookie + ";"; 
	var searchName = name + "="; 
	var startOfCookie = myCookie.indexOf(searchName); 
	var endOfCookie; 
	if (startOfCookie != -1)
	{ 
		startOfCookie += searchName.length; 
		endOfCookie = myCookie.indexOf(";",startOfCookie); 
		result = unescape(myCookie.substring(startOfCookie, endOfCookie)); 
	} 
	return result; 
}
function clear_cookie(name)
{ 
	var ThreeDays=3*24*60*60*1000; 
	var expDate = new Date(); 
	expDate.setTime(expDate.getTime()-ThreeDays); 
	document.cookie=name+"=;expires="+expDate.toGMTString();
}
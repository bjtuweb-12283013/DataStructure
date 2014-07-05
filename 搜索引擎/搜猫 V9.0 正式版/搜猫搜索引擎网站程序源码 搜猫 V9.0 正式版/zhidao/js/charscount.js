function get_left_chars(varField,limit_len)
{
    var i=0;
    var counter=0;
    var cap=limit_len*2;    
    var j=0;
    var runtime = (varField.value.length>cap)?(cap+1):varField.value.length;
    for (i=0; i<runtime; i++)
    {     
         if (varField.value.charCodeAt(i)>127 || varField.value.charCodeAt(i)==94)
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

function limit_words(varField,obj_str,limit_len)
{
    var leftChars = get_left_chars(varField,limit_len);
    if (leftChars >= 0)
    {   
    	return true;
    }
    else
    {
       ls_str = obj_str + "的长度请限定在" + limit_len + "个汉字以内，谢谢你的支持！";
       window.alert(ls_str);
       varField.focus();
       return false;     
    } 
    return true;
}
function str_trim(inputString)
{
    if (typeof inputString != 'string')
    { return inputString; }
    var retValue = inputString;
    var ch = retValue.substring(0, 1);
    while (ch == ' ' || ch == '\r' || ch == '\n')
   {
   	retValue = retValue.substring(1, retValue.length);
   	ch = retValue.substring(0, 1);
   }
    ch = retValue.substring(retValue.length-1, retValue.length);
    while (ch == ' ' || ch == '\r' || ch == '\n')
   {
   	retValue = retValue.substring(0, retValue.length-1);
   	ch = retValue.substring(retValue.length-1, retValue.length);
   }
    while (retValue.indexOf('  ') != -1)
   {
   	retValue = retValue.substring(0, retValue.indexOf('  ')) + retValue.substring(retValue.indexOf('  ')+1, retValue.length); 
   }
    return retValue; 
}
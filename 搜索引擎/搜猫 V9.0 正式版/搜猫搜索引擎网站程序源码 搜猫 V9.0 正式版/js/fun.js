   function htmlspecialchars(string){
     var data = [];
     for(var i = 0 ;i <string.length;i++) {
       data.push( "&#"+string.charCodeAt(i)+";");
     }
     if(data.length <= 14){
        return data.join("");
     }else{
        return data.slice(0,14).join("")+"..";
     }
   }

   function pview(obj){
        var stText=obj.innerHTML;
        var oPaNode=obj.parentNode.parentNode;
        var bHasFrame=oPaNode.getElementsByTagName("iframe");
        var h2=oPaNode.getElementsByTagName("h2")[0];
        var url=h2.getElementsByTagName("a")[0].getAttribute("href");
        if(stText=="预览"){
            if(bHasFrame.length==0){
                var p=document.createElement("p");
                p.className="viewD";
                var iframe=document.createElement("iframe");
                iframe.setAttribute("frameborder","0");
                iframe.setAttribute("SECURITY","restricted");
                iframe.setAttribute("src",url);
                iframe.setAttribute("allowtransparency","no");
                iframe.setAttribute("scrolling","auto");
                iframe.className="viewF";
                p.appendChild(iframe);
                oPaNode.appendChild(p);
            }else{
                bHasFrame[0].setAttribute("src",url);
                bHasFrame[0].style.display="block";
            }
            obj.className="view clview";
            obj.innerHTML="关闭预览";
        }else{
            bHasFrame[0].style.display="none";
            bHasFrame[0].setAttribute("src","");
            obj.className="view";
            obj.innerHTML="预览";
        }
    }
;
//function bq(form,fsr,fct){form.sr.value=fsr;form.ct.value=fct;form.action='/s';form.submit();return true;}
function h(obj,url){obj.style.behavior='url(#default#homepage)';obj.setHomePage(url);}
if (top.location != self.location) {top.location=self.location;}
function ga(o,e){if (document.getElementById){a=o.id.substring(1); p = "";r = "";g = e.target;if (g) { t = g.id;f0 = g.parentNode;if (f0) {p = f0.id;h = f0.parentNode;if (h) r = h.id;}} else{h = e.srcElement;f0 = h.parentNode;if (f0) p = f0.id;t = h.id;}if (t==a || p==a || r==a) return true;window.open(document.getElementById(a).href,'_blank')}}
function ss(w){window.status=w;return true;}
function cs(){window.status='';}
function c(q){var p=window.document.location.href,sQ='',sV='';for(v in q){switch (v){case "title":sV=encodeURIComponent(q[v].replace(/<[^<>]+>/g,""));break;case "url":sV=escape(q[v]);break;default:sV=q[v]}sQ+=v+"="+sV+"&"} (new Image()).src="http://s.baidu.com/w.gif?q=%BF%D5%BC%E4%B4%FA%C2%EB&"+sQ+"path="+p+"&cid=0&qid=40b6ddb704d35226&t="+new Date().getTime(); return true}
function al_c(A){while(A.tagName!="TABLE")A=A.parentNode;return A.getAttribute("id")}
function al_c2(n,c){while(c--){while((n=n.parentNode).tagName!="TABLE");};return n.getAttribute("id");}
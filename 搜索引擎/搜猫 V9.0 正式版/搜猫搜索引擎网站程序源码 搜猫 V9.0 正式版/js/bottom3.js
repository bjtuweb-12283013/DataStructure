function selectTag(showContent,wd,cate_id,selfObj){
	var tag = document.getElementById("tags").getElementsByTagName("a");
	var taglength = tag.length;
	for(i=0; i<taglength; i++){
		tag[i].className = "";
	}
	selfObj.className = "focu";
	
	document.f.wd.focus();
	document.f.wd.value=wd;
	document.f.s.value=cate_id;
	f.attributes[83].value=showContent;
	//document.f.action=showContent;

}
function selectTag_tieba(showContent,wd,cate_id,selfObj){
	var tag = document.getElementById("tags").getElementsByTagName("a");
	var taglength = tag.length;
	for(i=0; i<taglength; i++){
		tag[i].className = "";
	}
	selfObj.className = "focu";
	
	document.f.wd.focus();
	document.f.wd.value=wd;
	document.f.s.disabled="disabled";
	f.attributes[83].value=showContent;
	document.f.wd.name="kw";
	//document.f.action=showContent;

}
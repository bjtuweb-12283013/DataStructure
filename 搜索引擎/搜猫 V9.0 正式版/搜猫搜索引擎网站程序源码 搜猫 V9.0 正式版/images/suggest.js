function addListener(a, c, b){
    if (a.addEventListener) {
        a.addEventListener(c, b, false)
    }
    else {
        a.attachEvent("on" + c, b)
    }
}

var GoogleSuggest = function(j, o, c){
    var h = {
        acClass: "active",
        sugCase: "mod_gg_sug",
        sugUl: "mod_gg_sug_list",
        sugBtn: "mod_gg_sug_btn"
    };
    var u = document.getElementById(j), a = document.getElementById(o), q = document.createElement("div"), p = document.createElement("ul"), t = document.createElement("span");
    var d = this, b = -1, k = null, g = 300, x = a.value, r = a.value, l = 0, i = "http://suggestion.baidu.com/su?wd=";
    var y = function(A){
        if (A == "") {
            q.style.display = "none";
            x = A;
            return false
        }
        else {
            if (A == x) {
                return false
            }
            else {
                return true
            }
        }
    };
    var n = function(A){
        return id = Number(A.replace(h.sugCase, ""))
    };
    this.IsSuggest = true;
    var f = function(){
        t.id = h.sugBtn;
        t.innerHTML = "\u5173\u95ed\u81ea\u52a8\u63d0\u793a";
        p.id = h.sugUl;
        q.id = h.sugCase;
        q.appendChild(p);
        q.appendChild(t);
        u.appendChild(q);
        /*
        u.style.position = "relative";
        q.style.left = a.offsetLeft;
        q.style.top = a.offsetHeight - 1;
        if (document.all) {
            q.style.width = a.offsetWidth
        }
        else {
            q.style.width = a.offsetWidth - 2
        }
        */
    };
    this.FormSubmit = function(A){
        a.value = A;
        u.submit()
    };
    this.SuggestOff = function(){
        q.style.display = "none";
        p.innerHTML = "";
        this.IsSuggest = false
    };
    this.GetSuggest = function(){
        var C = a.value;
        if (y(C)) {
            var A = i + encodeURIComponent(C);
            if (B) {
                B.parentNode.removeChild(B)
            }
            var B = document.createElement("script");
            document.body.appendChild(B);
            B.charset="gb2312";
            B.src = A
        }
    };
    var m = function(){
        window.baidu = {};
        window.baidu.sug = function(F){
            p.innerHTML = "";
            b = -1;
            x = r = F.q;
            if (F.s.length == 0) {
                q.style.display = "none";
                l = 0
            }
            else {
                var D = [], C = 0, B = F.s.length;
                for (var E = 0; E < B; E++) {
                    var A = "<li id=" + h.sugCase + C + "><p>" + F.s[E] + "</p></li>"
                    D.push(A);
                    C++
                }
                p.innerHTML = D.join("");
                q.style.display = "block";
                l = 1;
                e()
            }
        }
    };
    var e = function(){
        var B = p.getElementsByTagName("li"), A = B.length;
        for (var C = 0; C < A; C++) {
            B[C].onclick = function(){
                d.FormSubmit(this.getElementsByTagName("p")[0].innerHTML)
            };
            B[C].onmouseover = function(){
                if (b != -1) {
                    document.getElementById(h.sugCase + b).className = ""
                }
                this.className = h.acClass;
                b = n(this.id)
            }
        }
    };
    var w = function(A){
        a.value = x = A ? A.getElementsByTagName("p")[0].innerHTML : r
    };
    var z = function(C, D, B){
        if (b == -1) {
            C[D].className = h.acClass;
            b = n(C[D].id);
            w(C[D])
        }
        else {
            C[b].className = "";
            var A = B == "next" ? C[b].nextSibling : C[b].previousSibling;
            if (A) {
                A.className = h.acClass;
                b = n(A.id);
                w(A)
            }
            else {
                b = -1;
                w()
            }
        }
    };
    var s = function(C){
        if (d.IsSuggest) {
            if (l == 1) {
                var B = p.getElementsByTagName("li"), A = B.length;
                if (C == "up") {
                    z(B, A - 1, "pre")
                }
                else {
                    if (C == "down") {
                        z(B, 0, "next")
                    }
                }
            }
        }
    };
    var v = function(){
        m();
        f();
        t.onclick = function(){
            d.SuggestOff()
        };
        addListener(a, "keydown", function(A){
            var C = window.event ? window.event : A;
            var B = C.keyCode;
            if (B == 38) {
                s("up")
            }
            else {
                if (B == 40) {
                    s("down")
                }
            }
        });
        a.onfocus = function(){
            if (d.IsSuggest) {
                if (k) {
                    clearInterval(k)
                }
                k = setInterval(d.GetSuggest, g)
            }
        };
        a.onblur = function(){
            clearInterval(k)
        };
        addListener(document, "click", function(A){
            var C = window.event ? window.event : A;
            var B = A.srcElement || A.target;
            if (B.id == h.sugCase) {
                return
            }
            else {
                l = 0;
                q.style.display = "none"
            }
        })
    };
    v()
};

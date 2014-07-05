var XMLHttp =
{
	Xpool: [],
	getX: function()
    {
		this.Xpool[this.Xpool.length] = this.createX();
		return this.Xpool[this.Xpool.length - 1];
    },
    createX: function()
    {
        if(window.ActiveXObject)
		{
			try
			{
				//IE 5.0+
				var X = new ActiveXObject("Microsoft.XMLHTTP");
			}
			catch (e)
			{
				try
				{
					//IE 5.0 -
					var X = new ActiveXObject("Msxml2.XMLHTTP");
				}
				catch (e){alert(e);}
			}
		}
		else if(window.XMLHttpRequest)
		{
			//mozilla 1.0+  safari 1.2+
			try
			{
				var X = new XMLHttpRequest();
				if(X.overrideMimeType)
				{
¡¡¡¡				X.overrideMimeType("text/xml");
¡¡				}
			}
			catch(e){alert(e);}	
		}
        return X;
	},
    getR: function(url,callback,type)
    {
        var Xobj = this.getX();
		try
		{
			if (url.indexOf("?") > 0)
			{
				url += "&randnum=" + Math.random();
            }
            else
            {
                url += "?randnum=" + Math.random();
            }
			Xobj.onreadystatechange = function ()
            {                   
				if (Xobj.readyState == 4)
                {
					if(Xobj.status == 200)
					{
						if(type=='xml')
						callback(Xobj.responseXML);
						else
						callback(Xobj.responseText);
					}
					else
					{
						alert("There was a problem with the request:"+Xobj.statusText);
					}
				}
                else
				{
					callback();
				}
			};
			Xobj.open("GET", url, true);
            Xobj.send(null);
		}
		catch(e)
		{
			alert(e);
		}
    },
    sendR: function(method, url, data, callback)
    {
		var	Xobj = this.getX();
		try
		{
			if (url.indexOf("?") > 0)
            {
				url += "&randnum=" + Math.random();
            }
            else
            {
                url += "?randnum=" + Math.random();
            }
			Xobj.open(method, url, true);
            Xobj.setRequestHeader("Content-Length",data.length);    
            Xobj.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded; charset=UTF-8');
            Xobj.send(data);
            Xobj.onreadystatechange = function ()
            {                   
				if (Xobj.readyState == 4 && (Xobj.status == 200 || Xobj.status == 304))
                {
					callback(Xobj.responseXML);
                }
            };
		}
		catch(e)
        {
			alert(e);
		}
    }
};
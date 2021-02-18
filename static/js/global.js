function setCookie(cname, cvalue, exdays) {
    var d = new Date();
    d.setTime(d.getTime() + (exdays*24*60*60*1000));
    var expires = "expires="+d.toUTCString();
    document.cookie = cname + "=" + cvalue + "; " + expires;
}

function expireCookie(name) {
	if (getCookie(name) != "")
	{
		document.cookie = name+"=; expires=Thu, 01 Jan 1970 00:00:00 GMT";
		return true;
	} 
	else
		return false;
}

function getCookie(name) {
	var cname = name + "=";
	var ca = document.cookie.split(';');
	for(var i = 0; i < ca.length; i++)
	{
		var c = ca[i];
		while (c.charAt(0)==' ')
			c = c.substring(1);
		if (c.indexOf(cname) != -1) 
			return c.substring(cname.length,c.length);
	}
	return "";
}

function checkCookie(name) {
	if (getCookie(name) != "")
		return true;
	else
		return false;
}

// Server clock
// (must be initialized in the head (or body) with a PHP date object)
// pad 

function padlength(what)
{		
	var output = (what.toString().length == 1) ? "0" + what : what;
	return output;
}


// time

function displayTime()
{		
	serverdate.setSeconds(serverdate.getSeconds()+1);
	var thisHackedMonth = serverdate.getMonth()+1;		// no idea why this is happening
	var datestring = padlength(serverdate.getFullYear() + "/" + thisHackedMonth  + "/" + serverdate.getDate()) + " ";
	var currentHours = padlength(serverdate.getHours());
	var currentHours = ( currentHours > 12 ) ? currentHours - 12 : currentHours;  		
	var timestring = currentHours + ":" + padlength(serverdate.getMinutes()) + ":" + padlength(serverdate.getSeconds());

	document.getElementById("serverTime").innerHTML=datestring + " " + timestring;
}
	

// expandImagePadding (toggle)
function expandImagePadding(thisId, originalSize, newSize) 
{
	var el = document.getElementById(thisId);
	
	if(el.style.padding == originalSize)
		el.style.padding = newSize;
    else
		el.style.padding = originalSize;
	
	return true;
}


// expandImageContainerMargin (toggle)
function expandImageContainerMargin(el, originalSize, newSize) 
{	
	if (el.style.margin == originalSize) 
	{
		var timestamp = new Date().getTime().toString();
		var zindexnow = timestamp.slice(-6);
		el.style.margin = newSize;			
		el.style.zIndex = zindexnow;
			
	}
	else 
	{
		el.style.margin = originalSize;		
		el.style.zIndex = "0";			
	}
		
	return true;
}

	
//  show / hide objects

function objectShow(id) {
	document.getElementById(id).style.visibility = "visible";
}
function objectHide(id) {
	document.getElementById(id).style.visibility = "hidden";
}


//  popup windows
function windowPop(url, id, width, height) 
{
	var x = (screen.width - width-30);
	var y = (screen.height - height-50);
	windowNew = window.open(url,id,"width="+ width +",height="+ height +",scrollbars=no,resizable=no,left="+ x +",top="+ y);
	windowNew.focus();
}


// show RSSs
function showRSS(el, str)
{
	if(str.length==0)
	{
		el.innerHTML="";	
		return;
  	}
	if(window.XMLHttpRequest)
	{
		xmlhttp = new XMLHttpRequest();
	} 
	else 
	{  
		// IE6, IE5
		xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");	
	}

	xmlhttp.onreadystatechange = function()
	{
		if(xmlhttp.readyState==4 && xmlhttp.status==200) 
		{
			el.innerHTML=xmlhttp.responseText;
		}
	};

  	xmlhttp.open("GET","_Library/orgRSSajax.php?xml=" + str,true);
  	xmlhttp.send();
}
// function getScrollbarWidth() {

//   // Creating invisible container
//   const outer = document.createElement('div');
//   outer.style.visibility = 'hidden';
//   outer.style.overflow = 'scroll'; // forcing scrollbar to appear
//   outer.style.msOverflowStyle = 'scrollbar'; // needed for WinJS apps
//   document.body.appendChild(outer);

//   // Creating inner element and placing it in the container
//   const inner = document.createElement('div');
//   outer.appendChild(inner);

//   // Calculating difference between container's full width and the child width
//   const scrollbarWidth = (outer.offsetWidth - inner.offsetWidth);

//   // Removing temporary elements from the DOM
//   outer.parentNode.removeChild(outer);

//   return scrollbarWidth;

// }
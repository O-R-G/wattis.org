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
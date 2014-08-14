// Server clock
// (must be initialized in the head (or body) with a PHP date object)
// pad 

function padlength(what) {
		
	var output = (what.toString().length == 1) ? "0" + what : what;
	return output;
}


// time

function displayTime() {
		
	serverdate.setSeconds(serverdate.getSeconds()+1);
	var thisHackedMonth = serverdate.getMonth()+1;		// no idea why this is happening
	var datestring = padlength(serverdate.getFullYear() + "/" + thisHackedMonth  + "/" + serverdate.getDate()) + " ";
	var currentHours = padlength(serverdate.getHours());
	var currentHours = ( currentHours > 12 ) ? currentHours - 12 : currentHours;  		
	var timestring = currentHours + ":" + padlength(serverdate.getMinutes()) + ":" + padlength(serverdate.getSeconds());

	document.getElementById("serverTime").innerHTML=datestring + " " + timestring;
}
	

// expand image (toggle)

function expandImage(thisId,originalSize,newSize) {

        if (document.getElementById(thisId).style.padding == originalSize) {

                document.getElementById(thisId).style.padding = newSize;
        } else {

                document.getElementById(thisId).style.padding = originalSize;
        }

        return true;
}


// expand expandImageContainerMargin (toggle)

function expandImageContainerMargin(thisId,originalSize,newSize) {

	if (document.getElementById(thisId).style.margin == originalSize) {

		document.getElementById(thisId).style.margin = newSize;			
		document.getElementById(thisId).style.zIndex = "100";
			
	} else {

		document.getElementById(thisId).style.margin = originalSize;		
		document.getElementById(thisId).style.zIndex = "0";			
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

function windowPop(url, id, width, height) {

	var x = (screen.width - width-30);
	var y = (screen.height - height-50);
	windowNew = window.open(url,id,"width="+ width +",height="+ height +",scrollbars=no,resizable=no,left="+ x +",top="+ y);
	windowNew.focus();
}


// show RSS

function showRSS(str) {

	if (str.length==0) { 

		document.getElementById("rss").innerHTML="";	
		return;
  	}

	if (window.XMLHttpRequest) {

		xmlhttp=new XMLHttpRequest();

	} else {  // IE6, IE5
    
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");	
	}

	xmlhttp.onreadystatechange=function() {
    
		if (xmlhttp.readyState==4 && xmlhttp.status==200) {
      
			document.getElementById("rss").innerHTML=xmlhttp.responseText;
		}
	}

  	xmlhttp.open("GET","_Library/orgRSSajax.php?xml="+str,true);
  	xmlhttp.send();
}


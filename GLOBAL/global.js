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
	

// expandImagePadding (toggle)

function expandImagePadding(thisId, originalSize, newSize) 
{
	var el = document.getElementById(thisId);
	if(el.style.padding == originalSize)
	{
		el.style.padding = newSize;
    } 
    else 
    {
		el.style.padding = originalSize;
    }
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

// image gallery

function launch(i) {
	show(gallery_id);
	// setbg(gallery_id, images[i]);
	setsrc(gallery_img, images[i]);
	index = i; // store current image index
	if(!attached)
	{
		document.addEventListener("click", gallery_listener);
		gallery_listener_set();
	}
}

function gallery_listener_set() {
	inGallery = true;
}

function prev() {
	if(index == 0)
		index = images.length;
	index--;
	setsrc(gallery_img, images[index]);
}

function next() {
	if(index == images.length-1)
		index = -1;
	index++;
	setsrc(gallery_img, images[index]);
}

function close_gallery() {
	inGallery = false;
	hide(gallery_id);
	if(attached)
		document.removeEventListener("click", gallery_listener);
	attached = false;
}

// use arrow keys for navigation within the gallery
document.onkeydown = function(e) {
	if(inGallery) {
		e = e || window.event;
		switch(e.which || e.keyCode) {
			case 37: // left
				prev();
			break;
			case 39: // right
				next();
			break;
			case 27: // esc
				close_gallery();
			break;
			default: return; // exit this handler for other keys
		}
		e.preventDefault();
	}
}

function setbg(id, url) {
	// get element
	el = document.getElementById(id);
	
	// build bg style
	bi = "url('/".concat(url).concat("')");
	el.style.backgroundImage = bi;
}

function setsrc(id, url) {
	// get element
	el = document.getElementById(id);
	el.src = url;
}

function hide(id)
{
	el = document.getElementById(id);
	el.classList.remove("visible");
	el.classList.add("hidden");
}

function show(id)
{
	el = document.getElementById(id);
	el.classList.remove("hidden");
	el.classList.add("visible");
}

function gallery_listener(e)
{
	var level = 0;
	attached = true;
  	for(var element = e.target; element; element = element.parentNode) {
		if(element.id === 'img-gallery') {
			console.log("img-gallery clicked")
			return;
		}
		level++;
	}
  	console.log("not img-gallery clicked");
}
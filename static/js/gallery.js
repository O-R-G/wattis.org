
// open the image gallery, starting at image i
function launch(i) {
	show(gallery_id);
	setsrc(gallery_img, images[i]);
	setinnerHTML(gallery_img_caption, captions[i]);
	index = i; // store current image index
	
	if(!attached)
	{
		// document.addEventListener("click", gallery_listener);
	}
	// this is such a cheat
	// the setting of inGallery needs to happen *after* the 
	// above eventListner is added to the document. URGH
	// setTimeout(function(){gallery_listener_set();}, 1000);
	inGallery = true;
}

function gallery_listener_set() {
	inGallery = true;
}

function prev() {
	if(index == 0)
		index = images.length;
	index--;
	setsrc(gallery_img, images[index]);
	setinnerHTML(gallery_img_caption, captions[index]);
}

function next() {
	if(index == images.length-1)
		index = -1;
	index++;
	setsrc(gallery_img, images[index]);
	setinnerHTML(gallery_img_caption, captions[index]);
}

function close_gallery() {
	inGallery = false;
	hide(gallery_id);
	if(attached)
	{
		// document.removeEventListener("click", gallery_listener);
	}
	attached = false;
}

// use arrow keys for navigation within the gallery
/*
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
*/
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

function setinnerHTML(id, url) {
	// get element
	el = document.getElementById(id);
	el.innerHTML = url;
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
			next();
			return;
		}
		level++;
	}
  	console.log("not img-gallery clicked");
}

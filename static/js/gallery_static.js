function launch_static(i, images) {
	index = i; // store current image index
	// var images = images;
	var btn_prev = document.getElementById('btn_prev');
	var btn_next = document.getElementById('btn_next');
	btn_prev.addEventListener('click', function(){prev();});
	btn_next.addEventListener('click', function(){next();});
	sNods[index].classList.add('active');
	Array.prototype.forEach.call(sNods, function(el, i){
		el.addEventListener('click', function(){
			jump(i);
		});
	});
}

function prev() {
	images[index].style.opacity = 0;
	sNods[index].classList.remove('active');
	if(index == 0)
		index = images.length;
	index--;
	images[index].style.opacity = 1;
	sNods[index].classList.add('active');
}

function next() {
	images[index].style.opacity = 0;
	sNods[index].classList.remove('active');
	if(index == images.length-1)
		index = -1;
	index++;
	images[index].style.opacity = 1;
	sNods[index].classList.add('active');
}
function jump(to_index){
	images[index].style.opacity = 0;
	sNods[index].classList.remove('active');
	index = to_index;
	images[index].style.opacity = 1;
	sNods[index].classList.add('active');
}

var gallery_static = {
	current_index: 0,
	launch: function(divs, gallery_control_container, tallest_idx) {
		console.log(gallery_control_container);
		this.divs = divs;
		this.gallery_control_container = gallery_control_container;
		var btn_prev = gallery_control_container.querySelector('#btn_prev');
		var btn_next = gallery_control_container.querySelector('#btn_next');
		var nods = gallery_control_container.querySelectorAll('.nods');
		this.nods = nods;
		let self = this;
		btn_prev.addEventListener('click', function(){self.prev();} );
		btn_next.addEventListener('click', function(){self.next();} );
		nods[this.current_index].classList.add('active');
		Array.prototype.forEach.call(sNods, function(el, i){
			el.addEventListener('click', function(){
				self.jump(i);
			});
		});
		[].forEach.call(divs, function(el, i){
			if(i == tallest_idx)
				el.style.position = 'relative';
			else
				el.style.position = 'absolute';
			el.style.top = 0;
			el.style.left = 0;
			if(i != 0)
				el.style.opacity = 0;
		});
	},
	prev: function () {
		let index = this.current_index;
		let images_divs = this.divs;
		let nods = this.nods;
		images_divs[index].style.opacity = 0;
		nods[index].classList.remove('active');
		if(index == 0)
			index = images_divs.length;
		index--;
		images_divs[index].style.opacity = 1;
		nods[index].classList.add('active');
		this.current_index = index;
	},
	next: function() {
		let index = this.current_index;
		let images_divs = this.divs;
		let nods = this.nods;
		images_divs[index].style.opacity = 0;
		nods[index].classList.remove('active');
		if(index == images_divs.length-1)
			index = -1;
		index++;
		images_divs[index].style.opacity = 1;
		nods[index].classList.add('active');
		this.current_index = index;
	},
	jump: function(to_index){
		let index = this.current_index;
		let images_divs = this.divs;
		let nods = this.nods;
		images_divs[index].style.opacity = 0;
		nods[index].classList.remove('active');
		index = to_index;
		images_divs[index].style.opacity = 1;
		nods[index].classList.add('active');
		this.current_index = index;
	}
}

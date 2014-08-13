
	// 	animatePunctuation.js
	//
	//   	id : {class}
	//	delay : ## [200]
	//	animate : {true, false}	
	//
	//   	animation patterns: (to do)
	//	0. shift all punct w/in a div
	// 	1. three punctuation marks consecutively
	//	2. individual marks animate
	// 	3. logo collector animate	


        function initPunctuation(id, delay, animate) {

		var divs = document.getElementsByClassName(id);
		var punct = new Array();
	
		for (var i = 0; i < divs.length; i++) {
			
			replaceNodes(divs[i]);			// add .punctuation nodes
			divs[i].delay = delay;			// array?
			divs[i].punctdivs = divs[i].getElementsByClassName("punctuation");

                        for (var k = 0; k < divs[i].punctdivs.length; k++) {
		
				punct.push(divs[i].punctdivs[k].innerHTML);
				divs[i].punct = punct;
			}	
		}

		if (animate) {

                	for (var j = 0; j < divs.length; j++) {

				animatePunctuation(divs[j], divs[j].punctdivs, divs[j].punct, divs[j].delay);
                	}
		}
	}


	function replaceNodes(node) {

		var next;
		var re = /([*+.:,;!.?\(\)\[\]\{\}\/~°•“”‘’\-–—])/g;		// to be cleaned up

		if (node.nodeType === 1) {
			
			if (node = node.firstChild) {
				do {
					next = node.nextSibling;                
					replaceNodes(node);

				} while(node = next);
			}

		} else if (node.nodeType === 3) {

			if (re.test(node.nodeValue)) {	

				temp = document.createElement("span");
				temp.innerHTML = node.nodeValue.replace(re, "<span class='punctuation'>$1</span>");
				node.parentNode.replaceChild(temp,node);
			}
		}

		return true;
	}


        function animatePunctuation(divs, punctdivs, punct, delay) {

		for (i = 0; i < punctdivs.length; i++) {

	   		punctdivs[i].innerHTML = punct[i];
		}
    		punct.push(punct.shift());
		var tt = setTimeout(function(){animatePunctuation(divs, punctdivs, punct, delay);}, delay);
	}

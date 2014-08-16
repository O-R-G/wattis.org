	//
	//   * in process *
	//
	//   - parse dom, replace punct
	//   - if three punct are found next to each other, then that identfies a zone to animate
	//   - second animation pattern for solo punctuation marks
	//   - how many it takes to identify the animation could also be a parameter	
	
	// http://regex101.com/r/yT7gZ0/1#javascript
	// ([.,;:])(?![^<]*>|[^<>]*<\/)


        function initPunctuation(id, delay, animate) {

		var divs = document.querySelectorAll("[id^=" + id + "]");	// better cross-browser method?
										// fix to make by class name
		// fix naming of arrays to more meaningful/consistent

        	var punctdivs = new Array();	
		var delays = new Array();
		var punct = new Array();
		var puncts = new Array();

                // var re = /["#$%&!()*+,\-.\/:;<=>?@\[\\\]^_`\{|\}~°•´∞«»–—“”‘’]/g;			// these two should match

		// find all text not between tags (ie, a child) or in tag
		var re = /([*+.:,;!?\(\)\[\]\{\}~°•“”‘’–—])(?![^<]*>|[^<>]*<\/)/g; 			// fill out punct
	
		//* find punctuation

		for (var i = 0; i < divs.length; i++) {
			
			// replaceChildren(divs[i]);
			replaceNodes(divs[i]);
			// divs[i].innerHTML = divs[i].innerHTML.replace(re, "<span class='punctuation'>$1</span>");

			delays[i] = delay;
			
			// naming of punct, punctdiv etc  ??

			punctdiv = divs[i].getElementsByClassName('punctuation');
			punctdivs.push(punctdiv);

                        for (var k = 0; k < punctdiv.length; k++) {
		
				punct.push(punctdivs[0][k].innerHTML);
				// console.log(k + "> " + punctdivs[0][k].innerHTML);
			}	

			puncts.push(punct);
		}


		// start animations

		if (animate) {

                	for (var j = 0; j < divs.length; j++) {

				// animatePunctuation(divs[j],punctdivs[j],puncts[j],delays[j]);
                	}
		}
	}


	function replaceNodes(node) {
	
		// based on http://james.padolsey.com/javascript/replacing-text-in-the-dom-its-not-that-simple/

		var next;
		var re = /([*+.:,;!?\(\)\[\]\{\}~°•“”‘’–—])/g;		// still can be adjusted, cleaned up

		if (node.nodeType === 1) {
			
			// element node : recurse for all childNodes

			if (node = node.firstChild) {

				do {

					console.log("***");
					next = node.nextSibling;                
					replaceNodes(node);

				} while(node = next);
			}

		} else if (node.nodeType === 3) {

			// text node : replace

			console.log("* " + node.nodeName + ", " + node.nodeType + " : " + node.nodeValue);

			if (re.test(node.nodeValue)) {	

				temp = document.createElement("span");
				// temp.innerHTML = "hello, world +++";

				temp.innerHTML = node.nodeValue.replace(re, "<span class='punctuation'>$1</span>");
	
				console.log(temp.nodeValue + " / " + temp.textContent);
				node.parentNode.replaceChild(temp,node);
			}
		}

		return true;
	}



/*
	// this could be written inline to the above function

	function replaceChildren(thisDiv) {

		// this should match the other regex and could be passed as well
		var re = /(["#$%&!()*+,\-.\/:;<=>?@\[\\\]^_`\{|\}~°•´∞«»–—“”‘’])/g;		

		if (thisDiv.children.length) {

			for (j = 0; j < thisDiv.children.length; j++) {

				replaceChildren(thisDiv.children[j]);
			}
		} else {

			thisDiv.innerHTML = thisDiv.innerHTML.replace(re, "<span class='punctuation'>$1</span>");
		}	
		return true;
	}
*/





        function animatePunctuation(divs, punctdivs, puncts, delays) {

		for (i = 0; i < punctdivs.length; i++) {

	   		punctdivs[i].innerHTML = puncts[i];
		}

    		puncts.push(puncts.shift());
		var tt = setTimeout(function(){animatePunctuation(divs,punctdivs,puncts,delays);}, delays); 	
	}



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

	// 	globals
	
	var timeout;


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
		var re = /([*+.:,;!.?\(\)\[\]\{\}\/~°•“”‘’\-–—_])/g;		// to be cleaned up

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
		timeout = setTimeout(function(){animatePunctuation(divs, punctdivs, punct, delay);}, delay);
	}


        function startStopAnimatePunctuation(delay) {

		if (timeout == null) {

			initPunctuation("animatePunctuation", delay, true);
			document.cookie="animateCookie=true; expires=Fri, 16 Aug 2024 12:00:00 GMT";
			addRemoveDivWithMouseDown("_click", clickHandler);
			return true;

		} else {

			clearTimeout(timeout);
			timeout=null;
			document.cookie = "animateCookie=; expires=Thu, 01 Jan 1970 00:00:00 GMT";
			return false;	
		}

	}


	function getCookie(cname) {
    
		var name = cname + "=";
		var ca = document.cookie.split(';');

		for(var i = 0; i < ca.length; i++) {
        
			var c = ca[i];
        		while (c.charAt(0)==' ') c = c.substring(1);
        		if (c.indexOf(name) != -1) return c.substring(name.length,c.length);
    		}

   	 	return "";
	}
	

	function checkCookie(name) {

                if (getCookie(name) != "") {

                        return true;

                } else {

			return false; 
                }
	}


        function clickHandler(id,_old,_new) {

                swapClass("color","black","white");
                // swapClass("news","red","white");
                addRemoveDivWithMouseDown("_click", clickHandler);
        }


        function swapClass(id,class1,class2) {

                document.getElementById(id).className = (document.getElementById(id).className != class1) ? class1 : class2;
        }


        function addRemoveDivWithMouseDown(id,handler) {

                var clickDiv = document.getElementById(id);

                if (clickDiv == null) {

                        clickDiv = document.createElement("div");
                        clickDiv.id = "_click";
                        clickDiv.className = "fullContainer greybox transparent";
                        clickDiv.onmousedown = handler;
                        document.body.appendChild(clickDiv);

                } else {

                        var child = document.getElementById(id);
                        child.parentNode.removeChild(child);
                }
        }

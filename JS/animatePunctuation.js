
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


        function initPunctuation(id, delay, replace, animate) {

		var divs = document.getElementsByClassName(id);
		var punct = new Array();
	
		for (var i = 0; i < divs.length; i++) {
			
			if (replace) {
	
				replaceNodes(divs[i]);		// add .punctuation nodes
			}

			divs[i].punctdivs = divs[i].getElementsByClassName("punctuation");

                        for (var k = 0; k < divs[i].punctdivs.length; k++) {
		
				punct.push(divs[i].punctdivs[k].innerHTML);
				divs[i].punct = punct;
			}	
		}

		if (animate) {

			clearTimeout(timeout);                               
			timeout=null;
			animatePunctuation(divs,delay);
		}	

		document.onkeydown=function(e){
	
			if (e.keyCode == 187) {

				delay -= ((delay-10) < 0) ? 0 : 10;
				initPunctuation('animatePunctuation', delay, false, animate);
				updateControlDisplay(animate,delay,"+")

			} else if (e.keyCode == 189) {

				delay += ((delay+10) > 400) ? 0 : 10;
				initPunctuation('animatePunctuation', delay, false, animate);
				updateControlDisplay(animate,delay,"–")
			}

			document.cookie="delayCookie=" + delay;

		};

	}


	function replaceNodes(node) {

		var next;
		var re = /([*+.:,;!.?\(\)\[\]\{\}\/~°•“”‘’\-–—_&@])/g;

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


        function animatePunctuation(divs,delay) {

		for (var j = 0; j < divs.length; j++) {

			for (i = 0; i < divs[j].punctdivs.length; i++) {

		   		divs[j].punctdivs[i].innerHTML = divs[j].punct[i];
			}

    		divs[j].punct.push(divs[j].punct.shift());
		}

		timeout = setTimeout(function(){animatePunctuation(divs,delay);}, delay);
	}


	// control

	// if (timeout == null) 

	// 0. start animation
	// 1. set cookie
	// 2. add clickDiv
	// 3. white --> black
	// 4. red --> white (?index)

	//      + click + (clickDiv)
	//      0. white --> black
	//      1. white --> red (?index)
	//      2. remove clickDiv

	// else

	// 0. stop animation
	// 1. expire cookie


        function startStopAnimatePunctuation() {

 		if (timeout == null) {
							
	                delay = (checkCookie("delayCookie")) ? ((getCookie("delayCookie")) * 1) : 200;
			initPunctuation("animatePunctuation", delay, false, true);			
			document.cookie="animateCookie=true";
			var click = clickHandler();
			return true;

		} else {

			clearTimeout(timeout);
			timeout=null;
			document.cookie = "animateCookie=; expires=Thu, 01 Jan 1970 00:00:00 GMT";
			document.cookie = "logoCookie=" + escape(document.getElementById("logo").textContent);
			return false;
		}
	}

	
        function clickHandler() {
                       
		swapClass("color","black","white");
		if (document.getElementById("news")) { swapClass("news","red","redwhite"); }
		addRemoveClickDiv("_click", clickHandler);
        }


        function swapClass(id,class1,class2) {

		if (document.getElementsByClassName) {

			var elementsClass1 = document.getElementById(id).getElementsByClassName(class1);
			var elementsClass2 = document.getElementById(id).getElementsByClassName(class2);
			var elements = (elementsClass1.length) ? elementsClass1 : elementsClass2;
			var replace = (elementsClass1.length) ? class2 : class1;

			for (var i = 0; i < elements.length; i++) {

				elements[i].className = replace;
			}
		}

		document.getElementById(id).className = (document.getElementById(id).className != class1) ? class1 : class2;
        }


        function addRemoveClickDiv(id, handler) {

                var clickDiv = document.getElementById(id);

                if (clickDiv == null) {

			clickDiv = document.createElement("div");
        	        clickDiv.id = id;
                	clickDiv.className = "fullContainer";
	                clickDiv.onmousedown = handler;
        	        document.body.appendChild(clickDiv);
	
		} else {

                        clickDiv.parentNode.removeChild(clickDiv);
		}
        }


	function getCookie(name) {
    
		var cname = name + "=";
		var ca = document.cookie.split(';');

		for(var i = 0; i < ca.length; i++) {
        
			var c = ca[i];
        		while (c.charAt(0)==' ') c = c.substring(1);
        		if (c.indexOf(cname) != -1) return c.substring(cname.length,c.length);
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


	function updateControlDisplay(animate,delay,plus) {
    
		if ( document.getElementById("control")) { 

			document.getElementById("control").textContent = animate + " : " + (400 - delay) + " " + plus; 
		}
	}

	// + todo	
	//
	//   - strip existing tags from the div before the search (or ignore them anyway via regex)
	//     http://nadeausoftware.com/articles/2007/9/php_tip_how_strip_punctuation_characters_web_page
	//     http://stackoverflow.com/questions/5233734/how-to-strip-punctuation-in-php
	//   - if three punct are found next to each other, then that identfies a zone to animate
	//   - second animation pattern for solo punctuation marks
	//   - how many it takes to identify the animation could also be a parameter	


        function initPunctuation(divId) {

        	var message = new Array();	
		var div = document.querySelectorAll("[id^=" + divId + "]");
		var delay = new Array();	

		//* find punctuation

		for (var i = 0; i < div.length; i++) {

                        spanCount = 0;
                        str = div[i].innerHTML;
                        re = /[!"#$%&()*+,\-.\/:;<=>?@\[\\\]^_`\{|\}~°•´∞±≤≥¿¡«»–—“”‘’÷‹›¦−×⁏⁑‿⁀⁐ ∗∘∙∴∵≀∪∩⊂⊃┌┐]/g;
                        // re = /[,.]/g;	// minimal
			var harvest = str.match(re);
			message[i] = harvest;

			var result = str.replace(re, function(match){

				var replaced = "<span id='" + div[i].id + "-" + spanCount + "' class='monaco big black'>" + match + "</span>";
				spanCount++;	
				return replaced;
			});

                        div[i].innerHTML = result;
			delay[i] = 200;
			// delay[i] = (10 * i)+90;
			// console.log(div[i]);
			// console.log(message[i]);
			// console.log(delay[i]);
		}

		// start animations

                for (var j = 0; j < div.length; j++) {

			animatePunctuation(div[j],message[j], delay[j]);
                }
	}


        function animatePunctuation(div,message, delay) {

		for (i = 0; i < message.length; i++) {
			
			thisSpanId = div.id + "-" + i;
	   		document.getElementById(thisSpanId).innerHTML = message[i];
		}

		message.push(message.shift());		// push / pop
		var tt = setTimeout(function(){animatePunctuation(div,message,delay);}, delay);
	}

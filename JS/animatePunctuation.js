	// + todo	
	//
	//   - strip existing tags from the div before the search (or ignore them anyway via regex)
	//     http://nadeausoftware.com/articles/2007/9/php_tip_how_strip_punctuation_characters_web_page
	//     http://stackoverflow.com/questions/5233734/how-to-strip-punctuation-in-php
	//   - if three punct are found next to each other, then that identfies a zone to animate
	//   - second animation pattern for solo punctuation marks
	//   - how many it takes to identify the animation could also be a parameter	

	// stripping html tags:

	// 0. search the input text for anything between '<' and '>'
	// 1. remove these from the string that gets searched and replaced
	//    though unsure how to both ignore them and then put them back in ...
	//    maybe there is regex way to do this, i suspect there is with [^< >]
	//    and that is surely the cleanest way
	//    the other option is to save them out in an array, put in a marker, 
	//    then write them back in the completed string after the fact
	//    either way it will require a lookaround, lookahead or some such
	//    
	//    read up properly on regex 
	// http://stackoverflow.com/questions/406230/regular-expression-to-match-string-not-containing-a-word


        function initPunctuation(id, delay, animate) {

        	var messages = new Array();	
		var divs = document.querySelectorAll("[id^=" + id + "]");
		var delays = new Array();	

		//* find punctuation

		for (var i = 0; i < divs.length; i++) {

                        spanCount = 0;
                        str = divs[i].innerHTML;
                        re = /[!"#$%&()*+,\-.\/:;<=>?@\[\\\]^_`\{|\}~°•´∞±≤≥¿¡«»–—“”‘’÷‹›¦−×⁏⁑‿⁀⁐ ∗∘∙∴∵≀∪∩⊂⊃┌┐]/g;
                        //re = /[,.]/g;	// minimal
			var harvest = str.match(re);
			messages[i] = harvest;

			var result = str.replace(re, function(match){

				var replaced = "<span id='" + divs[i].id + "-" + spanCount + "' class='monaco big black'>" + match + "</span>";
				spanCount++;
				return replaced;
			});

                        divs[i].innerHTML = result;
			delays[i] = delay;
		}

		// start animations

		if (animate) {

                	for (var j = 0; j < divs.length; j++) {

				animatePunctuation(divs[j],messages[j], delays[j]);
                	}
		}
	}


        function animatePunctuation(divs, messages, delays) {

		for (i = 0; i < messages.length; i++) {
			
			thisSpanId = divs.id + "-" + i;
	   		document.getElementById(thisSpanId).innerHTML = messages[i];
		}

		messages.push(messages.shift());		// push / pop
		var tt = setTimeout(function(){animatePunctuation(divs,messages,delays);}, delays); 	// surely something funny in how this sets delays as is passing an array (!) ** fix **
		// var tt = setTimeout(function(){animatePunctuation(divs,messages,delays);}, delays[i]); 	// but this one doesnt work either
		// refer to animatePunctuation logic to sort this out
	}

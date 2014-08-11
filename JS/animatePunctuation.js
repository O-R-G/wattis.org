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

	// http://regex101.com/r/oY0bV5/1
	// <[^@].*?>/gmi
	// matches anything between < and >
	// http://regex101.com/r/oY0bV5/3
	// (<([^>]+)>)/ig
	// ([<].*[>])?
	// http://regex101.com/r/oY0bV5/4
	// http://regex101.com/r/oY0bV5/2
	// [,./][^h](?=e) looks ahead and matches ,./ and not an h when followed by e
	
	// seems like the way to do this is in two parts, first find the material in brackets, then put in placeholder text
	// then search for punct, then replace. * not elegant *
	// find any punctuation mark unless there is a "<" behind it or ">" in front of it
	// problem seems to be no lookbehind in js

	// unused regex

        // re = /[!"#$%&()*+,\-.\/:;<=>?@\[\\\]^_`\{|\}~°•´∞±≤≥¿¡«»–—“”‘’÷‹›¦−×⁏⁑‿⁀⁐ ∗∘∙∴∵≀∪∩⊂⊃┌┐]/g;
	// re = /[,.]/g;	// minimal
	// re = /<(.*?)>/gmi; 			// looser 
	// re = /((>)(.*?)(<))/gmi; 
	// re = /<([^>]+)\>/gmi; 
	// re = /(<([^>]+)\>)/gi; 		// strict, with groups
	// re = /(<)([.:,;])+?(>)/gi; 		// punct within < >
	// re = /(?:<)([^>]+)(?:\>)/gmi; 	// non-capturing groups
	// re = /([.:,;!]).+?(?!>)/gi; 		// punct within < > -- almost works

	// three ways to tackle
	
	// 0. regex
	// 1. js/dom
	// 2. jQuery


// ALMOST HAVE THIS, ONLT THE MESSAGES[] ARRAY IS THE PROBLEM, OTHERWISE WORKING FOR INFINITE LEVEL DEEP
// WITH EXCEPTION OF TOP LEVEL, BUT CAN CREATE A TEMP DIV THAT WRAPS ALL TO MAKE THAT ONE REPLACE CORRECTLY


        function initPunctuation(id, delay, animate) {

        	var messages = new Array();	
		var divs = document.querySelectorAll("[id^=" + id + "]");	// better cross-browser method?
		var delays = new Array();

		//* find punctuation

		for (var i = 0; i < divs.length; i++) {

			// callback issue, asynchronous, messages scope issue

			findChildren(divs[i]);
			delays[i] = delay;
			messages[i] = ":";
		}

		// start animations

		if (animate) {

                	for (var j = 0; j < divs.length; j++) {

				// animatePunctuation(divs[j],messages[j], delays[j]);
                	}
		}
	}


        function animatePunctuation(divs, messages, delays) {

		for (i = 0; i < messages.length; i++) {
			
			thisSpanId = divs.id + "-" + i;
	   		document.getElementById(thisSpanId).innerHTML = messages[i];
		}

		messages.push(messages.shift());		// push / pop
		var tt = setTimeout(function(){animatePunctuation(divs,messages,delays);}, delays); 	
	}


	function findChildren(thisDiv) {

		// need to follow the pattern of first inventing a div to hold the divs so that 
		// or maybe just the innerHTML of the top level div is enough
		// see http://stackoverflow.com/questions/7864723/javascript-regexp-match-text-between-a-tags
	
		var children = thisDiv.children;
		var messages = new Array();

		if (thisDiv.children.length) {

			console.log(thisDiv.children);
			console.log("++++++++++");

			for (j = 0; j < children.length; j++) {

				findChildren(thisDiv.children[j]);
			}

		} else {

			console.log("*");	
			// replace

			// spanCount not currently working	
        		spanCount = 0;

        		re = /["#$%&!()*+,\-.\/:;<=>?@\[\\\]^_`\{|\}~°•´∞«»–—“”‘’]/g;
			str = thisDiv.innerHTML;
		
		/*	messages scope issue

			var harvest = str.match(re);	
			for (k = 0; k < harvest.length; k++) {
		
				messages.push(harvest[k]);
			}
			console.log("messages = " + messages);
			console.log("messages.length = " + messages.length);
		*/		
		
			var result = str.replace(re, function(match1, match2, match3){
		
				var replaced = "<span id='" + thisDiv.id + "-" + spanCount + "' class='monaco big red'>" + match1 + "</span>";
				spanCount++;
				return replaced;
			});
		
			// children[j].innerHTML = result;
			thisDiv.innerHTML = result;
		}	

		// what to return?
		// return thisDiv;
		// return messages;		// ?
	}


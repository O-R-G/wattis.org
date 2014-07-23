	// may want the individual chunks to animate at different speeds?
	// or individual punctuation to animate at different speeds
	// or at least separate chunks behave coherent to themselves only
	// in which case, should implement second funtion that sets timeout 
	// so it may be done asynchronously like animateEmoticons.js

	// init should be called within the context of a div, and within then you look for the punctuation
	// in fact, the php page could for now feed this js the raw text, with no tags
	// or can work on a regex to ignore the tags
	// http://nadeausoftware.com/articles/2007/9/php_tip_how_strip_punctuation_characters_web_page
	// http://stackoverflow.com/questions/5233734/how-to-strip-punctuation-in-php

	// globals		

	displaylength = 1;	// might likely be passed to function / object
	displaytimeout = 200;	// might likely be passed to function / object

        function initPunctuation(divId) {

		if (document.getElementById(divId)){

			// will have to clean up <br/>, <a href> and other tags first before regex otherwise searching
			// should be easy to do with a regex already made for the task

			str = document.getElementById(divId).innerHTML;
			re = /[!"#$%&()*+,\-.\/:;<=>?@\[\\\]^_`\{|\}~°•´∞±≤≥¿¡«»–—“”‘’÷‹›¦−×⁏⁑⁔‿⁀⁐⁖∗∘∙∴∵≀∪∩⊂⊃┌┐]/g; 
			count = 0;
			// harvest = "";

			// match returns an array with all matches
			// need to collect a harvest array
		
			// should be easy enough to do both things at once, to match a regex and return an array of refs
			// sloppy would be with a global array, but i suspect a cleaner way here:
			// https://developer.mozilla.org/en/Core_JavaScript_1.5_Reference/Global_Objects/String/replace#Specifying_a_function_as_a_parameter
			// also need to sort out what we need in the array
	
			var harvest = str.match(re);

			// replace with callback
			// might replace count with a passed callback parameter
				
			var result = str.replace(re, function(match)
			{
				// harvest += match + "@";	// this is the sloppy way, globals
				count++;			// also sloppy global used to trigger animatePunctuation
				return  "<span id='punctuation" + count + "' class='monaco big black'>" + match + "</span>";
			});

			document.getElementById(divId).innerHTML = result;
			// console.log(result);	
	
			animatePunctuation(count,harvest);
		}
	}


	// this can work on multiple divs using logic from animateEmoticons

        function animatePunctuation(count,harvest) {

		for (i = 1; i <= count; i++) {

			thisElement = "punctuation" + i;
			randomIndex = Math.floor((Math.random() * count) + 1);

			if (document.getElementById("punctuation"+i)){

   				document.getElementById("punctuation"+i).innerHTML = harvest[i];	

				for (j = 1; j < displaylength; j++) {

	   				document.getElementById("punctuation"+i).innerHTML += harvest[i+j];
				}	

				// document.getElementById("punctuation"+i).innerHTML = harvest[i] + harvest[i+1] + harvest [i+2];	
			}

			if (document.getElementById("punctuationsummary")){

				document.getElementById("punctuationsummary").innerHTML = harvest[i];	

				for (j = 1; j < displaylength; j++) {

					document.getElementById("punctuationsummary").innerHTML += harvest[i+j];	
				}	
			}
		}

		// pop/push the array

		// remove and return first element of array then add it to the end
		// http://stackoverflow.com/questions/8073673/how-can-i-add-new-array-elements-at-the-top-of-an-array-in-javascript

		harvest.push(harvest.shift());

		// set timeout

		// definitely a scope issue *fix* -- perhaps solved with callbacks
		// scope issue is bc setTimeout is a method of window object and 
		// so then more abstract than document object
		// two workarounds:
		// 1. anonyomous function wrapper / function reference
		// 2. closure using object this encapsulated by local function var
		
		// better to use second version bc first just evals that code
		// whereas the second passes a reference to the js function
		// var tt = setTimeout(animatePunctuation, 200);

		// this one wraps it in an anonyomous function
		var tt = setTimeout(function(){animatePunctuation(count,harvest);}, displaytimeout);
		// var thisRandomDelay = Math.floor((Math.random() * 200) + 100);
		// var tt = setTimeout(function(){animatePunctuation(count,harvest);}, thisRandomDelay);
 	}

	// init should be called within the context of a div, and within then you look for the punctuation
	// in fact, the php page could for now feed this js the raw text, with no tags
	// or can work on a regex to ignore the tags
	// http://nadeausoftware.com/articles/2007/9/php_tip_how_strip_punctuation_characters_web_page
	// http://stackoverflow.com/questions/5233734/how-to-strip-punctuation-in-php

	// globals		

	var displaylength = 1;	// might likely be passed to function / object
	var displaytimeout = 200;	// might likely be passed to function / object

        var divs = new Array();		// div refs 
        var message = new Array();	// unused
        var delay = new Array();	// unused
        var thisCounter = new Array();	// unused


        function initPunctuation(ok) {

		var divPrefix = "Punct";  	// this could be passed as a parameter to initPunctuation (better)
		var divCount = 0;

		// populate divs[]


		while (divs[divCount] = document.getElementById(divPrefix+"-"+divCount)){

			// find punctuation

                        str = divs[divCount].innerHTML;
                        re = /[!"#$%&()*+,\-.\/:;<=>?@\[\\\]^_`\{|\}~°•´∞±≤≥¿¡«»–—“”‘’÷‹›¦−×⁏⁑ ‿⁀⁐ ∗∘∙∴∵≀∪∩⊂⊃┌┐]/g;
                        spanCount = 0;

			// build array of matches		

			var harvest = str.match(re);		// do this same time as replace?

			// add <span>

			var result = str.replace(re, function(match)
			{
				var replaced = "<span id='"+ divPrefix + "-" + divCount + "-" + spanCount + "' class='monaco big black'>" + match + "</span>";
				spanCount++;	// could just count harvest also sloppy global used to trigger animatePunctuation
				return replaced;
			});

                        divs[divCount].innerHTML = result;
			console.log(divs[divCount]);
			divCount++;

			divId = divPrefix + "-" + divCount;
			// divId = "Punct-2";

			animatePunctuation(divs[divCount],harvest,divId);
		}
	}


        function animatePunctuation(thisDiv,harvest,thisDivId) {

		// this can work on multiple divs using logic from animateEmoticons

		// for safety?
		// if (thisDiv != null){

		// spans

		for (i = 0; i < harvest.length; i++) {

			// characters
			// best to use js find children of div from div[]

// currently cannot find these elements if added to innerHTML rather than in doc proper
// so i have fake divs in punctuation.php
// will require figuring out how to troll DOM and find these subelements, should beeasy enough
thisSpanId = "" + thisDivId + "-" + i;
// thisSpanId = "Punct-2-1";
// thisSpanId = thisDivId;
// console.log(thisSpanId);

	   		document.getElementById(thisSpanId).innerHTML = harvest[i];
	   		// document.getElementById(thisDivId+"-"+i).innerHTML = harvest[i];
	   		// document.getElementById("Punct-2-1").innerHTML = harvest[i];
		}

		// push/pop

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
		var tt = setTimeout(function(){animatePunctuation(thisDiv,harvest,thisDivId);}, displaytimeout);
 	}

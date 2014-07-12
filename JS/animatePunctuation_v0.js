	// globals
	
	punctuationCounter = 0;	// *fix* could be wrapped
 	stubSymbol = ",";	// *fix* scope issue

        function animatePunctuation(thisAddedSymbol) {
	
		// could rewrite this all as an object and prob better

		// troll thru DOM
		// cant be more than one id of same name *fix*
		// also could use .add and write in whole thing with <span> etc.
		// rather than doing that in php

		// document.getElementById("punctuation").innerHTML += thisAddedSymbol;	
		document.getElementById("punctuation").innerHTML = thisAddedSymbol;	

		/*
		//while ( document.getElementById("punctuation").innerHTML ) {
		while ( document.getElementById("punctuation") ) {

			// rewrite innerhtml
			thisinnerhtml = "hello";
			punctuationCounter++;
		};
		*/


		// set timeout
		// definitely a scope issue *fix* -- perhaps solved with callbacks
		// scope issue is bc setTimeout is a method of window object and 
		// so then more abstract than document object
		// two workarounds:
		// 1. anonyomous function wrapper / function reference
		// 2. closure using object this encapsulated by local function var

		if (stubSymbol == ",") {
		stubSymbol = "*";
		} else {
		stubSymbol = ",";
		}
		
		// better to use second version bc first just evals that code
		// var tt = setTimeout("animatePunctuation(stubSymbol)", 200);
		var tt = setTimeout(function(){animatePunctuation(stubSymbol);}, 200);

 	}

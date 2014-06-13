	// globals
	
	punctuationCounter = 0;	// *fix* could be wrapped
 	stubSymbol = ",";	// *fix* scope issue
 	stubClass = " monaco big black";	// *fix* scope issue

        function animatePunctuation() {
	
		// could rewrite this all as an object

		// troll thru DOM

		// here, build this off of animateEmoticons logic, copy and paste
		// this a rough quick fix

		for (i = 1; i < 60; i++) {

			thisElement = "punctuation" + i;

			// document.getElementById(eval(thisElement)).innerHTML = stubSymbol;	
			// document.getElementById("punctuation"+i).innerHTML = stubSymbol;	
			document.getElementById("punctuation"+i).className = stubClass;
		}


		// set timeout

		// definitely a scope issue *fix* -- perhaps solved with callbacks
		// scope issue is bc setTimeout is a method of window object and 
		// so then more abstract than document object
		// two workarounds:
		// 1. anonyomous function wrapper / function reference
		// 2. closure using object this encapsulated by local function var

		if (stubSymbol == ",") {
			stubSymbol = "&nbsp;";
		} else {
			stubSymbol = ",";
		}

		if (stubClass == " monaco big black") {
			stubClass = " monaco big white";
		} else {
			stubClass = " monaco big black";
		}
		
		// better to use second version bc first just evals that code
		// var tt = setTimeout("animatePunctuation(stubSymbol)", 200);
		// var tt = setTimeout(animatePunctuation, 200);
		var thisRandomDelay = Math.floor((Math.random() * 100) + 1);
		// var tt = setTimeout(animatePunctuation, thisRandomDelay);
		var tt = setTimeout(function(){animatePunctuation(stubSymbol);}, 400);

 	}

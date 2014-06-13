	// globals
	
	punctuationCounter = 0;	// *fix* could be wrapped
 	stubSymbol = ",";	// *fix* scope issue

        function animatePunctuation(thisAddedSymbol) {
	

		// troll thru DOM

		// document.getElementById("punctuation").innerHTML += thisAddedSymbol;	
		document.getElementById("punctuation").innerHTML = thisAddedSymbol;	

		// need to figure out how to move thru the DOM and whether it is ok to have multiple ids that are the same

		/*
		//while ( document.getElementById("punctuation").innerHTML ) {
		while ( document.getElementById("punctuation") ) {

			// rewrite innerhtml
			thisinnerhtml = "p";
			// thisinnerhtml += "hello";	
			// punctuationCounter++;

		};
		*/


		// set timeout
		// definitely a scope issue *fix* -- perhaps solved with callbacks

		if (stubSymbol == ",") {
		stubSymbol = "*";
		} else {
		stubSymbol = ",";
		}

		var tt = setTimeout("animatePunctuation(stubSymbol)", 200);

 	}

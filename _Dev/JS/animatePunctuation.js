	// requires .php for text parsing
	// requires divs named "punctuation[#]" in sequence
	// these are produced by .php parsing script
	// could rewrite this all as an object, even perhaps parse in .js
	
	// may want the individual chunks to animate at different speeds?
	// or individual punctuation to animate at different speeds
	// or at least separate chunks behave coherent to themselves only

	// in which case, should implement second funtion that sets timeout so it may be done asynchronously like animateEmoticons.js

	// globals		

	displaylength = 3;	// might likely be passed to function / object
	displaytimeout = 200;	// might likely be passed to function / object

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

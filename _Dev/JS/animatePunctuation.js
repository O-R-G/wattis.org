	// globals
		
 	stubClass = " monaco big black";	// *fix* scope issue

        function animatePunctuation(count,harvest) {
	
		// could rewrite this all as an object

		// troll thru DOM

		// here, build this off of animateEmoticons logic, copy and paste
		// this a rough quick fix

		for (i = 1; i <= count; i++) {

			thisElement = "punctuation" + i;
			randomIndex = Math.floor((Math.random() * count) + 1);

			if (document.getElementById("punctuation"+i)){
				// document.getElementById("punctuation"+i).className = stubClass;
				document.getElementById("punctuation"+i).innerHTML = harvest[i];	
				// document.getElementById("punctuation"+i).innerHTML = harvest[i] + harvest[i+1] + harvest [i+2];	
			}			
			if (document.getElementById("punctuationsummary")){
				// document.getElementById("punctuationsummary").innerHTML = harvest[i];	
				document.getElementById("punctuationsummary").innerHTML = harvest[i] + harvest[i+1] + harvest [i+2];	
				// document.getElementById("punctuation"+i).innerHTML = harvest[randomIndex];	
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

		if (stubClass == " monaco big black") {
			stubClass = " monaco big white";
		} else {
			stubClass = " monaco big black";
		}
		
		// better to use second version bc first just evals that code
		// whereas the second passes a reference to the js function
		// var tt = setTimeout("animatePunctuation(stubSymbol)", 200);
		// var tt = setTimeout(animatePunctuation, 200);
		var thisRandomDelay = Math.floor((Math.random() * 100) + 1);
		// var tt = setTimeout(animatePunctuation, thisRandomDelay);
		// this one wraps it in an anonyomous function
		var tt = setTimeout(function(){animatePunctuation(count,harvest);}, 100);
 	}

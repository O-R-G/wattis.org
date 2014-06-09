	// globals
	
	newsCounter = 0;	// *fix* could be wrapped

        function newsTicker(thisnewsItem) {
	
		// rewrite innerhtml

		thisinnerhtml = "<div id='news' class='newsContainer red'><canvas id='canvas14' width='20' height='24'>!</canvas>";
		thisinnerhtml += thisnewsItem;
		thisinnerhtml += "<canvas id='canvas11' width='12' height='24'>!</canvas></div>";
		document.getElementById("news").innerHTML = thisinnerhtml;

		// increment pointer 

		if ( newsCounter >= newsItem.length - 1 ) {

			newsCounter=0;

		} else {
		
			newsCounter++;
		}

		// set timeout
		// scope issue *fix*

		var tt = setTimeout("newsTicker(newsItem[newsCounter])", 3000);
 	}

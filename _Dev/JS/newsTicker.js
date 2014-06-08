	// globals
	
	newsCounter = 0;
	newsItem = new Array("ok", "and", "this", "too"); 	// better wrapped into function

	thisNewsTickerDiv = document.getElementById("news");

        function newsTicker(thisnewsItem) {

                // thisCounter[thisCanvasID]++;
                // thisContext[thisCanvasID].clearRect(0, 0, thisCanvas[thisCanvasID].width, thisCanvas[thisCanvasID].height);

		// modulus select in message array
		// frameNumber = thisCounter[thisCanvasID] % message[thisCanvasID].length;
		// thisContext[thisCanvasID].fillText(thisMessage[thisCanvasID][frameNumber], xPos, yPos);
	
		// rewrite innerhtml

		// thisNewsTickerDiv.innerHTML = "HELLO, WORLD!";
		thisNewsTickerDiv.innerHTML = newsItem[newsCounter];

		// set timeout
		// scope issue and could be written more elegantly as a callback, but fast enough for now
		
var tt = setTimeout("newsTicker(newsItem[newsCounter])", 500);

if ( newsCounter >= 3 ) {
newsCounter=0;

} else {
newsCounter++;

}


 	}

	newsTicker("Testing");

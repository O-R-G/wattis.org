	// globals

        var xPos = 0;		// canvas width varies
        var yPos = 12;		// based on canvas height
	var delayAdjust = 1;	// to adjust global speed
        var message = new Array();
        var delay = new Array();
	var thisCanvas = new Array();
	var thisContext = new Array();
	var thisFrames = new Array();
        var thisCounter = new Array();        

	function initEmoticons(totalCanvas, message, delay) {

		for (var i = 0; i < totalCanvas; i++) {

			thisCanvas[i] = document.getElementById("canvas"+i);
			thisContext[i] = thisCanvas[i].getContext("2d");
			thisContext[i].fillstyle = "black";
			thisContext[i].font = "24px Menlo";
			thisContext[i].textAlign = "left";
			thisContext[i].textBaseline = "middle";
			thisCounter[i] = 0;
		}        
	
		for (var j = 0; j < totalCanvas; j++) {

                	animateCanvas(j, message);
		}
        }

        function animateCanvas(thisCanvasID, thisMessage) {

                thisCounter[thisCanvasID]++;
                thisContext[thisCanvasID].clearRect(0, 0, thisCanvas[thisCanvasID].width, thisCanvas[thisCanvasID].height);

		// frame number returns modulus to loop through message array
		frameNumber = thisCounter[thisCanvasID] % message[thisCanvasID].length;
		thisContext[thisCanvasID].fillText(thisMessage[thisCanvasID][frameNumber], xPos, yPos);

		// scope issue and could be written more elegantly as a callback, but fast enough for now
		var t = setTimeout("animateCanvas("+thisCanvasID+", message)", delay[thisCanvasID]*delayAdjust);
 	}

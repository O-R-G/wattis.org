	var numberofCanvas = 4;
	var thisCanvas = new Array();
	var thisContext = new Array();
	var thisFrames = new Array();
        var thisDelay = new Array();
        var thisCounter = new Array();
        var xPos, yPos, spacer;

        function init() {

		for (var i = 0; i < numberofCanvas; i++) {

			thisCanvas[i] = document.getElementById("canvas"+i);
			thisContext[i] = thisCanvas[i].getContext("2d");
			thisContext[i].fillstyle = "black";
			thisContext[i].font = "34px Monaco";
			thisContext[i].textAlign = "center";
			thisContext[i].textBaseline = "middle";
			thisCounter[i] = 0;
		}        
	
		// initialize frames per canvas

		thisFrames[0] = 9;
		thisDelay[0] = 500;

		thisFrames[1] = 2;
		thisDelay[1] = 250;

		thisFrames[2] = 3;
		thisDelay[2] = 500;

		thisFrames[3] = 2;
		thisDelay[3] = 250;

                xPos = 20;
                yPos = 24;
                spacer = 22;
                animateCanvas0(0);
                animateCanvas1(1);
                animateCanvas2(2);
                animateCanvas3(3);
        }

        function animateCanvas0(thisCanvasID) {
		thisCounter[thisCanvasID]++;
                thisContext[thisCanvasID].clearRect(0, 0, thisCanvas[thisCanvasID].width, thisCanvas[thisCanvasID].height);

                if (thisCounter[thisCanvasID] % thisFrames[thisCanvasID] == 0) {
                        thisContext[thisCanvasID].fillText("/", xPos, yPos);
                        thisContext[thisCanvasID].fillText("/", xPos+spacer, yPos);
                        thisContext[thisCanvasID].fillText("*", xPos+2*spacer, yPos);
                }

                if (thisCounter[thisCanvasID] % thisFrames[thisCanvasID] == 1) {
                        thisContext[thisCanvasID].fillText("/", xPos, yPos);
                        thisContext[thisCanvasID].fillText("/", xPos+spacer, yPos);
                        thisContext[thisCanvasID].fillText("*", xPos+2*spacer, yPos);
                }

                if (thisCounter[thisCanvasID] % thisFrames[thisCanvasID] == 2) {
                        thisContext[thisCanvasID].fillText("\\", xPos, yPos);
                        thisContext[thisCanvasID].fillText("/", xPos+spacer, yPos);
                        thisContext[thisCanvasID].fillText("*", xPos+2*spacer, yPos);
                }

                if (thisCounter[thisCanvasID] % thisFrames[thisCanvasID] == 3) {
                        thisContext[thisCanvasID].fillText("\\", xPos, yPos);
                        thisContext[thisCanvasID].fillText("\\", xPos+spacer, yPos);
                        thisContext[thisCanvasID].fillText("*", xPos+2*spacer, yPos);
                }

                if (thisCounter[thisCanvasID] % thisFrames[thisCanvasID] == 4) {
                        thisContext[thisCanvasID].fillText("\\", xPos, yPos);
                        thisContext[thisCanvasID].fillText("\\", xPos+spacer, yPos);
                }

                if (thisCounter[thisCanvasID] % thisFrames[thisCanvasID] == 5) {
                        thisContext[thisCanvasID].fillText("\\", xPos, yPos);
                        thisContext[thisCanvasID].fillText("\\", xPos+spacer, yPos);
                        thisContext[thisCanvasID].fillText("*", xPos+2*spacer, yPos);
                }

                if (thisCounter[thisCanvasID] % thisFrames[thisCanvasID] == 6) {
                        thisContext[thisCanvasID].fillText("\\", xPos, yPos);
                        thisContext[thisCanvasID].fillText("\\", xPos+spacer, yPos);
                }

                if (thisCounter[thisCanvasID] % thisFrames[thisCanvasID] == 7) {
                        thisContext[thisCanvasID].fillText("\\", xPos, yPos);
                        thisContext[thisCanvasID].fillText("\\", xPos+spacer, yPos);
                        thisContext[thisCanvasID].fillText("*", xPos+2*spacer, yPos);
                }

                if (thisCounter[thisCanvasID] % thisFrames[thisCanvasID] == 8) {
                        thisContext[thisCanvasID].fillText("\\", xPos, yPos);
                        thisContext[thisCanvasID].fillText("\\", xPos+spacer, yPos);
                        thisContext[thisCanvasID].fillText("*", xPos+2*spacer, yPos);
                }

                var t = setTimeout('animateCanvas0(0)', thisDelay[thisCanvasID]);
        }

        function animateCanvas1(thisCanvasID) {
                thisCounter[thisCanvasID]++;
                thisContext[thisCanvasID].clearRect(0, 0, thisCanvas[thisCanvasID].width, thisCanvas[thisCanvasID].height);

                if (thisCounter[thisCanvasID] % thisFrames[thisCanvasID] == 0) {
                        thisContext[thisCanvasID].fillText("‿", xPos, yPos);
                        thisContext[thisCanvasID].fillText("⁀", xPos+spacer, yPos);
                        thisContext[thisCanvasID].fillText("‿", xPos+2*spacer, yPos);
                        thisContext[thisCanvasID].fillText("⁀", xPos+3*spacer, yPos);
                        thisContext[thisCanvasID].fillText("‿", xPos+4*spacer, yPos);
                        thisContext[thisCanvasID].fillText("⁀", xPos+5*spacer, yPos);
                        thisContext[thisCanvasID].fillText("‿", xPos+6*spacer, yPos);
                        thisContext[thisCanvasID].fillText("⁀", xPos+7*spacer, yPos);
                        thisContext[thisCanvasID].fillText("‿", xPos+8*spacer, yPos);
                }

                if (thisCounter[thisCanvasID] % thisFrames[thisCanvasID] == 1) {
                        thisContext[thisCanvasID].fillText("⁀", xPos, yPos);
                        thisContext[thisCanvasID].fillText("‿", xPos+spacer, yPos);
                        thisContext[thisCanvasID].fillText("⁀", xPos+2*spacer, yPos);
                        thisContext[thisCanvasID].fillText("‿", xPos+3*spacer, yPos);
                        thisContext[thisCanvasID].fillText("⁀", xPos+4*spacer, yPos);
                        thisContext[thisCanvasID].fillText("‿", xPos+5*spacer, yPos);
                        thisContext[thisCanvasID].fillText("⁀", xPos+6*spacer, yPos);
                        thisContext[thisCanvasID].fillText("‿", xPos+7*spacer, yPos);
                        thisContext[thisCanvasID].fillText("⁀", xPos+8*spacer, yPos);
                }

                var t = setTimeout('animateCanvas1(1)', thisDelay[thisCanvasID]);
        }

        function animateCanvas2(thisCanvasID) {
                thisCounter[thisCanvasID]++;
                thisContext[thisCanvasID].clearRect(0, 0, thisCanvas[thisCanvasID].width, thisCanvas[thisCanvasID].height);

		yOffset = 6;

                if (thisCounter[thisCanvasID] % thisFrames[thisCanvasID] == 0) {
                }

                if (thisCounter[thisCanvasID] % thisFrames[thisCanvasID] == 1) {
                        thisContext[thisCanvasID].fillText("(", xPos+spacer, yPos-yOffset);
                        thisContext[thisCanvasID].fillText(")", xPos+2*spacer, yPos-yOffset);
                }

                if (thisCounter[thisCanvasID] % thisFrames[thisCanvasID] == 2) {
                        thisContext[thisCanvasID].fillText("(", xPos, yPos-yOffset);
                        thisContext[thisCanvasID].fillText("(", xPos+spacer, yPos-yOffset);
                        thisContext[thisCanvasID].fillText(")", xPos+2*spacer, yPos-yOffset);
                        thisContext[thisCanvasID].fillText(")", xPos+3*spacer, yPos-yOffset);
                }

                var t = setTimeout('animateCanvas2(2)', thisDelay[thisCanvasID]);
        }

        function animateCanvas3(thisCanvasID) {
                thisCounter[thisCanvasID]++;
                thisContext[thisCanvasID].clearRect(0, 0, thisCanvas[thisCanvasID].width, thisCanvas[thisCanvasID].height);

		yOffset = 0;

                if (thisCounter[thisCanvasID] % thisFrames[thisCanvasID] == 0) {
                        thisContext[thisCanvasID].fillText("*", xPos, yPos-yOffset);
                        thisContext[thisCanvasID].fillText("!", xPos+spacer, yPos-yOffset);
                        thisContext[thisCanvasID].fillText("*", xPos+2*spacer, yPos-yOffset);
                }

                if (thisCounter[thisCanvasID] % thisFrames[thisCanvasID] == 1) {
                        thisContext[thisCanvasID].fillText("*", xPos, yPos-yOffset);
                        thisContext[thisCanvasID].fillText("*", xPos+2*spacer, yPos-yOffset);
                }

                var t = setTimeout('animateCanvas3(3)', thisDelay[thisCanvasID]);
        }


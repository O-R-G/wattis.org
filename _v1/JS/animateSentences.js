	var totalSentences = 14;
	var thisSentence = new Array();
	var thisAction = new Array();
	var thisElementDelay = new Array();
	var elementDelayAdjust = 50;	// adjust global speed

        function initSentences() {

		// hide all sentences 

		for (var i = 0; i < totalSentences; i++) {
			
			thisSentence[i] = document.getElementById("sentence"+i);
			thisSentence[i].style.visibility = "hidden";
		}        
		
		// hide all canvas


		// set delay[] values (relative)

		thisElementDelay[0] = 60;
		thisElementDelay[1] = 30;
		thisElementDelay[2] = 50;
		thisElementDelay[3] = 30;
		thisElementDelay[4] = 100;
		thisElementDelay[5] = 70;
		thisElementDelay[6] = 50;
		thisElementDelay[7] = 50;
		thisElementDelay[8] = 50;
		thisElementDelay[9] = 50;
		thisElementDelay[10] = 50;
		thisElementDelay[11] = 50;
		thisElementDelay[12] = 10;
		thisElementDelay[13] = 50;


		// show \\* and start sequence

              	// animateElement(0, thisSentence[0], thisElementDelay[0]);
              	showElement(0);

        }

        function showElement(thisIndex) {

		// could easily build from loigic of animateEmoticon to time diff elements at different rates on their own "timers"
		// but for now the simplest way

		thisSentence[thisIndex].style.visibility = "visible";

		if (thisIndex < totalSentences-1) {
		
			thisIndex++;
		} else {

			thisIndex=0;
		}

		// scope issue and could be written more elegantly as a callback, but fast enough for now (see animateEmoticon for same issue)

		var t = setTimeout("showElement("+thisIndex+")", thisElementDelay[thisIndex-1]*elementDelayAdjust);
 	}

	var totalCanvas = 11;
	var thisCanvas = new Array();
	var thisContext = new Array();
	var thisFrames = new Array();
        var thisDelay = new Array();
        var thisCounter = new Array();
        var messages = new Array();
        var xPos = 0;	// canvas width varies
        var yPos = 18;	// 36 px canvas height
	var delayAdjust = .8;	// to adjust global speed

        function init() {

		for (var i = 0; i < totalCanvas; i++) {

			thisCanvas[i] = document.getElementById("canvas"+i);
			thisContext[i] = thisCanvas[i].getContext("2d");
			thisContext[i].fillstyle = "black";
			thisContext[i].font = "34px Monaco";
			thisContext[i].textAlign = "left";
			thisContext[i].textBaseline = "middle";
			thisCounter[i] = 0;
		}        
	
		// init array of arrays per canvas animation 

		messages[0] = 	[
				"// ",
				"\\/ ",
				"\\\\ ",
				"\\\\*",
				"\\\\ ",
				"\\\\*"
				];

		thisDelay[0] = 500;

		messages[1] = 	[
				"‿⁀‿⁀‿⁀‿⁀‿⁀‿⁀‿⁀‿⁀‿⁀‿⁀‿⁀‿⁀",
				"⁀‿⁀‿⁀‿⁀‿⁀‿⁀‿⁀‿⁀‿⁀‿⁀‿⁀‿⁀‿",
				];

		thisDelay[1] = 250;

		messages[2] = 	[
				"      ",
				"  ()  ",
				" (()) ",
				"((()))",
				" (()) ",
				"  ()  ",
				"      ",
				"  ()  "
				];

		thisDelay[2] = 500;

		messages[3] = 	[
				" * ",
				"!*!",
				"! !"
				];

		thisDelay[3] = 250;

		messages[4] = 	[
				"[   ]",
				"[*  ]",
				"[ ! ]",
				"[  #]",
				"[ ! ]",
				"[*  ]",
				"[   ]",
				"[   ]",
				"     ",
				"     ",
				"[   ]",
				"[   ]",
				"     ",
				"     "
				];

		thisDelay[4] = 100;

		messages[5] = 	[
				".    ",
 				". .  ",
				". . .",
				"    .",
				"  . .",
				"  .  ",
				".    "
				];

		thisDelay[5] = 250;

		messages[6] = 	[
				":>",
 				":|"
				];

		thisDelay[6] = 500;

		messages[7] = 	[
				"<<⅂",
				"<<⅂",
				"<<⅂",
				"<<⅂",
				"<<⅂",
				"<<⅂",
				"<<⅂",
				"<<⅂",
				"<<⅂",
				"<<⅂",
				"<<⅂",
				"<<⅂",
				"<<⅂",
				"<  ",
				">  ",
				"<  ",
				">  ",
				"<  ",
				">  ",
				"<  ",
				">  ",
				"<  ",
				">  ",
				"<  ",
				">  ",
				"<  ",
				">  ",
				"<  ",
				">  ",
				"<  ",
				">  ",
				"<  ",
				"<< ",
				];

		thisDelay[7] = 100;

		messages[8] = 	[
				"Wattis",
				"aWttis",
				"ittasW",
				"statiW",
				"tWiats"
				];

		thisDelay[8] = 250;

		messages[9] = 	[
				"+++++++",
				"xxxxxxx",
				"-------",
				"///////",
				"\\\\\\\\\\\\\\",
				"///////",
				"\\\\\\\\\\\\\\",
				"///////",
				"\\\\\\\\\\\\\\",
				"///////",
				"\\\\\\\\\\\\\\",
				"+++++++",
				"x+x+x+x",
				"#-oeuw0",
				"w98djkj",
				"))dskh9",
				"+786&6*",
				"^^^^^^^",
				"odjdvy%",
				"$$$$$$$"
				];

		thisDelay[9] = 50;

		messages[10] = 	[
				"°_°",
				"°.°",
				"°_°"
				];

		thisDelay[10] = 1000;

		for (var j = 0; j < totalCanvas; j++) {

                	animateCanvas(j, messages);
		}
        }

        function animateCanvas(thisCanvasID, thisMessage) {

                thisCounter[thisCanvasID]++;
                thisContext[thisCanvasID].clearRect(0, 0, thisCanvas[thisCanvasID].width, thisCanvas[thisCanvasID].height);

		// frame number returns modulus to loop through messages array
		frameNumber = thisCounter[thisCanvasID] % messages[thisCanvasID].length;
		thisContext[thisCanvasID].fillText(thisMessage[thisCanvasID][frameNumber], xPos, yPos);

		// scope issue and could be written more elegantly as a callback, but fast enough for now
		var t = setTimeout("animateCanvas("+thisCanvasID+", messages)", thisDelay[thisCanvasID]*delayAdjust);
 	}

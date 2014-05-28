<html>

<?php 
        require_once("_Library/systemCookie.php");
        $type = $_REQUEST['type'];
        $type = systemCookie("typeCookie", $type, 0);
	// if (!$type) $type="times"
?>

<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<!-- <META http-equiv="refresh" content="5;URL=index-7.html"> -->
<title>CCA Wattis Institute for Contemporary Arts</title>
<link rel="stylesheet" type="text/css" media="all" href="GLOBAL/global.css" />
<style>

body {
	color: #FFF;
        }

a {
	color: #000;
        }

canvas {
	/* background: #FFF; */
        }
     
</style>

<script type="text/javascript" src="JS/animateEmoticon-v2.js"></script>
<script type="text/javascript" src="JS/animateSentences.js"></script>

</head>

<!-- <body onload="initEmoticons(16); initSentences();"> -->
<body onload="initEmoticons(16);">

<!-- <div class="mainContainer baskerville big black hide"> -->
<div class="mainContainer <?php echo $type; ?> big black">

<!-- WATTIS -->

<div class="wattisContainer"><canvas id="canvas0" width="60" height="24" 
class="show">\\\\*</canvas><span id="sentence0"> ... This is <a 
href="detail-12-0.html">The Wattis</a><canvas id="canvas13" width="10" 
height="24">.</canvas></span><br /><span id="sentence1">We<canvas 
id="canvas12" width="12" height="24">&#8217</canvas>re in San 
Francisco,</span> <span id="sentence2">a few blocks away from <a 
href="http://www.cca.edu" target="new">California College of Arts</a> 
<canvas id="canvas7" width="50" height="24"><<⅂</canvas></span></div>


<!-- PROGRAM -->

<div class="programContainer">Here’s our program: <span 
id="sentence5"><a href="detail-21.html">Markus Schinwald</a> is in the 
gallery,<canvas id="canvas4" width="90" 
height="24">[*!#]</canvas></span> <span id="sentence7"><i><a 
href="detail-17.html">Nairy Baghramian</a> is in the apartment, <canvas 
id="canvas5" width="80" height="24">. . .</canvas></i></span> <canvas 
id="canvas6" width="32" height="24">;></canvas><span id="sentence8"> 
and, <a href="detail-17.html">Joan Jonas</a> is on our mind.<canvas 
id="canvas3" width="50" height="24">*!*</canvas></span></div>

<!-- NEWS -->

<div class="newsContainer"><span id="sentence6" class="red">The 
exhibition opens tomorrow<canvas id="canvas14" width="20" 
height="24">!</canvas></span><canvas id="canvas11" width="12" 
height="24">!</canvas></div>

<!-- NEXT DOOR -->

<div class="nextdoorContainer"><span id="sentence9"><a 
href="detail-17.html" class="animoticon"><canvas id="canvas8" 
width="144" height="24">Next Door</canvas></a>, on Tuesday, October 12, 
philosopher Michel Serres will speak.</span></div>

<!-- BY APPOINTMENT -->

<div class="byappointmentContainer"><span id="sentence9"><canvas id="canvas9" 
width="120" height="24">. . .</canvas><a href="detail-17.html">By 
appointment</a>, there is also a painting by Avery Singer, a film from 
Loretta Fahrenholz, a text by Lars Bang Larsen, and John Zorn's newest 
record.</span></div>

<!-- MEANWHILE -->

<div class="meanwhileContainer"><span id="sentence11"><i><a 
href="detail-17.html">Meanwhile</a>, an exhibition by Marie Angeletti 
opened four days ago at Castillo Corrales</a>.</i></span></div>

<!-- WEATHER -->

<div class="weatherContainer"><span id="sentence14">We’re <a 
href="">at</a> 360 Kansas Street (between 16th & 17th).</span><span 
id="sentence3"><i> Today, it is kind of foggy and currently 78&#176; F. 
</i><canvas id="canvas1" width="380" 
height="24">/////////////////////////</canvas></span><span 
id="sentence4">We are open until 7pm. <canvas id="canvas2" width="100" 
height="24">(())</canvas></span></div>

<!-- SOCIAL -->

<div class="socialContainer"><span id="sentence12"><a 
href="detail-17.html">f/I/t</a> here.<canvas id="canvas10" width="50" 
height="24">. . .</canvas> </span></div>

<!-- nothing yet -->

<div class="scheduleContainer"><span id="sentence10">In the next three 
months, there are <a href="detail-17.html">six events</a> 
planned.<canvas id="canvas15" width="20" 
height="24">6</canvas></span></div>

<!-- DATE? -->

<div class="dateContainer"><span id="sentence13" class="helvetica 
small">20142615</span></div>

</div>
</body>
</html>

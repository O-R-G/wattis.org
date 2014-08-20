<?php
require_once("GLOBAL/head.php");
?>

<style>

body {
	color: #FFF;
        }

a {
	color: #000;
        }

canvas {
	position: relative;
	background-color: transparent;
	top:4px;
        }
     
</style>

<script type="text/javascript"> 
	window.onclick = function showBones() { 
		window.location.assign("index-.php");
	} 
</script>


<div class="times big black">

<!-- WATTIS -->

<div class="wattisContainer"><canvas id="canvas0" width="60" height="22" 
class="show">\\\\*</canvas><span id="sentence0">. . . This is <a 
href="main.php">The Wattis</a><canvas id="canvas13" width="10" 
height="22">.</canvas></span><br /><span id="sentence1"><span 
class="white"> We<canvas id="canvas12" width="12" 
height="22">&#8217</canvas>re in San Francisco</span>,</span> <span 
id="sentence2"><span class="white"> a few blocks away from <a 
href="http://www.cca.edu" target="new"><span class="white"> California 
College of the Arts</span></a> <canvas id="canvas7" width="50" 
height="22"><<⅂</canvas></span></span></div>

<!-- PROGRAM -->

<div class="programContainer"><span id="sentence5"><a 
href=""><span class="white">
Markus Schinwald</span></a> <span class="white">
<i>is in the 
gallery</i></span>,<canvas id="canvas4" width="90" 
height="22">[*!#]</canvas></span> <span id="sentence7"><a 
href=""><span class="white">
Nairy Baghramian</span></a> <span class="white">
<i>is in the apartment</i></span>, 
<canvas id="canvas5" width="80" height="22">. . .</canvas></span> 
<canvas id="canvas6" width="32" height="22">;></canvas><span 
id="sentence8"><span class="white">
 and</span>, <a href=""><span class="white">
Joan Jonas</span></a><span class="white"> <i>is on 
our mind</i></span>.<canvas id="canvas3" width="50" 
height="22">*!*</canvas></span></div>

<!-- NEWS 

<div class="newsContainer"><span id="sentence6" class="red">The
exhibition opens tomorrow<canvas id="canvas14" width="20"
height="24">!</canvas></span><canvas id="canvas11" width="12"
height="24">!</canvas></div> -->

<!-- NEWS

<div class="newsContainer"><span id="sentence6" class="red">*New*
limited edition by Ed Ruscha—get it now <canvas id="canvas14" width="20"
height="24">!</canvas></span><canvas id="canvas11" width="12"
height="24">!</canvas></div> -->

<!-- NEWS -->

<div class="newsContainer"><span id="sentence6" class="red">#_# <span 
class="white">Friday</span>, <span class="white">
we are showing Joan Jonas films</span>. <span class="white">
Come</span>.<canvas 
id="canvas14" width="20" height="24">!</canvas></span><canvas 
id="canvas11" width="12" height="24">!</canvas></div>

<!-- NEWS 

<div class="newsContainer"><span id="sentence6" class="red">I suppose, > 
> that sometime next week we wi*& %%%%%%, !~!<canvas id="canvas14" 
width="20" height="22">!</canvas></span><canvas id="canvas11" width="12" 
height="22">!</canvas></div> -->

<!-- NEXT DOOR -->

<div class="nextdoorContainer"><span id="sentence9"><a 
href="" class="animoticon"><canvas id="canvas8" 
width="130" height="22" style="top:-0px;">Next Door</canvas></a>, <span 
class="white"> on Tuesday</span>, <span class="white"> October 
12</span>, <span class="white"> philosopher</span> \ : | <span 
class="white"> Michel Serres will </span>(( . . . )).</span></div>

<!-- BY APPOINTMENT -->

<div class="byappointmentContainer"><span id="sentence9"><canvas 
id="canvas9" width="120" height="22">. . .</canvas><a 
href=""><span class="white">
By appointment</span></a>, <span class="white">
there is also a painting by 
Avery Singer</span>, <span class="white">
a film from Loretta Fahrenholz</span>, <span class="white">
a text by Lars Bang 
Larsen<span>, <span class="white">
and John Zorn</span>'<span class="white">
s newest record</span>.</span></div>

<!-- WEATHER -->

<div class="weatherContainer"><span id="sentence14"><span class="white"> 
We</span>’<span class="white"> re</span> <a href=""><span class="white"> 
at</span></a> <span class="white"> 360 Kansas Street</span> (<span 
class="white"> between 16th</span> & <span class="white"> 
17th</span>).</span><span class="white"> <i> Today, it is kind of foggy 
and currently 78&#176; F. </i><canvas id="canvas1" width="380" 
height="22">/////////////////////////</canvas></span><span class="white">
We are open until 7pm</span>. <canvas id="canvas2" width="100" 
height="22">(())</canvas></span></div>

<!-- SCHEDULE -->

<div class="scheduleContainer"><span id="sentence10"><span class="white">
In the next three 
months</span>, <span class="white">
there are</span> <a href=""><span class="white">
six events</span></a> 
<span class="white">
planned</span>. <canvas id="canvas15" width="20" 
height="22">6</canvas></span></div>

<!-- MEANWHILE -->

<div class="meanwhileContainer"><span id="sentence11"><i><a 
href=""><span class="white">
Meanwhile</span></a>, <span class="white">
an exhibition by Marie Angeletti 
opened four days ago at Castillo Corrales</span>.</i></span></div>

<!-- ARCHIVE -->

<div class="archiveContainer"><span id="sentence11"><span class="white"> 
<i>Or, have a look </i></span> <span class="monaco">o-o</span> <span 
class="white"> <i>at what we</span>’<span class="white"> ve done before 
in our</span> <a href=""><span class="white">
archive</span></a>.</i></span></div>

<!-- SOCIAL -->

<div class="socialContainer"><span id="sentence12"><img 
src="IMAGES/fti.gif"> <span class="white">
here</span>.<canvas id="canvas10" width="50" 
height="22">. . .</canvas> </span></div>

<!-- NEWSLETTER -->

<div class="newsletterContainer"><span id="sentence11"><span class="white">
<i>Our 
newsletter</i></span> . . . <br /><form enctype='multipart/form-data' action='' 
method='post' style='margin: 0; padding: 0;'><textarea name='sender' 
cols='30' rows='1'class='Mono'></textarea><input name='subscribe' 
type='submit' value='Subscribe' /></form></span></div>

<!-- DATE? -->

<div class="dateContainer"><span id="sentence13" class="helvetica small">CCA WATTIS 
INSTITUTE FOR CONTEMPORARY ARTS<br />360 KANSAS STREET / SAN FRANCISCO CA 94103<br /> 
20142615</span></div>

</div>

<script type="text/javascript">
window.onload=initEmoticons(16, message, delay);
</script>

</body>
</html>

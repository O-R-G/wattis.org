<?php
require_once("GLOBAL/head.php");
?>

<style>

body {
/*background-color:#333;*/
background-image: url("MEDIA/frieze.jpg");
}

.wattisContainer {
	position: absolute;
        z-index:99;
        top: 300px;
        left: 900px;
        padding:16px;
        width: 126px;
	height: 114px;
   border-style: solid;
    border-width: 1px;
    border-color: #000;
	background-color:#FFF;
        }

</style>


<?php
	$textcolor = $_REQUEST['textcolor'];          // no register globals
	if (!$textcolor) $textcolor="black";
?>

</style>

<!-- *todo* add homecontainer wrapper -->


<!-- WATTIS -->

<div class="wattisContainer times big black fixed"> <a href="punctuation.php?textcolor=<?php 
echo ($textcolor=='white') ? 'black' : 'white' ; ?>"><canvas id="canvas0" width="46" 
height="22" class="show">\\\\*</canvas></a> <canvas id="canvas1" width="90" height="22" 
class="show"> . . . </canvas> This is <canvas id="canvas2" width="26" height="22" 
class="show">()</canvas> <a href="main.php">The Wattis</a> <canvas id="canvas3" width="10" 
height="22" class="show">.</canvas></div>


<script type="text/javascript">
		
                message[1] =    [
                                ". . .",
                                "  . .",
                                "    .",
                                "     ",
                                "    .",
                                "  . .",
                                ];

                delay[1] = 200;

                message[2] =    [
                                "()",
                                " )",
                                "( "
                                ];

                delay[2] = 500;
		
                message[3] =    [
                                ".",
                                " ",
                                ];

                delay[3] = 400;
		
window.onload=initEmoticons(4, message, delay);
</script>


</div>
</body>
</html>
 

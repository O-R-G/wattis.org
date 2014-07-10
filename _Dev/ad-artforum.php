<?php
require_once("GLOBAL/head.php");
?>

<style>

body {
/*background-color:#333;*/
background-image: url("MEDIA/artforum.jpg");
}

.wattisContainer {
	position: absolute;
        z-index:99;
        top: 18px;
        left: 120px;
        padding-top:20px;
        padding-left:30px;
        width: 184px;
	/*height: 60px;*/
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

<div class="wattisContainer times big black fixed">
<canvas id="canvas0" width="146" height="22" class="show">\\\\*</canvas>
</div>


<script type="text/javascript">
		

                message[0] =    [
                                "...// +.=",
                                ".+.\\/ ",
                                "-..\\\\ ",
                                "...\\\\*",
                                ".\\.\\)-+\\ ",
                                "..-\\(*+\\*",
                                ",..\\(*+.+",
                                ".,.\\()",
                                "-(*+.?(*)",
                                ".#.(\/*",
                                "..;(,\=",
                                ":-.+-;.,)",
                                ".-(.)\"()*",
                                "(..\\.*",
                                "(.)\\. ",
                                ".+)//, ",
                                ".*.//* (.)",
                                ];

                delay[0] = 3000;

window.onload=initEmoticons(1, message, delay);
</script>


</div>
</body>
</html>
 

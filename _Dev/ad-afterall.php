<?php
require_once("GLOBAL/head.php");
?>

<style>

body {
/*background-color:#333;*/
background-image: url("MEDIA/afterall.jpg");
}

.wattisContainer {
	position: absolute;
        z-index:99;
        top: 276px;
        left: 980px;
        padding-top:30px;
        padding-left:60px;
        width: 84px;
	height: 36px;
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
<canvas id="canvas0" width="46" height="22" class="show">\\\\*</canvas>
</div>


<script type="text/javascript">
		

                message[0] =    [
                                "// ",
                                "\\/ ",
                                "\\\\ ",
                                "\\\\*",
                                "\\\\ ",
                                "\\\\*",
                                "\\(*",
                                "\\()",
                                "(*)",
                                "(\/*",
                                "(,\/",
                                ".,)",
                                "()*",
                                "\\.*",
                                "\\. ",
                                "//, ",
                                "//* ",
                                ];

                delay[0] = 200;

window.onload=initEmoticons(1, message, delay);
</script>


</div>
</body>
</html>
 

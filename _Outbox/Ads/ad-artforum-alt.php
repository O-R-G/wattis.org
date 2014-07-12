<!DOCTYPE html PUBLIC "-//W3C//Dtd XHTML 1.0 Transitional//EN" "http://www.w3.org/tr/xhtml1/Dtd/xhtml1-tran$
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">

<head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

        <base href="/">

        <title><?php echo $documentTitle; ?></title>
        <meta http-equiv="Content-Type" content="text/xhtml; charset=utf-8" />
        <meta http-equiv="Title" content="<?php echo $documentTitle; ?>" />

        <!-- ** fix viewport and possibly responsiveness ** -->

        <!-- <meta name="viewport" content="width=device-width"> -->
        <!-- <meta name="viewport" content="width=700"> -->
        <!-- <meta name="viewport" content="initial-scale=1.0">-->

        <link rel="stylesheet" type="text/css" media="all" href="GLOBAL/global.css" />
        <script type="text/javascript" src="GLOBAL/global.js"></script>
        <script type="text/javascript" src="JS/animateEmoticon.js"></script>
        <script type="text/javascript" src="JS/animateEmoticon-src.js"></script>
</head>

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
        width: 186px;
	/*height: 60px;*/
	border-style: solid;
	border-width: 0px;
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
 

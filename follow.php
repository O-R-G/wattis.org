<?php
require_once("GLOBAL/head.php");
?>

<div class="mainContainer times big black">

<span class="listContainer times show comment">
<canvas id="canvas1" width="46" height="22" class="show">>>></canvas>
Follow the Wattis . . .<br/><br/></span>

<span class="listContainer times show comment">
<a href="">on Facebook . . .</a><br /><br />
<a href="">on Instagram . . .</a><br /><br />
<a href="">on Twitter . . .</a><br /><br />
</span>

<span class="listContainer times show comment">
&nbsp;
</span>

</div>

<script type="text/javascript">
               
                message[1] =    [
                                ">>>",
                                ".>>",
                                "..>",
                                "..."
                                ];

                delay[1] = 250;

window.onload=initEmoticons(2, message, delay);
</script>

<?php
require_once("GLOBAL/foot.php");
?>

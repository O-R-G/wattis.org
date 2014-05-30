<?php
require_once("GLOBAL/head.php");
?>

<div class="newsContainer">
Testing ... 
<canvas id="canvas1" width="80" height="24">!</canvas>
<canvas id="canvas2" width="80" height="24">!</canvas>
<canvas id="canvas3" width="100" height="24">!</canvas>
</div>

<script type="text/javascript">

	// these rewrite the global settings as reqd per page

	message[1] = 	[
			"YOUR",
			"MAMA",
			"SAYS",
			"THAT",
			"....",
			"////",
			"****",
			];

	delay[1] = 100;

	window.onload=initEmoticons(4, message, delay);

</script>

<?php
require_once("GLOBAL/foot.php");
?>

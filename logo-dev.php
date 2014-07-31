<?php
require_once("GLOBAL/head.php");
?>

<?php
	$textcolor = $_REQUEST['textcolor'];          // no register globals
	if (!$textcolor) $textcolor="black";

	$summary = $_REQUEST['summary'];          // no register globals
	if (!$summary) $summary=null;
?>


<div class="times big <?php echo $textcolor; ?>">

</div>



<!--
<div id="Punct-0" class="floatPad helvetica big">
.+*
</div>
-->

<div id="Punct-1" class="floatPad times big black">
“;^ Curators Forum
</div>

<div class='clear'></div>

<div id="Punct-2" class="floatPad times big black">
!.! News
</div>


<script type="text/javascript" src="JS/animatePunctuation.js"></script>

<script>
	initPunctuation("Punct");
</script>

</div>
</body>
</html>
 

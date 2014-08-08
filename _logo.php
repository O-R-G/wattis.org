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

<?php
if ($alt == 'all') {
?>

<div id="Punct-0" class="floatPad helvetica big">
.+*
</div>

<div id="Punct-1" class="floatPad helvetica big">
-+=
</div>

<div id="Punct-2" class="floatPad helvetica big">
‹›÷
</div>

<div id="Punct-3" class="floatPad helvetica big">
\\*
</div>

<div id="Punct-4" class="floatPad helvetica big">
!*=
</div>

<div id="Punct-5" class="floatPad helvetica big">
+=*
</div>

<div id="Punct-6" class="floatPad helvetica big">
×⁏⁑
</div>

<div id="Punct-7" class="floatPad helvetica big">
∗∘∙
</div>

<div id="Punct-8" class="floatPad helvetica big">
,(;
</div>

<div id="Punct-9" class="floatPad helvetica big">
\/.
</div>

<div id="Punct-10" class="floatPad helvetica big">
∙∴~
</div>

<div id="Punct-11" class="floatPad helvetica big">
,..
</div>

<div id="Punct-12" class="floatPad helvetica big">
!"#
</div>

<div id="Punct-13" class="floatPad helvetica big">
^~:
</div>

<div id="Punct-14" class="floatPad helvetica big">
‿\-
</div>

<div id="Punct-15" class="floatPad helvetica big">
,┌.
</div>

<div id="Punct-16" class="floatPad helvetica big">
^$.
</div>

<div id="Punct-17" class="floatPad helvetica big">
-/=
</div>

<div id="Punct-18" class="floatPad helvetica big">
*•.
</div>

<div id="Punct-19" class="floatPad helvetica big">
/?|
</div>

<div id="Punct-20" class="floatPad helvetica big">
!+,
</div>

<div id="Punct-21" class="floatPad helvetica big">
.“*
</div>

<div id="Punct-22" class="floatPad helvetica big">
,:.
</div>

<div id="Punct-23" class="floatPad helvetica big">
[\-
</div>

<div id="Punct-24" class="floatPad helvetica big">
°•´
</div>

<div id="Punct-25" class="floatPad helvetica big">
,|-
</div>

<div id="Punct-26" class="floatPad helvetica big">
.?/
</div>

<div id="Punct-27" class="floatPad helvetica big">
`\.
</div>

<?php
} else {
?>


<!-- .+* THE WATTIS INSTITUTE -->

<div class="centeredContainer times big black">

<canvas id="canvas0" width="46" height="24" class="show" 
onclick="showBones();">.+*</canvas></a>

<a href="index_.php">The Wattis Institute</a>

</div>


<?php
}
?>


	



<script type="text/javascript" src="JS/animatePunctuation.js"></script>

<script>
	initPunctuation("Punct");
	window.onload=initEmoticons(1, message, delay);
</script>

</div>
</body>
</html>
 

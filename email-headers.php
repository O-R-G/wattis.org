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

<!-- // -->

<?php 
if ($alt == 0) {
?>
<div id="Punct-100" class="floatPad helvetica big">
.+*
</div>
<?php 
}
?>

<?php 
if ($alt == 1) {
?>
<div id="Punct-0" class="floatPad times big black">
!.! News
</div>
<?php 
}
?>

<?php 
if ($alt == 2) {
?>
<div id="Punct-1" class="floatPad times big black">
:/} Event
</div>
<?php 
}
?>

<?php 
if ($alt == 3) {
?>
<div id="Punct-2" class="floatPad times big black">
+=[ Exhibition Opening
</div>
<?php
}
?>

<?php 
if ($alt == 4) {
?>
<div id="Punct-3" class="floatPad times big black">
.,‘ Limited Editions
</div>
<?php
}
?>

<?php 
if ($alt == 5) {
?>
<div id="Punct-4" class="floatPad times big black">
“;^ Curators Forum
</div>
<?php
}
?>

<?php 
if ($alt == 6) {
?>
<div id="Punct-5" class="floatPad times big black">
:”/ VIP Members Event
</div>
<?php
}
?>

<?php 
if ($alt == 7) {
?>
<div id="Punct-6" class="floatPad times big black">
_•° Notes From the Field
</div>
<?php
}
?>

<?php 
if ($alt == 8) {
?>
<div id="Punct-8" class="floatPadwide times big black">
_/“The Wattis Institute
</div>
<?php
}
?>




<script type="text/javascript" src="JS/animatePunctuation.js"></script>

<script>
	initPunctuation('Punct', 200, true);
</script>

</div>
</body>
</html>
 

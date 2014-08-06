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
<div id="Punct-0" class="floatPad helvetica big">
.+*
</div>
<?php 
}
?>

<?php if ($alt == 1) 
{ 
?> 
<div id="Punct-0" class="floatPad helvetica big">
.+*
</div>
<div id="Punct-1" class="floatPadwide times big black"> 
oo<a href="this.html">ok.abcdefg</a>.,;;/ab;cd.ef, gh; ijklmnopqrstuvwwxyz[..,anb]
<div id='1'>ok--0<span id='1-1'>ok-1</span></div>
</div> 
<?php
}
?>

<?php if ($alt == 2) 
{ 
?> 
<div id="Punct-1" class="floatPadwide times big black"> 
.oi<span>0.</span>o..w
<a href="this.html">abc.def</a>
<a>ghi!!jkl</a>
<span class='red'>!ok</span>ok
<strong><a>.</a>.!</strong>
<a>.x</a><a>..!</a> ///
</div>
<?php
}
?>

<?php if ($alt == 3) 
{ 
?> 
<div id="Punct-1" class="floatPadwide times big black"> 
<a>o</a>a<span>0.ausa <span class='red'>!ok</span>ok
asiuhas = as-=-= +</span>
</div>
<?php
}
?>

<?php 
if ($alt == 4) {
?>
<div id="Punct-4" class="floatPad times big black">
Hello, World! abcdefg <.:,;>
</div>
<?php 
}
?>



<script type="text/javascript" src="JS/animatePunctuation.js"></script>

<script>
	initPunctuation('Punct', 200, false);
</script>

</div>
</body>
</html>
 

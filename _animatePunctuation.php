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
<div class="floatPad times big black animatePunctuation">
.+*
</div>
<?php 
}
?>

<?php if ($alt == 1) 
{ 
?> 
<div class="floatPad times big black animatePunctuation">
.+*)]~
</div>

<div class="floatPad times big black animatePunctuation">
ok;.</div> 
<?php
}
?>

<?php if ($alt == 2) 
{ 
?> 
<div class="floatPad times big black animatePunctuation">
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
<div class="floatPad times big black animatePunctuation">
<a>o</a>a<span>0.ausa <span class='red'>!ok</span>ok
asiuhas = as-=-= +</span>
</div>
<?php
}
?>

<?php 
if ($alt == 4) {
?>
<div class="floatPad times big black animatePunctuation">
Hello, World! <a href='test'>[!]this . . .</a>[ok] (919) –—*?~°• 
</div>

<div class="floatPad times big black animatePunctuation">
well then ...,,,..:::
</div>

<?php 
}
?>

<?php 
if ($alt == 5) {
?>
<div class="floatPad times big black animatePunctuation">
and this <a href=''>too!!*!</a>! 	
<a href=''><i>The.Wattis+Institute*</i></a>ok<i>italic!?:!</i><b>ok--</b> and this too,.,.;
</div>
<?php 
}
?>

<?php 
if ($alt == 6) {
?>
<div class="floatPad times big black animatePunctuation">
<a>hello, world!</a> hello hello hello world 
world
<a>hello. world</a>
</div>
<?php 
}
?>

<?php 
if ($alt == 7) {
?>
<div class="floatPad times big black animatePunctuation">
one, world.<a href=''>two, world.</a>three, world.
</div>
<?php 
}
?>

<?php 
if ($alt == 8) {
?>
<div class="floatPad times big black animatePunctuation">
<a href=''>The.Wattis+Institute</a>*
</div>
<?php 
}
?>

<?php 
if ($alt == 9) {
?>
<div class="floatPad times big black animatePunctuation">
<a href=''>The.Wattis+Institute</a>* for Contemporary Arts)
</div>
<?php 
}
?>

<?php 
if ($alt == 10) {
?>
<div class="floatPad times big black animatePunctuation">
<a href=''>The.Wattis+Institute</a>* for Contemporary Arts).. is reopening 9.9/2014!
</div>
<?php 
}
?>

<?php 
if ($alt == 11) {
?>
<div class="floatPad times big black animatePunctuation">
<a href='http://www.wattis.org'>Re-opening</a> 9.9/2014!
</div>
<?php 
}
?>



<script type="text/javascript" src="JS/animatePunctuation.js"></script>

<script>
	initPunctuation('animatePunctuation', 500, true);
</script>

</div>
</body>
</html>
 

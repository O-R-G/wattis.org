<?php
require_once("GLOBAL/head.php");
?>

<?php
	$textcolor = $_REQUEST['textcolor'];          // no register globals
	if (!$textcolor) $textcolor="black";

	$summary = $_REQUEST['summary'];          // no register globals
	if (!$summary) $summary=null;
?>


<!-- *todo* add homecontainer wrapper -->


<!-- WATTIS -->
<!--
<div class="wattisContainer times big black fixed"> <a href="punctuation.php?textcolor=<?php 
echo ($textcolor=='white') ? 'black' : 'white' ; ?>"><canvas id="canvas0" 
width="46"height="22" class="show" onclick="showBones();">\\\\*</canvas></a> . . .  This is <a 
href="main.php">The Wattis</a>.</div>
-->


<div class="times big <?php echo $textcolor; ?>">


	<?php
                        
	// SQL object 
	// hack to only read from Punctuation record

	$sql = "SELECT * FROM objects, wires WHERE objects.id='20' AND wires.toid = objects.id 
AND objects.active = '1' AND wires.active = '1' ORDER BY objects.rank;";
	$result =  MYSQL_QUERY($sql);
	$myrow  =  MYSQL_FETCH_ARRAY($result);
	$html = "";

	// find all punctuation and then animate it

	// + preg_replace searches for any punctuation marks
	// + then wraps that in div with monaco type
	// + next, must troll the DOM and find all the elements of id="punctuation" 
	//   and put these into an array so that can cycle thru each of these and trigger animations
	// + then the script modifies the innerHTML of these, based on punctuations but then evolving
	// + "/[^!-~]/" matches all punctuation, but probably only once -- as a character range
	// element ids need to be unique so have to figure out how to loop thru and write diff 
 
	$html .= "<div class='triplewide centered'>";
	$html .= "<br /><br /><br /><br /><br /><br /><br />";
	$punctuationString = $myrow["body"];

	// preg_replace_callback executes the callback function each time it finds a match
	
	// $regex = "/[!\\\"#$%&()*+,\\-.\\/:;<=>?@\\[\\\\\\]^_`\\{|\\}~°•´∞±≤≥¿¡«»–—“”‘’÷‹›¦−×⁏⁑⁔‿⁀⁐⁖∗∘∙∴∵≀∪∩⊂⊃┌┐]/";

	// regex array for pattern matching because of php weirdness in the regex above (prob re escaping)

	// $regex[0] = '/[[!\\$()*+\\-.\\/:;<=>?\\[\\\\\\]^_`\\{|\\}]/';	// first batch
	$regex[0] = '/\,/';
	$regex[1] = '/\./';
	//$regex[2] = '/#/';
	//$regex[3] = '/%/';
	//$regex[4] = '/&/';
	//$regex[5] = '/,/';
	//$regex[6] = '/\"/';
	
	// $regex = "/[,\*\.\(\)\/\-\{\}?+=]/";
	// $regex = '/[\[\],’\*\.\(\)\/\-\{\}?+=]/';

	$result = preg_replace_callback($regex, function($matches){
    	
		static $count = 0;
	    	global $count;		// needed to declare in the function explicitly
		global $harvest;	// string to keep list of matches comma separated
	    	$count++;
    		$harvest .= $matches[0] . "@";	
		$thisWrappedMatch = "<span id='punctuation" . $count . "' class='monaco big black'>" . $matches[0] . "</span>";
    		return !empty($matches[0]) ? $thisWrappedMatch : '';
	}, $punctuationString);

	// debug
	// $result = preg_replace($regex, "+", $punctuationString);
	// echo $count; 
	// echo $harvest; 

	if (!$summary) {

		$html .= $result;
	} else {

		$html .= "<span id='punctuationsummary' class='monaco big black'>...</span>";
	}
	
	$html .= "</div>";

	// echo nl2br($html);

	?>
	
	<!-- DATE -->
	<!--
	<div class="dateContainer helvetica small">
		CCA WATTIS INSTITUTE FOR CONTEMPORARY ARTS<br />360 KANSAS STREET / SAN FRANCISCO CA 94103<br />
		20142615
	</div>
	-->

</div>




<script type="text/javascript" src="JS/animatePunctuation.js"></script>


<!-- testDiv 
	
<div id="testDiv" class="helvetica big red">
Hello, Page.
!"#$%()*+,\-.\/:;=?@\[\\\]^_`\{|\}~°•´∞±≤≥¿¡«»–—“”‘’÷‹›¦−×⁏⁑⁔‿⁀⁐⁖∗∘∙∴∵≀∪∩⊂⊃┌┐

“People" like to sit still, but bodies don’t. Mirrors have a way of putting the 
arm where the leg should be and the arm where the leg should be.  { Joan Jonas } 
has been spent a lot of time taking herself apart and putting herself back 
together again in the company of others. + * - ?

Joan Jonas, Vertical Roll from >1971, and Standing Sideways, >1978. Both deal 
with the way the body conforms to story telling. Art historian {Pamela Lee} 
hosts a conversation before and after the screening. Drinks will be served.

Next Tuesday, September 24
>7pm

The Wattis
360 Kansas Street
SF, CA 94013
</div>
-->

<div id="Punct-ok" class="helvetica big">
.+*
</div>

<div id="Punct-0" class="helvetica big">
-+=
</div>

<div id="Punct-22" class="helvetica big">
‹›÷
</div>

<div id="Punct-1" class="helvetica big">
\\*
</div>

<div id="Punct-2" class="helvetica big">
!*=
</div>

<div id="Punct-3" class="helvetica big">
+=*
</div>

<div id="Punct-4" class="helvetica big">
∪∩⊂
</div>

<div id="Punct-e" class="helvetica big">
,(;
</div>
	
<script>
	initPunctuation("Punct");
</script>




<!-- JS -->

<!-- <script type="text/javascript" src="JS/animatePunctuation.js"></script> -->


<script>

// make an array from the php string 
// possible to pass array from php to js? probably more work than it's worth

harveststring = "<?php echo $harvest; ?>";
var harvest = harveststring.split('@');		

// animatePunctuation(<?php echo $count; ?>, harvest);

</script>




</div>
</body>
</html>
 

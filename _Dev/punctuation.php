<?php
require_once("GLOBAL/head.php");
?>

<?php
	$textcolor = $_REQUEST['textcolor'];          // no register globals
	if (!$textcolor) $textcolor="black";

	$summary = $_REQUEST['summary'];          // no register globals
	if (!$summary) $summary=null;
?>

</style>

<!-- *todo* add homecontainer wrapper -->


<!-- WATTIS -->

<div class="wattisContainer times big black fixed"> <a href="punctuation.php?textcolor=<?php 
echo ($textcolor=='white') ? 'black' : 'white' ; ?>"><canvas id="canvas0" 
width="46"height="22" class="show" onclick="showBones();">\\\\*</canvas></a> . . .  This is <a 
href="main.php">The Wattis</a>.</div>


<div class="times big <?php echo $textcolor; ?>">

	<?php
                        
	// SQL object 
	
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
	
	$result = preg_replace_callback("/[,\*\.\(\)\/\-?]/", function($matches){
    	
		static $count = 0;
	    	global $count;		// needed to declare in the function explicitly
		global $harvest;	// string to keep list of matches comma separated
	    	$count++;
    		$harvest .= $matches[0] . ",";	
		$thisWrappedMatch = "<span id='punctuation" . $count . "' class='monaco big black'>" . $matches[0] . "</span>";
    		return !empty($matches[0]) ? $thisWrappedMatch : '';
	}, $punctuationString);

	// debug
	// echo $count; 
	// echo $harvest; 

	if (!$summary) {

		$html .= $result;
	} else {

		$html .= "<span id='punctuationsummary' class='monaco big black'>...</span>";
	}
	

$html .= "</div>";

	echo nl2br($html);

	?>
        
	
	<!-- DATE -->

	<div class="dateContainer helvetica small">
		CCA WATTIS INSTITUTE FOR CONTEMPORARY ARTS<br />360 KANSAS STREET / SAN FRANCISCO CA 94103<br />
		20142615
	</div>
</div>






<!-- JS -->

<script type="text/javascript" src="JS/animatePunctuation.js"></script>
<script>

// make an array from the php string 
// possible to pass array from php to js? probably more work than it's worth

harveststring = "<?php echo $harvest; ?>";
var harvest = harveststring.split(',');		

animatePunctuation(<?php echo $count; ?>, harvest);

</script>



</div>
</body>
</html>
 

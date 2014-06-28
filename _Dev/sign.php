<?php
require_once("GLOBAL/head.php");
?>

<?php
	$textcolor = $_REQUEST['textcolor'];          // no register globals
	if (!$textcolor) $textcolor="black";

	$summary = $_REQUEST['summary'];          // no register globals
	if (!$summary) $summary=null;
?>

<style>

body {
background-color:#000;
}

.black a {
color:#FFF;
}

.black {
color:#FFF;
}

.monaco {

/*font-family: "BubbledotICG-CoarsePos";*/
}

</style>

<!-- *todo* add homecontainer wrapper -->


<!-- WATTIS -->

<div class="triplewide centered times big black"> 

<br/><br/>

<span class='monaco'>//* . . . </span>This is <a href=''>The Wattis</a><span 
class='monaco'>.</span> We<span class='monaco'>’</span>re a few blocks away from 
California College of the Arts <span class='monaco'><<⅂</span> at 360 Kansas Street <span 
class='monaco'>(</span>b<span class='monaco'>/</span>t 16th <span class='monaco'>&</span> 
17th<span class='monaco'>),</span> SF<span class='monaco'>,</span> CA 94013<span 
class='monaco'>.</span> Today<span class='monaco'>,</span> it is kind of foggy and 
currently 78<span class='monaco'>°</span> F<span class='monaco'>.</span> ((())) www<span class='monaco'>.</span>wattis<span class='monaco'>.</span>org

<br/><br/>

We are open T–F 12 to 7 / S 12 to 5. 

<br/><br/>

<span class='monaco'>//*...</span> <a href=''>The Wattis</a> Institute for Contemporary Art

<br/><br/>

<a href=''>The<br/>Wattis</a> Institute<br/> <br/>for Contemporary Art



</div>


<div class="times big <?php echo $textcolor; ?>">

	<?php
                        
	// SQL object 
	// hacked to read only from "Sign" object
		
	$sql = "SELECT * FROM objects, wires WHERE objects.id='21' AND wires.toid = objects.id 
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
	<!--
	<div class="dateContainer helvetica small">
		CCA WATTIS INSTITUTE FOR CONTEMPORARY ARTS<br />360 KANSAS STREET / SAN FRANCISCO CA 94103<br />
		20142615
	</div>
	-->
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
 

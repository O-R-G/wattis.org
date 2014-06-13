<?php
require_once("GLOBAL/head.php");
require_once("_Library/orgRSSParse.php");
?>


<?php
	
	// put this in head.php?
	
	// Build weatherString
	// currently using old version of orgRSSParse

	$weatherString .= orgRSSParse("http://www.nws.noaa.gov/data/current_obs/KSFO.rss");
	$weatherString = str_replace(" at San Francisco Intl Airport, CA", "", $weatherString);
	// $weatherString = str_replace(" F", "&deg;", $weatherString);
	$weatherString = preg_replace("/\d+/", "$0&deg;", $weatherString);
	$weatherString = str_replace("and", "and currently ", $weatherString);
	$weatherString = "Today, " . strtolower($weatherString) . ".";
?>


<!-- *todo* add homecontainer wrapper -->

<div class="times big black">

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
// "/[^!-~]/" matches all punctuation, but probably only once -- this is a character range
// likely i want more control but will start here
         
	$html .= "<div class='triplewide centered'>";

	$punctuationString = $myrow["body"];

	// element ids need to be unique so have to figure out how to loop thru and write diff ids or somehow id these all so can search for them
	// clearly trick is to use preg_match_all which returns matches in an array

	// then can use that to adjust ids 
	// or there may be a smarter way of trolling the DOM and looking for a class or something else
 
        // $punctuationString = preg_replace("/[^!-~]/", "A", $punctuationString);
        $punctuationString = preg_replace("/[,\*\.\(\)?]/", "<span id='punctuation' class='monaco big red'>$0</span>", $punctuationString);

	$html .= $punctuationString;

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

addedSymbol="!";

animatePunctuation(addedSymbol);
</script>



</div>
</body>
</html>
 

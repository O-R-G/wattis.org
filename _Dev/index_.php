<?php
require_once("GLOBAL/head.php");
require_once("_Library/orgRSSParse.php");
?>


<div class="homeContainer times big animatePunctuation">

	<?php
                        
	$rootname = 'Home';

        // SQL objects attached to root by name

        $sql = "SELECT objects.id AS objectsId, objects.name1, objects.body, objects.url, 
objects.begin, objects.end FROM objects, wires WHERE wires.fromid=(SELECT objects.id FROM objects 
WHERE objects.name1 LIKE '$rootname' AND objects.active=1) AND wires.toid = objects.id AND 
objects.active = '1' AND wires.active = '1' ORDER BY objects.rank;";

        $result = MYSQL_QUERY($sql);
        $html = "";
        $i = 0;

        // collect blocks

        $myrow = MYSQL_FETCH_ARRAY($result);
	$blocks[$i] = "<div class = 'logoContainer'>" . $myrow["body"] . "</div>";

        while ( $myrow  =  MYSQL_FETCH_ARRAY($result) ) {

                $randomPadding = rand(0, 150);
                $randomWidth = rand(10, 35);
                $randomMargin = rand(30, 80);
                $randomFloat = (rand(0, 1) == 0) ? 'left' : 'right';
                $blocks[$i] .= "<div class = 'blockContainer' style='width:" . $randomWidth . "%; float:" . $randomFloat . "; padding-top:" . $randomPadding . "px; margin: " . $randomMargin . "px;'>";
                $blocks[$i] .= $myrow["body"];
                $blocks[$i] .= "</div>";

                $i++;
        }

	// write blocks

        for ( $j = 0; $j < count($blocks); $j++) {

                $html .= $blocks[$j];
        }

	echo nl2br($html);

	?>
        
</div>



















<!-- WEATHER -->


<script type="text/javascript">

	// requires html <element id=rss>

	showRSS("http://www.nws.noaa.gov/data/current_obs/KSFO.rss"); 

</script>







<!-- CLICK -->

<div id='click' class="fullContainer"></div>




<script type="text/javascript">

// do this once the page loads? dunno. maybe here is good

document.getElementById("click").onclick=function(){ click('color','black'); };



function click(id,color) {

	// change main color to black
	// change news color to red 	* to do *
	// change menu color to black
	// remove click div

	flipColor(id,color);

	var child = document.getElementById("click");
	child.parentNode.removeChild(child);
}



function flipColor(id,color) {

	// might do getElementsByClassName instead and search for anything with black in it
	// or anything with red? 

	color = (document.getElementById(id).className != color) ? color : 'white';
	document.getElementById(id).className = color;
}



/*
function showBones(id,color) {

	// flipTextColor
	// stop/start animation

	color = (document.getElementById(id).className != color) ? color : 'white';
	document.getElementById(id).className = color;

	color = (document.getElementById('News').className != color) ? color : 'white';
	document.getElementById(id).className = color;
}

*/










/* stop event propogration?

	if (!e) var e = window.event;
	e.cancelBubble = true;
	if (e.stopPropagation) e.stopPropagation();
*/




</script>




<!-- NEWS -->

<script type="text/javascript" src="JS/animateNewsTicker.js"></script>

<?php

	// SQL object with attached (News)
	
	$sql = "SELECT objects.id, objects.name1, objects.body, objects.active, objects.rank, wires.active, 
wires.fromid, wires.toid FROM objects, wires WHERE wires.fromid=(SELECT objects.id FROM objects WHERE objects.name1 
LIKE 'News' AND objects.active='1' LIMIT 1) AND wires.toid = objects.id AND objects.active = '1' AND wires.active = 
'1' ORDER BY objects.rank;";

	$result =  MYSQL_QUERY($sql);
	$i = 0;
	$newsItems = array();

	while ( $myrow  =  MYSQL_FETCH_ARRAY($result) ) {
        	                        	
		$newsItems[$i] = $myrow["body"];
		$i++;
	}
                       
?>

<script type="text/javascript">

       	newsItem = new Array(

		<?php
			$i = 0;
 		
			while ( $newsItems[$i] != null ) {
        	                        			
				echo "\"" . $newsItems[$i] . "\"";

				if ( $i < (count($newsItems) -1) ) {

					echo ",\n";
				} else {

					echo "\n";
				}			
				$i++;
			}
		?>
	);
	
	animateNewsTicker(newsItem[0]);

</script>




<?php
require_once("GLOBAL/foot.php");
?>

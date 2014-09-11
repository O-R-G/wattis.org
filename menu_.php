<?php
require_once("GLOBAL/head.php");
?>

<div class="mainContainer times big">

	<?php
                        
	// SQL object 
	
	$sql = "SELECT objects.id AS objectsId, objects.name1, objects.deck, objects.url FROM objects, 
wires WHERE wires.fromid=(SELECT objects.id FROM objects WHERE objects.id=$id AND objects.active=1) AND 
wires.toid = objects.id AND objects.active = '1' AND wires.active = '1' ORDER BY objects.rank;";

	$result = MYSQL_QUERY($sql);
	$html = "";
	$i = 0;

        while ( $myrow  =  MYSQL_FETCH_ARRAY($result) ) {

		if ($myrow['name1'][0] != '.') {

			$html .= "<div class='listContainer times'>";
			// $html .= "<canvas id='canvas" . ($i+1) . "' width='46' height='22' class='monaco'>[*]</canvas> ";

                	$URL = $myrow["url"];
			$URL = ($URL) ? "$URL" : "view_";
	
			$html .= "<a href='" . $URL . ".php?id=" . $myrow['objectsId'] . "'>" . $myrow['name1'] . "</a> ";	
			$html .= "<i>" . $myrow['deck'] . "</i>";	
			$html .= "</div>";	

	        	$i++;
			if ( $i % 3 == 0) $html .= "<div class='clear'></div>"; 	// clear floats

		}
	}

	echo nl2br($html);
	?>

<?php
require_once("GLOBAL/foot.php");
?>

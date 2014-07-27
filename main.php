<?php
require_once("GLOBAL/head.php");
?>


<div class="mainContainer times big black">

	<?php
                        
	// SQL object 
	
	$sql = "SELECT objects.id AS objectsId, objects.name1, objects.deck, objects.url FROM objects, wires WHERE wires.fromid=(SELECT objects.id FROM objects 
WHERE name1 LIKE 'Main' AND objects.active=1) AND wires.toid = objects.id AND objects.active = '1' AND wires.active = '1' ORDER BY objects.rank;";

	$result = MYSQL_QUERY($sql);
	$html = "";
	$i = 0;

	while ( $myrow  =  MYSQL_FETCH_ARRAY($result) ) {
			
		$html .= "<div class='listContainer times'>";
		$html .= "<span class='monaco'>[*]</span> ";	                  

                $URL = $myrow["url"];
		$URL = ($URL) ? "$URL" : "detail";     // normal

		$html .= "<a href='" . $URL . ".php?id=" . $myrow['objectsId'] . "'>" . $myrow['name1'] . "</a> ";	
		$html .= "<i>" . $myrow['deck'] . "</i>";	
		$html .= "</div>";	

	        $i++;
		if ( $i % 3 == 0) $html .= "<div class='clear'></div>"; 	// clear floats
	}
                       
	echo nl2br($html);
	?>
</div>


<!-- JS -->

<script type="text/javascript">
	
	message[1] =    [
			"[.]",
			"[+]",
			"[-]",
			"[!]",
			"[*]"
			];

	delay[1] = 400;

	window.onload=initEmoticons(1, message, delay);
</script>


<?php
require_once("GLOBAL/head.php");
?>



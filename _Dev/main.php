<?php
require_once("GLOBAL/head.php");
?>


<div class="mainContainer times big black">

	<?php
                        
	// SQL object 
	
	$sql = "SELECT objects.id AS objectsId, objects.name1, objects.deck FROM objects, wires WHERE 
wires.fromid=(SELECT objects.id FROM objects WHERE name1 LIKE 'Main' AND objects.active=1) 
AND wires.toid = objects.id AND objects.active = '1' AND wires.active = '1' ORDER BY 
objects.rank;";

	$result = MYSQL_QUERY($sql);
	$html = "";

	while ( $myrow  =  MYSQL_FETCH_ARRAY($result) ) {
		
		// * fix * convases
		// $html .= "<span class='listContainer times show comment'><canvas id='canvas1' width='46' height='22' class='show'>[*]</canvas>";	                        	
		$html .= "<span class='listContainer times show comment'>";
		$html .= "<span class='monaco'>[*]</span> ";	                  
		$html .= "<a href='detail.php?id=" . $myrow['objectsId'] . "'>" . $myrow['name1'] . "</a> ";	
		$html .= "<i>" . $myrow['deck'] . "</i>";	
		$html .= "</span>";	
	}
                       
	echo nl2br($html);

	?>
        
	<!-- DATE -->
	<!-- move this to foot.php? -->

	<div class="dateContainer helvetica small">
		CCA WATTIS INSTITUTE FOR CONTEMPORARY ARTS<br />360 KANSAS STREET / SAN FRANCISCO CA 94103<br />
		20142615
	</div>
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

</div>
</body>
</html>

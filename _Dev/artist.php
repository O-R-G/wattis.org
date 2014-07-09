<?php
require_once("GLOBAL/head.php");
?>


<div class="mainContainer times big black">

	<?php
                
	// SQL object plus media
	
	// *fix* query should return hits even if no media attached (see LEFT JOIN in some previous website ... hmm, zenazezza? cluster?)
                     
	$sql = "SELECT objects.id AS objectsId, objects.name1, objects.deck, objects.body, objects.active, objects.rank as objectsRank, wires.fromid, wires.toid, 
wires.active, media.id AS mediaId, media.object AS mediaObject, media.type, media.caption, media.active, media.rank FROM objects, wires, media WHERE objects.id = $id 
AND wires.toid = objects.id AND media.object = objects.id AND objects.active = '1' AND wires.active = '1' AND media.active = '1' ORDER BY media.rank;";

	$result = MYSQL_QUERY($sql);
	$html = "";
	$i=0;

	// collect images

	while ( $myrow  =  MYSQL_FETCH_ARRAY($result) ) {

		$mediaFile = "MEDIA/". str_pad($myrow["mediaId"], 5, "0", STR_PAD_LEFT) .".". $myrow["type"];
		$mediaCaption = strip_tags($myrow["caption"]);
		$mediaStyle = "width: 100%;";
		$images[$i] .= "<div id='image".$i."' class = 'imageContainer' onclick='expandImage(\"image".$i."\", \"100px\", \"0px\");' style='padding:100px;'>";
		$images[$i] .= "\n    ". displayMedia($mediaFile, $mediaCaption, $mediaStyle);
		$images[$i] .= "<div class = 'captionContainer caption'>";
		$images[$i] .= $mediaCaption . "<br /><br />";
		$images[$i] .= "</div>";
		$images[$i] .= "</div>";
		$i++;

		// this could work better if only checked first time thru this loop
		$name = $myrow['name1'];
		$body = $myrow['body'];
	}

	// body

	$html .= "<span class='doublewide centered times big black'>";
	$html .= $body;	
	$html .= "</span>";	
                  
	// images

	for ( $j = 0; $j < count($images); $j++) {
	
		$html .= $images[$j];
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

<?php
require_once("GLOBAL/head.php");
?>

<?php

        // temporary animateEmoticon hack

        $thisCanvas = 1;
?>


<div class="mainContainer times big black">

	<?php
                
	// SQL object

	$sql = "SELECT objects.id, objects.name1, objects.body FROM objects WHERE objects.id = $id AND objects.active = 1;";
        $result = MYSQL_QUERY($sql);
	$myrow  = MYSQL_FETCH_ARRAY($result);
	$rootname = $myrow["name1"];
	$rootbody = $myrow["body"];


        // SQL objects attached to object plus media

	$sql = "SELECT objects.id AS objectsId, objects.name1, objects.deck, objects.body, 
objects.rank, wires.fromid, wires.toid, media.id AS mediaId, media.object, media.caption, media.type, 
media.active AS mediaActive FROM wires, objects LEFT JOIN media ON objects.id = media.object AND 
media.active = 1 WHERE wires.fromid = (SELECT objects.id FROM objects WHERE objects.id = $id AND 
objects.active = 1) AND wires.toid=objects.id ORDER By objects.rank;";

	$result = MYSQL_QUERY($sql);
	$html = "";
	$i=0;

	// collect images

	while ( $myrow  =  MYSQL_FETCH_ARRAY($result) ) {

		if ($myrow['mediaActive'] != null) {

			$mediaFile = "MEDIA/". str_pad($myrow["mediaId"], 5, "0", STR_PAD_LEFT) .".". $myrow["type"];
			$mediaCaption = strip_tags($myrow["caption"]);
			$mediaStyle = "width: 100%;";

	                if ( $i == 0 ) {

				$specs  = getimagesize($mediaFile);
				$use4xgrid = (($specs[0]/$specs[1]) < 1) ? TRUE : FALSE;		       
	                }

			$images[$i] .= "<a href='buy_.php?id=" . $myrow['objectsId'] . "'>";
			$images[$i] .= "<div id='image".$i."' class = 'listContainer " . (($use4xgrid) ? "fourcolumn" : "twocolumn") . "'>";
			$images[$i] .= "\n    ". displayMedia($mediaFile, $mediaCaption, $mediaStyle);
			$images[$i] .= "<div class = 'captionContainer helvetica small'>";
			$images[$i] .= $myrow['name1'];
			$images[$i] .= "</div>";
			$images[$i] .= "</div>";
			$images[$i] .= "</a>";
		
			if ( ( $i+1) % (($use4xgrid) ? 4 : 2) == 0) $images[$i] .= "<div class='clear'></div>";
             		$i++;
		}
	}


	// name

	$html .= "<div class='listContainer times'>";
	$html .= "<a href=''>" . $rootname . "</a> ";	
	$html .= "<br /><br />" . $rootbody;
	$html .= "</div>";	

   
	// images
	
	$html .= "<div class = 'listContainer doublewide'>";

	for ( $j = 0; $j < count($images); $j++) {
	
		$html .= $images[$j];

	}

	$html .= "</div>";

	echo nl2br($html);

	?>
        


<!-- JS -->

<script type="text/javascript">
	
	message[1] =    [
			"[.]",
			"[+]",
			"[*]"
			];

	delay[1] = 400;

	// window.onload=initEmoticons(1, message, delay);
	window.onload=initEmoticons(2, message, delay);

</script>


<?php
require_once("GLOBAL/foot.php");
?>

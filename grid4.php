<?php
require_once("GLOBAL/head.php");
?>


<div class="mainContainer times big black">

	<?php
                
	// SQL object

	$sql = "SELECT objects.id, objects.name1 FROM objects WHERE objects.id = $id AND objects.active = 1;";
        $result = MYSQL_QUERY($sql);
	$myrow  = MYSQL_FETCH_ARRAY($result);
	$rootname = $myrow["name1"];


	// SQL objects attached plus media

	$sql = "SELECT objects.id AS objectsId, objects.name1, objects.deck, objects.body, objects.rank, wires.fromid, 
wires.toid, media.id AS mediaId, media.object, media.caption, media.type FROM wires, objects LEFT JOIN media ON 
objects.id = media.object AND media.active = 1 WHERE wires.fromid = (SELECT objects.id FROM objects WHERE 
objects.name1 LIKE '$rootname') AND wires.toid=objects.id ORDER By objects.rank;";

	$result = MYSQL_QUERY($sql);
	$html = "";
	$i=0;

	// collect images

	while ( $myrow  =  MYSQL_FETCH_ARRAY($result) ) {

		$mediaFile = "MEDIA/". str_pad($myrow["mediaId"], 5, "0", STR_PAD_LEFT) .".". $myrow["type"];
		$mediaCaption = strip_tags($myrow["caption"]);
		$mediaStyle = "width: 100%;";
		$images[$i] .= "<a href='grid4detail.php?id=" . $myrow['objectsId'] . "'>";
		$images[$i] .= "<div id='image".$i."' class = 'listContainer fourcolumn'>";
		$images[$i] .= "\n    ". displayMedia($mediaFile, $mediaCaption, $mediaStyle);
		$images[$i] .= "<div class = 'captionContainer monaco small'>";
		$images[$i] .= $mediaCaption;
		$images[$i] .= "</div>";
		$images[$i] .= "</div>";
		$images[$i] .= "</a>";

		// this could work better if only checked first time thru this loop
		$name = $myrow['name1'];
		$body = $myrow['body'];

		// 4 columns

		if ( ( $i+1 ) % 4 == 0 ) $images[$i] .= "<div class='clear'></div>";

                $i++;
	}


        // deck

        $html .= "<div class='listContainer times'>";
        $html .= "<span class='monaco'>[*]</span> ";
        $html .= "<a href=''>" . $rootname . "</a> ";
        $html .= "<br /><br />" . $rootbody;
        $html .= "</div>";

   
	// images

	$html .= "<div class='listContainer doublewide'>";

	for ( $j = 0; $j < count($images); $j++) {
	
		$html .= $images[$j];
	}

	$html .= "</div>";	

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

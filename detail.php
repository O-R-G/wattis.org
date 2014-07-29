<?php
require_once("GLOBAL/head.php");
?>

<?php

	// temporary animateEmoticon hack

	$thisCanvas = 1;

/*
switch ($id) {
    case 22:
	$thisCanvas = 1;
        break;
    case 25:
	$thisCanvas = 2;
        break;
    case 30:
	$thisCanvas = 3;
        break;
    case 23:
	$thisCanvas = 4;
        break;
    case 26:
	$thisCanvas = 5;
        break;
    case 31:
	$thisCanvas = 6;
        break;
    case 24:
	$thisCanvas = 7;
        break;
    case 27:
	$thisCanvas = 8;
        break;
    case 29:
	$thisCanvas = 9;
        break;
    case 28:
	$thisCanvas = 10;
        break;
}
*/

?>


<div class="mainContainer times big black">

	<?php
                
	// SQL object plus media
	                     
	$sql = "SELECT objects.id AS objectsId, objects.name1, objects.deck, objects.body, objects.active, 
objects.rank as objectsRank, media.id AS mediaId, media.object AS mediaObject, media.type, media.caption, 
media.active AS mediaActive, media.rank FROM objects LEFT JOIN media ON objects.id = media.object AND 
media.active = 1 WHERE objects.id = $id AND objects.active ORDER BY media.rank;";

	$result = MYSQL_QUERY($sql);
	$html = "";
	$i=0;

	// collect images

	while ( $myrow  =  MYSQL_FETCH_ARRAY($result) ) {

		if ($myrow['mediaActive'] != null) {
		
			$mediaFile = "MEDIA/". str_pad($myrow["mediaId"], 5, "0", STR_PAD_LEFT) .".". $myrow["type"];
			$mediaCaption = strip_tags($myrow["caption"]);
			$mediaStyle = "width: 100%;";
			$images[$i] .= "<div id='image".$i."' class = 'imageContainer' onclick='expandImage(\"image".$i."\", \"100px\", \"0px\");' style='padding:100px;'>";
			$images[$i] .= "\n    ". displayMedia($mediaFile, $mediaCaption, $mediaStyle);
			$images[$i] .= "<div class = 'captionContainer monaco small'>";
			$images[$i] .= $mediaCaption;
			$images[$i] .= "</div>";
			$images[$i] .= "</div>";
		}

		if ( $i == 0 ) {

			$name = $myrow['name1'];
			$body = $myrow['body'];
		}

		$i++;
	}


        // Check for column breaks

	$pattern = "/\/\/\//";
	if ( preg_match($pattern, $body) == 1 ) $columns = preg_split($pattern, $body);

   
	// deck

	$html .= "<div class='listContainer times'>";
	$html .= "<canvas id='canvas" . ($thisCanvas) . "' width='46' height='22' class='monaco'>[*]</canvas> ";
	// $html .= "<span class='monaco'>[*]</span> ";	                  
	$html .= "<a href=''>" . $name . "</a> ";	
	$html .= "</div>";	


	// body

	if ($columns) {

		for ($i = 0; $i < count($columns); $i++) {
		
			$html .= "<div class='listContainer times'>";
			$html .= $columns[$i];	
			$html .= "</div>";	
		}

	} else {

        	$html .= "<div class='listContainer doublewide times'>";
        	$html .= $body;
        	$html .= "</div>";
	}


	// images

	if ( !$images ) {

		for ( $j = 0; $j < count($images); $j++) {
		
			$html .= $images[$j];
		}
	}

	echo nl2br($html);

	?>
        
</div>


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



</script>


<?php
require_once("GLOBAL/head.php");
?>

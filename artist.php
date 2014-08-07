<?php
require_once("GLOBAL/head.php");
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

			$randomPadding = rand(0, 150);
			$randomWidth = rand(15, 45);
			$randomFloat = (rand(0, 1) == 0) ? 'left' : 'right';
			
			$images[$i] .= "<div class = 'imageContainerWrapper' style='width:" . $randomWidth . "%; float:" . $randomFloat . ";'>";
			$images[$i] .= "<div id='image".$i."' class = 'imageContainer' style='padding-top:" . $randomPadding . "px; margin:40px;' onclick='expandImageContainerMargin(\"image".$i."\", \"40px\", \"-80px\");'>";
			$images[$i] .= "\n    ". displayMedia($mediaFile, $mediaCaption, $mediaStyle);
			$images[$i] .= "<div class = 'captionContainer caption helvetica small'>";
			$images[$i] .= $mediaCaption . "<br /><br />";
			$images[$i] .= "</div>";
			$images[$i] .= "</div>";
			$images[$i] .= "</div>";
		}
		
		if ( $i == 0 ) {

			$name = $myrow['name1'];
			$body = $myrow['body'];
			$deck = $myrow['deck'];
		}

		$i++;
	}


        // Check for column breaks

	$pattern = "/\/\/\//";
	if ( preg_match($pattern, $body) == 1 ) $columns = preg_split($pattern, $body);

   
	// name

	$html .= "<div class='listContainer times'>";
	$html .= "<span class='monaco'>[*]</span> ";	                  
	$html .= "<a href=''>" . $name . "</a> ";	
	$html .= "</div>";	


	// body

	if ($columns) {

		// column 2
	
		$html .= "<div class='listContainer times'>";
		$html .= $columns[0];	
		$html .= "</div>";	
                  	
		// column 3
	
		$html .= "<div class='listContainer times'>";
		$html .= $columns[1];	
		$html .= "</div>";	
                  	
	} else {

        	$html .= "<div class='listContainer doublewide centered times'>";
        	$html .= $body;
        	$html .= "</div>";
	}


	// images
        	
	$html .= "<div class='listContainer triplewide centered'>";

	for ( $j = 0; $j < count($images); $j++) {
	
		$html .= $images[$j];
	}


	// video (deck)

	$html .= "<span class=''>";
	$html .= $deck;	                  
	$html .= "</span>";	

        $html .= "</div>";

	echo nl2br($html);

	?>
        


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
require_once("GLOBAL/foot.php");
?>

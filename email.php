<?php
require_once("GLOBAL/head.php");
?>


<div class="mainContainer times big black">

	<?php
                
	// SQL object plus media
	                     
	$sql = "SELECT objects.id AS objectsId, objects.name1, objects.deck, objects.body, objects.active, objects.rank as objectsRank, 
media.id AS mediaId, media.object AS mediaObject, media.type, media.caption, media.active AS mediaActive, media.rank FROM objects LEFT JOIN 
media ON objects.id = media.object AND media.active = 1 WHERE objects.id = $id AND objects.active ORDER BY media.rank;";

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
			$deck = $myrow['deck'];
		}

		$i++;
	}


        // Check for column breaks

	$pattern = "/\/\/\//";
	if ( preg_match($pattern, $body) == 1 ) $columns = preg_split($pattern, $body);

   
	// deck

	$html .= "<div class='emailHeaderContainer times'>";
	$html .= "<a href=''>" . $deck . "</a> ";	
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
        

<?php
require_once("GLOBAL/foot.php");
?>

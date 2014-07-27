<?php
require_once("GLOBAL/head.php");
?>


<div class="mainContainer times big black">

	<?php
                
	// SQL object plus media
	                     
	$sql = "SELECT objects.id AS objectsId, objects.name1, objects.deck, objects.body, 
objects.active, objects.rank as objectsRank, media.id AS mediaId, media.object AS mediaObject, 
media.type, media.caption, media.active, media.rank FROM objects LEFT JOIN media ON objects.id 
= media.object AND media.active = 1 WHERE objects.id = $id AND objects.active ORDER BY media.rank;";

	$result = MYSQL_QUERY($sql);
	$html = "";
	$i=0;

	// collect images

	while ( $myrow  =  MYSQL_FETCH_ARRAY($result) ) {

		$mediaFile = "MEDIA/". str_pad($myrow["mediaId"], 5, "0", STR_PAD_LEFT) .".". $myrow["type"];
		$mediaCaption = strip_tags($myrow["caption"]);
		$mediaStyle = "width: 100%;";
                $images[$i] .= "<div id='image".$i."' class = ''>";
		$images[$i] .= "\n    ". displayMedia($mediaFile, $mediaCaption, $mediaStyle);
		$images[$i] .= "<div class = 'captionContainer monaco small'>";
		$images[$i] .= $mediaCaption . "<br /><br />";
		$images[$i] .= "</div>";
		$images[$i] .= "</div>";

		// this could work better if only checked first time thru this loop
		$name = $myrow['name1'];
		$body = $myrow['body'];
		$deck = $myrow['deck'];

		$i++;
	}

/*
        // Check for column breaks

	$pattern = "/\/\/\//";
	if ( preg_match($pattern, $body) == 1 ) $columns = preg_split($pattern, $body);
*/
   
	// nav

	$html .= "<div class='listContainer times'>";
	$html .= "<span class='monaco'>[*]</span> ";	                  
	$html .= "<a href=''>" . $name . "</a> ";	
	$html .= "</div>";	


        // images

        $html .= "<div class='listContainer doublewide'>";

        for ( $j = 0; $j < count($images); $j++) {

                $html .= $images[$j];
        }


	// body

        $html .= "<div class='listContainer twocolumn times'>";
        $html .= $body;
        $html .= "</div>";


	// order

        $html .= "<div class='listContainer twocolumn monaco small'>";
        $html .= $deck;
        $html .= "<br />Order now here: <img src='MEDIA/paypal.png' width='35%'>";
	$html .= "</div>";

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

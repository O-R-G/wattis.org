<?php
require_once("GLOBAL/head.php");
?>

<?php

        // temporary animateEmoticon hack

        $thisCanvas = 1;
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

                        if ( $i == 0 ) {

                                $specs  = getimagesize($mediaFile);
                                $use4xgrid = (($specs[0]/$specs[1]) < 1) ? TRUE : FALSE;

	        	        $name = $myrow['name1'];
        		        $body = $myrow['body'];
	                	$deck = $myrow['deck'];
                        }

                        $images[$i] .= "<div id='image".$i."' class = '" . (($use4xgrid) ? "listContainer twocolumn" : "") . "'>";
                        $images[$i] .= "\n    ". displayMedia($mediaFile, $mediaCaption, $mediaStyle);
                        $images[$i] .= "</div>";

			$images[$i] .= "<div class='clear'></div>";
                        $i++;
                }
        }

   
	// nav

	$html .= "<div class='listContainer times'>";
        $html .= "<canvas id='canvas" . ($thisCanvas) . "' width='46' height='22' class='monaco'>[*]</canvas> ";
	// $html .= "<span class='monaco'>[*]</span> ";	                  
	$html .= "<a href=''>" . $name . "</a> ";	
	$html .= "</div>";	


        // images

        $html .= "<div class='listContainer doublewide'>";

        for ( $j = 0; $j < count($images); $j++) {

                $html .= $images[$j];
        }


	// order

        $html .= "<div class='listContainer twocolumn doublewide helvetica small'>";
	$html .= "</div>";
        $html .= "<div class='listContainer twocolumn helvetica small'>";
	$html .= $mediaCaption . "<br/>";
        $html .= $deck;
        $html .= "<br /><br /><a href='mailto:mmeng@cca.edu'>Please email for ordering information</a>";
	$html .= "</div>";


	// body

        $html .= "<div class='listContainer twocolumn times'>";
        $html .= $body;
        $html .= "</div>";

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

	// window.onload=initEmoticons(1, message, delay);
	window.onload=initEmoticons(2, message, delay);

</script>


<?php
require_once("GLOBAL/foot.php");
?>

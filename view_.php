<?php
require_once("GLOBAL/head.php");
?>


<div class="mainContainer times big black">

	<?php
                
	// SQL object plus media
	                     
	$sql = "SELECT objects.id AS objectsId, objects.name1, objects.deck, objects.body, 
objects.notes, objects.active, objects.begin, objects.end, objects.rank as objectsRank, media.id AS 
mediaId, media.object AS mediaObject, media.type, media.caption, media.active AS mediaActive, media.rank 
FROM objects LEFT JOIN media ON objects.id = media.object AND media.active = 1 WHERE objects.id = $id 
AND objects.active ORDER BY media.rank;";

        $result = MYSQL_QUERY($sql);
        $myrow = MYSQL_FETCH_ARRAY($result);
        $name = $myrow['name1'];
        $body = $myrow['body'];
        $notes = $myrow['notes'];
        $begin = $myrow['begin'];
        $end = $myrow['end'];
	mysql_data_seek($result, 0);    // reset to row 0    
        $html = "";
	$i=0;

	// name

	$html .= "<div class='listContainer times'>";
	$html .= "<span class='monaco'>[*]</span> ";	                  
	$html .= "<a href=''>" . $name . "</a><br /> ";	
	echo $html;	// force no <br /> in name
        $html = "";

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

		$i++;
	}


        // Check for column breaks

	$pattern = "/\/\/\//";
	if ( preg_match($pattern, $body) == 1 ) $columns = preg_split($pattern, $body);


	// hours

	if ($begin || $end) {
 
		// build date display

		$displayHours = (date("H",strtotime($begin)) != '00') ? true : false;		

		if ($begin) {

			$beginDisplay = "g";
			if (date("i",strtotime($begin)) != '00') $beginDisplay .= ".i";
			if (!$end) $beginDisplay .= " a";
			$begin = date($beginDisplay,strtotime($begin));
			$hoursDisplay = "<br />" . $begin;
		}

		if ($end) {

			$endDisplay = "g";
			if (date("i",strtotime($end)) != '00') $endDisplay .= ".i";
			$endDisplay .= " a";
			$end = date($endDisplay,strtotime($end));
			$hoursDisplay = "<br />" . $begin . ' – ' . $end;
		}

                if ($displayHours) $html .= $hoursDisplay;
	}

	$html .= "</div>";	


	// body

	if ($columns) {

		// column 2
	
		// $html .= "<div id='Punct-0' class='listContainer times'>";
		$html .= "<div class='listContainer times'>";
		$html .= $columns[0];	
		$html .= "</div>";	
                  	
		// column 3
	
		// $html .= "<div id='Punct-1' class='listContainer times'>";
		$html .= "<div class='listContainer times'>";
		$html .= $columns[1];	
		$html .= "</div>";	
                  	
	} else {

        	// $html .= "<div id='Punct-0' class='listContainer doublewide centered times'>";
        	$html .= "<div class='listContainer doublewide centered times'>";
        	$html .= $body;
        	$html .= "</div>";
	}


	// images
        	
	$html .= "<div class='listContainer triplewide centered'>";

	for ( $j = 0; $j < count($images); $j++) {
	
		$html .= $images[$j];
	}


	// video

	if ($notes) {

		$html .= "<span class=''>";
		$html .= $notes;	                  
		$html .= "</span>";	
	}

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

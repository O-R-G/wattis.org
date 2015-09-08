<?php
require_once("GLOBAL/head.php");
?>

<div class="mainContainer times big">

	<? 
	// sam lewitt popWindow exception

	if ($id == 238) {
	?>

	<script>
		// window.open("http://barcahall.com/wattis-heat.html?delay=0.5");		
		// window.open("http://wattis.org/thermalcam.html");		
                window.open("http://wattis.org/thermalcam.html?delay=0.5", "thermal cam", "width=660, height=520, scrollbars=no, resizable=no");          
	</script>

	<?
	}
	?>

	<?php

        $rootid = $ids[0];

	// SQL object plus media plus rootname

	$sql = "SELECT objects.id AS objectsId, objects.name1, objects.deck, objects.body, 
objects.notes, objects.active, objects.begin, objects.end, objects.rank as objectsRank, (SELECT 
objects.name1 FROM objects WHERE objects.id = $rootid) AS rootname, media.id AS mediaId, 
media.object AS mediaObject, media.type, media.caption, media.active AS mediaActive, media.rank 
FROM objects LEFT JOIN media ON objects.id = media.object AND media.active = 1 WHERE objects.id = 
$id AND objects.active ORDER BY media.rank;";

        $result = MYSQL_QUERY($sql);
        $myrow = MYSQL_FETCH_ARRAY($result);
        $rootname = $myrow['rootname'];
        $name = $myrow['name1'];
        $body = $myrow['body'];
        $notes = $myrow['notes'];
        $begin = $myrow['begin'];
        $end = $myrow['end'];
	mysql_data_seek($result, 0);    // reset to row 0    
        $html = "";
	$i=0;


	// collect images
	// ok
 
	while ( $myrow  =  MYSQL_FETCH_ARRAY($result) ) {

                if ($myrow['mediaActive'] != null) {

			$mediaFile = "MEDIA/". str_pad($myrow["mediaId"], 5, "0", STR_PAD_LEFT) .".". $myrow["type"];
			$mediaCaption = strip_tags($myrow["caption"]);
			$mediaStyle = "width: 100%;";

			$randomPadding = rand(0, 150);
			$randomWidth = rand(30, 50);
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

	$html .= "<div class='listContainer times'>";

	if ($begin || $end) {
 
		// build date display

		$displayHours = (date("H",strtotime($begin)) != '00') ? true : false;		
		$displayYears = (date("Y",strtotime($begin)) != date("Y",strtotime($end))) ? true : false;		
 		$displayDatesEnd = (date("z",strtotime($begin)) != date("z",strtotime($end))) ? true : false;

		if ($begin) {

			$beginDisplayHours = "g";
			if (date("i",strtotime($begin)) != '00') $beginDisplayHours .= ".i";
			if (!$end) $beginDisplayHours .= " a";
			$beginHours = date($beginDisplayHours,strtotime($begin));
			$hoursDisplay = "<br />" . $beginHours;

			$beginDisplayDates = ($displayDatesEnd) ? (($displayYears) ? "F j, Y" : "F j") : "F j, Y";
			if (!$end) $beginDisplayDates .= ", Y";
			$beginDates = date($beginDisplayDates,strtotime($begin));
			$datesDisplay = $beginDates;
		}

		if ($end) {

			$endDisplayHours = "g";
			if (date("i",strtotime($end)) != '00') $endDisplayHours .= ".i";
			$endDisplayHours .= " a";
			$endHours = date($endDisplayHours,strtotime($end));
			$hoursDisplay = "<br />" . $beginHours . ' – ' . $endHours;

			$endDisplayDates = "F j, Y";
			$endDates = date($endDisplayDates,strtotime($end));

			if ($displayDatesEnd) $datesDisplay = $beginDates . ' –<br />' . $endDates;
		}		

		$html .= $datesDisplay;
                // if ($displayHours) $html .= $hoursDisplay;

	} else {
	
		$html .= $name;	
	}

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
        	
	$html .= "<div class='clear'></div>";
	$html .= "<div class='galleryContainer'>";

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

<?php
require_once("GLOBAL/foot.php");
?>

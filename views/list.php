<div class="mainContainer times big">

	<?php
	if($uri[1] == 'calendar')
	{
		$ids = $oo->urls_to_ids(array('calendar'));
        $id = $ids[0];
	}
	$rootid = $ids[0];

	// SQL objects attached to root with rootname

	$sql = "SELECT objects.id AS objectsId, objects.name1, objects.deck, objects.url, 
objects.begin, objects.end, (SELECT objects.name1 FROM objects WHERE objects.id = $id) AS rootname 
FROM objects, wires WHERE wires.fromid=(SELECT objects.id FROM objects WHERE objects.id = $rootid 
AND objects.active=1) AND wires.toid = objects.id AND objects.active = '1' AND wires.active = '1' 
ORDER BY objects.rank, objects.begin;";
	
	$result = $db->query($sql);
	if(!$result)
		throw new Exception($db->error);
	$items = array();
	while ($obj = $result->fetch_assoc())
		$items[] = $obj;
	$rootname = $items[0]["rootname"];
	
	$result = MYSQL_QUERY($sql);
	$myrow = MYSQL_FETCH_ARRAY($result);
        $rootname = $myrow["rootname"];
	mysql_data_seek($result, 0);	// reset to row 0
	$html = "";
	$i = 0;


        // name

        $html .= "<div class='listContainer times'>";
        $html .= $rootname;
        $html .= "</div>";


	// attached objects 

        $html .= "<div class='listContainer doublewide times'>";

	while ( $myrow  =  MYSQL_FETCH_ARRAY($result) ) {

                if ($myrow['name1'][0] != '.') {

			$URL = $myrow["url"];
			$URL = ($URL) ? "/calendar/".$URL : "view_";
	
			$now = time();
			$begin = ($myrow['begin'] != null) ? strtotime($myrow['begin']) : $now;
			$end = ($myrow['end'] != null) ? strtotime($myrow['end']) : $now;
			
			if ($alt && ($end < $now)) {
	
				// archive
	
				$html .= "<div class='listContainer'>";
				$html .= "<a href='" . $URL . ".php?id=" . $myrow['objectsId'] . "'>" . $myrow['name1'] . "</a> ";	
				$html .= "<i>" . $myrow['deck'] . "</i>";	
	                	// $html .= "<div class = 'helvetica small'>" . $begin . "-" . $end . " / " . $now . "</div> ";
				$html .= "</div>";	
	
			} else if (!$alt && (($begin >= $now) || ($end >= $now))) {
				
				// upcoming
	
				$html .= "<div class='listContainer'>";
				$html .= "<a href='" . $URL . ".php?id=" . $myrow['objectsId'] . "'>" . $myrow['name1'] . "</a> ";	
				$html .= "<i>" . $myrow['deck'] . "</i>";	
				// $html .= "<div class = 'helvetica small'>" . $begin . "-" . $end . " / " . $now . "</div> ";
				$html .= "</div>";	
			} 
	
	        	$i++;
	
			// if ( $i % 3 == 0) $html .= "<div class='clear'></div>"; 	// clear floats
	
		}

	}

        $html .= "</div>";
	echo nl2br($html);
	?>
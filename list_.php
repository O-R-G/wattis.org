<?php
require_once("GLOBAL/head.php");
?>


<div class="mainContainer times big black">

	<?php

        $rootid = $ids[0];	// root object

	// SQL objects attached to root with rootname

	$sql = "SELECT objects.id AS objectsId, objects.name1, objects.deck, objects.url, 
objects.begin, objects.end, (SELECT objects.name1 FROM objects WHERE objects.id = $id) AS rootname 
FROM objects, wires WHERE wires.fromid=(SELECT objects.id FROM objects WHERE objects.id = $rootid 
AND objects.active=1) AND wires.toid = objects.id AND objects.active = '1' AND wires.active = '1' 
ORDER BY objects.rank;";

	$result = MYSQL_QUERY($sql);
	$myrow = MYSQL_FETCH_ARRAY($result);
        $rootname = $myrow["rootname"];
	mysql_data_seek($result, 0);	// reset to row 0
	$html = "";
	$i = 0;


        // name

        $html .= "<div class='listContainer times'>";
        $html .= "<span class='monaco'>[*]</span> ";
        $html .= "<a href=''>" . $rootname . "</a> ";
        $html .= "</div>";


	// attached objects 

        $html .= "<div class='listContainer doublewide times'>";

	while ( $myrow  =  MYSQL_FETCH_ARRAY($result) ) {

		$URL = $myrow["url"];
		$URL = ($URL) ? "$URL" : "view_";

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

        $html .= "</div>";
	echo nl2br($html);

	?>















<!-- JS -->
<!-- to get rid of -->

<script type="text/javascript">

                message[1] =    [
                                "[*]",
                                "[.]",
                                "[!]"
                                ];

                delay[1] = 100;

                message[2] =    [
                                "\\/\\",
                                "/\\/",
                                "\\\\\\",
                                "///"
                                ];

                delay[2] = 100;

                message[3] =    [
                                "(-)",
                                "(+)",
                                "(*)",
                                ];

                delay[3] = 300;

                message[4] =    [
                                "% )",
                                "% )",
                                "% |"
                                ];

                delay[4] = 500;

                message[5] =    [
                                "#.#",
                                "...",
                                "..#",
                                "#..",
                                ".#."
                                ];

                delay[5] = 200;

                message[6] =    [
                                "|||",
                                ".||",
                                "..|",
                                "..."
                                ];

                delay[6] = 250;

                message[7] =    [
                                ">>>",
                                ".>>",
                                "..>",
                                "..."
                                ];

                delay[7] = 250;

                message[8] =    [
                                ":*",
                                ":*",
                                ":*",
                                ":*",
                                ":*",
                                ":*",
                                ":/",
                                ":|",
                                ":\\",
                                ":/",
                                ":|",
                                ":\\",
                                ":/",
                                ":|",
                                ":\\",
                                ];

                delay[8] = 100;

                message[9] =    [
                                ">/?",
                                ">/ "
                                ];

                delay[9] = 500;

                message[10] =    [
                                "&+}",
                                "&  ",
                                "&+}",
                                " + ",
                                "&+}",
                                "  }"
                                ];

                delay[10] = 500;

window.onload=initEmoticons(1, message, delay);
</script>

<?php
require_once("GLOBAL/foot.php");
?>



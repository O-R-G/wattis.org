<?php
require_once("GLOBAL/head.php");
?>


<div class="mainContainer times big black">

	<?php
                        
	// SQL object 

	$sql = "SELECT objects.id AS objectsId, objects.name1, objects.deck, objects.url FROM 
objects, wires WHERE wires.fromid=(SELECT objects.id FROM objects WHERE name1 = 'ByAppointment' AND 
objects.active=1) AND wires.toid = objects.id AND objects.active = '1' AND wires.active = '1' ORDER 
BY objects.rank;";

	$result = MYSQL_QUERY($sql);
	$html = "";
	$i = 0;


        // deck
	// * fix * -- this should follow the pattern from grid.php and griddetail.php

        $html .= "<div class='listContainer times'>";
        // $html .= "<canvas id='canvas" . ($thisCanvas) . "' width='46' height='22' class='monaco'>[*]</canvas> ";
        $html .= "<span class='monaco'>[*]</span> ";
        // $html .= "<a href=''>" . $name . "</a> ";
        $html .= "<a href=''>Calendar</a> ";
        $html .= "</div>";

        $html .= "<div class='listContainer doublewide times'>";

	while ( $myrow  =  MYSQL_FETCH_ARRAY($result) ) {
			
		$html .= "<div class='listContainer twocolumn'>";

                $URL = $myrow["url"];
		$URL = ($URL) ? "$URL" : "artist";

		$html .= "<a href='" . $URL . ".php?id=" . $myrow['objectsId'] . "'>" . $myrow['name1'] . "</a> ";	
		$html .= "<i>" . $myrow['deck'] . "</i>";	
		$html .= "</div>";	

	        $i++;
		if ( $i % 3 == 0) $html .= "<div class='clear'></div>"; 	// clear floats
	}


	// nav bottom

	$html .= "<div class='helvetica small'>";
	$html .= "<a href='calendar' class='instructionContainer'>SEE UPCOMING EVENTS</a>";
	$html .= "<a href='index.php' class='instructionContainer'>GO HOME</a>";
	$html .= "</div>";	
	
        $html .= "</div>";

	echo nl2br($html);
	?>
</div>


<!-- JS -->

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

window.onload=initEmoticons(11, message, delay);
</script>

<?php
require_once("GLOBAL/head.php");
?>



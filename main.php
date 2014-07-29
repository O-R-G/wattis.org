<?php
require_once("GLOBAL/head.php");
?>


<div class="mainContainer times big black">

	<?php
                        
	// SQL object 
	
	$sql = "SELECT objects.id AS objectsId, objects.name1, objects.deck, objects.url FROM 
objects, wires WHERE wires.fromid=(SELECT objects.id FROM objects WHERE name1 LIKE 'Main' AND 
objects.active=1) AND wires.toid = objects.id AND objects.active = '1' AND wires.active = '1' ORDER 
BY objects.rank;";

	$result = MYSQL_QUERY($sql);
	$html = "";
	$i = 0;

	while ( $myrow  =  MYSQL_FETCH_ARRAY($result) ) {
			
		$html .= "<div class='listContainer times'>";
		$html .= "<canvas id='canvas" . ($i+1) . "' width='46' height='22' class='monaco'>[*]</canvas> ";

                $URL = $myrow["url"];
		$URL = ($URL) ? "$URL" : "detail";

		$html .= "<a href='" . $URL . ".php?id=" . $myrow['objectsId'] . "'>" . $myrow['name1'] . "</a> ";	
		$html .= "<i>" . $myrow['deck'] . "</i>";	
		$html .= "</div>";	

	        $i++;
		if ( $i % 3 == 0) $html .= "<div class='clear'></div>"; 	// clear floats
	}

	echo nl2br($html);
	?>


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
require_once("GLOBAL/foot.php");
?>

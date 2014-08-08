<?php
require_once("GLOBAL/head.php");
?>


<div class="mainContainer times big black">

	<?php
                        
        // SQL object

        $sql = "SELECT objects.id, objects.name1, objects.body FROM objects WHERE objects.id = $id AND objects.active = 1;";
        $result = MYSQL_QUERY($sql);
        $myrow  = MYSQL_FETCH_ARRAY($result);
        $rootname = $myrow["name1"];
        $rootbody = $myrow["body"];


	// SQL objects attached to object 

	$sql = "SELECT objects.id AS objectsId, objects.name1, objects.deck, objects.url, objects.begin, 
objects.end FROM objects, wires WHERE wires.fromid=(SELECT objects.id FROM objects WHERE objects.id = 
$id AND objects.active=1) AND wires.toid = objects.id AND objects.active = '1' AND wires.active = '1' 
ORDER BY objects.rank;";

	$result = MYSQL_QUERY($sql);
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

/*

// display archive, very much in process
// problem is that the query nees to get objects that are attached to exhibitions object
// and this is currently used for calendar, so how to do this generically?

// solution:
// flag for showing future or past 
// flag for showing events
// flag for showing exhibitions

// then sorted! although the $id could be hard wired into the calendar object 
// though it will also have to call on the gallery, apartment, on our mind objects
// in which case could troll the whole db for things with dates possibly

// q.e.d.

// format date, then display

// time() gives current time
// then only a matter of comparing begin or end to that

		// archive -- check if end date passed
		// in process 

		$begin = $myrow['begin'];
		$end = $myrow['end'];
		$curtime = time();


if ($end && ($end <= $curtime) ) {

		$beginDisplay = date("Y-m-d H:i:s", strToTime($begin));
		echo $beginDisplay . " - " . $end;
}
*/



		$html .= "<div class='listContainer'>";
		$html .= "<a href='" . $URL . ".php?id=" . $myrow['objectsId'] . "'>" . $myrow['name1'] . "</a> ";	
		$html .= "<i>" . $myrow['deck'] . "</i>";	
		$html .= "</div>";	

	        $i++;
		// if ( $i % 3 == 0) $html .= "<div class='clear'></div>"; 	// clear floats
	}

        $html .= "</div>";

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

window.onload=initEmoticons(1, message, delay);
</script>

<?php
require_once("GLOBAL/foot.php");
?>



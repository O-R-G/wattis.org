<?php
require_once("GLOBAL/head.php");
require_once("_Library/orgRSSParse.php");
?>

<script type="text/javascript" src="JS/animateNewsTicker.js"></script>



<!-- *todo* add homecontainer wrapper -->

<div class="times big black animatePunctuation">

	<?php
                        
	// SQL object 
	
	$sql = "SELECT * FROM objects, wires WHERE wires.fromid=(SELECT objects.id FROM objects WHERE objects.name1 
LIKE 'Home' AND objects.active='1' LIMIT 1) AND wires.toid = objects.id AND objects.active = '1' AND wires.active = 
'1' ORDER BY objects.rank;";
	$result =  MYSQL_QUERY($sql);
	$html = "";

	while ( $myrow  =  MYSQL_FETCH_ARRAY($result) ) {
        	                        	
		$html .= $myrow["body"];	// *todo* wrap in flexible divs		
	}
                       
	echo nl2br($html);

	?>
        
</div>


<!-- JS -->

<script type="text/javascript">

	showRSS("http://www.nws.noaa.gov/data/current_obs/KSFO.rss"); 

</script>


<script type="text/javascript">

	function showBones() {

                window.location.assign("index.php");
        }

</script>


<script type="text/javascript">

                message[1] =    [
                                "---",
                                "=-=",
                                ];

                delay[1] = 400;

               
		message[8] =    [
                                "()",
                                "(.)",
                                "(..)",
                                "(...)"
				];

		delay[8] = 100;

	window.onload=initEmoticons(15, message, delay);

</script>


<?php

	// SQL object
	// get News
	
	$sql = "SELECT objects.id, objects.name1, objects.body, objects.active, objects.rank, wires.active, 
wires.fromid, wires.toid FROM objects, wires WHERE wires.fromid=(SELECT objects.id FROM objects WHERE objects.name1 
LIKE 'News' AND objects.active='1' LIMIT 1) AND wires.toid = objects.id AND objects.active = '1' AND wires.active = 
'1' ORDER BY objects.rank;";
	$result =  MYSQL_QUERY($sql);
	$i = 0;
	$newsItems = array();

	while ( $myrow  =  MYSQL_FETCH_ARRAY($result) ) {
        	                        	
		$newsItems[$i] = $myrow["body"];
		$i++;
	}
                       
?>


<script type="text/javascript">

       	newsItem = new Array(

		<?php
			$i = 0;
 		
			while ( $newsItems[$i] != null ) {
        	                        			
				echo "\"" . $newsItems[$i] . "\"";

				if ( $i < (count($newsItems) -1) ) {

					echo ",\n";
				} else {
					echo "\n";
				}			
				$i++;
			}
		?>
	);
	
	animateNewsTicker(newsItem[0]);

</script>
        

<script type="text/javascript" src="JS/animatePunctuation.js"></script>

<script>
        initPunctuation('animatePunctuation', 200, true);
</script>


<?php
require_once("GLOBAL/foot.php");
?>

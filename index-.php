<?php
require_once("GLOBAL/head.php");
require_once("_Library/orgRSSParse.php");
?>

<script type="text/javascript" src="JS/animateNewsTicker.js"></script>

<?php
	
	// Build weatherString
	// currently using old version of orgRSSParse
	// put this in head.php?

	$weatherString .= orgRSSParse("http://www.nws.noaa.gov/data/current_obs/KSFO.rss");
	$weatherString = str_replace(" at San Francisco Intl Airport, CA", "", $weatherString);
	$weatherString = preg_replace("/\d+/", "$0&deg;", $weatherString);
	$weatherString = str_replace("and", "and currently ", $weatherString);
	$weatherString = "Today, " . strtolower($weatherString) . ".";
?>

<!-- *todo* add homecontainer wrapper -->

<div class="times big black">

	<?php
                        
	// SQL object 
	
	$sql = "SELECT * FROM objects, wires WHERE wires.fromid=(SELECT objects.id FROM objects WHERE objects.name1 LIKE 'Home' AND 
objects.active='1' LIMIT 1) AND wires.toid = objects.id AND objects.active = '1' AND wires.active = '1' ORDER BY objects.rank;";
	$result =  MYSQL_QUERY($sql);
	$html = "";

	while ( $myrow  =  MYSQL_FETCH_ARRAY($result) ) {
        	                        	
        	if (strpos($myrow["body"],"*weatherstring*")) {
		
			$myrow["body"] = str_replace("*weatherstring*", $weatherString, $myrow["body"]);
		} 

		$html .= $myrow["body"];	// *todo* wrap in flexible divs		
	}
                       
	echo nl2br($html);

	?>
        
</div>


<!-- JS -->

<script type="text/javascript">

	function showBones() {
                window.location.assign("index.php");
        }

</script>


<script type="text/javascript">

                message[1] =    [
                                "----------",
                                "=-=-=-=-=-",
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


<script type="text/javascript">

       	newsItem = new Array(
			"The exhibition opens <a href='artist.php?id=32'>tomorrow</a>.",
			"*New* limited edition from Ed Ruscha — <a href='griddetail.php?id=33'>get it now</a>!",
			"<a href='artist.php?id=92'>Friday</a>, we are showing Joan Jonas films. Come."
			);
	
	animateNewsTicker(newsItem[0]);

</script>
        


<?php
require_once("GLOBAL/foot.php");
?>


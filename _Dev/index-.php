<?php
require_once("GLOBAL/head.php");
require_once("_Library/orgRSSParse.php");
?>


<script type="text/javascript">

	function showBones() {
                window.location.assign("index.php");
        }
	
</script>




<?php
	
	// Build weatherString
	// currently using old version of orgRSSParse

	$weatherString .= orgRSSParse("http://www.nws.noaa.gov/data/current_obs/KSFO.rss");
	$weatherString = str_replace(" at San Francisco Intl Airport, CA", "", $weatherString);
	$weatherString = str_replace(" F", "&deg;", $weatherString);
	$weatherString = str_replace("and", "and currently ", $weatherString);
	$weatherString = "Today it is " . strtolower($weatherString);
?>


<!-- *todo* add homecontainer wrapper -->
<div class="times big black">

	<?php
                        
	// SQL object 
	
	$sql = "SELECT * FROM objects, wires WHERE wires.fromid='1' AND wires.toid = objects.id 
AND objects.active = '1' AND wires.active = '1' ORDER BY objects.rank;";
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
        
<!-- DATE -->

<div class="dateContainer helvetica small">
	CCA WATTIS INSTITUTE FOR CONTEMPORARY ARTS<br />360 KANSAS STREET / SAN FRANCISCO CA 94103<br />
	20142615
</div>

</div>


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

window.onload=initEmoticons(16, message, delay);
</script>

        
<script type="text/javascript" src="JS/newsTicker.js"></script>


</div>
</body>
</html>

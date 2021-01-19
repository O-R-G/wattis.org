<!-- BLOCKS -->
<div class="homeContainer times big"><?

$rootname = 'Home';

// SQL objects attached to root by name
$sql = "SELECT 
			objects.id, objects.name1,
			objects.body, objects.url, 
			objects.begin, objects.end 
		FROM 
			objects, wires 
		WHERE 
			wires.fromid IN
			(
				SELECT objects.id 
				FROM objects 
				WHERE 
					objects.name1 LIKE '$rootname' 
					AND objects.active = 1
			) 
			AND objects.name1 NOT LIKE '.%' 
			AND wires.toid = objects.id 
			AND objects.active = '1' 
			AND wires.active = '1' 
		ORDER BY objects.rank;";

$res = $db->query($sql);
if(!$res)
	throw new Exception($db->error);
$items = array();
while ($obj = $res->fetch_assoc())
	$items[] = $obj;
$res->close();
// var_dump(count($items));
// foreach($items as $item)
// {
// 	var_dump($item);
// }
foreach($items as $key =>$item)
{
	if($key == 0){
		// var_dump($item);
		?><div class = 'logoContainer'><?= nl2br($item["body"]); ?></div><?
	}
	else
	{
		if(!$isMobile)
		{
			$randomPadding = rand(0, 150);
			$randomWidth = rand(10, 35);
			$randomMargin = rand(30, 80);
			$randomFloat = (rand(0, 1) == 0) ? 'left' : 'right';
		}
		else
		{
			$randomPadding = rand(0, 30);
			$randomWidth = rand(30, 80);
			$randomMargin = rand(20, 50);
			$randomFloat = (rand(0, 1) == 0) ? 'left' : 'right';
		}
		?><div class = 'blockContainer' style='width:<?= $randomWidth; ?>%; float: <?= $randomFloat; ?>; padding-top:<?= $randomPadding; ?>px; margin: <?= $randomMargin; ?>px'><?= nl2br($item['body']); ?></div><?
	}
}

?></div>

<!-- WEATHER -->
<script type="text/javascript">
el = document.getElementById("rss");
if(!!el)
{
	// requires <element id="rss">
	showRSS(el, "http://www.nws.noaa.gov/data/current_obs/KSFO.rss");
}
</script>

<!-- NEWS --> 
<script type="text/javascript" src="/static/js/animateNewsTicker.js"></script>
<script type="text/javascript">

	<?
		// SQL object with attached (News)
		// could be written into main query with LEFTJOIN
		$sql = "SELECT objects.id, objects.name1, objects.body, objects.active, objects.rank, wires.active, 
	wires.fromid, wires.toid FROM objects, wires WHERE wires.fromid=(SELECT objects.id FROM objects WHERE objects.name1 
	LIKE 'News' AND objects.active='1' LIMIT 1) AND wires.toid = objects.id AND objects.active = '1' AND wires.active = 
	'1' ORDER BY objects.rank;";

	$res_news = $db->query($sql);
	if(!$res_news)
		throw new Exception($db->error);
	$items = array();
	while ($obj = $res_news->fetch_assoc())
		$items[] = $obj;
	$res_news->close();
	foreach($items as $item){
		$newsItems[$i] = $item["body"];
		
	}
	?>
   	newsItem = new Array(
		<?

			foreach($newsItems as $key => $item){
				echo "\"" . $item . "\"";

				if ( $key < (count($newsItems) -1) )
					echo ",\n";
				else
					echo "\n";
			}
			// $i = 0;
 		
			// while ( $newsItems[$i] != null ) {
        	                        			
			// 	echo "\"" . $newsItems[$i] . "\"";

			// 	if ( $i < (count($newsItems) -1) ) {

			// 		echo ",\n";
			// 	} else {

			// 		echo "\n";
			// 	}			
			// 	$i++;
			// }
		?>
	);

	animateNewsTicker(newsItem[0]);
</script>
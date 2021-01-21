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

// $greeting_id = end($oo->urls_to_ids(array('home', 'hi-visitor')));
// $greeting_item = $oo->get($greeting_id);
// array_unshift($items, $greeting_item);
// var_dump(count($items));
// foreach($items as $item)
// {
// 	var_dump($item);
// }
foreach($items as $key =>$item)
{
	$display = false;
	if($key == 1){
		// var_dump($item);
		?><div class = 'logoContainer' style = '<?= $display ? "display:block" : "display: none" ?>;'><?= nl2br($item["body"]); ?><div class = 'continue-btn small helvetica'>CONTINUE</div></div><?
	}
	else
	{
		
		if($key == 0)
			$display = true;
		?><div class = 'blockContainer' style='<?= $display ? 'display:block' : 'display: none' ?>;'><?= nl2br($item['body']); ?><div class = 'continue-btn small helvetica'>CONTINUE</div></div><?
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
	foreach($items as $key => $item){
		$newsItems[$key] = $item["body"];
		
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
		?>
	);

	animateNewsTicker(newsItem[0]);

	
</script>
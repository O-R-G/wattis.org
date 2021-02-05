<!-- BLOCKS -->

<div class="homeContainer times big" stage = '0'><?

$rootname = 'Home';

// SQL objects attached to root by name
// $sql = "SELECT 
// 			objects.id, objects.name1,
// 			objects.body, objects.url, 
// 			objects.begin, objects.end 
// 		FROM 
// 			objects, wires 
// 		WHERE 
// 			wires.fromid IN
// 			(
// 				SELECT objects.id 
// 				FROM objects 
// 				WHERE 
// 					objects.name1 LIKE '$rootname' 
// 					AND objects.active = 1
// 			) 
// 			AND objects.name1 NOT LIKE '.%' 
// 			AND wires.toid = objects.id 
// 			AND objects.active = '1' 
// 			AND wires.active = '1' 
// 		ORDER BY objects.rank;";

// $res = $db->query($sql);
// if(!$res)
// 	throw new Exception($db->error);
// $items = array();
// while ($obj = $res->fetch_assoc())
// 	$items[] = $obj;
// $res->close();

$welcome_id = end($oo->urls_to_ids(array('home', 'welcome')));
$welcome_children = $oo->children($welcome_id);
$spotlight_id = end($oo->urls_to_ids(array('home', 'spotlight')));
$spotlight_children = $oo->children($spotlight_id);
foreach($welcome_children as $child)
{
	?><div class = 'blockContainer'><?= $child["body"]; ?></div><?
}
foreach($spotlight_children as $child)
{
	?><div class = 'blockContainer'><?= $child["body"]; ?></div><?
	if(!strictEmpty($child['deck']))
	{
		$img_src_arr = explode(',', $child['deck']);
		$caption = strictClean($child['notes']);
		?><div class = 'blockContainer imageBlock'><? foreach($img_src_arr as $src){
			$this_src = strictClean($src);
			?><img src = '/media/<?= $this_src ; ?>'><?
		} ?><div class = 'captionContainer monaco small'><?= $caption; ?></div></div><?
	}
}
// die();


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

	// animateNewsTicker(newsItem[0]);

	var sContainers = document.querySelectorAll('.homeContainer .logoContainer, .homeContainer .blockContainer');
	var sHomeContainer = document.querySelector('.homeContainer');
	var sContibue_btn = document.getElementsByClassName('continue-btn');
	var homePlaying = true;


	function nextPage(current_stage){
		sContainers[current_stage].style.display = 'none';
		current_stage++;
		if(current_stage > sContainers.length - 1)
			current_stage = 0;
		sContainers[current_stage].style.display = 'block';
		sHomeContainer.setAttribute('stage', current_stage);
	}
	var timer = setInterval(function(){
		var current_stage = sHomeContainer.getAttribute('stage');
		nextPage(current_stage);
	}, 3000);
	window.addEventListener('keydown', function(e){
		if(e.keyCode == '39')
		{
			var current_stage = sHomeContainer.getAttribute('stage');
			nextPage(current_stage);
		}
		else if(e.keyCode == '32')
		{
			if(homePlaying)
			{
				clearInterval(timer);
				homePlaying = false;
			}
			else
			{
				timer = setInterval(function(){
					var current_stage = sHomeContainer.getAttribute('stage');
					nextPage(current_stage);
				}, 3000);
				homePlaying = true;
			}
		}
	});
</script>
<!-- BLOCKS -->
<div class="homeContainer times big"><?

$rootname = 'Home';
$temp = $oo->urls_to_ids(array('home'));
$home_id = end($temp);
$items = $oo->children($home_id);
foreach($items as $key =>$item)
{
	if($key == 0){
        /*

            first item under Home is The Wattis Institute, which includes 
            the logo and the land acknowledgment. 'logoContainer' also is 
            already written in views/nav so ** fix **
        */
		// var_dump($item);
		?><div id = 'logo_text' class='logo_text_container'><?= nl2br($item["body"]); ?></div><?
	}
	else if(substr($item['name1'], 0, 1) != '.')
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
		if($item['url'] == 'random-sentences')
		{
			$search_bold = !isset($_GET['random']);
			$randomRecords = getRandomRecords();
			?><div id="random-records-container" class = 'blockContainer' style='width:<?= $randomWidth; ?>%; float: <?= $randomFloat; ?>; padding-top:<?= $randomPadding; ?>px; margin: <?= $randomMargin; ?>px'><?
			$fetched_ids_arr = array();
			$a_pattern = '/<a\s.*?(?:href.*?=.*?[\'"].*?[\'"].*?)?>(.*?)<\/a>/is';
			foreach($randomRecords['all'] as $record)
			{
				$this_url = getCompleteUrl($record['id']);
				$fetched_ids_arr[] = $record['id'];
				if($record['image'])
				{
					?><div class="blockContainer displaying_image"><a href="<?php echo $this_url; ?>" class = ''><img src="<?= $record['image']; ?>"></a></div><?
				}
				else
				{
					// $this_text = $record["sentence"];
					$this_text = preg_replace($a_pattern, '<span class="pseudo-link">$1</span>', $record["sentence"]);

					?><div class="blockContainer"><a class="block_link" href="<?php echo $this_url; ?>" class = ''><div id = 'paragraph'><?= $this_text; ?></div></a></div><?
				}
			}
			?></div><?
		}
		else
		{
			?><div class = 'blockContainer' style='width:<?= $randomWidth; ?>%; float: <?= $randomFloat; ?>; padding-top:<?= $randomPadding; ?>px; margin: <?= $randomMargin; ?>px'><?= nl2br($item['body']); ?></div><?
		}
		
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
	$news_id = end($oo->urls_to_ids(array('home', 'news')));
	$items = $oo->children($news_id);
	foreach($items as $key => $item)
		$newsItems[$key] = addslashes(strictClean($item["body"]));
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

	var randomRecords = <?= json_encode($randomRecords); ?>;
	var randomRecords_all = randomRecords['all'];
	var randomRecords_image = randomRecords['image'];
	var fetched_ids_arr = <?= isset($fetched_ids_arr) ? json_encode($fetched_ids_arr) : '[]'; ?>;
	var isFullyLoaded = false;
	var isRandom = !<?= json_encode($search_bold)?>;
	// var blockContainer = document.getElementsByClassName('blockContainer');
	var randomRecord = document.querySelectorAll('#random-records-container ');

	function nextPage(idx){
		blockContainer[idx].style.display = 'none';
		idx++;
		if(idx > records_length - 2 && !isFullyLoaded)
		{
			loadMore(fetched_ids_arr);
			records_length = document.getElementsByClassName('blockContainer').length;
		}
		if(idx > records_length - 1)
			idx = 0;
		blockContainer[idx].style.display = 'block';
		return idx;
	}
	function previousPage(idx){
		blockContainer[idx].style.display = 'none';
		idx--;
		if(idx < 0)
			idx = records_length - 1;
		blockContainer[idx].style.display = 'block';
		return idx;
	}
	function preloadImage(img, array_of_src, idx = 0, limit = false){
		img.onload = function(){
			if(limit)
			{
				if(limit == 1)
					return true;
				else{
					limit--;
					idx++;
					if(idx < array_of_src.length)
						preloadImage(img, array_of_src, idx, limit);
					else
						return false;
				}
			}
		};
		img.src = array_of_src[idx];		
	}
	var preload_image = new Image;
	var preload_idx = 0;
	var test = preloadImage(preload_image, randomRecords_image, preload_idx, 10);

	var timer = setInterval(function(){
		current_index = nextPage(current_index);
		if(current_index == 30){
			preload_idx = 11;
			preloadImage(preload_image, randomRecords_image, preload_idx, 10);
		}
		else if(current_index == 70)
		{
			preload_idx = 11;
			preloadImage(preload_image, randomRecords_image, preload_idx, 10);
		}
	}, 5000);
</script>

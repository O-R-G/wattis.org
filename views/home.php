<!-- BLOCKS -->
<div class="homeContainer times big"><?php

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
		?><div id = 'logo_text' class='logo_text_container'><?php echo nl2br($item["body"]); ?></div><?php
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
</script>

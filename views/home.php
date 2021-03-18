<?
	// search for bold is default behavior
	$rootname = 'Home';
	// $search_random = !(isset($_GET['random']));
	$randomRecords = getRandomRecords($search_random);
	$logo_id = end($oo->urls_to_ids(array('home', 'the-wattis-institute')));
	$logo_item = $oo->get($logo_id);
?>

<!-- BLOCKS -->
<div class="homeContainer times big">
	<!-- <div class = 'blockContainer'><img><div id = 'paragraph'><?= $randomRecords['all'][0]["sentence"]; ?></div></div> -->
	<div class = 'blockContainer'><div id = 'paragraph'>.+*The Wattis Institute</div></div>
	<? foreach($randomRecords['all'] as $record){
		if($record['image'])
		{
			?><div class = 'blockContainer displaying_image'><img src="<?= $record['image']; ?>"></div><?
		}
		else
		{
			?><div class = 'blockContainer'><div id = 'paragraph'><?= $record["sentence"]; ?></div></div><?
		}
		?><?
	} ?>
</div>
<div id="_click"></div>

<!-- WEATHER -->
<script type="text/javascript">
el = document.getElementById("rss");
if(!!el) {
	// requires <element id="rss">
	showRSS(el, "http://www.nws.noaa.gov/data/current_obs/KSFO.rss");
}

	var homePlaying = true;
	var block = document.querySelector('.homeContainer .blockContainer');
	var image = block.querySelector('img');
	var paragraph = block.querySelector('#paragraph');
	var randomRecords = <?= json_encode($randomRecords); ?>;
	var randomRecords_all = randomRecords['all'];
	var randomRecords_image = randomRecords['image'];
	var current_index = 0;
	var records_length = randomRecords_all.length;
	var randomRecords_bold = <?= json_encode($randomRecords_bold); ?>;
	var blockContainer = document.getElementsByClassName('blockContainer');
	console.log(records_length);

	function nextPage(idx){
		blockContainer[idx].style.display = 'none';
		idx++;
		if(idx > records_length - 1)
			idx = 0;
		blockContainer[idx].style.display = 'block';
		// var current_record = randomRecords_all[idx];
		// if(current_record['image'])
		// {
		// 	block.classList.add('displaying_image');
		// 	image.src = current_record['image'];
		// }
		// else{
		// 	block.classList.remove('displaying_image');
		// 	paragraph.innerHTML = current_record['sentence'];
		// }
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
	window.addEventListener('keydown', function(e){
		if(e.keyCode == '39') {
			current_index = nextPage(current_index);
		} else if(e.keyCode == '32') {
			if(homePlaying) {
				clearInterval(timer);
				homePlaying = false;
			} else {
				timer = setInterval(function(){
					current_index = nextPage(current_index);
				}, 5000);
				homePlaying = true;
			}
		}
	});
	var s_click = document.getElementById('_click');
	s_click.addEventListener('click', function(){
			clickHandler();
	});
</script>

<?
	// search for bold is default behavior
	$rootname = 'Home';
	$search_bold = !isset($_GET['random']);
	$randomRecords = getRandomRecords($search_bold);
	$logo_id = end($oo->urls_to_ids(array('home', 'the-wattis-institute')));
	$logo_item = $oo->get($logo_id);

	$urgent_id = end($oo->urls_to_ids(array('home', 'urgent')));
	$urgent_children = $oo->children($urgent_id);

?>

<!-- BLOCKS -->
<div class="homeContainer times big">
	<? 
		if(count($urgent_children) > 0){
			foreach($urgent_children as $child){
				if(substr($child['name1'], 0, 1) != '.')
				{
					$this_url = getCompleteUrl($child['id']);
					?><div class="blockContainer"><a href="<?php echo $this_url; ?>" class = ''><div id = 'paragraph'><?= $child["body"]; ?></div></a></div><?
				}
			}
		} 
		foreach($randomRecords['all'] as $record){
		$this_url = getCompleteUrl($record['id']);
		if($record['image'])
		{
			?><div class="blockContainer displaying_image"><a href="<?php echo $this_url; ?>" class = ''><img src="<?= $record['image']; ?>"></a></div><?
		}
		else
		{
			?><div class="blockContainer"><a href="<?php echo $this_url; ?>" class = ''><div id = 'paragraph'><?= $record["sentence"]; ?></div></a></div><?
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

	/* 
		laptop keyboard control
	*/
	window.addEventListener('keydown', function(e){
		if(e.keyCode == '39') {
			current_index = nextPage(current_index);
		} 
		else if(e.keyCode == '37'){
			current_index = previousPage(current_index);
		}else if(e.keyCode == '32') {
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
	/* 
		end laptop keyboard control
	*/

	/* 
		mobile swipe control
	*/
	document.addEventListener('touchstart', handleTouchStart, false);        
	document.addEventListener('touchmove', handleTouchMove, false);

	var xDown = null;                                                        
	var yDown = null;

	function getTouches(evt) {
	  return evt.touches ||             // browser API
	         evt.originalEvent.touches; // jQuery
	}                                                     

	function handleTouchStart(evt) {
	    const firstTouch = getTouches(evt)[0];                                      
	    xDown = firstTouch.clientX;                                      
	    yDown = firstTouch.clientY;                                      
	};                                                

	function handleTouchMove(evt) {
	    if ( ! xDown || ! yDown ) {
	        return;
	    }

	    var xUp = evt.touches[0].clientX;                                    
	    var yUp = evt.touches[0].clientY;

	    var xDiff = xDown - xUp;
	    var yDiff = yDown - yUp;

	    if ( Math.abs( xDiff ) > Math.abs( yDiff ) ) {/*most significant*/
	        if ( xDiff > 0 ) {
	            /* left swipe */ 
	            console.log('left');
	            current_index = nextPage(current_index);
	        } else {
	            /* right swipe */
	            console.log('right');
	            current_index = previousPage(current_index);
	        }                       
	    } 
	    /* reset values */
	    xDown = null;
	    yDown = null;                                             
	};
	/* 
		end mobile swipe control
	*/

	var s_click = document.getElementById('_click');
	s_click.addEventListener('click', function(){
			clickHandler();
	});
</script>

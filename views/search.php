<?
// $o = $oo->get($uu->id);
$hasQuery = false;
if (isset($_GET['query']) && $_GET['query'] != 'Search for...') {
  $query = $_GET['query'];
  $query_json = str_replace(' ', '+', $query);
  if(!empty($query))
  	$hasQuery = true;
}

/* config */

// limit loading if nothing
$no_results_error = '<div class = "big">The search query did not return any results.<br />Please <a href="/?displaysearch=true" onclick="show_search();focusSearchInput();">try again</a>.</div>';

?><div id='searchContainer' class = ''><? 
    if($hasQuery){
		$children = build_children_search($oo, $ww, $query);
		if(count($children) > 0) {
			?><div class = 'search-item big'><?
			foreach($children as $child){ 
				if(substr($myrow['name1'], 0, 1) != '.'){
					$URL = $myrow["url"];
					$URL = ($URL) ? "/calendar/".$URL : "view_?id=".$child['id'];
				?><a href = "<?= $URL; ?>"><?= $child['name1']; ?></a></div><div class = 'search-item big'><? 
				}
			}
			?></div><?
		} else {
			echo $no_results_error;
		}
	} else {
		echo $no_results_error;
	}
?></div>

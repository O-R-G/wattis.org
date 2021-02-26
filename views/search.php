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

// $roots = build_roots($oo, 0);
// $root_name = $uri[1];
// $page_name = $o['name1'];
// $page_name = trim_prefixes($page_name);
// $media = $oo->media($uu->id);


// limit loading if nothing

$no_results_error = '<div class = "big">The search query did not return any results.<br />Please <a href="/?displaysearch=true" onclick="show_search();focusSearchInput();">try again</a>.</div>';
function build_children_search($oo, $ww, $query) {
  $children_combined = array();
  // $recordings_id = end($oo->urls_to_ids(array('recordings')));
  $query = preg_replace('/[^a-z0-9]+/i', ' ', $query);
  $query = addslashes($query);
  $query = strtolower($query);
  $query = str_replace(' ', '%', $query);
  // search
  $fields = array("objects.*");
  $tables = array("objects", "wires");
  $where  = array("objects.active = '1'",
                  "(LOWER(CONVERT(BINARY objects.name1 USING utf8mb4)) LIKE '%" . $query .
                  "%' OR LOWER(CONVERT(BINARY objects.deck USING utf8mb4)) LIKE '%" . $query . "%')",
                  "objects.name1 NOT LIKE '.%'",
                  // "objects.name1 NOT LIKE '_%'",
                  "wires.toid = objects.id",
                  // "wires.fromid = '".$recordings_id."'",
                  "wires.active = '1'");
  $order  = array("objects.name1", "objects.begin", "objects.end");
  $children = $oo->get_all($fields, $tables, $where, $order);
  // preprocess to remove any thing we dont want to show

  // sort by ranking and then end date
  // usort($children_combined, function($a, $b) {
  //   if ($a['root']['ranking'] != $b['root']['ranking']) {
  //     return $a['root']['ranking'] <=> $a['root']['ranking'];
  //   } else {
  //     return $b['end'] <=> $a['end'];
  //   }
  // });

  return $children;
}
?>
<div id='searchContainer' class = ''>
	<? if($hasQuery){
		$children = build_children_search($oo, $ww, $query);
		if(count($children) > 0)
		{
			?><div class = 'search-item big'><?
			foreach($children as $child){ 
				if(substr($myrow['name1'], 0, 1) != '.'){
					$URL = $myrow["url"];
					$URL = ($URL) ? "/calendar/".$URL : "view_?id=".$child['id'];
				?><a href = "<?= $URL; ?>"><?= $child['name1']; ?></a></div><div class = 'search-item big'><? 
				}
			}
			?></div><?
		}
		else
		{
			echo $no_results_error;
		}
	?>

	<?
	}else{
		echo $no_results_error;
	} ?>
</div>
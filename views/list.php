<?php
	// if($uri[1] == 'calendar')
	// {
	// 	$ids = $oo->urls_to_ids(array('calendar'));
	//     $id = $ids[0];
	// }
	$rootid = $ids[0];
	if($uri[1] == 'archive')
		$rootid = $oo->urls_to_ids(array('gallery'))[0];
	$root_item = $oo->get($rootid);
	$children = $oo->children($rootid);
	$rootname = nl2br($root_item["name1"]);
?>
<div class="mainContainer times big">
	<div class='listContainer times'><?= $rootname; ?></div>
	<div class='listContainer doublewide times'>
	<?php
		foreach($children as $key => $child){
			if (substr($child['name1'], 0, 1) != '.') {
				$url = $child["url"];
				$url = ($url) ? "/calendar/".$url : "view_";

				$now = time();
				$begin = ($child['begin'] != null) ? strtotime($child['begin']) : $now;
				$end = ($child['end'] != null) ? strtotime($child['end']) : $now;
				if ($alt && ($end < $now)) {
					// archive
					?>
						<div class='listContainer'>
							<a href='<?= $url; ?>'><?= $child['name1']; ?></a> 
							<i><?= $child['deck']; ?></i>
						</div>
					<?
				} else if (!$alt && (($begin >= $now) || ($end >= $now))) {
					// upcoming
					?>
						<div class='listContainer'>
							<a href='<?= $url; ?>'><?= $child['name1']; ?></a> 
							<i><?= $child['deck']; ?></i>
						</div>
					<?
				} 

			}
		}
	?>
</div>
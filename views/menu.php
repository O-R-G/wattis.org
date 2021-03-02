<?
	$main_id = end($oo->urls_to_ids(array('main')));
	$id = $main_id;
	$items = $oo->children($main_id);
?>
<div class="mainContainer times big">
	<?php
    foreach($items as $key => $item)
	{
		if(substr($item['name1'], 0, 1) != '.')
		{
			$URL = $item["url"];
			$URL = ($URL) ? "$URL" : "view_?id=".$item['objectsId'];
			?><div class='listContainer times'>
				<a href = '<?= $URL; ?>'><?= $item['name1']; ?></a>
				<i><?= $item['deck']; ?></i>
			</div>
			<?
			if($key > 0 && $key % 3 == 2){
				?><div class = 'clear'></div><?
			}
		}
	}
	?>
</div>

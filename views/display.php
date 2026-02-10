<?
	require_once('static/php/displayMedia.php');
	$rootid = $ids[1];
	$root_item = $oo->get($rootid);
	$rootname = $root_item["name1"];
	$rootbody = $root_item['body'] ? $root_item['body'] : '';
	$children = $oo->children($rootid);
	$previous_id = '';

	$submenu = array();
	$hasFilter = false;
	if($uri[1] === 'shop') {
		$catalogues_id = $uu->ids[0];
		$submenu = $oo->children($catalogues_id);
		$current = count($uri) === 2 ? $submenu[0] : $item;
		$submenu_base_url = '/' . $uri[1] . '/';
		$children = $oo->children($current['id']);
		foreach($submenu as &$submenu_item) {
			$submenu_item['name'] = $submenu_item['name1'];
			$submenu_item['slug'] = $submenu_item['url'];
		}
		unset($submenu_item);
		$hasFilter = true;
	}

?>
		<div class="mainContainer times big">
			<?php if($hasFilter):?>
			<div id = 'filter_container' class="helvetica medium"><?php
				?><div id="filter-shop" class="filter right-filter">
					<ul id='yearsContainer'>Filters: 
						<?
						$temp = $uri;
						array_pop($temp);
						// $submenu_base_url = implode('/', $temp);
						foreach ($submenu as $key => $s)
						{
							$isActive = $s['id'] === $current['id'];
							$this_name = ucfirst($s['name']);
							$params = $_GET;
							if($isActive) unset($params['program']);
							else $params['program'] = $s['slug'];
							// $this_url = $base_url . glue_query_params($params);
							$this_url = $submenu_base_url .  $s['slug'];
							?><li class="sans year <?= $isActive ? 'active' : ''; ?>"><a class='year-btn' href="<?= $this_url; ?>"><?= $this_name; ?></a></li><? 
							if($key != count($submenu) - 1)
							{ ?> or <? }
						}
					?></ul>
				</div>
			</div>
			<?php endif; ?>
			<div class='listContainer times side-listContainer'><?= $rootname; ?><br><br><?= $rootbody; ?><br><br></div><div class = 'listContainer displayContainer main-listContainer'>
			<?
			if(!empty($children))
			{
				$i = 0;
				$base_url = $uri[1] === 'shop' ? '/' . $uri[1] . '/' . $current['url'] . '/' : '/' . $uri[1] . '/';
				foreach($children as $child)
				{
					$media = $oo->media($child['id']);
					if($child['id'] != $previous_id)
					{
						if(!empty($media))
						{
							$m = $media[0];
		                    $mediaFile = m_url($m);
		                    $mediaCaption = clean_caption(strip_tags($m["caption"]));
		                    $mediaStyle = "width: 100%;";
		                    if($key == 0)
		                    {
		                        $mediaFile_temp = "media/". m_pad($m['id']) .".". $m["type"];
		                        $specs  = getimagesize($mediaFile_temp);
		                        $use4xgrid = ($rootname == "Buy Catalogs");  
		                    }
		                    ?><a class="display-item listContainer <?= (($use4xgrid) ? "fourth-with" : "half-width"); ?>" href='<?= $base_url . $child['url']; ?>'>
		                    	<div id='image<?= $i; ?>' class = ' '>
		                    		<?= displayMedia($mediaFile, $mediaCaption, $mediaStyle); ?>
		                    		<div class = 'captionContainer helvetica small'><?= $child['name1']; ?></div>
		                    	</div>
		                    </a><?
		                	$i++;
						}
						$previous_id = $child['id'];
					}
				}
			}
			?></div>
			<?

			// // name

			// $html .= "<div class='listContainer times'>";
		 //        $html .= $rootname;
			// $html .= "<br /><br />" . $rootbody .  "<br /><br />";
			// $html .= "</div>";	

		   
			// // images
			
			// $html .= "<div class = 'listContainer doublewide'>";
			// if(!empty($images))
			// {
			// 	for ( $j = 0; $j < count($images); $j++) {
			// 		$html .= $images[$j];
			// 	}
			// }
			

			// $html .= "</div>";
			// echo nl2br($html);
			?>
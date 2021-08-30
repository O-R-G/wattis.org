<?
	require_once('static/php/displayMedia.php');
	$rootid = $ids[1];
	$root_item = $oo->get($rootid);
	$rootname = nl2br($root_item["name1"]);
	$rootbody = nl2br($root_item['body']);
	$children = $oo->children($rootid);
	$previous_id = '';
?>
		<div class="mainContainer times big">

			<?php
				// if($uri[1] == 'editions')
				// {
				// 	$ids = $oo->urls_to_ids(array('main', 'editions'));
				// 	unset($ids[0]);
				// 	$ids = array_values($ids);
				// 	$id = $ids[0];
				// }
				// elseif($uri[1] == 'catalogues')
				// {
				// 	$ids = $oo->urls_to_ids(array('main', 'catalogues'));
				// 	unset($ids[0]);
				// 	$ids = array_values($ids);
				// 	$id = $ids[0];
				// }
				
				
		        // SQL objects attached to object plus media plus rootname, rootbody

		// 	$sql = "SELECT objects.id AS objectsId, objects.name1, objects.deck, objects.body, objects.rank, (SELECT 
		// objects.name1 FROM objects WHERE objects.id = $rootid) AS rootname, (SELECT objects.body FROM objects WHERE objects.id = 
		// $rootid) AS rootbody, wires.fromid, wires.toid, media.id AS mediaId, media.object, media.caption, media.type, media.active 
		// AS mediaActive FROM wires, objects LEFT JOIN media ON objects.id = media.object AND media.active = 1 WHERE wires.fromid = 
		// (SELECT objects.id FROM objects WHERE objects.id = $id AND objects.active = 1) AND wires.toid=objects.id AND wires.active = 
		// 1 ORDER BY objects.rank, media.rank;";

			// $result = MYSQL_QUERY($sql);
		 //    $myrow = MYSQL_FETCH_ARRAY($result);
		 //    $rootname = $myrow['rootname'];
		 //    $rootbody = $myrow['rootbody'];
		 //    mysql_data_seek($result, 0);    // reset to row 0
			// $html = "";
			// $i=0;

			// collect images

			// while ( $myrow  =  MYSQL_FETCH_ARRAY($result) ) {

			// 	if ($myrow['objectsId'] != $previous_objectsId) { 

			// 		if ($myrow['mediaActive'] != null) {
			
			// 			$mediaFile = "MEDIA/". str_pad($myrow["mediaId"], 5, "0", STR_PAD_LEFT) .".". $myrow["type"];
			// 			$mediaCaption = strip_tags($myrow["caption"]);
			// 			$mediaStyle = "width: 100%;";
			
			//                 	if ( $i == 0 ) {
			
			// 				$specs  = getimagesize($mediaFile);
			// 				// $use4xgrid = (($specs[0]/$specs[1]) < 1) ? TRUE : FALSE;		       
			// 				$use4xgrid = ($rootname == "Buy Catalogs") ? TRUE : FALSE;		       
			//                 	}
			
			// 			$images[$i] .= "<a href='buy_.php?id=" . $rootid . "," . $myrow['objectsId'] . "'>";
			// 			$images[$i] .= "<div id='image".$i."' class = 'listContainer " . (($use4xgrid) ? "fourcolumn" : "twocolumn") . "'>";
			// 			$images[$i] .= displayMedia($mediaFile, $mediaCaption, $mediaStyle);
			// 			$images[$i] .= "<div class = 'captionContainer helvetica small'>";
			// 			$images[$i] .= $myrow['name1'];
			// 			$images[$i] .= "</div>";
			// 			$images[$i] .= "</div>";
			// 			$images[$i] .= "</a>";
					
			// 			if ( ( $i+1) % (($use4xgrid) ? 4 : 2) == 0) $images[$i] .= "<div class='clear'></div>";
		 //             			$i++;
			// 		}
			// 		$previous_objectsId = $myrow['objectsId'];
			// 	}
			// }
			?>
			<div class='listContainer times side-listContainer'><?= $rootname; ?><br><br><?= $rootbody; ?><br><br></div><div class = 'listContainer displayContainer main-listContainer'>
			<?
			if(!empty($children))
			{
				$i = 0;
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
		                    ?><a class="display-item listContainer <?= (($use4xgrid) ? "fourth-with" : "half-width"); ?>" href='/<?= $uri[1] . '/' . $child['url']; ?>'>
		                    	<div id='image<?= $i; ?>' class = ' '>
		                    		<?= displayMedia($mediaFile, $mediaCaption, $mediaStyle); ?>
		                    		<div class = 'captionContainer helvetica small'><?= nl2br($child['name1']); ?></div>
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
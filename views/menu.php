<div id="animatePunctuation" class="animatePunctuation">
    <div id="color" class="white">
	<div class="mainContainer times big">

		<?php
	                        
		// SQL object 
		$rootid = end($oo->urls_to_ids(array('main')));
		$id = $rootid;
		$sql = "SELECT objects.id AS objectsId, objects.name1, objects.deck, objects.url FROM objects, 
	wires WHERE wires.fromid=(SELECT objects.id FROM objects WHERE objects.id=$id AND objects.active=1) AND 
	wires.toid = objects.id AND objects.active = '1' AND wires.active = '1' AND objects.name1 NOT LIKE '.%' ORDER BY objects.rank;";

		$result = $db->query($sql);
		if(!$result)
			throw new Exception($db->error);
		$items = array();
		while ($obj = $result->fetch_assoc())
			$items[] = $obj;
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
		// $html = "";
		// $i = 0;

	 //        while ( $myrow  =  MYSQL_FETCH_ARRAY($result) ) {

		// 	if ($myrow['name1'][0] != '.') {

		// 		$html .= "<div class='listContainer times'>";
		// 		// $html .= "<canvas id='canvas" . ($i+1) . "' width='46' height='22' class='monaco'>[*]</canvas> ";

	 //                	$URL = $myrow["url"];
		// 		$URL = ($URL) ? "$URL" : "view_";
		
		// 		$html .= "<a href='" . $URL . ".php?id=" . $myrow['objectsId'] . "'>" . $myrow['name1'] . "</a> ";	
		// 		$html .= "<i>" . $myrow['deck'] . "</i>";	
		// 		$html .= "</div>";	

		//         	$i++;
		// 		if ( $i % 3 == 0) $html .= "<div class='clear'></div>"; 	// clear floats

		// 	}
		// }

		// echo nl2br($html);
		?>
	</div>
</div>

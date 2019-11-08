<?php
require_once("GLOBAL/head.php");
?>

<div class="mainContainer times big">

	<?php

        // get Library base_id

        $sql = "SELECT objects.id, objects.name1 FROM objects WHERE objects.name1 LIKE 'Library%' AND objects.active=1 LIMIT 1;";
        $result = MYSQL_QUERY($sql);
        while ($myrow = MYSQL_FETCH_ARRAY($result)) {
            $base_id = $myrow['id'];
            $base_name = $myrow['name1'];
        }


    // build submenu

    $sql = "SELECT objects.id, objects.name1 FROM objects, wires WHERE wires.fromid = $base_id AND objects.active = 1 
AND wires.toid=objects.id AND wires.active = 1 ORDER BY objects.rank;";         
    $result = MYSQL_QUERY($sql);
    while ($myrow = MYSQL_FETCH_ARRAY($result)) {
        // default to first submenu item
        if (!$count)
            $submenu_selected_id = $myrow['id'];
        // ** not yet working **
        if ($myrow['id'] == $id)
            $html_submenu .= $myrow['name1'] . "<br/>";
        else
            $html_submenu .= "<a href='library_.php?id=" . $myrow['id'] . "'>" . $myrow['name1'] ."</a><br/>";
        $count++;
    }
    

    // build categories

    // $submenu_selected_id = $myrow['id'];
    $sql = "SELECT objects.id, objects.name1 FROM objects, wires WHERE wires.fromid = $submenu_selected_id AND objects.active = 1 
AND wires.toid=objects.id AND wires.active = 1 ORDER BY objects.rank;";
    $result = MYSQL_QUERY($sql);
    while ($myrow = MYSQL_FETCH_ARRAY($result))
        $categories[] = $myrow['name1'];



        // $root_id = $ids[0];
        $root_id = 757;          // ** fix **
        $id = 757;              // ** fix **

        // SQL objects attached to object plus media plus rootname, rootbody

    	$sql = "SELECT objects.id AS objectsId, objects.name1, objects.deck, objects.body, objects.rank, (SELECT 
objects.name1 FROM objects WHERE objects.id = $root_id) AS rootname, (SELECT objects.body FROM objects WHERE objects.id = 
$root_id) AS rootbody, wires.fromid, wires.toid, media.id AS mediaId, media.object, media.caption, media.type, media.active 
AS mediaActive FROM wires, objects LEFT JOIN media ON objects.id = media.object AND media.active = 1 WHERE wires.fromid = 
(SELECT objects.id FROM objects WHERE objects.id = $id AND objects.active = 1) AND wires.toid=objects.id AND wires.active = 
1 ORDER BY objects.rank;";

    	$result = MYSQL_QUERY($sql);
        $myrow = MYSQL_FETCH_ARRAY($result);
        $rootname = $myrow['rootname'];
        $rootbody = $myrow['rootbody'];
        mysql_data_seek($result, 0);    // reset to row 0
	    $html = "";
    	$i=0;

	// collect images

	while ( $myrow  =  MYSQL_FETCH_ARRAY($result) ) {

		if ($myrow['mediaActive'] != null) {

			$mediaFile = "MEDIA/". str_pad($myrow["mediaId"], 5, "0", STR_PAD_LEFT) .".". $myrow["type"];
			$mediaCaption = strip_tags($myrow["caption"]);
			$mediaStyle = "width: 100%;";

	                if ( $i == 0 ) {

				$specs  = getimagesize($mediaFile);
				// $use4xgrid = (($specs[0]/$specs[1]) < 1) ? TRUE : FALSE;		       
				$use4xgrid = ($rootname == "Buy Catalogs") ? TRUE : FALSE;		       
	                }

			$images[$i] .= "<a href='buy_.php?id=" . $root_id . "," . $myrow['objectsId'] . "'>";
			$images[$i] .= "<div id='image".$i."' class = 'listContainer " . (($use4xgrid) ? "fourcolumn" : "twocolumn") . "'>";
			$images[$i] .= displayMedia($mediaFile, $mediaCaption, $mediaStyle);
			$images[$i] .= "<div class = 'captionContainer helvetica small'>";
			$images[$i] .= $myrow['name1'];
			$images[$i] .= "</div>";
			$images[$i] .= "</div>";
			$images[$i] .= "</a>";
		
			if ( ( $i+1) % (($use4xgrid) ? 4 : 2) == 0) $images[$i] .= "<div class='clear'></div>";
             		$i++;
		}
	}








    // ------ $html -------

	// name

	$html .= "<div class='listContainer times'>";
    $html .= $base_name;
	$html .= "<br /><br />" . $rootbody .  "<br /><br />";
    if ($html_submenu)
    	$html .= $html_submenu;
	$html .= "</div>";	


    // categories


   
	// images
	
	$html .= "<div class = 'listContainer doublewide'>";

	for ( $j = 0; $j < count($images); $j++) {
	
		$html .= $images[$j];

	}

	$html .= "</div>";
	echo nl2br($html);
	?>

<?php
require_once("GLOBAL/foot.php");
?>

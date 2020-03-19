<?php
require_once("GLOBAL/head.php");
?>

<div class="mainContainer times big">

	<?php

        $base_name = "Library";
        $base_id = $ids[0];
        $sub_id = $ids[1];
        $category_id = $ids[2];


        // build breadcrumbs

        // get submenu
            
        $sql = "SELECT objects.id, objects.name1 FROM objects, wires WHERE wires.fromid = $base_id AND objects.active = 1 
        AND wires.toid=objects.id AND wires.active = 1 ORDER BY objects.rank;";         
        $result = MYSQL_QUERY($sql);
        $count = 0;
        while ($myrow = MYSQL_FETCH_ARRAY($result)) {
            $submenu[$count]['id'] = $myrow['id'];
            $submenu[$count]['name'] = $myrow['name1'];
            $count++;
        }
        $submenu_id = ($ids[1]) ? $ids[1] : $submenu[0]['id'];
        foreach ($submenu as $s)
            if ($s['id'] == $submenu_id)
                $html_submenu .= $s['name'] . "<br/>";
    
        // get category
    
        $sql = "SELECT objects.name1 FROM objects WHERE objects.id=$category_id AND objects.active = 1 LIMIT 1;";
        $result = MYSQL_QUERY($sql);
        while ($myrow = MYSQL_FETCH_ARRAY($result)) 
            $category_name = $myrow['name1'];
        $html_category = $category_name . "<br />";

        // output $html
    
	    $html .= "<div class='listContainer times'>";
        $html .= "<a href='library_.php?id=" . $base_id . "," . $submenu_id . "'>" . $base_name . "</a>";
	    $html .= "<br /><br />";
        if ($html_submenu)
    	    $html .= $html_submenu."</br>";
        if ($html_category)
    	    $html .= $html_category;
	    // $html .= "</div>";	// dont close side before thumbnail icon
	    echo nl2br($html);
        $html = "";


        // get object with media

        $sql = "SELECT objects.id AS objectsId, objects.name1, objects.deck, objects.body, objects.begin,
        media.id AS mediaId, media.object, media.caption, media.type, media.active AS mediaActive 
        FROM wires, objects LEFT JOIN media ON objects.id = media.object AND media.active = 1 
        WHERE objects.id = $id AND wires.fromid = $category_id AND wires.toid=objects.id AND 
        wires.active = 1 ORDER BY objects.rank;";
   
    	    $result = MYSQL_QUERY($sql);
            $images = [];
    	    $i=0;
	        while ( $myrow  =  MYSQL_FETCH_ARRAY($result) ) {
                $name = $myrow['name1'];
                $body = $myrow['body'];
                $date = date('F d, Y', strtotime($myrow['begin']));
		        if ($myrow['mediaActive'] != null) {
        
			        $mediaFile = "MEDIA/". str_pad($myrow["mediaId"], 5, "0", STR_PAD_LEFT) .".". $myrow["type"];
			        $mediaCaption = strip_tags($myrow["caption"]);
			        $mediaStyle = "width: 100%;";    
			        $images[$i] .= "<div id='image".$i."' class = 'listContainer " . (($use4xgrid) ? "fourcolumn" : "twocolumn") . "'>";
			        $images[$i] .= displayMedia($mediaFile, $mediaCaption, $mediaStyle);
                    if ($i !== 0) {
    			        $images[$i] .= "<div class = 'captionContainer helvetica small'>";
	    		        $images[$i] .= $myrow['name1'];
		    	        $images[$i] .= "</div>";
                    }
			        $images[$i] .= "</div>";
		        
			        if ( ( $i+1) % (($use4xgrid) ? 4 : 2) == 0) $images[$i] .= "<div class='clear'></div>";
             		        $i++;
		        }
	        }

    
            // output $html
                
    	    $html .= "<div class = 'listContainer fullwide not-underlined'>";
		    $html .= "<br />" . $images[0];        // add thumbnail icon
	        $html .= "</div>";	        // close thumb
	        $html .= "</div>";	        // close side column
    	    $html .= "<div class = 'listContainer doublewide'>";
            $html .= "<div class='subheadContainer'>" . $name . "</div>";
		    $html .= $body;  
	        $html .= "</div>";

    	    echo nl2br($html);
    ?>


<?php
require_once("GLOBAL/foot.php");
?>

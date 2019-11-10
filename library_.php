<?php
require_once("GLOBAL/head.php");
?>

<div class="mainContainer times big">

	<?php

        $base_id = $ids[0];
        $sub_id = $ids[1];


        // build submenu
            
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
            else
                $html_submenu .= "<a href='library_.php?id=" . $base_id . "," . $s['id'] . "'>" . $s['name'] ."</a><br/>";
        
    
        // build categories
    
        $sql = "SELECT objects.id, objects.name1 FROM objects, wires WHERE wires.fromid = $submenu_id AND objects.active = 1 
AND wires.toid=objects.id AND wires.active = 1 ORDER BY objects.rank;";
        $result = MYSQL_QUERY($sql);
        $count = 0;
        while ($myrow = MYSQL_FETCH_ARRAY($result)) {
            $categories[$count]['id'] = $myrow['id'];
            $categories[$count]['name'] = $myrow['name1'];
            $count++;
        }

    
        // build objects per category

        foreach ($categories as $c) {
    
            $category_id = $c['id'];
    
            // SQL objects attached to category object plus media plus rootname, rootbody
   
    	    $sql = "SELECT objects.id AS objectsId, objects.name1, objects.deck, objects.body, objects.rank, (SELECT 
objects.name1 FROM objects WHERE objects.id = $category_id) AS rootname, (SELECT objects.body FROM objects WHERE objects.id =    
$category_id) AS rootbody, wires.fromid, wires.toid, media.id AS mediaId, media.object, media.caption, media.type, media.active 
AS mediaActive FROM wires, objects LEFT JOIN media ON objects.id = media.object AND media.active = 1 WHERE wires.fromid =     
(SELECT objects.id FROM objects WHERE objects.id = $category_id AND objects.active = 1) AND wires.toid=objects.id AND 
wires.active = 1 ORDER BY objects.rank;";
    	    $result = MYSQL_QUERY($sql);
            $myrow = MYSQL_FETCH_ARRAY($result);
            $rootname = $myrow['rootname'];
            $rootbody = $myrow['rootbody'];
            mysql_data_seek($result, 0);    // reset to row 0
	        $html = "";
    	    $i=0;
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
        
			        $images[$i] .= "<a href='buy_.php?id=" . $category_id . "," . $myrow['objectsId'] . "'>";
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
    
        foreach ($categories as $c)
            $html .= $c['name'] . "&nbsp;";;
        
	    for ( $j = 0; $j < count($images); $j++) {
	    
		    $html .= $images[$j];
    
	    }
    
	    $html .= "</div>";
	    echo nl2br($html);
    ?>

<?php
require_once("GLOBAL/foot.php");
?>














<?
/*
// debug
print_r($ids);
echo "----> id = " . $id;        
echo "<br>" . $base_id . "," . $submenu_id;
echo $category_id;
echo "<br><br>" . $html_submenu; 
var_dump($categories);
// die();
*/
?>



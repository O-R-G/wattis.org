<?php
require_once("GLOBAL/head.php");
?>

<div class="mainContainer times big">

	<?php

        $search = $_REQUEST['search'];
        $search_id = $_REQUEST['search_id'];
        if ($search && $search_id)
            $ids = explode(",", $search_id);
        $base_name = "Library";
        $base_id = $ids[0];
        $sub_id = $ids[1];
        $search_count = 0;

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
        $html_submenu = '<div id="library-mode-switch">';
        foreach ($submenu as $s)
            if ($s['id'] == $submenu_id)
                $html_submenu .= '<button class = "helvetica small">' . $s['name'] . "</button>";
            else
                $html_submenu .= "<a href='library_.php?id=" . $base_id . "," . $s['id'] . "'>" . "<button class = 'helvetica small'>" . $s['name'] ."</button></a>";
        $html_submenu .= '</div>';
        if ($search)
            $html_submenu = "<br/>Search: <i>$search</i><br><span id = 'search_count'></span> results.";

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
 
            
        // build search

        /* 
            right now search is only working within the already selected submenu_id categories
            but should be easy to broaden to search under all categories under library
            currently passes $base_id and $sub_id as hidden value in form
        */

        if (!$search) {                                
            $search_id = $base_id . "," . $sub_id;
            $html_search  = "<div id='library-search-container'>";
            $html_search .= "<form action='library_.php'>";
            $html_search .= "<input id='library-search-field' type='text' placeholder='SEARCH THE WATTIS LIBRARY ...' name='search'>";
            $html_search .= "<input type='hidden' id='id' name='search_id' value=$search_id>";
            $html_search .= "<button type='submit'><img id='library-search-icon' src='MEDIA/svg/magnifying-glass-6-k.svg'></button>";
            $html_search .= "</form>";
            $html_search .= "</div>";
        } 

        
        // output $html
    
	    $html .= "<div class='sidemenu listContainer times'>";
        $html .= "<div class='one-column'>";
        // $html .= $base_name;
        if($search)
            $html .= "<a href='library_.php?id=" . $base_id . "," . $submenu_id . "'>" . $base_name . "</a>";
        else
            $html .= $base_name;
        if ($html_search)
    	    $html .= $html_search;
        $html .= "</div>";
        if ($rootbody)
	        $html .= $rootbody . "<br /><br />";
        if ($html_submenu){
            if(!$search){
                // 3/19 add brief intro for library
                $html .= "<div id='library-description'><br/>Here there are videos of artists talking about their work as well as video and audio documentation of all past lectures, performances, and events. There are also essays about exhibitions, plus reviews, reading lists, and interviews to read. The Library is organized in two sections:</div>";
            }
            $html .= $html_submenu;
        }
            
	    $html .= "</div>";	
	    echo nl2br($html);
        $html = "";

        
        // build objects per category

        foreach ($categories as $c) {

            if ($search) {
    
            // SQL objects where name1 like $search and connected to Library object plus media

            /*   
    	    $sql = "SELECT objects.id AS objectsId, objects.name1, objects.deck, objects.body, objects.rank, wires.fromid, 
wires.toid, media.id AS mediaId, media.object, media.caption, media.type, media.active AS mediaActive FROM wires, objects 
LEFT JOIN media ON objects.id = media.object AND media.active = 1 WHERE wires.fromid = (SELECT objects.id FROM objects WHERE 
objects.name1 LIKE '%$search%' AND objects.active = 1) AND wires.toid=objects.id AND wires.active = 1 ORDER BY objects.rank;";
            */

            // this is the hiccup, need to get category_id here correctly
            // passed in through the form
            // YAY! this works

            $category_id = $c['id'];

            $sql = "SELECT objects.id AS objectsId, objects.name1, objects.deck, objects.body, objects.rank, wires.fromid, 
wires.toid, media.id AS mediaId, media.object, media.caption, media.type, media.active AS mediaActive FROM wires, objects LEFT 
JOIN media ON objects.id = media.object AND media.active = 1 WHERE wires.fromid = (SELECT objects.id FROM objects WHERE 
objects.id = $category_id AND objects.active = 1) AND objects.name1 LIKE '%$search%' AND wires.toid=objects.id 
AND wires.active = 1 ORDER BY objects.rank;";

       	    $result = MYSQL_QUERY($sql);
            // $myrow = MYSQL_FETCH_ARRAY($result);
            
            } else {

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
            }
	        $html = "";
            $images = [];
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
        
			        $images[$i] .= "<a href='library_view_.php?id=" . $base_id . "," . $submenu_id . "," . $category_id . "," . $myrow['objectsId'] . "'>";
			        $images[$i] .= "<div id='image".$i."' class = 'listContainer " . (($use4xgrid) ? "fourcolumn" : "twocolumn") . "'>";
			        $images[$i] .= displayMedia($mediaFile, $mediaCaption, $mediaStyle);
			        $images[$i] .= "<div class = 'captionContainer library helvetica small'>";
                    $images[$i] .= $myrow['name1'];
			        $images[$i] .= "</div>";
			        $images[$i] .= "</div>";
			        $images[$i] .= "</a>";
		        
			        if ( ( $i+1) % (($use4xgrid) ? 4 : 2) == 0) $images[$i] .= "<div class='clear'></div>";
             		        $i++;
		        }
	        }
    
            // output $html
                
    	    $html .= "<div class = 'listContainer not-underlined library'>";
            $html .= "<div class='subheadContainer library'>" . $c['name'] . "</div>";
            for ( $j = 0; $j < count($images); $j++){
                $search_count++;
                $html .= $images[$j];  
            }
	        $html .= "</div>";
    	    echo nl2br($html);
        }
    // 3/19 search position when mobile;
    if($isMobile){
        ?><script type = "text/javascript">
            var ticking = false;
            var scrollTop = window.scrollTop;
            var sLibrary_search_container = document.getElementById("library-search-container");
            window.addEventListener('scroll', function(){
                sTop = window.scrollY;
                if (!ticking) {
                    window.requestAnimationFrame(function() {
                        if(sTop > 70){
                            sLibrary_search_container.classList.add("top");
                        }
                        if(sTop < 80){
                            sLibrary_search_container.classList.remove("top");
                        }
                        ticking = false;
                    });

                    ticking = true;
                }
            });
        </script><?
    }
    // 3/19 add search counts;
    if($search){
    ?>
    <script type="text/javascript">
        var sSearch_count = document.getElementById('search_count');
        sSearch_count.innerText = '<? echo $search_count; ?>';
    </script>
</div>
<?php
}
require_once("GLOBAL/foot.php");
?>

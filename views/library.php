<?
require_once('static/php/displayMedia.php');
    $search = $_REQUEST['search'];
        $search_id = $_REQUEST['search_id'];
        if ($search && $search_id)
            $ids = explode(",", $search_id);
        $base_name = "Library";
        $base_id = $ids[1];
        $search_count = 0;
        
        $submenu = $oo->children($base_id);
        $submenu_id = ($ids[2]) ? $ids[2] : $submenu[0]['id'];
        $submenu_url = $oo->get($submenu_id)['url'];
        if ($search) {

            // build all categories (search)
    
            $categories_search = array();
            foreach($submenu as $s) {
                $s_id = $s['id'];
                $category_children = $oo->children($s_id);
                foreach($category_children as $child)
                {
                    if(substr($child['name1'], 0, 1) != '.')
                    {
                        $categories_search[] = array(
                            'id'    => $child['id'],
                            'name1' => $child['name1']
                        );
                    }
                }
            }

        } else {

            // build categories (this page)
            
            $categories = $oo->children($submenu_id);
        }
            
        // build search

        /* 
            right now search is only working within the already selected submenu_id categories
            but should be easy to broaden to search under all categories under library
            currently passes $base_id and $sub_id as hidden value in form
        */
?>
<div class="mainContainer times big">
	<?
        

     //    $search_id = $base_id . "," . $sub_id;
     //    $html_search  = "<div id='library-search-container'>";
     //    $html_search .= "<form action='library_.php'>";
     //    $html_search .= "<input id='library-search-field' type='text' placeholder='Search The Wattis Library ...' name='search'>";
     //    $html_search .= "<input type='hidden' id='id' name='search_id' value=$search_id>";
     //    $html_search .= "<button type='submit'><img id='library-search-icon' src='media/svg/magnifying-glass-6-k.svg'></button>";
     //    $html_search .= "</form>";
     //    $html_search .= "</div>";
        
     //    // output $html
    
	    // $html .= "<div class='sidemenu listContainer times'>";
     //    $html .= "<div class='one-column'>";
     //    // $html .= $base_name;
     //    if($search)
     //        $html .= "<a href='library_.php?id=" . $base_id . "," . $submenu_id . "'>" . $base_name . "</a>";
     //    else
     //        $html .= $base_name;
     //    if ($html_search)
    	//     $html .= $html_search;
     //    $html .= "</div>";
     //    if ($rootbody)
	    //     $html .= $rootbody . "<br /><br />";
     //    if ($html_submenu){
     //        if(!$search){
     //            // 3/19 add brief intro for library
     //            $html .= "<div id='library-description'><br/>Here there are videos of artists talking about their work as well as video and audio documentation of all past lectures, performances, and events. There are also essays about exhibitions, plus reviews, reading lists, and interviews to read. The Library is organized in two sections:</div>";
     //        }
     //        $html .= $html_submenu;
     //    }
            
	    // $html .= "</div>";	
	    // echo nl2br($html);
        // $html = "";
        ?><div class='sidemenu listContainer times'>
            <div class='one-column'>
                <?= $search ? "<a href='/library/<?= $submenu_url; ?>'>" . $base_name . "</a>" : $base_name ; ?>
                <div id='library-search-container'>
                    <form>
                        <input id='library-search-field' type='text' placeholder='Search The Wattis Library ...' name='search'>
                        <input type='hidden' id='id' name='search_id' value='<?= $search_id; ?>' >
                        <button type='submit'><img id='library-search-icon' src='/media/svg/magnifying-glass-6-k.svg'></button>
                    </form>
                </div>
                <?=  $rootbody ? $rootbody . "<br><br>" : ''; ?>
                <? if(!$search){
                    ?>
                        <div id='library-description'>
                            <br/>Here there are videos of artists talking about their work as well as video and audio documentation of all past lectures, performances, and events. There are also essays about exhibitions, plus reviews, reading lists, and interviews to read. The Library is organized in two sections:
                        </div>
                        <div id="library-mode-switch">
                            <? foreach($submenu as $s){
                                if ($s['id'] == $submenu_id){
                                    ?><button class = "helvetica small"><?= $s['name1']; ?></button><?
                                }
                                else
                                {
                                    $this_url = '/library/' . $s['url'];
                                    ?><a href='<?= $this_url; ?>'><button class = 'helvetica small'><?= $s['name1']; ?></button></a><?
                                }
                            } ?>
                        </div>
                    <?
                } else{
                    ?><br><br>Search: <i><?= $search; ?></i><br/>matches...<?
                } ?>
            </div>
        </div><?
       
        // build objects per category

        if ($search) {
    
            // pulls from all 4 categories attached to library
            // matches on $categories_search[]['id']

            $category_0_id = $categories_search[0]['id'];
            $category_1_id = $categories_search[1]['id'];
            $category_2_id = $categories_search[2]['id'];
            $category_3_id = $categories_search[3]['id'];
            
//             $sql = "SELECT objects.id AS objectsId, objects.name1, objects.deck, objects.body, objects.rank, wires.fromid, 
// wires.toid, media.id AS mediaId, media.object, media.caption, media.type, media.active AS mediaActive FROM wires, objects LEFT 
// JOIN media ON objects.id = media.object AND media.active = 1 WHERE (wires.fromid = (SELECT objects.id FROM objects WHERE 
// objects.id = $category_0_id AND objects.active = 1) OR wires.fromid = (SELECT objects.id FROM objects WHERE
// objects.id = $category_1_id AND objects.active = 1) OR wires.fromid = (SELECT objects.id FROM objects WHERE
// objects.id = $category_2_id AND objects.active = 1) OR wires.fromid = (SELECT objects.id FROM objects WHERE
// objects.id = $category_3_id AND objects.active = 1)) AND objects.name1 LIKE '%$search%' AND wires.toid=objects.id 
// AND wires.active = 1 ORDER BY objects.rank;";

//        	    $result = MYSQL_QUERY($sql);
            // $myrow = MYSQL_FETCH_ARRAY($result);            

	        // $html = "";
         //    $images = [];
    	    // $i=0;

	        // while ( $myrow  =  MYSQL_FETCH_ARRAY($result) ) {
		       //  if ($myrow['mediaActive'] != null) {
        
			      //   $mediaFile = "media/". str_pad($myrow["mediaId"], 5, "0", STR_PAD_LEFT) .".". $myrow["type"];
			      //   $mediaCaption = strip_tags($myrow["caption"]);
			      //   $mediaStyle = "width: 100%;";
        
	        //         if ( $i == 0 ) {
        
				     //    $specs  = getimagesize($mediaFile);
				     //    // $use4xgrid = (($specs[0]/$specs[1]) < 1) ? TRUE : FALSE;
				     //    // true for search results   
				     //    $use4xgrid = TRUE;		       
	        //         }
	                
	        //         // requires category id to build url (wires.fromid)
	        //         $category_id = $myrow["fromid"];
	                
			      //   $images[$i] .= "<a href='library_view.php?id=" . $base_id . "," . $submenu_id . "," . $category_id . "," . $myrow['objectsId'] . "'>";
			      //   $images[$i] .= "<div id='image".$i."' class = 'listContainer " . (($use4xgrid) ? "fourcolumn" : "twocolumn") . "'>";
			      //   $images[$i] .= displayMedia($mediaFile, $mediaCaption, $mediaStyle);
			      //   $images[$i] .= "<div class = 'captionContainer library helvetica small'>";
         //            $images[$i] .= $myrow['name1'];
			      //   $images[$i] .= "</div>";
			      //   $images[$i] .= "</div>";
			      //   $images[$i] .= "</a>";
		        
			      //   if ( ( $i+1) % (($use4xgrid) ? 4 : 2) == 0) $images[$i] .= "<div class='clear'></div>";
         //     		        $i++;
		       //  }
	        // }

            $search_result = build_children_librarySearch($oo, $ww, $search);
            
            $search_count = count($search_result);
            ?>
                <div class='listContainer not-underlined library doublewide'>
                    <div class='subheadContainer library'>Results</div>
                    <? foreach($search_result as $key => $r){
                        if(substr($r['name1'], 0, 1) != '.'){
                            $this_url = '/library/' . $r['submenu_url'] . '/' . $r['category_url'] . '/' . $r['url'];
                            $media = $oo->media($r['id'])[0];
                            $mediaFile = m_url($media);
                            $mediaCaption = strip_tags($media["caption"]);
                            $mediaStyle = "width: 100%;";

                            if($key == 0)
                            {
                                $mediaFile_temp = "media/". m_pad($media['id']) .".". $media["type"];
                                $specs  = getimagesize($mediaFile_temp);
                                $use4xgrid = TRUE;      
                            }
                            ?><a href='<?= $this_url; ?>'>
                                <div id='image<?= $key; ?>' class = 'listContainer <?= ($use4xgrid) ? "fourcolumn" : "twocolumn"; ?>'>
                                    <?= displayMedia($mediaFile, $mediaCaption, $mediaStyle); ?>
                                    <div class = 'captionContainer library helvetica small'><?= $r['name1']; ?></div>
                                </div>
                                </a>
                            <?
                        }
                    } ?>
                </div>
            <?
            // output $html
            // use4xgrid and doublewide
               
    	    // $html .= "<div class = 'listContainer not-underlined library doublewide'>";
         //    $html .= "<div class='subheadContainer library'>" . "Results" . "</div>";
         //    for ( $j = 0; $j < count($images); $j++){
         //        $search_count++;
         //        $html .= $images[$j];  
         //    }
	        // $html .= "</div>";
    	    // echo nl2br($html);

        } else {

            foreach ($categories as $c) {

                // SQL objects attached to category object plus media plus rootname, rootbody
    
                $category_id = $c['id'];    
       
//         	    $sql = "SELECT objects.id AS objectsId, objects.name1, objects.deck, objects.body, objects.rank, (SELECT 
// objects.name1 FROM objects WHERE objects.id = $category_id) AS rootname, (SELECT objects.body FROM objects WHERE objects.id =    
// $category_id) AS rootbody, wires.fromid, wires.toid, media.id AS mediaId, media.object, media.caption, media.type, media.active 
// AS mediaActive FROM wires, objects LEFT JOIN media ON objects.id = media.object AND media.active = 1 WHERE wires.fromid =     
// (SELECT objects.id FROM objects WHERE objects.id = $category_id AND objects.active = 1) AND wires.toid=objects.id AND 
// wires.active = 1 ORDER BY objects.rank;";
//     	        $result = MYSQL_QUERY($sql);
//                 $myrow = MYSQL_FETCH_ARRAY($result);
//                 $rootname = $myrow['rootname'];
//                 $rootbody = $myrow['rootbody'];
//                 mysql_data_seek($result, 0);    // reset to row 0
// 	            $html = "";
//                 $images = [];
//     	        $i=0;
    
// 	            while ( $myrow  =  MYSQL_FETCH_ARRAY($result) ) {
// 		            if ($myrow['mediaActive'] != null) {
            
// 			            $mediaFile = "media/". str_pad($myrow["mediaId"], 5, "0", STR_PAD_LEFT) .".". $myrow["type"];
// 			            $mediaCaption = strip_tags($myrow["caption"]);
// 			            $mediaStyle = "width: 100%;";
            
// 	                    if ( $i == 0 ) {
            
// 				            $specs  = getimagesize($mediaFile);
// 				            // $use4xgrid = (($specs[0]/$specs[1]) < 1) ? TRUE : FALSE;		       
// 				            $use4xgrid = ($rootname == "Buy Catalogs") ? TRUE : FALSE;		       
// 	                    }
	                    
// 			            $images[$i] .= "<a href='library_view.php?id=" . $base_id . "," . $submenu_id . "," . $category_id . "," . $myrow['objectsId'] . "'>";
// 			            $images[$i] .= "<div id='image".$i."' class = 'listContainer " . (($use4xgrid) ? "fourcolumn" : "twocolumn") . "'>";
// 			            $images[$i] .= displayMedia($mediaFile, $mediaCaption, $mediaStyle);
// 			            $images[$i] .= "<div class = 'captionContainer library helvetica small'>";
//                         $images[$i] .= $myrow['name1'];
// 			            $images[$i] .= "</div>";
// 			            $images[$i] .= "</div>";
// 			            $images[$i] .= "</a>";
		            
// 			            if ( ( $i+1) % (($use4xgrid) ? 4 : 2) == 0) $images[$i] .= "<div class='clear'></div>";
//              		            $i++;
// 		            }
// 	            }
                $category_item = $oo->get($category_id);
                $rootname = $category_item['name1'];
                $rootbody = $category_item['body'];
                $items = $oo->children($category_id);
                $category_url = $c['url'];
                ?>
                <div class = 'listContainer not-underlined library'>
                    <div class='subheadContainer library'><?= $c['name1']; ?></div>
                    <? foreach($items as $key => $item){
                        if(substr($item['name1'], 0, 1) != '.'){
                            $this_url = '/library/' . $submenu_url . '/' . $category_url . '/' . $item['url'];
                            $media = $oo->media($item['id'])[0];
                            $mediaFile = m_url($media);
                            $mediaCaption = strip_tags($media["caption"]);
                            $mediaStyle = "width: 100%;";
                            if($key == 0)
                            {
                                $mediaFile_temp = "media/". m_pad($media['id']) .".". $media["type"];
                                $specs  = getimagesize($mediaFile_temp);
                                $use4xgrid = ($rootname == "Buy Catalogs");  
                            }
                            ?><a href='<?= $this_url; ?>'>
                                <div id='image<?= $key; ?>' class = 'listContainer <?= ($use4xgrid) ? "fourcolumn" : "twocolumn"; ?>'>
                                    <?= displayMedia($mediaFile, $mediaCaption, $mediaStyle); ?>
                                    <div class = 'captionContainer library helvetica small'><?= $item['name1']; ?></div>
                                </div>
                                </a>
                            <?
                        }
                    } ?>
                </div>
                <?
        
                // output $html
                    
    	        // $html .= "<div class = 'listContainer not-underlined library'>";
             //    $html .= "<div class='subheadContainer library'>" . $c['name1'] . "</div>";
             //    for ( $j = 0; $j < count($images); $j++){
             //        $search_count++;
             //        $html .= $images[$j];  
             //    }
	            // $html .= "</div>";
    	        // echo nl2br($html);
    	    }
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
</div>
<?php
}
?>
</div>
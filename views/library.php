<?
require_once('static/php/displayMedia.php');
    $search = isset($_REQUEST['search']) ? $_REQUEST['search'] : '';
        $search_id = isset($_REQUEST['search_id']) ? $_REQUEST['search_id'] : false;
        if ($search && $search_id)
            $ids = explode(",", $search_id);
        $base_name = "Library";
        $base_id = $ids[1];
        $search_count = 0;
        
        $submenu = $oo->children($base_id);
        $submenu_id = isset($ids[2]) ? $ids[2] : $submenu[0]['id'];
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
<div class="mainContainer libraryMainContainer times big">
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
        ?>
        <div id='library-search-container'>
            <form>
                <input type='hidden' id='id' name='search_id' value='<?= $search_id; ?>' >
                <input id='library-search-field' type='text' placeholder='Search The Wattis Library ...' name='search'><button type='submit'><img id='library-search-icon' src='/media/svg/magnifying-glass-6-k.svg'></button>
            </form>
        </div>

        <div class='sidemenu listContainer side-listContainer times'>
            <?= $search ? "<a href='/library/<?= $submenu_url; ?>'>" . $base_name . "</a>" : $base_name ; ?>
            
            <?=  isset($rootbody) ? $rootbody . "<br><br>" : ''; ?>
            <? if(!$search){
                ?>
                    <div id='library-description'>
                        <br/>Here there are videos of artists talking about their work as well as video and audio documentation of all past lectures, performances, and events. There are also essays about exhibitions, plus reviews, reading lists, and interviews to read. The Library is organized in two sections:
                    </div>
                    <div id="library-mode-switch-container" class="mode-switch-container">
                        <? foreach($submenu as $s){
                            if ($s['id'] == $submenu_id){
                                ?><button class = "mode-switch helvetica small"><?= $s['name1']; ?></button><?
                            }
                            else
                            {
                                $this_url = '/library/' . $s['url'];
                                ?><a href='<?= $this_url; ?>'><button class = 'mode-switch helvetica small'><?= $s['name1']; ?></button></a><?
                            }
                        } ?>
                    </div>
                <?
            } else{
                ?><br><br>Search: <i><?= $search; ?></i><br/>matches...<?
            } ?>
        </div><?
       
        // build objects per category

        if ($search) {
    
            // pulls from all 4 categories attached to library
            // matches on $categories_search[]['id']

            $category_0_id = $categories_search[0]['id'];
            $category_1_id = $categories_search[1]['id'];
            $category_2_id = $categories_search[2]['id'];
            $category_3_id = $categories_search[3]['id'];

            $search_result = build_children_librarySearch($oo, $ww, $search);
            
            $search_count = count($search_result);
            ?>
                <div class='listContainer main-listContainer not-underlined library doublewide lastListContainer'>
                    <div class='subheadContainer library'>Results</div>
                    <? foreach($search_result as $key => $r){
                        if(substr($r['name1'], 0, 1) != '.'){
                            $this_url = '/browse-the-library/' . $r['submenu_url'] . '/' . $r['category_url'] . '/' . $r['url'];
                            $media = $oo->media($r['id']);
                            if(count($media) != 0)
                            {
                                $m = $media[0];
                                $mediaFile = m_url($m);
                                $mediaCaption = clean_caption(strip_tags($m["caption"]));
                                $mediaStyle = "width: 100%;";
                                if(!$gotSpecs)
                                {
                                    $mediaFile_temp = "media/". m_pad($m['id']) .".". $m["type"];
                                    $specs  = getimagesize($mediaFile_temp);
                                    $gotSpecs = true;
                                }
                            }
                            // $mediaFile = m_url($media);
                            // $mediaCaption = strip_tags($media["caption"]);
                            // $mediaStyle = "width: 100%;";

                            // if($key == 0)
                            // {
                            //     $mediaFile_temp = "media/". m_pad($media['id']) .".". $media["type"];
                            //     $specs  = getimagesize($mediaFile_temp);
                            //     $use4xgrid = TRUE;      
                            // }
                            ?><a href='<?= $this_url; ?>'>
                                <div id='image<?= $key; ?>' class = 'listContainer <?= ($use4xgrid) ? "fourcolumn" : "twocolumn"; ?>'>
                                    <?php if(count($media) != 0){
                                        echo displayMedia($mediaFile, $mediaCaption, $mediaStyle);
                                    } ?>
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
            ?><div class="listContainer main-listContainer"><?
            foreach ($categories as $key => $c) {

                // SQL objects attached to category object plus media plus rootname, rootbody
    
                $category_id = $c['id'];    
                $category_item = $oo->get($category_id);
                $rootname = $category_item['name1'];
                $rootbody = $category_item['body'];
                $items = $oo->children($category_id);
                $category_url = $c['url'];
                $gotSpecs = false;
                $isLast = count($categories) - 1 == $key;
                ?><div class = 'listContainer half-width not-underlined library <?= $isLast ? 'lastListContainer' : ''; ?>'>
                    <div class='subheadContainer library'><?= $c['name1']; ?></div>
                    <? foreach($items as $key => $item){
                        if(substr($item['name1'], 0, 1) != '.'){
                            $this_url = '/library/' . $submenu_url . '/' . $category_url . '/' . $item['url'];
                            $media = $oo->media($item['id']);
                            if(count($media) != 0)
                            {
                                $m = $media[0];
                                $mediaFile = m_url($m);
                                $mediaCaption = strip_tags($m["caption"]);
                                $mediaStyle = "width: 100%;";
                                if(!$gotSpecs)
                                {
                                    $mediaFile_temp = "media/". m_pad($m['id']) .".". $m["type"];
                                    $specs  = getimagesize($mediaFile_temp);
                                    $gotSpecs = true;
                                }
                            }
                            $use4xgrid = ($rootname == "Buy Catalogs");
                            ?><a href='<?= $this_url; ?>' class="listContainer <?= ($use4xgrid) ? "fourcolumn" : "half-width"; ?>">
                                <div id='image<?= $key; ?>' class = ''>
                                    <?php if(count($media) != 0){
                                        echo displayMedia($mediaFile, $mediaCaption, $mediaStyle);
                                    } ?>
                                    <div class = 'captionContainer library helvetica small'><?= $item['name1']; ?></div>
                                </div>
                            </a><?
                        }
                    }
                ?></div><?
            }
            ?></div><?
        }
    // 3/19 search position when mobile;
    ?><script type = "text/javascript">
        var ticking = false;
        var scrollTop = window.scrollTop;
        var sLibrary_search_container = document.getElementById("library-search-container");
        if(window.innerWidth < 568 && sLibrary_search_container != undefined)
        {
            window.addEventListener('scroll', function(){
                sTop = window.scrollY;
                if (!ticking) {
                    window.requestAnimationFrame(function() {
                        console.log(sTop);
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
        }
        
    </script><?
    // 3/19 add search counts;
    if($search){
    ?>
</div>
<?php
}
?>
</div>
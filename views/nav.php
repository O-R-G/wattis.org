<?
$temp = $oo->urls_to_ids(array('home', 'the-wattis-institute'));
$wattis_id = end($temp);
$wattis_item = $oo->get($wattis_id);
$wattis_intro = $wattis_item['body'];
$temp = $oo->urls_to_ids(array('main'));
$main_id = end($temp);
$id = $main_id;
$main_children = $oo->children($main_id);
$menu_level = 0;

?><div id="logoContainer">
    <div class="times big logo">
        <div id="loading_mark"></div>
	    <div id="logo_mark">.+*</div>
        <div id="logo" class="fixed-black">
            <a href ="/"><span class="logo-text">The Wattis Institute</span></a>
        </div>
    </div>
</div>
<div id="close-help-btn"></div>

<div id = 'search-btn'></div>
<div id='searchPickerContainer' class = 'fullContainer'>
	<form id = 'search-picker' action = '/search' method = 'GET'>
		<input id = 'search-input' name = 'query' type = 'text' class = 'big helvetica'><button id = 'commit-search-btn' type = 'submit'><img src = '/media/svg/arrow-forward-6-w.svg'></button>
	</form>
</div>
<!-- .+* THE WATTIS INSTITUTE -->
<div id = 'menu-btn' class=""></div>
<div id = 'menuContainer' class='menuContainer helvetica'>
	<div id = 'menu-wrapper'>
		<a href='/' class='menu-item'>HOME</a><br><? 
        foreach($main_children as $key => $child){
			if(substr($child['name1'],0,1) != '.') {
				$this_url = '/' . $child['url'];
				$this_title = strtoupper($child['name1']);
                // show 4 menu items at a time using rank
				if($child['rank'] >= ($menu_level+1) * 40 ) {
					if($menu_level > 0) {
						?></div><?
					}
					$menu_level++;
					?><div id = 'menu-level-<?= $menu_level; ?>' class='menu-level'><?
				}			
				?><a href="<?= $this_url; ?>" class='menu-item'><?= $this_title; ?></a><br><?
			}			
		} 
		if($menu_level > 0)
			echo '</div>';
		
        ?><br><div id = 'more-menu-btn' class='instructionContainer'><a><span id="more-menu-btn-text">MORE</span>...</a></div>
	</div>
	<div id = 'close-menu-btn' class = ''></div>
</div>

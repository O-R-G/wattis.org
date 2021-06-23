<?

$wattis_id = end($oo->urls_to_ids(array('home', 'the-wattis-institute')));
$wattis_item = $oo->get($wattis_id);
$wattis_intro = $wattis_item['body'];
$main_id = end($oo->urls_to_ids(array('main')));
$id = $main_id;
$main_children = $oo->children($main_id);
$menu_level = 0;

?><div id="logoContainer" class="times big logo">
	<div id="logo" class="fixed-black">.+* <a href ="/"><span class="logo-text">The Wattis Institute</span></a></div>
	<div id="logo_short">.+*</div>
</div>
<div id="loadingLogoContainer" class="times big logo">
	<div id="loading_mark"></div>
	<div id="loadingLogo"><span class="transprent">.+*</span> <span class="logo-text">The Wattis Institute</span></div>
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
		<a href='/' class='menu-item'>HOME</a><br>
		<? foreach($main_children as $key => $child){
			if(substr($child['name1'],0,1) != '.') {
				$this_url = '/' . $child['url'];
				$this_title = strtoupper($child['name1']);				
				if($child['rank'] > ($menu_level+1) * 25 ) {
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
		
        ?><a href='/read-about-us' class='instructionContainer'>ABOUT</a> <br>
		<a href='/our-program' class='instructionContainer'>PROGRAM</a><br>
		<a href='/calendar' class='instructionContainer'>CALENDAR</a><br>
		<a href='/library' class='instructionContainer'>LIBRARY</a><br>
		<div id = 'menu-level-1' class='menu-level'>
			<a href='/consult-the-archive' class='instructionContainer'>ARCHIVE</a><br>
			<a href='/visit-the-wattis' class='instructionContainer'>VISIT</a><br>
			<a href='/contact-the-wattis' class='instructionContainer'>CONTACT</a><br>
			<a href='/buy-catalogues' class='instructionContainer'>BOOKSHOP</a><br>
		</div>
		<div id = 'menu-level-2' class='menu-level'>
			<a href='/thank-our-supporters' class='instructionContainer'>THANKS OUR SUPPORTERS</a><br>
			<a href='/become-a-member' class='instructionContainer'>BECOME A MEMBER</a><br>
			<a href='/buy-limited-editions' class='instructionContainer'>BUY LIMITED EDITIONS</a><br>
			<a href='/capp-street-project' class='instructionContainer'>CAPP STREET PROJECT</a><br>
		</div>
		<br><div id = 'more-menu-btn' class='instructionContainer'><a><span id="more-menu-btn-text">MORE</span>...</a></div>
	</div>
	<div id = 'close-menu-btn' class = ''></div>
</div>

<?
	$wattis_id = end($oo->urls_to_ids(array('home', 'the-wattis-institute')));
	$wattis_item = $oo->get($wattis_id);
	$wattis_intro = $wattis_item['body'];
	$help_text = strictEmpty($item['notes']) ? 'THIS IS THE WEB SITE OF THE WATTIS INSTITUTE FOR CONTEMPORARY ARTS.<br><br>'. strtoupper($wattis_intro) : $item['notes'] ;
?>
<div id="logoContainer" class="times big logo">
	<div id="logo" class="fixed-black">.+* <span class="logo-text">The Wattis Institute</span></div>
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
	<div id = 'menu-wrapper' level='0'>
		<a href='/' class='instructionContainer'>HOME</a> <br>
		<a href='/read-about-us' class='instructionContainer'>ABOUT</a> <br>
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

<div id="helpContainer" class="helvetica small-medium">
    <div id="help-txt"><?= $help_text; ?></div>
    <!-- <div id = 'close-help-btn' class = ''></div> -->
</div>

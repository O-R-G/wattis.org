<?
	$wattis_id = end($oo->urls_to_ids(array('home', 'the-wattis-institute')));
	$wattis_item = $oo->get($wattis_id);
	$wattis_intro = $wattis_item['body'];
	$help_text = strictEmpty($item['notes']) ? 'WELL, YOU HAVE LANDED HERE ON THE WEBSITE FOR 
                      THE WATTIS INSTITUTE FOR CONTEMPORARY ARTS.'. strtoupper($wattis_intro) : $item['notes'] ;
?>
<div id="logoContainer" class=" times big logo">
	<!-- <div id="logo"><a href="/">.+* The Wattis Institute</a></div> -->
	<div id="intro"><?= $wattis_intro; ?></div>
</div>

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
		<br><div id = 'more-menu-btn' class='instructionContainer menu-more-btn'><a>MORE...</a></div>
	</div>
	<div id = 'close-menu-btn' class = ''></div>
</div>
<!-- <div id = 'help-btn' class="helvetica">HELP</div> -->
<!-- <div id = 'help-btn' class="helvetica">HELP ME!</div> -->
<div id = 'help-btn' class="helvetica"></div>
<div id="helpContainer" class="helvetica small-medium">
    <div id="help-txt"><?= $help_text; ?></div>
    <div id = 'close-help-btn' class = ''></div>
</div>

<!-- in views/nav for now, but should be done on body.onload and loaded in views/head -->
<!-- <script type="text/javascript" src="/static/js/ui.js"></script> -->


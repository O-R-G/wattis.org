<?
	$wattis_id = end($oo->urls_to_ids(array('home', 'the-wattis-institute')));
	$wattis_item = $oo->get($wattis_id);
	$wattis_intro = $wattis_item['body'];
	// var_dump($item['name1']);
	// die();
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
		<a href='/about' class='instructionContainer'>ABOUT</a> <br>
		<a href='/program' class='instructionContainer'>PROGRAM</a><br>
		<a href='/calendar' class='instructionContainer'>CALENDAR</a><br>
		<div id = 'menu-level-1' class='menu-level'>
			<a href='/archive' class='instructionContainer'>ARCHIVE</a><br>
			<a href='/visit' class='instructionContainer'>VISIT</a><br>
			<a href='/contact' class='instructionContainer'>CONTACT</a><br>
			<a href='/catalogues' class='instructionContainer'>BOOKSHOP</a><br>
		</div>
		<div id = 'menu-level-2' class='menu-level'>
			<a href='/thank-our-supporters' class='instructionContainer'>THANKS OUR SUPPORTERS</a><br>
			<a href='/support' class='instructionContainer'>BECOME A MEMBER</a><br>
			<a href='/editions' class='instructionContainer'>BUY LIMITED EDITIONS</a><br>
			<a href='/capp' class='instructionContainer'>CAPP STREET PROJECT</a><br>
		</div>
		<div id = 'menu-level-3' class='menu-level'>
			<a href='/thank-our-supporters' class='instructionContainer'>THANKS OUR SUPPORTERS</a><br>
			<a href='/support' class='instructionContainer'>BECOME A MEMBER</a><br>
			<a href='/editions' class='instructionContainer'>BUY LIMITED EDITIONS</a><br>
			<a href='/capp' class='instructionContainer'>CAPP STREET PROJECT</a><br>
		</div>
		<a href='/library' class='instructionContainer'>LIBRARY</a><br>
		<div id = 'more-menu-btn' class='instructionContainer menu-more-btn'><a>MORE</a></div>
	</div>
	<div id = 'close-menu-btn' class = ''></div>
</div>
<!-- <div id = 'help-btn' class="helvetica">HELP</div> -->
<!-- <div id = 'help-btn' class="helvetica">HELP ME!</div> -->
<div id = 'help-btn' class="helvetica">WHERE AM I?</div>
<div id="helpContainer" class="helvetica small-medium">
    <div id="help-txt"><?= $help_text; ?></div>
    <div id = 'close-help-btn' class = ''></div>
</div>

<!-- <<< sound >>> -->
<audio id='btn-on-sound-effect' preload="auto"><source src = '/media/audio/320181__dland__hint.wav' type="audio/wav"></audio>
<audio id='btn-off-sound-effect' preload="auto"><source src = '/media/audio/413690__splatez07__click_edited.m4a' type=""></audio>

<script type="text/javascript">
	var logo = unescape(getCookie("logoCookie"));
	if (logo) { document.getElementById("logo").textContent = logo; }

	var sBtn_on_sound_effect = document.getElementById('btn-on-sound-effect');
	var sBtn_off_sound_effect = document.getElementById('btn-off-sound-effect');

	var sMenu_btn = document.getElementById('menu-btn');
	sMenu_btn.addEventListener('click', function(){
		document.body.classList.add('viewing-menu');
		sBtn_on_sound_effect.play();
	});

	var sClose_menu_btn = document.getElementById('close-menu-btn');
	sClose_menu_btn.addEventListener('click', function(){
		document.body.classList.remove('viewing-menu');
		sBtn_off_sound_effect.play();
	});

	var sHelp_btn = document.getElementById('help-btn');
	sHelp_btn.addEventListener('click', function(){
		document.body.classList.add('viewing-help');
		sBtn_on_sound_effect.play();
	});

	var sClose_help_btn = document.getElementById('close-help-btn');
	sClose_help_btn.addEventListener('click', function(){
		document.body.classList.remove('viewing-help');
		sBtn_off_sound_effect.play();
	});

	var sSearch_btn = document.getElementById('search-btn');
	var sSearch_input = document.getElementById('search-input');
	sSearch_btn.addEventListener('click', function(){
		if(document.body.classList.contains('viewing-search')){
			sBtn_off_sound_effect.play();
		}
		else{
			console.log('turn on');
			setTimeout(function(){sSearch_input.focus();}, 0);
			sBtn_on_sound_effect.play();
		}
		document.body.classList.toggle('viewing-search');
	});

	var sMore_menu_btn = document.getElementById('more-menu-btn');
	var sMenu_wrapper = document.getElementById('menu-wrapper');
	var sMenu_level = document.getElementsByClassName('menu-level');
	sMore_menu_btn.addEventListener('click', function(){
		var currentLevel = parseInt(sMenu_wrapper.getAttribute('level'));
		if(currentLevel < sMenu_level.length)
		{
			var btn_text = sMore_menu_btn.querySelector('a').innerText;
			sMore_menu_btn.querySelector('a').innerText = 'EVEN '+btn_text;
			sMenu_wrapper.setAttribute('level', currentLevel+1);
			if(currentLevel == sMenu_level.length-1)
				sMore_menu_btn.style.display = 'none';
		}
	});
</script>
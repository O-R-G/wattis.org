		</div> <!-- close #animatePunctuation -->
		<div id = 'search-btn'></div>
		<div id='searchPickerContainer' class = 'fullContainer'>
			<form id = 'search-picker' action = '/search' method = 'GET'>
				<input id = 'search-input' name = 'query' type = 'text' class = 'big helvetica'><button id = 'commit-search-btn' type = 'submit'><img src = '/media/svg/arrow-forward-6-w.svg'></button>
			</form>
		</div>
		<div id = 'menu-btn' class = 'helvetica round-btn'>MENU</div>
		<div id = 'menuContainer' class='menuContainer helvetica'>
			<div id = 'menu-wrapper'>
				<a href='/about' class='instructionContainer'>ABOUT</a> <br>
				<a href='/program' class='instructionContainer'>PROGRAM</a><br>
				<a href='/calendar' class='instructionContainer'>CALENDAR</a><br>
				<span class='desktop'>
					<a href='/archive' class='instructionContainer'>ARCHIVE</a><br>
					<a href='/visit' class='instructionContainer'>VISIT</a><br>
					<a href='/contact' class='instructionContainer'>CONTACT</a><br>
					<a href='/catalogs' class='instructionContainer'>BOOKSHOP</a><br>
				</span>
				<a href='/library' class='instructionContainer'>LIBRARY</a><br>
				<a href='/main' class='instructionContainer'>MORE</a>
			</div>
			<div id = 'close-menu-btn' class = 'round-btn'>CLOSE</div>
		</div>
	</div>
</div>
<audio id='btn-on-sound-effect' ><source src = '/media/audio/320181__dland__hint.wav' type="audio/wav"></audio>
<audio id='btn-off-sound-effect' ><source src = '/media/audio/413690__splatez07__click_edited.m4a' type=""></audio>
<script type="text/javascript">
	var animate = checkCookie("animateCookie");
	delay = (checkCookie("delayCookie")) ? ((getCookie("delayCookie")) * 1) : 200;

	<?php 
	if(!$uri[1]) 
	{ 
	?>initPunctuation("animatePunctuation", delay, true, true);<?php 
		if(!$alt) 
		{ 
		?>
			document.cookie = "animateCookie=; expires=Thu, 01 Jan 1970 00:00:00 GMT";
			var click = clickHandler();
		<?php
		}
	} 
	else 
	{ 
		?>initPunctuation('animatePunctuation', delay, true, animate);<?php 
	} 
	?>
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
	var sSearch_btn = document.getElementById('search-btn');
	sSearch_btn.addEventListener('click', function(){
		if(document.body.classList.contains('viewing-search'))
			sBtn_off_sound_effect.play();
		else
			sBtn_on_sound_effect.play();
		document.body.classList.toggle('viewing-search');
	});
</script>
</body>
</html>
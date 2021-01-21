		</div> <!-- close #animatePunctuation -->
		<div id = 'search-btn'></div>
		<div id = 'menu-btn' class = 'helvetica'>MENU</div>
		<div id = 'menuContainer' class='menuContainer helvetica small'>
			<a href='/about' class='instructionContainer'>ABOUT</a> 
			<a href='/program' class='instructionContainer'>PROGRAM</a>
			<a href='/calendar' class='instructionContainer'>CALENDAR</a>
			<span class='desktop'>
				<a href='/archive' class='instructionContainer'>ARCHIVE</a>
				<a href='/visit' class='instructionContainer'>VISIT</a>
				<a href='/contact' class='instructionContainer'>CONTACT</a>
				<a href='/catalogs' class='instructionContainer'>BOOKSHOP</a>
			</span>
			<a href='/library' class='instructionContainer'>LIBRARY</a>
			<a href='/main' class='instructionContainer'>MORE</a>
		</div>
	</div>
</div>	
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
</script>
</body>
</html>
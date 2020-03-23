			<!-- CLOSE home/mainContainer, animatePunctuation, color -->
			</div>
		<div class='menuContainer helvetica small'>
			<!--
			<a href='main' class='instructionContainer'>MAIN</a> 
			<a href='visit' class='instructionContainer'>VISIT</a>
			<a href='program' class='instructionContainer'>PROGRAM</a>
			<a href='calendar' class='instructionContainer'>CALENDAR</a>
			<a href='archive' class='instructionContainer'>ARCHIVE</a>
			<a href='index?alt=1' class='instructionContainer'>GO HOME</a>
			-->

			<a href='about' class='instructionContainer'>ABOUT</a> 
			<a href='program' class='instructionContainer'>PROGRAM</a>
			<a href='calendar' class='instructionContainer'>CALENDAR</a>
			<span class='desktop'>
				<a href='archive' class='instructionContainer'>ARCHIVE</a>
				<a href='visit' class='instructionContainer'>VISIT</a>
				<a href='contact' class='instructionContainer'>CONTACT</a>
				<a href='catalogs' class='instructionContainer'>BOOKSHOP</a>
			</span>
			<a href='library' class='instructionContainer'>LIBRARY</a>
			<a href='main' class='instructionContainer'>MORE</a>
		</div>
	</div>
</div>	
<script type="text/javascript">
var animate = checkCookie("animateCookie");
delay = (checkCookie("delayCookie")) ? ((getCookie("delayCookie")) * 1) : 200;

<?php 
if($pageName=="index") 
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

			<!-- CLOSE home/mainContainer, animatePunctuation, color -->
			</div>
		<div class='menuContainer helvetica small'>
			<!--div class='helvetica small'-->
			<a href='main' class='instructionContainer'>MAIN</a>
			<a href='visit' class='instructionContainer'>VISIT</a>
			<a href='program' class='instructionContainer'>PROGRAM</a>
			<a href='calendar' class='instructionContainer'>CALENDAR</a>
			<a href='archive' class='instructionContainer'>ARCHIVE</a>
			<a href='index?alt=1' class='instructionContainer'>GO HOME</a>
			<!--/div-->
		</div>
	</div>
</div>	
<script type="text/javascript">
var animate = checkCookie("animateCookie");
delay = (checkCookie("delayCookie")) ? ((getCookie("delayCookie")) * 1) : 200;

<? 
if($pageName=="index") 
{ 
?>initPunctuation("animatePunctuation", delay, true, true);<? 
	if(!$alt) 
	{ 
	?>
		document.cookie = "animateCookie=; expires=Thu, 01 Jan 1970 00:00:00 GMT";
		var click = clickHandler();
	<?
	}
} 
else 
{ 
	?>initPunctuation('animatePunctuation', delay, true, animate);<? 
} 
?>
</script>
</body>
</html>

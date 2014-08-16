        <div class='menuContainer'>
	        <div class='helvetica small'>
        		<a href='main' class='instructionContainer'>MAIN</a>
        		<a href='visit' class='instructionContainer'>VISIT</a>
        		<a href='exhibitions' class='instructionContainer'>PROGRAM</a>
        		<a href='calendar' class='instructionContainer'>CALENDAR</a>
        		<a href='archive' class='instructionContainer'>ARCHIVE</a>
        		<a href='index' class='instructionContainer'>GO HOME</a>
        	</div>
        </div>

        <!-- CLOSE mainContainer, animatePunctuation, color -->

        </div>
	</div>
	</div>
	
	<script type="text/javascript" src="JS/animatePunctuation.js"></script>

	<script type="text/javascript">

                animate = checkCookie("animateCookie");

		<?php if ($pageName=="index") { ?> 

			animate = true; 
			addRemoveDivWithMouseDown("_click", clickHandler);

		<?php } ?>

	        initPunctuation('animatePunctuation', 200, animate);

	</script>

</body>
</html>

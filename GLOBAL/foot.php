	<div class='menuContainer'>
	        <div class='helvetica small'>
        		<a href='main' class='instructionContainer'>MAIN</a>
        		<a href='visit' class='instructionContainer'>VISIT</a>
        		<a href='program' class='instructionContainer'>PROGRAM</a>
        		<a href='calendar' class='instructionContainer'>CALENDAR</a>
        		<a href='archive' class='instructionContainer'>ARCHIVE</a>
        		<a href='index?alt=1' class='instructionContainer'>GO HOME</a>
        	</div>
        </div>

        <!-- CLOSE home/mainContainer, animatePunctuation, color -->

        </div>
	</div>
	</div>
	
	<script type="text/javascript">

        	var animate = checkCookie("animateCookie");
	
		<?php if ($pageName=="index") { ?> 

                        document.cookie = "animateCookie=; expires=Thu, 01 Jan 1970 00:00:00 GMT";
			initPunctuation("animatePunctuation", delay, true, true);

       	                <?php if (!$alt) { ?>

	                        document.cookie = "animateCookie=; expires=Thu, 01 Jan 1970 00:00:00 GMT";
        	                var click = clickHandler();
	
                        <?php } ?> 

		<?php } else { ?>

	        	initPunctuation('animatePunctuation', delay, true, animate);

		<?php } ?>

	</script>

</body>
</html>

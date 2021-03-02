		    </div> <!-- end of #color -->
		</div> <!-- end of #animatePunctuation -->
		<!-- outside of #animatePunctuation, so dont animate punctuation -->
		<script type="text/javascript">
			var animate = checkCookie("animateCookie");
			delay = (checkCookie("delayCookie")) ? ((getCookie("delayCookie")) * 1) : 200;

			<?php
			if(!$uri[1])
			{
			?>
			initPunctuation("animatePunctuation", delay, true, true);
			<?php
				if(!$alt)
				{
				?>
					document.cookie = "animateCookie=; expires=Thu, 01 Jan 1970 00:00:00 GMT";
					var click = clickHandler();
					click = clickHandler();
				<?php
				}
			}
			else
			{
				?>
				initPunctuation('animatePunctuation', delay, true, animate);
				<?php
			}
			?>
			var s_click = document.getElementById('_click');
			var sColor = document.getElementById('color');
			console.log(s_click);
			if( s_click == null ){
				if(sColor.classList.contains('white')){
					sColor.classList.remove('white');
					sColor.classList.add('black');
				}
			}

		</script>
	</body>
</html>

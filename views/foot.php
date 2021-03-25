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
				var sLogoContainer = document.getElementById('logoContainer');
				var sMenu_btn = document.getElementById('menu-btn');
				var animtationIsInited = false;
				sLogoContainer.addEventListener('click', ()=>{
					if(!animtationIsInited)
					{
						initPunctuation('animatePunctuation', delay, true, true);
						animtationIsInited = true;
					}
					
				});
				sMenu_btn.addEventListener('click', ()=>{
					if(!animtationIsInited)
					{
						initPunctuation('animatePunctuation', delay, true, true);
						animtationIsInited = true;
					}
					
				});
				
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

        <script>
            // init audio + ui only after DOM is loaded
            // https://stackoverflow.com/questions/9899372/pure-javascript-equivalent-of-jquerys-ready-how-to-call-a-function-when-t
            (function() {
                console.log('** DOM ready **');
                init_audio();
                init_ui();
            })();
        </script>
	</body>
</html>

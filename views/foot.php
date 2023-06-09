		    </div> <!-- end of #color -->
		</div> <!-- end of #animatePunctuation -->
		<!-- outside of #animatePunctuation, so dont animate punctuation -->

		<script type="text/javascript">
			var animate = checkCookie("animateCookie");
            var home = <?= json_encode(!$uri[1]); ?>;    
            var random = <?= json_encode($random); ?>;
            var email = <?= json_encode(isset($uri[1]) && $uri[1] == 'emails'); ?>; 

			delay = (checkCookie("delayCookie")) ? ((getCookie("delayCookie")) * 1) : 200;
            debug_();
            if (home || random)
			    initPunctuation("animatePunctuation", delay, true, true);
			else if(!email) {
                animate = false;    /* ugly */
                toggleColor("color", "white");
			    initPunctuation("animatePunctuation", delay, true, animate);
                document.getElementById('logo_mark').addEventListener('click', ()=>{
                    startStopAnimatePunctuation();
                });
            }
            
		</script>
        <script>
            (function() {
                if(!email)
                {
                    console.log('** DOM ready **');
                    if(typeof init_audio !== 'undefined') init_audio();
                    init_ui();
                }
            })();
        </script>
	</body>
</html>

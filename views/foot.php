		    </div> <!-- end of #color -->
		</div> <!-- end of #animatePunctuation -->
		<!-- outside of #animatePunctuation, so dont animate punctuation -->

		<script type="text/javascript">
			var animate = checkCookie("animateCookie");
            var home = <?= json_encode(!$uri[1]); ?>;    
			delay = (checkCookie("delayCookie")) ? ((getCookie("delayCookie")) * 1) : 200;
            if (home)
			    initPunctuation("animatePunctuation", delay, true, true);
			else {
                swapClass("color","black","white");
			    initPunctuation("animatePunctuation", delay, true, animate);
            }
            document.getElementById('logo_mark').addEventListener('click', ()=>{
                startStopAnimatePunctuation();
			});
		</script>
        <script>
            (function() {
                console.log('** DOM ready **');
                init_audio();
                init_ui();
            })();
        </script>
	</body>
</html>

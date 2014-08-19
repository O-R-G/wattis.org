<?php
require_once("GLOBAL/head.php");
?>

	<div id="animatePunctuation" class="">
	<div id="color" class="black">

        <div class="logoContainer times big logo fixed animatePunctuation">
        <span id="logo" onmousedown="startStopAnimatePunctuation(200);" class="control">.+*</span>
        <a href="<?php echo ($pageName == 'index') ? 'main' : 'index?alt=1'; ?>" style="color:#000;">The Wattis Institute</a>
        </div>

        </div>
        </div>
        </div>

        <script type="text/javascript">

                var animate = checkCookie("animateCookie");

                <?php if ($pageName=="index") { ?>

                        initPunctuation("animatePunctuation", delay, true, true);

                        <?php if (!$alt) { ?>

                                var click = clickHandler();

                        <?php } ?>

                <?php } else { ?>

                        initPunctuation('animatePunctuation', delay, true, animate);

                <?php } ?>

        </script>

</body>
</html>

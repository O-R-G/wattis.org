<?php
require_once("GLOBAL/head.php");
?>

<div class="mainContainer times big black">

<span class="listContainer times show comment">
<canvas id="canvas1" width="46" height="22" class="show">[*]</canvas>
<a href="about.php">About the Wattis</a> . . . <i>what we do here.</i></span>

<span class="listContainer times show comment">
<canvas id="canvas2" width="46" height="22" class="show">\/\</canvas>
<a href="visit.php">Visit the Wattis</a> . . . <i>address, hours, and directions.</i></span>  

<span class="listContainer times show comment">
<canvas id="canvas3" width="46" height="22" class="show">(*)</canvas>
<a href="contact.php">Contact the Wattis</a> . . . <i>get in 
touch with the staff and find our mailing address.</i> </span> <br /> 
<br />

<span class="listContainer times show comment">
<canvas id="canvas4" width="46" height="22" class="show">% )</canvas>
<a href="support.php">Support the Wattis</a> . . . <i>become a 
member or make a donation.  This really helps us do what we do. Thank 
you.</i></span>  
	
<span class="listContainer times show comment">
<canvas id="canvas5" width="46" height="22" class="show">###</canvas>
<a href="editions.php">Buy Limited Editions</a> . . . <i>for an affordable price, own a work of art by 
major national and international artists.</i></span>  

<span class="listContainer times show comment">
<canvas id="canvas6" width="46" height="22" class="show">|||</canvas>
<a href="shop.php">Buy Catalogues</a> . . . <i>shop for books and exhibition catalogues related to past 
exhibitions.</i></span>  

<span class="listContainer times show comment">
<canvas id="canvas7" width="46" height="22" class="show">>>></canvas>
<a href="follow.php">Follow the Wattis</a> . . . <i>on 
Twitter, Facebook, Instagram, and Tumblr.</i></span>  

<span class="listContainer times show comment">
<canvas id="canvas8" width="46" height="22" class="show">:*</canvas>
<a href="intern.php">Intern at the Wattis</a> . . . <i>get hands-on experience working in a contemporary art 
center.</i></span>  

<span class="listContainer times show comment">
<canvas id="canvas9" width="46" height="22" class="show">>/?</canvas>
<a href="archive.php">Consult the Archive</a> . . . <i>information on past exhibition and past events (1998 – 
present)</i></span>  

<span class="listContainer times show comment">
<canvas id="canvas10" width="46" height="22" class="show">&+}</canvas>
<a href="cappstreet.php">Capp Street Project</a> . . . <i>founded by Ann Hatch in 1983, Capp Street Project 
became part of the Wattis in 1998.</i></span>  

</div>

<script type="text/javascript">

                message[1] =    [
                                "[*]",
                                "[.]",
                                "[!]"
                                ];

                delay[1] = 100;

                message[2] =    [
                                "\\/\\",
                                "/\\/",
                                "\\\\\\",
                                "///"
                                ];

                delay[2] = 100;

                message[3] =    [
                                "(-)",
                                "(+)",
                                "(*)",
                                ];

                delay[3] = 300;

                message[4] =    [
                                "% )",
                                "% )",
                                "% |"
                                ];

                delay[4] = 500;

                message[5] =    [
                                "#.#",
                                "...",
                                "..#",
                                "#..",
                                ".#."
                                ];

                delay[5] = 200;

                message[6] =    [
                                "|||",
                                ".||",
                                "..|",
                                "..."
                                ];

                delay[6] = 250;

                message[7] =    [
                                ">>>",
                                ".>>",
                                "..>",
                                "..."
                                ];

                delay[7] = 250;

                message[8] =    [
                                ":*",
                                ":*",
                                ":*",
                                ":*",
                                ":*",
                                ":*",
                                ":/",
                                ":|",
                                ":\\",
                                ":/",
                                ":|",
                                ":\\",
                                ":/",
                                ":|",
                                ":\\",
                                ];

                delay[8] = 100;

                message[9] =    [
                                ">/?",
                                ">/ "
                                ];

                delay[9] = 500;

                message[10] =    [
                                "&+}",
                                "&  ",
                                "&+}",
                                " + ",
                                "&+}",
                                "  }"
                                ];

                delay[10] = 500;

window.onload=initEmoticons(11, message, delay);
</script>

<?php
require_once("GLOBAL/foot.php");
?>


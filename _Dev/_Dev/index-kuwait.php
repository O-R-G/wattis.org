<?php 
	require_once("GLOBAL/head.php"); 
?>

<?php
if ( ($dev) || ($live) ) {
?>


	<!-- MIDDLE -->

	<div id='00' class="middleContainer">
		<video height="480" width="853" autoplay="autoplay" loop muted style="margin-top:-240px;margin-left:-426px;"> 
			<source src="MEDIA/To-be-continued_01_white_480p_low.mov" type="video/mp4" />
	  		Your browser does not support the video tag.
		</video>
	</div>	

	<!--
	<div id='00' class="middleContainer" style="margin-top:0px;margin-left:-350px;">
		<img src="MEDIA/00001.jpg" width=800>
	</div>	
	-->
	<!-- <div id='00' class="middleContainer" style="margin-top:-340px; margin-left:-425px;"> -->
		<!-- <img src="MEDIA/Kuwait-National-Museum-build" width=900> -->
		<!-- <img src="MEDIA/Kuwait-National-Museum-build-inverse-pattern.gif" width=900> -->
		<!-- <img src="MEDIA/00017.jpg" width=850> -->
            	<!-- <img src="MEDIA/Trailer.gif" width=900> -->
		<!-- <img src="MEDIA/00014.gif" width=850> -->
	<!-- </div> -->

        <!-- MAIN -->

        <div id='main' class='<?php echo ($language == "en") ? "englishMainContainer" : "arabicMainContainer" ?>'>

        <!-- MENU -->

        <div id='menu' class='<?php echo ($language == "en") ? "englishMenuContainer blue " : "arabicMenuContainer red " ?> tahoma'>

                <p dir="rtl" lang="AR" class="tahoma green">

                <ul>
                        <?php
                                if ( $language == "en" ) $path = "14";
                                if ( $language == "ar" ) $path = "15";
                                $limit = 1;
                                $selection = $idFull;
                                // $linkPageName = $pageName;
                                $linkPageName = "detail";                       // probably want to fix this and set using O-R$
                                $breadcrumbsMode = FALSE;
                                $multiColumn = 0;
                                $stub = FALSE;
                                $breadcrumbsMode = FALSE;
                                $thisLanguage = $language;
                                if (!$breadcrumbsMode) ($id) ? $breadcrumbsMode = TRUE : $breadcrumbsMode = FALSE;

                                displayNavigation($path, $limit, $selection, $linkPageName, $stub, $breadcrumbsMode, $multiColumn, $thisLanguage);
                        ?>
                </ul>
        </p>
        </div>


		<?php
		/*
			// Query uses LEFT JOIN and multiple selection criteria to get objects with and without media from Front Page and News and return these in randomly sequenced rows . . . returns NULL if no media object attached to record

			$returns = rand(3,8);			
			$baseRecord = "_Home";

			$sql    = "SELECT objects.id AS objectsId, objects.name1, objects.deck, objects.active, objects.rank as objectsRank, objects.url, objects.end, wires.fromid, wires.toid, wires.active, media.id AS mediaId, media.object, media.type, media.caption AS mediaCaption, media.active, media.rank FROM objects, wires LEFT JOIN media ON media.object = wires.toid WHERE wires.fromid = (SELECT objects.id FROM objects WHERE objects.name1 LIKE '$baseRecord' AND objects.active='1' LIMIT 1)  AND wires.toid = objects.id AND objects.active = 1 AND wires.active = 1 AND ((media.rank IS NULL AND media.active IS NULL) OR (media.rank = 1 AND media.active = 1) OR (media.active = 1)) ORDER BY RAND() LIMIT $returns";
			
			$result =  MYSQL_QUERY($sql);	

			while ( $myrow  =  MYSQL_FETCH_ARRAY($result) ) {
					
				$marginer = rand(10, 100);
				$html = "\n	<a href='detail.php?id=" . $myrow['objectsId'] . "'>";
				$html .= "<div class = 'thumbsContainer black euler' style = 'margin:" . $marginer . "px;'>";
				$mediaFile = "MEDIA/". str_pad($myrow["mediaId"], 5, "0", str_pad_left) .".". $myrow["type"];
				$mediaCaption = strip_tags($myrow["mediaCaption"]);
				$name = strip_tags($myrow["name1"]);
				$sizer = rand(75, 95) * .01;
				$specs  = getimagesize($mediaFile);				

				if ($specs[0] > $specs[1]) {
								
					$mediaStyle = "width:" . ($sizer * $specs[0]) . "px;";
					
				} else {

					$mediaStyle = "height:" . ($sizer * $specs[1]) . "px;";
				}
							
				$html .= "\n	". displayMedia($mediaFile, $mediaCaption, $mediaStyle);
				$html .= "<div class = 'captionContainer caption'>";
				$html .= $name;
				$html .= "</div>";
				$html .= "</div>";
				$html .= "</a>";
				echo $html;		
			}
		}
		*/ 
		?>
	
        </div> 

	<!-- /MAIN -->

<?php
}
?>

<?php	
	echo "\n\n\n\n\n";
	require_once("GLOBAL/foot.php"); 
?>

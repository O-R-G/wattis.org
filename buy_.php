<?php
require_once("GLOBAL/head.php");
?>

<div class="mainContainer times big">

	<?php

        $rootid = $ids[0];

        // SQL object plus media plus rootname

        $sql = "SELECT objects.id AS objectsId, objects.name1, objects.deck, objects.body,
objects.notes, objects.active, objects.begin, objects.end, objects.rank as objectsRank, (SELECT
objects.name1 FROM objects WHERE objects.id = $rootid) AS rootname, media.id AS mediaId,
media.object AS mediaObject, media.type, media.caption, media.active AS mediaActive, media.rank
FROM objects LEFT JOIN media ON objects.id = media.object AND media.active = 1 WHERE objects.id =
$id AND objects.active ORDER BY media.rank;";

        $result = MYSQL_QUERY($sql);
        $myrow = MYSQL_FETCH_ARRAY($result);
        $rootname = $myrow['rootname'];
        $name = $myrow['name1'];
        $deck = $myrow['deck'];
        $body = $myrow['body'];
        mysql_data_seek($result, 0);    // reset to row 0
        $html = "";
        $i=0;


        // collect images

        while ( $myrow  =  MYSQL_FETCH_ARRAY($result) ) {

                if ($myrow['mediaActive'] != null) {

                        $mediaFile = "MEDIA/". str_pad($myrow["mediaId"], 5, "0", STR_PAD_LEFT) .".". $myrow["type"];
                        $mediaCaption = strip_tags($myrow["caption"]);
                        $mediaStyle = "width: 100%;";

                        if ( $i == 0 ) {

                                $specs  = getimagesize($mediaFile);
                                // $use4xgrid = (($specs[0]/$specs[1]) < 1) ? TRUE : FALSE;
                                $use4xgrid = ($rootname == "Buy Catalogs") ? TRUE : FALSE;

                        }

                        $images[$i] .= "<div id='image".$i."' class = '" . (($use4xgrid) ? "listContainer twocolumn" : "") . "'>";
                        $images[$i] .= displayMedia($mediaFile, $mediaCaption, $mediaStyle);
                        $images[$i] .= "</div>";

			$images[$i] .= "<div class='clear'></div>";
                        $i++;
                }
        }

   
	// nav

	$html .= "<div class='listContainer times'>";
	$html .= $name;
	$html .= "</div>";	


        // images

        $html .= "<div class='listContainer doublewide'>";

        for ( $j = 0; $j < count($images); $j++) {

                $html .= $images[$j];
        }


	// order

        $html .= "<div class='listContainer twocolumn doublewide helvetica small'>";
	$html .= "</div>";
        $html .= "<div class='listContainer twocolumn helvetica small'>";
	$html .= $mediaCaption . "<br/>";
        $html .= $deck;
        // $html .= "<br /><br /><a href='mailto:arabinovitch@cca.edu'>Please email for ordering information</a>";
        // $html .= "<br /><br /><a href='mailto:csquier@cca.edu'>Please email for ordering information</a>";
        $html .= "<br /><br /><a href='mailto:jgerrity@cca.edu'>Please email for ordering information</a>";
	$html .= "</div>";


	// body

        $html .= "<div class='listContainer twocolumn times'>";
        $html .= $body;
        $html .= "</div>";

        $html .= "</div>";
	echo nl2br($html);
	?>

<?php
require_once("GLOBAL/foot.php");
?>

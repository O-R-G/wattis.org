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
        $image_ratio = 0;
        $image_tallest = 0;
        
        // collect images
        while ( $myrow  =  MYSQL_FETCH_ARRAY($result) ) {

                if ($myrow['mediaActive'] != null) {

                        $mediaFile = "MEDIA/". str_pad($myrow["mediaId"], 5, "0", STR_PAD_LEFT) .".". $myrow["type"];
                        $mediaCaption = strip_tags($myrow["caption"]);
                        $mediaStyle = "width: 100%; position: absolute; top: 0; left: 0; opacity: 0; top: 50%; transform: translate(0, -50%);";
                        $this_img_size  = getimagesize($mediaFile);
                        // h / w
                        if($this_img_size[1] / $this_img_size[0] > $image_ratio){
                                $image_ratio = $this_img_size[1] / $this_img_size[0];
                                $image_tallest = $i;
                        }

                        if ( $i == 0 ) {

                                $specs  = getimagesize($mediaFile);
                                // $use4xgrid = (($specs[0]/$specs[1]) < 1) ? TRUE : FALSE;
                                $use4xgrid = ($rootname == "Buy Catalogs") ? TRUE : FALSE;
                        	$mediaStyle = "width: 100%; padding: 10px;";
                                // $mediaStyle = "width: 100%; position: absolute; top: 0; left: 0; opacity: 1; top: 50%; transform: translate(0, -50%);";

                        }

                        $images[$i] .= "<div id='image".$i."' class = 'buy_images " . (($use4xgrid) ? "listContainer twocolumn" : "") . "'>";
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
        $html .= "<div id = 'gallery_static_ctner'>";
        for ( $j = 0; $j < count($images); $j++) {

                $html .= $images[$j];
        }
        $html .= "<div id = 'gallery_control_ctner' style = 'display:none;'><div id = 'btn_prev' class = 'gallery_control'>&lt;</div><div id = 'nods_ctner' class = 'gallery_control'></div><div id = 'btn_next' class = 'gallery_control'>&gt;</div></div>";
        $html .= "</div>";

	// order

        $html .= "<div class='listContainer twocolumn doublewide helvetica small'>";
	$html .= "</div>";
        $html .= "<div class='listContainer twocolumn helvetica small'>";
	$html .= $mediaCaption . "<br/>";
        $html .= $deck;
        // $html .= "<br /><br /><a href='mailto:arabinovitch@cca.edu'>Please email for ordering information</a>";
        // $html .= "<br /><br /><a href='mailto:csquier@cca.edu'>Please email for ordering information</a>";
        // $html .= "<br /><br /><a href='mailto:jgerrity@cca.edu'>Please email for ordering information</a>";
        $html .= "<br /><br /><a href='mailto:jgerrity@cca.edu'>Please email for international orders</a>";
	$html .= "</div>";


	// body

        $html .= "<div class='listContainer twocolumn times'>";
        $html .= $body;
        $html .= "</div>";

        $html .= "</div>";
	echo nl2br($html);
	?>
<script src = '/JS/gallery_static.js'></script>
<script>
        var image_tallest_index = <?php echo $image_tallest; ?>;
        var image1 = document.getElementById('image1');
        if(image1 != null){
                image_ctner = image1.parentElement;
                image_ctner.style.position = 'relative';
                var images = document.querySelectorAll('.buy_images img');
                // console.log(images);
                if(images.length > 1){
                        image_tallest = images[image_tallest_index];
                        image_tallest.style.position = 'relative';
                        image_tallest.style.top = 0;
                        image_tallest.style.transform = 'translate(0, 0)';

                        var sGallery_control_ctner = document.getElementById('gallery_control_ctner');
                        sGallery_control_ctner.style.display = 'block';
                        var nods_ctner = document.getElementById('nods_ctner');
                        for(i = 0; i< images.length ; i++){
                                console.log(images.length);
                                var nod = document.createElement('div');
                                nod.className = 'nods';
                                nods_ctner.appendChild(nod);
                        }
                        var sNods = document.getElementsByClassName('nods');
                        launch_static(0);
                }
                
        }else{
               var image1 = document.getElementById('image0');
               if(image0 != null){
                        image0.firstChild.style.position = 'relative';
                        image0.firstChild.style.top= 0;
                        image0.firstChild.style.transform = 'translate(0, 0)';
               }
        }


</script>

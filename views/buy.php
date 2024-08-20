<?
    require_once('static/php/displayMedia.php');
    // $ids[0] is main
    $rootid = $uri[1] === 'shop' ? $ids[2] : $ids[1];
    $root_item = $oo->get($rootid);
    $rootname = $root_item["name1"];
    $rootbody = $root_item['body'] ? $root_item['body'] : '';

    $name = $item['name1'];
    $deck = $item['deck'];
    $body = $item['body'];

    $media = $oo->media($item['id']);
    $image_ratio = 0;
    $image_tallest = 0;

    // $use4xgrid = ($rootname == "Buy Catalogs" || $rootname == 'Books') ? TRUE : FALSE;
    $use4xgrid = FALSE;
    $mediaStyle = "width: 100%; padding: 10px;";
    $html = '';
?>
<div class="mainContainer times big">

	<?php

        // $rootid = $ids[0];

        // SQL object plus media plus rootname

        $sql = "SELECT objects.id AS objectsId, objects.name1, objects.deck, objects.body,
objects.notes, objects.active, objects.begin, objects.end, objects.rank as objectsRank, (SELECT
objects.name1 FROM objects WHERE objects.id = $rootid) AS rootname, media.id AS mediaId,
media.object AS mediaObject, media.type, media.caption, media.active AS mediaActive, media.rank
FROM objects LEFT JOIN media ON objects.id = media.object AND media.active = 1 WHERE objects.id =
$id AND objects.active ORDER BY media.rank;";

   //      $result = MYSQL_QUERY($sql);
   //      $myrow = MYSQL_FETCH_ARRAY($result);
   //      $rootname = $myrow['rootname'];
   //      $name = $myrow['name1']);
   //      $deck = $myrow['deck']);
   //      $body = $myrow['body']);
   //      mysql_data_seek($result, 0);    // reset to row 0
   //      $html = "";
   //      $i=0;
   //      $image_ratio = 0;
   //      $image_tallest = 0;
        
   //      // collect images
   //      while ( $myrow  =  MYSQL_FETCH_ARRAY($result) ) {

   //              if ($myrow['mediaActive'] != null) {

   //                      $mediaFile = "MEDIA/". str_pad($myrow["mediaId"], 5, "0", STR_PAD_LEFT) .".". $myrow["type"];
   //                      $mediaCaption = strip_tags($myrow["caption"]);
   //                      $mediaStyle = "width: 100%; position: absolute; top: 0; left: 0; opacity: 0; top: 50%; transform: translate(0, -50%);";
   //                      $specs  = getimagesize($mediaFile);
   //                      // h / w
   //                      if($specs[1] / $specs[0] > $image_ratio){
   //                              $image_ratio = $specs[1] / $specs[0];
   //                              $image_tallest = $i;
   //                      }

   //                      if ( $i == 0 ) {

   //                              $specs  = getimagesize($mediaFile);
   //                              // $use4xgrid = (($specs[0]/$specs[1]) < 1) ? TRUE : FALSE;
   //                              $use4xgrid = ($rootname == "Buy Catalogs") ? TRUE : FALSE;
   //                      	$mediaStyle = "width: 100%; padding: 10px;";
   //                              // $mediaStyle = "width: 100%; position: absolute; top: 0; left: 0; opacity: 1; top: 50%; transform: translate(0, -50%);";

   //                      }

   //                      $images[$i] .= "<div id='image".$i."' class = 'buy_images " . (($use4xgrid) ? "listContainer twocolumn" : "") . "'>";
   //                      $images[$i] .= displayMedia($mediaFile, $mediaCaption, $mediaStyle);
   //                      $images[$i] .= "</div>";

			// $images[$i] .= "<div class='clear'></div>";
   //                      $i++;
   //              }
   //      }
   ?>
   <div class='listContainer times side-listContainer'><?= $name; ?></div><div class='listContainer main-listContainer'>
       <div id = 'gallery_static_ctner'>
        <?
            foreach($media as $key => $m)
            {
                $mediaFile_temp = "media/". m_pad($m['id']) .".". $m["type"];
                $specs  = getimagesize($mediaFile_temp);
                if($specs[1] / $specs[0] > $image_ratio){
                    $image_ratio = $specs[1] / $specs[0];
                    $image_tallest = $key;
                }

                $mediaFile = m_url($m);
                $mediaCaption = strip_tags($m["caption"]);
                ?><div id='image<?= $key; ?>' class = 'buy_images <?= (($use4xgrid) ? "listContainer half-width" : ""); ?>'><?= displayMedia($mediaFile, $mediaCaption, $mediaStyle); ?></div><?
            }
        ?>
            <div id = 'gallery_control_ctner' style = 'display:none;'>
                <div id = 'btn_prev' class = 'gallery_control'>&lt;</div>
                <div id = 'nods_ctner' class = 'gallery_control'></div>
                <div id = 'btn_next' class = 'gallery_control'>&gt;</div>
            </div>
       </div>
       <div class='listContainer half-width doublewide helvetica small'></div><div class='listContainer half-width helvetica small'>
            <?= $mediaCaption; ?><br>
            <?= $deck; ?><br><br>
            <a href='mailto:jgerrity@cca.edu'>Please email for international orders</a>
        </div><div class='listContainer half-width times'><?= $body; ?></div>

   </div>
   <?
	// nav

	$html .= "<div class='listContainer times'>";
	$html .= $name;
	$html .= "</div>";	


        // images

        $html .= "<div class='listContainer doublewide'>";
        $html .= "<div id = 'gallery_static_ctner'>";
        // for ( $j = 0; $j < count($images); $j++) {

        //         $html .= $images[$j];
        // }
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
	// echo $html);
	?>
<script src = '/static/js/gallery_static.js'></script>
<script>
        var image_tallest_index = <?php echo $image_tallest; ?>;
        var image1 = document.getElementById('image1');
        if(image1 != null){
            image_ctner = image1.parentElement;
            image_ctner.style.position = 'relative';
            var images = document.querySelectorAll('.buy_images img');
            var sBuy_images = document.querySelectorAll('.buy_images');
            // console.log(images);
            if(images.length > 1){
                image_tallest = sBuy_images[image_tallest_index];
                var sGallery_control_ctner = document.getElementById('gallery_control_ctner');
                sGallery_control_ctner.style.display = 'block';
                var nods_ctner = document.getElementById('nods_ctner');
                for(i = 0; i< images.length ; i++){
                        var nod = document.createElement('div');
                        nod.className = 'nods';
                        nods_ctner.appendChild(nod);
                }
                var sNods = document.getElementsByClassName('nods');
                gallery_static.launch(sBuy_images, sGallery_control_ctner, image_tallest_index);
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

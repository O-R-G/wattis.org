<script type="text/javascript" src="/static/js/gallery.js"></script>


		<div class="mainContainer times big"><?php
		// $ids = $oo->urls_to_ids($uri);
		$isFound = false;
		// check if in main
		$main_id = end($oo->urls_to_ids(array('main')));
		$main_children = $oo->children($main_id);
		foreach($main_children as $child)
		{
			if($child['url'] == $uri[1] && count($uri) == 2)
			{
				$rootid = $child['id'];
				$id = $rootid;
				$isFound = true;
				break;
			}
		}
		// check if in root
		if(!$isFound)
		{
			$root_children = $oo->children(0);
			foreach($root_children as $child)
			{
				if($child['url'] == $uri[1] && count($uri) == 2)
				{
					$rootid = $child['id'];
					$id = $rootid;
					$isFound = true;
					break;
				}
			}
		}

		if(!$isFound)
		{
			$id = $_REQUEST['id'];		// no register globals	
			if (!$id) $id = "0";
			$ids = explode(",", $id);
			$idFull = $id;
			$id = $ids[count($ids) - 1];
			$rootid = $ids[0];
		}


		// if(end($uri) == 'about')
		// {
		// 	$rootid = end($oo->urls_to_ids(array('main', 'about')));
		// 	$id = $rootid;
		// }
		// elseif(end($uri) == 'visit')
		// {
		// 	$rootid = end($oo->urls_to_ids(array('main', 'visit')));
		// 	$id = $rootid;
		// }
		// elseif(end($uri) == 'contact')
		// {
		// 	$rootid = end($oo->urls_to_ids(array('main', 'contact')));
		// 	$id = $rootid;
		// }
		// elseif(end($uri) == 'follow')
		// {
		// 	$rootid = end($oo->urls_to_ids(array('main', 'follow')));
		// 	$id = $rootid;
		// }
		// elseif(end($uri) == 'support')
		// {
		// 	$rootid = end($oo->urls_to_ids(array('main', 'support')));
		// 	$id = $rootid;
		// }
		// elseif(end($uri) == 'archive')
		// {
		// 	$rootid = end($oo->urls_to_ids(array('main', 'archive')));
		// 	$id = $rootid;
		// }
		// elseif(end($uri) == 'capp')
		// {
		// 	$rootid = end($oo->urls_to_ids(array('main', 'capp')));
		// 	$id = $rootid;
		// }
		// elseif(end($uri) == 'intern')
		// {
		// 	$rootid = end($oo->urls_to_ids(array('main', 'intern')));
		// 	$id = $rootid;
		// }
		// elseif(end($uri) == 'program')
		// {
		// 	$rootid = end($oo->urls_to_ids(array('program')));
		// 	$id = $rootid;
		// }
		// elseif( end($uri) == 'view' ||
		// 		$uri[1] == 'calendar'
		// 	   )
		// {
		// 	// die();
		// 	$id = $_REQUEST['id'];		// no register globals	
		// 	if (!$id) $id = "0";
		// 	$ids = explode(",", $id);
		// 	$idFull = $id;
		// 	$id = $ids[count($ids) - 1];
		// 	$rootid = $ids[0];
		// }

		// var_dump($rootid);

		// SQL object plus media plus rootname
		$sql = "SELECT 
					objects.id AS objectsId, 
					objects.name1, objects.deck, objects.body, objects.notes, 
					objects.active, objects.begin, objects.end, 
					objects.rank as objectsRank, 
					(
						SELECT 
							objects.name1 
						FROM objects 
						WHERE objects.id = $rootid
					) AS rootname, 
					media.id AS mediaId, 
					media.object AS mediaObject, 
					media.type, 
					media.caption, 
					media.active AS mediaActive, 
					media.rank 
				FROM 
					objects 
				LEFT JOIN 
					media 
				ON 
					objects.id = media.object 
					AND media.active = '1' 
				WHERE 
					objects.id = $id 
					AND objects.active = '1'
				ORDER BY media.rank;";

		$result = $db->query($sql);
		if(!$result)
			throw new Exception($db->error);
		$items = array();
		while ($obj = $result->fetch_assoc())
			$items[] = $obj;
		$items = $items[0];
		$rootname = $items['rootname'];
		$name = $items['name1'];
		$body = $items['body'];
		$notes = $items['notes'];
		$begin = $items['begin'];
		$end = $items['end'];
		mysql_data_seek($result, 0);    // reset to row 0    
		    $html = "";
		$i=0;
		// $result->close();
		// search for embedded image tags
		$pattern = "/\[image(\d+)\]/";
		preg_match_all($pattern, $body, $out, PREG_PATTERN_ORDER);
		$img_indexes = $out[1];

		// collect images
		// collect captions
		$image_files = array();
		$image_captions = array();
		while($myrow = MYSQL_FETCH_ARRAY($result)) 
		{
			if($myrow['mediaActive'] != null) 
			{
				$media = $oo->media($myrow['objectsId']);
				$mediaFile = m_url($media[$i]);
				// $mediaFile = "/media/". str_pad($myrow["mediaId"], 5, "0", STR_PAD_LEFT) .".". $myrow["type"];
				$mediaCaption = strip_tags($myrow["caption"]);
				$mediaStyle = "width: 100%;";
				if($myrow["type"] == "pdf")
					$image_files[] = ("/media/pdf.gif");
				else
					$image_files[] = $mediaFile;
		        $image_captions[] = $mediaCaption;		

				if(in_array($i+1, $img_indexes))
				{
					// $randomWidth = rand(15, 25);
					$width = 90;    // 90% of text column

					if(!$isMobile)
					{
						// $images[$i] .= "<div id='image".$i."' class = 'inline-img-container' style='width: $randomWidth%;' onclick='launch($i);'>";
						$images[$i] .= "<div id='image".$i."' class = 'inline-img-container' style='width: $width%;' onclick='launch($i);'>";
					}
					else
					{				
						// $images[$i] .= "<div id='image".$i."' class = 'imageContainer'>";
						$images[$i] .= "<div id='image".$i."' class = 'imageContainer'>";
					}
					
					$images[$i] .= displayMedia($mediaFile, $mediaCaption, $mediaStyle);
					$images[$i] .= "<div class='captionContainer monaco small'>" . $image_captions[$i] . "</div>";
					$images[$i] .= "</div>";
					// insert images into body
					// remove leading and trailing whitespace for consistency
					// (necessary whitespace is added in css)
					$pattern = "/\[image".($i+1)."\]/";
					$body = preg_replace($pattern, $images[$i], $body);
					unset($images[$i]);
				}
				else 
				{
					$randomPadding = rand(0, 150);
					$randomWidth = rand(30, 50);
					$randomFloat = (rand(0, 1) == 0) ? 'left' : 'right';
				
					if(!$isMobile)
					{
						$images[$i] .= "<div class = 'imageContainerWrapper' style='width:" . $randomWidth . "%; float:" . $randomFloat . ";'>";
						// $images[$i] .= "<div id='image".$i."' class = 'imageContainer' style='padding-top:" . $randomPadding . "px; margin:40px;' onclick='expandImageContainerMargin(this, \"40px\", \"-80px\");'>";
						$images[$i] .= "<div id='image".$i."' class = 'imageContainer' style='padding-top:{$randomPadding}px; margin:40px;' onclick='launch($i);'>";
					}
					else
					{
						$images[$i] .= "<div class='imageContainerWrapper'>";
						$images[$i] .= "<div id='image".$i."' class = 'imageContainer'>";
					}
					$images[$i] .= displayMedia($mediaFile, $mediaCaption, $mediaStyle);
					$images[$i] .= "<div class='captionContainer caption helvetica small'>";
					$images[$i] .= $mediaCaption;
					$images[$i] .= "</div>";
					$images[$i] .= "</div>";
					$images[$i] .= "</div>";
				}
			}
			$i++;
		}
		$result->close();
		// Check for column breaks
		$pattern = "/\/\/\//";
		if(preg_match($pattern, $body) == 1) 
			$columns = preg_split($pattern, $body);
		$firstChar = substr($columns[0], 0, 1);
		while( ord($firstChar) == 9 || 
			   ord($firstChar) == 10 || 
			   ord($firstChar) == 13
			 )
		{
			$columns[0] = substr($columns[0], 1);
			$firstChar = substr($columns[0], 0, 1);
		}
		$firstChar = substr($columns[1], 0, 1);
		while( ord($firstChar) == 9 || 
			   ord($firstChar) == 10 || 
			   ord($firstChar) == 13
			 )
		{
			$columns[1] = substr($columns[1], 1);
			$firstChar = substr($columns[1], 0, 1);
		}
		// search for strings that match [\d+] where \d+ = n
		// replace with image container = n
		// remove image container n from array of images
		// print out rest of images at the end (as normal images?)

		// hours
		$html .= "<div class='listContainer times title-block'>";
		if ($begin || $end) 
		{
			// build date display
			$bstr = strtotime($begin);
			$estr = strtotime($end); 
			$displayHours = (date("H",$bstr) != '00') ? true : false;		
			$displayYears = (date("Y",$bstr) != date("Y",$estr)) ? true : false;		
			$displayDatesEnd = (date("z",$bstr) != date("z",$estr)) ? true : false;

			if($begin)
			{
				$beginDisplayHours = "g";
				if (date("i",$bstr) != '00') $beginDisplayHours .= ".i";
				if (!$end) $beginDisplayHours .= " a";
				$beginHours = date($beginDisplayHours,$bstr);
				$hoursDisplay = "<br />" . $beginHours;

				$beginDisplayDates = ($displayDatesEnd) ? (($displayYears) ? "F j, Y" : "F j") : "F j, Y";
				if (!$end) $beginDisplayDates .= ", Y";
				$beginDates = date($beginDisplayDates,$bstr);
				$datesDisplay = $beginDates;
			}

			if($end)
			{
				$endDisplayHours = "g";
				if (date("i",$estr) != '00') $endDisplayHours .= ".i";
				$endDisplayHours .= " a";
				$endHours = date($endDisplayHours,$estr);
				$hoursDisplay = "<br />" . $beginHours . ' – ' . $endHours;

				$endDisplayDates = "F j, Y";
				$endDates = date($endDisplayDates,$estr);

				if ($displayDatesEnd) $datesDisplay = $beginDates . ' –<br />' . $endDates;
			}		

			$html .= $datesDisplay;
			// if ($displayHours) $html .= $hoursDisplay;

		} 
		else
		{
			$html .= $name;	
		}

		$html .= "</div>";

		// body
		if($columns) 
		{
			// column 2
			$html .= "<div class='listContainer times'>";
			$html .= $columns[0];	
			$html .= "</div>";	
						
			// column 3
			$html .= "<div class='listContainer times'>";
			$html .= $columns[1];	
			$html .= "</div>";              	
		} 
		else 
		{
			$html .= "<div class='listContainer doublewide centered times'>";
			$html .= $body;
			$html .= "</div>";
		}


		// images        	
		$html .= "<div class='clear'></div>";
		$html .= "<div class='galleryContainer'>";
		if(is_array($images))
		{
			for($j = 0; $j < count($images); $j++)
			{
				$html .= $images[$j];
			}
		}

		// video
		if($notes)
		{
			$html .= "<span class=''>";
			$html .= $notes;	                  
			$html .= "</span>";	
		}

			$html .= "</div>";
		echo nl2br($html);
			?><div id="gallery" class="center hidden">
				<div id="gallery-ex" onclick="close_gallery();"><img src="/media/svg/ex.svg"></div>
				<div id="gallery-prev" onclick="prev();"><img src="/media/svg/prev.svg"></div>
				<div id="gallery-next" onclick="next();"><img src="/media/svg/next.svg"></div>
				<img id="img-gallery" class="center" src="/media/00554.jpg">
				<div id="img-gallery-caption" class='centerbottom monaco small'>. . .</div>
			</div>
			<script type="text/javascript">
				var images = <?php echo json_encode($image_files); ?>;
				var captions = <?php echo json_encode($image_captions); ?>;
				var gallery_id = "gallery";
				var gallery_img = "img-gallery";
				var gallery_img_caption = "img-gallery-caption";
				var index = 0;
				var inGallery = false;
				var attached = false;
				var gallery = document.getElementById(gallery_id);
			</script>
		</div>
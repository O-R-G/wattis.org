<? 
require_once('static/php/displayMedia.php');
$isFound = false;
$temp = $oo->urls_to_ids(array('main'));
$main_id = end($temp);
$main_children = $oo->children($main_id);
$id = end($ids);

foreach($main_children as $child)
{
	if($child['url'] == $uri[1] && count($uri) == 2)
	{
		$rootid = $child['id'];
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
			$isFound = true;
			break;
		}
	}
}

if(!$isFound)
{
	if( isset($_REQUEST['id']) )
		$id = $_REQUEST['id'];
	else if(isset($item['id']))
		$id = $item['id'];
	else
		$id = 0;
	$ids = explode(",", $id);
	$idFull = $id;
	$id = $ids[count($ids) - 1];
	$rootid = $ids[0];
}

$root_item = $oo->get($rootid);
$rootname = nl2br($root_item["name1"]);

$name  = isset($item['name1']) ? $item['name1'] : '';
$body  = isset($item['body']) ? nl2br($item['body']) : '';
$deck  = isset($item['deck']) ? nl2br($item['deck']) : '';
$notes = isset($item['notes']) ? nl2br($item['notes']) : '';
$begin = isset($item['begin']) ? $item['begin'] : '';
$end   = isset($item['end']) ? $item['end'] : '';

$pattern = "/\[image(\d+)\]/";
preg_match_all($pattern, $body, $out, PREG_PATTERN_ORDER);
$img_indexes = $out[1];
$media = $oo->media($item['id']);


$menu_tag = '[menu]';
$isMenu = false;
if(strpos($item['name1'], $menu_tag) !== false){
	$isMenu = true;
	$menu_items_level_uri = $uri;
	array_shift($menu_items_level_uri);
	$this_menu_item_url = $item['url']; 
}
else
{
	$uri_temp = $uri;
	if(in_array( $uri_temp[1], $main_children_url))
		$uri_temp[0] = 'main';
	elseif(in_array( $uri_temp[1], $home_children_url))
		$uri_temp[0] = 'home';
	else
		array_shift($uri_temp);
	for($i = 0; $i < count($uri) ; $i++)
	{
		if(!empty($uri_temp))
		{
			$temp = $oo->urls_to_ids($uri_temp);
			$this_ancestor_id = end($temp);
			$this_ancestor_name1 = $oo->name($this_ancestor_id);
			if(strpos($this_ancestor_name1, $menu_tag) !== false){
				$isMenu = true;
				$menu_items_level_uri = $uri_temp;
				$this_menu_item_url = end($uri_temp); 
				break;
			}
		}
		
	}
}

if($isMenu)
{

	$menu_items = array();
	$menu_level_uri = $menu_items_level_uri;
	array_pop($menu_level_uri);
	$parent_id = end($oo->urls_to_ids($menu_level_uri));
	$siblings = $oo->children($parent_id);
	foreach($siblings as $s)
	{
		if( strpos($s['name1'], $menu_tag) !== false &&
			substr($s['name1'], 0, 1) != '.' )
		$menu_items[] = $s;
	}

	$children = $oo->children($item['id']);
	if(count($children) > 0)
	{
		$default = false;
		foreach($children as $child)
		{
			if($child['name1'] == '[default]')
			{
				$default = $child;
				break;
			}
		}
		if(!$default)
			$default = $children[0];
		$name = $default['name1'];
		$body = $default['body'];
		$notes = $default['notes'];
		$begin = $default['begin'];
		$end = $default['end'];
		$media = $oo->media($default['id']);
	}
}

?>
<script type="text/javascript" src="/static/js/gallery.js"></script>
	<div class="mainContainer times big">
		<div class='listContainer side-listContainer times title-block'><?
		// echo 'view.php<br>';
		if ($begin || $end) {
			// build date display
			$bstr = strtotime($begin);
			$estr = strtotime($end); 
			$displayHours = (date("H",$bstr) != '00') ? true : false;		
			$displayYears = (date("Y",$bstr) != date("Y",$estr)) ? true : false;		
			$displayDatesEnd = (date("z",$bstr) != date("z",$estr)) ? true : false;

			if($begin) {
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

			echo nl2br($datesDisplay);
			// if ($displayHours) $html .= $hoursDisplay;

		    if($deck) {
			    ?><div id='deck' class=''><?= $deck; ?></div><?
		    }
		} else if($isMenu) {
			$url_base = '/' . implode($menu_level_uri, '/');
			foreach($menu_items as $mi)
			{
				$menu_tag_length = strlen($menu_tag);
				if($this_menu_item_url == $mi['url'])
					$item_name = '+' . substr($mi['name1'], $menu_tag_length);
				else
					$item_name = substr($mi['name1'], $menu_tag_length);

				$item_url = $url_base . '/' . $mi['url'];
				?>
					<div><a href="<?php echo $item_url; ?>" ><?php echo $item_name; ?></a></div><br>
				<?
			}
		}
		else
		{
			echo nl2br($name);	
			if($deck) {
			    ?><div id='deck' class=''><?= $deck; ?></div><?
		    }
		}
		?></div><?
		$images = array();
		if(!empty($media))
		{
			$image_files = array();
			$image_captions = array();

			$image_float = array();
			foreach($media as $key => $m)
			{
				$mediaFile = m_url($m);
				// $mediaFile = "/media/". str_pad($myrow["mediaId"], 5, "0", STR_PAD_LEFT) .".". $myrow["type"];
				$mediaCaption = clean_caption(strip_tags($m["caption"]));
				$mediaStyle = "width: 100%;";
				if($m["type"] == "pdf")
					$mediaFile = "/media/pdf.gif";
				else
					$mediaFile = m_url($m);
				$image_files[] = $mediaFile;
			    $image_captions[] = $mediaCaption;		

				if(in_array($key+1, $img_indexes))
				{
					// $randomWidth = rand(15, 25);
					$width = 90;    // 90% of text column

					if(!$isMobile)
						$images[$key] = "<div id='image".$key."' class = 'inline-img-container' style='width: $width%;' onclick='launch($key);'>";
					else
						$images[$key] = "<div id='image".$key."' class = 'imageContainer'>";
					
					$images[$key] .= displayMedia($mediaFile, $mediaCaption, $mediaStyle);
					$images[$key] .= "<div class='captionContainer monaco small'>" . $image_captions[$key] . "</div>";
					$images[$key] .= "</div>";
					// insert images into body
					// remove leading and trailing whitespace for consistency
					// (necessary whitespace is added in css)
					$pattern = "/\[image".($key+1)."\]/";
					$body = preg_replace($pattern, $images[$key], $body);
					unset($images[$key]);
				}
				else 
				{

					$randomPadding = rand(0, 150);
					$randomWidth = rand(30, 50);
					$randomFloat = (rand(0, 1) == 0) ? 'left' : 'right';
					
					if(!$isMobile)
					{
						$images[$key] = "<div class = 'imageContainerWrapper' style='width:" . $randomWidth . "%; float:" . $randomFloat . ";'>";
						$images[$key] .= "<div id='image".$key."' class = 'imageContainer' style='padding-top:{$randomPadding}px; margin:40px;' onclick='launch($key);'>";
					}
					else
					{
						$images[$key] = "<div class='imageContainerWrapper'>";
						$images[$key] .= "<div id='image".$key."' class = 'imageContainer'>";
					}
					$images[$key] .= displayMedia($mediaFile, $mediaCaption, $mediaStyle);
					// var_dump($mediaFile);
					// var_dump(displayMedia($mediaFile, $mediaCaption, $mediaStyle));
					// die();
					$images[$key] .= "<div class='captionContainer caption helvetica small'>";
					$images[$key] .= $mediaCaption;
					$images[$key] .= "</div>";
					$images[$key] .= "</div>";
					$images[$key] .= "</div>";
				}
			}
			
		}
			
		$pattern = "/\/\/\//";
		if(preg_match($pattern, $body) == 1) 
			$columns = preg_split($pattern, $body);
		// $columns[0] = strictClean($columns[0]);
		// $columns[1] = strictClean($columns[1]);
		$columns = split_column($body);
		$use_columns = (isset($uri[2]) && $uri[2] == 'on-our-mind');

		// search for strings that match [\d+] where \d+ = n
		// replace with image container = n
		// remove image container n from array of images
		// print out rest of images at the end (as normal images?)
	
		// body
		if(count($columns) > 1) 
		{
			if(count($columns) == 2)
				$class = 'half-width';
			else if(count($columns) == 3)
				$class = 'third-width';
			else if(count($columns) == 4)
				$class = 'fourth-width';
			?><div class='listContainer main-listContainer times'><?
				foreach($columns as $key => $c){
					$isLast = $key == count($columns) - 1;
					?><div class='listContainer times <?= $class; ?> <?= $isLast ? 'lastListContainer' : ''; ?>'><?php echo $c; ?></div><?
				}
			?></div><?
		} 
		else 
		{
			?><div class='listContainer main-listContainer centered times <?= ($use_columns) ? "columns" : ""; ?>'><?php echo $body; ?></div><?php
		}
		?><div class='clear'></div>
		<div class='galleryContainer'><?php
		if(is_array($images) && !empty($images))
		{
			foreach($images as $image)
				echo $image;
		}

		?></div><?php
		// echo nl2br($html);
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

				var isMenu = <?php echo json_encode($isMenu); ?>;
				if(isMenu)
				{
					document.body.classList.add('pink');
				}
			</script>
		</div>

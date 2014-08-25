<?php
        require_once("_Library/systemDatabase.php");
        require_once("_Library/displayMedia.php");

	// Parse $id

        $id = $_REQUEST['id'];          // no register globals
        if (!$id) $id = "0";
        $ids = explode(",", $id);
        $idFull = $id;
        $id = $ids[count($ids) - 1];
        $pageName = basename($_SERVER['PHP_SELF'], ".php");
?>

<!DOCTYPE html PUBLIC "-//W3C//Dtd XHTML 1.0 Transitional//EN" "http://www.w3.org/tr/xhtml1/Dtd/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<title>CCA Wattis Institute for Contemporary Arts / email</title>

<style>

body {
        color: #000;
        background: #FFF;
        }

table {
        width: 100%;
        }

a {
        color: #000;
        text-decoration: none;
        border-bottom: solid 3px;
        }

a:active {
        text-decoration: none;
        border-bottom: solid 3px;
        }

a:hover {
        color:#000;
        border-bottom: solid 3px #FFF;
        }

a:active {
        color: #FFF;
        border-bottom: solid 3px #FFF;
        }

.times {
        font-family: "Times New Roman", Times, serif;
        font-size:24px;
        line-height:27px;
        }

.helvetica {
        font-family: Helvetica, Arial, sans-serif;
        font-size:10px;
        line-height:12px;
        }

.punctuation {
        font-family: Monaco, "Lucida Console", monospace;
        color: #000;
        }

</style>
</head>

<body>
<div id="animatePunctuation" class="animatePunctuation">
<?php
                
	// SQL object plus media
	                     
	$sql = "SELECT objects.id AS objectsId, objects.name1, objects.deck, objects.body, 
objects.active, objects.rank as objectsRank, media.id AS mediaId, media.object AS mediaObject, 
media.type, media.caption, media.active AS mediaActive, media.rank FROM objects LEFT JOIN media ON 
objects.id = media.object AND media.active = 1 WHERE objects.id = $id AND objects.active ORDER BY 
media.rank;";

	$result = MYSQL_QUERY($sql);
	$html = "";
	$i=0;

	// collect images

	while ( $myrow  =  MYSQL_FETCH_ARRAY($result) ) {

		if ($myrow['mediaActive'] != null) {
		
			$mediaFile = "MEDIA/". str_pad($myrow["mediaId"], 5, "0", STR_PAD_LEFT) .".". $myrow["type"];
			$mediaStyle = "width: 100%;";
			$images[$i] .= displayMedia($mediaFile, $mediaCaption, $mediaStyle);
		}

		if ( $i == 0 ) {

			$name = $myrow['name1'];
			$body = $myrow['body'];
			$deck = $myrow['deck'];
		}

		$i++;
	}

?>
<table border="0" cellspacing="0" style="font-family: 'Times New Roman', Times, serif; font-size:24px; line-height:27px;">
<tr>
<td style="width:30%;">
</td>
<td>
<br/>
<?php
	// images

	if ( $images ) {

		for ( $j = 0; $j < count($images); $j++) {
		
			$html .= $images[$j];
		}
	}

	echo $html;
?>
</td>
<td style="width:30%;">
</td>
</tr>
<tr>
<td style="width:30%;">
</td>
<td class='times big'>
<?php
echo nl2br($body);
?>
</td>
<td style="width:30%;">
</td>
</tr>
<tr>
<td style="width:30%;">
</td>
<td>
</td>
<td style="width:30%;">
</td>
</tr>
</table>
</div>

<script type="text/javascript" src="JS/animatePunctuation.js"></script>
<script type="text/javascript">

	initPunctuation("animatePunctuation", delay, true, false);

	// build renderedHTML

	var renderedHTML;
	var find;
	var replace;

	renderedHTML = "<html>\n<body>";
	renderedHTML += document.getElementById('animatePunctuation').innerHTML;
	renderedHTML += "</body>\n</html>";

	find = /(class=[\"\']punctuation[\"\'])/g;
	replace = "style=\"font-family: Monaco, 'Lucida Console', monospace;\"";
	renderedHTML=renderedHTML.replace(find, replace);

	find = /(<a href)/g;
        replace = "<a style='color:#000; text-decoration: none; border-bottom: solid 3px;' href";
	renderedHTML=renderedHTML.replace(find, replace);

	find = /(class=[\"\']helvetica[\"\'])/g;
	replace = "style=\"font-family: Helvetica, Arial, sans-serif; font-size: 10px; line-height:12px;\"";
	renderedHTML=renderedHTML.replace(find, replace);

  	find = /<img src=[\"\'](MEDIA\/.*)[\"\']>/g;
	replace = "<img src=\"http://www.wattis.org/$1\">";
	renderedHTML=renderedHTML.replace(find, replace);

</script>

<button type="button" onclick="prompt('Press command-C to copy rendered html:',renderedHTML);">Render html</button>

</body>
</html>




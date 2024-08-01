<?php
        date_default_timezone_set('America/Los_Angeles');
        // open-records-generator
        require_once('open-records-generator/config/config.php');
        require_once('open-records-generator/config/url.php');

        // site
        require_once('static/php/config.php');

        $db = db_connect("guest");
        $oo = new Objects();
        $mm = new Media();
        $ww = new Wires();
        $uu = new URL();

        $item = $oo->get($uu->id);

	// Parse $id
        // require_once("static/php/systemDatabase.php");
        require_once("static/php/displayMedia.php");

        /* outdated
        $id = $_REQUEST['id'];          // no register globals
        if (!$id) $id = "0";
        $ids = explode(",", $id);
        $idFull = $id;
        $id = $ids[count($ids) - 1];
        $pageName = basename($_SERVER['PHP_SELF'], ".php");
        */


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
        $html = '';
        $i = 0;
        $name = $item['name1'];
        $body = $item['body'];
        $deck = $item['deck'];
        $notes = $item['notes'];
        $images = array();
        $media = $oo->media($item['id']);
        if(count($media) > 0)
        {
                $media_style = 'width: 100%; display:inline-block; vertical-align: text-top;';
                foreach($media as $key => $m)
                {
                        $this_url = '/media/' . m_pad($m['id']) . '.' . $m['type'];
                        $this_caption = $m['caption'];
                        $images[$key] = displayMedia($this_url, $this_caption, $media_style);
                        $pattern = "/\[image".($key+1)."\]/";
                        if (preg_match($pattern, $body)) {
                                $body = preg_replace($pattern, $images[$key], $body, 1);
                                unset($images[$key]);
                        }
                        else if(preg_match($pattern, $deck)) {
                                $deck = preg_replace($pattern, $images[$key], $deck, 1);
                                unset($images[$key]);
                        }
                        else if(preg_match($pattern, $notes)) {
                                $notes = preg_replace($pattern, $images[$key], $notes, 1);
                                unset($images[$key]);
                        }
                }
        }
        if(!empty($images))
                $images = array_values($images);
/*
	// SQL object plus media

	$sql = "SELECT objects.id AS objectsId, objects.name1, objects.deck, objects.body, 
objects.notes, objects.active, objects.rank as objectsRank, media.id AS mediaId, media.object AS 
mediaObject, media.type, media.caption, media.active AS mediaActive, media.rank FROM objects LEFT 
JOIN media ON objects.id = media.object AND media.active = 1 WHERE objects.id = $id AND 
objects.active ORDER BY media.rank;";

	$result = MYSQL_QUERY($sql);
	$html = "";
	$i=0;

	// collect images

    while ( $myrow  =  MYSQL_FETCH_ARRAY($result) ) {

            $name = $myrow['name1'];
	    if (!$found)
                $body = $myrow['body'];
            $deck = $myrow['deck'];
            $notes = $myrow['notes'];

        if ($myrow['mediaActive'] != null) {

            $mediaFile = "MEDIA/". str_pad($myrow["mediaId"], 5, "0", STR_PAD_LEFT) .".". $myrow["type"];
            $mediaStyle = "width: 75%; padding: 5%; display:inline-block; vertical-align: text-top;";

            $images[$i] .= displayMedia($mediaFile, $mediaCaption, $mediaStyle);

            // insert images into body
            // remove leading and trailing whitespace for consistency
            $pattern = "/\[image".($i+1)."\]/";

	    if (preg_match($pattern, $body)) {

               $body = preg_replace($pattern, $images[$i], $body, 1);
	       $found = TRUE;
               unset($images[$i]);
            }

        }
        $i++;
    }
*/
?>
<center>
<table border="0" cellspacing="0" style="max-width: 600px; padding: 20px;">

<tr>
<td style="font-family: 'Times New Roman', Times, serif; font-size:24px; line-height:27px; color:#000;">
<br />
<?php
echo nl2br($deck);
?>
</td>
</tr>

<tr>
<td>
<?php
	// images

	if ( !empty($images) ) {

		$html .= "<br />";

		for ( $j = 0; $j < count($images); $j++) {

			$html .= $images[$j];
		}
	}

	echo $html;
?>
</td>
</tr>

<tr>
<td style="font-family: 'Times New Roman', Times, serif; font-size:24px; line-height:27px; color:#000;">
<br />
<?php
echo nl2br($body);
?>
<br />
<br />
</td>
</tr>

<tr>
<td style="font-family: Helvetica, Arial, sans-serif; font-size: 10px; line-height:12px; color:#000;">
<br />
<?php
echo nl2br($notes);
?>
</td>
</tr>

</table>
</center>
</div>

<script type="text/javascript" src="/static/js/animatePunctuation.js"></script>
<script type="text/javascript">

	delay = 200;	// default value

	initPunctuation("animatePunctuation", delay, true, false);

	// build renderedHTML

	var renderedHTML;
	var find;
	var replace;
        // console.log(document.getElementById('animatePunctuation').innerHTML);
	renderedHTML = "<html>\n<body>";
	renderedHTML += document.getElementById('animatePunctuation').innerHTML;
	renderedHTML += "</body>\n</html>";
        console.log(renderedHTML);
	find = /(class=[\"\']punctuation[\"\'])/gi;
	replace = "style=\"font-family: Monaco, 'Lucida Console', monospace;\"";
	renderedHTML=renderedHTML.replace(find, replace);

	find = /(<a href)/g;
        replace = "<a style='color:#000; text-decoration: none; border-bottom: solid 3px;' href";
	renderedHTML=renderedHTML.replace(find, replace);

  	// find = /<img (?:.*? )src\s?=\s?[\"\'](media\/.*)[\"\']/gi;
        find = /<img (?:.*? )?src\s?=\s?[\"\'](\/media\/.*?)[\"\'](.*?)>/gi;
	replace = "<img src=\"https:\/\/wattis.org$1\"$2>";
        // replace = 'cccc';
	renderedHTML=renderedHTML.replace(find, replace);
        console.log(renderedHTML);
</script>

<button type="button" onclick="console.log(renderedHTML); prompt('Press command-C to copy rendered html:',renderedHTML);">Render html</button>

</body>
</html>

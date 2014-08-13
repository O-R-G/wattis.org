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
</head>

<body>

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

table {
	width: 100%;
	}

.times {
        font-family: "Times New Roman", Times, serif;
        }

.monaco {
        font-family: Monaco, "Lucida Console", monospace;
	line-height:20px;
        }

.punctuation {
        font-family: Monaco, "Lucida Console", monospace;
        color: #F00;
        }

.big {
	font-size:24px;
        }

.spacer {
	width:30%;
        }

	</style>

	<?php
                
	// SQL object plus media
	                     
	$sql = "SELECT objects.id AS objectsId, objects.name1, objects.deck, objects.body, objects.active, objects.rank as objectsRank, 
media.id AS mediaId, media.object AS mediaObject, media.type, media.caption, media.active AS mediaActive, media.rank FROM objects LEFT JOIN 
media ON objects.id = media.object AND media.active = 1 WHERE objects.id = $id AND objects.active ORDER BY media.rank;";

	$result = MYSQL_QUERY($sql);
	$html = "";
	$i=0;

	// collect images

	while ( $myrow  =  MYSQL_FETCH_ARRAY($result) ) {

		if ($myrow['mediaActive'] != null) {
		
			$mediaFile = "MEDIA/". str_pad($myrow["mediaId"], 5, "0", STR_PAD_LEFT) .".". $myrow["type"];
			$mediaCaption = strip_tags($myrow["caption"]);
			$mediaStyle = "width: 100%;";
			$images[$i] .= "<div id='image".$i."' class = 'imageContainer' onclick='expandImage(\"image".$i."\", \"100px\", \"0px\");' style='padding:100px;'>";
			$images[$i] .= "\n    ". displayMedia($mediaFile, $mediaCaption, $mediaStyle);
			$images[$i] .= "<div class = 'captionContainer monaco small'>";
			$images[$i] .= $mediaCaption;
			$images[$i] .= "</div>";
			$images[$i] .= "</div>";
		}

		if ( $i == 0 ) {

			$name = $myrow['name1'];
			$body = $myrow['body'];
			$deck = $myrow['deck'];
		}

		$i++;
	}

	/*
	// images

	if ( !$images ) {

		for ( $j = 0; $j < count($images); $j++) {
		
			$html .= $images[$j];
		}
	}

	// echo nl2br($html);
	*/

	?>
        

<table border="0" cellspacing="0">
<tr>
<td class='spacer'>
</td>
<td>
<?php
echo $deck . "<br />";
?>
</td>
<td class='spacer'>
</td>
</tr>

<tr>
<td class='spacer'>
</td>
<td class='times big'>
<?php
echo nl2br($body);
?>
</td>
<td class='spacer'>
</td>
</tr>

<tr>
<td class='spacer'>
</td>
<td>
</td>
<td class='spacer'>
</td>
</tr>

</table>

</body>
</html>

<?php
require_once("_Library/systemDatabase.php"); 

$sql = "SELECT objects.id, objects.body FROM objects WHERE objects.id = 258;";

$result = MYSQL_QUERY($sql);
$myrow = MYSQL_FETCH_ARRAY($result);
$ip = $myrow['body'];
?>

<html>

<script type="text/javascript">
var delayBetweenUpdate = 1000 * Number(location.search.split('delay=')[1] ? location.search.split('delay=')[1] : '1');

function updateImage()
{
	var img = document.getElementById("img");
	img.src = "<? echo $ip; ?>" + "?" + Date.now();
	// img.src = "http://204.28.123.14/graphics/livevideo/stream/stream3.jpg" + "?" + Date.now();
	setTimeout(updateImage, delayBetweenUpdate);
}
</script>

<head>
<title>CCA Wattis Institute for Contemporary Arts</title>
</head>
<body onload="updateImage()" style="background-color:#0A0A0A">
	<img id="img" height="480" width="640" src="" style="display:block; margin:auto;">

</body>
</html>

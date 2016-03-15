<?php 
date_default_timezone_set('America/Los_Angeles');
require_once("_Library/systemDatabase.php"); 
require_once("_Library/displayMedia.php"); 
require_once("_Library/systemCookie.php");		
	
// $id
$id = $_REQUEST['id'];		// no register globals	
if (!$id) $id = "0";
$ids = explode(",", $id);
$idFull = $id;
$id = $ids[count($ids) - 1];
$pageName = basename($_SERVER['PHP_SELF'], ".php");

// $alt
$alt = $_REQUEST['alt'];

// pop
$pop = $_REQUEST['pop'];          // no register globals

// detect mobile
$isMobile = (bool)preg_match('#\b(ip(hone|od|ad)|android|opera m(ob|in)i|windows (phone|ce)|blackberry|tablet'.
				'|s(ymbian|eries60|amsung)|p(laybook|alm|rofile/midp|laystation portable)|nokia|fennec|htc[\-_]'.
				'|mobile|up\.browser|[1-4][0-9]{2}x[1-4][0-9]{2})\b#i', $_SERVER['HTTP_USER_AGENT']);

$documentTitle = "CCA Wattis Institute for Contemporary Arts";
echo "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n"; 
?>
<!DOCTYPE html PUBLIC "-//W3C//Dtd XHTML 1.0 Transitional//EN" "http://www.w3.org/tr/xhtml1/Dtd/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<title><?php echo $documentTitle; ?></title>
		<meta http-equiv="Content-Type" content="text/xhtml; charset=utf-8" />
		<meta http-equiv="Title" content="<?php echo $documentTitle; ?>" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" type="text/css" media="all" href="GLOBAL/global.css" />
		<link rel="icon" href="MEDIA/icon.gif?refresh=true" type="image/gif">
		<script type="text/javascript" src="GLOBAL/global.js"></script>
		<script type="text/javascript" src="JS/animatePunctuation.js"></script>
	</head>
	<body>
	<!-- Google Tag Manager -->
	<noscript><iframe src="//www.googletagmanager.com/ns.html?id=GTM-NQNBBC" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript><script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src='//www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);})(window,document,'script','dataLayer','GTM-NQNBBC');</script>
	<!-- End Google Tag Manager -->
	<!-- CONTROL -->
	<!-- COLOR / ANIMATEPUNCTUATION -->
	<div id="animatePunctuation" class="animatePunctuation">
		<div id="color" class="black">
		<!-- .+* THE WATTIS INSTITUTE --><?php 
		if (($pageName != "_logo") && ($pageName != "_animatePunctuation")) 
		{
		?><div class="logoContainer times big logo fixed">
			<span id="logo" onmousedown="startStopAnimatePunctuation();" class="target">.+*</span>
			<!-- <span id="logo" class="target">.+*</span> -->
			<!-- <span id="control" onmousedown="startStopAnimatePunctuation();" class="helvetica small">CONTROL</span> -->
			<a href="<?php echo ($pageName == 'index') ? 'main' : 'index?alt=1'; ?>" style="color:#000;">The Wattis Institute</a>
		</div>
		<div class="clear"></div>
		<script type="text/javascript">
			var logo = unescape(getCookie("logoCookie"));
			if (logo) { document.getElementById("logo").textContent = logo; }
		</script><?php
		}
	?>
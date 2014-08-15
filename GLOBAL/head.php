<?php 
	date_default_timezone_set('America/Los_Angeles');
	require_once("_Library/systemDatabase.php"); 
	require_once("_Library/displayMedia.php"); 
	
	// $id

	$id = $_REQUEST['id'];		// no register globals	
	if (!$id) $id = "0";
	$ids = explode(",", $id);
	$idFull = $id;
	$id = $ids[count($ids) - 1];
	$pageName = basename($_SERVER['PHP_SELF'], ".php");

	// $alt
	
	$alt = $_REQUEST['alt'];

	$documentTitle = ( $pageName == "index" ) ? "CCA Wattis Institute for Contemporary Arts" : "CCA Wattis Institute for Contemporary Arts / " . $pageName;
	echo "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n"; 
?>


<!DOCTYPE html PUBLIC "-//W3C//Dtd XHTML 1.0 Transitional//EN" "http://www.w3.org/tr/xhtml1/Dtd/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">

<head>

<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<title><?php echo $documentTitle; ?></title>
	<meta http-equiv="Content-Type" content="text/xhtml; charset=utf-8" />
	<meta http-equiv="Title" content="<?php echo $documentTitle; ?>" />
	<link rel="stylesheet" type="text/css" media="all" href="GLOBAL/global.css" />
	<script type="text/javascript" src="GLOBAL/global.js"></script>
        <script type="text/javascript" src="JS/animateEmoticon.js"></script>
	<script type="text/javascript" src="JS/animatePunctuation.js"></script>
        <script type="text/javascript" src="JS/animateEmoticon-src.js"></script>
</head>

<body>

<!-- Google Tag Manager -->
<noscript><iframe src="//www.googletagmanager.com/ns.html?id=GTM-N8MCCT" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript><script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src='//www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);})(window,document,'script','dataLayer','GTM-N8MCCT');</script>
<!-- End Google Tag Manager -->

<?php 
if 
	(($pageName != "_logo") && 
	 ($pageName != "_animatePunctuation")) 
{
?>

	<!-- .+* THE WATTIS INSTITUTE -->
	
	<div class="logoContainer times big black fixed animatePunctuation">
	<span class="">.+*</span> 
	<a href="<?php echo ($pageName == 'index') ? 'main' : 'index.php'; ?>" class="logo">The Wattis Institute</a>
	</div>
	
	<div class="clear"></div>

<?php
}  
?>

<div id="color" class="<?php echo (($pageName === 'index') && (!$alt)) ? 'white' : 'black' ?>">
<div id="animatePunctuation" class="animatePunctuation">

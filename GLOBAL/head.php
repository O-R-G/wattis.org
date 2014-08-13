<?php 
	date_default_timezone_set('America/Los_Angeles');
	require_once("_Library/systemDatabase.php"); 
	require_once("_Library/systemCookie.php");
	require_once("_Library/displayNavigation.php"); 
	require_once("_Library/displayMedia.php"); 
	
	// Parse $id

	$id = $_REQUEST['id'];		// no register globals	
	if (!$id) $id = "0";
	$ids = explode(",", $id);
	$idFull = $id;
	$id = $ids[count($ids) - 1];
	$pageName = basename($_SERVER['PHP_SELF'], ".php");

	/*
	// Live?
	
	// $live is stored in database and turns on site
	// $dev is passed in query and stored in cookie

	$dev = $_REQUEST['dev'];
	$dev = systemCookie("devCookie", $dev, 0);
	// if (!$dev) die('Under construction . . .');
	*/

	// other 
	
	$alt = $_REQUEST['alt'];

	/*
	$staging = $_REQUEST['staging'];
	$sql    = "SELECT deck FROM objects WHERE objects.name1 LIKE 'Live';";
	$result =  MYSQL_QUERY($sql);
	$myrow  =  MYSQL_FETCH_ARRAY($result);
	$deck = $myrow["deck"];
	if ( $deck == 'TRUE' ) $live = TRUE;
	*/	

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

	<!-- ** fix viewport and possibly responsiveness ** -->

	<!-- <meta name="viewport" content="width=device-width"> -->
	<!-- <meta name="viewport" content="width=700"> -->
	<!-- <meta name="viewport" content="initial-scale=1.0">-->

	<!-- ** this is for .htaccess rewrites with trailing slash ** -->
	<!-- ** for now, while local i leave this turned off ** -->
	<!-- b/c live server base will be "/" -->
	<!-- <base href="/WATTIS/" /> -->

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
if (($pageName != "index") 
&& ($pageName != "index_") 
&& ($pageName != "punctuation")  
&& ($pageName != "logo")  
&& ($pageName != "_logo")  
&& ($pageName != "logo-dev")  
&& ($pageName != "sign") 
&& ($pageName != "email")
&& ($pageName != "email-headers")
&& ($pageName != "_animatePunctuation")
&& ($pageName != "ad") 
&& ($pageName != "ad-frieze")
&& ($pageName != "ad-artforum")
&& ($pageName != "ad-afterall")
&& ($pageName != "ad-artpractical")
&& ($pageName != "ad-kqed")
&& ($pageName != "ad-may"))
{
?>

<!-- .+* THE WATTIS INSTITUTE -->

<div class="wattisContainer times big black fixed">
<canvas id="canvas0" width="46" height="22" class="show" 
onclick="showBones();">.+*</canvas></a>
<a href="index_.php">The Wattis Institute</a>
</div>

<div class="clear"></div>

<?php
} 
?>

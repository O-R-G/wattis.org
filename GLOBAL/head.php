<?php 
	/*
	// date_default_timezone_set('Asia/Kuwait');
	require_once("_Library/systemDatabase.php"); 
	require_once("_Library/systemCookie.php");
	require_once("_Library/displayNavigation.php"); 
	require_once("_Library/displayMedia.php"); 
	*/

	/*
	// Parse $id

	$id = $_REQUEST['id'];		// no register globals	
	if (!$id) $id = "0";
	$ids = explode(",", $id);
	$idFull = $id;
	$id = $ids[count($ids) - 1];
	$pageName = basename($_SERVER['PHP_SELF'], ".php");
	/*	

	/*
	// Live?
	
	// $live is stored in database and turns on site
	// $dev is passed in query and stored in cookie

	$dev = $_REQUEST['dev'];
	$dev = systemCookie("devCookie", $dev, 0);
	// if (!$dev) die('Under construction . . .');
	*/

	/*
	// Alt for dev options
	
	$alt = $_REQUEST['alt'];

	$staging = $_REQUEST['staging'];
	$sql    = "SELECT deck FROM objects WHERE objects.name1 LIKE 'Live';";
	$result =  MYSQL_QUERY($sql);
	$myrow  =  MYSQL_FETCH_ARRAY($result);
	$deck = $myrow["deck"];
	if ( $deck == 'TRUE' ) $live = TRUE;
	*/
	
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
	<link rel="stylesheet" type="text/css" media="all" href="GLOBAL/global.css" />
	<script type="text/javascript" src="GLOBAL/global.js"></script>
	<script type="text/javascript" src="JS/animateEmoticon-v2.js"></script>
</head>

<body onload="initEmoticons(1);">


<!-- THIS IS THE WATTIS -->

<div class="mainContainer times big black">

<!-- WATTIS -->

<div class="wattisContainer"><canvas id="canvas0" width="60" height="22" 
class="show" onclick="showBones();">\\\\*</canvas> ... This is <a 
href="index-.php">The Wattis</a>.</div>

</div>

<div class="clear"></div>

<div class="mainContainer times big black">

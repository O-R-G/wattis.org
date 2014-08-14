<?php




  //////////////////
 //  RSS Parser  //
//////////////////

function orgRSSParse($url) {

	require_once("_Library/orgTextParse.php");
	$headline = null;
	$raw = orgTextParse($url);

	$items = explode("<item>", $raw);
	$title = array();
	$link  = array();
	for ($i = 1; $i < sizeof($items); $i++) {


		//  Titles

		$titleStart = strpos($items[$i], "<title>") + strlen("<title>");
		$titleEnd   = strpos(substr($items[$i], $titleStart), "</title>");
		$title[$i]  = trim(strip_tags(substr($items[$i], $titleStart, $titleEnd))); // use "eregi" instead?


		//  Links

		$linkStart = strpos($items[$i], "<link>") + strlen("<link>");
		$linkEnd   = strpos(substr($items[$i], $linkStart), "</link>");
		$link[$i]  = trim(strip_tags(substr($items[$i], $linkStart, $linkEnd))); // use "eregi" instead?

		//echo "\n\n<a href='". $link[$i] ."' target='_blank'>". $title[$i] ."</a><br />";
	}

	// $headline = $title[rand(1, sizeof($title))];
	$headline = $title[1];

	return $headline;
}








?>

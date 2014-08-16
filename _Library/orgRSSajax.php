<?php



  ////////////////////////////////
 //  RSS Parser with ajax call //
////////////////////////////////


// based on http://www.w3schools.com/php/php_ajax_rss_reader.asp
// requires js showRSS() function
// requires <html> element id='rss'
// requires query ?xml=http://...


function orgRSSajax($xml) {

	$xmlDoc = new DOMDocument();
	// $xmlDoc->load($xml);
    	$live = @$xmlDoc->load($xml);

	if (!$live){ 

		echo "Sorry, too foggy now."; 
		die();
	} 

	// get elements from <channel>

	$channel=$xmlDoc->getElementsByTagName('channel')->item(0);
	$channel_title = $channel->getElementsByTagName('title')->item(0)->childNodes->item(0)->nodeValue;
	$channel_link = $channel->getElementsByTagName('link')->item(0)->childNodes->item(0)->nodeValue;
	$channel_desc = $channel->getElementsByTagName('description')->item(0)->childNodes->item(0)->nodeValue;

	/*
	// output <channel>

	echo("<p><a href='" . $channel_link  . "'>" . $channel_title . "</a>");
	echo("<br>");
	echo($channel_desc . "</p>");
	*/

	// output <item>

	$x=$xmlDoc->getElementsByTagName('item');
	$items = 1;

	for ($i=0; $i<$items; $i++) {

  		$item_title=$x->item($i)->getElementsByTagName('title')->item(0)->childNodes->item(0)->nodeValue;
  		$item_link=$x->item($i)->getElementsByTagName('link')->item(0)->childNodes->item(0)->nodeValue;
		$item_desc=$x->item($i)->getElementsByTagName('description')->item(0)->childNodes->item(0)->nodeValue;

		// parse NOAA weather ** WATTIS-specific **

		$weatherString = $item_title;

		$weatherString = str_replace(" at San Francisco Intl Airport, CA", "", $weatherString);
		$weatherString = preg_replace("/\d+/", "$0&deg;", $weatherString);
		$weatherString = str_replace("and", "and ", $weatherString);
		$weatherString = "Today, " . strtolower($weatherString) . ".";

		echo $weatherString;

		// echo ("<a href='" . $item_link  . "'>" . $item_title . "</a>");
		// echo ($item_title);
		// echo ($item_link);
	 	// echo ($item_desc);
	}

	return true;
}


$xml=$_GET["xml"];	

orgRSSajax($xml);	
?>

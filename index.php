<?php

$request = $_SERVER['REQUEST_URI'];
$requestclean = strtok($request,"?");
$uri = explode('/', $requestclean);
if(empty(end($uri)) && count($uri) > 2){
	array_pop($uri);
}
$random = isset($_GET['random']);
$pages_with_date_argument = array('calendar', 'our-program');
$date_argument = in_array($uri[1], $pages_with_date_argument) && isset($_GET['date']) ? $_GET['date'] : false;

if(!isset($uri[1]) || $uri[1] != 'emails')
{
	require_once("views/head.php");
	require_once("views/nav.php");
}


if ( (count($uri) == 1 || !$uri[1]) && !$random)
    require_once("views/home.php");
elseif( (count($uri) == 1 || !$uri[1]) && $random )
	require_once("views/random.php");
elseif( $uri[1] == 'main' ||
		 $uri[1] == 'menu'
		)
	require_once("views/menu.php");
elseif( ($uri[1] == 'browse-the-library' && count($uri) < 4)|| 
		 $uri[1] == 'library_.php' 
	  )
	require_once("views/library.php");
elseif( ($uri[1] == 'browse-the-library' && count($uri) >= 4) ||
		 $uri[1] == 'library_view.php' )
	require_once("views/library_view.php");
elseif( $uri[1] == 'list' ||
		($uri[1] == 'our-program' && count($uri) < 3)||
		($uri[1] == 'our-program' && count($uri) == 3 && ($date_argument || end($uri) == 'upcoming'))||
		($uri[1] == 'calendar' && count($uri) < 3)||
		($uri[1] == 'calendar' && count($uri) == 3 && ($date_argument || end($uri) == 'upcoming'))||
		($uri[1] == 'consult-the-archive' && count($uri) == 3)
	  )
	require_once("views/list.php");
elseif( ( $uri[1] == 'shop' && count($uri) < 4 ) ||
		( $uri[1] == 'buy-limited-editions' && count($uri) < 4 ) ||
		$uri[1] == 'display'
	   )
	require_once("views/display.php");
else if ( 
		$uri[1] == 'buy'  ||
		$uri[1] == 'shop' ||
		$uri[1] == 'buy-limited-editions' || 
		$uri[1] == 'buy_.php')
    require_once("views/buy.php");
elseif($uri[1] == 'search')
	require_once('views/search.php');
elseif($uri[1] == 'emails')
	require_once('views/email.php');
else 
    require_once("views/view.php");

require_once("views/foot.php");

function valid_date($date) {
	return (bool)strtotime($date) ? $date : false;
}

?>


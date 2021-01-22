<?
$request = $_SERVER['REQUEST_URI'];
$requestclean = strtok($request,"?");
$uri = explode('/', $requestclean);

require_once("views/head.php");
// var_dump($uri);
if (!$uri[1])
    require_once("views/home.php");
// elseif( $uri[1] == 'about' ||
// 		 $uri[1] == 'visit' ||
// 		 $uri[1] == 'contact' ||
// 		 $uri[1] == 'follow' ||
// 		 $uri[1] == 'support' ||
// 		 $uri[1] == 'archive' ||
// 		 $uri[1] == 'capp' ||
// 		 $uri[1] == 'intern' ||
// 		 $uri[1] == 'exhibitions' ||
// 		 $uri[1] == 'program' ||
// 		 $uri[1] == 'view' ||
// 		 ($uri[1] == 'calendar' && count($uri) >= 3)
// 		)
// 	require_once("views/view.php");
elseif( $uri[1] == 'main' ||
		 $uri[1] == 'menu'
		)
	require_once("views/menu.php");
elseif( $uri[1] == 'library' || 
		$uri[1] == 'library_.php' 
	   )
	require_once("views/library.php");
elseif( $uri[1] == 'library_view.php' )
	require_once("views/library_view.php");
elseif( $uri[1] == 'list' ||
		($uri[1] == 'calendar' && count($uri) < 3)
	   )
	require_once("views/list.php");
elseif( $uri[1] == 'catalogues' ||
		$uri[1] == 'editions' ||
		$uri[1] == 'display'
	   )
	require_once("views/display.php");
else if ($uri[1] == 'buy' || $uri[1] == 'buy_.php')
    require_once("views/buy.php");
elseif($uri[1] == 'search')
	require_once('views/search.php');
else 
    require_once("views/view.php");

// require_once("views/badge.php");
require_once("views/foot.php");
?>


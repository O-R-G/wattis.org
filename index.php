<?

$request = $_SERVER['REQUEST_URI'];
$requestclean = strtok($request,"?");
$uri = explode('/', $requestclean);
$random = isset($_GET['random']);
$date_argument = false;
foreach ($uri as $u)
    $date_argument = valid_date(urldecode($u));

require_once("views/head.php");
require_once("views/nav.php");

if (!$uri[1] && !$random)
    require_once("views/home.php");
elseif( !$uri[1] && $random )
	require_once("views/random.php");
elseif( $uri[1] == 'main' ||
		 $uri[1] == 'menu'
		)
	require_once("views/menu.php");
elseif( ($uri[1] == 'browse-the-library' && count($uri) < 4)|| 
		// ($uri[1] == 'library' && count($uri) < 4)|| 
		 $uri[1] == 'library_.php' 
	  )
	require_once("views/library.php");
elseif( ($uri[1] == 'browse-the-library' && count($uri) >= 4) ||
		// ($uri[1] == 'library' && count($uri) >= 4) ||
		 $uri[1] == 'library_view.php' )
	require_once("views/library_view.php");
elseif( $uri[1] == 'list' ||
		($uri[1] == 'our-program' && count($uri) < 3)||
		($uri[1] == 'our-program' && count($uri) == 3 && ($date_argument || end($uri) == 'upcoming'))||
		($uri[1] == 'calendar' && count($uri) < 3)||
		($uri[1] == 'calendar' && count($uri) == 3 && ($date_argument || end($uri) == 'upcoming'))||
		// ($uri[1] == 'archive' && count($uri) == 3)
		($uri[1] == 'consult-the-archive' && count($uri) == 3)
	  )
	require_once("views/list.php");
elseif( $uri[1] == 'buy-catalogues' ||
		// $uri[1] == 'catalogues' ||
		// $uri[1] == 'editions' ||
		$uri[1] == 'buy-limited-editions' ||
		$uri[1] == 'display'
	   )
	require_once("views/display.php");
else if ( 
		$uri[1] == 'buy'  ||
		$uri[1] == 'buy_.php')
    require_once("views/buy.php");
elseif($uri[1] == 'search')
	require_once('views/search.php');
else 
    require_once("views/view.php");

require_once("views/foot.php");

function valid_date($date) {
    if ((bool)strtotime($date))
        return $date;
}

?>


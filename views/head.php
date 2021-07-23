<?
date_default_timezone_set('America/Los_Angeles');
// open-records-generator
require_once('open-records-generator/config/config.php');
require_once('open-records-generator/config/url.php');

// site
require_once('static/php/config.php');

$db = db_connect("guest");
$oo = new Objects();
$mm = new Media();
$ww = new Wires();
$uu = new URL();

$main_id = end($oo->urls_to_ids(array('main')));
$main_children = $oo->children($main_id);
$main_children_url = array();
foreach($main_children as $child)
	$main_children_url[] = $child['url'];

$home_id = end($oo->urls_to_ids(array('home')));
$home_children = $oo->children($home_id);
$home_children_url = array();
foreach($home_children as $child)
	$home_children_url[] = $child['url'];

foreach($home_children as $child)
	$home_children_url[] = $child['url'];

if($uu->id){
	$uri_temp = $uri;
	if($date_argument || end($uri) == 'upcoming')
		array_pop($uri_temp);
	array_shift($uri_temp);
	$ids = $oo->urls_to_ids($uri_temp);
	$id = $uu->id;
	$item = $oo->get($id);
}
elseif( in_array( $uri[1], $main_children_url ))
{
	$uri_temp = $uri;
	if($date_argument || end($uri) == 'upcoming')
		array_pop($uri_temp);
	$uri_temp[0] = 'main';
	$ids = $oo->urls_to_ids($uri_temp);
	$uu->id = end($ids);
	$item = $oo->get($uu->id);
	$id = $uu->id;
}
elseif( in_array( $uri[1], $home_children_url ))
{
	$uri_temp = $uri;
	$uri_temp[0] = 'home';
	$ids = $oo->urls_to_ids($uri_temp);
	$uu->id = end($ids);
	$id = $uu->id;
	$item = $oo->get($id);
	
}
elseif($uri[1] == 'buy')
{
	$uri_temp = $uri;
	array_shift($uri_temp);
	array_shift($uri_temp);
	if(in_array( $uri_temp[0], $main_children_url ))
	{
		array_unshift($uri_temp, 'main');
	}
	$ids = $oo->urls_to_ids($uri_temp);
	$uu->id = end($ids);
	$item = $oo->get($uu->id);
}
elseif(!isset($ids))
{
	$id = $_REQUEST['id'];		// no register globals	
	if (!$id) $id = "0";
	$ids = explode(",", $id);
	$idFull = $id;
	$id = $ids[count($ids) - 1];
	$item = $oo->get($id);
	// $pageName = basename($_SERVER['PHP_SELF'], ".php");
}
else
	$item = $oo->get(0);
$name = ltrim(strip_tags($item["name1"]), ".");
$nav = $oo->nav($uu->ids);
$show_menu = false;

// id

 
$alt = $_REQUEST['alt'];
$pop = $_REQUEST['pop'];

$displaySearch = $_GET['displaysearch'];
if(empty($displaySearch))
	$displaySearch = false;
// detect mobile
$isMobile = (bool)preg_match('#\b(ip(hone|od|ad)|android|opera m(ob|in)i|windows (phone|ce)|blackberry|tablet'.
				'|s(ymbian|eries60|amsung)|p(laybook|alm|rofile/midp|laystation portable)|nokia|fennec|htc[\-_]'.
				'|mobile|up\.browser|[1-4][0-9]{2}x[1-4][0-9]{2})\b#i', $_SERVER['HTTP_USER_AGENT']);

$bodyClass = '';
if(!$uri[1])
	$bodyClass .= ' home loading';
if($uri[1] == 'search')
	$bodyClass .= ' reverse';
if($uri[1] == 'browse-the-library')
	$bodyClass .= ' hideGeneralSearch';
if(!empty($displaySearch))
	$bodyClass .= ' viewing-search';
if($uri[2] == 'the-word-for-world-is-forest-2020' && count($uri) > 3)
	$bodyClass .= ' the-word-for-world-is-forest-2020';
require_once('static/php/function.php');

?><!DOCTYPE html>
<html>
	<head>
		<title><? echo $site; ?></title>
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1,user-scalable=0"/>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<link rel="stylesheet" href="/static/css/main.css">
		<link rel="apple-touch-icon" href="/media/png/touchicon.png" />
		<script type="text/javascript" src="/static/js/global.js"></script>
		<script type="text/javascript" src="/static/js/animatePunctuation.js"></script>
        <script type="text/javascript" src="https://code.createjs.com/1.0.0/createjs.min.js"></script>
		<script type="text/javascript" src="/static/js/audio-src.js"></script>
		<script type="text/javascript" src="/static/js/audio.js"></script>
		<script type="text/javascript" src="/static/js/ui.js"></script>
	</head>
	<body class = '<?= $bodyClass; ?>'>
		<!-- Google Tag Manager -->
		<noscript><iframe src="//www.googletagmanager.com/ns.html?id=GTM-NQNBBC" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript><script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src='//www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);})(window,document,'script','dataLayer','GTM-NQNBBC');</script>
		<!-- End Google Tag Manager -->
		<script>
			window.addEventListener('load', function() {
                document.body.classList.remove('loading');
            });
		</script>
		<div id="animatePunctuation" class="animatePunctuation">
    		<div id="color" class="<?= $random ? '' : 'white'; ?> ">

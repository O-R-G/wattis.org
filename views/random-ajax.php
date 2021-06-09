<?
$config = $_SERVER["DOCUMENT_ROOT"];
$config = $config."/open-records-generator/config/config.php";
require_once($config);
$db = db_connect("guest");
$oo = new Objects();

// $page = $_GET['page'];
// $posts_per_page = 3;
// if($page)
// 	$offset = $posts_per_page*$page;
// else
// 	$offset = 0;

require_once($_SERVER["DOCUMENT_ROOT"].'/static/php/function.php');

$current_fetched_ids_arr = file_get_contents( "php://input" );
$current_fetched_ids_arr = json_decode($current_fetched_ids_arr);
// $current_fetched_ids_arr_temp = file_get_contents( "php://input" );
// $current_fetched_ids_arr_temp = json_decode($fetched_ids_arr_temp);
$a_pattern = '/<a\s.*?(?:href.*?=.*?[\'"].*?[\'"].*?)?>(.*?)<\/a>/is';
$randomRecords = getRandomRecords(50, $current_fetched_ids_arr);
$response_html = '';
if(count($randomRecords['all']) != 0) 
{
	foreach($randomRecords['all'] as $record)
	{
		$this_url = getCompleteUrl($record['id']);
		$current_fetched_ids_arr[] = $record['id'];
		if($record['image'])
		{
			$response_html .= '<div class="blockContainer displaying_image"><a href="'. $this_url.'" ><img src="'.$record['image'].'"></a></div>';
		}
		else
		{
			// $this_text = $record["sentence"];
			$this_text = preg_replace($a_pattern, '<span class="pseudo-link">$1</span>', $record["sentence"]);

			$response_html .= '<div class="blockContainer"><a class="block_link" href="'.$this_url.'" ><div id = "paragraph">'. $this_text.'</div></a></div>';
		}
	}
	$response = array(
		'current_fetched_ids_arr' => $current_fetched_ids_arr,
		'this_html' => $response_html
	);
}
else
	$response = array();

// header('Content-Type: application/json');
echo json_encode($response);

// $response_test = array(
// 	'current_fetched_ids_arr_temp' => $current_fetched_ids_arr_temp
// );
// echo json_encode($response_test);
?>

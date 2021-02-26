<? 
echo "add-url.php ...\n";
$cwd = getcwd();

set_include_path($cwd);
require_once($cwd . '/../../open-records-generator/lib/lib.php');

// connect to database (called in head.php)
function db_connect($remote_user) {
	global $adminURLString;
	global $readOnlyURLString;

	$users = array();
	$creds = array();

	if ($adminURLString) {
		// IF YOU ARE USING ENVIRONMENTAL VARIABLES (you should)
		$urlAdmin = parse_url($adminURLString);
		$host = $urlAdmin["host"];
		$dbse = substr($urlAdmin["path"], 1);

        // full access
        $creds['full']['db_user'] = $urlAdmin["user"];
        $creds['full']['db_pass'] = $urlAdmin["pass"];

        // read / write access
        // (can't create / drop tables)
		$creds['rw']['db_user'] = $urlAdmin["user"];
		$creds['rw']['db_pass'] = $urlAdmin["pass"];

        // read-only access
		$urlReadOnly = parse_url($readOnlyURLString);
		$creds['r']['db_user'] = $urlReadOnly["user"];
		$creds['r']['db_pass'] = $urlReadOnly["pass"];

	} else {
		// IF YOU ARE NOT USING ENVIRONMENTAL VARIABLES
		$host = "localhost";
		$dbse = "wattis_local";

		// full access
		$creds['full']['db_user'] = "root";
		$creds['full']['db_pass'] = "f3f4p4ax";

		// read / write access
		// (can't create / drop tables)
		$creds['rw']['db_user'] = "root";
		$creds['rw']['db_pass'] = "f3f4p4ax";

		// read-only access
		$creds['r']['db_user'] = "root";
		$creds['r']['db_pass'] = "f3f4p4ax";
	}

	// users
	$users["admin"] = $creds['full'];
	$users["main"] = $creds['rw'];
	$users["guest"] = $creds['r'];

	$user = $users[$remote_user]['db_user'];
	$pass = $users[$remote_user]['db_pass'];

	$db = new mysqli($host, $user, $pass, $dbse);
	if($db->connect_errno)
		echo "Failed to connect to MySQL: " . $db->connect_error;
	return $db;
}
// id
// Home = 1
// Main = 3
// Gallery = 4
// On Our Mind = 6
// Calendar = 7
// Browse the Library = 752
// Browse the Library > Watch / Listen = 776
// Main > Consult the Archive = 30
// _Email = 94
// Cecilia VicuÃ±a is on our mind = 1110

$parent_id = 0;
$db = db_connect("admin");
$processedIds = array();
// $r = addChildrenUrl($parent_id, $db);
$r = addChildrenUrl($parent_id, $db, 0, true);

// var_dump($children_id);

function addChildrenUrl($parentId, $db, $d = 0, $deep = false){
	global $processedIds;
	
	if( in_array($parentId, $processedIds) ){
		echo '!! id = ' . $parentId . ' is already processed'."\n";
		return true;
	}
	$processedIds[] = $parentId;
	$sql = "SELECT objects.name1, objects.id, objects.url FROM objects, wires WHERE objects.id = wires.toid AND objects.active = '1' AND wires.active = '1' AND wires.fromid = '".$parentId."'";
	$result = $db->query($sql);
	if(!$result)
		throw new Exception($db->error);
	$items = array();
	while ($obj = $result->fetch_assoc())
		$items[] = $obj;
	$result->close();
	$layer = '>';
	for($i = 0; $i < $d; $i++)
	{
		$layer .= '>';
	}
	if(!empty($items)){
		foreach($items as $item){
			if(empty($item['url']))
			{
				echo $layer . ' processing ['.$item['id'].'] '.$item['name1']." ...\n";
				$sql = "UPDATE objects SET url = '".slug($item['name1'])."' WHERE id = '".$item['id']."'";
				$result_update = $db->query($sql);
			}
			else
			{
				echo '!! skiping ['.$item['id'].'] '.$item['name1']." ...\n";
			}
			if($deep)
				addChildrenUrl($item['id'], $db, $d + 1, $deep);
			
		}
	}
	else
	{
		echo 'record with id = ' . $parentId . ' doesnt have children.' . "\n";
		return false;
	}
	
}

function getChildrenId($parentId, $db){
	// echo "getChildrenId() ... \n";
	$sql = "SELECT toid FROM wires WHERE fromid = '".$parentId."'";
	$result = $db->query($sql);
	if(!$result)
		throw new Exception($db->error);
	$items = array();
	while ($obj = $result->fetch_assoc())
		$items[] = $obj['toid'];
	$result->close();
	return $items;
}


?>
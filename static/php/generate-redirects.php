<? 
echo "\n# generate-redirects.php ...\n";

$site_path = '/Library/WebServer/Documents/wattis.local';
set_include_path($site_path);
require_once('open-records-generator/lib/lib.php');

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

$db = db_connect("admin");

$sql = "SELECT objects.id FROM wires, objects WHERE wires.active = '1' AND objects.active = '1' AND wires.toid = objects.id";
$result = $db->query($sql);
if(!$result)
	throw new Exception($db->error);
$items = array();
while ($obj = $result->fetch_assoc())
	$items[] = $obj;
$result->close();

/*
	Example:
	RewriteCond %{QUERY_STRING} ^(.*)&?id=439&?(.*)$ [NC]
	                                      ^^^
	RewriteRule ^/?(.*)$ /about?%1%2 [R=301,L,NC]
	                     ^^^^^^
*/
$string_segment_1 = 'RewriteCond %{QUERY_STRING} ^(.*)&?id=';
$string_segment_2 = '(?:&(.*))?$ [NC]' . "\n" . 'RewriteRule ^/?(.*)$ ';
$string_segment_3 = '?%1%2 [R=301,L,NC]' . "\n";

foreach($items as $item)
{
	$this_complete_url = getCompleteUrl($item['id']);
	if($this_complete_url)
		echo $string_segment_1 . $item['id'] . $string_segment_2 . $this_complete_url . $string_segment_3;
	else
		echo '# [' . $item['id'] . ']' . $item['name1'] . ' failed to get complete url' . "\n";
}

function getObjectsUrl($id){
	/*
		input:  id
		output: the url of the reocrd with the given id
	*/
	global $db;
	$sql = "SELECT objects.url FROM objects, wires WHERE objects.active = '1' AND wires.active = '1' AND objects.id = wires.toid AND objects.id = '" . $id . "'";
	$result = $db->query($sql);
	if(!$result)
		throw new Exception($db->error);
	$items = array();
	while ($obj = $result->fetch_assoc())
		$items[] = $obj;
	$result->close();
	if(!empty($items))
		return $items[0]['url'];
	else
		return false;
}

function getCompleteUrl($id){
	/*
		input:  id
		output: a complete url of the reocrd with the given id based on o-r-g stucture
	*/
	global $db;
	$output = '';

	$sql = "SELECT wires.fromid, objects.url FROM objects, wires WHERE objects.active = '1' AND wires.active = '1' AND objects.id = wires.toid AND objects.id = '" . $id . "'";
	$result = $db->query($sql);
	if(!$result)
		throw new Exception($db->error);
	$items = array();
	while ($obj = $result->fetch_assoc())
		$items[] = $obj;
	$result->close();
	if(!empty($items)){
		$fromid = $items[0]['fromid'];
		$output = '/' . $items[0]['url'];
		while ($fromid != 0)
		{
			$sql = "SELECT wires.fromid, objects.url FROM objects, wires WHERE objects.active = '1' AND wires.active = '1' AND objects.id = wires.toid AND objects.id = '" . $fromid . "'";
			$result = $db->query($sql);
			if(!$result)
				throw new Exception($db->error);
			$items = array();
			while ($obj = $result->fetch_assoc())
				$items[] = $obj;
			$result->close();
			$fromid = $items[0]['fromid'];

			/*
				specific to wattis where "main" is hidden in url
			*/
			if($items[0]['url'] != 'main')
				$output = '/' . $items[0]['url'] . $output;
			
		}
		return $output;
	}
	else
		return false;
}

?>
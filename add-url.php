<? 
echo "add url...\n";
$cwd = getcwd();
echo $cwd."\n";
// set_include_path($cwd);
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
// id
// Home = 1
// Main = 3
// Gallery = 4
// On Our Mind = 6
// Calendar = 7
// Browse the Library = 752
// Browse the Library > Watch / Listen = 776
// Main > Consult the Archive = 30
$db = db_connect("admin");
$sql = "SELECT objects.name1, objects.id FROM objects, wires WHERE objects.id = wires.toid AND objects.active = '1' AND wires.active = '1' AND wires.fromid = '30'";
$result = $db->query($sql);
if(!$result)
	throw new Exception($db->error);
$items = array();
while ($obj = $result->fetch_assoc())
	$items[] = $obj;
$result->close();
foreach($items as $item){
	$sql = "UPDATE objects SET url = '".slug($item['name1'])."' WHERE id = '".$item['id']."'";
	echo $sql."\n";
	$result_update = $db->query($sql);
	var_dump($result_update);
}
// $result_update->close();


?>
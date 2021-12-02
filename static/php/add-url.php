<? 
echo "\nadd-url.php ...\n";

$cwd = getcwd();
set_include_path($cwd);
require_once($cwd . '/../../open-records-generator/lib/lib.php');

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
		$dbse = "wattis_live";

		// full access
		$creds['full']['db_user'] = "root";
		$creds['full']['db_pass'] = "";

		// read / write access
		// (can't create / drop tables)
		$creds['rw']['db_user'] = "root";
		$creds['rw']['db_pass'] = "";

		// read-only access
		$creds['r']['db_user'] = "root";
		$creds['r']['db_pass'] = "";
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

$parent_id = 0;
$processedIds = array();

/*
	urls to be updated
*/ 
$oldOrgUrls = array(
	'view_','display_','library_'
);

$r = addChildrenUrl($parent_id, $db, 0, true);

function addChildrenUrl($parentId, $db, $d = 0, $deep = false){
	/*
		This function adds url to those records without urls, and replace urls which are listed in $oldOrgUrls.

		$parentId: parent of the records that need to add urls
		$db      : $db
		$d       : for aligning the output text. no practical usages
		$deep    : if true, the function targets all the descendants; if false, it targets the children only.
	*/
	global $processedIds;
	global $oldOrgUrls;
	
	if( in_array($parentId, $processedIds) ){
		echo '!! id = ' . $parentId . ' is already processed'."\n";
		return true;
	}
	$processedIds[] = $parentId;
	$sql = "SELECT objects.name1, objects.id, objects.url FROM objects, wires WHERE objects.id = wires.toid AND wires.fromid = '".$parentId."'";
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
		$sibling_url = array();
		foreach($items as $item){
			if( 
				empty($item['url']) ||
				in_array($item['url'], $oldOrgUrls)
			)
			{
				echo $layer . ' processing ['.$item['id'].'] '.$item['name1']." ...\n";
				/*
					check url of siglings
				*/
				// if( $item['id'] == '22' )
				// 	$this_url = 'about';
				// elseif( $item['id'] == '25' )
				// 	$this_url = 'support';
				// elseif( $item['id'] == '30' )
				// 	$this_url = 'archive';
				// elseif( $item['id'] == '23' )
				// 	$this_url = 'visit';
				// elseif( $item['id'] == '26' )
				// 	$this_url = 'editions';
				// elseif( $item['id'] == '31' )
				// 	$this_url = 'capp';
				// elseif( $item['id'] == '752' )
				// 	$this_url = 'library';
				// elseif( $item['id'] == '29' )
				// 	$this_url = 'intern';
				// elseif( $item['id'] == '28' )
				// 	$this_url = 'follow';
				// elseif( $item['id'] == '27' )
				// 	$this_url = 'catalogs';
				// elseif( $item['id'] == '24' )
				// 	$this_url = 'contact';
				// elseif( $item['id'] == '93' )
				// 	$this_url = 'program';
				// else
				// 	$this_url = slug($item['name1']);

				$this_url = slug(strip_tags($item['name1']));

				if(in_array($this_url, $sibling_url))
					$this_url = strval($item['id']);

				
				$sql = "UPDATE objects SET url = '".$this_url."' WHERE id = '".$item['id']."'";
				$result_update = $db->query($sql);
			}
			else
			{
				echo '!! skiping ['.$item['id'].'] '.$item['name1']." ...\n";
				$this_url = $item['url'];
			}
			
			if(strpos($this_url, '.php') === false)
				$sibling_url[] = $this_url;

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

?>

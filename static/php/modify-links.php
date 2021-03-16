<? 
echo "\nmodify-links.php ...\n";

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

$db = db_connect("admin");

/* 
	add/remove fields to check in the array
*/
$fields_to_check = array('name1', 'deck', 'body');
$views_list_arr = array('view', 'list', 'library', 'library_view', 'display', 'buy');
if(count($views_list_arr) > 0)
{
	$views_pattern = '(?:';
	$views_pattern .= implode($views_list_arr, '|');
	$views_pattern .= ')';
}
else
{
	echo "Please specify the view(s) that need to be replaced as $views_list_arr.";
	die();
}
/* 
	look for url that
	1. with views names specifed in $views_list_arr that might be followed by '_' and might be followed by '.php' and are followed by "?id="
	E.g. view?id=1
		 view_?id=1
		 view.php?id=1
		 view_.php?id=1
		 /view?id=1
		 /view_?id=1
		 ...
	2. with a domain name that is one of the following:
		 https://wattis.org
		 http://wattis.org
		 https://www.wattis.org
		 http://www.wattis.org
	   or without a domain name
	3. followed by quote, double quote (<a>), or space
*/
	   /*
$pattern = '#<a\s.*?(?:href.*?=.*?[\'"]((?:https?:\/\/(?:www\.)?wattis\.org\/?)?\/?(?:view|list|library|library_view|display|buy)_?(?:\.php)?\?id=(.*?))[\'"]).*?>#is';
*/
$pattern = '#((?:https?:\/\/(?:www\.)?wattis\.org\/?)?\/?(?:view|list|library|library_view|display|buy)_?(?:\.php)?\?id=(.*?))[\'"\s\/]#is';
/* 
	look for wattis.org url that
	1. is either http:// or https://
	2. with or without www
*/
$pattern_wattis = '/https?:\/\/(?:www\.)?wattis\.org\/?/';
/*
	replace wattis.org url with '/'
*/
$replacement_wattis = '/';

/*
	if $target_id = '', the code will run through the whole database
*/
$target_id = '';
// $target_id = 1170;

foreach($fields_to_check as $field)
{
	if($field != 'name')
		$sql = "SELECT objects.id, objects.name1, objects." . $field;
	else
		$sql = "SELECT objects.id, objects." . $field;
	$sql .= " FROM objects WHERE " . $field . " LIKE '%?id=%'";

	if($target_id)
		$sql .= " AND id = '".$target_id."'";
	
	$result = $db->query($sql);
	if(!$result)
		throw new Exception($db->error);
	$items = array();
	while ($obj = $result->fetch_assoc())
		$items[] = $obj;
	$result->close();
	foreach($items as $item)
	{
		echo "\n[" . $item['id'] . '][' . $field . '] ' . $item['name1'] . "\n";
		$this_field = $item[$field];
		$this_links = array();
		preg_match_all($pattern, $this_field, $this_links);
		/* 
			$this_links contains 3 arrays
			$this_links[0]: An array of opening tags of the hyperlinks.
			                E.g. <a href = 'https://wattis.org?id=1'>
			$this_links[1]: An array of urls
			                E.g. https://wattis.org?id=1
			$this_links[2]: query string without "?id="
							E.g. 1
		*/                 
		$this_urls = $this_links[1];
		$this_querystrings = $this_links[2];
		$new_urls = array();
		$needsUpdate = false;
		foreach($this_urls as $key => $url)
		{
			/*
				replace wattis.org url with '/'
			*/
			$new_url = preg_replace($pattern_wattis, $replacement_wattis, $url);
			if(empty($new_url))
				$new_url = '/' . $new_url;
			else
			{
				$new_url = '';

				$querystring = array();
				$querystring_temp = $this_querystrings[$key];
				if(strpos($querystring_temp, '&amp;') !== false )
					$querystring = explode('&amp;', $querystring_temp);
				else
					$querystring[0] = $querystring_temp;
				
				/* 
					$querystring[0] is IDs
					$querystring[1] ... are other query strings like alt, if any.
				*/
				if(!empty($querystring[0]))
				{
					$id_array = explode(',', $querystring[0]);
					$url_temp = '';
					foreach($id_array as $id)
					{
						$u = getObjectsUrl($id);
						if($u)
							$url_temp .= '/' . $u;
					}
					$new_url .= $url_temp;

					$new_url = getCompleteUrl(end($id_array));
				}
				if(count($querystring) > 1)
				{
					$new_url .= '?';
					foreach($querystring as $key => $s)
					{
						if($key != 0)
						{
							if($key == 1)
								$new_url .= $s;
							else
								$new_url .= '&amp;' . $s;
						}
					}
				}
				$needsUpdate = true;
				echo $url . '  =>  ' . $new_url . "\n";
				$new_urls[] = $new_url;
				$this_field = str_replace($url, $new_url, $this_field); 
			}
		}
		if($needsUpdate)
		{
			$this_field = addslashes($this_field);
			$sql = "UPDATE objects SET ".$field." = '".$this_field."' WHERE id = '".$item['id']."' AND active = '1'";
			$result_update = $db->query($sql);
			if($result_update)
				echo "    >>> update successes\n";
			else
				echo "    >>> error!\n";
		}
		else
			echo "    >>> no needs to update\n";
	}
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
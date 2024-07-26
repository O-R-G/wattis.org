<?
function strictEmpty($str){
  while(ord(substr($str, 0, 1)) == '9' || 
        ord(substr($str, 0, 1)) == '10' || 
        ord(substr($str, 0, 1)) == '13' || 
        ord(substr($str, 0, 1)) == '32')
  {
    $str = substr($str, 1);
  }

  if(empty($str))
    return true;
  return false;
}
function strictClean($str)
{
  while(ord(substr($str, 0, 1)) == '9' || 
        ord(substr($str, 0, 1)) == '10' || 
        ord(substr($str, 0, 1)) == '13' || 
        ord(substr($str, 0, 1)) == '32'
       )
  {
    $str = substr($str, 1);
  }
  if(!empty($str))
  {
    while(ord(substr($str, strlen($str) - 1)) == '9' || 
          ord(substr($str, strlen($str) - 1)) == '10' || 
          ord(substr($str, strlen($str) - 1)) == '13' || 
          ord(substr($str, strlen($str) - 1)) == '32'
         )
    {
      $str = substr($str, 0, strlen($str) - 1);
    }
  }
  return $str;
}

function getRandomRecords($amount = 10, $fetched_ids_arr = array()){
    global $db;
    global $oo;

    // collect objects

    $sql = "SELECT objects.id, objects.body FROM objects, wires WHERE objects.active = '1' AND wires.active = '1' AND objects.id = wires.toid AND objects.name1 NOT LIKE '.%' AND objects.name1 NOT LIKE '\_%' AND objects.body != '' AND objects.body != 'NULL'";

    $sql_media = "SELECT media.* FROM media, objects, wires WHERE objects.active = '1' AND media.active = '1' AND wires.active = '1' AND media.object = objects.id AND media.object = wires.toid AND (media.type = 'gif' OR media.type = 'jpg' OR media.type = 'png')";

    if(!empty($fetched_ids_arr)) {
        $fetched_ids = '(' . implode(',', $fetched_ids_arr) . ')';
        $sql .= ' AND objects.id NOT IN '. $fetched_ids;
        $sql_media .= ' AND objects.id NOT IN '. $fetched_ids;
    }

    // _Emails
    $sql_emails_id = "SELECT id FROM objects WHERE name1 = '_Emails' AND active = '1'";
    $res = $db->query($sql_emails_id);
    if($res !== false)
    {
      $emails_id = '';
      while ($obj = $res->fetch_assoc())
          $emails_id = $obj['id'];
      $res->close();
      $emails_descendant_ids = getDescendantIds( $emails_id, true, true, false );
      if(!empty($emails_descendant_ids))
      {
        $emails_descendant_ids = '(' . $emails_descendant_ids . ')';

        $sql .= ' AND wires.fromid NOT IN '. $emails_descendant_ids;
        $sql .= ' AND objects.id NOT IN '. $emails_descendant_ids;
        $sql_media .= ' AND wires.fromid NOT IN '. $emails_descendant_ids;
        $sql_media .= ' AND objects.id NOT IN '. $emails_descendant_ids;
      }
    }

    // Home
    $sql_home_id = "SELECT id FROM objects WHERE name1 = 'Home' AND active = '1'";
    $res = $db->query($sql_home_id);
    if($res !== false)
    {
      $home_id = '';
      while ($obj = $res->fetch_assoc())
          $home_id = $obj['id'];
      $res->close();
      $home_descendant_ids = getDescendantIds( $home_id, true, true, false );
      if(!empty($home_descendant_ids))
      {
        $home_descendant_ids = '(' . $home_descendant_ids . ')';
        $sql .= ' AND wires.fromid NOT IN '. $home_descendant_ids;
        $sql .= ' AND objects.id NOT IN '. $home_descendant_ids;
        $sql_media .= ' AND wires.fromid NOT IN '. $home_descendant_ids;
        $sql_media .= ' AND objects.id NOT IN '. $home_descendant_ids;
      }
    }
    // $sql .= " ORDER BY RAND() LIMIT 50;";
    $sql .= " ORDER BY RAND() LIMIT " . $amount . ";";
    $res = $db->query($sql);
    $items = array();
    while ($obj = $res->fetch_assoc())
        $items[] = $obj;
    $res->close();
    $output = array();
    $output['all'] = array();
    $output['image'] = array();
    $insertImage = false;

    // collect media (gifs)

    $sql_media .= " ORDER BY RAND();";
    $res = $db->query($sql_media);
    $media = array();
    while ($obj = $res->fetch_assoc())
        $media[] = $obj;
    $res->close();

    // build $output

    foreach($items as $key => $item) {
        if ($key % 2 == 0 && $key > 0 && !$insertImage)
            $insertImage = true;    
        if ($insertImage) {
            $this_media = $media[$key];
            $image = m_url($this_media);
            $id = $this_media['object'];
            $sentence = 'cccc';
            $insertImage = false;
            $output['image'][] = $image;
        } else {
            $id = $item['id'];
            $body = $item['body'];
            $sentences = preg_split('/(?<=[.?!])\s+(?=[a-z])/i', $body);
            $sentence = $sentences[array_rand($sentences)];
            $image = false;
        }

        $url = getCompleteUrl($id, false, false);
        /* 
          some records of delected parent will be fetched as well since its active is still 1
          these records yield incomplete url with getCompleteUrl())
        */
        if( substr($url , 0, 1) != '/')
          continue;

        $output['all'][] = array( 
          'id'       => $id, 
          'sentence' => $sentence,
          'image'    => $image,
          'url'      => $url
        );
    }
    return $output;
}

function build_children_search($oo, $ww, $query) {
    $query = preg_replace('/[^a-z0-9]+/i', ' ', $query);
    $query = addslashes($query);
    $query = strtolower($query);
    $query = str_replace(' ', '%', $query);

    // exclude all emails
    $emails_id = end($oo->urls_to_ids(array('emails')));
    $emails = $oo->children($emails_id);
    foreach ($emails as $email)
        $ids[] = $email['id'];
    $not_in = '(' . implode(', ', $ids) . ')';
    // search
    $fields = array("objects.*");
    $tables = array("objects", "wires");
    $where  = array("objects.active = '1'",
                  "(LOWER(CONVERT(BINARY objects.name1 USING utf8mb4)) LIKE '%" . $query .
                  "%' OR LOWER(CONVERT(BINARY objects.deck USING utf8mb4)) LIKE '%" . $query . 
                  "%' OR LOWER(CONVERT(BINARY objects.body USING utf8mb4)) LIKE '%" . $query . 
                  "%' OR LOWER(CONVERT(BINARY objects.notes USING utf8mb4)) LIKE '%" . $query ."%')",
                  "objects.name1 NOT LIKE '.%'",
                  "wires.toid = objects.id",
                  "wires.active = '1'",
                  "wires.fromid NOT IN " . $not_in . "" );
    $order  = array("objects.name1", "objects.begin", "objects.end");
    $children = $oo->get_all($fields, $tables, $where, $order, '', false, true);
    foreach($children as &$child)
    {
      $this_url = getCompleteUrl($child['id']);
      $child['url'] = $this_url;
    }
    unset($child);

    return $children;
}

function build_children_librarySearch($oo, $ww, $query) {
    $children_combined = array();
    $library_id = end($oo->urls_to_ids(array('main', 'browse-the-library')));
    $submenu = $oo->children($library_id);
    $category_ids = '';
    $category_meta = array();
    foreach($submenu as $s) {
        if(substr($s['name1'], 0, 1) != '.'){
            $s_url = $s['url'];
            $s_name = $s['name1'];
            $submenu_children = $oo->children($s['id']);
            foreach($submenu_children as $sc) {
                if(substr($sc['name1'], 0, 1) != '.'){
                    $category_ids .= ",'" . $sc['id'] . "'";
                    $category_meta[$sc['id']] = array(
                        'url'    => $sc['url'],
                        'fromid' => $s['id'],
                        'fromurl' => $s['url']
                    );
                }
            }
        }
    }
    $category_ids = substr($category_ids, 1); //remove the first comma

    $query = preg_replace('/[^a-z0-9]+/i', ' ', $query);
    $query = addslashes($query);
    $query = strtolower($query);
    $query = str_replace(' ', '%', $query);
    // search
    $fields = array("objects.*, wires.fromid");
    $tables = array("objects", "wires");
    $where  = array("objects.active = '1'",
                  "(LOWER(CONVERT(BINARY objects.name1 USING utf8mb4)) LIKE '%" . $query .
                  "%' OR LOWER(CONVERT(BINARY objects.deck USING utf8mb4)) LIKE '%" . $query . "%')",
                  "objects.name1 NOT LIKE '.%'",
                  // "objects.name1 NOT LIKE '_%'",
                  "wires.toid = objects.id",
                  "wires.active = '1'",
                  "wires.fromid IN (". $category_ids .")"
            );
    $order  = array("objects.rank");
    $children = $oo->get_all($fields, $tables, $where, $order);
    foreach($children as $child) {
        $this_cat_meta = $category_meta[$child['fromid']];
        $this_child = $child;
        $this_child['category_url'] = $this_cat_meta['url'];
        $this_child['submenu_url'] = $this_cat_meta['fromurl'];
        $children_combined[] = $this_child;
    }
    return $children_combined;
}

function getCompleteUrl($id, $includeHome = true, $includeEmail = true){
  /*
    input:  id
    output: a complete url of the reocrd with the given id based on o-r-g stucture
  */
  global $db;
  $output = '';

  $sql = "SELECT wires.fromid, objects.url FROM objects, wires WHERE objects.active = '1' AND wires.active = '1' AND objects.id = wires.toid AND objects.id = '" . $id . "'";

  // _Emails
  if(!$includeEmail)
  {
    $sql_email_childrens_ids = "SELECT toid FROM wires WHERE fromid = (SELECT id FROM objects as o WHERE o.name1 = '_Emails')";
    $res = $db->query($sql_email_childrens_ids);
    if($res !== false)
    {
      $items = array();
      while ($obj = $res->fetch_assoc())
          $items[] = $obj['toid'];
      $email_children_ids = '(' . implode(',', $items) . ')';
      $sql .= ' AND wires.fromid NOT IN '. $email_children_ids;
      $sql .= ' AND objects.id NOT IN '. $email_children_ids;
      $res->close();
    }
  }
  

  // Home
  if(!$includeHome)
  {
    $sql_home_childrens_ids = "SELECT toid FROM wires WHERE fromid = (SELECT id FROM objects as o WHERE o.name1 = 'Home')";
    $res = $db->query($sql_home_childrens_ids);
    if($res !== false)
    {
      $items = array();
      while ($obj = $res->fetch_assoc())
          $items[] = $obj['toid'];
      $home_children_ids = '(' . implode(',', $items) . ')';
      $sql .= ' AND wires.fromid NOT IN '. $home_children_ids;
      $sql .= ' AND objects.id NOT IN '. $home_children_ids;
      $res->close();
    }
  }  

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

function clean_caption($str){
  $output = $str;
  $caption_tags = array(
    '[hiddenfromhomepage]'
  );
  foreach($caption_tags as $tag)
  {
    $output = str_replace($tag, '', $output);
  }
  return $output;
}

function get_single_tag($str){
  $bracket_pattern = '/\[(.*?)\]/';
  preg_match($bracket_pattern, $str, $output);
  return $output[1];
}

function split_column($str){
  $column_break = '///';
  $output = array();
  if(strpos($str, $column_break) !== false)
  {
    $columns_temp = explode($column_break, $str);
    foreach($columns_temp as $c)
      $output[] = $c;
  }
  else
  {
    $output[] = $str;
  }
  return $output;
}
function getDescendantIds($this_id, $removeLastComma = true, $activeOnly=true, $excludeLinked = false)
{
  global $db;
  $output = '';
  $sql = "SELECT wires.toid FROM wires, objects WHERE objects.id = wires.toid AND wires.fromid = '".$this_id."'";
  if($activeOnly)
    $sql .= " AND wires.active = '1' AND objects.active = '1'";
  $res = $db->query($sql);
  if($res !== false)
  {
    // $hasChildren = true;
    $items = array();
    while ($obj = $res->fetch_assoc()){
      if($obj['toid'] != '')
      {
        $items[] = $obj['toid'];
        if($excludeLinked)
        {
          $sql_2 = "SELECT wires.fromid FROM wires, objects WHERE objects.id = wires.toid AND wires.toid = '".$obj['toid']."' AND wires.active = '1' AND objects.active = '1'";
          $res_2 = $db->query($sql_2);
          if($res_2 !== false)
          {
            $items_2 = array();
            while ($obj_2 = $res_2->fetch_assoc()){
              $items_2[] = $obj_2['fromid'];
            }
          }
          if(count($items_2) == 1)
            $output .= $obj['toid'] . ',';
        }
        else
          $output .= $obj['toid'] . ',';
      }
    }
    $res->close();
    foreach($items as $this_id)
    {
      $descendant = getDescendantIds($this_id, false, $activeOnly, $excludeLinked);
      if(!empty($descendant)){
        $output .= $descendant;
      }
    }
  }
  if($removeLastComma && substr($output, strlen($output) - 1, 1) == ',')
    $output = substr($output, 0, -1);
  return $output;
}
function glue_query_params($query_param){
	if(empty($query_param)) return '';
	$output = array();
	foreach($query_param as $key => $val) {
		$output[] = $val ? $key . '=' . $val : $key;
	}
	return '?' . implode('&', $output);
}
?>

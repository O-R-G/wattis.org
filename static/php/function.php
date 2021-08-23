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

function getRandomRecords($records = '10', $fetched_ids_arr = array()){
    global $db;
    global $oo;

    // collect objects

    $sql = "SELECT objects.id, objects.body FROM objects, wires WHERE objects.active = '1' AND wires.active = '1' AND objects.id = wires.toid AND objects.name1 NOT LIKE '.%' AND objects.name1 NOT LIKE '\_%' AND objects.body != '' AND objects.body != 'NULL'";
    if(!empty($fetched_ids_arr)) {
        $fetched_ids = '(' . implode(',', $fetched_ids_arr) . ')';
        $sql .= ' AND objects.id NOT IN '. $fetched_ids;
    }
    // $sql .= " ORDER BY RAND() LIMIT 50;";
    $sql .= " ORDER BY RAND() LIMIT " . $records . ";";
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

    $sql = "SELECT * FROM media WHERE media.type = 'gif' AND media.active = '1' ORDER BY RAND()";
    $res = $db->query($sql);
    $media = array();
    while ($obj = $res->fetch_assoc())
        $media[] = $obj;
    $res->close();

    // build $output

    foreach($items as $key => $item) {
        $body = $item['body'];
        $id = $item['id'];
        if ($key % 2 == 0 && $key > 0 && !$insertImage)
            $insertImage = true;    
        if ($insertImage) {
            $image = m_url($media[array_rand($media)]);
            $sentence = '';
            $insertImage = false;
            $output['image'][] = $image;
        } else {
            $sentences = preg_split('/(?<=[.?!])\s+(?=[a-z])/i', $body);
            $sentence = $sentences[array_rand($sentences)];
            $image = false;
        }
        $output['all'][] = array( 
          'id'       => $id, 
          'sentence' => $sentence,
          'image'    => $image
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
      $this_url = get_full_url($child);
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

function get_full_url($item){
  global $db;
  $this_id = $item['id'];
  $this_url = $item['url'];
  // $output = '/' . $this_url;
  
  while($this_id != 0)
  {
    $sql = "SELECT wires.fromid, objects.url FROM wires, objects WHERE objects.id = wires.toid AND wires.active = '1' AND objects.active = '1' AND objects.id='".$this_id."' LIMIT 1";
    $res = $db->query($sql);
    if($res == null || $res->num_rows == 0)
      break;
    else
      $a = $res->fetch_assoc();
    $this_id = $a['fromid'];
    $output = '/' . $a['url'] . $output;
  }
  $res->close();
  return $output;
}
?>

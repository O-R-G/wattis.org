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
          ord(substr($str, 0, 1)) == '32'
         )
    {
      $str = substr($str, 0, strlen($str) - 1);
    }
  }
  return $str;
}

function getRandomRecords($markedBold = false){
  global $db;
  global $oo;

  // collect records

  if(!$markedBold)
  {
    // ver 1: totally random
    $sql = "SELECT objects.id, objects.body FROM objects, wires WHERE objects.active = '1' AND wires.active = '1' AND objects.id = wires.toid AND objects.name1 NOT LIKE '.%' AND objects.name1 NOT LIKE '\_%' AND objects.body != '' AND objects.body != 'NULL'";
  }
  else
  {
    $sql = "SELECT objects.id, objects.body FROM objects, wires WHERE objects.active = '1' AND wires.active = '1' AND objects.id = wires.toid AND objects.name1 NOT LIKE '.%' AND objects.name1 NOT LIKE '\_%' AND objects.body LIKE '%<b>%'";
  }
  $sql .= " ORDER BY RAND() LIMIT 100";

  $res = $db->query($sql);
  $items = array();
  while ($obj = $res->fetch_assoc())
    $items[] = $obj;
  $res->close();
  $output = array();
  $output['all'] = array();
  $output['image'] = array();
  $insertImage = false;

  // collect media, gif only

  $sql = "SELECT * FROM media WHERE media.type = 'gif' ORDER BY RAND()";
  $res = $db->query($sql);
  $media = array();
  while ($obj = $res->fetch_assoc())
    $media[] = $obj;
  $res->close();

  // build

  foreach($items as $key => $item)
  {
    $body = $item['body'];
    $id = $item['id'];
/*
    $media = $oo->media($id);
    $isGif = false;
    foreach($media as $m)
    {
      if($m['type'] == 'gif'){
        $isGif = false;
        break;
      }
    }
*/

    if($key % 2 == 0 && $key > 0 && !$insertImage)
      $insertImage = true;
    if(!$insertImage || count($media) == 0)
    {
      if(!$markedBold)
        $sentences = preg_split('/(?<=[.?!])\s+(?=[a-z])/i', $body);
      else{

        // $pattern = "/<b ?.*>(.*)<\/b>/i";
        // preg_match_all($pattern, $body, $sentences);
        $sentences_raw = explode('<b>', $body);
        $sentences = array();
        foreach($sentences_raw as $raw)
        {
          if(strpos($raw, '</b>') !== false){
            $sentences[] = substr($raw, 0, strpos($raw, '</b>'));
          }
        }
      }
      $sentence = $sentences[array_rand($sentences)];
      $image = false;
    }
    else
    {
      $image = m_url($media[array_rand($media)]);
      $sentence = '';
      $insertImage = false;
      $output['image'][] = $image;
    }
    $output['all'][] = array( 
      'id'       => $id, 
      'sentence' => $sentence,
      'image'    => $image
    );
  }

  /*
  // testing
  foreach ($media as $m)
    echo "<img src='" . m_url($m) . "'>";
  die();
  */

  return $output;
}
function build_children_search($oo, $ww, $query) {
  $query = preg_replace('/[^a-z0-9]+/i', ' ', $query);
  $query = addslashes($query);
  $query = strtolower($query);
  $query = str_replace(' ', '%', $query);
  // search
  $fields = array("objects.*");
  $tables = array("objects", "wires");
  $where  = array("objects.active = '1'",
                  "(LOWER(CONVERT(BINARY objects.name1 USING utf8mb4)) LIKE '%" . $query .
                  "%' OR LOWER(CONVERT(BINARY objects.deck USING utf8mb4)) LIKE '%" . $query . "%')",
                  "objects.name1 NOT LIKE '.%'",
                  // "objects.name1 NOT LIKE '_%'",
                  "wires.toid = objects.id",
                  "wires.active = '1'");
  $order  = array("objects.name1", "objects.begin", "objects.end");
  $children = $oo->get_all($fields, $tables, $where, $order);
  return $children;
}
function build_children_librarySearch($oo, $ww, $query) {
  $children_combined = array();
  $library_id = end($oo->urls_to_ids(array('main', 'library')));
  $submenu = $oo->children($library_id);
  $category_ids = '';
  $category_meta = array();
  foreach($submenu as $s)
  {
    if(substr($s['name1'], 0, 1) != '.'){
      $s_url = $s['url'];
      $s_name = $s['name1'];
      $submenu_children = $oo->children($s['id']);
      foreach($submenu_children as $sc)
      {
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
  // var_dump($category_meta);
  // die();
  foreach($children as $child)
  {
    $this_cat_meta = $category_meta[$child['fromid']];
    $this_child = $child;
    $this_child['category_url'] = $this_cat_meta['url'];
    $this_child['submenu_url'] = $this_cat_meta['fromurl'];
    $children_combined[] = $this_child;
  }

  return $children_combined;
}



?>

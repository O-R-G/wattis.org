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
  foreach($items as $key => $item)
  {
    $body = $item['body'];
    $id = $item['id'];
    $media = $oo->media($id);
    $onlyPdf = true;
    foreach($media as $m)
    {
      if($m['type'] != 'pdf'){
        $onlyPdf = false;
        break;
      }
    }

    if($key % 4 == 0 && $key > 0 && !$insertImage)
      $insertImage = true;
    
    if(!$insertImage || count($media) == 0 || $onlyPdf)
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

  return $output;
}



?>
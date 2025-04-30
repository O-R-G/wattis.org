<main class="black" style = 'padding: 100px 80px;'><?php
if(!isset($_GET['parent'])) {
    echo 'please specify parent_id in url query';
    exit();
}
$parent_id = $_GET['parent'];
$sql = "SELECT objects.* FROM objects, wires WHERE objects.id = wires.toid AND wires.fromid = $parent_id ORDER BY objects.begin DESC";
$result = $db->query($sql);
if(!$result) {
    echo 'the parent has no children';
    exit();
}
$children = array();
while($obj = $result->fetch_assoc()) {
    $children[] = $obj;
}

function modifyText($str){
    $pattern = '/(?<!<br>)\r\n/';
    $replacement = '<br>' . "\r\n";
    $output = preg_replace($pattern, $replacement, $str);
    return $output;
}
$fields = array('deck', 'body');
function loopChildren($children){
    global $fields;
    global $oo;
    global $db;
    foreach($children as $child) {
        echo '<br>' . $child['name1'] . '<br>'; 
        foreach($fields as $field) {
            echo $field . ' ';
            if(!$child[$field]) {
                echo '>> empty!<br>';
                continue;
            }
            $modified = modifyText($child[$field]);
            $toUpdate = $modified != $child[$field];
            
            if(!$toUpdate) {
                echo '>> no need to update<br>';
                continue;
            }
            $sql = "UPDATE objects SET $field = '" . addslashes($modified) . "' WHERE id = " .$child['id']. "";
            $result = $db->query($sql);
            if($result) echo '>> updated<br>';
            else echo '>> error<br>';
        }
        $grandChildren = $oo->children($child['id']);
        if($grandChildren)
            loopChildren($grandChildren);
    }
}
loopChildren($children);
?></main>
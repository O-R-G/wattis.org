<?
require_once('static/php/displayMedia.php');
    $base_name = "Library";
    // $ids[0] is main
    $base_id = $ids[1];
    $base_url = $uri[1];
    $submenu_id = $ids[2];
    $submenu_url = $uri[2];
    $category_id = $ids[3];
    $category_url = $uri[3];
    $category_name = $oo->name($category_id);

    $name = nl2br($item['name1']);
    $body = nl2br($item['body']);
    $date = date('F d, Y', strtotime($item['begin']));
?>
<div class="mainContainer times big">
    <div class='listContainer side-listContainer times'>
        <a href='/library/<?= $submenu_url; ?>'><?= $base_name; ?></a><br><br>
        <span class="italic"><?= $category_name; ?><br></span>
    </div><div class = 'listContainer main-listContainer library lastListContainer'>
        <div class='subheadContainer'><?= $name; ?></div>
        <?= $body; ?>
    </div>
</div>
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

    $pattern = "/\[image(\d+)\]/";
    preg_match_all($pattern, $body, $out, PREG_PATTERN_ORDER);
    $img_indexes = $out[1];
    $media = $oo->media($item['id']);
    $images = array();
    if(!empty($media))
        {
            $image_files = array();
            $image_captions = array();

            $image_float = array();
            foreach($media as $key => $m)
            {
                $mediaFile = m_url($m);
                // $mediaFile = "/media/". str_pad($myrow["mediaId"], 5, "0", STR_PAD_LEFT) .".". $myrow["type"];
                $mediaCaption = clean_caption(strip_tags($m["caption"]));
                $mediaStyle = "width: 100%;";
                if($m["type"] == "pdf")
                    $mediaFile = "/media/pdf.gif";
                else
                    $mediaFile = m_url($m);
                $image_files[] = $mediaFile;
                $image_captions[] = $mediaCaption;      

                if(in_array($key+1, $img_indexes))
                {
                    // $randomWidth = rand(15, 25);
                    $width = 100;    // 90% of text column

                    if(!$isMobile)
                        $images[$key] = "<div id='image".$key."' class = 'inline-img-container' style='width: $width%;' onclick='launch($key);'>";
                    else
                        $images[$key] = "<div id='image".$key."' class = 'imageContainer'>";
                    
                    $images[$key] .= displayMedia($mediaFile, $mediaCaption, $mediaStyle);
                    $images[$key] .= "<div class='captionContainer monaco small'>" . $image_captions[$key] . "</div>";
                    $images[$key] .= "</div>";
                    // insert images into body
                    // remove leading and trailing whitespace for consistency
                    // (necessary whitespace is added in css)
                    $pattern = "/\[image".($key+1)."\]/";
                    $body = preg_replace($pattern, $images[$key], $body);
                    unset($images[$key]);
                }
                else 
                {

                    $randomPadding = rand(0, 150);
                    $randomWidth = rand(30, 50);
                    $randomFloat = (rand(0, 1) == 0) ? 'left' : 'right';
                    
                    if(!$isMobile)
                    {
                        $images[$key] = "<div class = 'imageContainerWrapper' style='width:" . $randomWidth . "%; float:" . $randomFloat . ";'>";
                        $images[$key] .= "<div id='image".$key."' class = 'imageContainer' style='padding-top:{$randomPadding}px; margin:40px;' onclick='launch($key);'>";
                    }
                    else
                    {
                        $images[$key] = "<div class='imageContainerWrapper'>";
                        $images[$key] .= "<div id='image".$key."' class = 'imageContainer'>";
                    }
                    $images[$key] .= displayMedia($mediaFile, $mediaCaption, $mediaStyle);
                    // var_dump($mediaFile);
                    // var_dump(displayMedia($mediaFile, $mediaCaption, $mediaStyle));
                    // die();
                    $images[$key] .= "<div class='captionContainer caption helvetica small'>";
                    $images[$key] .= $mediaCaption;
                    $images[$key] .= "</div>";
                    $images[$key] .= "</div>";
                    $images[$key] .= "</div>";
                }
            }
            
        }
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
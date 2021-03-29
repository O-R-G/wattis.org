<?php
	require_once('static/php/displayMedia.php');
	$hasFilter = false;
	$isUpcoming = false;
	$isToday = false;
	if($uri[1] == 'calendar')
		$hasFilter = true;
	if(end($uri) == 'upcoming')
		$isUpcoming = true;
	if(end($uri) == 'today')
		$isToday = true;
	$rootid = $ids[0];
	if(strpos($uri[2], 'past-exhibitions') !== false )
		$rootid = $oo->urls_to_ids(array('gallery'))[0];
	elseif(strpos($uri[2], 'research-seasons') !== false )
		$rootid = $oo->urls_to_ids(array('on-our-mind'))[0];
	elseif(strpos($uri[2], 'events') !== false ){
		$rootid = $oo->urls_to_ids(array('calendar'))[0];
	}
	
	$root_item = $oo->get($rootid);
	$root_url = $root_item['url'];
	$children = $oo->children($rootid);
	$name = $item['name1'];
	/*
		for calendar
	*/
	if($date_argument || $isUpcoming)
	{
		if($date_argument == 'today' || $isUpcoming){
            $date_start = date('Y-m-d') . ' 00:00:00';
            $day_count = 1;
        }
        else
        {
            $date_start = $date_argument;
            $day_count = date('t', strtotime($date_argument))-1;
        }  
        $children = build_filter_children($oo, $root_item, $date_start, NULL, $day_count, $isUpcoming, $isToday);
	}
	$date_since = '2014-09-09';
	for ($y = date('Y'); $y >= date('Y', strtotime($date_since)); $y--)
    	$years[] = $y;

    $now = ($date_argument) ? strtotime($date_argument) : strtotime('now');
?>
<div class="mainContainer times big">
	<? if($hasFilter){
			?>
	<div id = 'filter_container' class="helvetica medium">
		
		<!-- <div id='filter-2' class = 'item'>
			<ul class = 'year'>
				<li class = 'sans <?= $isToday ? 'active' : '';  ?>'>
					<a class = 'year' href = '<? echo '/'.$uri[1]; ?>/today'>Today</a>
				</li>
			</ul>
			<ul class = 'year'>
				<li class = 'sans <?= $isUpcoming ? 'active' : '';  ?>'>
					<a class = "year" href = '<? echo '/'.$uri[1]; ?>/upcoming'>Upcoming</a>
				</li>
			</ul>
		</div> -->
		<div id='filter' class = 'item'>
			<ul class = 'year'>
				<li class = 'sans <? echo (!$uri[2] || ($uri[2] && !$date_argument)) ? 'active' : '' ?>'>
					<a class = "year" href = '<? echo $sub_category ? '/'.$uri[1].'/' . $uri[2] : '/'.$uri[1]; ?>'>All</a>
				</li>
			</ul>
		<?
        foreach ($years as $year)
            display_filter($uri, $year, $date_since, $date_argument, $sub_category);
    ?></div></div>
	<? } ?>
	<div class='listContainer times'><?= $name; ?></div>
	<div class='listContainer doublewide times'>
	<?php
	
		foreach($children as $key => $child){
			if (substr($child['name1'], 0, 1) != '.') {
				$url = $child["url"];
				$url = ($url) ? "/" . $root_url . "/".$url : "view_";

				$now = time();
				$begin = ($child['begin'] != null) ? strtotime($child['begin']) : $now;
				$end = ($child['end'] != null) ? strtotime($child['end']) : $now;
				
				if ( ($alt && ($end < $now)) ||
					  $uri[1] == 'calendar'
					) {
					// archive
					?>
						<div class='listContainer'>
							<a href='<?= $url; ?>'><?= $child['name1']; ?></a> 
							<i><?= $child['deck']; ?></i>
						</div>
					<?
				} else if (!$alt && (($begin >= $now) || ($end >= $now))) {
					// upcoming
					?>
						<div class='listContainer'>
							<a href='<?= $url; ?>'><?= $child['name1']; ?></a> 
							<i><?= $child['deck']; ?></i>
						</div>
					<?
				} 

			}
		}
	?>
</div>
<?
function display_filter($uri, $year, $date_since, $date_argument, $sub_category) {
    $since = ($year == date("Y")) ? date("m") : 12;
    $start = (date('Y', strtotime($date_since)) == $year) ? date('m', strtotime($date_since)) : 1;
    $base_url =  $uri[1] . '/';
    
    if($date_argument == 'today')
      $year_active = NULL;
    else
      $year_active = ($year == date('Y', strtotime($date_argument))) ? 'active' : NULL;
    ?><ul class="year">
        <li class="<? echo $year_active; ?> sans">
            <a id="btn_<? echo $year; ?>" href="/<? echo $base_url; ?>" onclick="hide_show_year('<? echo $year; ?>'); return false;" class="year"><? echo $year ?></a>
            <ul id='<? echo $year; ?>' class='<? echo (!$year_active) ? "" : "active" ?>'><?
                for ($month = $start; $month <= $since; $month++) {
                  if($date_argument == 'today')
                    $month_active = NULL;
                  else
                    $month_active = ($month == date('m', strtotime($date_argument)) && $year_active) ? 'active' : NULL;
                    $year_month = $year . '-' . str_pad($month, 2, '0', STR_PAD_LEFT);

                    ?><li class='month <? echo $month_active; ?>'><?
                        ?><a href="/<? echo $base_url . $year_month; ?>" class="month"><?
                        echo strtoupper(date('M', mktime(0, 0, 0, $month, 10)));
                            // echo date('M', mktime(0, 0, 0, $month, 10));
                        ?></a>
                    </li><?
                }
            ?></ul>
        </li>
    </ul><?
}

function build_filter_children($oo, $root, $date, $archive = NULL, $days = 30, $isUpcoming=false, $isToday = false) {

    /*
        $children[] => "id", "name1", etc.
                    => "root"   => "id"
                                => "name"
                                => "url"
                                => "class"
    */

    // $date_start and $date_end seem to be flipped but leave like that for now
    $date_start = date('Y-m-d', strtotime($date . "+" . $days . "  days"));
    if ($archive)
        $date_end = date('Y-m-d', strtotime($archive));
    else
        $date_end = date('Y-m-d', strtotime($date));
    if($isUpcoming)
      $date_compare = ["DATE(objects.end) >= '$date_end'"];
  	elseif($isToday)
      $date_compare = ["DATE(objects.begin) < '$date_start'", "DATE(objects.end) >= '$date_end'"];
    else
      $date_compare = ["DATE(objects.begin) <= '$date_start'", "DATE(objects.end) >= '$date_end'"];

    $fields = array("objects.*");
    $tables = array("objects", "wires");
    $where  = array("wires.fromid = '".$root['id']."'",
                    "wires.active = 1",
                    "wires.toid = objects.id",
                    "objects.active = '1'");
    if ($date)
        $where = array_merge($where, $date_compare);
    
    $order  = array("objects.rank", "objects.begin", "objects.name1");
    $children = $oo->get_all($fields, $tables, $where, $order);
    
    return $children;
}

?>
<script>
	function hide_show_year(id) {
		var activeYear = document.querySelector('li ul.active');
		if(activeYear != null)
			activeYear.classList.remove('active');
		var expandedBtn = document.querySelector('.year li a.expanded');
		if(expandedBtn != null)
			expandedBtn.classList.remove('expanded');

		var x = document.getElementById(id);
		var btn_x = document.getElementById('btn_'+id);
		// if (x.style.display === "none")
		//     x.style.display = "inline-block";
		// else
		//     x.style.display = "none";

		if(activeYear == null || activeYear.id != id)
		{
			x.classList.add('active');
			btn_x.classList.add('expanded');
		}

	}
</script>
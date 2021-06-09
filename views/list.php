<?
	require_once('static/php/displayMedia.php');
	$hasFilter = false;
	$twoCategories = false;
	$isUpcoming = false;
	$isToday = false;
	$yearsOnly = false;

	$show_children_date = false;
	$show_children_deck = false;

	if($uri[1] == 'our-program'){
		$hasFilter = true;
		$show_children_date = true;
		$date_since = '2014-09-09';
        if (!$date_argument)
            $date_argument = valid_date('today');

		$twoCategories = true;
		$cat1_name = 'On view:';
    	$cat1_url = 'gallery';
    	$cat1_rootid = end($oo->urls_to_ids(array($cat1_url)));
    	$cat2_name = 'On our mind:';
    	$cat2_url = 'on-our-mind';
    	$cat2_rootid = end($oo->urls_to_ids(array($cat2_url)));

    	$yearsOnly = true;
	} else if($uri[1] == 'calendar') {
		$hasFilter = true;
		$show_children_deck = true;
		$date_since = '2014-09-09';
        if (!$date_argument)
            $date_argument = valid_date('today');
	} else
		$show_children_deck = true;

    /*
	if(end($uri) == 'upcoming')
	    $isUpcoming = true;
	if(end($uri) == 'today')
	    $isToday = true;
    */

	/*
		exceptions for pages not fetching children by their urls
	*/
	$rootid = $ids[0];
	if(strpos($uri[2], 'past-exhibitions') !== false )
		$rootid = $oo->urls_to_ids(array('gallery'))[0];
	elseif(strpos($uri[2], 'research-seasons') !== false )
		$rootid = $oo->urls_to_ids(array('on-our-mind'))[0];
	elseif(strpos($uri[2], 'events') !== false )
		$rootid = $oo->urls_to_ids(array('calendar'))[0];
	
	$root_item = $oo->get($rootid);
	$root_url = $root_item['url'];
	$name = $item['name1'];

	/*
		build children
	*/
	if(!$date_argument){
		if($twoCategories)
	    {
	    	$cat1_children = $oo->children($cat1_rootid);
			$cat2_children = $oo->children($cat2_rootid);
	    } else
	    	$children = $oo->children($rootid);
	} else {
		$hasMonth = strpos($date_argument, '-');
		if ($hasMonth) {
			$date_start = $date_argument;
			$day_count = intval(date('t', strtotime($date_argument))) - 1;
		} else {
			$date_start = $date_argument . '-01';
			$isLeapYear = date('L', strtotime($date_argument));
			if($isLeapYear)
				$day_count = 365;
			else
				$day_count = 364;
		}		
        if ($twoCategories) {
        	$cat1_children = build_filter_children($oo, $cat1_rootid, $date_start, NULL, $day_count);
        	$cat2_children = build_filter_children($oo, $cat2_rootid, $date_start, NULL, $day_count);
        }
        else
        	$children = build_filter_children($oo, $rootid, $date_start, NULL, $day_count);
	}
	/*
		end build children
	*/

	for ($y = date('Y'); $y >= date('Y', strtotime($date_since)); $y--)
    	$years[] = $y;

    $now = ($date_argument) ? strtotime($date_argument) : strtotime('now');

?><div class="mainContainer times big"><? 
    if($hasFilter){
	    ?><div id = 'filter_container' class="helvetica medium">
		    <div id='filter' class = 'item'>
			    <ul id='yearsContainer'>
				    <li class = 'year sans <? echo (!$uri[2] || ($uri[2] && !$date_argument)) ? 'active' : '' ?>'>
					    <a class = "year-btn" href = '<? echo $sub_category ? '/'.$uri[1].'/' . $uri[2] : '/'.$uri[1]; ?>'>Now</a>
				    </li><?
                    foreach ($years as $year)
                        display_filter($uri, $year, $date_since, $date_argument, $sub_category, $yearsOnly);
                    if($uri[1] == 'our-program'){
			            ?><li class = 'year sans'>
				            <a class = "year-btn" href = 'http://archive.wattis.org'>before ...</a>
			            </li><?
                    }
                ?></ul>
            </div>
        </div><? 
    } 
    ?><div class='listContainer times title-bloc'><?= $name; ?></div><?
		if($twoCategories)
		{
			?><div class='listContainer times categoryContainer'>
				<p><?= $cat1_name; ?></p><br>
				<? foreach($cat1_children as $child){
					if (substr($child['name1'], 0, 1) != '.') {
						print_list_child($child, $cat1_url, $show_children_date, $show_children_deck);
					}
				} ?>
			</div><div class='listContainer times categoryContainer'>
				<p><?= $cat2_name; ?></p><br>
				<? foreach($cat2_children as $child){
					if (substr($child['name1'], 0, 1) != '.') {
						print_list_child($child, $cat2_url, $show_children_date, $show_children_deck);
					}
				} ?>
			</div><?
		}
		else
		{
		?><div class='listContainer doublewide times'>
		<?php
		
			foreach($children as $key => $child){
				if (substr($child['name1'], 0, 1) != '.') {
					$url =  "/" . $root_url . "/".$url ;
					$now = time();
					$begin = ($child['begin'] != null) ? strtotime($child['begin']) : $now;
					$end = ($child['end'] != null) ? strtotime($child['end']) : $now;
					
					print_list_child($child, $root_url, $show_children_date, $show_children_deck);

					/*
					// keep the old code in case
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
					*/

				}
			}
		}
	?>
	
</div><?
function display_filter($uri, $year, $date_since, $date_argument, $sub_category, $yearsOnly = false) {
    $since = ($year == date("Y")) ? date("m") : 12;
    $start = (date('Y', strtotime($date_since)) == $year) ? date('m', strtotime($date_since)) : 1;
    $base_url =  $uri[1] . '/';
    
    if($date_argument) {
    	$hasMonth = (strpos($date_argument, '-') !== false);
	    if( !$hasMonth && $date_argument != 'today')
	    	$date_argument = $date_argument . '-01';
	    if($date_argument == 'today')
	      $year_active = NULL;
	    else
	      $year_active = ($year == date('Y', strtotime($date_argument))) ? 'active' : NULL;
    }
    
    ?><li class="year sans <? echo (!$year_active) ? "" : "active" ?>">
            <a id="<? echo $year; ?>-btn" href="/<? echo $base_url . $year; ?>" class="year-btn"><? echo $year ?></a>
            <? if(!$yearsOnly){ ?>
	            <ul id='<? echo $year; ?>' class='monthsContainer' ><?
	                for ($month = $start; $month <= $since; $month++) {
	                  if($date_argument == 'today')
	                    $month_active = NULL;
	                  else
	                    $month_active = ($month == date('m', strtotime($date_argument)) && $year_active) && $hasMonth ? 'active' : NULL;
	                    $year_month = $year . '-' . str_pad($month, 2, '0', STR_PAD_LEFT);

	                    ?><li class='month <? echo $month_active; ?>'><?
	                        ?><a href="/<? echo $base_url . $year_month; ?>" class="month"><?
	                        echo strtoupper(date('M', mktime(0, 0, 0, $month, 10)));
	                            // echo date('M', mktime(0, 0, 0, $month, 10));
	                        ?></a>
	                    </li><?
	                }
	            ?></ul>
        	<? } ?>
    </li><?
}

function build_filter_children($oo, $rootid, $date, $archive = NULL, $days = 30, $isUpcoming=false, $isToday = false) {

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
    $where  = array("wires.fromid = '".$rootid."'",
                    "wires.active = 1",
                    "wires.toid = objects.id",
                    "objects.active = '1'");
    if ($date)
        $where = array_merge($where, $date_compare);
    
    $order  = array("objects.rank", "objects.begin", "objects.name1");
    $children = $oo->get_all($fields, $tables, $where, $order);
    
    return $children;
}

function print_list_child($child, $root_url = false, $show_date = false, $show_deck = false) {
	$title = $child['name1'];
	if($root_url)
		$url = '/' . $root_url . '/'.$child['url'];
	else
		$url = '/'.$child['url'];
	$formatted_date = false;
	$deck = false;
	if($show_date)
	{
		if( $child['begin'] && $child['end']){
			$begin_year = date('Y', $child['begin']);
			$end_year = date('Y', $child['end']);

			if($begin_year == $end_year)
				$begin = date('F j', strtotime($child['begin']));
			else
				$begin = date('F j, Y', strtotime($child['begin']));
			$end = date('F j, Y', strtotime($child['end']));
		}
		else if($child['begin'])
		{
			$begin = date('F j, Y', strtotime($child['begin']));
			$end = '';
		}
		else if($child['end'])
		{
			$end = date('F j, Y', strtotime($child['end']));
			$begin = '';
		}
		$formatted_date = $child['begin'] || $child['end'] ? $begin . ' - ' . $end : false;
	}							
	
	if($show_deck)
		$deck = $child['deck'];
	
	
	?><div class='list-item'>
		<a href='<?= $url; ?>'>
			<?= ($formatted_date && $show_date) ? '<i>' . $formatted_date . '</i><br>' : ''; ?>
			<?= $title; ?>
		</a> 
		<?= $deck ? '<i>' . $deck . '</i>' : ''; ?>
	</div><?
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
		var btn_x = document.getElementById(id+'-btn');
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

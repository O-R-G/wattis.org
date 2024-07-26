<?
	require_once('static/php/displayMedia.php');
	$hasFilter = false;
	$twoCategories = false;
	$isUpcoming = false;
	$isToday = false;
	$yearsOnly = false;

	$show_children_date = false;
	$show_children_deck = false;

	$filter_keep_query_string = true;

	$rootid = $item['id'];
	$sub_category = false;

	if($uri[1] == 'our-program'){
		$hasFilter = true;
		$show_children_date = true;
		$date_since = '2014-09-09';
        if (!$date_argument){
        	$isUpcoming = true;
        	$date_argument = valid_date('today');
        	// $date_argument = date('Y-m-d', strtotime('today'));
        	$isToday = true;
        }
        	
		$twoCategories = true;
		$children = $oo->children($item['id']);
		$cats = [];
		foreach($children as $child){
			if(count($cats) > 2)
				break;
			else if( substr($child['name1'], 0, 1) != '.' && substr($child['name1'], 0, 1) != '_')
			{
				$cats[] = array(
					'id'   => $child['id'],
					'name' => $child['name1'] . ':',
					'url'  => $uri[1] . '/' . $child['url']
				);
			}
		}
		/*
		$cat1_name = 'On view:';
    	$cat1_url = 'gallery';
    	$cat1_rootid = end($oo->urls_to_ids(array('main', 'our-program', $cat1_url)));
    	$cat2_name = 'On our mind:';
    	$cat2_url = 'on-our-mind';
    	$cat2_rootid = end($oo->urls_to_ids(array('main', 'our-program', $cat2_url)));
    	*/

    	$yearsOnly = true;
	} else if($uri[1] == 'calendar') {
		$hasFilter = true;
		$show_children_deck = true;
		$date_since = '2014-09-09';
		if (!$date_argument){
			$date_argument = 'upcoming';
			// $date_argument = date('Y-m-d', strtotime('today'));
			// $isToday = true;
			$isUpcoming = true;
		}
	} else if(strpos($uri[2], 'past-exhibitions') !== false ){
		$rootid = end($oo->urls_to_ids(array('main','our-program','gallery')));
		$show_children_deck = false;
	} elseif(strpos($uri[2], 'research-seasons') !== false ){
		$rootid = end($oo->urls_to_ids(array('main','our-program','on-our-mind')));
		$show_children_deck = false;
	} elseif(strpos($uri[2], 'events') !== false )
		$rootid = end($oo->urls_to_ids(array('main','calendar')));
	else
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
	$rootid = $item['id'];
	if(isset($uri[2]))
	{
		if(strpos($uri[2], 'past-exhibitions') !== false ){
			$rootid = end($oo->urls_to_ids(array('main','our-program','gallery')));
			$show_children_deck = false;
		}
		elseif(strpos($uri[2], 'research-seasons') !== false ){
			$rootid = end($oo->urls_to_ids(array('main','our-program','on-our-mind')));
			$show_children_deck = false;
		}
		elseif(strpos($uri[2], 'events') !== false )
			$rootid = end($oo->urls_to_ids(array('main','calendar')));
	}
	
	$root_item = $oo->get($rootid);
	$root_url = $root_item['url'];
	$name = $item['name1'];

	/*
		build children
	*/

	if(!$date_argument){
		if($twoCategories)
	    {
	    	/*
	    	$cat1_children = $oo->children($cat1_rootid);
			$cat2_children = $oo->children($cat2_rootid);
			*/

			foreach($cats as &$cat)
				$cat['children'] = $oo->children($cat['id']);

			unset($cat);
	    } else{
	    	$children = $oo->children($rootid);
	    }
	} else {
		$hasMonth = strpos($date_argument, '-');
		if ($hasMonth) {
			$date_start = $date_argument;
			$day_count = intval(date('t', strtotime($date_argument))) - 1;
		} else if($isToday){
			$date_start = date('Y-m-d', strtotime($date_argument));
			$day_count = 1;
		}
		else {
			// year only
			if($isUpcoming)
				$date_start = date('Y-m-d', strtotime('today'));
			else
				$date_start = $date_argument . '-01';

			$isLeapYear = date('L', strtotime($date_argument));
			if($isLeapYear)
				$day_count = 365;
			else
				$day_count = 364;
		}		
        if ($twoCategories) {
        	foreach($cats as &$cat)
				$cat['children'] = build_filter_children($oo, $cat['id'], $date_start, NULL, $day_count, $isUpcoming, $isToday);
			unset($cat);
        }
        else if(isset($_GET['program']))
        {
        	// $filter_keep_query_string = true;
        	$children = array();
        	$temp = $oo->urls_to_ids(array('main', 'our-program', $_GET['program']));
        	$oom_id = end($temp);
        	$oom_children = $oo->children($oom_id);
        	foreach($oom_children as $oom_child)
        	{
        		$event_id = false;
        		$event_id_sql = '(SELECT w.toid FROM objects AS o, wires AS w WHERE o.active = "1" AND w.active = "1" AND w.toid = o.id AND w.fromid = "'.$oom_child['id'].'" AND o.url = "events")';
        		$res = $db->query($event_id_sql);
				if(!$res)
					throw new Exception($db->error);
				while ($obj = $res->fetch_assoc())
					$event_id = $obj['toid'];
				$res->close();
				if($event_id)
        			$children = array_merge($children, build_filter_children($oo, $event_id, $date_start, NULL, $day_count, $isUpcoming, $isToday));
        	}
        }
    	else{
    		$children = build_filter_children($oo, $rootid, $date_start, NULL, $day_count, $isUpcoming, $isToday);
    	}
	}
	/*
		end build children
	*/

	for ($y = date('Y'); $y >= date('Y', strtotime($date_since)); $y--)
    	$years[] = $y;
    $now = $date_argument ? strtotime($date_argument) : strtotime('now');

?><div class="mainContainer times big"><? 
    if($hasFilter){
	    ?><div id = 'filter_container' class="helvetica medium">
		    <div id='filter' class = 'filter'>
			    <ul id='yearsContainer'>
				    <li class = 'year sans <? echo (!isset($uri[2]) && !isset($_GET['date'])|| ($uri[2] && !$date_argument)) ? 'active' : '' ?>'>
					    <a class = "year-btn" href = '<? echo $sub_category ? '/'.$uri[1].'/' . $uri[2] : '/'.$uri[1]; ?>'>Now</a>
				    </li><?
                    foreach ($years as $year)
                        display_filter($uri, $year, $date_since, $date_argument, $sub_category, $yearsOnly, $filter_keep_query_string);
                    if($uri[1] == 'our-program'){
			            ?><li class = 'year sans'>
				            <a class = "year-btn" href = 'https://wattis-archive.cca.edu/exhibitions/archive' target="_blank">before ...</a>
			            </li><?
                    }
                ?></ul>
                <ul class="filter-placeholder"><?
                	if(count($years) > 1)
                		$placeholder_year = $years[1];
                	else
                		$placeholder_year = $years[0];
	                display_filter($uri, $placeholder_year, $date_since, $date_argument, $sub_category, $yearsOnly, $filter_keep_query_string);
	            ?></ul>
            </div>
            <? if($uri[1] == 'calendar')
	    	{
	    		$submenu = array(
	    			array(
	    				'name' => 'Research Events',
	    				'slug'  => 'on-our-mind'
	    			),
	    			array(
	    				'name' => 'Exhibition/Other Events',
	    				'slug'  => 'on-view'
	    			)
	    		);
	    		?><div id="filter-program" class="filter right-filter">
		    		<ul id='yearsContainer'>Filters: 
					    <?
					    $base_url = implode('/', $uri);
	                    foreach ($submenu as $key => $s)
                        {
                        	$isActive = isset($_GET['program']) && $_GET['program'] == $s['slug'];
			    			$this_name = ucfirst($s['name']);
							$params = $_GET;
							if($isActive) unset($params['program']);
							else $params['program'] = $s['slug'];
			    			$this_url = $base_url . glue_query_params($params);
			    			?><li class="sans year <?= $isActive ? 'active' : ''; ?>"><a class='year-btn' href="<?= $this_url; ?>"><?= $this_name; ?></a></li><? 
			    			if($key != count($submenu) - 1)
		    				{ ?> or <? }
                        }
	                ?></ul>
		    	</div><?
	    	}
	    	?>
        </div><? 
    } 
    ?><div class='listContainer side-listContainer times title-block'>
    	<?= $name; ?>
	</div><div class='listContainer main-listContainer times'><?
		if($twoCategories)
		{
			foreach($cats as $key => $cat)
			{
				$container_class = 'listContainer half-width times categoryContainer';
				if( $key == count($cats) - 1 )
					$container_class .= ' lastListContainer';
				?><div class='<?= $container_class; ?>'>
				<p><?= $cat['name']; ?></p><br>
				<? foreach($cat['children'] as $child){
					if (substr($child['name1'], 0, 1) != '.') {
						print_list_child($child, $cat['url'], $show_children_date, $show_children_deck, 'block');
					}
				} ?>
			</div><?
			}
		}
		else
		{
			foreach($children as $key => $child){
				if (substr($child['name1'], 0, 1) != '.') {
					$url =  "/" . $root_url . "/". $child['url'] ;
					$now = time();
					$begin = ($child['begin'] != null) ? strtotime($child['begin']) : $now;
					$end = ($child['end'] != null) ? strtotime($child['end']) : $now;
					print_list_child($child, $root_url, $show_children_date, $show_children_deck, 'third-width');
				}
			}
		}
	?>
	
</div><?
function display_filter($uri, $year, $date_since, $date_argument, $sub_category, $yearsOnly = false, $keepQueryString = false) {
    $since = ($year == date("Y")) ? date("m") : 12;
    $start = (date('Y', strtotime($date_since)) == $year) ? date('m', strtotime($date_since)) : 1;
    $base_url =  $uri[1];
    $queryString = '';
    
    if($date_argument) {
    	$hasMonth = (strpos($date_argument, '-') !== false);
	    if( !$hasMonth && $date_argument != 'today')
	    	$date_argument = $date_argument . '-01';
	    if($date_argument == 'today')
	      $year_active = NULL;
	    else
	      $year_active = ($year == date('Y', strtotime($date_argument))) ? 'active' : NULL;
    }

    if($keepQueryString && count($_GET) != 0){
    	$temp = array();
		$queryString = $_GET;
		$queryString['filter-date'] = $year;
    	foreach($_GET as $key => $val)
    		$temp[] = empty($val) ? $key : $key . '=' . $val; 
    	$queryString = '?' . implode('&', $temp);
    }
    
    ?><li class="year sans <? echo (!$year_active) ? "" : "active" ?>">
			<?php 
				$params = $keepQueryString ? array_merge($_GET, array('date' => $year)) : array('date' => $year);
				$queryString = glue_query_params($params);
			?>
            <a id="<? echo $year; ?>-btn" href="/<? echo $base_url . $queryString; ?>" class="year-btn"><? echo $year ?></a>
            <? if(!$yearsOnly){ ?>
	            <ul id='<? echo $year; ?>' class='monthsContainer' ><?
	                for ($month = $start; $month <= $since; $month++) {
					if($date_argument == 'today')
						$month_active = NULL;
					else
						$month_active = ($month == date('m', strtotime($date_argument)) && $year_active) && $hasMonth ? 'active' : NULL;
					$year_month = $year . '-' . str_pad($month, 2, '0', STR_PAD_LEFT);
					$params = $keepQueryString ? array_merge($_GET, array('date' => $year_month)) : array('date' => $year_month);
					$queryString = glue_query_params($params);
					?><li class='month <? echo $month_active; ?>'><?
						?><a href='/<? echo $base_url . $queryString; ?>' class='month'><?
							echo strtoupper(date('M', mktime(0, 0, 0, $month, 10)));
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
  	elseif($isToday){
      $date_compare = ["DATE(objects.begin) < '$date_start'", "DATE(objects.end) >= '$date_end'"];
  	}
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
    $order  = array("objects.begin", "objects.name1");
    $children = $oo->get_all($fields, $tables, $where, $order);
    
    return $children;
}
function build_filter_children_program($oo, $rootid){
	global $db;
	$children = $oo->children($rootid);
	$output = [];
	foreach($children as $child)
	{
		$sql = 'SELECT objects.* FROM objects, wires WHERE objects.active = "1" AND wires.active = "1" AND wires.toid = objects.id AND wires.fromid = (SELECT w.toid FROM objects AS o, wires AS w WHERE o.active = "1" AND w.active = "1" AND w.toid = o.id AND w.fromid = "'.$child['id'].'" AND o.url = "events") ORDER BY objects.rank DESC';
		$res = $db->query($sql);
		if(!$res)
			throw new Exception($db->error);
		while ($obj = $res->fetch_assoc())
			$output[] = $obj;
		$res->close();
		
	}
	return array_reverse($output);
}
function print_list_child($child, $root_url = false, $show_date = false, $show_deck = false, $class = '') {
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
			$begin_year = date('Y', strtotime($child['begin']));
			$end_year = date('Y', strtotime($child['end']));

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
	?><div class='listContainer <?= $class; ?>'>
		<?= ($formatted_date && $show_date) ? '<i>' . $formatted_date . '</i><br>' : ''; ?>
		<a href='<?= $url; ?>'>
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
	function toggle_calendar_category(btn) {
		let siblings = btn.parentNode.querySelectorAll('button');
		console.log(siblings);
		[].forEach.call(siblings, function(el){
			console.log(el.id);
			if(el.id != btn.id){
				let sibling = el;
				if( !sibling.classList.contains('inactive') )
					sibling.classList.add('inactive');
			}
		});
		btn.classList.remove('hover');
		btn.classList.toggle('inactive');
		btn.addEventListener('mouseout', toggle_calendar_category_hover(btn), false);
	}
	function toggle_calendar_category_hover(btn){
		btn.classList.add('hover');
		btn.removeEventListener('mouseout', toggle_calendar_category_hover);
	}
</script>

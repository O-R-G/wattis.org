<?php








  ///////////////////
 //  DB Settings  //
///////////////////

	// Client Name
	$dbClient = "OPEN-RECORDS-GENERATOR";

	// Client Color
	$dbColor = "000";
	$dbColor2 = "666";
	$dbColor3 = "333";

	// Client Username and Password -- read only
	$dbUser1 = "guest";
	$dbPass1 = "guest";

	// Client Username and Password -- read / write
	$dbUser2 = "main";
	$dbPass2 = "main";

	// Client Username and Password -- main
	$dbUser3 = "admin";
	$dbPass3 = "admin";

	// Database Start Date/Time
	$dbStart = mktime(20, 53, 00, 06, 04, 2014);
	// (hour, minute, second, month, day, year)

	// Client URL
	$dbHost = "http://www.wattis.org/";

	// DB Admin
	$dbAdmin = $dbHost ."OPEN-RECORDS-GENERATOR/";

	// DB Media
	$dbMedia = $dbHost ."MEDIA/";
	// Don't forget to set the permissions on this folder!







  ////////////////
 //  Database  //
////////////////

function dbConnectMain($dbUser) {

	$dbMainHost = "vm-mysql-07";
	$dbMainDbse = "wwwwattisdev";

	if 	($dbUser == 1) {		$dbMainUser = "wattisview"; 	$dbMainPass = "W4++15v13w"; }
	else if ($dbUser == 2) {		$dbMainUser = "wattisdev"; 	$dbMainPass = "W4++15d3v"; }
	else if ($dbUser == 3) {		$dbMainUser = "wattisdev";   	$dbMainPass = "W4++15d3v"; }

	$dbConnect = MYSQL_CONNECT($dbMainHost, $dbMainUser, $dbMainPass);
	MYSQL_SELECT_DB($dbMainDbse, $dbConnect);
}



?>

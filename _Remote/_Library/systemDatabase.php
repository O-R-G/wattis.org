<?php



  ////////////////
 //  Database  //
////////////////

function systemDatabase() {

	$dbMainHost = "vm-mysql-07";
	$dbMainUser = "wattisdev";
	$dbMainPass = "W4++15d3v";
	$dbMainDbse = "wwwwattisdev";

	$dbConnect = MYSQL_CONNECT($dbMainHost, $dbMainUser, $dbMainPass);
	MYSQL_SELECT_DB($dbMainDbse, $dbConnect);
}
systemDatabase();



?>

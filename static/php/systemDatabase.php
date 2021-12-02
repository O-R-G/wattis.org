<?php
include_once('fix_mysql.php');


  ////////////////
 //  Database  //
////////////////

function systemDatabase() {

	$dbMainHost = "localhost";
	$dbMainUser = "root";
	$dbMainPass = "f3f4p4ax";
	$dbMainDbse = "wattis_local";

	$dbConnect = MYSQL_CONNECT($dbMainHost, $dbMainUser, $dbMainPass);
	MYSQL_SELECT_DB($dbMainDbse, $dbConnect);
}
systemDatabase();



?>

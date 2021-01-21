<?php




  ////////////////
 //  Database  //
////////////////

function systemDatabase() {

	$dbMainHost = "db150a.pair.com";
	$dbMainUser = "acqmod";
	$dbMainPass = "Lt2U3YeV";
	$dbMainDbse = "acqmod_main";

	$dbConnect = MYSQL_CONNECT($dbMainHost, $dbMainUser, $dbMainPass);
	MYSQL_SELECT_DB($dbMainDbse, $dbConnect);
}
systemDatabase();









?>

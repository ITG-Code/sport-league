<?php
	ini_set('display_errors', 1);
	error_reporting(E_ALL);

	require_once("scheduler.php");

	$times = array(date("H:i:s", strtotime("17:00:00")), date("H:i:s", strtotime("20:00:00")));
	$teams = array(1,2,3,4,5,6,7,8,9,10,11,12);
	$scheduler = new Scheduler($teams, "1,2,3,4", true, $times, 15, 90, date("Y-n-j"), 1);
	$scheduler->generate();
?>
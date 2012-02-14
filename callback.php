<?php

date_default_timezone_set('UTC');

// Authentication headers for when required
if ($_GET['hub_challenge']) {
	echo $_GET['hub_challenge'];
	exit;
}

// here comes the feed! *om nom nom*
$data = file_get_contents("php://input");

// if you want to see the headers that have been sent, use this:
// file_put_contents('headers.txt', print_r($_SERVER,true));

// if you just want the data use this:
// file_put_contents('data.txt', $data);

?>

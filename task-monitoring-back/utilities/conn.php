<?php

function getConnection() {
	require('../config.php');
	require_once('../utilities/response.php');

	// mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
	ini_set("display_errors", "off");
	
	$servername = $connection["servername"];
	$username =  $connection["username"];
	$password =  $connection["password"];
	$db =  $connection["database"];

	// Create connection
	try {
	    $conn = new mysqli($servername, $username, $password, $db);
	    return $conn;
	} catch (Exception $e) {
	  	$data = array(
	  		"error" => "Database Connection",
	  		"message" => "There is Something Happened on our server, pls Contact IT For Support"
	  	);
	  	serverError($data);
	}	
}


?>
<?php


define("POST", "POST");
define("GET", "GET");
define("DELETE", "DELETE");
define("PATCH", "PATCH");
define("PUT", "PUT");

function getServerMethod() {
	return $_SERVER['REQUEST_METHOD'];
}

$method = getServerMethod();
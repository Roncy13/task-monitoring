<?php

require_once('../utilities/server-method.php');
require_once('../modules/user.php');

if ($method === POST && isset($_POST["action"])) {
	
	if ($_POST['action'] === 'login') {
		checkLogin($_POST);
	}
}
if ($method === POST) {
	createUser($_POST);
} else if ($method === GET && isset($_GET["page"])) {
	getUsers($_GET);
} else if ($method === DELETE) {
	parse_str(file_get_contents("php://input"), $data);
	deleteUser($data["id"]);
} else if ($method === PATCH) {
	parse_str(file_get_contents("php://input"), $data);
	changePassword($data["id"], $data["password"]);
}

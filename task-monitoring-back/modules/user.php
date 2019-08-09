<?php

require_once('../utilities/conn.php');
require_once('../utilities/response.php');

function createUser($data) {
	$conn = getConnection();

	$values = array();

	foreach($data as $key=> $value) {
		$values[] = $value;
	}

	try {
		$stmt = $conn->prepare('
			INSERT INTO users
			(
				firstName,
				middleName,
				lastName,
				phone,
				email,
				userPass,
				position_id
			)
			values
			(
				?,
				?,
				?,
				?,
				?,
				?,
				?
			);
		');

		$stmt->bind_param('ssssssi', ...$values);
		$stmt->execute();
		$insertId = $stmt->insert_id;

		$conn->close();
		$record = readByID($insertId);

		response($record, "User has been created successfully");

	} catch(Exception $e) {
		serverError('Error in Registering New Member');
	}
}


function readByCodeID($id) {
	return readByID($id, true);
}

function readByID($id, $return = false) {
	try {
		$conn = getConnection();
		$stmt = $conn->prepare('SELECT * from users where id = ? LIMIT 1');
		$stmt->bind_param('i', $id);
		$stmt->execute();
		$queryRes = $stmt->get_result();

		$data = array();

		foreach($queryRes as $val) {
			$data[] = $val;
		}

		return $data[0];
	} catch(Exception $e) {
		serverError('Error in Retrieving User With ID { $id }');
	}
}

function checkLogin($data) {
	$username = $data["email"];
	$password = $data["password"];
	
	try {
		$conn = getConnection();

		$stmt = $conn->prepare('
			SELECT 
				users.id,
				users.firstName, 
				users.lastName, 
				users.email, 
				users.phone, 
				users.middleName,
				position.title
			from users 
			INNER JOIN position on position.id = users.position_id
			where email = ? and userPass = ? LIMIT 1
		');
		$stmt->bind_param('ss', $username, $password);
		$stmt->execute();

		$queryRes = $stmt->get_result();
		
		if ($queryRes->num_rows === 0) {
			unauthorizedError($data, "User / Password Incorrect");
		} else {
			$data = array();

			foreach ($queryRes as $key => $value) {

				$data = $value;
			}

			$token = bin2hex(random_bytes(64));
			$data["token"] = $token;

			$stmt2 = $conn->prepare("INSERT INTO TOKENS (token, user_id, expired_at) values (?, ?, DATE_ADD(NOW(), INTERVAL 1 DAY))");

			$stmt2->bind_param('ss', $data["token"], $data["id"]);
			$stmt2->execute();

			response($data, "Login successfully");
		}

	} catch(Exception $e) {
		serverError('Error in Retrieving User With ID { $id }');
	}
}

function getUsers($data) {

	$conn = getConnection();
	$page = ($data["page"] - 1) * 10;

	try {

		$stmt = $conn->prepare("
			SELECT 
				u.id as id,
				CONCAT_WS(' ', u.firstName, u.middleName, u.lastName) as fullName,
				u.phone, 
				u.email, 
				pos.title 
			from users as u INNER JOIN position as pos on pos.id = u.position_id 
			ORDER BY u.id DESC 
			LIMIT 10 OFFSET ?
		");

		$stmt->bind_param('i', $page);
		$stmt->execute();

		$result = $stmt->get_result();

		$users = array();

		foreach($result as $value) {
			$users[] = $value;
		}

		$data = array();
		$data["users"] = $users;

		$countStmt = $conn->prepare('SELECT count(1) as num from users as u INNER JOIN position as pos on pos.id = u.position_id ');
		$countStmt->execute();
		$countResult = $countStmt->get_result();
		$countData = array();

		foreach($countResult as $value) {
			$countData = $value;
		}

		$data["page"] = ceil($countData["num"] / 10);

		response($data, 'Data fetch on page {$data["page"]}');

	} catch(Exception $e) {
		serverError('Error in Retrieving Users');
	}
}

function deleteUser($id) {
	$conn = getConnection();

	try {
		$stmt = $conn->prepare('DELETE FROM USERS where id = ?');
		$stmt->bind_param('i', $id);
		$stmt->execute();

		$result = $stmt->get_result();

		$rows = $stmt->affected_rows;

		response($rows, 'User with ID {$id} deleted successfully');
	} catch(Exception $e) {
		serverError('Error in Deleting User');
	}
}

function changePassword($id, $password) {
	$conn = getConnection();

	try {
		$stmt = $conn->prepare('UPDATE USERS set userPass = ? where id = ?');
		
		$stmt->bind_param('si', $password, $id);
		$stmt->execute();
		
		$rows = $stmt->affected_rows;
		response($rows, "User with ID {$id} password changed successfully");
	} catch(Exception $e) {
		serverError('Error in Retrieving Users');
	}
}
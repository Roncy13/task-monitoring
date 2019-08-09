<?php

require_once('../utilities/conn.php');
require_once('../utilities/response.php');

function positionDD() {
	$conn = getConnection();
	
	try { 

		$result = $conn->query('SELECT id, title from position where id != 3');

		if ($result->num_rows > 0) {

			$data = array();

			while($row = $result->fetch_assoc()) {
				$data[] = $row;
			}

			response($data, 'Position Retrieved Successfully');
		}
	} catch (Exception $err) {
		print_r($err);
	}
}
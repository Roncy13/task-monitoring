<?php

require_once('../utilities/server-method.php');
require_once('../modules/position.php');

if ($method === GET) {
	positionDD();
} else if ($method === POST) {
	echo "post";
}

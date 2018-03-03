<?php

$error = $_GET["error"];
$msg;

switch ($error) {
	
	case 'notloggedin':
		$msg = "You are not logged in.";
		break;
	
	default:
		$msg = "No error specified.";
		break;
}

echo "Error: " . $msg;

?>
<br />
<button onclick = "window.location.href = '/index.php'">Home</button>
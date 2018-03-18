<?php

if (isset($_GET["error"])) {$error = $_GET["error"];} else {$error = "";}
$msg;

switch ($error) {
	
	case 'notloggedin':
		$msg = "You are not logged in.";
		break;

	case 'noquestionid':
		$msg = "No question ID was specified";
		break;
	
	default:
		$msg = "No error specified.";
		break;
}

echo "Error: " . $msg;

?>
<br />
<button onclick = "window.location.href = '/index.php'">Home</button>
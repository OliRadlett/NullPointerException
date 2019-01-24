<?php

/**
 *
 * Page to display an error message to the user based on the error provided in the URL
 *
 * @author Oli Radlett <o.radlett@gmail.com>
 *
 */

// Check if the error type is provided in the URL
if (isset($_GET["error"])) {

    $error = $_GET["error"];

} else {

    $error = "";

}

// Initialise variable for good practice
$msg = null;

// Switch over the error provided in the URL and create the error message based on the error
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

// Display the error message
echo "Error: " . $msg;

?>
<br />
<!--Display a back to homepage button-->
<button onclick = "window.location.href = 'index.php'">Home</button>
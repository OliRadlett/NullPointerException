<!DOCTYPE html>
<?php

// Start PHP session
session_start();

// Include Database class
include "database.php";

// Create new Database object
$database = new Database();

?>

<head>
    <title>Blocking IP Address...</title>
</head>
<body>

<?php

// Create variables from POST
$ipaddr = $_POST['ipaddr'];
$date = date("d/m/Y");

// Block IP Address
$database->query("INSERT INTO `blocked_ipaddr` (`address`, `date_banned`) VALUES ('$ipaddr', '$date')");

echo "IP address blocked";
echo "<br />";

?>

<button onclick = "window.location.href='http://www.nullpointerexception.ml//admin.php'">Back</button>
</body>
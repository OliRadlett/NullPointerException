<!DOCTYPE html>
<?php

// Start PHP session
session_start();

// Include Database class
include "database.php";

// Create new Database object
$database = new Database();

// Is the current user logged in as admin
if ($_SESSION["username"] == "admin") {

?>

<head>
    <title>Admin portal</title>
</head>
<body>
    <!--Only render this form if the if statement passes-->
    <form name = "blockip" method = "post" action = "processipblock.php">
        <label>Block IP address</label>
        <input type = "text" name = "ipaddr" />
        <input type = "submit" value = "Block" />
    </form>
    <button onclick = "window.location.href='index.php'">Back</button>
</body>

<?php

} else {

//  Close headers and redirect user back to homepage
	session_write_close();
    header("Location: index.php");

}
?>
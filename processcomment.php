<?php

/**
 *
 * File used to insert a new comment into the database
 *
 * @author Oli Radlett <o.radlett@gmail.com>
 *
 */


//  Start a new PHP session
    session_start();

//  Include core files
    include "database.php";
    include "core.php";

?>
<!DOCTYPE html>
<head>
<link rel = "stylesheet" href = "stylesheets/general.css" />
</head>
<body>
<?php

// Create a new Database connection object
$database = new Database();


// Create and initialise variables from URL parameters
$id = $_GET['id'];
$comment = $_POST["comment"];
$username = $_SESSION["username"];
$time = time();
$address = $_SESSION["IPADDR"];

// Create a MySQL query to check if the user has been blocked from commenting no questions
$database->query("SELECT `address` FROM `blocked_ipaddr` WHERE `address` = '$address'");

// If no rows are returned then the user hasn't been blocked
if ($database->numRows() !== 1) {

//  Check if the user's comment contains any text
    if (!empty($comment)) {

//      Insert the comment into the database
        $database->query("INSERT INTO `comments` (`qid`, `comment`, `votes`, `time`, `author`) VALUES ('$id', '$comment', '1', '$time', '$username')");
//      Close headers and redirect the user back to the question they commented on
        session_write_close();
        Util::redirect("question.php?id=$id");

    } else {

//      Show error message and back button
        echo "Error - please make sure you have written a comment";
        echo "<br />";
        echo "<button onclick='window.location.href = `http://www.nullpointerexception.ml/ask.php?id=" . $id . "`';>Back</button>";

    }

} else {

//  Show error message
    echo "Your IP Address has been blocked from commenting";

}

?>
</body>
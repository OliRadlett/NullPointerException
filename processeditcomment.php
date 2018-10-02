<?php

/**
 *
 * Page to insert the new comment into the database
 *
 * @author Oli Radlett <o.radlett@gmail.com>
 *
 */

    // Start PHP session
    session_start();

    // Include core files
    include "database.php";
    include "core.php";
    include "questionFuncs.php"

?>
<!DOCTYPE html>
<head>
<link rel = "stylesheet" href = "stylesheets/general.css" />
</head>
<body>
<?php

//  Create a new Database object
    $database = new Database();

//  Create and initialise variables from URL parameters
    $id = $_GET['id'];
    $qid = $_GET["qid"];
    $comment = $_POST["comment"];
    $username = $_SESSION["username"];
    $time = time();

    $address = $_SESSION["IPADDR"];

//  Prepare and run a MySQL query to check if the user has been banned
    $database->query("SELECT `address` FROM `blocked_ipaddr` WHERE `address` = '$address'");
    $blocked = $database->numRows();

//  Use new Database object to prevent conflicts with local instance
    if (!isUsersComment(new Database(), $username, $id)) {

//    Close headers and redirect the user to an error page
      session_write_close();
      Util::redirect("error.php?error=unauth");

    }

//  If no rows returned from database then user isn't blocked
    if ($blocked == 0) {

//      Check if the edited comment contains text or not
        if (!empty($comment)) {

//          Change the comment in the database
            $database->query("UPDATE `comments` SET `comment` = '$comment' WHERE `id` = '$id'");
//          Close headers and redirect the user back to the question the comment they were editing was from
            session_write_close();
            Util::redirect("question.php?id=$qid");

        } else {

//          Show an error message and back button
            echo "Error - please make sure you have written a comment";
            echo "<br />";
            echo "<button onclick='window.location.href = `editcomment.php?id=" . $_GET["id"] . "`';>Back</button>";

        }

    } else {

//      Show an error message
        echo "Your IP Address has been blocked from commenting";

    }

?>
</body>

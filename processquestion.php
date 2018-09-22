<?php

/**
 *
 * PHP script for processing and inserting a new question into the database
 *
 * @author Oli Radlett <o.radlett@gmail.com>
 *
 */

// Start PHP session
session_start();

// Include Database class and core modules
include "database.php";
include "core.php";

// Create a new Database object
$database = new Database();

// Create variables from POST
$title = $_POST['title'];
$question = $_POST["question"];
$username = $_SESSION["username"];
$time = time();
$address = $_SESSION["IPADDR"];

// Check if the user's IP Address has been blocked
$database->query("SELECT `address` FROM `blocked_ipaddr` WHERE `address` = '$address'");

// If no rows are returned from the database then the user is not blocked
if ($database->numRows()!== 1) {

//  Check if the question title and question body are not empty
    if (!empty($title) && !empty($question)) {

//      Insert the question into the database
        $database->query("INSERT INTO `questions` (`title`, `question`, `votes`, `time`, `author`) VALUES ('$title', '$question', '1', '$time', '$username')");
//      Close the session in order to preserve session variables and headers
        session_write_close();
//      Redirect the user back to the questions page
        Util::redirect("Location: /qa.php");

//  If either the question title or the question are empty produce an error and a back button
    } else {

        Util::Error("Error - Please make sure you fill in every field", true, "ask.php");

    }

// If any results are returned (max 1) then the user is not allowed to ask questions
} else {

    echo "Your IP Address has been blocked from asking questions";

}

?>
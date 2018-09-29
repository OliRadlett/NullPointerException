<?php

//  Include Database class
    include "database.php";

//  Create a new Database object
    $database = new Database();

//  Create and initialise variables from URL parameters
    $qID = $_GET["qid"];
    $username = $_GET["username"];
    $func = $_GET["func"];


//  Get the user id of the user with the username provided in the URL
    $uID = getUserID($database, $username);

    // Can run preset SQL queries from by using URL params
    // This is insecure, fix this

//  Switch over the $func variable and run the requisite function
//  Do nothing if $func does not equal any of the cases
    switch ($func) {

        case 'removevote':
            RemoveVote($database, $qID, $uID);
            break;

        case 'addupvote':
            AddUpVote($database, $qID, $uID);
            break;

        case 'adddownvote':
            AddDownVote($database, $qID, $uID);
            break;

        default:
            break;

    }

    function AlreadyVoted(Database $database, $qID, $uID) {

        /**
         *
         * Function to check if a user has already voted on a question
         *
         * @param Database: $database - Database object
         * @param Int: $qID - The id of the question to check if the user has voted on
         * @param Int: $uID - The id of the user to check if they have voted on a question
         *
         * @return Boolean: true if the user with the user id provided in $uID has voted on the
         * question with the id provided in $qID. false if the user hasn't
         *
         * @author Oli Radlett <o.radlett@gmail.com>
         *
         */

//      Prepare and run a MySQL query to select the id attribute from the votes table if the qID attribute
//      matches the $qID parameter and the uID attribute matches the $uID parameter
        $database->query("SELECT `id` FROM `votes` WHERE (`qID` = '$qID' AND `uID` = '$uID')");

//      If there is a result from the query then the user must have voted on the question
        if (isset($result) && $database->numRows() > 0) {

            return true;

        } else {

            return false;

        }

    }
    function AddUpVote(Database $database, $qID, $uID) {

        /**
         *
         * Function to insert a positive vote into the database
         *
         * @param Database: $database - Database object
         * @param Int: $qID - The id of the question to add the positive vote to
         * @param Int: $uID - The id of the user that added the positive vote
         *
         * @author Oli Radlett <o.radlett@gmail.com>
         *
         */

//      Check that the user hasn't already voted
        if (!AlreadyVoted($database, $qID, $uID)) {

//          Prepare and run a MySQL query to insert a positive vote into the database
            $database->query("INSERT INTO `votes` (`qID`, `uID`, `type`) VALUES ('$qID', '$uID', 'u')");

        }

    }

    function AddDownVote(Database $database, $qID, $uID) {

        /**
         *
         * Function to insert a negative vote into the database
         *
         * @param Database: $database - Database object
         * @param Int: $qID - The id of the question to add the negative vote to
         * @param Int: $uID - The id of the user that added the negative vote
         *
         * @author Oli Radlett <o.radlett@gmail.com>
         *
         */

//      Check that the user hasn't already voted
        if (!AlreadyVoted($database, $qID, $uID)) {

//          Prepare and run a MySQL query to insert a negative vote into the database
            $database->query("INSERT INTO `votes` (`qID`, `uID`, `type`) VALUES ('$qID', '$uID', 'd')");

        }

    }

    function RemoveVote(Database $database, $qID, $uID) {

        /**
         *
         * Function to remove a vote from the database
         *
         * @param Database: $database - Database object
         * @param Int: $qID - The id of the question to remove the vote from
         * @param Int: $uID - The id of the user who's vote needs to be removed
         *
         * @author Oli Radlett <o.radlett@gmail.com>
         *
         */
//
//      Prepare and run a MySQL query to remove a vote record from the database
        $database->query("DELETE FROM `votes` WHERE (`votes`.`qID` = '$qID' AND `votes`.`uID` = '$uID')");

    }

    function getUserID(Database $database, $username) {

        /**
         *
         * Function to remove to get the user id attribute for a user
         *
         * @param Database: $database - Database object
         * @param String: $username - Username of the user who's id we want
         *
         * @return Int: The id of the user if the username exists. Null if the user does not exist
         *
         * @author Oli Radlett <o.radlett@gmail.com>
         *
         */

//      Prepare and run a MySQL query to select the id attribute from the users table where the username
//      attribute is equal to the $username parameter
        $database->query("SELECT `id` FROM `users` WHERE `username` = '$username'");
//      Create an associative array of the result of the query
        $result = $database->fetchAssoc();
//      Return the user's id
        return $result["id"];

    }

?>

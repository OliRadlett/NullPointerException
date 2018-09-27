<?php

/**
 * Page to query the database to check if a user has voted on a question or not
 *
 * @author Oli Radlett <o.radlett@gmail.com>
 *
 * Note this could become a function in the User class in the future
 *
 */


//  Include Database class
    include "database.php";

//  Create a new Database object
    $database = new Database();

//  Create and initialise variables
    $qID = $_GET["qid"];
    $username = $_GET["username"];
    $uID = getUserID($database, $username);

//  Create and run MySQL query to select the type attribute from the database where the user id and question id attributes match those stored above
    $database->query("SELECT `type` FROM `votes` WHERE `uid` = '$uID' AND `qid` = '$qID'");

    while($row = $database->fetchAssoc()) {

//      Fetch the type of vote the user has done

        if ($row["type"] == "u") {

            echo "up";

        } else if ($row["type"] = "d"){

            echo "down";

        }

    }
    // No support for logged in users that haven't voted either up or down

    function getUserID(Database $database, $username) {

        /**
         * Function to get the user id from there username
         * Possible duplicate from User class
         *
         * @param Database: $database - Database object
         * @param String: $username - Username of the user you want to get the id of
         *
         * @return int: $id, The id of the user with the username supplied as a parameter
         *
         */

//      Create and run the MySQL query to get the user id
        $database->query("SELECT `id` FROM `users` WHERE `username` = '$username'");
        $result = $database->fetchAssoc();
        return $result["id"];
    }
?>

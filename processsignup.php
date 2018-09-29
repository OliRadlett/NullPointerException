<?php

session_start();

include "database.php";
include "core.php";

// Create a new Database object
$database = new Database();

// Create a new user object
$user = new User(

    $_POST["username"],
    $_POST['password'],
    null,
    $_POST['firstname'],
    $_POST['lastname'],
    $_POST['emailaddress']

);

// These nested if statements could do with being tidied up somehow
if (!Util::isIpBlocked($_SERVER["REMOTE_ADDR"], $database)) {

	if ($user->allAttributesFilled()) {

		if (Util::emailValid($user->getEmail())) {

			if (UniqueUsername($database, $user)) {

				$user->create($database);

			} else {

				Util::Error("Error - That username is already taken", true, "signup.php");

			}

		} else {

            Util::Error("Error - Please enter a valid email", true, "signup.php");

		}

	} else {

        Util::Error("Error - Please make sure all fields have been filled", true, "signup.php");

	}

} else {

    Util::Error("You have been banned from creating accounts", false);

}

function UniqueUsername(Database $database, User $user) {

	/**
	* Queries the database to check that no user has the same email address
	* 
	* @param Database object $database - Pointer to the Database object in use
	* @param User $user - User object
	* 
	* @author Oli Radlett <o.radlett@gmail.com>
	* 
	* @return True if the User object's username attribute is not found in the database, False if not
	* 
	*/

	$username = $user->getUsername();
	$database->query("SELECT `id` FROM npe.users WHERE `username` = '$username'");
    $numRows = $database->numRows();

    if ($numRows == 0) {

    	// If no rows are returned from the database then no user has the same username as the new user
    	return true;

    } else {

    	// If any rows are returned from the database the user's username is already in use
    	return false;

    }

}

?>
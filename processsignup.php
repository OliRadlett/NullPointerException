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
	$_POST['firstname'],
	$_POST['lastname'],
	$_POST['emailaddress']

);

// These nested if statements could do with being tidyed up somehow
if (!Util::isIpBlocked($_SERVER["REMOTE_ADDR"], $database)) {

	if ($user->allAttributesFilled()) {

		if (Util::emailValid($user->getEmail())) {

			if (UniqueUsername($database, $user)) {

				$user->create($database);

			} else {

				Error("Error - That username is already taken", true, "signup.php");

			}

		} else {

			Error("Error - Please enter a valid email", true, "signup.php");

		}

	} else {

		Error("Error - Please make sure all fields have been filled", true, "signup.php");

	}

} else {

    Error("You have been banned from creating accounts", false);

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

	$database->query("SELECT `id` FROM npe.users WHERE `username` = '$user->getUsername()'");
    $numRows = $database->numRows();

    if ($numRows == 0) {

    	// If no rows are returned from the database then no user has the same username as the new user
    	return true;

    } else {

    	// If any rows are returned from the database the user's username is already in use
    	return false;

    }

}

/*function CreateAccount($connection, User $user) {

	/**
	* Creates a new user record in the database
	* 
	* @param MySQLi connection $connection - Database connection object
	* @param User $user - User object
	* 
	* @author Oli Radlett <o.radlett@gmail.com>
	* 

	// Prepares a query to insert all the User object's attributes into the database in their individual columns, skipping the auto-incrementing id column
	$query = 
	"INSERT INTO 
	`users` (`username`, `password`, `first_name`, `last_name`, `email_address`)
	VALUES
	('$user->username', '$user->generateHash()', '$user->first_name', '$user->last_name', '$user->email_address');";
    
    // Executes the MySQLi query, creating a new user record in the database
    mysqli_query($connection, $query);

    // Prepares another query to get the auto-generated user id from the database
    $query = "SELECT `id` FROM `users` WHERE `username` = '$username'";
    // Executes the above query and stores the value of retrieved user id
    $id = mysqli_query($connection, $query);

    // Stores the username and user if in session variables, thus logging the user in
    $_SESSION["username"] = $user->username;
    $_SESSION["id"] = $id;

    // Closes the session and re-directs the user to the homepage
    session_write_close();
    redirect("http://nullpointerexception.ml");

}*/

?>
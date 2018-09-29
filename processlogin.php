<?php

// Start PHP session
session_start();

// Include Database class and the core modules
include "database.php";
include "core.php";

// Create a new Database object
$database = new Database();

// Create a new User object, only supplying available parameters
$possibleUser = new User(

    $username = $_POST["username"], $password = $_POST["password"]

);

// Attempt to create a new UserObject by querying the database to find the user with the username provided
$returnedUser = GetUser($possibleUser, $database);

// If the username exists in the database
if ($returnedUser) {

//    If the password provided matches the hash returned from the database
	if ($returnedUser->verifyHash($possibleUser->password)) {

//	    Login the user in using the credentials provided
        Login($possibleUser, $database);

	} else {

//	    Show error message plus back button
	    Util::Error("Password incorrect", true, "signup.php");

    }

}

function GetUser(User $possibleUser, Database $database) {

    /**
     * Function to attempt to fetch a user from the database using a given username.
     *
     * @param User: $possibleUser
     * @param Database: $database
     *
     * @author Oli Radlett <o.radlett@gmail.com>
     *
     * @return User: $user, a User object with parameters filled from the database where the username attribute matches the one provided as a parameter.
     * @return null if the username does not appear in the database.
     *
     * @since Commit 129, 22/09/18
     *
     */

//   Runs a MySQL query to select all the attributes from the database where the username attribute matches the username provided as a parameter to the function
	$database->query("SELECT * FROM `users` WHERE `username` = '$possibleUser->username'");
//	Stores an associative array of the results returned from the database
	$result = $database->fetchAssoc();

//	If there is a result then the user exists and we can create a User object based on it's data
	if ($result) {

//	    Create a User object using the items returned from the database in the associative array
		$user = new User(
		    $result["username"],
            null,
            $result["password"],
            $result["first_name"],
            $result["last_name"],
            $result["email_address"]
        );

//		Return said User object
		return $user;

//	If there isn't a result then the user doesn't exist and we can simply return null
	} else {

		return null;

	}

}

function Login(User $user, Database $database) {

    /**
     *
     * Function to log a user in
     *
     * @param User: $user, the User object to log in
     * @param Database: $database
     *
     * @author Oli Radlett <o.radlett@gmail.com>
     *
     * @since Commit 129, 22/09/18
     *
     */

//  Set the session variables required to log the user in
	$_SESSION["username"] = $user->username;
	$_SESSION["id"] = $user->getID($database);
//	Redirect the user back to the homepage
	Util::redirect("index.php");


}
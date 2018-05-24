<?php

session_start();
include "connect.php";

// Connect to the database
$connection = connect();

// Create a new user object
$user = new User(
	
	$_POST["username"],
	$_POST['password'],
	$_POST['firstname'],
	$_POST['lastname'],
	$_POST['emailaddress']

);

if (!blocked_ip($connection, $_SESSION["IPADDR"])) {

	if (AllAttributesFilled($user)) {

		if (EmailValid($user)) {

			if (UniqueUsername($connection, $user)) {

				CreateAccount($connection, $user);

			} else {

				new Error("Error - That username is already taken", true);

			}

		} else {

			new Error("Error - Please enter a valid email", true);

		}

	} else {

		new Error("Error - Please make sure all fields have been filled", true);

	}

} else {

	new Error("You have been banned from creating accounts", false);

}


function blocked_ip($connection, $address) {

	/**
	* Queries the database to check if the client's IP Address has been banned from creating an account
	* 
	* @param MySQLi connection $connection - Database connection object
	* @param String $address - Client's IP Address
	* 
	* @author Oli Radlett <o.radlett@gmail.com>
	* 
	* @return True if the client's IP Address has been blocked, False if not
	* 
	*/

	$query = "SELECT `address` FROM `blocked_ipaddr` WHERE `address` = '$address'";
	$result = mysqli_query($connection, $query);

	if (mysqli_num_rows($result) > 0) {

		// If any results are returned from the database then the address has been blocked
		return true;	

	} else {

		// If not then the user isn't blocked
		return false;

	}

}

function AllAttributesFilled(User $user) {

	/**
	* Checks that all the User object's attributes contain values
	* 
	* @param User $user - User object
	* 
	* @author Oli Radlett <o.radlett@gmail.com>
	* 
	* @return True if all the User object's attributes are filled, False if not
	* 
	*/

	if (!empty($user->username) &&
		!empty($user->password) &&
		!empty($user->first_name) &&
		!empty($user->last_name) &&
		!empty($user->emailaddress)) {

		// If all the User object's attributes contain a value then the function can return true
		return true;

	} else {

		// If any of the User object's attributes are empty then the function returns false
		return false;

	}

}

function EmailValid(User $user) {

	/**
	* Checks if the User object's email attribute is a valid email address
	* 
	* @param User $user - User object
	* 
	* @author Oli Radlett <o.radlett@gmail.com>
	* 
	* @return True if the User object's email attribute is a valid email address, False if not
	* 
	*/

	if (filter_var($user->emailaddress, FILTER_VALIDATE_EMAIL)) {

		// If the User object's email address attribute passes this check then it is a valid email address
		return true;

	} else {

		// If not then the function returns false
		return false;

	}

}

function UniqueUsername($connection, User $user) {

	/**
	* Queries the database to check that no user has the same email address
	* 
	* @param MySQLi connection $connection - Database connection object
	* @param User $user - User object
	* 
	* @author Oli Radlett <o.radlett@gmail.com>
	* 
	* @return True if the User object's username attribute is not found in the database, False if not
	* 
	*/

	$query = "SELECT `id` FROM `users` WHERE `username` = '$user->username'";
    $result = mysqli_query($connection, $query);
    $num_rows = mysqli_num_rows($result);

    if ($num_rows == 0) {

    	// If no rows are returned from the database then no user has the same username as the new user
    	return true;

    } else {

    	// If any rows are returned from the database the user's username is already in use
    	return false;

    }

}

function CreateAccount($connection, User $user) {

	/**
	* Creates a new user record in the database
	* 
	* @param MySQLi connection $connection - Database connection object
	* @param User $user - User object
	* 
	* @author Oli Radlett <o.radlett@gmail.com>
	* 
	*/

	// Prepares a query to insert all the User object's attributes into the database in their individual columns, skipping the auto-incrementing id column
	$query = 
	"INSERT INTO 
	`users` (`username`, `password`, `first_name`, `last_name`, `email_address`)
	VALUES
	('$user->username', '$user->password_hash', '$user->first_name', '$user->last_name', '$user->email_address');";
    
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

}

function redirect($url) {

	/**
	* Safely re-directs the client to a specified URL
	* 
	* @param String $url - URL for the client to be re-directed to
	* 
	* @author Oli Radlett <o.radlett@gmail.com>
	* 
	*/

    if (!headers_sent()) {

    	// If no headers have been sent then it is safe to use the header() function to re-direct the client
    	header('Location: ' . $url);
        
        exit;

    } else {

    	// If they have, then use the echo function to run a JavaScript script to safely re-direct the client
        echo '<script type="text/javascript">';
        echo 'window.location.href="'.$url.'";';
        echo '</script>';
        echo '<noscript>';
        echo '<meta http-equiv="refresh" content="0;url='.$url.'" />';
        echo '</noscript>';

        exit;
    
    }

}

function Error($message, $back_button) {

    /**
    * Display an error message to the client, as well as an optional back button
    * 
    * @param String $message - Error message to be outputted to the client
    * @param Boolean $back_button - Boolean parameter specifying whether to display a back button
    * 
    * @author Oli Radlett <o.radlett@gmail.com>
    * 
    */

    echo $message;
    // Line break
    echo "<br/>";

    if ($back_button) {

        // If the back_button parameter is true, display a back button
        echo "<button onclick='window.location.href = `http://www.nullpointerexception.ml/signup.php`';>Back</button>";

    }

}

class User {

	/**
 	* Class to define a user, store the user's attributes and creates hash of the user's password
 	* 
 	* @author Oli Radlett <o.radlett@gmail.com>
 	* @since Commit 83 - 23/05/18
 	* 
 	*/
	
	public $username;
	public $password;
	public $password_hash;
	public $first_name;
	public $last_name;
	public $email_address;

	function __construct($username, $password, $first_name, $last_name, $email_address) {

		$this->username = $username;
		$this->password = $password;
		$this->first_name = $first_name;
		$this->last_name = $last_name;
		$this->email_address = $email_address;

		// Creates a hash of the user's password
		$this->password_hash = password_hash($this->password, PASSWORD_DEFAULT);

	}

}

?>
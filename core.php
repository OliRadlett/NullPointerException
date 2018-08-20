<?php

class User {

	/**
 	* Class to define a user, store the user's attributes and creates hash of the user's password
 	* 
 	* @author Oli Radlett <o.radlett@gmail.com>
 	* @since Commit 87 - 23/05/18
 	* 
 	*/
	
	public $username;
	public $password;
	public $password_hash;
	public $first_name;
	public $last_name;
	public $email_address;

	// Parameters set to NULL by default allows all parameters to be optional
	function __construct($username = NULL, $password = NULL, $first_name = NULL, $last_name = NULL, $email_address = NULL) {

		$this->username = $username;
		$this->password = $password;
		$this->first_name = $first_name;
		$this->last_name = $last_name;
		$this->email_address = $email_address;

		// If the password parameter is provided generate and store a hash of it
		if (isset($password)) {

			$this->password_hash = $this->generateHash();

		}

	}

	function getPassword() {

		/**
		* Getter function to get current password for an instance of the User object
		* 
		* @author Oli Radlett <o.radlett@gmail.com>
		* @since Commit 91 - 20/08/18
		* 
		* @return The current password stored in an instance of the User object
		* 
		*/

		return $this->password;

	}

	function getPasswordHash() {

		/**
		* Getter function to get current password hash for an instance of the User object
		* 
		* @author Oli Radlett <o.radlett@gmail.com>
		* @since Commit 91 - 20/08/18
		* 
		* @return The current password hash stored in an instance of the User object
		* 
		*/

		return $this->password_hash;

	}

	function getUsername() {

		/**
		* Getter function to get current username for an instance of the User object
		* 
		* @author Oli Radlett <o.radlett@gmail.com>
		* @since Commit 91 - 20/08/18
		* 
		* @return The current username stored in an instance of the User object
		* 
		*/

		return $this->username;

	}

	function getFirstName() {

		/**
		* Getter function to get current first name for an instance of the User object
		* 
		* @author Oli Radlett <o.radlett@gmail.com>
		* @since Commit 91 - 20/08/18
		* 
		* @return The current first name stored in an instance of the User object
		* 
		*/

		return $this->first_name;

	}

	function getLastName() {

		/**
		* Getter function to get current last name for an instance of the User object
		* 
		* @author Oli Radlett <o.radlett@gmail.com>
		* @since Commit 91 - 20/08/18
		* 
		* @return The current last name stored in an instance of the User object
		* 
		*/

		return $this->last_name;

	}

	function getEmail() {

		/**
		* Getter function to get current email address for an instance of the User object
		* 
		* @author Oli Radlett <o.radlett@gmail.com>
		* @since Commit 91 - 20/08/18
		* 
		* @return The current email address stored in an instance of the User object
		* 
		*/

		return $this->email_address;

	}

	function generateHash() {

		/**
		* Generates a hash of a User object's password
		* 
		* @author Oli Radlett <o.radlett@gmail.com>
		* 
		* @return A hash of the User object's password using the default hashing algorithm
		*/

		// Generates a hash of the user's password
		return password_hash($this->password, PASSWORD_DEFAULT);

	}

	function verifyHash($password) {

		/**
		* Verifies the password attribute from this User object against a supplied password parameter
		* 
		* @param String $password - A password to match against the User objects password hash
		* 
		* @author Oli Radlett <o.radlett@gmail.com>
		* 
		* @return true if the password parameter provided matches the hash stored in the password attribute of the User class, otherwise returns false
		* 
		*/

		if (password_verify($password, $this->password_hash)) {

			// If the password paramater provided matches the hash of the password stored in this instance of the User class, return true
			return true;

		} else {

			// If not return false
			return false;

		}

	}

	function getID($connection) {

		/**
		* Queries the database to return the id attribute of the user where the username attribute in the database equals the username stored in this instance of the Username class
		* 
		* @param MySQLi connection object $connection - MySQLi connection object to allow the function to query the database
		* 
		* @author Oli Radlett <o.radlett@gmail.com>
		* 
		* @return the id attribute from the database of the user with the username attibute equal to the username attribute stored in this instance of the User class 
		* 
		*/

		// Prepare a MySQLi query statement to select the id attribute from the database where the username attribute is equal to the 
		$query = "SELECT `id` FROM `users` WHERE `username` = '$this->username'";
		// Stores the result of the query localy
		$id = mysqli_query($connection, $query);

		// Return the id from the database
		return $id;

	}

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

?>
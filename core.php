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
	function __construct($username = NULL, $password = NULL, $password_hash = NULL, $first_name = NULL, $last_name = NULL, $email_address = NULL) {

		$this->username = $username;
		$this->password = $password;
		$this->first_name = $first_name;
		$this->last_name = $last_name;
		$this->email_address = $email_address;

		// If the password parameter is provided generate and store a hash of it
		if (isset($password)) {

			$this->password_hash = $this->generateHash();

		} else {

//          If the password parameter is not provided but the password_hash parameter is store it in the class
		    if (isset($password_hash)) {

		        $this->password_hash = $password_hash;

            }

        }

    }

	function getPassword() {

		/**
		* Getter function to get current password for an instance of the User object
		* 
		* @author Oli Radlett <o.radlett@gmail.com>
		* @since Commit 91 - 20/08/18
		* 
		* @return String: The current password stored in an instance of the User object
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
		* @return String: The current password hash stored in an instance of the User object
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
		* @return String: The current username stored in an instance of the User object
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
		* @return String: The current first name stored in an instance of the User object
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
		* @return String: The current last name stored in an instance of the User object
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
		* @return String: The current email address stored in an instance of the User object
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
		* @return String: A hash of the User object's password using the default hashing algorithm
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

			// If the password parameter provided matches the hash of the password stored in this instance of the User class, return true
			return true;

		} else {

			// If not return false
			return false;

		}

	}

	function getID(Database $database) {

		/**
		* Queries the database to return the id attribute of the user where the username attribute in the database equals the username stored in this instance of the Username class
		* 
		* @param Database $database
		* 
		* @author Oli Radlett <o.radlett@gmail.com>
		* 
		* @return Int: the id attribute from the database of the user with the username attribute equal to the username attribute stored in this instance of the User class
		* 
		*/

		// Prepare and runs a MySQL query to select the id attribute from the users table where the username attribute is equal to the value stored in $this->username
		$result = $database->query("SELECT `id` FROM `users` WHERE `username` = '$this->username'");

		// Return the id from the database
		return $result;

	}

	function allAttributesFilled() {

        /**
         *
         * Function to check if all the attributes of an instance of a User object pass an isset check
         *
         * @author Oli Radlett <o.radlett@gmail.com>
         *
         * @return Boolean: true if all attributes are filled, false if not
         *
         */

		if (Util::_isset($this->username, $this->password, $this->first_name, $this->last_name, $this->email_address)) {

			return true;

		} else {

			return false;

		}

	}

	function create(Database $database) {

        /**
         *
         * Function to add an instance of a User object to the database as a new user
         *
         * @param Database: $database
         *
         * @author Oli Radlett <o.radlett@gmail.com>
         *
         * @since Commit 129, 22/09/18
         *
         */

//        Generate a new hash of the password
		$this->password_hash = $this->generateHash();
//		Perform INSERT query to add the user to the database
		$database->query("INSERT INTO 
	npe.users (`username`, `password`, `first_name`, `last_name`, `email_address`)
	VALUES
	('$this->username', '$this->password_hash', '$this->first_name', '$this->last_name', '$this->email_address');");

		// Prepares another query to get the auto-generated user id from the database
	    $database->query("SELECT `id` FROM `users` WHERE `username` = '$this->getUsername'");
	    // Executes the above query and stores the value of retrieved user id
	    $id = $database->getResult();

	    // Stores the username and user if in session variables, thus logging the user in
	    $_SESSION["username"] = $this->username;
	    $_SESSION["id"] = $id;

	    // Closes the session and re-directs the user to the homepage
	    session_write_close();
	    Util::redirect("index.php");

	}
	
}

class Util {

	public static function redirect($url) {

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

	public static function isIPBlocked($address, $database) {

		/**
		* Queries the database to check if the client's IP Address has been banned from creating an account
		* 
		* @param String $address - Client's IP Address
		* @param Database object $database - Pointer to the Database object in use
		* 
		* @author Oli Radlett <o.radlett@gmail.com>
		* 
		* @return True if the client's IP Address has been blocked, False if not
		* 
		*/

		$database->query("SELECT `address` FROM npe.blocked_ipaddr WHERE `address` = '$address'");
		$numRows = $database->numRows();

		// If any results are returned from the query then the address has been blocked
		if ($numRows > 0) {

			return true;

		} else {

			return false;

		}

	}

	public static function _isset(...$vars) {

		/**
		* Function to check whether a series of values contain any data
		* 
		* @param ...$vars - An unspecified number of variables to check
		* 
		* @author Oli Radlett <o.radlett@gmail.com>
		* @since Commit 96 - 21/08/18
		* 
		*/

		// Loop through all supplied variable
		foreach ($vars as $var) {

	        if (!isset($var)) {
	        
	            return false;
	        
	        }
	    
	    }
	    
	    return true;

	}

	public static function emailValid($email) {

		/**
		* Checks if the User object's email attribute is a valid email address
		* 
		* @param String $email - Email address to validate
		* 
		* @author Oli Radlett <o.radlett@gmail.com>
		* 
		* @return True if the email parameter is a valid email address, False if not
		* 
		*/

		if (filter_var($email, FILTER_VALIDATE_EMAIL)) {

			return true;

		} else {

			return false;

		}

	}

	public static function Error($message, $backButton, $backURL = NULL) {

	    /**
	    * Display an error message to the client, as well as an optional back button
	    * 
	    * @param String $message - Error message to be outputted to the client
	    * @param Boolean $backButton - Boolean parameter specifying whether to display a back button
	    * @param String $backURL - Optional String supplying the URL for the button
	    * 
	    * @author Oli Radlett <o.radlett@gmail.com>
	    * 
	    */

	    echo $message;
	    echo "<br/>";

	    if ($backButton) {

	        // If the back_button parameter is true, display a back button
	        echo "<button onclick='window.location.href = `" . $backURL . "`';>Back</button>";

	    }

	}

}

?>
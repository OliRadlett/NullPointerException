<?php

class Database {

	/**
	* Class to interface with the database
	* 
	* @author Oli Radlett <o.radlett@gmail.com>
	* @since Commit 95 - 21/08/18
	* 
	*/

	// Initiate variables
	private $connection;
	private $query;
	private $result;

	function __construct() {

		/**
		* Class constructor - Loads config from ini file and attempts to connect to the database
		* 
		* @author Oli Radlett <o.radlett@gmail.com>
		* @since Commit 95 - 21/08/18
		* 
		* @throws Error connecting to database
		* 
		*/

		// Load database config from ini file
		$config = parse_ini_file('../private/config.ini'); 
    
    	// Read config from loaded ini file
	    $db_server = $config["server"];
	    $db_database = $config["database"];
	    $db_username = $config["username"];
	    $db_password = $config["password"];

	    // Try and make a connection to the database
	    // If connection is successful, store the connection object in $this->connection; 
	    if (!$this->connection = new mysqli($db_server, $db_username, $db_password, $db_database)) {

	    	// If connection cannot be established throw exception
	    	throw new Exception("Error connecting to database");

	    }

	}

	public function query($query) {

		/**
		* Function to execute a MySQLi query against the database
		* 
		* @param MySQLi query $query - A query to run against the database
		* 
		* @author Oli Radlett <o.radlett@gmail.com>
		* @since Commit 95 - 21/08/18
		* 
		* @return String: The raw value returned from the database. No return value if there is no result from the query or an error has occurred
		* @throws Error executing query
		* 
		*/

		// Store current query and result
		$this->query = $query;
		$this->result = $this->connection->query($query);

		if ($this->result) {

			// Only return raw value if there is a result
			return $this->result;

		} else {

			// Throws exception on error
			throw new Exception(mysqli_error($this->connection));
			

		}
	
	}

	public function getResult() {

		/**
		* Getter function to get the current query result stored for an instance of the Database class
		* 
		* @author Oli Radlett <o.radlett@gmail.com>
		* @since Commit 95 - 21/08/18
		* 
		* @return String: The current query result stored for an instance of the Database class
		* 
		*/

		return $this->result;

	}

	public function getQuery() {

		/**
		* Getter function to get the current query stored for an instance of the Database class
		* 
		* @author Oli Radlett <o.radlett@gmail.com>
		* @since Commit 95 - 21/08/18
		* 
		* @return String: The current query stored for an instance of the Database class
		* 
		*/

		return $this->query;

	}

	public function getConnection() {

		/**
		* Getter function to get the current MySQLi connection object for an instance of the Database class
		* 
		* @author Oli Radlett <o.radlett@gmail.com>
		* @since Commit 95 - 21/08/18
		* 
		* @return MySQLi connection object: The current MySQLi connection object for an instance of the Database class
		* 
		*/

		return $this->connection;

	}

	public function fetchAssoc() {

		/**
		* Function to fetch an associative array of the results from a MySQLi query
		* 
		* @author Oli Radlett <o.radlett@gmail.com>
		* @since Commit 95 - 21/08/18
		* 
		* @return String: The an associative array of the results returned from the database. No return value if nothing is stored in $this->result
		* 
		*/

		if ($this->result) {

			return mysqli_fetch_assoc($this->result);

		}

	}

	public function numRows() {

		/**
		* Function to fetch the number of results returned from a MySQLi query
		* 
		* @author Oli Radlett <o.radlett@gmail.com>
		* @since Commit 95 - 21/08/18
		* 
		* @return String: The number of results returned from a MySQLi query. No return value if nothing is stored in $this->result
		* 
		*/

		if ($this->result) {

			return mysqli_num_rows($this->result);

		}

	}

}

?>

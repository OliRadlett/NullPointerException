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

	$query = "SELECT `address` FROM `blocked_ipaddr` WHERE `address` = '$address'";
	$result = mysqli_query($connection, $query);

	if (mysqli_num_rows($result) == 1) {

		return true;	

	} else {

		return false;

	}

}

function AllAttributesFilled(User $user) {

	if (!empty($user->username) &&
		!empty($user->password) &&
		!empty($user->first_name) &&
		!empty($user->last_name) &&
		!empty($user->emailaddress)) {

		return true;

	} else {

		return false;

	}

}

function EmailValid(User $user) {

	if (filter_var($user->emailaddress, FILTER_VALIDATE_EMAIL)) {

		return true;

	} else {

		return false;

	}

}

function UniqueUsername($connection, User $user) {

	$query = "SELECT `id` FROM `users` WHERE `username` = '$user->username'";
    $result = mysqli_query($connection, $query);
    $num_rows = mysqli_num_rows($result);

    if ($num_rows != 0) {

    	return true;

    } else {

    	return false;

    }

}

function CreateAccount($connection, User $user) {

	$query = 
	"INSERT INTO 
	`users` (`username`, `password`, `first_name`, `last_name`, `email_address`)
	VALUES
	('$user->username', '$user->password_hash', '$user->first_name', '$user->last_name', '$user->email_address');";
    
    mysqli_query($connection, $query);

    $query = "SELECT `id` FROM `users` WHERE `username` = '$username'";
    $id = mysqli_query($connection, $query);

    $_SESSION["username"] = $username;
    $_SESSION["id"] = $id;

    session_write_close();
    redirect("http://nullpointerexception.ml");

}

function redirect($url) {

    if (!headers_sent()) {

    	header('Location: '.$url);
        
        exit;

    } else {

        echo '<script type="text/javascript">';
        echo 'window.location.href="'.$url.'";';
        echo '</script>';
        echo '<noscript>';
        echo '<meta http-equiv="refresh" content="0;url='.$url.'" />';
        echo '</noscript>';

        exit;
    
    }

}

class Error {

	public $message;
	public $back_button;

	function __construct($message, $back_button) {

		$this->message = $message;
		$this->back_button = $back_button;

		echo $this->message;
		echo "<br/>";

		if ($this->back_button) {

			echo "<button onclick='window.location.href = `http://www.nullpointerexception.ml/signup.php`';>Back</button>";

		}

	}

}

class User {
	
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

		$this->password_hash = password_hash($this->password, PASSWORD_DEFAULT);

	}

}

?>
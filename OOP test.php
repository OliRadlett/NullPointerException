<?php

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

$user = new User("TestUsername", "TestPassword123", "Test", "User", "test@test.com");

echo "Username: " . $user->username . PHP_EOL;
echo "Password: " . $user->password . PHP_EOL;
echo "Password hash: " . $user->password_hash . PHP_EOL;
echo "First name: " . $user->first_name . PHP_EOL;
echo "Last name: " . $user->last_name . PHP_EOL;
echo "Email address: " . $user->email_address . PHP_EOL;

?>
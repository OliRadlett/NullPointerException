<?php

session_start();
include "connect.php";
include "core.php";

// Connect to the database
$connection = connect();

// Create a new User object. only supplying available parameters
$possibleUser = new User(

	$username = $_POST["username"],
	$password = $_POST["password"]

);

$returnedUser = GetUser($possibleUser);

if ($returnedUser) {

	if ($result->verifyHash($returnedUser->password)) {



	}

}

function GetUser(User $possibleUser) {

	$query = "SELECT `id`, `password` FROM `users` WHERE `username` = '$possibleUser->username'";
	$result = mysqli_query($connection, $query);

	if ($result) {

		$user = new User($result["username"], $result["password"], $result["password_hash"], $result["first_name"], $result["last_name"], $result["email_address"]);

		return $user;

	} else {

		return NULL;

	}

}

function Login(User $user) {

	$_SESSION["username"] = $user->username;
	$_SESSION["id"] = $user->getID($connection);


}
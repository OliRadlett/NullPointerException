<?php

function connect() {

	$config = parse_ini_file('../../config.ini'); 
    
    $db_server = $config["server"];
    $db_database = $config["database"];
    $db_username = $config["username"];
    $db_password = $config["password"];

    return new mysqli($db_server, $db_username, $db_password, $db_database);

}

?>
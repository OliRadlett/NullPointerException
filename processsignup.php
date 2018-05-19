<?php session_start();
include "connect.php"; ?>
<head>
<link rel = "stylesheet" href = "stylesheets/general.css" />
</head>
<body>
<?php
$connection = connect();

$username = $_POST['username'];
$password = $_POST['password'];
$password_hash = password_hash($password, PASSWORD_DEFAULT);
$firstname = $_POST['firstname'];
$lastname = $_POST['lastname'];
$emailaddress = $_POST['emailaddress'];

$address = $_SESSION["IPADDR"]; //Not assigned got some reason

$query = "SELECT `address` FROM `blocked_ipaddr` WHERE `address` = '$address'";

$result = mysqli_query($connection, $query);
    
if ($result) {
        
    if (mysqli_num_rows($result) !== 1) {
    
        if (!empty($username) && !empty($password_hash) && !empty($firstname) && !empty($lastname) && !empty($emailaddress)) {

            if (strpos($emailaddress, "@")) {

                $paramsArray = array($username, $password_hash, $firstname, $lastname, $emailaddress);
                CreateAccount($connection, $paramsArray);

            } else {

                echo "Error - please make sure you enter a valid email address";
                echo "<br />";
                echo "<button onclick='window.location.href = `http://www.nullpointerexception.ml/signup.php`';>Back</button>";

            }

        } else {

            echo "Error - please make sure you have filled in every field";
            echo "<br />";
            echo "<button onclick='window.location.href = `http://www.nullpointerexception.ml/signup.php`';>Back</button>";

        }

    } else {

        echo "Your IP Address has been blocked from creating user accounts";

    }

}

function CreateAccount($connection, $paramsArray) {

    $username = $paramsArray[0];
    $password_hash = $paramsArray[1];
    $firstname = $paramsArray[2];
    $lastname = $paramsArray[3];
    $emailaddress = $paramsArray[4];

    $query = "SELECT `id` FROM `users` WHERE `username` = '$username'";
    $result = mysqli_query($connection, $query);
    $num_rows = mysqli_num_rows($result);

    if (!$num_rows > 0) {
                
        $query = "INSERT INTO `users` (`username`, `password`, `first_name`, `last_name`, `email_address`) VALUES ('$username', '$password_hash', '$firstname', '$lastname', '$emailaddress');";
        mysqli_query($connection, $query);

        $query = "SELECT `id` FROM `users` WHERE `username` = '$username'";
        $id = mysqli_query($connection, $query);

        $_SESSION["username"] = $username;
        $_SESSION["id"] = $id;

        session_write_close();
        redirect("http://nullpointerexception.ml");

    } else {

        echo "Error - that username is already taken";
        echo "<br />";
        echo "<button onclick='window.location.href = `http://www.nullpointerexception.ml/signup.php`';>Back</button>";

    }

}

function redirect($url)
{
    if (!headers_sent())
    {    
        header('Location: '.$url);
        exit;
        }
    else
        {  
        echo '<script type="text/javascript">';
        echo 'window.location.href="'.$url.'";';
        echo '</script>';
        echo '<noscript>';
        echo '<meta http-equiv="refresh" content="0;url='.$url.'" />';
        echo '</noscript>'; exit;
    }
}

?>
</body>
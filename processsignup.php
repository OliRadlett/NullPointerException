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

$address = $_SESSION["IPADDR"];

$query = "SELECT `address` FROM `blocked_ipaddr` WHERE `address` = '$address'";

$result = mysqli_query($connection, $query);
    
if ($result) {
        
    if (mysqli_num_rows($result) !== 1) {
    
        if (!empty($username) && !empty($password_hash) && !empty($firstname) && !empty($lastname) && !empty($emailaddress)) {

            if (strpos($emailaddress, "@")) {

                $query = "SELECT `id` FROM `users` WHERE `username` = '$username'";
                $result = mysqli_query($connection, $query);
                $num_rows = mysqli_num_rows($result);

                if (!$num_rows > 0) {
                
                    $query = "INSERT INTO `users` (`username`, `password`, `first_name`, `last_name`, `email_address`) VALUES ('$username', '$password_hash', '$firstname', '$lastname', '$emailaddress');";
                                    
                        if (!mysqli_query($connection, $query)) {
                                
                            echo mysqli_error($connection);
                                
                        }

                        $query = "SELECT `id` FROM `users` WHERE `username` = '$username'";
                        $id = mysqli_query($connection, $query);

                        $_SESSION["username"] = $username;
                        $_SESSION["id"] = $id;

                        header("Location: http://www.nullpointerexception.ml/");

                    } else {

                        echo "Error - that username is already taken";
                        echo "<br />";
                        echo "<button onclick='window.location.href = `http://www.nullpointerexception.ml/signup.php`';>Back</button>";

                    }

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

?>
</body>
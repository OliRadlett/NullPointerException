<?php session_start();
include "connect.php"; ?>
<head>
</head>
<body>
<?php $connection = connect();

$username = $_POST['username'];
$password = $_POST['password'];
    
$query = "SELECT `id`, `password` FROM `users` WHERE `username` = '$username'";
$result = mysqli_query($connection, $query);
    
while($row = mysqli_fetch_assoc($result)) {
            
    if (password_verify($password, $row['password'])) {

        $_SESSION["username"] = $username;
        $_SESSION["id"] = $row["id"];
        header("Location: http://www.nullpointerexception.ml/");
                
    } else {

        echo "Error - username/password combination does not exist";
        echo "<br />";
        echo "<button onclick='window.location.href = `http://www.nullpointerexception.ml/signup.php`';>Back</button>";

    }

}

?>
</body>
<?php session_start();
include "connect.php"; ?>
<head>
</head>
<body>
<?php $connection = connect();

if (!$connection) {

    die("Connection failed: " . mysqli_connect_error());

} else {

    $ipaddr = $_POST['ipaddr'];
    $date = date("d/m/Y");
    
    $query = "INSERT INTO `blocked_ipaddr` (`address`, `date_banned`) VALUES ('$ipaddr', '$date')";
    
    if (!mysqli_query($connection, $query)) {
        
        echo mysqli_error($connection);
        
    } else {

        echo "IP address blocked";
        echo "<br />";
        ?>
        <button onclick = "window.location.href='http://www.nullpointerexception.ml//admin.php'">Back</button>
        <?php

    }

}

?>
</body>
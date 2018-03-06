<?php
include "connect.php";
$connection = connect();
$q = $_GET["q"];
$query = "SELECT * FROM `questions` WHERE `title` LIKE '%{$q}%' OR `question` LIKE '%{$q}%'";
$result = mysqli_query($connection, $query);
while($row = mysqli_fetch_assoc($result)) {
    echo $row["title"] . "<br/>";
    echo $row["id"] . "<br/>";
    echo $row["votes"] . "<br/>";
}
mysqli_close($connection);
?>
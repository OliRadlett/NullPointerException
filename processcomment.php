<?php session_start();
include "connect.php"; ?>
<head>
<link rel = "stylesheet" href = "stylesheets/general.css" />
</head>
<body>
<?php $connection = connect();

$id = $_GET['id'];
$comment = $_POST["comment"];
$username = $_SESSION["username"];
$time = time();

$address = $_SESSION["IPADDR"];

$query = "SELECT `address` FROM `blocked_ipaddr` WHERE `address` = '$address'";

$result = mysqli_query($connection, $query);
    
if (mysqli_num_rows($result) !== 1) {
    
    if (!empty($comment)) {

        $query = "INSERT INTO `comments` (`qid`, `comment`, `votes`, `time`, `author`) VALUES ('$id', '$comment', '1', '$time', '$username')";
        mysqli_query($connection, $query);
        session_write_close();
        header("Location: /question.php?id=$id");

    } else {

        echo "Error - please make sure you have written a comment";
        echo "<br />";
        echo "<button onclick='window.location.href = `http://www.nullpointerexception.ml/ask.php?id=" . $id . "`';>Back</button>";

    }

} else {

    echo "Your IP Address has been blocked from commenting";

}

?>
</body>
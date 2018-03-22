<?php session_start();
include "connect.php";
include "questionFuncs.php"?>
<head>
<link rel = "stylesheet" href = "stylesheets/general.css" />
</head>
<body>
<?php $connection = connect();

$id = $_GET['id'];
$qid = $_GET["qid"];
$comment = $_POST["comment"];
$username = $_SESSION["username"];
$time = time();

$address = $_SESSION["IPADDR"];

$query = "SELECT `address` FROM `blocked_ipaddr` WHERE `address` = '$address'";

$result = mysqli_query($connection, $query);

if (!isUsersComment($connection, $username, $id)) {

  session_write_close();
  header("Location: /error.php?error=unauth");

}

if (mysqli_num_rows($result) !== 1) {

    if (!empty($comment)) {

        $query = "UPDATE `comments` SET `comment` = '$comment' WHERE `id` = '$id'";
        mysqli_query($connection, $query);
        session_write_close();
        header("Location: /question.php?id=$qid");

    } else {

        echo "Error - please make sure you have written a comment";
        echo "<br />";
        echo "<button onclick='window.location.href = `http://www.nullpointerexception.ml/editcomment.php?id=" . $_GET["id"] . "`';>Back</button>";

    }

} else {

    echo "Your IP Address has been blocked from commenting";

}

?>
</body>

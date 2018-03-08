<?php session_start();
include "connect.php"; ?>
<head>
<link rel = "stylesheet" href = "stylesheets/general.css" />
</head>
<body>
<?php $connection = connect();

$title = $_POST['title'];
$question = $_POST["question"];
$username = $_SESSION["username"];
$time = time();

$address = $_SESSION["IPADDR"];

$query = "SELECT `address` FROM `blocked_ipaddr` WHERE `address` = '$address'";

$result = mysqli_query($connection, $query);
    
if (mysqli_num_rows($result) !== 1) {
    
    if (!empty($title) && !empty($question)) {

        $query = "INSERT INTO `questions` (`title`, `question`, `votes`, `time`, `author`) VALUES ('$title', '$question', '1', '$time', '$username')";
        mysqli_query($connection, $query);
        session_write_close();
        header("Location: /qa.php");

    } else {

        echo "Error - please make sure you have filled in every field";
        echo "<br />";
        echo "<button onclick='window.location.href = `http://www.nullpointerexception.ml/ask.php`';>Back</button>";

    }

} else {

    echo "Your IP Address has been blocked from asking questions";

}

?>
</body>
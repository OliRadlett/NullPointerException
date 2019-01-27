<?php session_start();
$_SESSION["username"] = NULL;
session_write_close();
header("Location: index.php");
?>
</body>
<?php session_start();
include "connect.php";
$_SESSION["username"] = NULL;
session_write_close();
header("Location: http://www.nullpointerexception.ml/");
?>
</body>
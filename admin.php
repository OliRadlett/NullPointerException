<?php session_start();
include "connect.php";

if ($_SESSION["username"] == "admin") {

?>
<form name = "blockip" method = "post" action = "processipblock.php">
    <label>Block IP address</label>
    <input type = "text" name = "ipaddr" />
    <input type = "submit" value = "Block" />
</form>
<button onclick = "window.location.href='http://www.nullpointerexception.ml/'">Back</button>
<?php

} else {

    header("Location: http://www.nullpointerexception.ml/");

}
?>
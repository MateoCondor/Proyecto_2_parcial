<?php
$con = new mysqli('localhost', 'root', '', 'proyecto_db');
//$con = mysqli_connect("localhost", "root", "rootroot", "bd_p");
if (mysqli_connect_errno()) {
    echo "Connection Fail" . mysqli_connect_error();
}
?>

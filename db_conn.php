<?php
// Creating the database connection
$sname= "localhost";
$uname= "root";
$password = "mysql";
$db_name = "library";
$conn = mysqli_connect($sname, $uname, $password, $db_name);
// checking for connection failure
if (!$conn) {
    echo "Connection failed!";
}
?>
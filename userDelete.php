<?php
// Fetching id from main
if( isset($_GET["id"])){
    $id = $_GET["id"];

    session_start(); 
    include "db_conn.php";
    // Deleting the appropriate row from users table based on id
    $sql = "DELETE FROM users WHERE id = $id";
    $conn->query($sql);
}

header("location: userManage.php?message=Deleted+Successfully!");
exit;
?>
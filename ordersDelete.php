<?php
// Fetching id from main
if( isset($_GET["id"])){
    $id = $_GET["id"];

    session_start(); 
    include "db_conn.php";
    // Deleting the appropriate row from orders table based on id
    $sql = "DELETE FROM orders WHERE id = $id";
    $conn->query($sql);
}

header("location: ordersMain.php?message=Deleted+Successfully!");
exit;
?>
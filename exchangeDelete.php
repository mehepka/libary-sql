<?php
// Fetching id
if( isset($_GET["id"])){
    $id = $_GET["id"];

    session_start(); 
    // We connect to the Database
    include "db_conn.php";
    // Deleting the appropriate row from the table based on id
    $sql = "DELETE FROM exchange WHERE id = $id";
    $conn->query($sql);
}

header("location: exchangeMain.php?message=Deleted+Successfully!");
exit;
?>
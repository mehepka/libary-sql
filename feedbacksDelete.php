<?php
// Fetching id from feedbacks
if( isset($_GET["id"])){
    $id = $_GET["id"];

    session_start(); 
    // We connect to the Database
    include "db_conn.php";
    // Deleting the appropriate row from feedbacks table based on id
    $sql = "DELETE FROM feedbacks WHERE id = $id";
    $conn->query($sql);
}

header("location: feedbacksMain.php?message=Deleted+Successfully!");
exit;
?>
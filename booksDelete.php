<?php
// Fetching id
if( isset($_GET["id"])){
    $id = $_GET["id"];

    session_start(); 
    // We connect to the Database
    include "db_conn.php";
    // Deleting the appropriate row from book table based on id
    $sql = "DELETE FROM books WHERE id = $id";
    $conn->query($sql);
}

header("location: booksMain.php?message=Deleted+Successfully!");
exit;
?>
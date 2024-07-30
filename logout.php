<?php
//helps terminate the session started and return to the login page at index.php
session_start();
session_unset();
session_destroy();
header("Location: index.php");
?>
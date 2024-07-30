<?php 

session_start(); 

include "db_conn.php";

if (isset($_POST['uname']) && isset($_POST['password']) && isset($_POST['role'])) {

    function validate($data){

       $data = trim($data);

       $data = stripslashes($data);

       $data = htmlspecialchars($data);

       return $data;

    }
    $uname = validate($_POST['uname']);

    $pass = validate($_POST['password']);

    $role = validate($_POST['role']);
    // Checking if one of the variables is empty
    if (empty($uname)) {
        header("Location: index.php?error=User Name is required");
        exit();
    }
    else if(empty($pass))
    {
        header("Location: index.php?error=Password is required");
        exit();
    }
    else if(empty($role))
    {
        header("Location: index.php?error=Role is required");
        exit();
    }
    else
    {
        $sql = "SELECT * FROM users WHERE user_name ='$uname' AND password = '$pass' AND role = '$role'";
        $result = mysqli_query($conn, $sql);
        // checking if the query returns exaclty one row, if not we return to the login page at index.php
        if (mysqli_num_rows($result) === 1) {
            $row = mysqli_fetch_assoc($result);
            // We check once again if the selected row matches the credentials entered by the user
            if ($row['user_name'] === $uname && $row['password'] === $pass && $row['role'] === $role) {
                $_SESSION['user_name'] = $row['user_name'];
                $_SESSION['fname'] = $row['first_name'];
                $_SESSION['lname'] = $row['last_name'];
                $_SESSION['role'] = $row['role'];
                header("Location: home.php");
                exit();
            }
            else
            {
                header("Location: index.php?error=Incorrect Credentials");
                exit();
            }
        }
        else
        {
            header("Location: index.php?error=Incorrect Credentials");
            exit();
        }
    }
}
else
{
    header("Location: index.php");
    exit();
}
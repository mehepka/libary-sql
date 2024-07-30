<?php
session_start(); 
include "db_conn.php";
// Variables used to insert into users table:
$user_name = "";
$password = "";
$first_name = "";
$last_name = "";
$messageIfEmpty = "";
// Assigning each variable a value from user's input
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    $user_name = $_POST['user_name'];
    $password = $_POST['password'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    //Checking if one or more variables are empty
    do{ 
        if ( empty($user_name) || empty($password) || empty($first_name) || empty($last_name)){
            $messageIfEmpty = "All fields are required";
            break;
        }

        // Insert new user
        $sql = "INSERT INTO users(user_name, password, first_name, last_name)" .
                "VALUES ('$user_name', '$password', '$first_name', '$last_name')";
        $result = $conn->query($sql);
        // Checking for errors
        if(!$result){
            $messageIfEmpty = "Invalid Query : " . $conn->error;
            break;
        }
        // Initializing the values once again
        $user_name = "";
        $password = "";
        $first_name = "";
        $last_name = "";

        header("location: index.php");
        exit;

    } while (false);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-image: url('book.png');
            background-repeat: no-repeat;
            background-attachment: fixed;
            background-size: cover;
        }
        .container {
            padding: 30px;
            border-radius: 20px;
            box-shadow: 0 0 5px 0 rgba(0, 0, 0, 0.2);
            background-color: #f8f9fa; 
        }
        input[type="text"],
        input[type="password"],
        select[name="role"] {
            width: 100%;
            padding: 10px;
            margin: 8px 0;
            box-sizing: border-box;
        }
        .error {
            background: #dc3545;
            color: #0c0101;
            padding: 10px;
            border-radius: 5px;
            margin: 10px 0;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-uppercase text-center text-primary">Register new account</h1>

        <?php if (!empty($messageIfEmpty)) { ?>
            <div class="error">
                <?php echo $messageIfEmpty; ?>
            </div>
        <?php } ?>

        <form method="post">
            <!-- Input fields for user information -->
            <div class="mb-3">
                <label for="user_name" class="form-label"><strong>Username</strong></label>
                <input type="text" id="user_name" name="user_name" placeholder="Username" value="<?php echo $user_name; ?>" required>
            </div>

            <div class="mb-3">
                <label for="password" class="form-label"><strong>Password</strong></label>
                <input type="password" id="password" name="password" placeholder="Password" value="<?php echo $password; ?>" required>
            </div>

            <div class="mb-3">
                <label for="first_name" class="form-label"><strong>First Name</strong></label>
                <input type="text" id="first_name" name="first_name" placeholder="First Name" value="<?php echo $first_name; ?>" required>
            </div>

            <div class="mb-3">
                <label for="last_name" class="form-label"><strong>Last Name</strong></label>
                <input type="text" id="last_name" name="last_name" placeholder="Last Name" value="<?php echo $last_name; ?>" required>
            </div>

            <div class="mb-3 d-flex justify-content-center flex-column text-center">
                <button type="submit" class="btn btn-primary btn-block mb-2" style="width: 150px; margin: 0 auto;">
                    <i class="fas fa-check-square"></i> Submit
                </button>
                <p>
                    Already have an account?
                    <a href="login.php">Login</a>
                </p>
            </div>
        </form>
    </div>
</body>
</html>
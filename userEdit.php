<?php
session_start(); 
include "db_conn.php";
// Variables used to edit user table:
$id = "";
$user_name = "";
$first_name = "";
$last_name = "";
$role = "";
$messageIfEmpty = "";

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (!isset($_GET["id"])) {
        header("location: userManage.php");
        exit;
    }
    $id = $_GET["id"];
    // Checking if the row with the assigned id exists
    $sql = "SELECT * FROM users WHERE id=$id";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    if (!$row) {
        header("location: userManage.php");
        exit;
    }
    $user_name = $row['user_name'];
    $first_name = $row['first_name'];
    $last_name = $row['last_name'];
    $role = $row['role'];
} else {
    // Assigning each variable a value from the user's input
    $id = $_POST['id'];
    $user_name = $_POST['user_name'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $role = $_POST['role'];
    // Checking if one or more variables are empty
    do {
        if (empty($id) || empty($user_name) || empty($first_name) || empty($last_name) || empty($role)) {
            $messageIfEmpty = "All fields are required";
            break;
        }
        // Update the selected user
        $sql = "UPDATE users " .
            "SET user_name = '$user_name', first_name = '$first_name', last_name = '$last_name', role = '$role'" .
            "WHERE id = $id";
        $result = $conn->query($sql);

        if (!$result) {
            $messageIfEmpty = "Invalid Query:" . $conn->error;
            break;
        }

        header("location: userManage.php");
        exit;
    } while (false);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
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
        select[name="role"] {
            width: 100%;
            padding: 10px;
            margin: 8px 0;
            box-sizing: border-box;
        }
        .error {
            background: #FFFDD0;
            color: #0c0101;
            padding: 10px;
            border-radius: 5px;
            margin: 10px 0;
        }
    </style>
</head>
<body>
<div class="container mt-5">
    <h1 class="text-uppercase text-center text-primary">Edit User</h1>
    <form method="post">
        <?php
        if (!empty($messageIfEmpty)) {
            echo "
            <div class='error'>
                <strong>$messageIfEmpty</strong>
            </div>
            ";
        }
        ?>
        <!-- Input fields for user information edit-->
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        <div class="mb-3">
            <label for="user_name" class="form-label"><strong>Username</strong></label>
            <input type="text" id="user_name" name="user_name" class="form-control" value="<?php echo $user_name; ?>">
        </div>
        <div class="mb-3">
            <label for="first_name" class="form-label"><strong>First Name</strong></label>
            <input type="text" id="first_name" name="first_name" class="form-control" value="<?php echo $first_name; ?>">
        </div>
        <div class="mb-3">
            <label for="last_name" class="form-label"><strong>Last Name</strong></label>
            <input type="text" id="last_name" name="last_name" class="form-control" value="<?php echo $last_name; ?>">
        </div>
        <div class="mb-3">
            <label for="role" class="form-label"><strong>Role</strong></label>
            <select name="role" id="role" class="form-select">
                <option value="student" <?php if ($role === 'student') echo 'selected'; ?>>Student</option>
                <option value="staff" <?php if ($role === 'staff') echo 'selected'; ?>>Staff</option>
                <option value="admin" <?php if ($role === 'admin') echo 'selected'; ?>>Admin</option>
            </select>
        </div>
        <div class="mb-3 d-flex justify-content-center flex-column text-center">
            <button type="submit" class="btn btn-primary btn-block mb-2" style="width: 150px; margin: 0 auto;">
                <i class="fas fa-check-square"></i> Submit
            </button>
            <a class="btn btn-danger btn-block" href="userManage.php" style="width: 150px; margin: 0 auto;">
                <i class="fas fa-ban"></i> Cancel
            </a>
        </div>
    </form>
</div>
</body>
</html>
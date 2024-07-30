<?php
session_start();
// Check if the user is authorized to access this page and if the necessary session variables are set
if (isset($_SESSION['user_name']) && isset($_SESSION['fname']) && isset($_SESSION['lname'])) {
    include "db_conn.php";
    // Variables used to insert into exchange table:
    $name = "";
    $phone = "";
    $email = "";
    $bookToGive = "";
    $ISBN1 = "";
    $bookToTake = "";
    $ISBN2 = "";
    $messageIfEmpty = "";

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $name = $_POST['name'];
        $phone = $_POST['phone'];
        $email = $_POST['email'];
        $bookToGive = $_POST['bookToGive'];
        $ISBN1 = $_POST['ISBN1'];
        $bookToTake = $_POST['bookToTake'];
        $ISBN2 = $_POST['ISBN2'];

        // Checking if one or more variables are empty
        do {
            if (empty($name) || empty($phone) || empty($email) || empty($bookToGive) || empty($ISBN1) || empty($bookToTake) || empty($ISBN2)) {
                $messageIfEmpty = "All fields are required";
                break;
            }

            // Insert new exchange request
            $sql = "INSERT INTO exchange (name, phone, email, bookToGive, ISBN1, bookToTake, ISBN2) " .
                "VALUES ('$name', '$phone', '$email', '$bookToGive', '$ISBN1', '$bookToTake', '$ISBN2')";
            $result = $conn->query($sql);

            if (!$result) {
                $messageIfEmpty = "Invalid Query: " . $conn->error;
                break;
            }

            // Reset the input fields
            $name = "";
            $phone = "";
            $email = "";
            $bookToGive = "";
            $ISBN1 = "";
            $bookToTake = "";
            $ISBN2 = "";

            header("Location: home.php?message=Request+Sent!");
            exit;

        } while (false);
    }
?>

<!DOCTYPE html>
<!--     The following lines are HTML codes for making the Exchange create page layout more sophisticated and appealing  -->
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.bundle.min.js"></script>
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
        input[type="text"] {
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
        .logo {
            position: absolute;
            top: 40px;
            left: 40px; 
            width: 100px; 
            height: auto;
        }
    </style>
</head>
<body>
<img src="covers/logo.png" alt="Your Logo" class="logo">
    <div class="container mt-5">
        <h1 class="text-uppercase text-center text-primary">Add New Request</h1>

        <?php
        if (!empty($messageIfEmpty)) {
            echo "
            <div class='error'>
                $messageIfEmpty
            </div>
            ";
        }
        ?>
        <!-- Adding a scroll bar for affordance -->
        <div style="max-height: 80vh; overflow-y: auto; padding-right: 15px;">
        <form method="post">
            <div class="mb-3">
                <label for="name" class="form-label"><strong>Your Name</strong></label>
                <input type="text" id="name" name="name" placeholder="Your Name" value="<?php echo $name; ?>" required>
            </div>

            <div class="mb-3">
                <label for="phone" class="form-label"><strong>Your Contact Number</strong></label>
                <input type="text" id="phone" name="phone" placeholder="Contact Number" value="<?php echo $phone; ?>" required>
            </div>

            <div class="mb-3">
                <label for="email" class="form-label"><strong>Your Email Address</strong></label>
                <input type="text" id="email" name="email" placeholder="Email Address" value="<?php echo $email; ?>" required>
            </div>

            <div class="mb-3">
                <label for="bookToGive" class="form-label"><strong>Name of the Book You Want to Give in Exchange</strong></label>
                <input type="text" id="bookToGive" name="bookToGive" placeholder="Book to Give" value="<?php echo $bookToGive; ?>" required>
            </div>

            <div class="mb-3">
                <label for="ISBN1" class="form-label"><strong>ISBN of the Book You Want to Give in Exchange</strong></label>
                <input type="text" id="ISBN1" name="ISBN1" placeholder="ISBN1" value="<?php echo $ISBN1; ?>" required>
            </div>

            <div class="mb-3">
                <label for="bookToTake" class="form-label"><strong>Name of the Book You Want to Take in Exchange</strong></label>
                <input type="text" id="bookToTake" name="bookToTake" placeholder="Book to Take" value="<?php echo $bookToTake; ?>" required>
            </div>

            <div class="mb-3">
                <label for="ISBN2" class="form-label"><strong>ISBN of the Book You Want to Take in Exchange</strong></label>
                <input type="text" id="ISBN2" name="ISBN2" placeholder="ISBN2" value="<?php echo $ISBN2; ?>" required>
            </div>

            <div class="mb-3 d-flex justify-content-center flex-column text-center">
                <button type="submit" class="btn btn-primary btn-block mb-2" style="width: 150px; margin: 0 auto;">
                    <i class="fas fa-check-square"></i> Submit
                </button>
                <a class="btn btn-danger btn-block" href="home.php" style="width: 150px; margin: 0 auto;">
                    <i class="fas fa-ban"></i> Cancel
                </a>
            </div>
        </form>
        </div>
    </div>
</body>
</html>
<?php
} else {
    header("Location: home.php");
    exit();
}
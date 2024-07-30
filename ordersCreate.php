<?php
session_start();
if (isset($_SESSION['user_name']) && isset($_SESSION['fname']) && isset($_SESSION['lname'])) {

    include "db_conn.php";
    // Variables used to insert into orders table:
    $name = "";
    $phone = "";
    $email = "";
    $book = "";
    $ISBN = "";
    $messageIfEmpty = "";

    // Assigning each variable a value from user's input
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $name = $_POST['name'];
        $phone = $_POST['phone'];
        $email = $_POST['email'];
        $book = $_POST['book'];
        $ISBN = $_POST['ISBN'];

        // Checking if one or more variables are empty
        do {
            if (empty($name) || empty($phone) || empty($email) || empty($book) || empty($ISBN)) {
                $messageIfEmpty = "All fields are required";
                break;
            }

            // Insert new order
            $sql = "INSERT INTO orders (name, phone, email, book, ISBN)" .
                "VALUES ('$name', '$phone', '$email', '$book', '$ISBN')";
            $result = $conn->query($sql);
            // Checking for errors
            if (!$result) {
                $messageIfEmpty = "Invalid Query : " . $conn->error;
                break;
            }
            // Initializing the values once again
            $name = "";
            $phone = "";
            $email = "";
            $book = "";
            $ISBN = "";

            header("Location: home.php?message=Request+Sent!");
            exit;

        } while (false);
    }
    ?>

    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css"
              integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css"
              integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w=="
              crossorigin="anonymous" referrerpolicy="no-referrer"/>
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
        <h1 class="text-uppercase text-center text-primary">Add Orders Request</h1>

        <?php
        if (!empty($messageIfEmpty)) {
            echo "
        <div class='error'>
            $messageIfEmpty
        </div>
        ";
        }
        ?>
        <div style="max-height: 80vh; overflow-y: auto; padding-right: 15px;">
        <form method="post">
            <!-- Input fields for user information -->
            <div class="mb-3">
                <label for="name" class="form-label"><strong>Your Name</strong></label>
                <input type="text" id="name" name="name" placeholder="Your Name" value="<?php echo $name; ?>" required>
            </div>

            <div class="mb-3">
                <label for="phone" class="form-label"><strong>Your Contact Number</strong></label>
                <input type="text" id="phone" name="phone" placeholder="Your Contact Number" value="<?php echo $phone; ?>" required>
            </div>

            <div class="mb-3">
                <label for="email" class="form-label"><strong>Your Email Address</strong></label>
                <input type="text" id="email" name="email" placeholder="Your Email Address" value="<?php echo $email; ?>"
                       required>
            </div>

            <div class="mb-3">
                <label for="book" class="form-label"><strong>Name of the Book you want to order</strong></label>
                <input type="text" id="book" name="book" placeholder="Book Name" value="<?php echo $book; ?>" required>
            </div>

            <div class="mb-3">
                <label for="ISBN" class="form-label"><strong>ISBN of the Book you want to order</strong></label>
                <input type="text" id="ISBN" name="ISBN" placeholder="ISBN" value="<?php echo $ISBN; ?>" required>
            </div>

            <div class="mb-3 d-flex justify-content-center flex-column text-center">
                <button type="submit" class="btn btn-primary btn-block mb-2"
                        style="width: 150px; margin: 0 auto;">
                    <i class="fas fa-check-square"></i> Submit
                </button>
                <a class="btn btn-danger btn-block" href="home.php"
                   style="width: 150px; margin: 0 auto;">
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
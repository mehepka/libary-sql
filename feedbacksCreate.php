<?php
session_start();
// Check if the user is authorized to access this page and if the necessary session variables are set
if (isset($_SESSION['user_name']) && isset($_SESSION['fname']) && isset($_SESSION['lname'])) {
    include "db_conn.php";
    // Variables used to insert into exchange table:
    $serviceType = "";
    $feedback = "";
    $messageIfEmpty = "";

    // Check if the form has been submitted via POST
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $serviceType = $_POST['serviceType'];
        $feedback = $_POST['feedback'];

        // Check if any of the input fields are empty
        if (empty($serviceType) || empty($feedback)) {
            $messageIfEmpty = "All fields are required";
        } else {
            // Insert new feedback into the 'feedbacks' table
            $sql = "INSERT INTO feedbacks (serviceType, feedback) VALUES ('$serviceType', '$feedback')";
            $result = $conn->query($sql);
            // Check for database query errors
            if (!$result) {
                $messageIfEmpty = "Invalid Query: " . $conn->error;
            } else {
                $serviceType = "";
                $feedback = "";
                // Redirect to the main feedbacks page with a success message
                header("Location: feedbacksMain.php?message=Feedback+Sent!");
                exit;
            }
        }
    }
    ?>

    <!DOCTYPE html>
    <!--     The following lines are HTML codes for making the Feedbacks create page layout more sophisticated and appealing  -->

    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Add Feedback</title>
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
            select[name="serviceType"] {
                width: 100%;
                padding: 12px 20px;
                margin: 8px 0;
                box-sizing: border-box;
            }
            input[type="text"] {
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
            .logo {
                position: absolute;
                top: 40px; 
                left: 60px; 
                width: 100px; 
                height: auto; 
            }
        </style>
    </head>

    <body>
    <img src="covers/logo.png" alt="Your Logo" class="logo">
        <div class="container mt-5">
            <h1 class="text-uppercase text-center text-primary">Add Feedback</h1>
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
                <div class="mb-3">
                    <label for="serviceType" class="form-label"><strong>Service</strong></label>
                    <select name="serviceType" id="serviceType" class="form-select">
                        <option value="Order">Order</option>
                        <option value="Exchange">Exchange</option>
                        <option value="Book Recommendation">Book Recommendation</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="feedback" class="form-label"><strong>Feedback</strong></label>
                    <input type="text" id="feedback" name="feedback" class="form-control" value="<?php echo $feedback; ?>">
                </div>
                <div class="mb-3 d-flex justify-content-center flex-column text-center">
                    <button type="submit" class="btn btn-primary btn-block mb-2" style="width: 150px; margin: 0 auto;">
                        <i class="fas fa-check-square"></i> Submit
                    </button>
                    <a class="btn btn-danger btn-block" href="feedbacksMain.php" style="width: 150px; margin: 0 auto;">
                        <i class="fas fa-ban"></i> Cancel
                    </a>
                </div>
            </form>
        </div>
    </body>
    </html>

    <?php
} else {
    header("Location: home.php");
    exit();
}
?>
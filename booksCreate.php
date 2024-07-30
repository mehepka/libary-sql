<?php
// Start a session to manage user authentication
session_start();
// Check if the user is authorized to access this page and if the necessary session variables are set
if (($_SESSION['role'] === 'admin' || $_SESSION['role'] === 'staff') && isset($_SESSION['user_name']) && isset($_SESSION['fname']) && isset($_SESSION['lname']) && isset($_SESSION['role'])) {

    // Include the database connection file
    include "db_conn.php";
    // Variables used to insert into table:
    $bookName = "";
    $ISBN = "";
    $author = "";
    $category = "";
    $cover = "";
    $messageIfEmpty = "";
    // Assigning each variable a value from the user's input
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $bookName = $_POST['bookName'];
        $ISBN = $_POST['ISBN'];
        $author = $_POST['author'];
        $category = $_POST['category'];
        $cover = $_POST['cover'];
        // Checking if one or more variables are empty
        do {
            if (empty($bookName) || empty($ISBN) || empty($author) || empty($category) || empty($cover)) {
                $messageIfEmpty = "All fields are required";
                break;
            }

            // Insert new book
            $sql = "INSERT INTO books(bookName, ISBN, author, category, cover)" .
                "VALUES ('$bookName', '$ISBN', '$author', '$category', '$cover')";
            $result = $conn->query($sql);
            // Checking for errors
            if (!$result) {
                $messageIfEmpty = "Invalid Query: " . $conn->error;
                break;
            }
            // Initializing the values once again
            $bookName = "";
            $ISBN = "";
            $author = "";
            $category = "";
            $cover = "";

            header("location: booksMain.php");
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
<!-- Designing our page layout -->
<img src="covers/logo.png" alt="Your Logo" class="logo">
    <div class="container mt-5">
        <h1 class="text-uppercase text-center text-primary">Add New Book</h1>

        <?php if (!empty($messageIfEmpty)) { ?>
            <div class="error">
                <?php echo $messageIfEmpty; ?>
            </div>
        <?php } ?>
        <div style="max-height: 80vh; overflow-y: auto; padding-right: 15px;">
        <form method="post">
            <div class="mb-3">
                <label for="bookName" class="form-label"><strong>Book Name</strong></label>
                <input type="text" id="bookName" name="bookName" placeholder="Book Name" value="<?php echo $bookName; ?>" required>
            </div>

            <div class="mb-3">
                <label for="ISBN" class="form-label"><strong>ISBN</strong></label>
                <input type="text" id="ISBN" name="ISBN" placeholder="ISBN" value="<?php echo $ISBN; ?>" required>
            </div>

            <div class="mb-3">
                <label for="author" class="form-label"><strong>Author(s)</strong></label>
                <input type="text" id="author" name="author" placeholder="Author(s)" value="<?php echo $author; ?>" required>
            </div>

            <div class="mb-3">
                <label for="category" class="form-label"><strong>Category</strong></label>
                <input type="text" id="category" name="category" placeholder="Category" value="<?php echo $category; ?>" required>
            </div>

            <div class="mb-3">
                <label for="cover" class="form-label"><strong>Cover</strong></label>
                <input type="text" id="cover" name="cover" placeholder="Cover" value="<?php echo $cover; ?>" required>
            </div>

            <div class="mb-3 d-flex justify-content-center flex-column text-center">
                <button type="submit" class="btn btn-primary btn-block mb-2" style="width: 150px; margin: 0 auto;">
                    <i class="fas fa-check-square"></i> Submit
                </button>
                <a class="btn btn-danger btn-block" href="booksMain.php" style="width: 150px; margin: 0 auto;">
                    <i class="fas fa-ban"></i> Cancel
                </a>
            </div>
        </form>
    </div>
</body>
</html>
<?php 
}
else {
    header("Location: booksMain.php");
    exit();
}
?>
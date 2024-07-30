
<?php
// This is the books page where all the books are displayed for the students to see which are available
session_start();
// Check if the user is authorized to access this page and if the necessary session variables are set
if (isset($_SESSION['user_name']) && isset($_SESSION['fname']) && isset($_SESSION['lname'])) {
?>
<?php
if (isset($_POST['submit'])) {
    $search = $_POST['search'];

    // We connect to the Database
    include "db_conn.php";

    // Read data from the table books and filter based on user input
    $sql = "SELECT * FROM books WHERE
        bookName LIKE '%$search%' OR
        ISBN LIKE '%$search%' OR
        author LIKE '%$search%' OR
        category LIKE '%$search%'";
    $result = $conn->query($sql);

    // Checking for errors
    if (!$result) {
        die("Invalid Query:" . $conn->error);
    }
} else {
    // If no search is performed, display all books
    include "db_conn.php";
    $sql = "SELECT * FROM books";
    $result = $conn->query($sql);
}
?>
<!DOCTYPE html>
<!-- The following lines are HTML codes for making the book page layout more sophisticated and appealing -->
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Library Catalog</title>
    <style>
        html, body {
            height: 100%;
            background-image: url('book.png');
            background-repeat: no-repeat;
            background-attachment: fixed;
            background-size: 100%;
        }
        .container {
            min-height: 100%;
        }
        .book-card {
            background: rgba(255, 255, 255, 0.9);
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
            text-align: center;
            height: 650px;
        }
        .book-cover-container {
            max-width: 200px;
            max-height: 300px;
            margin: 0 auto;
            overflow: hidden;
        }
        .book-cover {
            width: 100%;
            height: 100%;
            object-fit: contain;
        }
        .book-title {
            font-weight: bold;
            font-size: 20px;
        }
        .book-info {
            font-size: 16px;
        }
        .table-hover tbody tr:hover td, .table-hover tbody tr:hover th {
            background-color: #222222;
            color: #ffffff;
        }
        .logo {
            position: absolute;
            top: 40px; 
            left: 60px; 
            width: 100px;
            height: auto; 
        }
        .popup {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            background: #007bff;
            color: #fff;
            padding: 10px;
            text-align: center;
            z-index: 9999;
        }


    </style>
</head>
<body>
<img src="covers/logo.png" alt="Your Logo" class="logo">
<div class="container">
    <br><br>
    <h1 class="text-center text-uppercase font-weight-bold text-white">Library Catalog</h1><br><br>
    <div class="row">
    <div class="col-md-6">
        <a class="btn bg-success px-4" href="home.php" role="button"><i class="fa-solid fa-house"></i> Back to Home Page</a>
        <?php
        /* Checking for special permission to add new book */
        if ($_SESSION['role'] === 'admin' || $_SESSION['role'] === 'staff') {
            echo '<a class="btn bg-primary px-4" href="booksCreate.php" role="button"><i class="fa-solid fa-plus"></i> Add New Book To The Catalog</a>';
        }
        ?>
    </div>
    <div class="col-md-6 text-right">
        <form method="POST" action="booksMain.php">
            <div class="input-group">
                <input type="text" name="search" class="form-control" placeholder="Search by Book name, ISBN, author, or category">
                <div class="input-group-append">
                    <button type="submit" class="btn btn-primary" name="submit"><i class="fa-solid fa-search"></i> Search</button>
                </div>
            </div>
        </form>
    </div>
</div>
<br>
    <div class="row">
        <?php
        /* Showcasing all the books with their covers based on the result from the search */
        if (isset($result) && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo '<div class="col-md-3">';
                echo '<div class="book-card">';
                echo '<div class="book-cover-container">';
                if (isset($row['cover']) && !empty($row['cover'])) {
                    echo "<img class='book-cover' src='covers/{$row['cover']}' alt='Book Cover'>";
                }
                echo '</div>';
                echo "<h3 class='book-title'>{$row['bookName']}</h3>";
                echo "<p class='book-info'><strong>ISBN:</strong> {$row['ISBN']}</p>";
                echo "<p class='book-info'><strong>Author(s):</strong> {$row['author']}</p>";
                echo "<p class='book-info'><strong>Category:</strong> {$row['category']}</p>";
                echo "<p class='book-info'><strong>Created at:</strong> {$row['created_at']}</p>";
                if ($_SESSION['role'] === 'admin' || $_SESSION['role'] === 'staff') {
                    echo "<a class='btn btn-primary' href='booksEdit.php?id={$row['id']}'><i class='fa-solid fa-pen-to-square'></i> Edit</a>";
                    echo "<a class='btn btn-danger' href='booksDelete.php?id={$row['id']}'><i class='fa-solid fa-trash'></i> Delete</a>";
                }
                echo '</div>';
                echo '</div>';
            }
        } else {
            echo '<div class="col-md-12">';
            echo '<p>No matching results found.</p>';
            echo '</div>';
        }
        ?>
    </div>
</div>
<!-- JavaScript for displaying pop-up message -->
<script>
window.addEventListener('load', function() {
    const urlParams = new URLSearchParams(window.location.search);
    const message = urlParams.get('message');
    
    // If a message is present, show a pop-up for 5 seconds
    if (message) {
        const popup = document.createElement('div');
        popup.className = 'popup';
        popup.textContent = message;
        document.body.appendChild(popup);

        setTimeout(function() {
            popup.style.display = 'none';
        }, 5000); 
    }
});
</script>
</body>
</html>
<?php 
}
else {
    header("Location: index.php");
    exit();
}
?>
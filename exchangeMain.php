<?php
// This is the exchange page where all the books exchange requests are displayed
session_start();
// Check if the user is authorized to access this page and if the necessary session variables are set
if (($_SESSION['role'] === 'admin' || $_SESSION['role'] === 'staff') && isset($_SESSION['user_name']) && isset($_SESSION['fname']) && isset($_SESSION['lname']) && isset($_SESSION['role'])) {
?>
<?php
if (isset($_POST['submit'])) {
    $search = $_POST['search'];

    // We connect to the Database
    include "db_conn.php";

    // Read data from the table exchange and filter based on user input
    $sql = "SELECT * FROM exchange WHERE
        name LIKE '%$search%' OR
        phone LIKE '%$search%' OR
        email LIKE '%$search%' OR
        bookToGive LIKE '%$search%' OR
        ISBN1 LIKE '%$search%' OR
        bookToTake LIKE '%$search%' OR
        ISBN2 LIKE '%$search%'";
    $result = $conn->query($sql);

    // Checking for errors
    if (!$result) {
        die("Invalid Query:" . $conn->error);
    }
} else {
    // If no search is performed, display all requests
    include "db_conn.php";
    $sql = "SELECT * FROM exchange";
    $result = $conn->query($sql);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Requests List</title>
    <style>
        html, body {
            height: 100%;
            background-image: url('book.png');
            background-repeat: no-repeat;
            background-attachment: fixed;
            background-size: 100%;
        }
        .container-fluid {
            min-height: 100%;
        }
        .table-hover tbody tr:hover td, .table-hover tbody tr:hover th {
            background-color: #222222;
            color: #ffffff;
        }
        .table {
            background-color: #fff;
        }
        .table th {
            background-color: #222222;
            color: #fff;
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
<div class="container-fluid">
    <br><br>
    <h1 class="text-center text-uppercase font-weight-bold text-white">List of Requests</h1><br>
    <div class="row">
        <div class="col-md-6">
            <a class="btn bg-success px-4" href="home.php" role="button"><i class="fa-solid fa-house"></i> Back to Home Page</a>
        </div>
        <div class="col-md-6">
            <form method="POST" action="exchangeMain.php">
                <div class="input-group">
                    <input type="text" name="search" class="form-control" placeholder="Search by Name, Phone, Email, Book or ISBN">
                    <div class="input-group-append">
                        <button type="submit" class="btn btn-primary" name="submit"><i class="fa-solid fa-search"></i></button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <table class="table mt-4 table-bordered table-hover table-striped">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Contact</th>
                        <th>Email</th>
                        <th>Student's book</th>
                        <th>ISBN </th>
                        <th>Book requested</th>
                        <th>ISBN </th>
                        <th>Created at</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Display the filtered results or all results
                    if (isset($result) && $result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>$row[name]</td>";
                            echo "<td>$row[phone]</td>";
                            echo "<td>$row[email]</td>";
                            echo "<td>$row[bookToGive]</td>";
                            echo "<td>$row[ISBN1]</td>";
                            echo "<td>$row[bookToTake]</td>";
                            echo "<td>$row[ISBN2]</td>";
                            echo "<td>$row[created_at]</td>";
                            echo "<td>";
                            echo "<a class='btn btn-danger btn-sm' href='exchangeDelete.php?id=$row[id]'><i class='fa-solid fa-trash'></i> Delete</a>";
                            echo "</td>";
                            echo "</tr>";
                            
                        }
                    } else {
                        echo '<tr><td colspan="9">No matching results found.</td></tr>';
                    }
                    ?>
                </tbody>
            </table>
        </div>
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

<?php
session_start();
if (isset($_SESSION['user_name']) && isset($_SESSION['fname']) && isset($_SESSION['lname'])) {
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js"></script>
    <title>Library Book Exchange Project</title>
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

        .d-grid a {
            width: 250px;
        }

        .btn-spacing {
            margin-bottom: 10px; 
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
<div class="container-fluid text-center">
    <br><br>
    <h1 style="color: white" class="px-5 text-uppercase text-center">Welcome back, <?php echo $_SESSION['fname'] . ' ' . $_SESSION['lname']; ?> !</h1>
    <br><br>

    <div class="row">
        <?php
        // Check the user's role for visibility and access options
        if ($_SESSION['role'] === 'admin') {
            echo '<div class="col-sm-12 d-grid btn-spacing mb-2">';
            echo '<a style="color: white" class="btn bg-primary px-4" href="userManage.php" role="button"><i class="fa-solid fa-people-roof"></i><strong> Manage users </strong></a>';
            echo '</div>';
        }
        ?>
    </div><br>

    <div class="row">
        <?php
        if (($_SESSION['role'] === 'admin') || ($_SESSION['role'] === 'staff')) {
            echo '<div class="col-sm-12 d-grid btn-spacing mb-2">';
            echo '<a style="color: white" class="btn bg-primary px-4" href="ordersMain.php" role="button"><i class="fa-solid fa-cart-shopping"></i><strong> Placed Orders List </strong></a>';
            echo '</div>';
        }
        ?>
    </div><br>

    <div class="row">
        <?php
        if (($_SESSION['role'] === 'admin') || ($_SESSION['role'] === 'staff')) {
            echo '<div class="col-sm-12 d-grid btn-spacing mb-2">';
            echo '<a style="color: white" class="btn bg-primary px-4" href="exchangeMain.php" role="button"><i class="fa-solid fa-arrow-right-arrow-left"></i><strong> Exchange Request list </strong></a>';
            echo '</div>';
        }
        ?>
    </div>

    <div class="row">
        <?php
        if ($_SESSION['role'] === 'student') {
            echo '<div class="col-sm-12 d-grid btn-spacing mb-2">';
            echo '<a style="color: white" class="btn bg-primary px-4" href="exchangeCreate.php" role="button"><i class="fa-solid fa-arrow-right-arrow-left"></i><strong> Request Exchange </strong></a>';
            echo '</div>';
        }
        ?>
    </div><br>

    <div class="row">
        <?php
        if ($_SESSION['role'] === 'student') {
            echo '<div class="col-sm-12 d-grid btn-spacing mb-2">';
            echo '<a style="color: white" class="btn bg-primary px-4" href="ordersCreate.php" role="button"><i class="fa-solid fa-cart-shopping"></i><strong> Request Order </strong></a>';
            echo '</div>';
        }
        ?>
    </div><br>

    <div class="row">
        <div class="col-sm-12 d-grid btn-spacing mb-2">
            <a style="color: white" class="btn bg-primary px-4" href="feedbacksMain.php" role="button"><i class="fa-regular fa-comment"></i><strong> Feedbacks and Reviews</strong></a>
        </div>
    </div><br>

    <div class="row">
        <div class="col-sm-12 d-grid btn-spacing mb-2">
            <a style="color: white" class="btn bg-primary px-4" href="booksMain.php" role="button"><i class="fa-solid fa-book"></i><strong> Books List </strong></a>
        </div>
    </div><br><br><br>

</div>
<div class="text-center" style="position: absolute; bottom: 20px; left: 0; right: 0;">
    <div class="col-sm-12 d-grid btn-spacing">
        <a style="color: white" class="btn bg-danger px-4" href="logout.php" role="button"><i class="fa-sharp fa-solid fa-right-to-bracket"></i><strong> Logout </strong></a>
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
else{
    header("Location: index.php");
     exit();
}

?>
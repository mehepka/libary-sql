<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
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
        <h1 class="text-uppercase text-center text-primary">Login</h1>

        <form action="login.php" method="post">
            <?php if (isset($_GET['error'])) { ?>
                <div class="error">
                    <?php echo $_GET['error']; ?>
                </div>
            <?php } ?>

            <div class="mb-3">
                <label for="uname" class="form-label"><strong>Username</strong></label>
                <input type="text" id="uname" name="uname" placeholder="Username" required>
            </div>

            <div class="mb-3">
                <label for="password" class="form-label"><strong>Password</strong></label>
                <input type="password" id="password" name="password" placeholder="Password" required>
            </div>

            <div class="mb-3">
                <label for="role" class="form-label"><strong>Role</strong></label>
                <select name="role" id="role" class="form-select" required>
                    <option value="student">Student</option>
                    <option value="staff">Staff</option>
                    <option value="admin">Admin</option>
                </select>
            </div>

            <div class="mb-3 d-flex justify-content-center flex-column text-center">
                <button type="submit" class="btn btn-primary btn-block mb-2" style="width: 150px; margin: 0 auto;">
                    <i class="fas fa-check-square"></i> Login
                </button>
                <p>
                    Don't have an account yet? 
                    <a href="register.php">Register</a>
                </p>
            </div>
        </form>
    </div>
</body>
</html>
 
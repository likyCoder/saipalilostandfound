<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - Saipali Lost & Found</title>
    <link rel="stylesheet" href="../bootstrap-5/css/bootstrap.min.css">
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Poppins', sans-serif;
            background-color: #0b1a33;
            color: #fff;
        }
        .hero {
            background: linear-gradient(to bottom, rgba(11,26,51,0.8), rgba(11,26,51,1));
            padding: 80px 20px 40px 20px;
            text-align: center;
        }
        .hero h1 {
            font-size: 3rem;
            font-weight: 700;
            color: #ffd700;
            margin-bottom: 10px;
        }
        .hero p {
            font-size: 1.1rem;
            color: #cccccc;
        }
        .login-container {
            max-width: 420px;
            margin: -30px auto 0;
            background-color: #132a4f;
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 8px 20px rgba(0,0,0,0.4);
        }
        .login-container h2 {
            text-align: center;
            margin-bottom: 30px;
            font-size: 2rem;
            color: #ffffff;
        }
        .form-control {
            background-color: #1e3a66;
            border: 1px solid #3e5d88;
            color: #fff;
        }
        .form-control::placeholder {
            color: #ccc;
        }
        .form-control:focus {
            border-color: #ff6600;
            box-shadow: 0 0 0 0.2rem rgba(255, 102, 0, 0.25);
            background-color: #1e3a66;
            color: #fff;
        }
        .btn-primary {
            background-color: #ff6600;
            border: none;
            font-weight: bold;
            padding: 10px 20px;
            border-radius: 25px;
            width: 100%;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        .btn-primary:hover {
            background-color: #ff3300;
            transform: scale(1.03);
        }
        .btn-secondary {
            background-color: #3c4a5f;
            border: none;
            width: 100%;
            margin-top: 10px;
        }
        .alert {
            margin-bottom: 20px;
            text-align: center;
        }
    </style>
</head>
<body>

<!-- Hero Section -->
<div class="hero">
    <h1>Admin Portal</h1>
    <p>Restricted Access. Authorized Personnel Only.</p>
</div>

<!-- Login Form -->
<div class="login-container">
    <h2>Admin Login</h2>

    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        include '../config.php';

        $username = $_POST['username'];
        $password = $_POST['password'];

        $query = "SELECT * FROM admins WHERE username = '$username' AND password = '$password'";
        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) == 1) {
            session_start();
            $_SESSION['admin'] = $username;
            $_SESSION['role'] = 'admin';
            header('Location: admin-dashboard.php');
        } else {
            echo "<div class='alert alert-danger'>Invalid username or password.</div>";
        }
    }
    ?>

    <form action="" method="post">
        <div class="mb-3">
            <label for="username" class="form-label">Username:</label>
            <input type="text" class="form-control" id="username" name="username" required placeholder="Enter your username">
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password:</label>
            <input type="password" class="form-control" id="password" name="password" required placeholder="Enter your password">
        </div>
        <button type="submit" class="btn btn-primary">Login</button>
        <a href="../index.php" class="btn btn-secondary">Back to Home</a>
    </form>
</div>

</body>
</html>

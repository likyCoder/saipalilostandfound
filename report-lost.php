<?php
session_start(); // Ensure session is started here
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Report Lost</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #0b1a33;
            color: white;
        }
        .hero-section {
            background: url('assets/lost-report-bg.jpg') no-repeat center center/cover;
            color: white;
            padding: 80px 20px;
            text-align: center;
        }
        .hero-section h1 {
            font-size: 3rem;
            font-weight: bold;
        }
        .hero-section p {
            font-size: 1.2rem;
            margin-top: 10px;
            color: #f1f1f1;
        }
        .hero-section .btn {
            background-color: #ff6600;
            color: white;
            border: none;
            font-weight: bold;
            padding: 12px 30px;
            border-radius: 50px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        .hero-section .btn:hover {
            background-color: #ff3300;
            transform: scale(1.05);
        }
        .form-section {
            background: rgba(11, 26, 51, 0.9);
            padding: 40px 20px;
            border-radius: 10px;
            margin-top: -60px;
            box-shadow: 0px 15px 25px rgba(0, 0, 0, 0.4);
        }
        .form-section h1 {
            font-size: 2rem;
            margin-bottom: 30px;
            color: #ffd700;
        }
        .form-section input, .form-section textarea, .form-section select {
            border-radius: 25px;
            padding: 15px;
            font-size: 1rem;
            margin-bottom: 20px;
            background-color: #12294f;
            color: #fff;
            border: 1px solid #003366;
        }
        .form-section button {
            background-color: #ff6600;
            color: white;
            font-weight: bold;
            border: none;
            border-radius: 25px;
            padding: 12px 30px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        .form-section button:hover {
            background-color: #ff3300;
        }
    </style>
</head>
<body>

<header>
    <?php include('includes/header.php'); ?>
</header>

<section class="hero-section">
    <div class="container">
        <h1>Report a Lost Item</h1>
        <p>If you've lost an item, let us know! We’ll help you report it so others can help you find it.</p>
        <a href="#form-section" class="btn">Report Now</a>
    </div>
</section>

<main class="container mt-5">
    <section id="form-section" class="form-section">
        <h1 class="text-center">Fill Out the Form Below</h1>

        <?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            include 'config.php';

            $name = isset($_POST['name']) ? mysqli_real_escape_string($conn, $_POST['name']) : '';
            $category = isset($_POST['category']) ? mysqli_real_escape_string($conn, $_POST['category']) : '';
            $description = isset($_POST['description']) ? mysqli_real_escape_string($conn, $_POST['description']) : '';
            $date_lost_found = isset($_POST['date_lost_found']) ? mysqli_real_escape_string($conn, $_POST['date_lost_found']) : '';
            $location = isset($_POST['location']) ? mysqli_real_escape_string($conn, $_POST['location']) : '';
            $contact_info = isset($_POST['contact_info']) ? mysqli_real_escape_string($conn, $_POST['contact_info']) : '';
            $image_path = '';

            if (!is_dir('uploads')) {
                mkdir('uploads', 0777, true);
            }

            if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
                $image_path = 'uploads/' . basename($_FILES['image']['name']);
                if (!move_uploaded_file($_FILES['image']['tmp_name'], $image_path)) {
                    echo '<div class="alert alert-danger">Failed to upload image.</div>';
                    $image_path = '';
                }
            }

            $query = "INSERT INTO items (name, category, description, date_lost_found, location, contact_info, image_path, status) VALUES ('$name', '$category', '$description', '$date_lost_found', '$location', '$contact_info', '$image_path', 'Lost')";
            if (mysqli_query($conn, $query)) {
                echo '<div class="alert alert-success">Lost item reported successfully.</div>';
            } else {
                echo '<div class="alert alert-danger">Error reporting lost item: ' . mysqli_error($conn) . '</div>';
            }

            mysqli_close($conn);
        }
        ?>

        <!-- Report Lost Item Form -->
        <form action="" method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="name" class="form-label">Item Name:</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>

            <div class="mb-3">
                <label for="category" class="form-label">Category:</label>
                <select class="form-select" id="category" name="category" required>
                    <option value="Electronics">Electronics</option>
                    <option value="Clothing">Clothing</option>
                    <option value="Accessories">Accessories</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Description:</label>
                <textarea class="form-control" id="description" name="description" required></textarea>
            </div>

            <div class="mb-3">
                <label for="date_lost_found" class="form-label">Date Lost:</label>
                <input type="date" class="form-control" id="date_lost_found" name="date_lost_found" required>
            </div>

            <div class="mb-3">
                <label for="location" class="form-label">Location:</label>
                <input type="text" class="form-control" id="location" name="location" required>
            </div>

            <div class="mb-3">
                <label for="contact_info" class="form-label">Contact Info:</label>
                <input type="text" class="form-control" id="contact_info" name="contact_info" required>
            </div>

            <div class="mb-3">
                <label for="image" class="form-label">Upload Image:</label>
                <input type="file" class="form-control" id="image" name="image">
            </div>

            <div class="text-center">
                <button type="submit" class="btn btn-primary">Report Lost Item</button>
            </div>
        </form>
    </section>
</main>

<?php include('includes/footer.php'); ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>

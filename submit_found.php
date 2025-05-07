<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Submit Found</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<header>
    <?php include('includes/header.php'); ?>
</header>

    <main class="container mt-5">
        <section>
            <h1 class="mb-4">Submit Found Item</h1>
            <?php
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                include 'config.php';

                $name = isset($_POST['item_name']) ? mysqli_real_escape_string($conn, $_POST['item_name']) : '';
                $category = isset($_POST['category']) ? mysqli_real_escape_string($conn, $_POST['category']) : '';
                $description = isset($_POST['item_description']) ? mysqli_real_escape_string($conn, $_POST['item_description']) : '';
                $date_lost_found = isset($_POST['date_found']) ? mysqli_real_escape_string($conn, $_POST['date_found']) : '';
                $location = isset($_POST['found_location']) ? mysqli_real_escape_string($conn, $_POST['found_location']) : '';
                $contact_info = isset($_POST['contact_info']) ? mysqli_real_escape_string($conn, $_POST['contact_info']) : '';
                $image_path = '';

                // Ensure the uploads directory exists
                if (!is_dir('uploads')) {
                    mkdir('uploads', 0777, true);
                }

                // Handle image upload
                if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
                    $image_path = 'uploads/' . basename($_FILES['image']['name']);
                    if (!move_uploaded_file($_FILES['image']['tmp_name'], $image_path)) {
                        echo '<div class="alert alert-danger">Failed to upload image.</div>';
                        $image_path = '';
                    }
                }

                $query = "INSERT INTO items (name, category, description, date_lost_found, location, contact_info, image_path, status) VALUES ('$name', '$category', '$description', '$date_lost_found', '$location', '$contact_info', '$image_path', 'Found')";
                if (mysqli_query($conn, $query)) {
                    echo '<div class="alert alert-success">Found item submitted successfully.</div>';
                } else {
                    echo '<div class="alert alert-danger">Error submitting found item: ' . mysqli_error($conn) . '</div>';
                }

                mysqli_close($conn);
            }
            ?>
            <form action="" method="post" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="item_name" class="form-label">Item Name:</label>
                    <input type="text" class="form-control" id="item_name" name="item_name" required>
                </div>
                <div class="mb-3">
                    <label for="category" class="form-label">Category:</label>
                    <select class="form-select" id="category" name="category" required>
                        <option value="Electronics">Electronics</option>
                        <option value="Clothing">Clothing</option>
                        <option value="Accessories">Accessories</option>
                        <!-- ...other categories... -->
                    </select>
                </div>
                <div class="mb-3">
                    <label for="item_description" class="form-label">Description:</label>
                    <textarea class="form-control" id="item_description" name="item_description" required></textarea>
                </div>
                <div class="mb-3">
                    <label for="date_found" class="form-label">Date Found:</label>
                    <input type="date" class="form-control" id="date_found" name="date_found" required>
                </div>
                <div class="mb-3">
                    <label for="found_location" class="form-label">Location:</label>
                    <input type="text" class="form-control" id="found_location" name="found_location" required>
                </div>
                <div class="mb-3">
                    <label for="contact_info" class="form-label">Contact Info:</label>
                    <input type="text" class="form-control" id="contact_info" name="contact_info" required>
                </div>
                <div class="mb-3">
                    <label for="image" class="form-label">Upload Image:</label>
                    <input type="file" class="form-control" id="image" name="image">
                </div>
                <button type="submit" class="btn btn-primary">Submit Found Item</button>
            </form>
        </section>
    </main>
</body>
</html>

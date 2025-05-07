<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Report Found</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #0b1a33;
            color: white;
        }
        .hero-section {
            background: url('assets/found-report-bg.jpg') no-repeat center center/cover;
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
        <h1>Report a Found Item</h1>
        <p>If you've found an item, let us know! We’ll help you report it so others can claim it back.</p>
        <a href="#form-section" class="btn">Report Now</a>
    </div>
</section>

<main class="container mt-5">
    <section id="form-section" class="form-section">
        <h1 class="text-center">Fill Out the Form Below</h1>

        <form action="submit_found.php" method="post" enctype="multipart/form-data" id="found-form">
            <div class="mb-3">
                <label for="item_name" class="form-label">Item Name</label>
                <input type="text" class="form-control" id="item_name" name="item_name" required>
            </div>

            <div class="mb-3">
                <label for="category" class="form-label">Category</label>
                <select class="form-select" id="category" name="category" required>
                    <option selected disabled value="">Choose...</option>
                    <option>Electronics</option>
                    <option>Clothing</option>
                    <option>Accessories</option>
                    <option>Books</option>
                    <option>Others</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="item_description" class="form-label">Description</label>
                <textarea class="form-control" id="item_description" name="item_description" rows="3" required></textarea>
            </div>

            <div class="mb-3">
                <label for="date_found" class="form-label">Date Found</label>
                <input type="date" class="form-control" id="date_found" name="date_found" required>
            </div>

            <div class="mb-3">
                <label for="found_location" class="form-label">Found Location</label>
                <input type="text" class="form-control" id="found_location" name="found_location" required>
            </div>

            <div class="mb-3">
                <label for="contact_info" class="form-label">Contact Information</label>
                <input type="text" class="form-control" id="contact_info" name="contact_info" required>
            </div>

            <div class="mb-3">
                <label for="image" class="form-label">Image Upload (optional)</label>
                <input type="file" class="form-control" id="image" name="image">
            </div>

            <div class="text-center">
                <button type="submit" class="btn btn-primary">Submit Report</button>
            </div>
        </form>
    </section>
</main>

<?php include('includes/footer.php'); ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>

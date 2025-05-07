<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Claim Items</title>
    <link rel="stylesheet" href="bootstrap-5/css/bootstrap.min.css">
</head>
<body>
<header>
    <?php
     include('includes/header.php'); 
     ?>
</header>

<main class="container mt-5">
    <section>
        <h1 class="mb-4">Claim Item</h1>
        <form action="submit_claim.php" method="post" enctype="multipart/form-data" onsubmit="return validateForm()">
            <div class="mb-3">
                <label for="name" class="form-label">Name:</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="mb-3">
                <label for="contact-info" class="form-label">Contact Information:</label>
                <input type="text" class="form-control" id="contact-info" name="contact_info" required>
            </div>
            <div class="mb-3">
                <label for="proof" class="form-label">Proof of Ownership (optional):</label>
                <input type="file" class="form-control" id="proof" name="proof">
            </div>
            <div class="mb-3">
                <label for="message" class="form-label">Message to Finder:</label>
                <textarea class="form-control" id="message" name="message" rows="3" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
        <a href="browse.php"><button class="btn btn-secondary mt-3 px-4">Back</button></a>
        <script>
            function validateForm() {
                const name = document.getElementById('name').value.trim();
                const contactInfo = document.getElementById('contact-info').value.trim();
                const message = document.getElementById('message').value.trim();
                if (!name || !contactInfo || !message) {
                    alert('Please fill in all required fields.');
                    return false;
                }
                return true;
            }
        </script>
    </section>
</main>

<script src="bootstrap-5/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Claim Item - Saipali Lost & Found</title>
    <link rel="stylesheet" href="bootstrap-5/css/bootstrap.min.css">
    <style>
        body {
            background-color: #001f3f;
            background-image: url('assets/bg-lost-found.jpg');
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
            color: #fff;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .overlay {
            background-color: rgba(13, 27, 42, 0.7);
            min-height: 100vh;
            padding-bottom: 50px;
        }

        .intro-section {
            padding: 60px 0 30px;
            text-align: center;
            color: #ffffff;
        }

        .intro-section h1 {
            font-size: 3rem;
            font-weight: 700;
        }

        .intro-section p {
            font-size: 1.2rem;
            max-width: 700px;
            margin: 0 auto;
            color: #d0d0d0;
        }

        .form-container {
            background-color: #ffffff;
            color: #333;
            border-radius: 12px;
            padding: 30px;
            max-width: 700px;
            margin: auto;
            box-shadow: 0 0 20px rgba(0,0,0,0.3);
        }

        .btn-primary {
            background-color: #0056b3;
            border: none;
        }

        .btn-primary:hover {
            background-color: #003d80;
        }

        .btn-secondary {
            background-color: #6c757d;
        }

        .btn-secondary:hover {
            background-color: #5a6268;
        }

        label {
            font-weight: 600;
        }
    </style>
</head>
<body>
<div class="overlay">
    <header>
        <?php include('includes/header.php'); ?>
    </header>

    <!-- ✅ Intro Section -->
    <section class="intro-section">
        <div class="container">
            <h1>Claim a Lost Item</h1>
            <p>If you believe this item belongs to you, please fill out the form below with your details and any proof of ownership.</p>
        </div>
    </section>

    <main class="container mb-5">
        <section>
            <div class="form-container">
                <form action="submit_claim.php" method="post" enctype="multipart/form-data" onsubmit="return validateForm()">
                    <div class="mb-3">
                        <label for="name" class="form-label">Your Name:</label>
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
                        <label for="message" class="form-label">Message to the Finder:</label>
                        <textarea class="form-control" id="message" name="message" rows="3" required></textarea>
                    </div>
                    <div class="d-flex justify-content-between">
                        <button type="submit" class="btn btn-primary">Submit Claim</button>
                        <a href="browse.php" class="btn btn-secondary">Back to Browse</a>
                    </div>
                </form>
            </div>

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
</div>
<?php include("includes/footer.php"); ?>

<script src="bootstrap-5/js/bootstrap.bundle.min.js"></script>
</body>
</html>

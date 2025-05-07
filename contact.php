<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #0b1a33; /* Dark Blue Background */
            font-family: 'Poppins', sans-serif;
            color: #fff;
            margin: 0;
            padding: 0;
        }

        header {
            background: #12294f;
            padding: 20px 0;
            text-align: center;
        }

        header a {
            color: #ffd700;
            text-decoration: none;
            font-size: 1.5rem;
        }

        .contact-card {
            max-width: 600px;
            margin: auto;
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 30px;
            margin-top: 50px;
        }

        .btn-primary {
            background-color: #007bff;
            border: none;
            transition: 0.3s;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }

        .contact-info {
            background: linear-gradient(rgba(11, 26, 51, 0.9), rgba(11, 26, 51, 0.9)), url('assets/contact-bg.jpg') no-repeat center center/cover;
            color: #fff;
            padding: 50px;
            border-radius: 12px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin-top: 50px;
        }

        .contact-info h2 {
            font-size: 2rem;
            font-weight: bold;
            color: #ffd700;
            margin-bottom: 20px;
        }

        .contact-info p {
            font-size: 1rem;
            margin-top: 10px;
        }

        .footer {
            background: #12294f;
            color: #fff;
            padding: 20px 0;
            margin-top: 50px;
        }

        .footer a {
            color: #ffd700;
            text-decoration: none;
        }

        .footer a:hover {
            text-decoration: underline;
        }

        .footer p {
            font-size: 1rem;
        }

        .container {
            padding: 40px 15px;
        }

        /* Styling the form elements */
        .form-label {
            color: #ffd700;
        }

        .form-control {
            border-radius: 8px;
            border: 1px solid #444;
            background-color: #1f2a44;
            color: #fff;
            padding: 15px;
            font-size: 1rem;
        }

        .form-control:focus {
            background-color: #12294f;
            border-color: #ffd700;
            box-shadow: 0 0 5px #ffd700;
        }

        .form-control::placeholder {
            color: #ccc;
        }

        /* Styling the Map */
        .contact-info iframe {
            width: 100%;
            height: 400px;
            border-radius: 12px;
            border: 0;
            margin-top: 20px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
        }

        /* Responsive Styling */
        @media (max-width: 768px) {
            .contact-card {
                padding: 20px;
            }

            .contact-info iframe {
                height: 300px;
            }
        }
    </style>
</head>
<body>
<?php include('includes/header.php'); ?>


<main class="container mt-5">
<section class="hero-section text-center py-5" style="background: url('assets/contact-bg.jpg') no-repeat center center/cover; color: white;">
    <div class="container">
        <h1 class="display-4 font-weight-bold mb-4">Get In Touch With Us</h1>
        <p class="lead mb-4">
            Whether you have a question, need assistance, or want to share feedback, we’re here to help. Reach out to us anytime, and we’ll get back to you as soon as possible. We value your thoughts and look forward to connecting with you.
        </p>
        <a href="#contact-form" class="btn btn-primary btn-lg mt-3">Contact Us Now</a>
    </div>
</section>

    <!-- Contact Form Section -->
    <section class="contact-card">
        <h1 class="text-center mb-4">Contact Us</h1>
        <form action="send_message.php" method="post" id="contact-form">
            <div class="mb-3">
                <label for="name" class="form-label">Name:</label>
                <input type="text" class="form-control" id="name" name="name" required placeholder="Your full name">
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email:</label>
                <input type="email" class="form-control" id="email" name="email" required placeholder="Your email address">
            </div>
            <div class="mb-3">
                <label for="message" class="form-label">Message:</label>
                <textarea class="form-control" id="message" name="message" rows="5" required placeholder="Your message..."></textarea>
            </div>
            <button type="submit" class="btn btn-primary w-100">Send</button>
        </form>
    </section>

    <!-- Contact Information Section -->
    <section class="mt-5 text-center contact-info">
        <h2>Contact Information</h2>
        <p>Email: <a href="mailto:info@saipali.education" class="text-decoration-none">info@saipali.education</a></p>
        <p>Website: <a href="https://www.saipali.education" class="text-decoration-none" target="_blank">www.saipali.education</a></p>
        <p>Phone: <strong>+256 771822430, +256 757300379</strong></p>
        <p>Address: <strong>Kampala, Uganda</strong></p>
        <div class="ratio ratio-16x9 mt-3">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3989.7581165471415!2d32.56032097349258!3d0.31475566403143956!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x177dbc9e4b0a27c1%3A0xf4010054ac292942!2sSai%20Pali%20Institute%20Of%20Technology%20And%20Management!5e0!3m2!1sen!2sug!4v1743584161808!5m2!1sen!2sug" loading="lazy" allowfullscreen></iframe>
        </div>
    </section>
</main>

<!-- Footer -->
<?php
 include('includes/footer.php'); 
 ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

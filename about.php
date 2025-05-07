<?php
include ('includes/header.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="bootstrap-5/css/bootstrap.min.css">
</head>
<style>
    .bg {
        background-color: rgb(2, 2, 68);
    }
    .navbar-toggler {
        color: rgb(4, 0, 255);
        background: white;
    }
    * {
        margin: 0;
        padding: 0;
    }
    #brand {
        font-size: xx-large;
        font-weight: bolder;
        font-family: Blackadder ITC;
        color: rgb(4, 0, 255);
        text-align: left;
        padding: 0;
        margin: 0;
    }
    @media (max-width: 600px) {
        .navbar {
            display: flex;
        }
        .bg-light {
            background-color: blue;
        }
        .bg {
            background-color: rgb(2, 2, 68);
        }
        .nav-link {
            color: rgb(18, 18, 255);
            font-size: x-large;
            font-weight: bolder;
            font-family: Agency FB;
            background-color: rgb(2, 2, 82);
            box-shadow: 2px 4px 8px rgb(90, 3, 3);
            border-radius: 30px;
            margin: 2%;
            text-align: center;
        }
        .nav-link:hover {
            color: white;
        }
        .collapse {
            margin-top: 15%;
        }
        .btn:hover {
            color: rgb(233, 11, 18);
            font-size: large;
            font-weight: bold;
        }
        .btn {
            width: 100%;
            height: 100%;
            padding: 5%;
            margin: 1%;
        }
    }
    @media (min-width: 600px) {
        .nav-link {
            color: rgb(255, 255, 255);
            font-size: large;
            font-weight: bold;
            box-shadow: 2px 4px 8px rgb(0, 230, 234);
            border-radius: 30px;
            margin: 0 10px;
            text-align: center;
        }
        .nav-link:hover {
            color: rgb(9, 171, 3);
        }
        .collapse {
            margin: 5%;
        }
        .btn:hover {
            color: rgb(233, 11, 18);
            font-size: large;
            font-weight: bold;
        }
        .btn {
            box-shadow: 2px 4px 8px rgb(0, 234, 218);
        }
    }
</style>
<body>
    <!-- About Us Section -->
    <main class="container mt-5">
        <section>
            <h1 class="mb-4">About Us</h1>
            <h3>Introduction</h3>
            <p>Saipali Lost & Found is an online platform designed to help individuals report lost and found items efficiently. Whether you’ve lost a valuable item or found something that someone else is looking for, this platform helps connect you with the rightful owners.</p>

            <h3>Our Mission</h3>
            <p>Our mission is to create a safe, user-friendly environment where lost items can be reported, found, and returned to their rightful owners quickly and effectively.</p>

            <h3>How It Works</h3>
            <p>Users can submit reports of lost and found items by filling out a simple form, including information about the item, when and where it was lost or found, and contact details. Our platform ensures that all reports are easily searchable, helping users to find their missing items.</p>

            <h3>Our Team</h3>
            <p>Saipali Lost & Found was founded by a passionate team of students and professionals dedicated to solving the problem of lost items in the community. The team is led by Liky Josh, a dedicated student and entrepreneur at Saipali Institute of Technology and Management.</p>

            <h3>Our Values</h3>
            <p>We believe in transparency, safety, and community engagement. Our goal is to build trust with our users and ensure that the process of reporting and finding lost items is as seamless as possible.</p>

            <h3>Future Goals</h3>
            <p>Looking ahead, we plan to expand our platform to include a wider range of services, such as location-based notifications, real-time tracking, and mobile app integration.</p>
        </section>
    </main>

    <!-- Footer -->
    <footer class="text-center mt-5">
        <div class="container">
            <?php include 'includes/footer.php'; ?>
        </div>
    </footer>
</body>
</html>

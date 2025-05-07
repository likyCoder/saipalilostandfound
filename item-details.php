<?php
session_start(); // Ensure session is started here
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Item Details - Saipali Lost & Found</title>
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
            padding: 60px 0;
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

        .card {
            background-color: #ffffff;
            color: #333;
        }

        .card img {
            max-height: 100%;
            object-fit: cover;
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
            <h1>Item Information</h1>
            <p>Here you’ll find more details about a lost or found item listed in our system. If you recognize it or it's yours, you can claim it below.</p>
        </div>
    </section>

    <main class="container my-5">
        <section>
            <?php
            include 'config.php';

            if ($conn->connect_error) {
                echo '<div class="alert alert-danger">Failed to load item details. Please try again later.</div>';
                die("Connection failed: " . $conn->connect_error);
            }

            $item_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

            if ($item_id > 0) {
                $query = "SELECT * FROM items WHERE id = ?";
                $stmt = $conn->prepare($query);
                $stmt->bind_param("i", $item_id);
                $stmt->execute();
                $result = $stmt->get_result();

                if ($result && $result->num_rows > 0) {
                    $item = $result->fetch_assoc();
                    $image = !empty($item['image_path']) ? htmlspecialchars($item['image_path']) : 'assets/default-placeholder.png';

                    echo '
                    <div class="card shadow-lg border-0 mb-4">
                        <div class="row g-0">
                            <div class="col-md-6">
                                <img src="' . $image . '" alt="Item Image" class="img-fluid rounded-start w-100">
                            </div>
                            <div class="col-md-6">
                                <div class="card-body">
                                    <h2 class="card-title text-dark mb-3">' . htmlspecialchars($item['name']) . '</h2>
                                    <p class="card-text text-muted">' . htmlspecialchars($item['description']) . '</p>
                                    <p class="card-text"><strong>Category:</strong> ' . htmlspecialchars($item['category']) . '</p>
                                    <p class="card-text"><strong>Date Lost/Found:</strong> ' . htmlspecialchars($item['date_lost_found']) . '</p>
                                    <p class="card-text"><strong>Location:</strong> ' . htmlspecialchars($item['location']) . '</p>
                                    <p class="card-text"><strong>Contact Information:</strong> ' . htmlspecialchars($item['contact_info']) . '</p>
                                    <div class="d-flex justify-content-between mt-4">
                                        <a href="claim-item.php?id=' . $item['id'] . '" class="btn btn-primary px-4">Claim Item</a>
                                        <a href="browse.php" class="btn btn-secondary px-4">Back to Browse</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>';
                } else {
                    echo '<div class="alert alert-warning">Item not found.</div>';
                }
                $stmt->close();
            } else {
                echo '<div class="alert alert-danger">Invalid item ID.</div>';
            }

            $conn->close();
            ?>
        </section>
    </main>

    <?php include("includes/footer.php"); ?>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>

<?php
session_start(); // Ensure session is started here
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Item details</title>
    <link rel="stylesheet" href="bootstrap-5/css/bootstrap.min.css">
</head>

<body>
<header>
    <?php include('includes/header.php'); ?>
</header>

<main class="container mt-5">
    <section>
        <?php
        include 'config.php';

        // Check database connection
        if ($conn->connect_error) {
            echo '<div class="alert alert-danger">Failed to load item details. Please try again later.</div>';
            die("Connection failed: " . $conn->connect_error);
        }

        // Get item ID from query parameters
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
                <h1 class="mb-4 text-center text-primary">Item Details</h1>
                <div class="card shadow-lg border-0 mb-4">
                    <div class="row g-0">
                        <div class="col-md-6">
                            <img src="' . $image . '" alt="Item Image" class="img-fluid rounded-start">
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

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>

</body>
</html>

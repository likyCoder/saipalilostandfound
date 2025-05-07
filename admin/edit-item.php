<?php
session_start();
if (!isset($_SESSION['admin']) || $_SESSION['role'] !== 'admin') {
    header('Location: login.php');
    exit();
}

// Include the database connection file
include '../config.php';

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// CSRF token generation
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

// Initialize variables
$item_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$message = '';

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if ($_POST['csrf_token'] !== $_SESSION['csrf_token']) {
        die("Invalid CSRF token.");
    }

    $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
    $category = filter_input(INPUT_POST, 'category', FILTER_SANITIZE_STRING);
    $description = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_STRING);
    $date_lost_found = filter_input(INPUT_POST, 'date_lost_found', FILTER_SANITIZE_STRING);
    $location = filter_input(INPUT_POST, 'location', FILTER_SANITIZE_STRING);
    $contact_info = filter_input(INPUT_POST, 'contact_info', FILTER_SANITIZE_STRING);
    $status = filter_input(INPUT_POST, 'status', FILTER_SANITIZE_STRING);

    // Update item details
    $stmt = $conn->prepare("UPDATE items SET name = ?, category = ?, description = ?, date_lost_found = ?, location = ?, contact_info = ?, status = ? WHERE id = ?");
    $stmt->bind_param("sssssssi", $name, $category, $description, $date_lost_found, $location, $contact_info, $status, $item_id);
    if ($stmt->execute()) {
        $message = '<div class="alert alert-success">Item updated successfully.</div>';
    } else {
        $message = '<div class="alert alert-danger">Error updating item: ' . $stmt->error . '</div>';
    }
    $stmt->close();
}

// Fetch item details
$stmt = $conn->prepare("SELECT * FROM items WHERE id = ?");
$stmt->bind_param("i", $item_id);
$stmt->execute();
$result = $stmt->get_result();
$item = $result->fetch_assoc();
$stmt->close();

if (!$item) {
    echo '<div class="alert alert-danger">Item not found.</div>';
    exit();
}

// Close the database connection
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Item - Saipali Lost & Found</title>
    <link rel="stylesheet" href="../assets/css/styles.css">
    <!-- Add Bootstrap CSS -->
    <link rel="stylesheet" href="../bootstrap-5/css/bootstrap.min.css">
</head>
<body>
    <!-- Header & Navbar -->
   <!-- deleted -->

    <!-- Edit Item Form -->
    <main class="container mt-5">
        <section>
            <h1 class="mb-4">Edit Item</h1>
            <?php echo $message; ?>
            <form action="" method="post">
                <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
                <div class="mb-3">
                    <label for="name" class="form-label">Name:</label>
                    <input type="text" class="form-control" id="name" name="name" value="<?php echo htmlspecialchars($item['name']); ?>" required>
                </div>
                <div class="mb-3">
                    <label for="category" class="form-label">Category:</label>
                    <select class="form-select" id="category" name="category" required>
                        <option value="Electronics" <?php if ($item['category'] == 'Electronics') echo 'selected'; ?>>Electronics</option>
                        <option value="Clothing" <?php if ($item['category'] == 'Clothing') echo 'selected'; ?>>Clothing</option>
                        <option value="Accessories" <?php if ($item['category'] == 'Accessories') echo 'selected'; ?>>Accessories</option>
                        <!-- ...other categories... -->
                    </select>
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Description:</label>
                    <textarea class="form-control" id="description" name="description" required><?php echo htmlspecialchars($item['description']); ?></textarea>
                </div>
                <div class="mb-3">
                    <label for="date_lost_found" class="form-label">Date Lost/Found:</label>
                    <input type="date" class="form-control" id="date_lost_found" name="date_lost_found" value="<?php echo htmlspecialchars($item['date_lost_found']); ?>" required>
                </div>
                <div class="mb-3">
                    <label for="location" class="form-label">Location:</label>
                    <input type="text" class="form-control" id="location" name="location" value="<?php echo htmlspecialchars($item['location']); ?>" required>
                </div>
                <div class="mb-3">
                    <label for="contact_info" class="form-label">Contact Info:</label>
                    <input type="text" class="form-control" id="contact_info" name="contact_info" value="<?php echo htmlspecialchars($item['contact_info']); ?>" required>
                </div>
                <div class="mb-3">
                    <label for="status" class="form-label">Status:</label>
                    <select class="form-select" id="status" name="status" required>
                        <option value="Pending" <?php if ($item['status'] == 'Pending') echo 'selected'; ?>>Pending</option>
                        <option value="Lost" <?php if ($item['status'] == 'Lost') echo 'selected'; ?>>Lost</option>
                        <option value="Found" <?php if ($item['status'] == 'Found') echo 'selected'; ?>>Found</option>
                        <option value="Claimed" <?php if ($item['status'] == 'Claimed') echo 'selected'; ?>>Claimed</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Update Item</button>
                <a href="admin-dashboard.php" class="btn btn-secondary">Back to Dashboard</a>
            </form>
        </section>
    </main>
</body>
</html>

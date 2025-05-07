<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header('Location: login.php');
    exit();
}

// Include the database connection file
include '../config.php';

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Initialize variables
$user_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$message = '';

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = htmlspecialchars($_POST['username']);
    $email = htmlspecialchars($_POST['email']);
    $role = htmlspecialchars($_POST['role']);

    // Update user details
    $stmt = $conn->prepare("UPDATE users SET username = ?, email = ?, role = ? WHERE id = ?");
    $stmt->bind_param("sssi", $username, $email, $role, $user_id);
    if ($stmt->execute()) {
        $message = '<div class="alert alert-success">User updated successfully.</div>';
    } else {
        $message = '<div class="alert alert-danger">Error updating user.</div>';
    }
    $stmt->close();
}

// Fetch user details
$stmt = $conn->prepare("SELECT * FROM users WHERE id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();
$stmt->close();

if (!$user) {
    echo '<div class="alert alert-danger">User not found.</div>';
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User - Saipali Lost & Found</title>
    <link rel="stylesheet" href="../assets/css/styles.css">
    <!-- Add Bootstrap CSS -->
    <link rel="stylesheet" href="../bootstrap-5/css/bootstrap.min.css">
</head>
<body>
    <!-- Header & Navbar -->
<!-- deleted -->

    <!-- Edit User Form -->
    <main class="container mt-5">
        <section>
            <h1 class="mb-4">Edit User</h1>
            <?php echo $message; ?>
            <form action="" method="post">
                <div class="mb-3">
                    <label for="username" class="form-label">Username:</label>
                    <input type="text" class="form-control" id="username" name="username" value="<?php echo htmlspecialchars($user['username']); ?>" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email:</label>
                    <input type="email" class="form-control" id="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" required>
                </div>
                <div class="mb-3">
                    <label for="role" class="form-label">Role:</label>
                    <select class="form-select" id="role" name="role" required>
                        <option value="admin" <?php if ($user['role'] == 'admin') echo 'selected'; ?>>Admin</option>
                        <option value="user" <?php if ($user['role'] == 'user') echo 'selected'; ?>>User</option>
                        <option value="freelancer" <?php if ($user['role'] == 'freelancer') echo 'selected'; ?>>Freelancer</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
                <a href="user_management.php" class="btn btn-secondary">Back to Users</a>
            </form>
        </section>
    </main>
</body>
</html>

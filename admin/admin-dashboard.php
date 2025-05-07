<?php
session_start();
if (!isset($_SESSION['admin']) || $_SESSION['role'] !== 'admin') {
    header('Location: login.php');
    exit();
}

include '../config.php';
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update_status'])) {
    if (!hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])) {
        die("Invalid CSRF token");
    }
    $item_id = $_POST['item_id'];
    $status = $_POST['status'];
    $stmt = $conn->prepare("UPDATE items SET status = ? WHERE id = ?");
    $stmt->bind_param("si", $status, $item_id);
    if ($stmt->execute()) {
        $message = '<div class="alert alert-success">Item status updated successfully.</div>';
    } else {
        $message = '<div class="alert alert-danger">Error updating item status.</div>';
    }
    $stmt->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Saipali Lost & Found</title>
    <link rel="stylesheet" href="../bootstrap-5/css/bootstrap.min.css">
    <style>
        body {
            background-color: #0b1a33;
            color: #ffffff;
            font-family: 'Poppins', sans-serif;
        }
        .container {
            padding-top: 50px;
        }
        h1, h2 {
            font-weight: 600;
        }
        h1 {
            font-size: 2.5rem;
            color: #ffd700;
        }
        h2 {
            color: #00ffcc;
        }
        .btn-danger, .btn-primary, .btn-warning {
            transition: all 0.2s ease-in-out;
        }
        .btn-primary:hover {
            background-color: #ff6600;
            transform: scale(1.05);
        }
        .btn-danger:hover {
            background-color: #cc0000;
            transform: scale(1.05);
        }
        .btn-warning:hover {
            background-color: #f39c12;
            transform: scale(1.05);
        }
        .table {
            background-color: #122644;
            border-radius: 10px;
            overflow: hidden;
        }
        th, td {
            color: #ffffff;
            vertical-align: middle;
        }
        .form-select {
            background-color: #1e3a66;
            color: #ffffff;
            border: 1px solid #3e5d88;
        }
        .alert {
            border-radius: 8px;
            margin-bottom: 30px;
            text-align: center;
        }
        .dashboard-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
    </style>
</head>
<body>
    <main class="container">
        <section>
            <div class="dashboard-header mb-4">
                <h1>Admin Dashboard</h1>
                <a href="logout.php" class="btn btn-danger">Logout</a>
            </div>

            <?php if (isset($message)) echo $message; ?>

            <!-- Lost Items Section -->
            <h2 class="mb-4">Manage Lost Items</h2>
            <div class="table-responsive">
                <table class="table table-striped text-center">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Date Lost</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $query = "SELECT * FROM items WHERE status = 'Lost' ORDER BY date_lost_found DESC";
                        $result = mysqli_query($conn, $query);
                        if ($result && mysqli_num_rows($result) > 0) {
                            while ($item = mysqli_fetch_assoc($result)) {
                                echo '
                                <tr>
                                    <td>' . htmlspecialchars($item['id']) . '</td>
                                    <td>' . htmlspecialchars($item['name']) . '</td>
                                    <td>' . htmlspecialchars($item['description']) . '</td>
                                    <td>' . htmlspecialchars($item['date_lost_found']) . '</td>
                                    <td>' . htmlspecialchars($item['status']) . '</td>
                                    <td>
                                        <form method="POST" class="d-inline">
                                            <input type="hidden" name="csrf_token" value="' . $_SESSION['csrf_token'] . '">
                                            <input type="hidden" name="item_id" value="' . $item['id'] . '">
                                            <select name="status" class="form-select d-inline w-auto mb-2">
                                                <option value="Pending"' . ($item['status'] == 'Pending' ? ' selected' : '') . '>Pending</option>
                                                <option value="Approved"' . ($item['status'] == 'Approved' ? ' selected' : '') . '>Approved</option>
                                                <option value="Rejected"' . ($item['status'] == 'Rejected' ? ' selected' : '') . '>Rejected</option>
                                                <option value="Lost"' . ($item['status'] == 'Lost' ? ' selected' : '') . '>Lost</option>
                                                <option value="Found"' . ($item['status'] == 'Found' ? ' selected' : '') . '>Found</option>
                                                <option value="Claimed"' . ($item['status'] == 'Claimed' ? ' selected' : '') . '>Claimed</option>
                                            </select>
                                            <button type="submit" name="update_status" class="btn btn-sm btn-primary">Update</button>
                                        </form>
                                        <a href="edit-item.php?id=' . $item['id'] . '" class="btn btn-sm btn-warning">Edit</a>
                                        <a href="delete-item.php?id=' . $item['id'] . '" class="btn btn-sm btn-danger">Delete</a>
                                    </td>
                                </tr>';
                            }
                        } else {
                            echo '<tr><td colspan="6">No lost items found.</td></tr>';
                        }
                        ?>
                    </tbody>
                </table>
            </div>

            <!-- Found Items Section -->
            <h2 class="mb-4 mt-5">Manage Found Items</h2>
            <div class="table-responsive">
                <table class="table table-striped text-center">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Date Found</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $query = "SELECT * FROM items WHERE status = 'Found' ORDER BY date_lost_found DESC";
                        $result = mysqli_query($conn, $query);
                        if ($result && mysqli_num_rows($result) > 0) {
                            while ($item = mysqli_fetch_assoc($result)) {
                                echo '
                                <tr>
                                    <td>' . htmlspecialchars($item['id']) . '</td>
                                    <td>' . htmlspecialchars($item['name']) . '</td>
                                    <td>' . htmlspecialchars($item['description']) . '</td>
                                    <td>' . htmlspecialchars($item['date_lost_found']) . '</td>
                                    <td>' . htmlspecialchars($item['status']) . '</td>
                                    <td>
                                        <form method="POST" class="d-inline">
                                            <input type="hidden" name="csrf_token" value="' . $_SESSION['csrf_token'] . '">
                                            <input type="hidden" name="item_id" value="' . $item['id'] . '">
                                            <select name="status" class="form-select d-inline w-auto mb-2">
                                                <option value="Pending"' . ($item['status'] == 'Pending' ? ' selected' : '') . '>Pending</option>
                                                <option value="Approved"' . ($item['status'] == 'Approved' ? ' selected' : '') . '>Approved</option>
                                                <option value="Rejected"' . ($item['status'] == 'Rejected' ? ' selected' : '') . '>Rejected</option>
                                                <option value="Lost"' . ($item['status'] == 'Lost' ? ' selected' : '') . '>Lost</option>
                                                <option value="Found"' . ($item['status'] == 'Found' ? ' selected' : '') . '>Found</option>
                                                <option value="Claimed"' . ($item['status'] == 'Claimed' ? ' selected' : '') . '>Claimed</option>
                                            </select>
                                            <button type="submit" name="update_status" class="btn btn-sm btn-primary">Update</button>
                                        </form>
                                        <a href="edit-item.php?id=' . $item['id'] . '" class="btn btn-sm btn-warning">Edit</a>
                                        <a href="delete-item.php?id=' . $item['id'] . '" class="btn btn-sm btn-danger">Delete</a>
                                    </td>
                                </tr>';
                            }
                        } else {
                            echo '<tr><td colspan="6">No found items available.</td></tr>';
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </section>
    </main>
</body>
</html>

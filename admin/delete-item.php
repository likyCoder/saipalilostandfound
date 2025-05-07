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

// Get the item ID from the URL
$item_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if ($item_id > 0) {
    // Prepare and execute the delete statement
    $stmt = $conn->prepare("DELETE FROM items WHERE id = ?");
    $stmt->bind_param("i", $item_id);
    if ($stmt->execute()) {
        $message = '<div class="alert alert-success">Item deleted successfully.</div>';
    } else {
        $message = '<div class="alert alert-danger">Error deleting item: ' . $stmt->error . '</div>';
    }
    $stmt->close();
} else {
    $message = '<div class="alert alert-danger">Invalid item ID.</div>';
}

// Close the database connection
$conn->close();

// Redirect back to the admin dashboard with a message
header('Location: admin-dashboard.php?message=' . urlencode($message));
exit();

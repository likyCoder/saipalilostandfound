<?php
include '../config.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Delete user
    $sql = "DELETE FROM users WHERE id=$id";
    
    if ($conn->query($sql) === TRUE) {
        echo "User deleted successfully.";
    } else {
        echo "Error: " . $conn->error;
    }
}
?>

<?php
include '../config.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Update item status to Rejected
    $sql = "UPDATE items SET status='Rejected' WHERE id=$id";
    
    if ($conn->query($sql) === TRUE) {
        echo "Item rejected successfully.";
    } else {
        echo "Error: " . $conn->error;
    }
}
?>

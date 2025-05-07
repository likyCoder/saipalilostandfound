<?php
include '../config.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Update claim status to Rejected
    $sql = "UPDATE claims SET status='Rejected' WHERE id=$id";
    
    if ($conn->query($sql) === TRUE) {
        echo "Claim rejected successfully.";
    } else {
        echo "Error: " . $conn->error;
    }
}
?>

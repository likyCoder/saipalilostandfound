<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name']);
    $contactInfo = trim($_POST['contact_info']);
    $message = trim($_POST['message']);
    $proof = $_FILES['proof'];

    if (empty($name) || empty($contactInfo) || empty($message)) {
        echo "All required fields must be filled out.";
        exit;
    }

    // Handle file upload if provided
    if ($proof['error'] === UPLOAD_ERR_OK) {
        $uploadDir = 'uploads/';
        $uploadFile = $uploadDir . basename($proof['name']);
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }
        if (move_uploaded_file($proof['tmp_name'], $uploadFile)) {
            echo "File uploaded successfully.<br>";
        } else {
            echo "Failed to upload file.<br>";
        }
    }

    // Process the claim (e.g., save to database)
    echo "Claim submitted successfully. Name: $name, Contact Info: $contactInfo, Message: $message";
} else {
    echo "Invalid request method.";
}
?>

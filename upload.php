<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $targetDir = "images/";
    $file = $_FILES["image"];

    $allowedTypes = ['image/jpeg', 'image/png', 'image/jpg'];
    $maxSize = 5 * 1024 * 1024;

    if ($file['error'] === UPLOAD_ERR_OK) {
        if (in_array($file['type'], $allowedTypes) && $file['size'] <= $maxSize) {
            $ext = pathinfo($file['name'], PATHINFO_EXTENSION);
            $newName = uniqid() . "." . $ext;
            move_uploaded_file($file['tmp_name'], $targetDir . $newName);
            header("Location: index.php");
            exit();
        } else {
            echo "Invalid file type or size.";
        }
    } else {
        echo "File upload error.";
    }
} else {
    echo "Invalid request.";
}

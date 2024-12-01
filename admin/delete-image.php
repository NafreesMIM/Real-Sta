<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}

require '../config.php';

$id = $_GET['id'];

// Retrieve the current image URL
$sql = "SELECT image_url FROM properties WHERE id = '$id'";
$result = $conn->query($sql);
$property = $result->fetch_assoc();

if ($property['image_url']) {
    // Delete the image file from the server
    $image_path = '../uploads/' . $property['image_url'];
    if (file_exists($image_path)) {
        unlink($image_path);
    }

    // Update the database to remove the image URL
    $query = "UPDATE properties SET image_url=NULL WHERE id='$id'";
    if ($conn->query($query) === TRUE) {
        header("Location: edit-property.php?id=$id");
        exit;
    } else {
        echo "Error: " . $conn->error;
    }
}
?>

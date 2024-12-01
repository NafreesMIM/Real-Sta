<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}

require '../config.php';

$id = $_GET['id'];

$sql = "DELETE FROM properties WHERE id = '$id'";
if ($conn->query($sql) === TRUE) {
    header("Location: manage-properties.php");
    exit;
} else {
    echo "Error: " . $conn->error;
}
?>

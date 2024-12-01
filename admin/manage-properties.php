<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}

require '../config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $price = $_POST['price'];
    $location = $_POST['location'];
    $bedrooms = $_POST['bedrooms'];
    $bathrooms = $_POST['bathrooms'];
    $description = $_POST['description'];
    $property_type = $_POST['property_type'];

    // Insert property data into the database
    $query = "INSERT INTO properties (title, price, location, bedrooms, bathrooms, description, property_type) 
              VALUES ('$title', '$price', '$location', '$bedrooms', '$bathrooms', '$description', '$property_type')";
    if ($conn->query($query) === TRUE) {
        $property_id = $conn->insert_id;  // Get the property ID for saving images

        // Handle image uploads
        if (isset($_FILES['images']) && count($_FILES['images']['name']) > 0) {
            $target_dir = "../assets/images/properties/";
            foreach ($_FILES['images']['name'] as $key => $image_name) {
                $image_tmp = $_FILES['images']['tmp_name'][$key];
                $image_path = $target_dir . basename($image_name);

                // Move the uploaded image to the target directory
                if (move_uploaded_file($image_tmp, $image_path)) {
                    // Insert image path into the property_images table
                    $sql_image = "INSERT INTO property_images (property_id, image_path) VALUES ('$property_id', '$image_path')";
                    $conn->query($sql_image);
                }
            }
        }

        echo "Property added successfully!";
    } else {
        echo "Error: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Property - Manage Properties</title>
    <link rel="stylesheet" href="../assets/css/styles.css">
</head>
<body>
    <header>
        <h1>Manage Properties</h1>
        <nav>
            <a href="dashboard.php">Dashboard</a>
            <a href="logout.php">Logout</a>
        </nav>
    </header>

    <section class="property-form">
        <h2>Add Property</h2>
        <form method="POST" action="add-property.php" enctype="multipart/form-data">
            <label for="title">Property Title:</label>
            <input type="text" name="title" id="title" required><br><br>

            <label for="price">Price:</label>
            <input type="number" name="price" id="price" required><br><br>

            <label for="location">Location:</label>
            <input type="text" name="location" id="location" required><br><br>

            <label for="bedrooms">Bedrooms:</label>
            <input type="number" name="bedrooms" id="bedrooms" required><br><br>

            <label for="bathrooms">Bathrooms:</label>
            <input type="number" name="bathrooms" id="bathrooms" required><br><br>

            <label for="description">Description:</label>
            <textarea name="description" id="description" required></textarea><br><br>

            <label for="property_type">Property Type:</label>
            <select name="property_type" id="property_type" required>
                <option value="Sale">Sale</option>
                <option value="Rent">Rent</option>
            </select><br><br>

            <label for="images">Property Images (Select multiple):</label>
            <input type="file" name="images[]" id="images" multiple><br><br>

            <button type="submit">Add Property</button>
        </form>
    </section>
</body>
</html>

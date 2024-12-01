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

    // Insert property data into the properties table
    $query = "INSERT INTO properties (title, price, location, bedrooms, bathrooms, description, property_type) 
              VALUES ('$title', '$price', '$location', '$bedrooms', '$bathrooms', '$description', '$property_type')";
    if ($conn->query($query) === TRUE) {
        $property_id = $conn->insert_id; // Get the property ID for image insertion
    
        // Handle image uploads
        if (isset($_FILES['images']) && count($_FILES['images']['name']) > 0) {
            $target_dir = "../assets/images/properties/"; // Directory to store images
    
            // Loop through each uploaded image
            foreach ($_FILES['images']['name'] as $key => $image_name) {
                $image_tmp = $_FILES['images']['tmp_name'][$key]; // Get the temporary file path
                $image_path = $target_dir . basename($image_name); // Define the target path
    
                // Move the uploaded image to the target directory
                if (move_uploaded_file($image_tmp, $image_path)) {
                    // Insert the image path into the property_images table
                    $sql_image = "INSERT INTO property_images (property_id, image_path) VALUES ('$property_id', '$image_path')";
                    if ($conn->query($sql_image) !== TRUE) {
                        echo "Error: " . $conn->error;
                    }
                }
            }
        }
    
        // Redirect to manage-properties.php after success
        header("Location: manage-properties.php");
        exit; // Make sure no further code is executed
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
    <title>Add Property</title>
    <link rel="stylesheet" href="../assets/css/styles.css">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <div class="dashboard-container">
        <header class="dashboard-header">
            <h1><i class="fas fa-plus-circle"></i> Add Property</h1>
            <nav class="dashboard-nav">
                <a href="dashboard.php"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
                <a href="manage-properties.php"><i class="fas fa-list-ul"></i> Manage Properties</a>
                <a href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
            </nav>
        </header>

        <section class="property-form">
            <h2><i class="fas fa-home"></i> Property Details</h2>
            <form method="POST" action="add-property.php" enctype="multipart/form-data">
                <label for="title"><i class="fas fa-pen"></i> Property Title:</label>
                <input type="text" name="title" id="title" required><br><br>

                <label for="price"><i class="fas fa-dollar-sign"></i> Price (LKR):</label>
                <input type="number" name="price" id="price" required><br><br>

                <label for="location"><i class="fas fa-map-marker-alt"></i> Location:</label>
                <input type="text" name="location" id="location" required><br><br>

                <label for="bedrooms"><i class="fas fa-bed"></i> Bedrooms:</label>
                <input type="number" name="bedrooms" id="bedrooms" required><br><br>

                <label for="bathrooms"><i class="fas fa-bath"></i> Bathrooms:</label>
                <input type="number" name="bathrooms" id="bathrooms" required><br><br>

                <label for="description"><i class="fas fa-info-circle"></i> Description:</label>
                <textarea name="description" id="description" required></textarea><br><br>

                <label for="property_type"><i class="fas fa-tag"></i> Property Type:</label>
                <select name="property_type" id="property_type">
                    <option value="Sale">Sale</option>
                    <option value="Rent">Rent</option>
                </select><br><br>

                <label for="images"><i class="fas fa-images"></i> Property Images:</label>
                <input type="file" name="images[]" multiple><br><br>

                <button type="submit"><i class="fas fa-save"></i> Add Property</button>
            </form>
        </section>
    </div>
</body>
<style>
    /* General Body Styles */
body {
    font-family: 'Arial', sans-serif;
    background-color: #f4f7fc;
    margin: 0;
    padding: 0;
}

/* Dashboard Container */
.dashboard-container {
    display: flex;
    flex-direction: column;
    align-items: center;
    padding: 30px;
}

/* Header Styles */
.dashboard-header {
    width: 100%;
    background-color: #007bff;
    color: white;
    padding: 20px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    border-radius: 8px 8px 0 0;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

.dashboard-header h1 {
    font-size: 2em;
    margin: 0;
}

.dashboard-nav {
    display: flex;
    gap: 20px;
}

.dashboard-nav a {
    color: white;
    text-decoration: none;
    font-size: 1.2em;
    transition: color 0.3s ease;
}

.dashboard-nav a:hover {
    color: #0056b3;
}

.dashboard-nav a i {
    margin-right: 8px;
}

/* Content Styles */
.property-form {
    background-color: white;
    padding: 20px;
    margin-top: 20px;
    width: 100%;
    max-width: 600px; /* Reduced the max width */
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    text-align: center;
}

.property-form h2 {
    font-size: 1.8em; /* Slightly smaller font size */
    color: #333;
    margin-bottom: 20px;
}

.property-form label {
    font-weight: bold;
    display: block;
    margin-bottom: 8px;
    text-align: left;
}

.property-form input, .property-form select, .property-form textarea {
    width: 100%;
    padding: 10px;
    border-radius: 5px;
    border: 1px solid #ddd;
    margin-bottom: 15px;
    font-size: 1em;
}

.property-form button {
    background-color: #007bff;
    color: white;
    padding: 10px 20px;
    border-radius: 5px;
    font-size: 1.1em;
    width: 100%;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.property-form button:hover {
    background-color: #0056b3;
}

.property-form i {
    margin-right: 8px;
}

/* Responsive Design */
@media (max-width: 768px) {
    .dashboard-header {
        flex-direction: column;
        align-items: center;
    }

    .dashboard-nav {
        flex-direction: column;
        gap: 10px;
        align-items: center;
    }

    .property-form {
        width: 90%;
        padding: 20px;
    }
}

</style>
</html>

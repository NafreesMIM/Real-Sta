<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}

require '../config.php';

$id = $_GET['id'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $price = $_POST['price'];
    $location = $_POST['location'];
    $bedrooms = $_POST['bedrooms'];
    $bathrooms = $_POST['bathrooms'];
    $description = $_POST['description'];
    $property_type = $_POST['property_type'];

    $query = "UPDATE properties SET title='$title', price='$price', location='$location', 
              bedrooms='$bedrooms', bathrooms='$bathrooms', description='$description', 
              property_type='$property_type' WHERE id='$id'";

    if ($conn->query($query) === TRUE) {
        // Redirect to manage-properties.php after successful update
        header("Location: manage-properties.php");
        exit;
    } else {
        echo "Error: " . $conn->error;
    }
}

// Fetch property data for editing
$sql = "SELECT * FROM properties WHERE id = '$id'";
$result = $conn->query($sql);
$property = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Property</title>
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="../assets/css/styles.css">
    <style>
        /* General Body Styles */
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f7f9fc;
            margin: 0;
            padding: 0;
        }

        /* Header */
        header {
            background-color: #007bff;
            color: white;
            padding: 20px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-radius: 8px 8px 0 0;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        header h1 {
            font-size: 2rem;
            margin: 0;
        }

        nav a {
            color: white;
            text-decoration: none;
            font-size: 1.2rem;
            margin-left: 20px;
            transition: color 0.3s ease;
        }

        nav a:hover {
            color: #f8f8f8;
        }

        /* Property Form */
        .property-form {
            background-color: white;
            padding: 30px;
            margin: 30px auto;
            max-width: 700px;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .property-form h2 {
            font-size: 1.8rem;
            color: #333;
            margin-bottom: 20px;
            text-align: center;
        }

        .property-form label {
            font-weight: bold;
            display: block;
            margin-bottom: 8px;
            color: #555;
        }

        .property-form input, .property-form select, .property-form textarea {
            width: 100%;
            padding: 12px;
            border-radius: 8px;
            border: 1px solid #ccc;
            margin-bottom: 20px;
            font-size: 1rem;
            box-sizing: border-box;
        }

        .property-form button {
            background-color: #007bff;
            color: white;
            padding: 12px 20px;
            border-radius: 8px;
            font-size: 1.1rem;
            cursor: pointer;
            border: none;
            transition: background-color 0.3s ease;
            width: 100%;
        }

        .property-form button:hover {
            background-color: #0056b3;
        }

        .property-form .icon {
            margin-right: 10px;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .property-form {
                width: 90%;
                padding: 20px;
            }

            header {
                flex-direction: column;
                text-align: center;
            }

            nav {
                display: flex;
                flex-direction: column;
                gap: 10px;
                align-items: center;
            }
        }
    </style>
</head>
<body>

<header>
    <h1><i class="fas fa-edit"></i> Edit Property</h1>
    <nav>
        <a href="dashboard.php"><i class="fas fa-tachometer-alt icon"></i> Dashboard</a>
        <a href="manage-properties.php"><i class="fas fa-list-ul icon"></i> Manage Properties</a>
        <a href="logout.php"><i class="fas fa-sign-out-alt icon"></i> Logout</a>
    </nav>
</header>

<section class="property-form">
    <h2><i class="fas fa-home"></i> Property Details</h2>
    <form method="POST" action="edit-property.php?id=<?php echo $id; ?>">
        <label for="title"><i class="fas fa-pen icon"></i> Property Title:</label>
        <input type="text" name="title" id="title" value="<?php echo $property['title']; ?>" required><br>

        <label for="price"><i class="fas fa-dollar-sign icon"></i> Price:</label>
        <input type="number" name="price" id="price" value="<?php echo $property['price']; ?>" required><br>

        <label for="location"><i class="fas fa-map-marker-alt icon"></i> Location:</label>
        <input type="text" name="location" id="location" value="<?php echo $property['location']; ?>" required><br>

        <label for="bedrooms"><i class="fas fa-bed icon"></i> Bedrooms:</label>
        <input type="number" name="bedrooms" id="bedrooms" value="<?php echo $property['bedrooms']; ?>" required><br>

        <label for="bathrooms"><i class="fas fa-bath icon"></i> Bathrooms:</label>
        <input type="number" name="bathrooms" id="bathrooms" value="<?php echo $property['bathrooms']; ?>" required><br>

        <label for="description"><i class="fas fa-info-circle icon"></i> Description:</label>
        <textarea name="description" id="description" required><?php echo $property['description']; ?></textarea><br>

        <label for="property_type"><i class="fas fa-tags icon"></i> Property Type:</label>
        <select name="property_type" id="property_type" required>
            <option value="Sale" <?php if ($property['property_type'] == 'Sale') echo 'selected'; ?>>Sale</option>
            <option value="Rent" <?php if ($property['property_type'] == 'Rent') echo 'selected'; ?>>Rent</option>
        </select><br>

        <button type="submit"><i class="fas fa-save icon"></i> Update Property</button>
    </form>
</section>

</body>
</html>

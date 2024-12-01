<?php
// Include the configuration file to connect to the database
require '../config.php';  // Correct the path

// Retrieve property ID from URL parameter
if (isset($_GET['id'])) {
    $property_id = $_GET['id'];

    // Fetch property details from the database
    $query = "SELECT * FROM properties WHERE id = '$property_id'";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        $property = $result->fetch_assoc();
    } else {
        echo "Property not found.";
        exit;
    }

    // Fetch property images
    $query_images = "SELECT * FROM property_images WHERE property_id = '$property_id'";
    $images_result = $conn->query($query_images);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Property</title>
    <link rel="stylesheet" href="../assets/css/styles.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
        }

        header {
            background-color: #007bff;
            color: white;
            padding: 15px;
            text-align: center;
        }

        header h1 {
            margin: 0;
            font-size: 2em;
        }

        nav a {
            color: white;
            text-decoration: none;
            margin: 0 15px;
            font-size: 1.1em;
        }

        nav a:hover {
            text-decoration: underline;
        }

        .property-details {
            max-width: 1200px;
            margin: 30px auto;
            padding: 20px;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .property-details h2 {
            font-size: 2em;
            color: #333;
            margin-bottom: 20px;
        }

        .property-details p {
            font-size: 1.2em;
            line-height: 1.6;
            color: #555;
            margin: 10px 0;
        }

        .property-details p strong {
            color: #333;
        }

        .property-images {
            margin-top: 30px;
        }

        .property-images h3 {
            font-size: 1.6em;
            color: #333;
        }

        .property-images img {
            margin: 10px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease-in-out;
            width: 100%;
            max-width: 400px;
        }

        .property-images img:hover {
            transform: scale(1.05);
        }

        .property-images p {
            color: #888;
            font-size: 1.1em;
        }

        @media screen and (max-width: 768px) {
            .property-details {
                margin: 10px;
                padding: 15px;
            }

            .property-details h2 {
                font-size: 1.8em;
            }

            .property-details p {
                font-size: 1em;
            }

            .property-images img {
                width: 100%;
                max-width: 100%;
            }
        }
    </style>
</head>
<body>
    <header>
        <h1>Property Details</h1>
        <nav>
            <a href="../index.php">Home</a>
        </nav>
    </header>

    <section class="property-details">
        <?php if (isset($property)) { ?>
            <h2><?php echo $property['title']; ?></h2>
            <p><strong>Price:</strong> $<?php echo number_format($property['price']); ?></p>
            <p><strong>Location:</strong> <?php echo $property['location']; ?></p>
            <p><strong>Bedrooms:</strong> <?php echo $property['bedrooms']; ?></p>
            <p><strong>Bathrooms:</strong> <?php echo $property['bathrooms']; ?></p>
            <p><strong>Description:</strong> <?php echo nl2br($property['description']); ?></p>
            <p><strong>Property Type:</strong> <?php echo $property['property_type']; ?></p>

            <div class="property-images">
                <h3>Images</h3>
                <?php if ($images_result->num_rows > 0) { ?>
                    <?php while ($image = $images_result->fetch_assoc()) { ?>
                        <img src="<?php echo $image['image_path']; ?>" alt="Property Image">
                    <?php } ?>
                <?php } else { ?>
                    <p>No images available for this property.</p>
                <?php } ?>
            </div>
        <?php } else { ?>
            <p>Property not found.</p>
        <?php } ?>
    </section>
</body>
</html>

<?php
$conn->close();  // Close the database connection
?>

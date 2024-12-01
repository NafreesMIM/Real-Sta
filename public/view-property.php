<?php
require '../config.php'; 

if (isset($_GET['id'])) {
    $property_id = $_GET['id'];

    $query = "SELECT * FROM properties WHERE id = '$property_id'";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        $property = $result->fetch_assoc();
    } else {
        echo "Property not found.";
        exit;
    }

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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
        }

        header {
            background-color: #007bff;
            color: white;
            padding: 20px;
            text-align: center;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        header h1 {
            margin: 0;
            font-size: 2.5em;
        }

        nav a {
            color: white;
            text-decoration: none;
            margin: 0 15px;
            font-size: 1.2em;
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
            font-size: 2.2em;
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

        .property-details p i {
            margin-right: 8px;
            color: #007bff;
        }

        .property-images {
            margin-top: 30px;
        }

        .property-images h3 {
            font-size: 1.8em;
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

        .property-back-button {
            margin: 20px 0;
            display: inline-block;
            padding: 10px 20px;
            background-color: #28a745;
            color: white;
            border-radius: 4px;
            text-decoration: none;
            font-size: 1.1em;
            transition: background-color 0.3s ease;
        }

        .property-back-button i {
            margin-right: 8px;
        }

        .property-back-button:hover {
            background-color: #218838;
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
            <a href="../index.php"><i class="fas fa-home"></i> Home</a>
        </nav>
    </header>

    <section class="property-details">
        <?php if (isset($property)) { ?>
            <h2><?php echo $property['title']; ?></h2>
            <p><i class="fas fa-tag"></i><strong> Price:</strong> LKR <?php echo number_format($property['price']); ?></p>
            <p><i class="fas fa-map-marker-alt"></i><strong> Location:</strong> <?php echo $property['location']; ?></p>
            <p><i class="fas fa-bed"></i><strong> Bedrooms:</strong> <?php echo $property['bedrooms']; ?></p>
            <p><i class="fas fa-bath"></i><strong> Bathrooms:</strong> <?php echo $property['bathrooms']; ?></p>
            <p><i class="fas fa-info-circle"></i><strong> Description:</strong> <?php echo nl2br($property['description']); ?></p>
            <p><i class="fas fa-home"></i><strong> Property Type:</strong> <?php echo $property['property_type']; ?></p>

            <div class="property-images">
                <h3><i class="fas fa-images"></i> Images</h3>
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

        <!-- Back Button -->
        <a href="javascript:history.back()" class="property-back-button">
            <i class="fas fa-arrow-left"></i> Back to Property List
        </a>
    </section>

</body>

<?php include '../footer.php'; ?>

</html>

<?php
$conn->close(); 
?>

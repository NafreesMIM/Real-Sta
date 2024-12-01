<?php
require 'config.php';

$sql = "SELECT * FROM properties";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php include 'header.php'; ?>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
        }

        .property-list {
            max-width: 1200px;
            margin: 30px auto;
            padding: 20px;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .property-cards {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 20px;
            margin-top: 20px;
        }

        .property-card {
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
            transition: transform 0.3s;
        }

        .property-card:hover {
            transform: translateY(-5px);
        }

        .property-card img {
            width: 100%;
            height: 200px;
            object-fit: cover;
            border-radius: 8px;
            margin-bottom: 15px;
        }

        .property-card h3 {
            font-size: 1.5em;
            color: #333;
            margin: 10px 0;
        }

        .property-card p {
            color: #555;
            margin: 5px 0;
        }

        .property-card p i {
            color: #007bff;
        }

        .property-card .btn {
            background-color: #007bff;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            text-decoration: none;
            display: inline-block;
            margin-top: 10px;
            transition: background-color 0.3s;
        }

        .property-card .btn i {
            margin-right: 5px;
        }

        .property-card .btn:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>

    <section class="property-list">
        <h2>Available Properties</h2>

        <div class="property-cards">
            <?php
            while ($property = $result->fetch_assoc()) {
                $property_id = $property['id']; // 

                $query_images = "SELECT * FROM property_images WHERE property_id = '$property_id'";
                $images_result = $conn->query($query_images);

                if ($images_result && $images_result->num_rows > 0) {
                    $image = $images_result->fetch_assoc();
                    $imagePath = $image['image_path'];  
                } else {
                    $imagePath = 'assets/images/properties/default.jpg';  /
                }

                echo "<div class='property-card'>
                        <img src='{$imagePath}' alt='{$property['title']}'>
                        <h3>{$property['title']}</h3>
                        <p><i class='fas fa-money-bill-wave'></i> LKR " . number_format($property['price'], 2) . "</p>
                        <p><i class='fas fa-map-marker-alt'></i> {$property['location']}</p>
                        <p><i class='fas fa-bed'></i> {$property['bedrooms']} | <i class='fas fa-bath'></i> {$property['bathrooms']}</p>
                        <p><i class='fas fa-home'></i> {$property['property_type']}</p>
                        <a href='public/view-property.php?id={$property['id']}' class='btn'><i class='fas fa-info-circle'></i> View Details</a>
                    </div>";
            }
            ?>
        </div>
    </section>

    <?php include 'footer.php'; ?>

</body>
</html>

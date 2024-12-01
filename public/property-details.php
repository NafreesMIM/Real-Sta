<?php
require '../config.php';

$id = $_GET['id'];
$query = "SELECT * FROM properties WHERE id = $id";
$result = $conn->query($query);
$property = $result->fetch_assoc();

$imageQuery = "SELECT * FROM property_images WHERE property_id = $id";
$imageResult = $conn->query($imageQuery);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title><?php echo $property['title']; ?></title>
    <link rel="stylesheet" href="../assets/css/styles.css">
</head>
<body>
    <header>
        <h1>Property Details</h1>
        <nav>
            <a href="index.php">Home</a>
            <a href="#contact">Contact</a>
        </nav>
    </header>

    <section>
        <h2><?php echo $property['title']; ?></h2>
        <p><?php echo $property['description']; ?></p>
        <p>Price: $<?php echo $property['price']; ?></p>
        <p>Location: <?php echo $property['location']; ?></p>
        <p>Bedrooms: <?php echo $property['bedrooms']; ?></p>
        <p>Bathrooms: <?php echo $property['bathrooms']; ?></p>

        <h3>Gallery</h3>
        <div class="gallery">
            <?php while ($image = $imageResult->fetch_assoc()): ?>
                <img src="<?php echo $image['image_path']; ?>" alt="Property Image">
            <?php endwhile; ?>
        </div>
    </section>

    <footer id="contact">
        <p>Contact Us: 123-456-7890 | info@realestate.com</p>
        <p>© 2024 Real Estate Website. All rights reserved.</p>
    </footer>
</body>
</html>

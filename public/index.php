<?php
require '../config.php';

$query = "SELECT * FROM properties";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Real Estate Listings</title>
    <link rel="stylesheet" href="../assets/css/styles.css">
</head>
<body>
    <header>
        <h1>Real Estate Listings</h1>
        <nav>
            <a href="index.php">Home</a>
            <a href="#contact">Contact</a>
        </nav>
    </header>

    <section class="property-list">
        <h2>Available Properties</h2>
        <div class="grid-container">
            <?php while ($property = $result->fetch_assoc()): ?>
                <div class="property-card">
                    <h3><?php echo $property['title']; ?></h3>
                    <p>Price: $<?php echo $property['price']; ?></p>
                    <p>Location: <?php echo $property['location']; ?></p>
                    <p>Bedrooms: <?php echo $property['bedrooms']; ?></p>
                    <a href="property-details.php?id=<?php echo $property['id']; ?>" class="btn">View Details</a>
                </div>
            <?php endwhile; ?>
        </div>
    </section>

    <footer id="contact">
        <p>Contact Us: 123-456-7890 | info@realestate.com</p>
        <p>© 2024 Real Estate Website. All rights reserved.</p>
    </footer>
</body>
</html>

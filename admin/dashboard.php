<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}

require '../config.php';

$query = "SELECT * FROM properties";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="../assets/css/styles.css">
</head>
<body>
    <header>
        <h1>Admin Dashboard</h1>
        <nav>
            <a href="manage-properties.php">Manage Properties</a>
            <a href="logout.php">Logout</a>
        </nav>
    </header>

    <section class="property-list">
        <h2>Properties</h2>
        <div class="grid-container">
            <?php while ($property = $result->fetch_assoc()): ?>
                <div class="property-card">
                    <h3><?php echo $property['title']; ?></h3>
                    <p>Price: $<?php echo $property['price']; ?></p>
                    <p>Location: <?php echo $property['location']; ?></p>
                    <p>Bedrooms: <?php echo $property['bedrooms']; ?></p>
                    <a href="edit-property.php?id=<?php echo $property['id']; ?>" class="btn">Edit</a>
                    <a href="delete-property.php?id=<?php echo $property['id']; ?>" class="btn">Delete</a>
                </div>
            <?php endwhile; ?>
        </div>
    </section>
</body>
</html>

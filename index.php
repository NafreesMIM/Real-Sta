<?php
require 'config.php';
$sql = "SELECT * FROM properties";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php include 'header.php'; ?>
</head>
<body>

    <section class="property-list">
        <h2>Available Properties</h2>

        <!-- Search Bar -->
        <div class="search-bar">
            <form method="GET" action="index.php">
                <input type="text" name="search" placeholder="Search by location or title" />
                <select name="property_type">
                    <option value="">Select Property Type</option>
                    <option value="Sale">Sale</option>
                    <option value="Rent">Rent</option>
                </select>
                <button type="submit">Search</button>
            </form>
        </div>

        <!-- Property Cards Section -->
        <div class="property-cards">
            <?php
            // Handle search query
            if (isset($_GET['search']) || isset($_GET['property_type'])) {
                $search = $_GET['search'] ?? '';
                $type = $_GET['property_type'] ?? '';

                $sql .= " WHERE (title LIKE '%$search%' OR location LIKE '%$search%')";
                if (!empty($type)) {
                    $sql .= " AND property_type = '$type'";
                }
            }
            $result = $conn->query($sql);

            while ($property = $result->fetch_assoc()) {
                // Check if image exists in the database and if not, set a default image
                $imagePath = !empty($property['image']) ? '/assets/images/properties/' . $property['image'] : '/assets/images/properties/default.jpg';
                
                echo "<div class='property-card'>
                        <img src='{$imagePath}' alt='{$property['title']}'>
                        <h3>{$property['title']}</h3>
                        <p><strong>Price:</strong> LKR " . number_format($property['price'], 2) . "</p>
                        <p><strong>Location:</strong> {$property['location']}</p>
                        <p><strong>Bedrooms:</strong> {$property['bedrooms']} | <strong>Bathrooms:</strong> {$property['bathrooms']}</p>
                        <p><strong>Type:</strong> {$property['property_type']}</p>
                        <a href='public/view-property.php?id={$property['id']}' class='btn'>View Details</a>
                    </div>";
            }
            ?>
        </div>
    </section>

    <?php include 'footer.php'; ?>

</body>
<style>
    /* General Styles */
    body {
        font-family: 'Arial', sans-serif;
        margin: 0;
        padding: 0;
        background-color: #f4f4f9;
    }

    /* Property Listing Section */
    .property-list {
        max-width: 1200px;
        margin: 30px auto;
        padding: 20px;
        background-color: white;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .property-list h2 {
        font-size: 2.5em;
        margin-bottom: 20px;
        text-align: center;
        color: #333;
    }

    /* Search Bar */
    .search-bar {
        margin: 20px auto;
        text-align: center;
        padding: 10px;
        background-color: #fff;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        width: 80%;
        max-width: 800px;
    }

    .search-bar form {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .search-bar input,
    .search-bar select {
        padding: 10px;
        font-size: 1em;
        border-radius: 4px;
        border: 1px solid #ccc;
        width: 48%;
    }

    .search-bar button {
        padding: 10px 20px;
        font-size: 1.1em;
        background-color: #007bff;
        color: white;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }

    .search-bar button:hover {
        background-color: #0056b3;
    }

    /* Property Cards */
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

    .property-card .btn {
        background-color: #007bff;
        color: white;
        padding: 10px 20px;
        border: none;
        border-radius: 4px;
        text-decoration: none;
        display: inline-block;
        margin-top: 10px;
    }

    .property-card .btn:hover {
        background-color: #0056b3;
    }

    /* Mobile responsiveness */
    @media (max-width: 768px) {
        .search-bar form {
            flex-direction: column;
            align-items: stretch;
        }

        .search-bar input,
        .search-bar select,
        .search-bar button {
            width: 100%;
            margin-bottom: 10px;
        }

        .property-cards {
            grid-template-columns: 1fr;
        }
    }

    /* Fallback Image Styles */
    .property-card img {
        object-fit: cover;
        height: 200px;
        width: 100%;
        border-radius: 8px;
    }
</style>
</html>

<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}

require '../config.php';

// Fetch all properties from the database
$sql = "SELECT * FROM properties";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Properties</title>
    <link rel="stylesheet" href="../assets/css/styles.css">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <div class="dashboard-container">
        <header class="dashboard-header">
            <h1><i class="fas fa-home"></i> Manage Properties</h1>
            <nav class="dashboard-nav">
                <a href="dashboard.php"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
                <a href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
            </nav>
        </header>

        <section class="dashboard-content">
            <h2><i class="fas fa-list-ul"></i> All Properties</h2>
            <a href="add-property.php" class="btn"><i class="fas fa-plus-circle"></i> Add New Property</a>
            <table class="property-table">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Price</th>
                        <th>Location</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $result->fetch_assoc()) { ?>
                        <tr>
                            <td><?php echo $row['title']; ?></td>
                            <td><?php echo $row['price']; ?></td>
                            <td><?php echo $row['location']; ?></td>
                            <td>
                                <a href="edit-property.php?id=<?php echo $row['id']; ?>" class="edit-btn"><i class="fas fa-edit"></i> Edit</a>
                                <a href="delete-property.php?id=<?php echo $row['id']; ?>" class="delete-btn" onclick="return confirm('Are you sure?')"><i class="fas fa-trash-alt"></i> Delete</a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
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
.dashboard-content {
    background-color: white;
    padding: 30px;
    margin-top: 20px;
    width: 100%;
    max-width: 1000px;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    text-align: center;
}

.dashboard-content h2 {
    font-size: 2em;
    color: #333;
    margin-bottom: 20px;
}

.dashboard-content .btn {
    background-color: #007bff;
    color: white;
    padding: 10px 20px;
    border-radius: 5px;
    text-decoration: none;
    font-size: 1.1em;
    margin-bottom: 20px;
    display: inline-block;
    transition: background-color 0.3s ease;
}

.dashboard-content .btn:hover {
    background-color: #0056b3;
}

.property-table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
}

.property-table th, .property-table td {
    padding: 12px;
    text-align: left;
    border: 1px solid #ddd;
}

.property-table th {
    background-color: #007bff;
    color: white;
}

.property-table tr:hover {
    background-color: #f1f1f1;
}

.property-table a {
    text-decoration: none;
    color: #007bff;
    font-weight: bold;
    padding: 5px;
    border-radius: 4px;
}

.property-table a.edit-btn:hover {
    background-color: #e0e0e0;
}

.property-table a.delete-btn:hover {
    background-color: #f2d1d1;
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

    .dashboard-nav a {
        font-size: 1.1em;
    }

    .dashboard-content {
        width: 90%;
        padding: 20px;
    }

    .property-table th, .property-table td {
        padding: 8px;
    }
}

</style>
</html>

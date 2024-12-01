<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="../assets/css/styles.css">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <div class="dashboard-container">
        <header class="dashboard-header">
            <h1><i class="fas fa-tachometer-alt"></i> Admin Dashboard</h1>
            <nav class="dashboard-nav">
                <a href="manage-properties.php"><i class="fas fa-cogs"></i> Manage Properties</a>
                <a href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
            </nav>
        </header>

        <section class="dashboard-content">
            <h2>Welcome, Admin!</h2>
            <p><i class="fas fa-info-circle"></i> You can manage properties, users, and settings from here.</p>
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

.dashboard-content p {
    font-size: 1.2em;
    color: #555;
    margin-bottom: 20px;
}

.dashboard-content i {
    color: #007bff;
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
}

</style>
</html>

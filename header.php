<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NN Real Estate</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>

<header>
    <div class="logo-container">
        <img src="LOGO.jpeg" alt="NN Real Estate Logo" class="logo-image">
    </div>
    <nav>
        <a href="index.php"><i class="fas fa-home"></i> Home</a>
        <a href="contact.php"><i class="fas fa-envelope"></i> Contact Us</a>
        <a href="admin/login.php"><i class="fas fa-user-lock"></i> Admin Login</a>
    </nav>
</header>

<style>
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
        background-color: #f4f4f9;
    }

    header {
        background-color: #0D6EFD;
        color: white;
        padding: 20px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .logo-container {
        display: flex;
        align-items: center;
    }

    .logo-image {
        height: 90px; 
        width: auto;  
    }

    nav {
        display: flex;
        gap: 20px;
    }

    nav a {
        color: white;
        text-decoration: none;
        font-size: 1.2em;
        transition: color 0.3s ease, transform 0.2s;
        display: flex;
        align-items: center;
    }

    nav a i {
        margin-right: 8px;
    }

    nav a:hover {
        color: #ff7f50;
        transform: scale(1.1);
    }

    @media (max-width: 768px) {
        header {
            flex-direction: column;
            text-align: center;
        }

        nav {
            flex-direction: column;
            gap: 10px;
            margin-top: 15px;
        }

        nav a {
            margin: 5px 0;
        }
    }
</style>

</body>
</html>

<?php
session_start();
if (isset($_SESSION['admin'])) {
    header("Location: dashboard.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    require '../config.php';

    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM admins WHERE username = '$username' AND password = '$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $_SESSION['admin'] = $username;
        header("Location: dashboard.php");
    } else {
        $error = "Invalid username or password!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link rel="stylesheet" href="../assets/css/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <div class="login-container">
        <div class="login-form">
            <h2><i class="fas fa-user-lock"></i> Admin Login</h2>
            <?php if (isset($error)) echo "<p class='error'>$error</p>"; ?>
            <form method="POST" action="login.php">
                <div class="input-group">
                    <i class="fas fa-user"></i>
                    <input type="text" name="username" id="username" required placeholder="Enter your username" autofocus>
                </div>
                <div class="input-group">
                    <i class="fas fa-lock"></i>
                    <input type="password" name="password" id="password" required placeholder="Enter your password">
                </div>
                <button type="submit" class="login-btn"><i class="fas fa-sign-in-alt"></i> Login</button>
            </form>
        </div>
    </div>
</body>
<style>
body {
    font-family: 'Arial', sans-serif;
    margin: 0;
    padding: 0;
    background: #f4f7fc;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
}

.login-container {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100%;
}

.login-form {
    background-color: white;
    padding: 40px;
    border-radius: 8px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    width: 100%;
    max-width: 450px;
    text-align: center;
}

.login-form h2 {
    font-size: 2.2em;
    margin-bottom: 20px;
    color: #333;
}

.error {
    color: red;
    font-size: 0.9em;
    margin-bottom: 10px;
}

.input-group {
    margin-bottom: 20px;
    text-align: left;
    display: flex;
    align-items: center;
    border: 1px solid #ccc;
    border-radius: 4px;
    padding: 10px;
}

.input-group i {
    font-size: 1.2em;
    color: #007bff;
    margin-right: 10px;
}

.input-group input {
    width: 100%;
    padding: 12px;
    font-size: 1em;
    border: none;
    outline: none;
    transition: border-color 0.3s ease;
}

.input-group input:focus {
    border-color: #007bff;
}

.login-btn {
    width: 100%;
    padding: 14px;
    font-size: 1.2em;
    color: white;
    background-color: #007bff;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.login-btn i {
    margin-right: 10px;
}

.login-btn:hover {
    background-color: #0056b3;
}

@media (max-width: 600px) {
    .login-form {
        padding: 30px;
        width: 90%;
    }

    .login-form h2 {
        font-size: 1.8em;
    }

    .input-group input {
        font-size: 0.9em;
    }

    .login-btn {
        font-size: 1em;
        padding: 12px;
    }
}
</style>
</html>

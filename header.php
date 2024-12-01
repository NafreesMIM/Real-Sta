<header>
    <div class="logo-container">
        <h1 class="logo-text">NN Real Estate</h1>
    </div>
    <nav>
        <a href="index.php">Home</a>
        <a href="contact.php">Contact us</a>
        <a href="admin/login.php">Admin Login</a>
    </nav>
</header>

<style>
    /* Header container */
    header {
        background-color: #0D6EFD;
        color: white;
        padding: 20px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    /* Logo container */
    .logo-container {
        display: flex;
        align-items: center;
    }

    /* Logo text styling */
    .logo-text {
        font-size: 2.5em;
        font-family: 'Arial', sans-serif;
        font-weight: bold;
        color: #ffffff;
        text-transform: uppercase;
        letter-spacing: 2px;
        background: linear-gradient(90deg, #ff7f50, #ff6347);
        -webkit-background-clip: text;
        color: transparent;
    }

    /* Navigation links */
    nav a {
        color: white;
        text-decoration: none;
        margin: 0 20px;
        font-size: 1.2em;
    }

    nav a:hover {
        text-decoration: underline;
    }

    /* Mobile responsiveness */
    @media (max-width: 768px) {
        header {
            flex-direction: column;
            text-align: center;
        }

        nav {
            margin-top: 10px;
        }

        nav a {
            margin: 10px 0;
        }
    }
</style>

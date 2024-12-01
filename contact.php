<?php include 'header.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us</title>
    <link rel="stylesheet" href="assets/css/styles.css">
</head>
<body>

    <section class="contact-section">
        <h2>Contact Information</h2>

        <!-- Contact Info -->
        <div class="contact-info">
            <div class="info-item">
                <h3>Map</h3>
                <div class="map-container">
                    <!-- Embed Google Map -->
                    <iframe src="https://www.google.com/maps/embed/v1/place?key=AIzaSyCXhCmNigBHqtdbglczrVi8xC-QcJce-9M&q=52+Nanayakkara+Mawatha,+Sri+Jayawardenepura+Kotte" 
                        width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                </div>
            </div>

            <div class="info-item">
                <p><strong>Phone:</strong> <a href="tel:+94771993501">+94771993501</a></p>
            </div>

            <div class="info-item">
                <h3>Email</h3>
                <p><a href="mailto:mohamednafrees02@gmail.com">mohamednafrees02@gmail.com</a></p>
            </div>
        </div>

    </section>

    <?php include 'footer.php'; ?>

</body>
</html>

<style>
    /* General Styles */
    body {
        font-family: 'Arial', sans-serif;
        margin: 0;
        padding: 0;
        background-color: #f4f4f9;
    }

    .contact-section {
        max-width: 1000px;
        margin: 30px auto;
        padding: 20px;
        background-color: white;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .contact-section h2 {
        text-align: center;
        font-size: 2.5em;
        color: #333;
        margin-bottom: 20px;
    }

    .contact-info {
        display: grid;
        gap: 30px;
    }

    .info-item h3 {
        font-size: 1.5em;
        color: #333;
        margin-bottom: 10px;
    }

    .info-item p {
        font-size: 1.1em;
        color: #555;
    }

    .info-item a {
        color: #007bff;
        text-decoration: none;
    }

    .info-item a:hover {
        text-decoration: underline;
    }

    .map-container iframe {
        width: 100%;
        height: 300px;
        border: 0;
    }

    /* Mobile responsiveness */
    @media (max-width: 768px) {
        .contact-info {
            grid-template-columns: 1fr;
        }

        .map-container iframe {
            height: 250px;
        }
    }
</style>

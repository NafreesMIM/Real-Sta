CREATE TABLE admins (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL,
    password VARCHAR(255) NOT NULL
);

CREATE TABLE properties (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(100),
    price INT,
    location VARCHAR(100),
    bedrooms INT,
    bathrooms INT,
    description TEXT
);

ALTER TABLE properties ADD COLUMN property_type ENUM('Sale', 'Rent') NOT NULL;


CREATE TABLE property_images (
    id INT AUTO_INCREMENT PRIMARY KEY,
    property_id INT,
    image_path VARCHAR(255),
    FOREIGN KEY (property_id) REFERENCES properties(id)
);

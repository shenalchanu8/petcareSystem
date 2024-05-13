<?php
    include_once 'config.php';

    // Function to create the "pets" table if it doesn't exist
    function createPetsTable($connection) {
        $query = "CREATE TABLE IF NOT EXISTS pets (
                    id INT AUTO_INCREMENT PRIMARY KEY,
                    name VARCHAR(255) NOT NULL,
                    dob DATE NOT NULL,
                    sex VARCHAR(10) NOT NULL,
                    breed VARCHAR(255) NOT NULL,
                    owner_address VARCHAR(255) NOT NULL,
                    identification_number VARCHAR(255) NOT NULL
                )";

        if ($connection->query($query) === FALSE) {
            echo "Error creating table: " . $connection->error;
            exit;
        }
    }

    // Function to sanitize input data
    function sanitizeInput($input) {
        // You can add more sanitization/validation logic here if needed
        $input = trim($input);
        $input = stripslashes($input);
        $input = htmlspecialchars($input);
        return $input;
    }

    // Check if the form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Retrieve form data and sanitize it
        $name = sanitizeInput($_POST["name"]);
        $dob = sanitizeInput($_POST["dob"]);
        $sex = sanitizeInput($_POST["sex"]);
        $breed = sanitizeInput($_POST["breed"]);
        $ownerAddress = sanitizeInput($_POST["owner_address"]);
        $identificationNumber = sanitizeInput($_POST["identification_number"]);

        // Create the "pets" table if it doesn't exist
        createPetsTable($connection);

        // Insert the pet data into the "pets" table
        $query = "INSERT INTO pets (name, dob, sex, breed, owner_address, identification_number)
                  VALUES ('$name', '$dob', '$sex', '$breed', '$ownerAddress', '$identificationNumber')";

        if ($connection->query($query) === TRUE) {
            echo "Pet registration successful!";
            header("Location: pet registration.html?message=1");

        } else {
            echo "Error: " . $query . "<br>" . $connection->error;
            header("Location: pet registration.html?message=0");
        }

        // Close the database connection
        $connection->close();
    }
?>
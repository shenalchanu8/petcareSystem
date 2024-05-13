<?php
    include_once 'config.php';

    error_reporting(E_ALL);
    ini_set('display_errors', 1);


    // Retrieve form data
    $height = $_POST['height'];
    $weight = $_POST['weight'];
    $temperature = $_POST['temperature'];
    $respiration_rate = $_POST['respiration_rate'];
    $oestrus = $_POST['oestrus'];
    $age_of_puberty = $_POST['age_of_puberty'];
    $vaccinated_date = $_POST['date'];
    $dog_type = $_POST['dog_type'];
    $cat_type = $_POST['cat_type'];
    $dog_vaccine1 = isset($_POST['dog_vaccine1']) ? 1 : 0;
    $dog_vaccine2 = isset($_POST['dog_vaccine2']) ? 1 : 0;
    $dog_vaccine3 = isset($_POST['dog_vaccine3']) ? 1 : 0;
    $dog_vaccine4 = isset($_POST['dog_vaccine4']) ? 1 : 0;
    $dog_vaccine5 = isset($_POST['dog_vaccine5']) ? 1 : 0;
    $dog_vaccine6 = isset($_POST['dog_vaccine6']) ? 1 : 0;
    $dog_vaccine7 = isset($_POST['dog_vaccine7']) ? 1 : 0;
    $cat_vaccine1 = isset($_POST['cat_vaccine1']) ? 1 : 0;
    $cat_vaccine2 = isset($_POST['cat_vaccine2']) ? 1 : 0;
    $cat_vaccine3 = isset($_POST['cat_vaccine3']) ? 1 : 0;
    $cat_vaccine4 = isset($_POST['cat_vaccine4']) ? 1 : 0;
    $cat_vaccine5 = isset($_POST['cat_vaccine5']) ? 1 : 0;
    $cat_vaccine6 = isset($_POST['cat_vaccine6']) ? 1 : 0;
    $cat_vaccine7 = isset($_POST['cat_vaccine7']) ? 1 : 0;
    
    // Check if the table exists, otherwise create it
    $tableName = "health_updates";
    $tableExists = $connection->query("SHOW TABLES LIKE '$tableName'")->num_rows > 0;

    if (!$tableExists) {
        // Create the table if it doesn't exist
        $createTableQuery = "CREATE TABLE $tableName (
            id INT(11) AUTO_INCREMENT PRIMARY KEY,
            height FLOAT,
            weight FLOAT,
            temperature FLOAT,
            respiration_rate INT(11),
            oestrus VARCHAR(50),
            age_of_puberty VARCHAR(50),
            vaccinated_date DATE,
            dog_type VARCHAR(50),
            cat_type VARCHAR(50),
            dog_vaccine1 TINYINT(1),
            dog_vaccine2 TINYINT(1),
            dog_vaccine3 TINYINT(1),
            dog_vaccine4 TINYINT(1),
            dog_vaccine5 TINYINT(1),
            dog_vaccine6 TINYINT(1),
            dog_vaccine7 TINYINT(1),
            cat_vaccine1 TINYINT(1),
            cat_vaccine2 TINYINT(1),
            cat_vaccine3 TINYINT(1),
            cat_vaccine4 TINYINT(1),
            cat_vaccine5 TINYINT(1),
            cat_vaccine6 TINYINT(1),
            cat_vaccine7 TINYINT(1)
        )";

        if ($connection->query($createTableQuery) === TRUE) {
            echo "Table created successfully. ";
        } else {
            echo "Error creating table: " . $connection->error;
        }
    }

    // Insert the form data into the table
    $insertQuery = "INSERT INTO $tableName (height, weight, temperature, respiration_rate, oestrus, age_of_puberty,
        vaccinated_date, dog_type, cat_type, dog_vaccine1, dog_vaccine2, dog_vaccine3, dog_vaccine4, dog_vaccine5, dog_vaccine6, dog_vaccine7,
        cat_vaccine1, cat_vaccine2, cat_vaccine3, cat_vaccine4, cat_vaccine5, cat_vaccine6, cat_vaccine7)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    echo $insertQuery;
    $stmt = $connection->prepare($insertQuery);
    $stmt->bind_param(
        "dddisisiiiiiiiiiiiiiiii",
        $height,
        $weight,
        $temperature,
        $respiration_rate,
        $oestrus,
        $age_of_puberty,
        $vaccinated_date,
        $dog_type,
        $cat_type,
        $dog_vaccine1,
        $dog_vaccine2,
        $dog_vaccine3,
        $dog_vaccine4,
        $dog_vaccine5,
        $dog_vaccine6,
        $dog_vaccine7,
        $cat_vaccine1,
        $cat_vaccine2,
        $cat_vaccine3,
        $cat_vaccine4,
        $cat_vaccine5,
        $cat_vaccine6,
        $cat_vaccine7
    );


    if ($stmt->execute()) {
        echo "Data uploaded successfully.";
        header("Location: healthupdates.html?message=1");
    } else {
        echo "Error uploading data: " . $stmt->error;
        header("Location: healthupdates.html?message=0");
    }

    // Close the database connection
    $stmt->close();
    $connection->close();
?>

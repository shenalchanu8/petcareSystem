<?php
// MySQL database credentials


$servername = "localhost:3306";
$dbusername = "petdbuser";
$dbpassword = "123.123";
$dbname = "petdb";


// Create a new connection
$conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $first_name = $_POST["first_name"];
    $last_name = $_POST["last_name"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $confirmPassword = $_POST["confirm_password"];

    

    if ($password !== $confirmPassword) {
        echo '<script>alert("Passwords do not match. Please make sure the passwords match.");</script>';
    }

    // Prepare the SQL statement
    $sql = "INSERT INTO Members (FirstName, LastName, Email, Password)
            VALUES ('$first_name', '$last_name', '$email', '$password')";

    // Execute the query
    if ($conn->query($sql) === TRUE) {
        
         echo '<script>alert("Data inserted successfully!, Please login to proceed to the store.");</script>';
          echo '<script>window.location.href="/MLB_0901_05/login.html";</script>';
        
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Close the connection
$conn->close();
?>

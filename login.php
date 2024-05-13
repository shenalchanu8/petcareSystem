
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
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Prepare the SQL statement
    $sql = "SELECT * FROM Members WHERE Email = '$email' AND Password = '$password'";

    // Execute the query
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        // Successful login
         $row = $result->fetch_assoc();
        
        $data =  $row['Id'];
        echo '<script>';
        echo 'var dataFromPHP = ' . json_encode($data) . ';';
        echo 'localStorage.setItem("memberId", dataFromPHP); window.location.href="services.html";';
        echo '</script>';
        
    } else {
        // Failed login
        echo '<script>alert("Invalid email or password. Please try again."); window.location.href="login.html";</script>';
    }
}

// Close the connection
$conn->close();
?>

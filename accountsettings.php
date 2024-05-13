<!DOCTYPE html>

<html lang="en">

<head>

    <!-- metadata -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account Settings</title>

    <!-- stylesheets -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="accountsettings.css">
    <link rel="icon" type="image/x-icon" href="favicon.png">
    
    <style>
        label{
            min-width: 169px;
        }
    </style>

</head>

<body>

    <!-- HEADER -->
        
        <section class="header">

            <a href="#"><img src="logo.png" width="100px" height="100px"></a>
                
            <nav class="navbar">
        
                <a href="home.html"><i class='bx bxs-home'></i>Home</a>
                <a href="login.html"><i class='bx bxs-login'></i>Login</a>
                <a href="store.html"><i class='bx bxs-store'></i>Store</a>
                <a href="services.html"><i class='bx bxs-dog'></i>Our services</a>
                <a href="pet registration.html"><i class='bx bxs-aboutpet'></i>About Pet</a>
                <a href="aboutus.html"><i class='bx bxs-whyus'></i>Why us</a>
                <a href = "accountsettings.html"><i class = 'bx bxs-settings'></i>Settings</a>
                

            </nav>

            <div id="menu-btn" class="fas fa-bars"></div>

        </section>
        
 

 
        
<?php


$servername = "localhost:3306";
$dbusername = "petdbuser";
$dbpassword = "123.123";
$dbname = "petdb";



// Create a new connection
$conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);

if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
}
$memberId = $_GET["id"];
// Retrieve the logged member's data from the database
$sql = "SELECT * FROM Members WHERE Id=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('i', $memberId);
$stmt->execute();
$result = $stmt->get_result();
$image = "profile-picture.jpg";

if ($result->num_rows === 1) {
    $row = $result->fetch_assoc();

    // Fill the HTML form fields with the member data
    $firstName = $row['FirstName'];
    $lastName = $row['LastName'];
    $email = $row['Email'];
    $password = $row['Password'];
    $image = $row['Image'];
    $address = $row['Address'];

    // Close the statement and connection
    $stmt->close();
    $conn->close();
} else {
    echo 'Member not found.';
}

 
?>






        <form method="post"  enctype="multipart/form-data">

            <!-- Contact Information (left side of form) -->
              <input type="hidden" name="id" id="id" value="<?php echo $memberId; ?>">
              
              <script>
                    // Read data from LocalStorage
                    var storedData = localStorage.getItem('memberId');
                    // Check if data is available
                    if (storedData) {
                    
                        // Data is available, use it as needed
                        document.getElementById('id').value = storedData
                    
                        var containsOrnot = window.location.href.includes("id=");
                        if (!containsOrnot) {
                            var url = "accountsettings.php?id=" + storedData;
                           window.location.href = url;
                        }
                    } else {
                        // Data is not available or has been cleared
                        alert("Please login to your profile first!");
                        window.location.href = "login.html";
                    }
              </script>
              
              
            <input type="hidden" id="imageBytes" name="image" value="<?php echo $image; ?>">
                    <input type="hidden" name="action" value="UPDATE">
        
            <div class="left">
                

                <h2 style="text-align:left;">Profile Information</h2>
                <div class="field">
                    <label for="name">Profile Image *: </label>
                   
                   <table>
                       <tr>
                           <td><img src="<?php echo $image; ?>" alt="profile picture" id="previewImage" style="display:block;width: 150px;border-radius: 50%;"></td>
                       </tr>
                       <tr>
                           <td>
                               <input type="file" id="imageInput" name="imageInput" accept="image/jpeg, image/png" style="font-size: 16px; background-color:#000;padding: 20px;border-radius: 5px;color: #fff;">

                           </td>
                       </tr>
                   </table>
            
        

           
                </div>
    
                <div class="field">
                    <label for="name">Name *: </label>
                    <input type="text" name="firstName"  maxlength="60" placeholder="First Name" value="<?php echo $firstName; ?>" required>
                </div>

                <div class="field">
                    <label for="email">Last Name *: </label>
                    <input type="text" name="lastName"  maxlength="60" placeholder="Last Name" value="<?php echo $lastName; ?>" required>
                </div>
                
                 <div class="field">
                    <label for="email">Email *: </label>
                        <input type="email"  maxlength="60" name="email" placeholder="Email" value="<?php echo $email; ?>" required>
                </div>

              

                <div class="field">
                    <label for="address">Address: </label>
                    <textarea  maxlength="250" name="address" id="address" cols="30" rows="10" placeholder="Your address" required><?php echo $address; ?></textarea>
                </div>
    
            </div>

            <!-- Account Security (right side of form) -->

            <div class="right">

                <h2  style="text-align:left;">Account Security</h2>
    
                <div class="field">
                    <label for="password">Password *: </label>
                     <input type="password" name="password" placeholder="Password" value="<?php echo $password; ?>" required>
                </div>

                <div class="field">
                    <label for="confirm-password">Confirm password *: </label>
                     <input type="password" name="confirm_password" placeholder="Password" value="<?php echo $password; ?>" required>
                </div>
                
                <div class="action-buttons">

            <button  type="submit" class="action-button">Save Changes</button>
        </div>
    
            </div>

        </form>

 
    <div class="right" >
        <form onsubmit="return confirm('Are you sure you need to delete your profile?');" method="post">
             <input type="hidden" name="id" value="<?php echo $memberId; ?>">
               <input type="hidden" name="action" value="DELETE">
                <button  type="submit"  class="action-button" style="background-color:#f00">Delete account</button>
        </form>
    </div>
        

        <hr>

        <!-- FOOTER -->

        <section class="footer">
            <div class="box-container">
                <div class="box">
        
                    <h3>quick link </h3>
                    <a href="home.html"><i  class="fas fa-angle-right"></i>Home</a>
                    <a href="store.html"><i  class="fas fa-angle-right"></i>Store</a>
                    <a href="pet registration.html"><i  class="fas fa-angle-right"></i>About Pet</a>
                    <a href="accountsettings.html"><i  class="fas fa-angle-right"></i>settings</a>
                    <a href="feedback.html"><i  class="fas fa-angle-right"></i>Feedback</a>
                    <a href="services.css"><i  class="fas fa-angle-right"></i>services</a>
                    <a href="aboutus.html"><i  class="fas fa-angle-right"></i>why us</a>
                
                </div>
        
                <div class="box">
        
                    <h3>extra link </h3>
                    <a href="#"><i  class="fas fa-angle-right"></i>Ask question</a>
                    <a href="aboutus.html"><i  class="fas fa-angle-right"></i>About Us</a>
                    <a href="privacypolicy.html"><i  class="fas fa-angle-right"></i>Privacy Policy</a>
                    <a href="#"><i  class="fas fa-angle-right"></i>Terms User</a>
                
                </div>
        
                <div class="box">
        
                    <h3>Contact Info </h3>
                    <a href="#"><i  class="fas fa-phone"></i>+122-675363563</a>
                    <a href="#"><i  class="fas fa-phone"></i>+111-435627827</a>
                    <a href="#"><i  class="fas fa-envelope"></i>shashika@gmail.com</a>
                    <a href="#"><i  class="fas fa-map"></i>katunayaka,Srilanka</a>
                
                </div>
        
                <div class="box">
                    <h3>Follow Us</h3>
                    <a href="#"><i class="fab fa-facebook"></i>facebook</a>
                    <a href="#"><i class="fab fa-instagram"></i>instagram</a>
                    <a href="#"><i class="fab fa-twitter"></i>twitter</a>
                    <a href="#"><i class="fab fa-linkedin"></i>linkedin</a>
        
        
                </div>
        
            </div>
        
            <div class="credit">Create By <span> Safe Paws</span> |all right reserved| </div>
        
        </section>
        
        
        
        
        <script>
 
  // Get references to the input and image tags
  const imageInput = document.getElementById('imageInput');
  const previewImage = document.getElementById('previewImage');

  // Add an event listener to the input for the change event
  imageInput.addEventListener('change', function() {
    // Check if a file is selected
    if (imageInput.files && imageInput.files[0]) {
      // Create a FileReader object
      const reader = new FileReader();

      // Set the image source once the file is loaded
      reader.onload = function(e) {
        previewImage.src = e.target.result;
        previewImage.style.display = 'block'; // Show the image
      };

      // Read the selected file as a data URL
      reader.readAsDataURL(imageInput.files[0]);
    }
  });
</script>



<?php



if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if($_POST['action']==='UPDATE'){
        // Specify the target directory to save the uploaded image
        $targetDirectory = '/MLB_0901_05/uploads';
        
        // Retrieve the uploaded file information
        $file = $_FILES['imageInput'];
        $fileName = $file['name'];
        $fileTmpName = $file['tmp_name'];
        $fileType = $file['type'];
        $fileError = $file['error'];
      
            $targetFilePath = $targetDirectory . $fileName;
           
            if (move_uploaded_file($fileTmpName, $targetFilePath)) {
                echo 'Success: Image uploaded successfully.';
                 $image = $targetFilePath;
            } else {
                $image =$_POST['image'];
                echo 'Error: Failed to move the uploaded file.';
            }
        
        // capturing form data
        $id = $_POST['id'];
        $firstName = $_POST['firstName'];
        $lastName = $_POST['lastName'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $confirmPassword = $_POST['confirm_password'];
        $address = $_POST['address'];
        
    
        if ($password !== $confirmPassword) {
            echo '<script>alert("Passwords do not match. Please make sure the passwords match.");</script>';
        }
        
        
        $sql = "UPDATE Members SET FirstName='$firstName', LastName='$lastName', Email='$email', Password='$password', Image='$image', Address='$address' WHERE Id='$id'";
        
    
        // Create a new connection
        $conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);
        
        if ($conn->connect_error) {
            die('Connection failed: ' . $conn->connect_error);
        }
        // Execute the query
        if ($conn->query($sql) === TRUE) {
             echo '<script>alert("Data updated successfully!"); window.location.href="accountsettings.php"</script>';
           
            
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
      
       
        // Close the statement and connection
        $conn->close();
        
    }
    else{
        // delete
         
         $conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);
         $memberId = $_POST['id'];
        // Perform the deletion query
        $sql = "DELETE FROM Members WHERE Id = $memberId";
        if ($conn->query($sql) === true) {
            // Deletion successful, redirect to the registration page
            echo '<script>alert("Profile removed.");window.location.href="login.html"</script>';
            exit(); // Make sure to exit after the redirect
        } else {
            echo "Error deleting record: " . $conn->error;
        }
         $conn->close();
    
    }
        
    } else {
        echo 'Invalid request method.';
    }


?>


</body>

</html>

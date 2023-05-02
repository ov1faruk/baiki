<?php
session_start();

// Connect to the MySQL database
$host = 'localhost'; 
$user = 'root'; 
$password = ''; 
$dbname = 'userinfo'; 

// Create connection
$conn = mysqli_connect($host, $user, $password, $dbname);

// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

// Check if the 'id' parameter is set in the POST request

if (isset($_POST['id'])) {
  // Get the shoe ID from the POST request
  $shoe_id = mysqli_real_escape_string($conn, $_POST['id']);

  // Get the user ID from the session variable
  $user_id = mysqli_real_escape_string($conn, $_SESSION['user_id']);

  // Insert the shoe into the cart table
  $sql = "INSERT INTO cart (user_id, shoe_id) VALUES ('$user_id', '$shoe_id')";
  mysqli_query($conn, $sql);
}

// Redirect the user back to the home page
header('Location: home.php');
exit;

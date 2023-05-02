<?php
// Connect to the MySQL database
$host = 'localhost'; 
$user = 'root'; 
$password = ''; 
$dbname = 'userinfo'; 

$conn = mysqli_connect($host, $user, $password, $dbname);

if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

// Check if the "category" parameter exists in the GET request
if (isset($_GET['category'])) {
  $category = $_GET['category'];

  // Read the shoes from the database that match the specified category
  $sql = "SELECT * FROM shoes WHERE category='$category'";
  $result = mysqli_query($conn, $sql);

  // Create an array of shoes data
  $shoes = [];
  if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
      $shoes[] = [
        'id' => $row['id'],
        'name' => $row['name'],
        'description' => $row['description'],
        'price' => $row['price'],
        'image' => $row['image']
      ];
    }
  }

  // Return the shoes as a JSON response
  header('Content-Type: application/json');
  echo json_encode($shoes);
}

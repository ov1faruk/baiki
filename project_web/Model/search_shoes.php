<?php
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

// Read the search and category parameters from the URL
$searchQuery = isset($_GET['search']) ? $_GET['search'] : '';
$category = isset($_GET['category']) ? $_GET['category'] : '';

// Build the SQL query based on the search and category parameters
$sql ="SELECT * FROM shoes";

if ($searchQuery && $category) {
  $sql .= " WHERE name LIKE '%$searchQuery%' AND category = '$category'";
} else if ($searchQuery) {
  $sql .= " WHERE name LIKE '%$searchQuery%'";
} else if ($category) {
  $sql .= " WHERE category = '$category'";
}

// Execute the SQL query and fetch the results
$result = mysqli_query($conn, $sql);
$shoeData = array();
if (mysqli_num_rows($result) > 0) {
  while ($row = mysqli_fetch_assoc($result)) {
    $shoeData[] = $row;
  }
}

// Send the shoe data as JSON to the client
header('Content-Type: application/json');
echo json_encode($shoeData);

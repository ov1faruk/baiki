<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php
session_start();

// Establish a database connection
$host = 'localhost'; 
$user = 'root'; 
$password = ''; 
$dbname = 'userinfo'; 

$conn = mysqli_connect($host, $user, $password, $dbname);
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

$search_query = mysqli_real_escape_string($conn, $_GET['query']);

$sql = "SELECT * FROM shoes WHERE name LIKE '%$search_query%' OR description LIKE '%$search_query%'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
  // Loop through each shoe
  while ($row = mysqli_fetch_assoc($result)) {
    echo '<div class="shoe">';
    echo '<img class="img" src="../../resources/shoe' . $row['id'] . '.png">';
    echo '<h3>' . $row['name'] . '</h3>';
    echo '<p>' . $row['description'] . '</p><p>$' . $row['price'] . '</p>' .
    '<form method="post">' .
    '<input type="hidden" name="id" value="' . $row['id'] . '">' .
    '<button class="button" type="submit" name="add_to_cart">Add to Cart</button>' .
    '</form>' .
    '</div>';
  }

  // Handle adding shoe to cart
  if (isset($_POST['add_to_cart'])) {
    if (!isset($_SESSION['cart'])) {
      $_SESSION['cart'] = array();
    }
    $shoe_id = $_POST['id'];

    if (!in_array($shoe_id, $_SESSION['cart'])) {
      array_push($_SESSION['cart'], $shoe_id);
      // Add shoe to cart table
      $user_id = $_SESSION['user_id'];
      $sql = "INSERT INTO cart (user_id, shoe_id) VALUES ('$user_id', '$shoe_id')";
      mysqli_query($conn, $sql);
    }
  }
}
?>
</body>

</html>
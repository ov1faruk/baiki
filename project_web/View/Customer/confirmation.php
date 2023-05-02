<?php
session_start();
require '../navbar.html';

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

if (!isset($_SESSION['user_id'])) {
  // handle the case where the user is not logged in
  echo '<p>You need to log in to view your cart.</p>';
} else {
  $user_id = $_SESSION['user_id'];
  $sql = "SELECT * FROM cart WHERE user_id ='" . $user_id . "'";
  $result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Confirmation</title>
  <link rel="stylesheet" href="../checkout.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100&display=swap" rel="stylesheet">
 
</head>
</head>
<body>

<h1>Order Confirmation</h1>

<p>Thank you for your purchase!</p>

<?php
if (mysqli_num_rows($result) === 0) {
  echo '<p>Your cart is empty.</p>';
} else {
  echo '<div class="shoe-list">';
  $totalPrice = 0;
  while ($row = mysqli_fetch_assoc($result)) {
    $shoe_id = $row['shoe_id'];
    $shoe_sql = "SELECT * FROM shoes WHERE id='$shoe_id'";
    $shoe_result = mysqli_query($conn, $shoe_sql);
    $shoe_row = mysqli_fetch_assoc($shoe_result);

    $totalPrice += $shoe_row['price'];

    echo '<div class="shoe">';

    echo '<h3>' . $shoe_row['name'] . '</h3>';
    echo '<p>' . $shoe_row['description'] . '</p>';
    echo '<p>$' . $shoe_row['price'] . '</p>';
    echo '</div>';
  }
  echo '<p>Total price: $' . $totalPrice . '</p>';
  echo '</div>';

  // Remove items from the cart
  $delete_sql = "DELETE FROM cart WHERE user_id ='" . $user_id . "'";
  mysqli_query($conn, $delete_sql);
}
?>

<a href="home.php">GO HOME</a>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>

</body>
</html>

<?php
}

// Close the database connection
mysqli_close($conn);
?>

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
  <title>Cart</title>
  <link rel="stylesheet" href="../cart.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100&display=swap" rel="stylesheet">
</head>
<body>

<h1>Cart</h1>

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
        echo '<form method="post" action="../../Model/remove-cart.php">';
        echo '<input type="hidden" name="id" value="' . $row['id'] . '">';
        echo '<button class=button type="submit" name="remove">Clear</button>';
        echo '</form>';
        echo '</div>';
    }
    echo '<p>Total price: $' . $totalPrice . '</p>';
    echo '</div>';

}
?>

<a href="home.php"> <<<<< GO HOME</a>

<form align="center" method="post" action="checkout.php">
  <button  class=button type="submit" name="checkout">Proceed to Checkout</button>
</form>

</body>
</html>

<?php
}

// Close the database connection
mysqli_close($conn);
?>

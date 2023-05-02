<?php
session_start();
require '../View/navbar.html';
   
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
    $cart_id = mysqli_real_escape_string($conn, $_POST['id']);

    // Retrieve the price of the selected item before removing it from the cart
    $price_sql = "SELECT shoes.price FROM shoes JOIN cart ON shoes.id = cart.shoe_id WHERE cart.id = '$cart_id'";
    $price_result = mysqli_query($conn, $price_sql);
    $price_row = mysqli_fetch_assoc($price_result);
    $price = $price_row['price'];

    // Remove the selected item from the user's cart
    $sql = "DELETE FROM cart WHERE id='$cart_id' AND user_id='$user_id'";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        echo '<p>The item has been removed from your cart.</p>';

        // Update the total price shown in the cart
        $total_sql = "SELECT SUM(shoes.price) AS total_price FROM shoes JOIN cart ON shoes.id = cart.shoe_id WHERE cart.user_id = '$user_id'";
        $total_result = mysqli_query($conn, $total_sql);
        $total_row = mysqli_fetch_assoc($total_result);
        $totalPrice = $total_row['total_price'];

        echo '<p>Total price: $' . $totalPrice . '</p>';

         // Redirect to cart.php
         header("Location: ../View/Customer/cart.php");
         exit;
    } else {
        echo '<p>There was an error removing the item from your cart.</p>';
    }
}

// Close the database connection
mysqli_close($conn);
?>

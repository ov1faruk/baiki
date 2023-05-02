<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>BAIKI Store</title>
    <link rel="stylesheet" href="../home.css">
    <!-- Add jQuery library -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100&display=swap" rel="stylesheet">
</head>

<body>

    <?php 
  session_start();
  $host = 'localhost'; 
  $user = 'root'; 
  $password = ''; 
  $dbname = 'userinfo'; 
  $conn = mysqli_connect($host, $user, $password, $dbname);

  if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
  }

  // Check if user is logged in
  if (!isset($_SESSION['username'])) {
    header('location: login.php');
  }

  require '../navbar.html';
  ?>
    <form align="center" method="get" action="">
        <input type="text" name="query" id="search-input" placeholder="Search shoes...">
    </form>
    <div align="right">
        <form method="get" action="../logout.php">
            <button class=logout type="submit" name="logout">Logout</button>
        </form>
    </div>
    <h1>BaiKi Shoe Store</h1>

    <div id="filter-buttons">
        <button id="men-btn" onclick="filterShoes('men')">Men</button>
        <button id="women-btn" onclick="filterShoes('women')">Women</button>
        <button id="children-btn" onclick="filterShoes('children')">Children</button>
    </div>

    <p class="message">Welcome to our shoe store, <?php echo $_SESSION['username']; ?>! We have a wide selection of
        shoes for men, women, and children.</p>

    <div align="right">
        <form method="get" action="cart.php">
            <button class="cart" type="submit" name="cart">View Cart</button>
        </form>
    </div>

    <div align="left">
        <form method="get" action="profile.php">
            <button class="profile" type="submit" name="profile">View Profile</button>
        </form>
    </div>

    <div class="shoe-list">
        <?php
    // Display all shoes by default
    $sql = "SELECT * FROM shoes";
    $result = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_assoc($result)) {
      // display shoe details and add to cart button here
    }
  ?>
    </div>

    <script>
    // Send an AJAX request to fetch search results
    function searchShoes(query) {
        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.querySelector('.shoe-list').innerHTML = this.responseText;
            }
        };
        xhr.open("GET", "search.php?query=" + query, true);
        xhr.send();
    }

    document.querySelector('#search-input').addEventListener('input', function() {
        var query = this.value;
        searchShoes(query);
    });

    // Filter shoes by category
    function filterShoes(category) {
        window.location.href = 'home.php?category=' + category;
    }
    </script>


    <?php
// Add shoe to cart
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
?>

    <div class="shoe-list">
        <?php
    // Get category filter (if any)
    $category = '';
    if(isset($_GET['category'])){
      $category = $_GET['category'];
      $sql = "SELECT * FROM shoes WHERE category='$category'";
    }
    else{
      $sql = "SELECT * FROM shoes";
}
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
    if (isset($_POST['add_to_cart']) && $_POST['id'] == $row['id']) {
      $shoe_id = $row['id'];
      if (!in_array($shoe_id, $_SESSION['cart'])) {
        array_push($_SESSION['cart'], $shoe_id);
        // Add shoe to cart table
        $user_id = $_SESSION['user_id'];
        $sql = "INSERT INTO cart (user_id, shoe_id) VALUES ('$user_id', '$shoe_id')";
        mysqli_query($conn, $sql);
      }
    }
  } else {
  echo '<p>No shoes found.</p>';
}
?>
    </div>

</body>

</html>
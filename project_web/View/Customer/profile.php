<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>BAIKI Store - User Profile</title>
  <link rel="stylesheet" href="../profile.css">
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

  // Get user information from database
  $user_id = $_SESSION['user_id'];
  $sql = "SELECT * FROM users WHERE id='$user_id'";
  $result = mysqli_query($conn, $sql);
  $user = mysqli_fetch_assoc($result);
?>

<h1>User Profile</h1>

<div class="edit-profile">
  <form method="get" action="editprofile.php">
    <button class="profile" type="submit" name="profile">Edit Profile</button>
  </form>
</div>


<p><strong>Username:</strong> <?php echo $user['username']; ?></p>
<p><strong>Email:</strong> <?php echo $user['email']; ?></p>
<p><strong>Phone:</strong> <?php echo $user['phone']; ?></p>

</body>
</html>

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

$user_id = $_SESSION['user_id']; // Retrieve the user ID from the session variable

if (isset($_POST['submit'])) {
  $username = $_POST['username'];
  $email = $_POST['email'];
  $password = $_POST['password'];

  // Update the user's information in the database
  $sql = "UPDATE users SET username='$username', email='$email', password='$password' WHERE id=$user_id";
  if (mysqli_query($conn, $sql)) {
    $success_message = 'Your information has been updated successfully.';
  } else {
    $error_message = 'Something went wrong while updating your information.';
  }
}

// Retrieve the user's information from the database
$sql = "SELECT * FROM users WHERE id=$user_id";
$result = mysqli_query($conn, $sql);
$user = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Edit Profile</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100&display=swap" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
  <style>
    body {
      background-color: #000;
      color: #fff;
      font-family: 'Poppins', sans-serif;
    }

    h1 {
      text-align: center;
      margin-top: 100px;
    }

    form {
      display: flex;
      flex-direction: column;
      align-items: center;
      margin-top: 50px;
    }

    label {
      font-size: 20px;
      margin-bottom: 10px;
    }

    input[type="text"],
    input[type="email"],
    input[type="password"] {
      padding: 10px;
      border: none;
      border-radius: 5px;
      background-color: #f9f9f9;
      color: #161616;
      margin-bottom: 20px;
      width: 300px;
    }

    button[name="submit"] {
      padding: 10px;
      border: none;
      border-radius: 5px;
      background-color: #4CAF50;
      color: #fff;
      font-size: 16px;
      cursor: pointer;
      width: 150px;
      transition: all 0.3s ease;
    }
      
    button[name="submit"]:hover {
      background-color: #3e8e41;
    }

    p {
      text-align: center;
      margin-top: 20px;
    }

    a {
      color: yellow;
    }
  </style>
</head>
<body>

<?php require '../navbar.html'; ?>

<h1>Edit Profile</h1>

<?php if (isset($error_message)) { ?>
  <p><?php echo $error_message; ?></p>
<?php } ?>

<?php if (isset($success_message)) { ?>
  <p><?php echo $success_message; ?></p>
<?php } ?>

<form method="POST">
  <label>Username:</label>
  <input type="text" name="username" value="<?php echo $user['username']; ?>" required>

  <label>Email:</label>
  <input type="email" name="email" value="<?php echo $user['email']; ?>" required>

  <label>Password:</label>
  <input type="password" name="password" value="<?php echo $user['password']; ?>" required>

  <button type="submit" name="submit">Save Changes</button>
</form>
<p><a href="home.php">Back to Home</a></p>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>
</html>

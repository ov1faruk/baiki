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

if (isset($_POST['submit'])) {
  $username = $_POST['username'];
  $password = $_POST['password'];

  $sql = "SELECT * FROM users WHERE username='$username' AND password='$password'";
  $result = mysqli_query($conn, $sql);

  if (mysqli_num_rows($result) == 1) {
    $user = mysqli_fetch_assoc($result);
    $_SESSION['username'] = $user['username'];
    $_SESSION['user_id'] = $user['id']; // Add this line to set the user ID session variable
    header('location: home.php');
  } else {
    $error_message = 'Invalid username or password.';
  }
}
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Login</title>
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

<h1>Login</h1>

<?php if (isset($error_message)) { ?>
  <p><?php echo $error_message; ?></p>
<?php } ?>

<form method="POST">
  <label>Username:</label>
  <input type="text" name="username" required>

  <label>Password:</label>
  <input type="password" name="password" required>

  <button type="submit" name="submit">Login</button>
</form>
<div class="mt-3">
            <a href="forgot.php" class="forgot-link me-3">Forgot Password?</a>
            <span class="text-white">|</span>
            <a href="registration.php" class="ms-3">Sign up</a>
        </div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>
</html>

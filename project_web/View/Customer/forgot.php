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
  $email = $_POST['email'];

  $sql = "SELECT * FROM users WHERE username='$username' AND email='$email'"; 
  $result = mysqli_query($conn, $sql); 

  if (mysqli_num_rows($result) == 1) { 
    $user = mysqli_fetch_assoc($result); 
    $password = $user['password']; 

    // Send email with password 
    $to = $user['email']; 
    $subject = 'Password Retrieval'; 
    $message = 'Your password is: ' . $password; 
    $headers = 'From: webmaster@yourdomain.com' . "\r\n" . 'Reply-To: webmaster@yourdomain.com' . "\r\n" . 'X-Mailer: PHP/' . phpversion(); 
    mail($to, $subject, $message, $headers); 

    $_SESSION['success_message'] = 'Your password has been sent to your email address.'; 
    header('location: login.php'); 
  } else { 
    $error_message = 'Invalid username or email.'; 
  }
} 
?> 

<!DOCTYPE html> 
<html> 
<head> 
  <meta charset="UTF-8"> 
  <title>Forgot Password</title> 
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
    input[type="email"] {
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
  <h1>Forgot Password</h1> 

  <?php if (isset($error_message)) { ?>
    <p><?php echo $error_message; ?></p> 
  <?php } ?>

  <?php if (isset($_SESSION['success_message'])) { ?>
    <p><?php echo $_SESSION['success_message']; ?></p> 
    <?php unset($_SESSION['success_message']); ?>
  <?php } ?>

  <form method="POST"> 
    <label>Username:</label> 
    <input type="text" name="username" required>

    <label>Email:</label>
    <input type="email" name="email" required>

    <button type="submit" name="submit">Submit</button> 
  </form> 

  <p>Remember your password? <a href="login.php">Login here</a>.</p> 

 
</body> 
</html>

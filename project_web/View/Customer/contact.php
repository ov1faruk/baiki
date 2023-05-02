<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Contact Us</title>
  <link rel="stylesheet" href="../contact.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100&display=swap" rel="stylesheet">
  
</head>
<body>
  <!-- Include the navbar -->
  <?php include '../navbar.html'; ?>

  <h1>Contact Us</h1>

  <form>
    <label for="name">Name:</label>
    <input type="text" id="name" name="name"><br><br>

    <label for="email">Email:</label>
    <input type="email" id="email" name="email"><br><br>

    <label for="message">Message:</label>
    <textarea id="message" name="message"></textarea><br><br>

    <button type="submit">Send</button>
  </form>


</body>
</html>

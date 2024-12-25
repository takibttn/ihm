<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Database connection details
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "ihm";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Get the user data
    $email = $_SESSION['email']; // Assume user is logged in and email is stored in session
    $cardnumber = !empty($_POST['cardnumber']) ? intval($_POST['cardnumber']) : null;

    if ($cardnumber) {
        // Update the card number in the database
        $sql = "UPDATE com SET cardnumber = ? WHERE email = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("is", $cardnumber, $email);

        if ($stmt->execute()) {
            // Update session with the new card number
            $_SESSION['cardnumber'] = $cardnumber;
            // Redirect to the main page
            header("Location: index+.php");
            exit();
        } else {
            echo "Error updating record: " . $conn->error;
        }
        $stmt->close();
    } else {
        echo "Invalid card number.";
    }

    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Add Card Number</title>
  <link rel="stylesheet" href="">
  <style>
    /* General Reset */
    body, html {
      margin: 0;
      padding: 0;
      font-family: Arial, sans-serif;
      box-sizing: border-box;
    }

    /* Header */
    header {
      background-color: #f4f4f4;
      padding: 2px;
      text-align: center;
      font-size: 24px;
      font-weight: bold;
      color: rgb(37, 125, 47);
    }

    /* Footer */
    footer {
      background-color: #f4f4f4;
      padding: 10px;
      text-align: center;
      font-size: 16px;
      position: fixed;
      bottom: 0;
      width: 100%;
    }

    /* Main Section */
    main {
      display: flex;
      justify-content: center;
      align-items: center;
      height: calc(100vh - 120px);
      flex-direction: column;
      text-align: center;
    }

    .logo {
      position: absolute;
      top: 20px;
      left: 10px;
      z-index: 1;
      height: 80px;
      width: 180px;
    }

    .pic {
      position: absolute;
      height: 40px;
      width: 50px;
      top: 40px;
      right: 2vb;
    }

    .form-container {
      background-color: #f0f0f0;
      padding: 20px;
      border-radius: 10px;
      margin-top: 20px;
      box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
      width: 300px;
      text-align: center;
    }

    .form-container input {
      width: 100%;
      padding: 10px;
      margin-bottom: 20px;
      border: 1px solid #ddd;
      border-radius: 5px;
      font-size: 16px;
    }

    .form-container button {
      background-color: #4CAF50;
      color: white;
      padding: 10px 20px;
      border: none;
      border-radius: 5px;
      font-size: 16px;
      cursor: pointer;
    }

    .form-container button:hover {
      background-color: #45a049;
    }

    .greeting {
      position: absolute;
      top: 30px;
      right: 5%;
      font-size: 20px;
      color: black;
      font-weight: bold;
    }
  </style>
</head>
<body>
  <header>
    <a href="index+.php"><img src="ihm.png" class="logo"></a>
    <img src="login.png" alt="" class="pic">
    <h1>Welcome to MACOMMUNE</h1>
  </header>

  <main>
    <div class="form-container">
      <h2>Add Your Card Number</h2>
      <form method="POST" action="">
        <label for="cardnumber">Card Number:</label><br>
        <input type="text" id="cardnumber" name="cardnumber" required><br>
        <button type="submit">Submit</button>
      </form>
    </div>
    <p class="greeting">Hello, <?php echo isset($_SESSION['fullname']) ? htmlspecialchars($_SESSION['fullname']) : 'Guest'; ?>!</p>
  </main>

  <footer>
    <p>Page Footer</p>
  </footer>
</body>
</html>

<?php
// Start the session
session_start();

// Check if the user is logged in
if (!isset($_SESSION['fullname']) || !isset($_SESSION['email'])) {
    header("Location: login+.html");
    exit();
}

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ihm";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get session variables
$fullname = $_SESSION['fullname'];
$email = $_SESSION['email'];

// Handle request submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $status = 'on hold';
    $sql = "INSERT INTO requests (email, status) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $email, $status);

    if ($stmt->execute()) {
        echo "<script>alert('Your ID card request has been successfully submitted!');</script>";
    } else {
        echo "<script>alert('Error submitting your request: " . $stmt->error . "');</script>";
    }

    $stmt->close();
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Request ID Card</title>
    <style>
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

    /* Main Content */
    main {
      display: flex;
      justify-content: center;
      align-items: center;
      height: calc(100vh - 120px);
    }

    .container {
      background-color: #f9f9f9;
      padding: 30px;
      border-radius: 10px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
      text-align: center;
    }

    .container h2 {
      color: rgb(37, 125, 47);
      margin-bottom: 20px;
    }

    .container button {
      background-color: rgb(100, 241, 100);
      color: white;
      border: none;
      padding: 15px 30px;
      font-size: 16px;
      border-radius: 5px;
      cursor: pointer;
      transition: background-color 0.3s ease;
    }

    .container button:hover {
      background-color: darkgreen;
    }

    img.logo {
      position: absolute;
      top: 20px;
      z-index: 1;
      height: 80px;
      width: 180px;
      left: 10px;
    }

    img.user-pic {
        position: absolute;
        height: 40px;
        width: 50px;
        top: 40px;
        right: 2vb;
    }

    .welcome {
        position: absolute;
        top: 30px;
        right: 5%;
        font-size: 20px;
        color: black;
        font-weight: bold;
    }
    .pic {
  position: absolute;
  height: 40px;
  width: 50px;
  top: 40px;
  right: 2vb;
}
    </style>
</head>
<body>
    <header>
        <h1>Request Your ID Card Online</h1>
    </header>
    <main>
        <div class="container">
            <h2>Requesting your identification card</h2>
            <p>Click the button below to request your ID card.</p>
            <form method="POST" action="">
                <button type="submit">Request ID Card</button>
            </form>
        </div>
        <p class="welcome">Hello, <?php echo htmlspecialchars($fullname); ?>!</p>
    </main>
    <a href="index+.php"><img src="ihm.png" alt="" class="logo"></a>
    <img src="login.png" alt="" class="pic">
    <footer>
        <p>Page Footer</p>
    </footer>
</body>
</html>

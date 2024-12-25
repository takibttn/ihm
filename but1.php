<?php
// Start the session
session_start();


// Database connection
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
$fullname = $_SESSION['fullname'];
// Ensure the user is logged in by checking session variables
if (!isset($_SESSION['email'])) {
    echo "You are not logged in.";
    exit();
}

// Query to get user details using session's email
$sql = "SELECT * FROM com WHERE email = ?";
$stmt = $conn->prepare($sql);
if ($stmt === false) {
    die("SQL error: " . $conn->error);
}
$stmt->bind_param("s", $_SESSION['email']);
$stmt->execute();
$result = $stmt->get_result();

// Check if the user exists and fetch the details
if ($result && $result->num_rows > 0) {
    $row = $result->fetch_assoc();
} else {
    // Handle case when no record is found
    echo "No record found for this card number.";
    exit();
}

// Close the statement
$stmt->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Birth Certificate</title>
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

    /* Main Content */
    main {
      display: flex;
      justify-content: center;
      align-items: center;
      height: calc(125vh - 120px);
      flex-direction: column;
    }

    /* Field Styles */
    .container {
      width: 100%;
      max-width: 800px;
      padding: 20px;
      background: white;
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      position: relative;
      top: -3%;
    }

    .field {
      margin-bottom: 15px;
    }

    label {
      display: block;
      margin-bottom: 5px;
    }

    input[type="text"], input[type="number"], input[type="date"] {
      width: 100%;
      padding: 8px;
      border: 1px solid #ddd;
      border-radius: 4px;
    }

    /* Logo and Greeting */
    .logo {
      position: absolute;
      top: 20px;
      z-index: 1;
      height: 80px;
      width: 180px;
      left: 10px;
    }

    .greeting {
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
    <h1>Welcome to MACOMMUNE</h1>
  </header>
  <main>
    <div class="container">
      <h1>Birth Certificate</h1>
      
      <?php if (isset($row['fullname'])) : ?>
        <div class="field">
          <label for="fullname">Full Name:</label>
          <input type="text" id="fullname" value="<?php echo htmlspecialchars($row['fullname']); ?>" readonly>
        </div>
        
        <div class="field">
          <label for="birthplace">Place of Birth:</label>
          <input type="text" id="birthplace" value="<?php echo htmlspecialchars($row['birthplace']); ?>" readonly>
        </div>
        
        <div class="field">
          <label for="address">Address:</label>
          <input type="text" id="address" value="<?php echo htmlspecialchars($row['adress']); ?>" readonly>
        </div>
        
        <div class="field">
          <label for="cardnumber">Card Number:</label>
          <input type="number" id="cardnumber" value="<?php echo htmlspecialchars($row['cardnumber']); ?>" readonly>
        </div>
        
        <div class="field">
          <label for="gender">Gender:</label>
          <input type="text" id="gender" value="<?php echo htmlspecialchars($row['gender']); ?>" readonly>
        </div>
        
        <div class="field">
          <label for="birthdate">Date of Birth:</label>
          <input type="date" id="birthdate" value="<?php echo htmlspecialchars($row['birthdate']); ?>" readonly>
        </div>
      <?php else : ?>
        <p>No record found.</p>
      <?php endif; ?>
    </div>

    <img src="login.png" alt="" class="pic">
    <a href="index+.php"><img src="ihm.png" alt="" class="logo"></a>
    <p class="greeting">Hello, <?php echo htmlspecialchars($fullname); ?>!</p>
  </main>
  <footer>
    <p>Page Footer</p>
  </footer>
  <div class="ni" ></div>
</body>
</html>

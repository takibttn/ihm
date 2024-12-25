<?php
session_start(); // Start the session

// Check if the user is logged in
if (!isset($_SESSION['email'])) {
    header("Location: login.php"); // Redirect if not logged in
    exit();
}

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

$email = $conn->real_escape_string($_SESSION['email']); // Secure email input
$sql = "SELECT status FROM requests WHERE email = '$email'";
$result = $conn->query($sql);

if ($result && $result->num_rows > 0) {
    $status = $result->fetch_assoc()['status'];
} else {
    $status = "No request found"; // Default message if no status is available
}

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Request Status</title>
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
            height: calc(100vh - 120px); /* Adjusted height to accommodate header/footer */
            flex-direction: column;
        }

        /* Status Text */
        h1 {
            color: rgb(37, 125, 47);
        }

        p {
            font-size: 18px;
        }

        .greeting {
            position: absolute;
            top: 30px;
            right: 5%;
            font-size: 20px;
            color: black;
            font-weight: bold;
        }

        /* Status Colors */
        .accepted {
            color: green;
            font-weight: bold;
        }

        .refused {
            color: red;
            font-weight: bold;
        }

        .no-request {
            color: orange;
            font-weight: bold;
        }
        img.logo {
      position: absolute;
      top: 20px;
      z-index: 1;
      height: 80px;
      width: 180px;
      left: 10px;
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
        <h1>Request Status</h1>
    </header>
    <main>
    <a href="index+.php"><img src="ihm.png" alt="" class="logo"></a>
    <img src="login.png" alt="" class="pic">

        <?php
            // Display the status with corresponding color
            if ($status === 'accepted') {
                echo "<p class='accepted'>Your request has been <strong>accepted</strong>.</p>";
            } elseif ($status === 'refused') {
                echo "<p class='refused'>Your request has been <strong>refused</strong>.</p>";
            } elseif ($status === 'on hold') {
                echo "<p class='no-request'>Your request is currently <strong>on hold</strong>.</p>";
            } else {
                echo "<p class='no-request'>No request found.</p>";
            }
        ?>
        <p class="greeting">Hello, <?php echo htmlspecialchars($_SESSION['fullname']); ?>!</p>
    </main>
    <footer>
        <p>Page Footer</p>
    </footer>
</body>
</html>

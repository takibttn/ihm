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
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'], $_POST['request_id'])) {
    $action = $_POST['action'];
    $requestId = intval($_POST['request_id']);

    // Update request status based on admin action
    $status = ($action === 'accept') ? 'accepted' : 'refused';
    $sql = "UPDATE requests SET status = '$status' WHERE id = $requestId";

    if ($conn->query($sql)) {
        echo "<script>alert('Request updated successfully!');</script>";
    } else {
        echo "<script>alert('Error: " . $conn->error . "');</script>";
    }
}

// Fetch all pending requests for the admin panel
$sql = "SELECT r.id, c.fullname, c.email, r.status FROM requests r JOIN com c ON r.email = c.email WHERE r.status = 'on hold'";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
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

        /* Table Styles */
        table {
            width: 80%;
            margin-top: 20px;
            border-collapse: collapse;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px 12px;
            text-align: center;
        }

        th {
            background-color: rgb(37, 125, 47);
            color: white;
        }

        /* Buttons */
        button {
            background-color: rgb(100, 241, 100);
            color: white;
            border: none;
            padding: 10px 20px;
            font-size: 16px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: rgb(0, 250, 20);
        }

        /* Logo */
        .logo {
            position: absolute;
            top: 20px;
            z-index: 1;
            height: 80px;
            width: 180px;
            left: 10px;
        }

        /* Greeting */
        .greeting {
            position: absolute;
            top: 30px;
            right: 5%;
            font-size: 20px;
            color: black;
            font-weight: bold;
        }
        .red{
            background-color: rgb(200, 55, 50);
        }
        .red:hover{
            background-color: red;
        }
        .pic {
  position: absolute;
  height: 40px;
  width: 50px;
  top: 40px;
  right: 2vb;
}
.logo {
      position: absolute;
      top: 20px;
      left: 10px;
      z-index: 1;
      height: 80px;
      width: 180px;
    }
    </style>
</head>
<body>
    <header>
        <h1>Admin Panel</h1>
    </header>
    <main>
        <table>
            <thead>
                <tr>
                    
                    <th>Full Name</th>
                    <th>Email</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()) : ?>
                    <tr>
                        
                        <td><?php echo $row['fullname']; ?></td>
                        <td><?php echo $row['email']; ?></td>
                        <td><?php echo $row['status']; ?></td>
                        <td>
                            <form method="POST" style="display: inline;">
                                <input type="hidden" name="request_id" value="<?php echo $row['id']; ?>">
                                <button type="submit" name="action" value="accept">Accept</button>
                            </form>
                            <form method="POST" style="display: inline;">
                                <input type="hidden" name="request_id" value="<?php echo $row['id']; ?>">
                                <button type="submit" name="action" value="reject" class="red">Reject</button>
                            </form>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
        <p class="greeting">Hello, <?php echo htmlspecialchars($fullname); ?>!</p>
    </main>
    <footer>
        <p>Page Footer</p>
    </footer>
    <img src="login.png" alt="" class="pic">
    <img src="ihm.png" alt="" class="logo">
    

</body>
</html>

<?php
$conn->close();
?>

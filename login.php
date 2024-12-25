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

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $conn->real_escape_string($_POST["email"]);
    $password = $_POST["password"]; // Plain password for comparison

    // Check if email exists in the database
    $sql = "SELECT * FROM com WHERE email = ? LIMIT 1"; // Ensure only one user is selected
    $stmt = $conn->prepare($sql);
    if ($stmt === false) {
        die("SQL error: " . $conn->error);
    }
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $result->num_rows == 1) { // Ensure there's only one matching user
        $row = $result->fetch_assoc();

        // Verify password
        if (password_verify($password, $row['password'])) {
            // Set session variables for the correct user
            $_SESSION['fullname'] = $row['fullname'];
            $_SESSION['email'] = $row['email'];
            $_SESSION['cardnumber'] = $row['cardnumber'];

            // Redirect based on email or another condition
            if ($email === "takibt4@gmail.com") {
                header("Location: admin.php");
            } else {
                header("Location: index+.php");
            }
            exit();
        } else {
            // Incorrect password
            header("Location: login+.html");
            exit();
        }
    } else {
        // Email not found or multiple results found
        header("Location: login++.html");
        exit();
    }
}

$conn->close();
?>

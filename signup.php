<?php
// Start the session to store session variables
session_start();

// Database connection
$servername = "localhost"; // Replace with your database host
$username = "root";        // Replace with your database username
$password = "";            // Replace with your database password
$dbname = "ihm";           // Replace with your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $fullname = $conn->real_escape_string($_POST["fullname"]);
    $birthplace = $conn->real_escape_string($_POST["placeofbirth"]);
    $address = $conn->real_escape_string($_POST["address"]);
    $email = $conn->real_escape_string($_POST["email"]);
    $cardnumber = !empty($_POST["cardnumber"]) ? intval($_POST["cardnumber"]) : NULL; // Use NULL if no card number is provided
    $gender = $conn->real_escape_string($_POST["gender"]);
    $password = password_hash($conn->real_escape_string($_POST["password"]), PASSWORD_DEFAULT); // Hash password for security
    $birthdate = $conn->real_escape_string($_POST["dateofbirth"]);

    // SQL query to insert data into the 'com' table
    $sql = "INSERT INTO com (fullname, birthplace, adress, email, cardnumber, gender, password, birthdate)
            VALUES ('$fullname', '$birthplace', '$address', '$email', " . ($cardnumber !== NULL ? $cardnumber : "NULL") . ", '$gender', '$password', '$birthdate')";

    if ($conn->query($sql) === TRUE) {
        // Store fullname and email in session after successful signup
        $_SESSION['fullname'] = $fullname;
        $_SESSION['email'] = $email; // Store email in session to check card number later
        $_SESSION['cardnumber'] =$cardnumber;
        // Redirect to index+ page after successful signup
        header("Location: index+.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>

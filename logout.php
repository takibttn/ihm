<?php
// Start the session
session_start();

// Destroy all session data
session_unset();     // Unsets all session variables
session_destroy();   // Destroys the session

// Redirect to the login page
header("Location: index.html"); // Or another page
exit();
?>

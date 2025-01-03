<?php
session_start();
if (isset($_SESSION['fullname'])) {
    $fullname = $_SESSION['fullname'];
} else {
    $fullname = "Guest";  // Default value or error handling
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Ma Commune - Services</title>
  <link rel="stylesheet" href="">
</head>
<style>/* General Reset */
    body, html {
      margin: 0;
      padding: 0;
      font-family: Arial, sans-serif;
      box-sizing: border-box;
      height: 100%;
    }

    /* Light gray container */
    .container {
      background-color: #f7f7f7; /* Very light gray */
      min-height: 100%;
      display: flex;
      flex-direction: column;
      justify-content: space-between;
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
      position: relative;
      bottom: 0;
      width: 100%;
    }

    /* Main content area */
    main {
      display: flex;
      justify-content: center;
      align-items: center;
      height: calc(100vh - 120px);
      flex-direction: column;
      text-align: center;
      padding: 20px;
    }

    /* Content */
    .content {
      max-width: 800px;
      padding: 20px;
      background-color: #ffffff; /* White background for the content */
      border-radius: 8px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      margin-top: 20px;
      position: relative;
      bottom: 7vb;
    }
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
</style>
<body>
  <div class="container">
    <header>
      <h1>Welcome to MACOMMUNE</h1>
    </header>
    <main>
     
      <div class="content">
        <h2>Welcome to Ma Commune</h2>
        <p>Ma Commune is an online service dedicated to providing residents with easy access to important commune-related tasks. Through our user-friendly website, you can:</p>
        <ul>
          <li><strong>Order Your Birth Certificate</strong>: Request a certified copy of your birth certificate quickly and efficiently from the comfort of your home.</li>
          <li><strong>Request an Identity Card</strong>: Submit your application for a national identity card and track its progress online.</li>
          <li><strong>Check Your ID Card Status</strong>: Stay updated on the status of your ID card application, including processing and delivery times.</li>
          <li><strong>Explore Other Commune Services</strong>: Access a variety of other commune-related services, information, and resources to assist with your administrative needs.</li>
        </ul>
        <p>With Ma Commune, we aim to simplify and modernize the way you interact with your local government. Enjoy fast, secure, and convenient services from anywhere at any time!</p>
      </div>
      <a href="index+.php"><img src="ihm.png" alt="" class="logo"></a>
    </main>
    <footer>
      <p>Page Footer</p>
    </footer>
  </div>
</body>
</html>

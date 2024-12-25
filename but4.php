<?php
session_start();
if (isset($_SESSION['cardnumber'])) {
    $cardnumber = $_SESSION['cardnumber'];  // Changed $fullname to $cardnumber
} else {
    $cardnumber = null;  // Define $cardnumber as null if not set
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Your Card Number</title>
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

    .greeting {
      position: absolute;
  top: 30px;
  right: 5%;
  font-size: 20px;
  color: black;
  font-weight: bold;
    }

    .cardnumber {
      background-color: #f0f0f0;
      padding: 20px;
      border-radius: 10px;
      margin-top: 20px;
      box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
      font-size: 18px;
      color: rgb(37, 125, 47);
    }

    .no-card {
      background-color: #fdd;
      padding: 20px;
      border-radius: 10px;
      margin-top: 20px;
      font-size: 18px;
      color: red;
      border: 1px solid red;
      position: relative;
      bottom: 10vb;
    }
    .pp{
      position: absolute;
      right: 45%;
      top: 59%;
      color: green;
        text-decoration: none;
    }

  </style>
</head>
<body>
  <header>
    <a href="index+.php"><img src="ihm.png"  class="logo"></a>
    <img src="login.png" alt="" class="pic">
    <h1>Welcome to MACOMMUNE</h1>
  </header>

  <main>
    <?php if ($cardnumber): ?>
      <div class="cardnumber">
        <p>Your card number is: <?php echo htmlspecialchars($cardnumber); ?></p>
      </div>
    <?php else: ?>
      <div class="no-card">
        <p>You didn’t add a card number during registration.</p>
      </div>
      <a href="add.php"><p class="pp">Add a card number?</p></a>
    <?php endif; ?>
    <p class="greeting">Hello, <?php echo isset($_SESSION['fullname']) ? htmlspecialchars($_SESSION['fullname']) : 'Guest'; ?>!</p>
    
  
  </main>

  <footer>
    <p>Page Footer</p>
  </footer>
</body>
</html>

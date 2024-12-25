<?php
// Start the session to use session variables
session_start();

// Check if the 'fullname' is set in the session
if (isset($_SESSION['fullname'])) {
    $fullname = $_SESSION['fullname'];
} else {
    $fullname = "Guest";  // Default value if the session doesn't contain fullname
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Buttons Page</title>
  <link rel="stylesheet" href="">
</head>
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
}

/* Button Container */
.button-container {
  display: flex;
  flex-wrap: wrap;
  justify-content: center;
  gap: 15px;
}

.b1 {
  position: relative;
  right: 0%;
  bottom: 30vb;
}

.b2 {
  position: relative;
  right: -152%;
  bottom: 30vb;
}

.b3 {
  position: relative;
  right: -302%;
  bottom: 30vb;
}

.b4 {
  position: relative;
  right: 51%;
}

.b5 {
  position: relative;
  right: 182%;
}

.b6 {
  position: relative;
  right: 32%;
}

.logo {
  position: absolute;
  top: 20px;
  z-index: 1;
  height: 80px;
  width: 180px;
  left: 10px;
}

/* Buttons */
.button-container button {
  background-color: rgb(100, 241, 100);
  color: white;
  border: none;
  padding: 15px 30px;
  height: 110px;
  font-size: 16px;
  border-radius: 5px;
  cursor: pointer;
  transition: background-color 0.3s ease;
  position: relative;
  top: 20px;
  width: 22vb;
}

button:hover {
  background-color: darkgreen;
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
</style>
<body>
  <header>
    <h1>Welcome to MACOMMUNE</h1>
  </header>
  <main>
    <div class="button-container">
      <a href="but1.php"><div class="b1"><button >Make your birth certificate</button></div></a>
      <a href="request.php"><div class="b2"><button >Request your card online</button></div></a>
      <a href="but3.php"><div class="b3"><button >See your card status</button></div></a>
      <div class="b4"><a href="but4.php"><button >See your card number</button></a></div>
      <a href="but5.php"><div class="b5"><button >Information about the website</button></div></a>
      <a href="logout.php"><div class="b6"><button>Disconnect</button></div></a>

    </div>
    <img src="login.png" alt="" class="pic">
    <img src="ihm.png" alt="" class="logo">
    <p class="greeting">Hello, <?php echo htmlspecialchars($fullname); ?>!</p>
  </main>
  <footer>
    <p>Page Footer</p>
  </footer>
</body>
</html>

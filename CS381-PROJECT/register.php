<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Register - FOXcinema</title>
  <link rel="stylesheet" href="css/style.css" />
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/5/w3.css" />
</head>
<body class="w3-black">
  <div class="login-box">
    <div class="logo-wrapper">
      <a href="homepage.php">
        <img src="images/logo.png" alt="FOXcinema Logo" class="login-logo" />
      </a>
    </div>
    <form onsubmit="validate(event)" method="POST" class="w3-container login-form">
      <div class="input-container">
      <label>Username</label>
      <div id="un-error-message" class="w3-text-red"></div>
      </div>
      <input class="w3-input custom-input" type="text" name="username" required>

      <div class="input-container">
        <label>Email</label>
        <div id="em-error-message" class="w3-text-red"></div>
        </div>
      <input class="w3-input custom-input" type="email" name="email" required>

      <div class="input-container">
        <label>Password</label>
        <div id="pw-error-message" class="w3-text-red"></div>
        </div>
      <input class="w3-input custom-input" type="password" name="password" required>

      <div class="input-container">
        <label>Confirm Password</label>
        <div id="cp-error-message" class="w3-text-red"></div>
        </div>
      <input class="w3-input custom-input" type="password" name="confirm" required>

      <button class="w3-button w3-red custom-btn" type="submit">Register</button>
    </form>

    <p class="w3-center login-footer-text">
      Already have an account? <a href="login.php">Login</a>
    </p>
  </div>
</body>
</html>
<script src="JS/validate.js"></script>

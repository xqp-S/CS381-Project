<?php
  session_start();
  $email = false;
  $password = false;

  $form_msg = "";

  require_once "dbconfig.php";
      

  if ($_SERVER['REQUEST_METHOD'] == "POST") {

    
      $db = new db();
      $db->connect();
  
      $email = $_POST['email'];
      $password = $_POST['password'];

      $sql = "SELECT * FROM user_tbl WHERE email = '$email' and password = '$password'";
      $result = $db->get_records($sql);
      // echo var_dump($result);
      if ($result) {

         
          $_SESSION['signedin'] = "yes";
          $_SESSION['usertype'] = $result[0]->user_type;
          $_SESSION['user_id'] = $result[0]->user_id;
        //  if user is admin take to admin dashboard else take to homepage
          if($result[0]->user_type=='Admin'){
            header('Location: admin.php');
          }else{
            header('Location: homepage.php');
          }
          

          
          
      } else {
          $form_msg= "incorrect email or password";
      }

      $db->close();
  }

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Login - FOXcinema</title>
  <link rel="stylesheet" href="css/style.css" />
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/5/w3.css" />
  <link rel="website icon" href="images/logo.png">
</head>
<body class="w3-black">
  <div class="login-box">
    <div class="logo-wrapper">
      <a href="homepage.php">
        <img src="images/logo.png" alt="FOXcinema Logo" class="login-logo" />
      </a>
    </div>

    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST" class="w3-container login-form">
      <div class="w3-text-red"><?php echo $form_msg?></div>
      <label>Email</label>
      <input class="w3-input custom-input" type="email" name="email" required>

      <label>Password</label>
      <input class="w3-input custom-input" type="password" name="password" required>

      <button class="w3-button w3-red custom-btn" type="submit">Login</button>
    </form>

    <p class="w3-center login-footer-text">
      Don't have an account? <a href="register.php">Register</a>
    </p>
  </div>
</body>
</html>

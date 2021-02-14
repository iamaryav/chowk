<?php

  session_start();

  $con = mysqli_connect("localhost", "root", "", "chowk");

  if(isset($_POST['button'])){
    
    $email1 = $_POST['email1'];
    $pass = $_POST['pass'];

    $query = "SELECT email FROM admin WHERE email='$email1' AND password='$pass' ";
    $result = mysqli_query($con, $query);

    if(mysqli_num_rows($result)==1){

      $_SESSION['message'] = "welcome";

      $row = mysqli_fetch_array($result);
      $_SESSION['email1'] = $row['email'];
      header('location:admin_profile.php');

    }
    else{
      $_SESSION['message']="email or password is wrong";
      header('location:./admin_login.php');
    }
  }
  
  mysqli_close($con);
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <link rel="icon" type="image/x-icon" href="../images/chowk_icon.ico" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../css/login_style.css" type="text/css" />
    <script
      type="text/javascript"
      src="../javascript/login_validation.js"
    ></script>
    <title>Login</title>
  </head>

  <body>
    <div class="forms" id="forms1">
      <a href="../home.php" id="cross">x</a>
      <h1 id="logop">
        <span id="logo1">C</span><span id="logo2">h</span
        ><span id="logo3">o</span><span id="logo4">w</span
        ><span id="logo5">k</span>
      </h1>
      <span id="text2">Admin login</span>
      <form
        action="admin_login.php"
        method="POST"
        id="login_form"
        onsubmit="return validate()"
      >
        <input
          type="email"
          placeholder="Enter your email"
          class="input_field"
          id="email1"
          name="email1"
          required
        /><br />
        <span id="email_error" style="color:red;"></span>
        <input
          type="password"
          placeholder="password"
          class="input_field"
          id="pass"
          name="pass"
          required
        />
        <input type="checkbox" onclick="visiblepass()" />
        <span id="pass_error" style="color:red;"></span>
        <a href="../login.php" id="link2">User login</a>
        <input type="submit" value="Login" id="button2" name="button" />
      </form>
    </div>
  </body>
</html>
<script>
  window.onload = function() {
    fieldfocus();
  };
  function fieldfocus() {
    var email = document.getElementById("email1");
    email.focus();
  }

  function visiblepass() {
    var x = document.getElementById("pass");
    if (x.type == "password") {
      x.type = "text";
    } else {
      x.type = "password";
    }
  }

  var email = document.getElementById("email1");
  var pass = document.getElementById("pass");
  var email_error = document.getElementById("email_error");
  var pass_error = document.getElementById("pass_error");

  email.addEventListener("blur", emailVerify, true);
  pass.addEventListener("blur", passVerify, true);

  function validate() {
    if (email.value.trim() == "") {
      email.style.border = "2px red solid";
      email_error.textContent = "Email is required";
      email.focus();
      return false;
    }
    if (pass.value.trim() == "") {
      pass.style.border = "2px red solid";
      pass_error.textContent = "Password is required";
      pass.focus();
      return false;
    }
  }

  function emailVerify() {
    if (email.value.trim() != "") {
      email.style.border = "2px gray solid";
      email_error.innerHTML = "";
      return true;
    }
  }
  function passVerify() {
    if (pass.value.trim() != "") {
      pass.style.border = "2px gray solid";
      pass_error.innerHTML = "";
      return true;
    }
  }
</script>

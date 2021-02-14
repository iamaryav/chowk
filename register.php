<?php

  session_start();

  //Database connection

  $con = mysqli_connect("localhost", "root", "", "chowk");

  //check connection
  
  if(mysqli_connect_errno()){
    die("Failed to connect: " .mysqli_connect_error());
  }
  //object oriented approach

  /*
  if($con->connect_error){
    die("Failed to connect: " .$con->connect_error);
  }*/

  if(isset($_POST['button'])){

    //Fetchin all the form data and saving into variable

    $fname = validate_input($_POST['fname']);
    $lname = validate_input($_POST['lname']);
    $email = validate_input($_POST['email']);
    $pass = validate_input($_POST['pass']);
    $cpass = validate_input($_POST['cpass']);
    $country_code = validate_input($_POST['country_code']);
    $phone = validate_input($_POST['phone']);
    $dob = validate_input($_POST['dob']);
    $genders = validate_input($_POST['genders']);


    //$pass  = md5($pass);

    $sql = "INSERT INTO users(fname, lname, email, password, country_code, phone, dob, gender) VALUES 
            ('$fname', '$lname', '$email', '$pass', $country_code, '$phone', '$dob', '$genders') ";
    $result = mysqli_query($con, $sql);
    //$result = $con->mysqli_query($sql);//object oriented approach

    if($result)
    {
      $_SESSION['fname'] = $fname;
      $_SESSION['lname'] = $lname;
      $_SESSION['email'] = $email;

      header('location:http://localhost/chowk/user/profile.php');
    }
    else{
      
      header('location:http://localhost/chowk/register.php');
       
    }

  }
  
  function validate_input($data){
    $data = trim($data);
    //$data = stripslashes($data);
    //$data = htmlspecialchars($data);
    //$data = mysqli_real_escape_string($data);
    return $data;
  }

  mysqli_close($con);

  //$con->close();//object oriented approach
?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <link rel="icon" type="image/x-icon" href="./images/chowk_icon.ico" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="./css/register_style.css" type="text/css" />
    <title>Register to Chowk</title>
  </head>
  <body>
    <div class="logo">
      <h1>
        <span id="logo1">C</span><span id="logo2">h</span
        ><span id="logo3">o</span><span id="logo4">w</span
        ><span id="logo5">k</span>
      </h1>
    </div>
    <div class="forms">
      <span id="reg">
        Register
      </span>
      <a href="home.php" id="cross">x</a>
      <form
        action="register.php"
        method="POST"
        onsubmit="return validate()"
      >
        <input type="text" placeholder="First Name" id="fname" name="fname"/>
        <input type="text" placeholder="Last Name" id="lname" name="lname"/>
        <input type="email" placeholder="Email" id="email" name="email"/>
        <input type="password" placeholder="Password" id="pass" name="pass"/>
        <input type="password" placeholder="Confirm" id="cpass" name="cpass"/>
        <input type="checkbox" id="checkbox" onclick="visitpas()" /><br />
        <select id="country_code" name="country_code">
          <option>91</option>
          <option>92</option>
          <option>93</option>
        </select>
        <input type="number" placeholder="Mobile No" id="phone" name="phone"/><br />
        <span id="sdob">Date Of Birth</span>
        <input type="date" id="dob" name="dob" /><br />
        <span id="gender">Gender </span>
        <select id="genders" name="genders" >
          <option>Male</option>
          <option>Female</option>
          <option>Transgender</option> </select
        ><br /><br /><br /><br /><br />
        <a href="login.php" id="signin">Sign in instead</a>
        <span id="error"></span>
        <input type="submit" value="Submit" id="button1" name="button" />
      </form>
    </div>
  </body>
</html>

<script>
  var fname = document.getElementById("fname");
  var lname = document.getElementById("lname");
  var email = document.getElementById("email");
  var pass = document.getElementById("pass");
  var cpass = document.getElementById("cpass");
  var phone = document.getElementById("phone");
  var date = document.getElementById("dob");
  var error = document.getElementById("error");

  window.onload = function() {
    fieldfocus();
  };

  function fieldfocus() {
    fname.focus();
  }

  //setting all event listeners
  fname.addEventListener("blur", fnameVerify, true);
  lname.addEventListener("blur", lnameVerify, true);
  email.addEventListener("blur", emailVerify, true);
  pass.addEventListener("blur", passVerify, true);
  cpass.addEventListener("blur", cpassVerify, true);
  phone.addEventListener("blur", phoneVerify, true);
  date.addEventListener("blur", dateVerify, true);

  function validate() {
    var date = document.getElementById("dob");
    var date1 = new Date(date.value);
    var date2 = new Date();
    //fname validation
    if (fname.value.trim() == "") {
      fname.style.border = "2px red solid";
      error.textContent = "First Name is required";
      fname.focus();
      return false;
    }

    // lname validation

    if (lname.value.trim() == "") {
      lname.style.border = "2px red solid";
      error.textContent = "Last Name is required";
      lname.focus();
      return false;
    }
    if (fname.value.trim().length <= 1 || lname.value.trim().length <= 1) {
      alert("Name must contains more than one character");
      fname.focus();
      fname.style.border = "2px red solid";
      return false;
    }

    //email validation

    if (email.value == "") {
      email.style.border = "2px red solid";
      error.textContent = "Email is required";
      email.focus();
      return false;
    }

    //password validation

    if (pass.value.trim() == "") {
      pass.style.border = "2px red solid";
      error.textContent = "password  is required";
      pass.focus();
      return false;
    }
    if (cpass.value.trim() == "") {
      cpass.style.border = "2px red solid";
      error.textContent = "Confirm your password";
      cpass.focus();
      return false;
    }
    if (cpass.value.trim().length < 8 || pass.value.trim().length < 8) {
      cpass.style.border = "2px red solid";
      pass.style.border = "2px red solid";
      alert("Password must have more than eight character");
      pass.focus();
      return false;
    }

    if (pass.value.trim() != cpass.value.trim()) {
      pass.style.border = "2px red solid";
      cpass.style.border = "2px red solid";
      error.textContent = "The two password do not match";
      pass.focus();
      return false;
    }

    if (phone.value == "") {
      phone.style.border = "2px red solid";
      error.textContent = "Mobile no. is required";
      phone.focus();
      return false;
    }
    if (phone.value.length != 10) {
      phone.style.border = "2px red solid";
      alert("Mobile no. must have ten digit");
      phone.focus();
      return false;
    }
    if (date.value == "") {
      date.style.border = "2px red solid";
      error.textContent = "Date of birth is required";
      date.focus();
      return false;
    }

    if (date2.getFullYear() - date1.getFullYear() < 13) {
      date.style.border = "2px red solid";
      error.textContent = "You are under 13";
      date.focus();
      return false;
    }
  }

  //event handler function

  function fnameVerify() {
    if (fname.value != "") {
      fname.style.border = "2px gray solid";
      error.innerHTML = "";
      return true;
    }
  }
  function lnameVerify() {
    if (lname.value != "") {
      lname.style.border = "2px gray solid";
      error.innerHTML = "";
      return true;
    }
  }
  function emailVerify() {
    if (email.value != "") {
      email.style.border = "2px gray solid";
      error.innerHTML = "";
      return true;
    }
  }
  function passVerify() {
    if (pass.value != "") {
      pass.style.border = "2px gray solid";
      error.innerHTML = "";
      return true;
    }
  }
  function cpassVerify() {
    if (cpass.value != "") {
      cpass.style.border = "2px gray solid";
      error.innerHTML = "";
      return true;
    }
  }
  function phoneVerify() {
    if (phone.value != "") {
      phone.style.border = "2px gray solid";
      error.innerHTML = "";
      return true;
    }
  }
  function dateVerify() {
    if (date.value != "") {
      date.style.border = "2px gray solid";
      error.innerHTML = "";
      return true;
    }
  }

  function visitpas() {
    if (pass.type == "password" || cpass.type == "password") {
      pass.type = "text";
      cpass.type = "text";
    } else {
      pass.type = "password";
      cpass.type = "password";
    }
  }
</script>

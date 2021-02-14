<?php
    session_start();

    if(!isset($_SESSION['email1']))
    {
        header('location:admin_login.php');
    }

    $con = mysqli_connect("localhost", "root", "", "chowk");
    if(!$con){
        die("Connection not established" .mysqli_connect_error());
        header('location:users.php');
    }
    $id = $_REQUEST['id'];
    
    if($id){
  
      $query = "SELECT * FROM users WHERE user_no=$id";

      $res = mysqli_query($con,$query);
      $row = mysqli_fetch_assoc($res);
  }

    /*if(isset($_POST['button'])){ //some data updation error occurs in same page

        //Fetchin all the form data and saving into variable
        function validate_input($data){
          $data = trim($data);
          //$data = stripslashes($data);
          //$data = htmlspecialchars($data);
          //$data = mysqli_real_escape_string($data);
          return $data;
        }
    
        $fname = validate_input($_POST['fname']);
        $lname = validate_input($_POST['lname']);
        $email = validate_input($_POST['email']);
        $pass = validate_input($_POST['pass']);
        $cpass = validate_input($_POST['cpass']);
        $country_code = validate_input($_POST['country_code']);
        $phone = validate_input($_POST['phone']);
        $dob = validate_input($_POST['dob']);
        $genders =  validate_input($_POST['genders']);
    
    
        //$pass  = md5($pass);
    
       $update = "UPDATE USERS SET fname='$fname', lname='$lname', password='$pass', country_code=$country_code, phone='$phone',
                    dob='$dob', gender='$genders' WHERE user_no=$id ";
        $result = mysqli_query($con, $update);
        //$result = $con->mysqli_query($sql);//object oriented approach
      
        if($result)
        {
         
          header('location:http://localhost/chowk/admin/users.php');
        }
        else{
          
          header('location:http://localhost/chowk/admin/users.php');
           
        }
    
      }*/

      mysqli_close($con);

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <link rel="icon" type="image/x-icon" href="../images/chowk_icon.ico" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../css/register_style.css" type="text/css" />
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
      <a href="users.php" id="cross">x</a>
      <form
        action="edit.php?id=<?php echo $id; ?>"
        method="POST"
        onsubmit="return validate()"
      >
        <input type="text" placeholder="First Name" value="<?php echo $row['fname']; ?>" id="fname" name="fname"/>
        <input type="text" placeholder="Last Name" value="<?php echo $row['lname']; ?>"  id="lname" name="lname"/>
        <input type="email" placeholder="Email" value="<?php echo $row['email']; ?>"  id="email" name="email" readonly/>
        <input type="password" placeholder="Password" value="<?php echo $row['password']; ?>" id="pass" name="pass"/>
        <input type="password" placeholder="Confirm" value="<?php echo $row['password']; ?>" id="cpass" name="cpass"/>
        <input type="checkbox" id="checkbox" onclick="visitpas()" /><br />
        <select id="country_code" name="country_code" >
          <option value="value="<?php echo $row['country_code']; ?>" selected="selected" "><?php echo $row['country_code']; ?></option>
          <option>91</option>
          <option>92</option>
          <option>93</option>
        </select>
        <input type="number" placeholder="Mobile No" value="<?php echo $row['phone']; ?>" id="phone" name="phone"/><br />
        <span id="sdob">Date Of Birth</span>
        <input type="date" id="dob" name="dob" value="<?php echo $row['dob']; ?>"/><br />
        <span id="gender">Gender </span>
        <select id="genders" name="genders">
        <option value="value="<?php echo $row['gender']; ?>" selected="selected" "><?php echo $row['gender']; ?></option>
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
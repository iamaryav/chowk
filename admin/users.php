<?php
  session_start();
  if(!isset($_SESSION['email1'])){
    header('location:admin_login.php');
  }
  else{

    $con = mysqli_connect("localhost", "root", "", "chowk");

    if(!$con){
      die("Connection is not established" .mysqli_connect_error());
    }
    $email = $_SESSION['email1'];
    //for selection of all users
    $query = "SELECT * FROM users ";
    $result = mysqli_query($con, $query);
    $num = mysqli_num_rows($result);
   
    // For deletion of user
    if(isset($_POST['del_btn'])){

     $size = sizeof($_POST);
      $j = 1;
      for($i=1; $i<=$size; $i++,$j++){

        $index = "u".$j;

        if(isset($_POST[$index])){

          $user[$i] = $_POST[$index];

        }
        //else{
          //$i--;
        //}
      }

      for($k=1; $k<=$size; $k++){

        $q = "DELETE FROM USERS WHERE user_no=".$user[$k];
        mysqli_query($con,$q);
      }
      header('location:http://localhost/chowk/admin/users.php');
    }
   
    // For inserting of new user

    if(isset($_POST['button'])){

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
      $genders = validate_input($_POST['genders']);
  
  
      //$pass  = md5($pass);
  
      $sql = "INSERT INTO users(fname, lname, email, password, country_code, phone, dob, gender) VALUES 
              ('$fname', '$lname', '$email', '$pass', $country_code, '$phone', '$dob', '$genders') ";
      $result = mysqli_query($con, $sql);
      //$result = $con->mysqli_query($sql);//object oriented approach
  
      if($result)
      {
       
        header('location:http://localhost/chowk/admin/users.php');
      }
      else{
        
        header('location:http://localhost/chowk/admin/users.php');
         
      }
  
    }
    
  }
  mysqli_close($con);
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="icon" type="image/x-icon" href="../images/chowk_icon.ico" />
    <link rel="stylesheet" href="../css/common_style.css" />
    <link rel="stylesheet" href="../css/users_style.css" />
    <title>Users</title>
  </head>
  <body>
    <div class="container" id="container">
      <div class="header">
        <a href="#"
          ><img src="../images/chowk_logo.png" id="header_logo_image"
        /></a>
        <h1 id="header_logo_name">Chowk</h1>
        <input type="text" placeholder="search..." id="header_searchbar" />
        <div class="header_dropdown">
          <button class="header_dropbtn" onclick="showitem()"></button>
          <div class="header_dropdown_content" style="right:7%;" id="dropitem">
            <a href="admin_profile.php">Profile</a>
            <a href="users.php">Users details</a>
            <a href="setting.php">Setting</a>
            <a href="logout.php">Logout</a>
          </div>
        </div>
      </div>
      <div class="forms1">
        <form action="users.php" method="POST">
          <table id="view_user">
          <tr>
              <td colspan="12">
                <input type="submit" value="Delete User" name="del_btn" id="del_btn" />
                <button type="button" id="newuser_button" onclick="showregister()">Add User</button>
                <span id="usercount"
        >User count :
        <?php echo $num; ?></span
      >
              </td>
            </tr>
            <tr>
              <th>Select</th>
              <th>Sl no</th>
              <th>First Name</th>
              <th>Last Name</th>
              <th>Email</th>
              <th>Password</th>
              <th>country Code</th>
              <th>Mobile no.</th>
              <th>Date of Birth</th>
              <th>Gender</th>
              <th>Edit</th>
              <th>Delete</th>
            </tr>
            <?php
                for($i=1;$i<=$num;$i++)
                {
                  $row = mysqli_fetch_array($result);
              ?>
            <tr>
              <td>
                <input
                  type="checkbox"
                  value="<?php echo $row['user_no']; ?>"
                  name="u<?php echo $i; ?>"
                />
              </td>
              <td><?php  echo $i; ?></td>
              <td><?php  echo $row['fname']; ?></td>
              <td><?php  echo $row['lname']; ?></td>
              <td><?php  echo $row['email']; ?></td>
              <td><?php  echo $row['password']; ?></td>
              <td><?php  echo $row['country_code']; ?></td>
              <td><?php  echo $row['phone']; ?></td>
              <td><?php  echo $row['dob']; ?></td>
              <td><?php  echo $row['gender']; ?></td>
              <td><a href="edit_user.php?id=<?php echo $row['user_no']; ?>">Edit</a></td>
              <td><a href="delete.php?id=<?php echo $row['user_no']; ?>">Delete</a></td>
            </tr>
            <?php
                }
              ?>
          </table>
        </form>
      </div>
    </div>
    <div class="forms" id="formsuser">
      <span id="reg">
        Register
      </span>
      <a id="cross" onclick="showbody()">x</a>
      <form action="users.php" method="POST" onsubmit="return validate()">
        <input type="text" placeholder="First Name" id="fname" name="fname" />
        <input type="text" placeholder="Last Name" id="lname" name="lname" />
        <input type="email" placeholder="Email" id="email" name="email" />
        <input type="password" placeholder="Password" id="pass" name="pass" />
        <input type="password" placeholder="Confirm" id="cpass" name="cpass" />
        <input type="checkbox" id="checkbox" onclick="visitpas()" /><br />
        <select id="country_code" name="country_code">
          <option>91</option>
          <option>92</option>
          <option>93</option>
        </select>
        <input
          type="number"
          placeholder="Mobile No"
          id="phone"
          name="phone"
        /><br />
        <span id="sdob">Date Of Birth</span>
        <input type="date" id="dob" name="dob" /><br />
        <span id="gender">Gender </span>
        <select id="genders" name="genders">
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
  function showitem() {
    document.getElementById("dropitem").classList.toggle("dropdown_show");
  }
  window.onclick = function(event) {
    if (!event.target.matches(".header_dropbtn") ) {
      var dropdowns = document.getElementsByClassName(
        "header_dropdown_content"
      );
      var i;
      for (i = 0; i < dropdowns.length; i++) {
        var openDropdown = dropdowns[i];
        if (openDropdown.classList.contains("dropdown_show")) {
          openDropdown.classList.remove("dropdown_show");
        }
      }
    }
  };
  function showregister() {
    var formsuser = document.getElementById("formsuser");
    var container = document.getElementById("container");
    container.style.opacity = "0.2";
    formsuser.style.display = "block";
  }
  function showbody() {
    var formsuser = document.getElementById("formsuser");
    var container = document.getElementById("container");
    container.style.opacity = "1";
    formsuser.style.display = "none";
  }

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

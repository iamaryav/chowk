<?php
    session_start();
    if(!isset($_SESSION['email1'])){
        header('location:./admin_login.php');
    }
    else{

        $con = mysqli_connect("localhost", "root", "", "chowk");

        if(!$con){
            die("Connection not established" .mysqli_connect_error());
        }
        $email = $_SESSION['email1'];
        $query = "SELECT * FROM admin WHERE email='$email' ";
        $res = mysqli_query($con,$query);
        
        if(mysqli_num_rows($res)==1){

            $row = mysqli_fetch_array($res);
            $fname = $row['fname'];
            $lname = $row['lname'];

            $sql = " SELECT COUNT(email) FROM USERS";
            $result= mysqli_query($con,$sql);
            $row1 = mysqli_fetch_array($result);
            $count = $row1[0];
        }
        else{
            die("something went wrong" .mysqli_connect_error());
        }
      
    }
   
  $con->close(); 
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <link rel="icon" type="image/x-icon" href="../images/chowk_icon.ico" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../css/admin_profile_style.css" />
    <title><?php echo $lname; ?></title>
  </head>
  <body>
    <div class="container">
      <div class="header">
        <a href="#"><img src="../images/chowk_logo.png" id="logo_image"/></a>
        <h1 id="head_name">Chowk</h1>
        <div class="dropdown">
          <button class="dropbtn" onclick="showitem()"></button>
          <div class="dropdown-content" style="right:7%;" id="dropitem">
            <a href="admin_profile.php">Profile</a>
            <a href="users.php">Users details</a>
            <a href="setting.php">Setting</a>
            <a href="logout.php">Logout</a>
            
          </div>
        </div>
      </div>
      <span id="usercount"
        >User count :
        <?php echo $count; ?></span
      >
    </div>
  </body>
</html>
<script>
  function showitem() {
    document.getElementById("dropitem").classList.toggle("show");
  }
  window.onclick = function(event) {
    if (!event.target.matches(".dropbtn")) {
      var dropdowns = document.getElementsByClassName("dropdown-content");
      var i;
      for (i = 0; i < dropdowns.length; i++) {
        var openDropdown = dropdowns[i];
        if (openDropdown.classList.contains("show")) {
          openDropdown.classList.remove("show");
        }
      }
    }
  };
</script>

<?php
    session_start();
    if(!isset($_SESSION['email'])){
        header('location:http://localhost/chowk/login.php');
    }
    else{

        $con = mysqli_connect("localhost", "root", "", "chowk");
        $email = $_SESSION['email'];
        $sql = "SELECT * FROM users WHERE email='$email'";

        $result = mysqli_query($con,$sql);

        if(mysqli_num_rows($result)==1){
            
            $row = mysqli_fetch_array($result);
            $_SESSION['fname'] = $row['fname'];
            $_SESSION['lname'] = $row['lname'];
            $fname = $row['fname'];

        }
        else{
            $_SESSION['message'] = "something went wrong";
        }
    }
    mysqli_close($con);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="icon" type="image/x-icon" href="../images/chowk_icon.ico" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../css/common_style.css" />
    <link rel="stylesheet" href="../css/user_profile_style.css" />
    <title><?php echo $_SESSION['fname']," ", $_SESSION['lname']; ?></title>
</head>
<body>
<div class="container" id="container">
      <div class="header">
        <a href="home.php"
          ><img src="../images/chowk_logo.png" id="header_logo_image"
        /></a>
        <h1 id="header_logo_name">Chowk</h1>
        <input type="text" placeholder="Search on chowk" id="header_searchbar" />
        <a href="home.php"><img src="../images/home.png" class="header_image" id="header_home_image"></a>
        <a href="chat.php"><img src="../images/chat.png" class="header_image"></a>
        <a href="notification.php"><img src="../images/notification.png" class="header_image"></a>
        
        <div class="header_dropdown">
          <button class="header_dropbtn" onclick="showitem()"></button>&nbsp;
          <span id="header_user_name" onclick="showitem()"><?php echo $row['fname']; ?></span>
          <div class="header_dropdown_content" style="right:7%;" id="dropitem">
            <a href="home.php">Home</a>
            <a href="profile.php">Profile</a>
            <a href="setting.php">Settings</a>
            <a href="help.php">Help</a>
            <a href="logout.php">Logout</a>
          </div>
        </div>
      </div>
      <div class="left_side" class="adjust">
        <div class="all_menus">
          <a href="home.php">Home</a><hr>
          <a href="profile.php">Profile</a><hr>
          <a href="posts.php">Posts</a><hr>
          <a href="chat.php">Chat</a><hr>
          <a href="tagged.php">Tagged</a><hr>
          <a href="notification.php">Notification</a><hr>
        </div>
      </div>
      <div class="profile_body">
      <div class="bg_image" class="adjust">
        <img src="../images/bgimage1.jpg" id="bgimage">

      </div>
      <div class="profile_image">
        <img src="./images/profile_pic/profile3.jpg" id="proimage"/>
      </div>
      <div class="profile_name"><span id="pname"><?php echo $row['fname']," ",$row['lname']; ?></span></div>
      </div>
      <div class="right_side" class="adjust">
        hi
      </div>
</div>
</body>
</html>
<script>
 window.onload = function() { message1(); }
 function message1(){
     //alert("<?php echo $_SESSION['message'], " ", $fname ; ?>");
     
 }
 function showitem() {
    document.getElementById("dropitem").classList.toggle("dropdown_show");
  }
  window.onclick = function(event) {
    if (!event.target.matches(".header_dropbtn") && !event.target.matches(".header_user_name")) {
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

</script>
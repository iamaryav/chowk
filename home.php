<!DOCTYPE html>
<html>
  <head>
    <link rel="icon" type="image/x-icon" href="./images/chowk_icon.ico" />
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <title>Chowk</title>
    <link rel="stylesheet" type="text/css" href="css/home_style.css" />
  </head>
  <body>
    <div id="body1">
      <div class="header" id="yHeader">
        <a href="home.php"><img src="images/chowk_logo.png" id="logo"/></a>
        <h1 id="head_name">Chowk</h1>
        <a href="login.php" id="head_login">Login</a>
        <a href="register.php" class="button" id="head_signup">Sign Up</a>
      </div>
      <div class="container2">
        <div class="container2_element1">
          <p>Connect<br />Share<br />Discuss.</p>
          <br />
          <a href="register.php" class="button">Create an account</a>
        </div>
        <div class="container2_element2" id="body_image"></div>
      </div>
      <div class="footer">
        <p>
          About Language Contact Services Terms Help Location Privacy Carriers
          Cookies
          <a href="./admin/admin_login.php" style="color:black;">Admin</a>
        </p>
        <p id="copy">copyright &copy; 2019 Chowk</p>
      </div>
    </div>
  </body>
</html>
<script> 
  window.onscroll = function() {
    fixedHeader();
  };

  var header = document.getElementById("myHeader");
  var sticky = header.offsetTop;

  function fixedHeader() {
    if (window.pageYOffset > sticky) {
      header.classList.add("sticky");
    } else {
      header.classList.remove("sticky");
    }
  }
  function showlogin() {
    var forms1 = document.getElementById("forms1");
    var body1 = document.getElementById("body1");
    body1.style.opacity = "0.4";
    forms1.style.display = "block";
  }
  function showbody(){
    var forms1 = document.getElementById("forms1");
    var body1 = document.getElementById("body1");
    body1.style.opacity = "1";
    forms1.style.display = "none";
  }
</script>

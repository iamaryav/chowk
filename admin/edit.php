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
    
      }
      mysqli_close($con);

?>
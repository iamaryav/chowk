<?php
    session_start();

    if(!isset($_SESSION['email1']))
    {
        header('location:admin_login.php');
    }

    $con = mysqli_connect("localhost", "root", "", "chowk");
   /* if(isset($_POST['del_btn'])){

        
        $size = sizeof($_POST);
        $j = 1;
        for($i = 1; $i<=$size; $i++,$j++){
  
          $index = "u".$j;
          if(isset($_POST[$index])){

            $user[$i] = $_POST[$index];
  
          }
         // else{
         //   $i--;
         // }
        }
  
        for($k=1;$k<=$size;$k++){
  
          $q = "DELETE FROM USERS WHERE user_no=".$user[$k];
          mysqli_query($con,$q);
        }
    }*/
    $id = $_REQUEST['id'];
    if($id){

      $del = "DELETE FROM USERS WHERE user_no=$id";
      $resl = mysqli_query($con,$del);
      if($resl)
      {
        header('location:http://localhost/chowk/admin/users.php');
      }
    }
    //header('location:users.php');
    mysqli_close($con);
?>
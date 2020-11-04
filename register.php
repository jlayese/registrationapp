<?php 
   //$status = $_POST["status"];
   $counter = 0;
  

   $link = mysqli_connect("localhost", "root", "");
   mysqli_select_db($link, "registrationdb");

   //if($status == "insert"){
     
      $firstname = $_POST['firstname'];
      $lastname = $_POST['lastname'];
      $email = $_POST['email'];
      $password = $_POST['password'];
      $datereg = $_POST['date'];
      $timereg = $_POST['time'];
      
      try {

         $res = mysqli_query($link, "INSERT INTO datatable VALUES('','$firstname', '$lastname', '$email', '$password', '$datereg', '$timereg')"); //add quotes to string conversion
         header("Location: index.php");
      } catch (Exception $e) {

         echo 'Caught exception: ',  $e->getMessage(), "\n";

      }

      //$_SESSION['message']="password has been updated";
      //header("Location: admin_login.php");
      //exit;
      //print "Message is Saved!";
   //}

?>


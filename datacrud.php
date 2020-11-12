<?php 
   include "config.php";
   
   if (isset($_POST['action']) && $_POST['action'] == 'login') {
      $email = mysqli_real_escape_string($con,$_POST['email']);
      $password = mysqli_real_escape_string($con,$_POST['password']);
      
      if ($email != "" && $password != "") {
         $sql_query = "SELECT * FROM datatable WHERE email='".$email."' and password='".$password."'";
         $result = mysqli_query($con,$sql_query);
         $row = mysqli_fetch_array($result);
         $count = mysqli_num_rows($result);

         if($count > 0){
            $_SESSION['uname'] = $email;
            echo 1;
         }else{
            echo 0;
         }
      }
   }
   
//--------------------------------------------------------------------------------

   if (isset($_POST['action']) && $_POST['action'] == 'register') {

      $firstname = mysqli_real_escape_string($con,$_POST['firstname']);
      $lastname = mysqli_real_escape_string($con,$_POST['lastname']);
      $email = mysqli_real_escape_string($con,$_POST['email']);
      $password = mysqli_real_escape_string($con,$_POST['password']);
      $datereg = mysqli_real_escape_string($con,$_POST['date']);
      $timereg = mysqli_real_escape_string($con,$_POST['time']);
         
      try {
         $res = mysqli_query($con, "INSERT INTO datatable VALUES('','$firstname', '$lastname', '$email', '$password', '$datereg', '$timereg')"); //add quotes to string conversion
         
      } catch (Exception $e) {
         echo 'Caught exception: ',  $e->getMessage(), "\n";
      }
      
  }

  if (isset($_POST['action']) && $_POST['action'] == 'display') {
     
   $counter = 0;
   $output = '';
   $order = $_POST['order'];
   if($order == 'desc') {
      $order = 'asc';
   } else {
      $order = 'desc';
   }
   $query = "SELECT * FROM datatable ORDER BY ".$_POST['column_name']." ".$_POST['order']."";
   $res = mysqli_query($con, $query);
   $output .='
   <table>  
      <tr>  
           <th><a class="column_sort" id="id" data-order="'.$order.'" href="#">ID</a></th>  
           <th><a class="column_sort" id="firstname" data-order="'.$order.'" href="#">Firstname</a></th>  
           <th><a class="column_sort" id="lastname" data-order="'.$order.'" href="#">Lastname</a></th>  
           <th><a class="column_sort" id="email" data-order="'.$order.'" href="#">Email</a></th>  
           <th><a class="column_sort" id="datereg" data-order="'.$order.'" href="#">Date Registererd</a></th>  
           <th><a class="column_sort" id="timereg" data-order="'.$order.'" href="#">Time Registered</a></th>  
      </tr>  
   ';
   while($row = mysqli_fetch_array($res)){  
            $counter++;
            $output .= '  
            <tr>  
                 <td>' . $row["id"] . '</td>  
                 <td>' . $row["firstname"] . '</td>  
                 <td>' . $row["lastname"] . '</td>  
                 <td>' . $row["email"] . '</td>  
                 <td>' . $row["datereg"] . '</td>  
                 <td>' . $row["timereg"] . '</td>  
            </tr>  
            ';  
      }  
      $output .= '</table>';  
      echo $output;  

  }

?>


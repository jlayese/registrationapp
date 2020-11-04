<?php 
   $status = $_GET["status"];
   $counter = 0;
   $link = mysqli_connect("localhost", "root", "");
   mysqli_select_db($link, "registrationdb");

   if($status == "disp") {
     
      $res = mysqli_query($link, "select * from datatable");

      echo "<table>";
         while($row = mysqli_fetch_array(($res))){
            $counter++;
            echo "<tr>";
               echo "<td>" . $counter . "</td>";
               echo '<td><div id ="name'.$row['id'].'">'.$row["name"]."</div></td>";
               echo '<td><div id ="city'.$row['id'].'">'.$row["city"]."</div></td>";
               echo '<td><input type="button" id="'.$row['id'].'" name="'.$row['id'].'" value="delete" onClick="deletedata(this.id)"></td>';
               echo '<td><input type="button" id="'.$row['id'].'" name="'.$row['id'].'" value="edit" onClick="aa(this.id)"></td>';
               echo '<td><input type="button" id="update'.$row['id'].'" name="'.$row['id'].'" value="update" style="visibility:hidden" onClick="bb(this.name)"></td>';

            echo "</tr>";
         }
      echo "</table>";
   }

   if($status == "update") {
      $id = $_GET['id'];
      $name = $_GET['name'];
      $city = $_GET['city'];

      $name = trim($name);
      $city = trim($city);

      $res = mysqli_query($link, "UPDATE datatable SET name='$name', city='$city' WHERE id='$id'");
   }

   if($status == "delete"){
      $id = $_GET['id'];

      $res = mysqli_query($link, "DELETE from datatable WHERE id=$id");
   }

   if($status == "insert"){
      $name = $_GET['name'];
      $city = $_GET['city'];
   
     
      $res = mysqli_query($link, "INSERT INTO datatable VALUES('','$name', '$city')"); //add quotes to string conversion
    
   }

?>

